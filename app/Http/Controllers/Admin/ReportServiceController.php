<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\Element;
use App\Models\Respondent;
use App\Models\Service;
use App\Models\Skm;

use Illuminate\Http\Request;

class ReportServiceController extends Controller
{


    public function __construct()
    {
        $this->middleware('permission:report.ikm-by-service')->only(['ikmByService']);
        $this->middleware('permission:report.ikm-by-service-by-unor')->only(['ikmByServiceByUnor']);
    }

    public function ikmByService(Request $request)
    {
        $skmSelectedName = 'Provinsi Gorontalo';
        $skmSelected = null;
        $serviceSelectedName = 'Semua Layanan';
        $serviceSelected = null;
        $yearSelected = date('Y');
        $monthSelected = null;
        if ($request->isMethod('POST')) {
            $skmSelected = $request->skm;
            $skm = Skm::with('unor')->find($skmSelected);
            $skmSelectedName = $skm?->unor?->name ?? $skmSelectedName;
            $serviceSelected = $request->service;
            $yearSelected = $request->year;
            $monthSelected = $request->month;
            $serviceSelectedName = Service::find($serviceSelected)->name ?? $serviceSelectedName;
        }

        return $this->renderIkm(
            $skmSelected,
            $skmSelectedName,
            $serviceSelected,
            $serviceSelectedName,
            $yearSelected,
            $monthSelected
        );
    }



    public function ikmByServiceByUnor(Request $request)
    {

        $unorId = auth()->user()->unor_id;
        $skm = Skm::with('unor')->where('unor_id', $unorId)->first();

        $skmSelectedName = $skm->unor->name;
        $skmSelected = $skm->id;
        $serviceSelectedName = 'Semua Layanan';
        $serviceSelected = null;
        $yearSelected = date('Y');
        $monthSelected = null;
        if ($request->isMethod('POST')) {
            $skmSelected = $request->skm;
            $skm = Skm::with('unor')->find($skmSelected);
            $skmSelectedName = $skm?->unor?->name ?? $skmSelectedName;
            $serviceSelected = $request->service;
            $yearSelected = $request->year;
            $monthSelected = $request->month;
            $serviceSelectedName = Service::find($serviceSelected)->name ?? $serviceSelectedName;
        }

        return $this->renderIkm(
            $skmSelected,
            $skmSelectedName,
            $serviceSelected,
            $serviceSelectedName,
            $yearSelected,
            $monthSelected
        );
    }


    private function renderIkm(
        $skmSelected,
        $skmSelectedName,
        $serviceSelected,
        $serviceSelectedName,
        $yearSelected,
        $monthSelected
    ) {

        $skms = Skm::with('unor')->get();
        $elements = Element::all();


        $rows = Answer::elementScoresByAllServices(
            $skmSelected,
            $yearSelected,
            $monthSelected
        );


        $dataByService = $rows
            ->groupBy('service_id')
            ->map(function ($rows) {

                $elements = $rows->keyBy('element_code')->map(function ($row) {
                    $score = Skm::format(round($row->element_score, 2));
                    $quality = Skm::skmQuality($score);

                    return [
                        'element_name' => $row->element_name,
                        'element_score' => $score,
                        'quality_value' => $quality['value'],
                        'quality_label' => $quality['label'],
                    ];
                });

                return [
                    'service_id' => $rows->first()->service_id,
                    'service_name' => $rows->first()->service_name,
                    'elements' => $elements,
                    'ikm_total' => round($elements->avg('element_score'), 2),
                ];
            });

        $respondentByService = Respondent::countRespondentByService(
            $skmSelected,
            $yearSelected,
            $monthSelected
        );

        $elementScoresAvg = $rows
            ->groupBy('element_code')
            ->map(function ($rows) {
                $score = Skm::format(round($rows->avg('element_score'), 2));
                $quality = Skm::skmQuality($score);

                return [
                    'element_name' => $rows->first()->element_name,
                    'element_score' => $score,
                    'quality_value' => $quality['value'],
                    'quality_label' => $quality['label'],
                ];
            });


        $scoreTotalAvg = 0;
        if ($elementScoresAvg->isNotEmpty()) {
            $scoreTotalAvg = round(
                collect($elementScoresAvg)->avg('element_score'),
                2
            );
        }

        $ikmQuality = Skm::skmQuality($scoreTotalAvg);
        $ikmQualityValue = $ikmQuality['value'];
        $ikmQualityLabel = $ikmQuality['label'];


        return view('admin.report.ikm_by_service.ikm_by_service', compact(
            'skmSelected',
            'skmSelectedName',
            'serviceSelectedName',
            'serviceSelected',
            'yearSelected',
            'monthSelected',
            'skms',
            'elements',
            'dataByService',
            'respondentByService',
            'elementScoresAvg',
            'scoreTotalAvg',
            'ikmQualityLabel',
            'ikmQualityValue',
        ));
    }
}

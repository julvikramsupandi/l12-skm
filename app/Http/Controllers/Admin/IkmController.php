<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\Feedback;
use App\Models\Respondent;
use App\Models\Service;
use App\Models\Skm;
use App\Models\Unor;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class IkmController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // $skm = Skm::with('unor')->find($skm->id);
        // $services = Service::where('skm_id', $skm->id)->get();

        // $serviceSelectedName = 'Semua Layanan';
        // $serviceSelected = null;
        $yearSelected = date('Y');
        $monthSelected = null;
        if ($request->isMethod('POST')) {
            // $serviceSelected = $request->service;
            $yearSelected = $request->year;
            $monthSelected = $request->month;
            // $serviceSelectedName = Service::find($serviceSelected)->name ?? $serviceSelectedName;
        }


        $respondentTotal = Respondent::countRespondent(
            null,
            null,
            $yearSelected,
            $monthSelected
        );

        $elementScores = Answer::elementScores(
            null,
            null,
            $yearSelected,
            $monthSelected
        );

        $scoreTotal = 0;
        if ($elementScores->isNotEmpty()) {
            $scoreTotal = round(
                collect($elementScores)->avg('element_score'),
                2
            );
        }

        $skmQuality = Skm::skmQuality($scoreTotal);
        $skmQualityValue = $skmQuality['value'];
        $skmQualityLabel = $skmQuality['label'];

        $respondentGenderTotal = Respondent::countBy(
            'gender',
            null,
            null,
            $yearSelected,
            $monthSelected
        );

        $respondentEducationTotal = Respondent::countBy(
            'education',
            null,
            null,
            $yearSelected,
            $monthSelected
        );

        $respondentOccupationTotal = Respondent::countBy(
            'occupation',
            null,
            null,
            $yearSelected,
            $monthSelected
        );

        $feedbacks = Feedback::getFeedback(
            null,
            null,
            $yearSelected,
            $monthSelected
        );

        return view(
            'admin.ikm.index',
            compact(
                // 'skm',
                // 'services',
                'respondentTotal',
                'elementScores',
                'scoreTotal',
                'skmQualityValue',
                'skmQualityLabel',
                // 'serviceSelectedName',
                // 'serviceSelected',
                'yearSelected',
                'monthSelected',
                'respondentGenderTotal',
                'respondentEducationTotal',
                'respondentOccupationTotal',
                'feedbacks'
            )
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Skm $skm)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Skm $skm)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Skm $skm)
    {
        //
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Respondent;
use App\Models\Service;
use App\Models\Skm;

class ReportController extends Controller

{

    public function __construct()
    {
        // Respondent
        $this->middleware('permission:report.analytic-respondent')->only(['analyticRespondent']);
        $this->middleware('permission:report.analytic-respondent-by-unor')->only(['analyticRespondentByUnor']);
    }


    public function analyticRespondent(Request $request)
    {

        $skmSelectedName = 'Provinsi Gorontalo';
        $skmSelected = null;
        $serviceSelectedName = 'Semua Layanan';
        $serviceSelected = null;
        $yearSelected = date('Y');
        $monthSelected = null;
        if ($request->isMethod('POST')) {
            $skmSelected = $request->skm;
            $skmSelectedName = Skm::with('unor')->where('id', $skmSelected)->first()->unor->name  ?? $skmSelectedName;
            $serviceSelected = $request->service;
            $yearSelected = $request->year;
            $monthSelected = $request->month;
            $serviceSelectedName = Service::find($serviceSelected)->name ?? $serviceSelectedName;
        }

        return  $this->renderAnalyticRespondent(
            $skmSelected,
            $skmSelectedName,
            $serviceSelected,
            $serviceSelectedName,
            $yearSelected,
            $monthSelected
        );
    }


    public function analyticRespondentByUnor(Request $request)
    {

        $unorId = auth()->user()->unor_id;
        $skm = Skm::with('unor')->where('unor_id', $unor_id)->first();

        $skmSelectedName = $skm->unor->name;
        $skmSelected = $skm->id;
        $serviceSelectedName = 'Semua Layanan';
        $serviceSelected = null;
        $yearSelected = date('Y');
        $monthSelected = null;
        if ($request->isMethod('POST')) {
            $serviceSelected = $request->service;
            $yearSelected = $request->year;
            $monthSelected = $request->month;
            $serviceSelectedName = Service::find($serviceSelected)->name ?? $serviceSelectedName;
        }

        return $this->renderAnalyticRespondent(
            $skmSelected,
            $skmSelectedName,
            $serviceSelected,
            $serviceSelectedName,
            $yearSelected,
            $monthSelected
        );
    }


    private function renderAnalyticRespondent(
        $skmSelected,
        $skmSelectedName,
        $serviceSelected,
        $serviceSelectedName,
        $yearSelected,
        $monthSelected
    ) {
        if ($skmSelected != null) {
            $services = Service::where('skm_id', $skmSelected)->get();

            $skmSelectedName = Skm::with('unor')->where('id', $skmSelected)->first()->unor->name  ?? null;
            $serviceSelectedName = Service::find($serviceSelected)->name ?? null;
        } else {
            $services = Service::all();
        }

        $skms = Skm::with('unor')->get();
        $occupations = Respondent::listOccupation();
        $educations = Respondent::listEducation();
        $disabilityTypes = Respondent::listDisabilityType();

        $respondentTotal = Respondent::countByRespondent(
            $skmSelected,
            $serviceSelected,
            $yearSelected,
            $monthSelected
        );

        $respondentGenderTotal = Respondent::countBy(
            'gender',
            $skmSelected,
            $serviceSelected,
            $yearSelected,
            $monthSelected
        );

        $respondentEducationTotal = Respondent::countBy(
            'education',
            $skmSelected,
            $serviceSelected,
            $yearSelected,
            $monthSelected
        );

        $respondentOccupationTotal = Respondent::countBy(
            'occupation',
            $skmSelected,
            $serviceSelected,
            $yearSelected,
            $monthSelected
        );

        $respondentDisabilityTypeTotal = Respondent::countBy(
            'disability_type',
            $skmSelected,
            $serviceSelected,
            $yearSelected,
            $monthSelected
        );

        $respondentDisabilityTotal = Respondent::countBy(
            'is_disability',
            $skmSelected,
            $serviceSelected,
            $yearSelected,
            $monthSelected
        );

        return view('admin.report.analytic_respondents/analytic_respondents', compact(
            'skmSelected',
            'skmSelectedName',
            'serviceSelectedName',
            'serviceSelected',
            'yearSelected',
            'monthSelected',
            'skms',
            'services',
            'occupations',
            'educations',
            'disabilityTypes',
            'respondentTotal',
            'respondentGenderTotal',
            'respondentEducationTotal',
            'respondentOccupationTotal',
            'respondentDisabilityTypeTotal',
            'respondentDisabilityTotal',
        ));
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\Respondent;
use App\Models\Service;
use App\Models\Skm;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:dashboard.view')->only(['index']);
    }

    public function index()
    {
        $year = date('Y');

        $skmTotal = Skm::count();
        $serviceTotal = Service::where('is_active', true)->count();
        $respondentTotal = Respondent::count();

        $elementScores = Answer::elementScores();

        $skmScoreTotal = 0;
        if ($elementScores->isNotEmpty()) {
            $skmScoreTotal = round(
                collect($elementScores)->avg('element_score'),
                2
            );
        }

        $skmQuality = Skm::skmQuality($skmScoreTotal);
        $skmQualityValue = $skmQuality['value'];
        $skmQualityLabel = $skmQuality['label'];

        $monthlyRespondents = Respondent::getRespondent($year);

        $chartLineData = [];
        for ($i = 1; $i <= 12; $i++) {
            $chartLineData[] = $monthlyRespondents[$i] ?? 0;
        }

        $respondentRecent = Respondent::with('service')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        return view('admin.dashboard', compact(
            'skmTotal',
            'serviceTotal',
            'respondentTotal',
            'elementScores',
            'skmScoreTotal',
            'skmQualityValue',
            'skmQualityLabel',
            'respondentRecent',
            'chartLineData',
            'year',
        ));
    }
}

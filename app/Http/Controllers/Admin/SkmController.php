<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\Respondent;
use App\Models\Service;
use App\Models\Skm;
use App\Models\Unor;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class SkmController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $skm = Skm::with('unor')->get();
        $unors = Unor::all();

        return view('admin.skm.index', compact('skm', 'unors'));
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

        try {
            // cek jika id unor yang direquest ternyata sudah ada di database skm
            $cek = Skm::where('unor_id', $request->unor_id)->first();

            if ($cek) {
                return redirect()
                    ->back()
                    ->with('toast', [
                        'type' => 'error',
                        'title' => 'Gagal',
                        'message' => 'Data sudah ada',
                    ]);
            }

            Skm::create([
                'uuid' => Str::uuid(),
                'unor_id' => $request->unor_id,
            ]);
        } catch (\Throwable $th) {

            return redirect()
                ->back()
                ->with('toast', [
                    'type' => 'error',
                    'title' => 'Gagal',
                    'message' => 'Data gagal disimpan : ' . $th->getMessage(),
                ]);
        }

        return redirect()
            ->back()
            ->with('toast', [
                'type' => 'success',
                'title' => 'Berhasil',
                'message' => 'Data berhasil disimpan',
            ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Skm $skm, Request $request)
    {
        $skm = Skm::with('unor')->find($skm->id);
        $services = Service::where('skm_id', $skm->id)->get();

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


        $respondentTotal = Respondent::countRespondent(
            $skm->id,
            $serviceSelected,
            $yearSelected,
            $monthSelected
        );

        $elementScores = Answer::elementScores(
            $skm->id,
            $serviceSelected,
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


        return view(
            'admin.skm.detail',
            compact(
                'skm',
                'services',
                'respondentTotal',
                'elementScores',
                'scoreTotal',
                'skmQualityValue',
                'skmQualityLabel',
                'serviceSelectedName',
                'serviceSelected',
                'yearSelected',
                'monthSelected'
            )
        );
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
        $skm->delete();

        return redirect()
            ->back()
            ->with('toast', [
                'type' => 'success',
                'title' => 'Berhasil',
                'message' => 'Data berhasil dihapus',
            ]);
    }
}

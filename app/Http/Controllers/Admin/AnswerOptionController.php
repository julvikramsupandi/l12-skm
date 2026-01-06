<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AnswerOption;
use App\Models\OptionScale;
use Illuminate\Http\Request;

class AnswerOptionController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:answer.view')->only(['index', 'show']);
        $this->middleware('permission:answer.create')->only(['create', 'store']);
        $this->middleware('permission:answer.edit')->only(['edit', 'update']);
        $this->middleware('permission:answer.delete')->only(['destroy']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $answerOptions = AnswerOption::with('optionScale')->get();
        $optionScales = OptionScale::all();
        return view('admin.answer_option.index', compact('answerOptions', 'optionScales'));
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
            $request->validate([
                'label' => 'required|max:100',
                'score' => 'required',
            ]);

            AnswerOption::create([
                'option_scale_id' => $request->option_scale_id,
                'label' => $request->label,
                'score' => $request->score,
            ]);
        } catch (\Throwable $th) {

            return redirect()->back()->with('toast', [
                'type' => 'error',
                'title' => 'Gagal',
                'message' => 'Data gagal disimpan : ' . $th->getMessage(),
            ]);
        }

        return redirect()->back()
            ->with('toast', [
                'type' => 'success',
                'title' => 'Berhasil',
                'message' => 'Data berhasil disimpan',
            ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(AnswerOption $answerOption)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AnswerOption $answerOption)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AnswerOption $answerOption)
    {
        try {
            $request->validate([
                'label' => 'required|max:100',
                'score' => 'required',
            ]);


            $answerOption->update([
                'option_scale_id' => $request->option_scale_id,
                'label' => $request->label,
                'score' => $request->score,
            ]);
        } catch (\Throwable $th) {

            return redirect()->back()->with('toast', [
                'type' => 'error',
                'title' => 'Gagal',
                'message' => 'Data gagal diubah : ' . $th->getMessage(),
            ]);
        }

        return redirect()->back()
            ->with('toast', [
                'type' => 'success',
                'title' => 'Berhasil',
                'message' => 'Data berhasil diubah',
            ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AnswerOption $answerOption)
    {
        $answerOption->delete();

        return redirect()->back()
            ->with('toast', [
                'type' => 'success',
                'title' => 'Berhasil',
                'message' => 'Data berhasil dihapus',
            ]);
    }
}

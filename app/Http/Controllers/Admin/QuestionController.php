<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Models\Element;
use App\Models\OptionScale;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $elements = Element::all();
        $optionScales = OptionScale::all();
        $questions = Question::with('element')
            ->with('optionScale')
            ->get();

        return view('admin.question.index', compact('questions', 'optionScales', 'elements'));
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
                'question_code' => 'required|max:100',
                'question_text' => 'required|max:255',
                'service_channel' => 'required',
            ]);

            Question::create([
                'element_id' => $request->element_id,
                'option_scale_id' => $request->option_scale_id,
                'service_channel' => $request->service_channel,
                'question_code' => $request->question_code,
                'question_text' => $request->question_text,
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
    public function show(Question $question)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Question $question)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Question $question)
    {
        try {
            $request->validate([
                'question_code' => 'required|max:100',
                'question_text' => 'required|max:255',
                'service_channel' => 'required',
            ]);

            $question->update([
                'element_id' => $request->element_id,
                'option_scale_id' => $request->option_scale_id,
                'service_channel' => $request->service_channel,
                'question_code' => $request->question_code,
                'question_text' => $request->question_text,
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
    public function destroy(Question $question)
    {
        $question->delete();

        return redirect()->back()
            ->with('toast', [
                'type' => 'success',
                'title' => 'Berhasil',
                'message' => 'Data berhasil dihapus',
            ]);
    }
}

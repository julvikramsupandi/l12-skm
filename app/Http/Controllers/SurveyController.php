<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Feedback;
use App\Models\Question;
use App\Models\Service;
use App\Models\Skm;
use App\Models\Respondent;
use Illuminate\Http\Request;

use Inertia\Inertia;

class SurveyController extends Controller
{
    public function index()
    {
        $title = 'Organisasi Pemerintah Daerah';
        $skms = Skm::with('unor')
            ->get();

        return Inertia::render('Survey/SkmPage', [
            'title' => $title,
            'skms' => $skms,
        ]);
    }


    public function services($uuid)
    {

        $skm = Skm::with('unor')
            ->where('uuid', $uuid)
            ->first();

        if (!$skm) return abort(404);

        $skmId = $skm->id;
        $unorName = $skm->unor->name;

        $services = Service::where('skm_id', $skmId)
            ->where('is_active', true)
            ->get();

        return Inertia::render('Survey/ServicePage', [
            'title' => 'Layanan ' . $unorName,
            'uuid' => $uuid,
            'services' => $services,
            'skm' => $skm
        ]);
    }


    public function form($uuid, $serviceId)
    {
        $skm = Skm::with('unor')
            ->where('uuid', $uuid)
            ->first();

        $service = Service::find($serviceId);
        $serviceName = $service->name;
        $educations = Respondent::listEducation();
        $occupations = Respondent::listOccupation();
        $disabilityTypes = Respondent::listDisabilityType();

        return Inertia::render('Survey/FormPage', [
            'title' => 'Survei',
            'uuid' => $uuid,
            'serviceId' => $serviceId,
            'serviceName' => $serviceName,
            'educations' => $educations,
            'occupations' => $occupations,
            'disabilityTypes' => $disabilityTypes,
            'skm' => $skm
        ]);
    }

    public function store($uuid, $serviceId, Request $request)
    {

        $is_disability = $request->is_disability ? true : false;

        $validated = $request->validate([
            'survey_date'      => ['required', 'date'],
            'survey_time'      => ['required', 'string'],
            'respondent_name'  => ['nullable', 'string', 'max:255'],
            'age'              => ['nullable', 'integer', 'min:1'],
            'gender'           => ['required', 'in:L,P'],
            'education'        => ['required', 'string'],
            'occupation'       => ['required', 'string'],
            'is_disability'    => ['boolean'],
            'disability_type'  => $is_disability ? ['required', 'string'] : ['nullable', 'string'],
        ]);

        $respondent = Respondent::create([
            'service_id'       => $serviceId,
            'survey_date'      => $validated['survey_date'],
            'survey_time'      => $validated['survey_time'],
            'respondent_name'  => $validated['respondent_name'] ?? null,
            'age'              => $validated['age'] ?? null,
            'gender'           => $validated['gender'],
            'education'        => $validated['education'] ?? null,
            'occupation'       => $validated['occupation'] ?? null,
            'is_disability'    => $validated['is_disability'] ?? false,
            'disability_type'  => $validated['disability_type'] ?? null,
        ]);

        return redirect()
            ->route('survey.questionnaire', [
                'uuid' => $uuid,
                'serviceId' => $serviceId,
                'respondentUuid' => $respondent->uuid,
            ]);
    }

    public function questionnaire($uuid, $serviceId, $respondentUuid)
    {
        $skm = Skm::with('unor')
            ->where('uuid', $uuid)
            ->first();

        $respondent = Respondent::where('uuid', $respondentUuid)
            ->where('service_id', $serviceId)
            ->firstOrFail();

        $service = Service::find($serviceId);
        $serviceChannel = $service->service_channel;

        $questions = Question::with('optionScale.answerOptions')
            ->where('service_channel', $serviceChannel)
            ->get();

        return Inertia::render('Survey/QuestionnairePage', [
            'title' => 'Kuesioner',
            'skm' => $skm,
            'service' => $service,
            'respondent' => $respondent,
            'questions' => $questions,
        ]);
    }

    public function submit(Request $request)
    {
        foreach ($request->answers as $answer) {

            $respondent = Respondent::where('uuid', $answer['respondent_uuid'])
                ->first();
            $respondentId = $respondent->id;

            $questionId = $answer['question_id'];
            $answerOptionId = $answer['answer_option_id'];
            $score = $answer['score'];

            Answer::create([
                'question_id' => $questionId,
                'respondent_id' => $respondentId,
                'answer_option_id' => $answerOptionId,
                'score' => $score
            ]);
        }

        if ($request->feedback) {
            Feedback::create([
                'respondent_id' => $respondentId,
                'feedback' => $request->feedback
            ]);
        }

        return redirect()
            ->route('survey');
    }


    public function servicesv1($uuid)
    {
        return redirect()
            ->route('survey.services',  $uuid);
    }

    public function formv1($uuid, $serviceId)
    {
        return redirect()
            ->route('survey.form',  [$uuid, $serviceId]);
    }
}

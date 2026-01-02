<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use DB;

class Answer extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'answers';
    protected $guarded = ['id'];


    public static  function questionScores(
        ?int $skmId = null,
        ?int $serviceId = null,
        ?int $year = null,
        ?int $month = null
    ) {
        return DB::table('answers')
            ->join('questions', 'questions.id', '=', 'answers.question_id')
            ->join('elements', 'elements.id', '=', 'questions.element_id')
            ->join('respondents', 'respondents.id', '=', 'answers.respondent_id')
            ->join('services', 'services.id', '=', 'respondents.service_id')
            ->join('skm', 'skm.id', '=', 'services.skm_id')
            ->when($skmId, function ($query) use ($skmId) {
                $query->where('skm.id', $skmId);
            })
            ->when($serviceId, function ($query) use ($serviceId) {
                $query->where('services.id', $serviceId);
            })
            ->when($year, function ($query) use ($year) {
                $query->whereYear('answers.created_at', $year);
            })
            ->when($month, function ($query) use ($month) {
                $query->whereMonth('answers.created_at', $month);
            })
            ->where('questions.is_active', true)
            ->groupBy(
                'questions.id',
                'questions.question_text',
                'elements.code',
                'elements.name'
            )
            ->selectRaw('
                questions.id        AS question_id,
                questions.question_text  AS question_text,
                elements.code       AS element_code,
                elements.name       AS element_name,
                AVG(answers.score)  AS question_score
            ')
            ->orderBy('elements.code')
            ->orderBy('questions.id')
            ->get();
    }


    public static  function elementScores(
        ?int $skmId = null,
        ?int $serviceId = null,
        ?int $year = null,
        ?int $month = null
    ) {
        return collect(self::questionScores($skmId, $serviceId, $year, $month))
            ->groupBy('element_code')
            ->map(function ($questions) {

                $score = Skm::format(round(
                    $questions->avg('question_score'),
                    2
                ));

                return [
                    'element_code' => $questions->first()->element_code,
                    'element_name' => $questions->first()->element_name,
                    'element_score' => $score,
                    'element_quality_value' => Skm::skmQuality($score)['value'],
                    'element_quality_label' => Skm::skmQuality($score)['label'],
                ];
            })
            ->values();
    }


    public function question()
    {
        return $this->belongsTo(Question::class, 'question_id');
    }

    public function respondent()
    {
        return $this->belongsTo(Respondent::class, 'respondent_id');
    }

    public function AnswerOption()
    {
        return $this->belongsTo(AnswerOption::class, 'answer_option_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Answer extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded = ['id'];

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

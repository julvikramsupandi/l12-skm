<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OptionScale extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded = ['id'];

    public function answerOptions()
    {
        return $this->hasMany(AnswerOption::class, 'option_scale_id');
    }

    public function questions()
    {
        return $this->hasMany(Question::class, 'option_scale_id');
    }
}

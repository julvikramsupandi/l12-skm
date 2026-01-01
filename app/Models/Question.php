<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Question extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];


    public function element()
    {
        return $this->belongsTo(Element::class, 'element_id');
    }

    public function optionScale()
    {
        return $this->belongsTo(OptionScale::class, 'option_scale_id');
    }
}

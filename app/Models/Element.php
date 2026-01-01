<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Element extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded = ['id'];



    public function question()
    {
        return $this->hasMany(Question::class, 'element_id');
    }
}

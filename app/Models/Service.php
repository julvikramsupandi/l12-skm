<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Service extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];


    public function respondent()
    {
        return $this->hasMany(Respondent::class, 'service_id');
    }

    public function skm()
    {
        return $this->belongsTo(Skm::class, 'skm_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Unor extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    /**
     * Mengambil SKM yang terkait dengan Unor ini.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function skm()
    {
        return $this->hasMany(Skm::class, 'unor_id');
    }
}

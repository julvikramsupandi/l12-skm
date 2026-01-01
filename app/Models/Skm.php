<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Skm extends Model
{
    protected $table = 'skm';
    use HasFactory;
    protected $fillable = ['uuid', 'unor_id'];

    /**
     * Mengembalikan relasi belongsTo antara model ini dengan model Unor.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function unor()
    {
        return $this->belongsTo(Unor::class, 'unor_id');
    }

    public function services()
    {
        return $this->hasMany(Service::class, 'skm_id');
    }
}

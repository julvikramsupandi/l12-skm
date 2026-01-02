<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Respondent extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    protected static function booted()
    {
        static::creating(function ($model) {
            $model->uuid = (string) \Str::uuid();
        });
    }

    public static function countRespondent(
        ?int $skmId = null,
        ?int $serviceId = null,
        ?int $year = null,
        ?int $month = null
    ): int {
        return self::query()
            ->when($serviceId, function ($query) use ($serviceId) {
                $query->where('service_id', $serviceId);
            })

            ->when($skmId, function ($query) use ($skmId) {
                $query->whereHas('service.skm', function ($query) use ($skmId) {
                    $query->where('id', $skmId);
                });
            })

            ->when($year, function ($query) use ($year) {
                $query->whereYear('created_at', $year);
            })

            ->when($month, function ($query) use ($month) {
                $query->whereMonth('created_at', $month);
            })

            ->count();
    }

    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }
}

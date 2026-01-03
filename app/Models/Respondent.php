<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
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

    public static function baseQuery(
        ?int $skmId = null,
        ?int $serviceId = null,
        ?int $year = null,
        ?int $month = null
    ): Builder {
        return self::query()
            ->when(
                $serviceId,
                fn($q) =>
                $q->where('service_id', $serviceId)
            )
            ->when(
                $skmId,
                fn($q) =>
                $q->whereHas(
                    'service.skm',
                    fn($q) =>
                    $q->where('id', $skmId)
                )
            )
            ->when(
                $year,
                fn($q) =>
                $q->whereYear('created_at', $year)
            )
            ->when(
                $month,
                fn($q) =>
                $q->whereMonth('created_at', $month)
            );
    }

    public static function countRespondent(
        ?int $skmId = null,
        ?int $serviceId = null,
        ?int $year = null,
        ?int $month = null
    ): int {
        return self::baseQuery($skmId, $serviceId, $year, $month)->count();
    }

    public static function countBy(
        string $column,
        ?int $skmId = null,
        ?int $serviceId = null,
        ?int $year = null,
        ?int $month = null
    ): array {
        return self::baseQuery($skmId, $serviceId, $year, $month)
            ->select($column, \DB::raw('COUNT(*) as total'))
            ->groupBy($column)
            ->pluck('total', $column)
            ->all();
    }

    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }

    public function feedback()
    {
        return $this->hasMany(Feedback::class, 'respondent_id');
    }
}

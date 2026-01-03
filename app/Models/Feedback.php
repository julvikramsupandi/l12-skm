<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;
    protected $guarded = ['id'];


    public static function getFeedback(
        ?int $skmId = null,
        ?int $serviceId = null,
        ?int $year = null,
        ?int $month = null
    ) {
        return self::with('respondent')
            // ->with('respondent.service')
            ->when(
                $serviceId,
                fn($q) =>
                $q->whereHas(
                    'respondent',
                    fn($q) =>
                    $q->where('service_id', $serviceId)
                )
            )
            ->when(
                $skmId,
                fn($q) =>
                $q->whereHas(
                    'respondent.service.skm',
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
            )
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();
    }

    public function respondent()
    {
        return $this->belongsTo(Respondent::class, 'respondent_id');
    }
}

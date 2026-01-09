<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Skm extends Model
{
    protected $table = 'skm';
    use HasFactory;
    protected $fillable = ['uuid', 'unor_id'];
    // Ganti jadi 1 jika nilai SKALA 1 - 4
    // Ganti jadi 25 jika nilai SKALA 1 - 100
    protected const RANGE = 25;

    public static function format(float $score): float
    {
        return round($score * self::RANGE, 2);
    }


    public static function skmQuality(int $value): array
    {
        if (self::RANGE == 1) {
            return match (true) {
                $value >= 3.53 => [
                    'value' => 'A',
                    'label' => 'Sangat Baik'
                ],
                $value >= 3.06  => [
                    'value' => 'B',
                    'label' => 'Baik'
                ],
                $value >= 2.60  => [
                    'value' => 'C',
                    'label' => 'Kurang Baik'
                ],
                default         => [
                    'value' => 'D',
                    'label' => 'Tidak Baik'
                ],
            };
        } else {
            return match (true) {
                $value >= 88.31 => [
                    'value' => 'A',
                    'label' => 'Sangat Baik'
                ],
                $value >= 76.61 => [
                    'value' => 'B',
                    'label' => 'Baik'
                ],
                $value >= 65.00 => [
                    'value' => 'C',
                    'label' => 'Kurang Baik'
                ],
                default         => [
                    'value' => 'D',
                    'label' => 'Tidak Baik'
                ],
            };
        };
    }



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

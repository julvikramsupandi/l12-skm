<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Respondent extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];
    protected $appends = ['initials'];

    protected static function booted()
    {
        static::creating(function ($model) {
            $model->uuid = (string) \Str::uuid();
        });
    }

    public function getInitialsAttribute(): string
    {
        if (!$this->respondent_name) {
            return '';
        }

        return collect(preg_split('/\s+/', trim($this->respondent_name)))
            ->map(fn($word) => mb_strtoupper(mb_substr($word, 0, 1)))
            ->implode('');
    }

    protected function maskedName(): Attribute
    {
        return Attribute::make(
            get: fn() => collect(preg_split('/\s+/', trim($this->respondent_name)))
                ->map(function ($word) {
                    $length = mb_strlen($word);
                    if ($length <= 2) return $word;

                    return mb_substr($word, 0, 1)
                        . str_repeat('*', $length - 2)
                        . mb_substr($word, -1);
                })
                ->implode(' ')
        );
    }

    public static function baseQuery(
        ?int $skmId = null,
        ?int $serviceId = null,
        ?int $year = null,
        string|int|null $month = null
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
            ->when($month, function ($q) use ($month) {

                // Jika bulan numerik (1–12)
                if (is_numeric($month)) {
                    $q->whereMonth('created_at', (int) $month);
                }

                // Triwulan
                elseif (str_starts_with($month, 'TW')) {
                    match ($month) {
                        'TW1' => $q->whereMonth('created_at', [1, 2, 3]),
                        'TW2' => $q->whereMonth('created_at', [4, 5, 6]),
                        'TW3' => $q->whereMonth('created_at', [7, 8, 9]),
                        'TW4' => $q->whereMonth('created_at', [10, 11, 12]),
                    };
                }

                // Semester
                elseif (str_starts_with($month, 'S')) {
                    match ($month) {
                        'S1' => $q->whereMonth('created_at', [1, 2, 3, 4, 5, 6]),
                        'S2' => $q->whereMonth('created_at', [7, 8, 9, 10, 11, 12]),
                    };
                }
            });
    }

    public static function countRespondent(
        ?int $skmId = null,
        ?int $serviceId = null,
        ?int $year = null,
        string|int|null $month = null
    ): int {
        return self::baseQuery($skmId, $serviceId, $year, $month)->count();
    }

    public static function countRespondentByService(
        ?int $skmId = null,
        ?int $year = null,
        string|int|null $month = null
    ) {
        return self::baseQuery($skmId, null, $year, $month)
            ->select('service_id', DB::raw('COUNT(*) as total'))
            ->groupBy('service_id')
            ->pluck('total', 'service_id');
    }

    public static function countBy(
        string $column,
        ?int $skmId = null,
        ?int $serviceId = null,
        ?int $year = null,
        string|int|null $month = null
    ): array {
        return self::baseQuery($skmId, $serviceId, $year, $month)
            ->select($column, \DB::raw('COUNT(*) as total'))
            ->groupBy($column)
            ->pluck('total', $column)
            ->all();
    }

    public static function countByRespondent(
        ?int $skmId = null,
        ?int $serviceId = null,
        ?int $year = null,
        string|int|null $month = null
    ): int {
        return self::baseQuery($skmId, $serviceId, $year, $month)
            ->count();
    }


    public static function getRespondent(int $year)
    {
        return Self::select(
            DB::raw('MONTH(created_at) as month'),
            DB::raw('COUNT(*) as total')
        )
            ->whereYear('created_at', $year)
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->pluck('total', 'month');
    }


    public static function listEducation(): array
    {
        $educations = array(
            "Tidak sekolah",
            "SD/Sederajat",
            "SMP/Sederajat",
            "SMA/Sederajat",
            "D1/D2/D3",
            "D4/S1",
            "S2",
            "S3",
        );

        return $educations;
    }

    public static function listOccupation(): array
    {
        $occupations = array(
            "ASN",
            "TNI",
            "POLRI",
            "Swasta",
            "Wirausaha",
            "Pelajar/Mahasiswa",
            "Petani/Nelayan",
            "Pekerja Lepas/Freelance",
            "Pensiunan",
            "Lainnya"
        );

        return $occupations;
    }

    public static function listDisabilityType(): array
    {
        $disabilityTypes = array(
            "Disabilitas Fisik",
            "Disabilitas Intelektual",
            "Disabilitas Mental",
            "Disabilitas Sensorik"
        );

        return $disabilityTypes;
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

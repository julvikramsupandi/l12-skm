<?php

if (! function_exists('periodLabel')) {
    function periodLabel(?string $period): string
    {
        if (! $period) {
            return '';
        }

        // Triwulan
        if (preg_match('/^TW([1-4])$/', $period, $m)) {
            return 'Triwulan ' . $m[1];
        }

        // Semester
        if (preg_match('/^S([1-2])$/', $period, $m)) {
            return 'Semester ' . $m[1];
        }

        return $period; // fallback
    }
}

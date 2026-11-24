<?php

use Carbon\Carbon;

if (!function_exists('numberToRupiah')) {
    function numberToRupiah($angka): string
    {
        return 'Rp ' . number_format($angka, 0, ',', '.');
    }
}

if (!function_exists('rupiahToNumber')) {
    function rupiahToNumber(string $rp): int
    {
        return (int) preg_replace('/\D/', '', $rp);
    }
}

// 5 Januari 2027 (nama bulan berbahasa Indonesia tanpa mengubah APP_LOCALE)
if (!function_exists('formatTanggal')) {
    function formatTanggal($tanggal, string $format = 'd F Y'): string
    {
        return Carbon::parse($tanggal)->locale('id')->translatedFormat($format);
    }
}

// 07.30
if (!function_exists('formatJam')) {
    function formatJam($waktu): string
    {
        return Carbon::parse($waktu)->format('H.i');
    }
}
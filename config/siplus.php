<?php

return [
    'nama' => env('SIPLUS_NAMA', 'SIPLUS Vokasi'),

    // Kode rahasia untuk mendaftar sebagai pengelola (jangan dibiarkan kosong)
    'kode_pengelola' => env('SIPLUS_KODE_PENGELOLA'),

    // Jam layanan peminjaman: 0 = Minggu ... 6 = Sabtu (hari yang tidak ada = tutup)
    'jam_layanan' => [
        1 => ['07:00', '20:30'],
        2 => ['07:00', '20:30'],
        3 => ['07:00', '20:30'],
        4 => ['07:00', '20:30'],
        5 => ['07:00', '20:30'],
        6 => ['08:00', '15:00'],
    ],
];
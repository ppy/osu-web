<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'header' => [
        'title' => 'status',
        'description' => 'apa yang terjadi bung?',
    ],

    'incidents' => [
        'title' => 'Insiden Aktif',
        'automated' => 'otomatis',
    ],

    'online' => [
        'title' => [
            'users' => 'Pengguna yang Online dalam 24 Jam Terakhir',
            'score' => 'Pengiriman Skor dalam 24 Jam Terakhir',
        ],
        'current' => 'Pengguna sedang Online Saat Ini',
        'score' => 'Pengiriman Skor per Detik',
    ],

    'recent' => [
        'incidents' => [
            'title' => 'Insiden Terbaru',
            'state' => [
                'resolved' => 'Terselesaikan',
                'resolving' => 'Sedang Menyelesaikan',
                'unknown' => 'Tidak Diketahui',
            ],
        ],

        'uptime' => [
            'title' => 'Waktu Aktif',
            'graphs' => [
                'server' => 'server',
                'web' => 'web',
            ],
        ],

        'when' => [
            'today' => 'hari ini',
            'week' => 'minggu',
            'month' => 'bulan',
            'all_time' => 'sepanjang waktu',
            'last_week' => 'minggu lalu',
            'weeks_ago' => ':count minggu lalu',
        ],
    ],
];

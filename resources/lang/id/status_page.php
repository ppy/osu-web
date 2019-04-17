<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
 *
 *    This file is part of osu!web. osu!web is distributed with the hope of
 *    attracting more community contributions to the core ecosystem of osu!.
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License version 3
 *    as published by the Free Software Foundation.
 *
 *    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
 *    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *    See the GNU Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public License
 *    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
 */

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

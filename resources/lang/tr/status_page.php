<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'header' => [
        'title' => 'durum',
        'description' => 'neler oluyor kanki?',
    ],

    'incidents' => [
        'title' => 'Aktif Olaylar',
        'automated' => 'otomatik',
    ],

    'online' => [
        'title' => [
            'users' => 'Son 24 saatteki Online Kullanıcılar',
            'score' => 'Son 24 Saatteki Skorlar',
        ],
        'current' => 'Anlık Çevrimiçi Kullanıcılar',
        'score' => 'Saniye Başına Gönderilen Skor',
    ],

    'recent' => [
        'incidents' => [
            'title' => 'Son Olaylar',
            'state' => [
                'resolved' => 'Çözülmüş',
                'resolving' => 'Çözülüyor',
                'unknown' => 'Bilinmiyor',
            ],
        ],

        'uptime' => [
            'title' => 'Çalışma süresi',
            'graphs' => [
                'server' => 'sunucu',
                'web' => 'web',
            ],
        ],

        'when' => [
            'today' => 'bugün',
            'week' => 'hafta',
            'month' => 'ay',
            'all_time' => 'tüm zamanlar',
            'last_week' => 'geçen hafta',
            'weeks_ago' => ':count hafta önce|:count hafta önce',
        ],
    ],
];

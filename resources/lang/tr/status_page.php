<?php

/**
 *    Copyright 2015-2018 ppy Pty. Ltd.
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

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
    'index' => [
        'description' => 'Paket beatmap yang telah disusun atas satu tema tertentu.',
        'nav_title' => 'daftar',
        'title' => 'Paket Beatmap',

        'blurb' => [
            'important' => 'BACA INI SEBELUM MENGUNDUH',
            'instruction' => [
                '_' => "Pemasangan: Setelah paket beatmap diunduh, ekstrak .rar ke direktori osu! Songs.
                    Semua lagu masih dalam bentuk .zip dan/atau .osz di dalam paket, osu! akan mengekstrak beatmap dengan sendirinya saat Anda masuk ke mode Play.
                    :scary ekstrak zip/osz sendiri,
                    atau beatmap akan ditampilkan secara tidak benar di dalam osu! dan tidak akan berfungsi dengan baik.",
                'scary' => 'JANGAN',
            ],
            'note' => [
                '_' => 'Mohon diingat bahwa sangat disarankan bagi Anda untuk :scary, mengingat map-map yang berasal dari era yang lebih lama pada umumnya cenderung memiliki kualitas yang jauh lebih rendah daripada map-map yang berasal dari era yang lebih modern.',
                'scary' => 'mengunduh paket dari yang terbaru ke yang paling lama',
            ],
        ],
    ],

    'show' => [
        'download' => 'Unduh',
        'item' => [
            'cleared' => 'telah diselesaikan',
            'not_cleared' => 'belum diselesaikan',
        ],
    ],

    'mode' => [
        'artist' => 'Artis/Album',
        'chart' => 'Spotlights',
        'standard' => 'Standar',
        'theme' => 'Tema',
    ],

    'require_login' => [
        '_' => 'Anda harus :link untuk mengunduh',
        'link_text' => 'masuk',
    ],
];

<?php

/**
 *    Copyright 2015-2017 ppy Pty. Ltd.
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
        'small' => 'Bersaing dengan cara lain selain hanya mengklik lingkaran.',
        'large' => 'osu! Community Contests',
    ],
    'voting' => [
        'over' => 'Pemungutan suara untuk kontes ini telah berakhir',
        'login_required' => 'Silakan masuk untuk memilih.',
        'best_of' => [
            'none_played' => 'Anda tidak terlihat memainkan beatmaps yang memenuhi syarat kontes ini!',
        ],
    ],
    'entry' => [
        '_' => 'entri',
        'login_required' => 'Silakan masuk untuk mengikuti kontes.',
        'silenced_or_restricted' => 'Anda tidak dapat mengikuti kontes saat sedang dibatasi atau dibungkam.',
        'preparation' => 'Kami sedang mempersiapkan kontes ini. Harap tunggu dengan sabar!',
        'over' => 'Terima kasih telah mengirimkan entri anda! Namun pengiriman untuk kontes ini telah ditutup and pemungutan suara akan segera dibuka.',
        'limit_reached' => 'Anda telah mencapai batas entri untuk kontes ini',
        'drop_here' => 'Letakkan entri anda disini',
        'wrong_type' => [
            'art' => 'Hanya format file .jpg dan .png yang diterima di kontes ini',
            'beatmap' => 'Hanya format file .osu files yang diterima di kontes ini',
            'music' => 'Hanya format file .mp3 files yang diterima di kontes ini',
        ],
        'too_big' => 'Entri untuk kontes ini hanya dapat menampung sebanyak :limit.',
    ],
    'beatmaps' => [
        'download' => 'Unduh Entri',
    ],
    'vote' => [
        'list' => 'suara',
        'count' => '1 suara|:count suara',
    ],
    'dates' => [
        'ended' => 'Selesai :date',

        'starts' => [
            '_' => 'Mulai :date',
            'soon' => 'segera™',
        ],
    ],
    'states' => [
        'entry' => 'Pendaftaran Dibuka',
        'voting' => 'Pemungutan Suara Dimulai',
        'results' => 'Hasil',
    ],
];

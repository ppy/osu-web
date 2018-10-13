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
        'small' => 'Karena sesungguhnya persaingan tidak hanya terjadi di dalam lapangan permainan.',
        'large' => 'Turnamen Komunitas',
    ],
    'voting' => [
        'over' => 'Pemungutan suara untuk kontes ini telah berakhir',
        'login_required' => 'Silakan masuk untuk memberikan suara.',
        'best_of' => [
            'none_played' => "Tampaknya Anda belum pernah memainkan map-map yang tercatat diikutsertakan dalam kontes ini!",
        ],
    ],
    'entry' => [
        '_' => 'entri',
        'login_required' => 'Silakan masuk untuk mengikuti kontes.',
        'silenced_or_restricted' => 'Anda tidak dapat mengikuti kontes saat akun sedang dibatasi atau dibungkam.',
        'preparation' => 'Kami sedang mempersiapkan kontes ini. Harap tunggu dengan sabar!',
        'over' => 'Terima kasih telah mengirimkan entri Anda! Meskipun demikian, dengan sangat menyesal kami harus memberi tahu Anda bahwa tahapan penyerahan entri untuk kontes ini telah berakhir. Mohon maaf sebelumnya!',
        'limit_reached' => 'Anda telah mencapai batas entri untuk kontes ini',
        'drop_here' => 'Letakkan entri Anda di sini',
        'wrong_type' => [
            'art' => 'Hanya file-file dengan format .jpg dan .png yang diterima di kontes ini',
            'beatmap' => 'Hanya file-file dengan format .osu yang diterima di kontes ini',
            'music' => 'Hanya file-file dengan format .mp3 yang diterima di kontes ini',
        ],
        'too_big' => 'Entri untuk kontes ini hanya dapat menampung sebanyak :limit.',
    ],
    'beatmaps' => [
        'download' => 'Unduh Entri',
    ],
    'vote' => [
        'list' => 'suara',
        'count' => ':count suara',
    ],
    'dates' => [
        'ended' => 'Selesai :date',

        'starts' => [
            '_' => 'Mulai :date',
            'soon' => 'segera™',
        ],
    ],
    'states' => [
        'entry' => 'Menerima Entri',
        'voting' => 'Dalam Tahapan Pemungutan Suara',
        'results' => 'Selesai Dilaksanakan',
    ],
];

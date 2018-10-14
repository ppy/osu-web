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
    'feed_title' => 'umpan',
    'generic' => 'Perbaikan bug dan perkembangan kecil',

    'build' => [
        'title' => 'terjadi perubahan di :version',
    ],

    'builds' => [
        'users_online' => ':count_delimited pengguna online',
    ],

    'entry' => [
        'by' => 'oleh :user',
    ],

    'index' => [
        'page_title' => [
            '_' => 'daftar riwayat perubahan',
            '_from' => 'terjadi perubahan sejak :from',
            '_from_to' => 'terjadi perubahan antara :from dan :to',
            '_stream' => 'terjadi perubahan dalam :stream',
            '_stream_from' => 'terjadi perubahan dalam :stream sejak :from',
            '_stream_from_to' => 'terjadi perubahan dalam :stream antara :from dan :to',
            '_stream_to' => 'terjadi perubahan dalam :stream hingga :to',
            '_to' => 'terjadi perubahan hingga :to',
        ],

        'title' => [
            '_' => ':info Riwayat Perubahan',
            'info' => 'Daftar',
        ],
    ],

    'support' => [
        'heading' => 'Menyukai pembaruan ini?',
        'text_1' => 'Dukung pengembangan osu! lebih lanjut dan :link hari ini!',
        'text_1_link' => 'jadilah supporter',
        'text_2' => 'Anda tidak hanya membantu mempercepat pengembangan, tetapi Anda juga akan mendapatkan beberapa fitur tambahan dan kustomisasi!',
    ],
];

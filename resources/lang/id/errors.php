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
    'codes' => [
        'http-401' => 'Mohon masuk untuk melanjutkan.',
        'http-403' => 'Akses ditolak.',
        'http-404' => 'Tidak ditemukan.',
        'http-429' => 'Terlalu banyak percobaan. Coba lagi nanti.',
    ],
    'account' => [
        'profile-order' => [
            'generic' => 'Terjadi masalah. Cobalah untuk memuat ulang laman.',
        ],
    ],
    'beatmaps' => [
        'invalid_mode' => 'Mode tidak valid.',
        'standard_converts_only' => 'Tidak ada skor yang tersedia untuk mode yang diminta pada beatmap dengan tingkat kesulitan ini.',
    ],
    'checkout' => [
        'generic' => 'Terjadi kesalahan ketika akan melangsungkan proses check-out.',
    ],
    'search' => [
        'default' => 'Hasil tidak ditemukan, coba lagi nanti.',
        'operation_timeout_exception' => 'Aktivitas pencarian saat ini lebih sibuk dari biasanya, coba lagi nanti.',
    ],

    'logged_out' => 'Anda telah keluar. Mohon masuk dan coba lagi.',
    'supporter_only' => 'Anda harus menjadi supporter untuk menggunakan fitur ini.',
    'no_restricted_access' => 'Anda tidak dapat melakukan tindakan ini saat akun Anda sedang dibatasi.',
    'unknown' => 'Terjadi kesalahan yang tidak diketahui.',
];

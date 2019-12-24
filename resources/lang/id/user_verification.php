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
    'box' => [
        'sent' => 'Kode verifikasi telah dikirim ke :mail. Masukkan kode verifikasi yang diterima.',
        'title' => 'Verifikasi Akun',
        'verifying' => 'Memverifikasi...',
        'issuing' => 'Meminta kode baru...',

        'info' => [
            'check_spam' => "Pastikan untuk memeriksa folder spam Anda jika Anda tidak dapat menemukan emailnya.",
            'recover' => "Jika Anda tidak dapat mengakses email Anda atau tidak ingat alamat email yang Anda gunakan untuk mendaftarkan akun osu! Anda, silahkan ikuti :link.",
            'recover_link' => 'proses pemulihan email di sini',
            'reissue' => 'Anda juga dapat :reissue_link atau :logout_link.',
            'reissue_link' => 'meminta kode baru',
            'logout_link' => 'keluar',
        ],
    ],

    'errors' => [
        'expired' => 'Kode verifikasi telah kedaluwarsa, email verifikasi baru telah dikirim.',
        'incorrect_key' => 'Kode verifikasi salah.',
        'retries_exceeded' => 'Kode verifikasi salah. Batas percobaan terlampaui, email verifikasi baru telah dikirim.',
        'reissued' => 'Kode verifikasi diperbarui, email verifikasi baru telah dikirim.',
        'unknown' => 'Terjadi masalah yang tidak diketahui, email verifikasi baru telah dikirim.',
    ],
];

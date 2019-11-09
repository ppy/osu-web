<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
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

    'email' => [
        'subject' => 'verifikasi akun osu!',
    ],

    'errors' => [
        'expired' => 'Kode verifikasi telah kedaluwarsa, email verifikasi baru telah dikirim.',
        'incorrect_key' => 'Kode verifikasi salah.',
        'retries_exceeded' => 'Kode verifikasi salah. Batas percobaan terlampaui, email verifikasi baru telah dikirim.',
        'reissued' => 'Kode verifikasi diperbarui, email verifikasi baru telah dikirim.',
        'unknown' => 'Terjadi masalah yang tidak diketahui, email verifikasi baru telah dikirim.',
    ],
];

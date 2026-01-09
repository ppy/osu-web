<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'box' => [
        'sent' => 'Kode verifikasi telah dikirim ke :mail. Masukkan kode verifikasi yang diterima.',
        'title' => 'Verifikasi Akun',
        'verifying' => 'Memverifikasi...',
        'issuing' => 'Meminta kode baru...',

        'info' => [
            'check_spam' => "Pastikan untuk memeriksa folder spam apabila kamu tidak menemukan email yang dimaksud.",
            'recover' => "Apabila kamu tidak dapat mengakses emailmu atau sudah tidak lagi ingat alamat email yang kamu gunakan untuk mendaftar, silakan ikuti :link.",
            'recover_link' => 'proses pemulihan email berikut',
            'reissue' => 'Kamu juga dapat :reissue_link atau :logout_link.',
            'reissue_link' => 'meminta kode baru',
            'logout_link' => 'keluar dari akun',
        ],
    ],

    'box_totp' => [
        'heading' => 'Silakan masukkan kode yang diterima dari aplikasi autentikator yang kamu gunakan.',

        'info' => [
            'logout' => [
                '_' => 'Kamu juga dapat :link.',
                'link' => 'keluar dari akun',
            ],
            'mail_fallback' => [
                '_' => 'Apabila kamu tidak dapat mengakses aplikasimu, :link.',
                'link' => 'kamu dapat memverifikasi akun kamu melalui email sebagai gantinya',
            ],
        ],
    ],

    'errors' => [
        'expired' => 'Kode verifikasi telah kedaluwarsa, email verifikasi baru telah dikirim.',
        'incorrect_key' => 'Kode verifikasi salah.',
        'retries_exceeded' => 'Kode verifikasi salah. Batas percobaan terlampaui, email verifikasi baru telah dikirim.',
        'reissued' => 'Kode verifikasi diperbarui, email verifikasi baru telah dikirim.',
        'totp_used_key' => 'Kode verifikasi telah digunakan. Silakan tunggu dan gunakan kode verifikasi yang baru.',
        'totp_gone' => 'Token autentikasi telah dihapus. Beralih ke email verifikasi. Email verifikasi telah dikirim.',
        'unknown' => 'Terjadi masalah yang tidak diketahui, email verifikasi baru telah dikirim.',
    ],
];

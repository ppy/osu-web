<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'box' => [
        'sent' => 'Kode verifikasi sudah dikirim ke :mail. Masukkan kode verifikasi yang diterima.',
        'title' => 'Verifikasi Akun',
        'verifying' => 'Memverifikasi...',
        'issuing' => 'Meminta kode baru...',

        'info' => [
            'check_spam' => "Pastikan untuk memeriksa folder spam apabila kamu tidak menemukan email ini.",
            'recover' => "Apabila kamu tidak bisa mengakses emailmu atau sudah tidak ingat alamat email yang kamu gunakan, silakan ikuti :link.",
            'recover_link' => 'proses pemulihan email berikut',
            'reissue' => 'Kamu juga bisa :reissue_link atau :logout_link.',
            'reissue_link' => 'meminta kode baru',
            'logout_link' => 'keluar dari akun',
        ],
    ],

    'box_totp' => [
        'heading' => 'Silakan masukkan kode yang diterima dari aplikasi autentikator yang kamu gunakan.',

        'info' => [
            'logout' => [
                '_' => 'Kamu juga bisa :link.',
                'link' => 'keluar dari akun',
            ],
            'mail_fallback' => [
                '_' => 'Apabila kamu tidak bisa mengakses aplikasimu, :link.',
                'link' => 'kamu bisa memverifikasi akun kamu melalui email sebagai gantinya',
            ],
        ],
    ],

    'errors' => [
        'expired' => 'Kode verifikasi sudah kedaluwarsa. Email verifikasi baru sudah dikirim.',
        'incorrect_key' => 'Kode verifikasi salah.',
        'retries_exceeded' => 'Kode verifikasi salah. Batas percobaan ulang terlampaui, dan email verifikasi baru sudah dikirim.',
        'reissued' => 'Kode verifikasi sudah dilansir ulang. Email verifikasi baru sudah dikirim.',
        'totp_used_key' => 'Kode verifikasi sudah digunakan. Silakan tunggu dan gunakan kode yang baru.',
        'totp_gone' => 'Token autentikasi sudah dihapus. Beralih ke verifikasi via email. Email verifikasi sudah dikirim.',
        'unknown' => 'Terjadi masalah yang tidak diketahui. Email verifikasi baru sudah dikirim.',
    ],
];

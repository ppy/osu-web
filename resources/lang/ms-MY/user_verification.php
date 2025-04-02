<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'box' => [
        'sent' => 'Sebuah emel telah dihantar ke :mail dengan kod pengesahan. Masukkan kod tersebut.',
        'title' => 'Pengesahan Akaun',
        'verifying' => 'Mengesahkan...',
        'issuing' => 'Mengeluarkan kod baharu...',

        'info' => [
            'check_spam' => "Pastikan anda menyemak folder spam sekiranya anda tidak boleh mencari e-mel tersebut.",
            'recover' => "Sekiranya anda tidak boleh mencapai e-mel anda atau telah terlupa emel yang digunakan, sila ikut :link.",
            'recover_link' => 'proses pemulihan e-mel di sini',
            'reissue' => 'Anda boleh juga :reissue_link atau :logout_link.',
            'reissue_link' => 'minta kod baharu',
            'logout_link' => 'daftar keluar',
        ],
    ],

    'errors' => [
        'expired' => 'Kod pengesahan luput, e-mel pengesahan baharu dikirim.',
        'incorrect_key' => 'Kod pengesahan tidak betul.',
        'retries_exceeded' => 'Kod pengesahan tidak betul. Cubaan lagi melebihi had, e-mel pengesahan baharu dihantar.',
        'reissued' => 'Kod pengesahan diterbitkan semula, e-mel pengesahan baharu dihantar.',
        'unknown' => 'Masalah tidak diketahui berlaku, e-mel pengesahan baharu dihantar.',
    ],
];

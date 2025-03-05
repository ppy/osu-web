<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'box' => [
        'sent' => 'Sebuah emel telah dihantar ke :mail dengan kod pengesahan. Masukkan kod itu.',
        'title' => 'Pengesahan Akaun',
        'verifying' => 'Mengesahkan...',
        'issuing' => 'Mengeluarkan kod baharu...',

        'info' => [
            'check_spam' => "Pastikan anda menyemak folder spam sekiranya anda tidak boleh mencari emel tersebut.",
            'recover' => "Sekiranya anda tidak boleh mencapai emel anda atau telah terlupa emel yang digunakan, sila ikut :link.",
            'recover_link' => 'proses pemulihan emel di sini',
            'reissue' => 'Anda boleh juga :reissue_link atau :logout_link.',
            'reissue_link' => 'minta kod baharu',
            'logout_link' => 'daftar keluar',
        ],
    ],

    'errors' => [
        'expired' => 'Kod pengesahan luput, emel pengesahan baharu dikirim.',
        'incorrect_key' => 'Kod pengesahan tidak betul.',
        'retries_exceeded' => 'Kod pengesahan tidak betul. Cubaan lagi melebihi had, emel pengesahan baharu dihantar.',
        'reissued' => 'Kod pengesahan dikeluarkan semula, emel pengesahan baharu dihantar.',
        'unknown' => 'Masalah tak diketahui berlaku, emel pengesahan baharu dihantar.',
    ],
];

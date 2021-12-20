<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'error' => [
        'chat' => [
            'empty' => 'Tidak dapat mengirim pesan kosong.',
            'limit_exceeded' => 'Anda mengirim pesan terlalu cepat, harap tunggu sebentar sebelum mencoba lagi.',
            'too_long' => 'Pesan yang hendak Anda kirim terlalu panjang.',
        ],
    ],

    'scopes' => [
        'bot' => 'Bertindak selaku chat bot.',
        'identify' => 'Mengenali diri Anda dan membaca profil publik Anda.',

        'chat' => [
            'write' => 'Mengirimkan pesan-pesan atas nama akun Anda.',
        ],

        'forum' => [
            'write' => 'Membuat dan menyunting postingan forum atas nama akun Anda.',
        ],

        'friends' => [
            'read' => 'Melihat siapa saja yang Anda ikuti.',
        ],

        'public' => 'Membaca data-data yang bersifat publik atas nama akun Anda.',
    ],
];

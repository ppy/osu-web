<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'error' => [
        'chat' => [
            'empty' => 'Tidak dapat mengirim pesan kosong.',
            'limit_exceeded' => 'Anda mengirim pesan terlalu cepat, harap tunggu sebentar sebelum mencoba lagi.',
            'too_long' => 'Pesan yang ingin dikirim terlalu panjang.',
        ],
    ],

    'scopes' => [
        'bot' => 'Bertindak selaku chat bot.',
        'identify' => 'Mengenali dirimu dan membaca profil publik milikmu.',

        'chat' => [
            'write' => 'Mengirim pesan atas nama akunmu.',
        ],

        'forum' => [
            'write' => 'Membuat dan menyunting topik forum serta postingan forum atas nama akunmu.',
        ],

        'friends' => [
            'read' => 'Melihat siapa saja yang kamu ikuti.',
        ],

        'public' => 'Membaca data yang bersifat publik atas nama akunmu.',
    ],
];

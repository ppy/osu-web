<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'error' => [
        'chat' => [
            'empty' => 'Tidak dapat mengirim pesan kosong.',
            'limit_exceeded' => 'Kamu mengirim pesan terlalu cepat. Silakan tunggu beberapa saat sebelum mencoba lagi.',
            'too_long' => 'Pesan yang ingin kamu kirim terlalu panjang.',
        ],
    ],

    'scopes' => [
        'bot' => 'Bertindak selaku chat bot.',
        'identify' => 'Mengenali dirimu dan membaca profil publik milikmu.',

        'chat' => [
            'read' => 'Membaca pesan atas nama akunmu.',
            'write' => 'Mengirim pesan atas nama akunmu.',
            'write_manage' => 'Membawa akunmu untuk masuk dan keluar dari kanal percakapan.',
        ],

        'forum' => [
            'write' => 'Membuat dan menyunting topik forum serta postingan forum atas nama akunmu.',
            'write_manage' => '',
        ],

        'friends' => [
            'read' => 'Melihat siapa saja yang kamu ikuti.',
        ],

        'public' => 'Membaca data yang bersifat publik atas nama akunmu.',
    ],
];

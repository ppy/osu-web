<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'error' => [
        'chat' => [
            'empty' => 'Tidak dapat mengirim pesanan kosong.',
            'limit_exceeded' => 'Kamu mengirim pesanan terlalu cepat, sila tunggu sebentar sebelum mencubanya lagi.',
            'too_long' => 'Pesanan yang ingin dikirim terlalu panjang.',
        ],
    ],

    'scopes' => [
        'bot' => 'Bertindak selaku bot bual.',
        'identify' => 'Mengenali dirimu dan membaca profil awam milik kamu.',

        'chat' => [
            'write' => 'Mengirim pesan atas nama akaun kamu.',
        ],

        'forum' => [
            'write' => 'Membuat dan menyunting topik forum serta kiriman forum atas nama akaun kamu.',
        ],

        'friends' => [
            'read' => 'Melihat siapa saja yang kamu ikuti.',
        ],

        'public' => 'Membaca data yang bersifat awam atas nama akaun kamu.',
    ],
];

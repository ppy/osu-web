<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'error' => [
        'chat' => [
            'empty' => 'Pesanan kosong tidak boleh dikirim.',
            'limit_exceeded' => 'Anda terlalu cepat mengirim pesanan, sila cuba lagi selepas menunggu sebentar.',
            'too_long' => 'Pesanan yang dicuba kirim terlalu panjang.',
        ],
    ],

    'scopes' => [
        'bot' => 'Bertindak selaku bot perbualan.',
        'identify' => 'Mengenali dan membaca profil awam anda.',

        'chat' => [
            'read' => 'Baca pesanan untuk pihak anda.',
            'write' => 'Kirim pesanan untuk pihak anda.',
            'write_manage' => 'Memasuki dan meninggalkan saluran untuk pihak anda.',
        ],

        'forum' => [
            'write' => 'Mencipta dan menyunting tajuk dan hantaran forum untuk pihak anda.',
            'write_manage' => '',
        ],

        'friends' => [
            'read' => 'Melihat ikutan anda.',
        ],

        'public' => 'Membaca data awam untuk pihak anda.',
    ],
];

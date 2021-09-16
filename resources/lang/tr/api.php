<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'error' => [
        'chat' => [
            'empty' => 'Boş mesaj gönderilemez.',
            'limit_exceeded' => 'Çok hızlı mesaj gönderiyorsunuz, tekrar göndermeden önce lütfen biraz bekleyin.',
            'too_long' => 'Göndermeye çalıştığınız mesaj çok uzun.',
        ],
    ],

    'scopes' => [
        'bot' => 'Bir sohbet botu gibi davran.',
        'identify' => 'Kim olduğunuzu ve herkese açık profilinizi görüntüleyebilir.',

        'chat' => [
            'write' => 'Sizin adınıza mesaj gönderebilir.',
        ],

        'forum' => [
            'write' => 'Sizin adınıza forum konuları ve gönderileri oluşturabilir ve düzenleyebilir.',
        ],

        'friends' => [
            'read' => 'Kimi takip ettiğinizi görebilir.',
        ],

        'public' => 'Herkese açık verilerinizi sizin adınıza okuyabilir.',
    ],
];

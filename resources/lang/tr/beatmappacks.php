<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'index' => [
        'description' => 'Benzer bir tema etrafında toplanmış, önceden paketlenmiş beatmap paketleri.',
        'nav_title' => 'katalog',
        'title' => 'Beatmap Paketleri',

        'blurb' => [
            'important' => 'İNDİRMEDEN ÖNCE OKUYUN',
            'install_instruction' => '',
            'note' => [
                '_' => 'Ayrıca :scary tavsiye edilir, zira eski haritalar en yeni haritalara kıyasla çok daha düşük kalitededir.',
                'scary' => 'paketleri en yeniden en eskiye doğru indirmeniz',
            ],
        ],
    ],

    'show' => [
        'download' => 'İndir',
        'item' => [
            'cleared' => 'geçildi',
            'not_cleared' => 'geçilmedi',
        ],
        'no_diff_reduction' => [
            '_' => ':link bu paketi tamamlamak için kullanılamaz.',
            'link' => 'Zorluk düşürme modları',
        ],
    ],

    'mode' => [
        'artist' => 'Sanatçı/Albüm',
        'chart' => 'Öne Çıkanlar',
        'standard' => 'Standart',
        'theme' => 'Tema',
    ],

    'require_login' => [
        '_' => 'İndirmek için :link olmanız lazım',
        'link_text' => 'giriş yapmış',
    ],
];

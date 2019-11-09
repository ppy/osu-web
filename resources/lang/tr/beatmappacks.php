<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
 */

return [
    'index' => [
        'blurb' => [
            'important' => 'İNDİRMEDEN ÖNCE OKUYUN',
            'instruction' => [
                '_' => "Kurulum: Bir paketi indirdikten sonra, .rar dosyasını osu!'nun Songs klasörüne çıkartın.                 Bütün şarkılar hala ya .zip ya da .osz halinde, o yüzden osu! bir sonraki Play moduna girdiğinizde beatmaplerin kendilerini çıkartması gerekecek.                    .zip/.osz dosyalarını kendiniz :scary,                    yoksa beatmapler osu!'da yanlış gözükür ve düzgün çalışmazlar.",
                'scary' => 'ÇIKARTMAYIN',
            ],
            'note' => [
                '_' => 'Ayrıca :scary tavsiye edilir, zira eski haritalar en yeni haritalara kıyasla çok daha düşük kalitededir.',
                'scary' => 'paketleri en yeniden en eskiye doğru indirmeniz',
            ],
        ],
        'title' => 'Beatmap Paketleri',
        'description' => 'Benzer bir tema etrafında toplanmış, önceden paketlenmiş beatmap paketleri.',
    ],

    'show' => [
        'back' => '',
        'download' => 'İndir',
        'item' => [
            'cleared' => 'geçildi',
            'not_cleared' => 'geçilmedi',
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

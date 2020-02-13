<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
 *
 *    This file is part of osu!web. osu!web is distributed with the hope of
 *    attracting more community contributions to the core ecosystem of osu!.
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License version 3
 *    as published by the Free Software Foundation.
 *
 *    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
 *    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *    See the GNU Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public License
 *    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
 */

return [
    'index' => [
        'description' => 'Benzer bir tema etrafında toplanmış, önceden paketlenmiş beatmap paketleri.',
        'nav_title' => 'liste',
        'title' => 'Beatmap Paketleri',

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
    ],

    'show' => [
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

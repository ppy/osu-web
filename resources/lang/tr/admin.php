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
    'beatmapsets' => [
        'covers' => [
            'regenerate' => 'Yeniden oluştur',
            'regenerating' => 'Yeniden oluşturuluyor...',
            'remove' => 'Kaldır',
            'removing' => 'Kaldırılıyor...',
            'title' => 'Uyarlanmış beatmapsetler',
        ],
        'show' => [
            'covers' => 'Beatmap Seti Kapaklarını Yönet',
            'discussion' => [
                '_' => 'Modlama v2',
                'activate' => 'aktifleştir',
                'activate_confirm' => 'bu beatmap için modlama v2 aktifleştirilsin mi?',
                'active' => 'aktif',
                'inactive' => 'inaktif',
            ],
        ],
    ],

    'forum' => [
        'forum-covers' => [
            'index' => [
                'delete' => 'Sil',

                'forum-name' => 'Forum #:id: :name',

                'no-cover' => 'Kapak seçilmedi',

                'submit' => [
                    'save' => 'Kaydet',
                    'update' => 'Güncelle',
                ],

                'title' => 'Forum Kapakları Listesi',

                'type-title' => [
                    'default-topic' => 'Varsayılan Konu Kapağı',
                    'main' => 'Forum Kapağı',
                ],
            ],
        ],
    ],

    'logs' => [
        'index' => [
            'title' => 'Günlük Görüntüleyici',
        ],
    ],

    'pages' => [
        'root' => [
            'sections' => [
                'beatmapsets' => 'Beatmapsets',
                'forum' => 'Forum',
                'general' => 'Genel',
                'store' => 'Mağaza',
            ],
        ],
    ],

    'store' => [
        'orders' => [
            'index' => [
                'title' => 'Sipariş Listesi',
            ],
        ],
    ],

    'users' => [
        'restricted_banner' => [
            'title' => 'Bu kullanıcı şu anda kısıtlanmış.',
            'message' => '(sadece yöneticiler bunu görebilir)',
        ],
    ],

];

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
            'regenerate' => 'Obnovit',
            'regenerating' => 'Obnovování...',
            'remove' => 'Odebrat',
            'removing' => 'Odebírání...',
            'title' => '',
        ],
        'show' => [
            'covers' => 'Spravovat Přebaly Mapsetu',
            'discussion' => [
                '_' => 'Modding v2',
                'activate' => 'aktivovat',
                'activate_confirm' => 'aktivovat modding v2 pro tuto beatmapu?',
                'active' => 'aktivní',
                'inactive' => 'neakitvní',
            ],
        ],
    ],

    'forum' => [
        'forum-covers' => [
            'index' => [
                'delete' => 'Smazat',

                'forum-name' => 'Fórum #:id: :name',

                'no-cover' => 'Žádný přebal nenastaven',

                'submit' => [
                    'save' => 'Uložit',
                    'update' => 'Aktualizovat',
                ],

                'title' => 'Seznam Přebalů fór',

                'type-title' => [
                    'default-topic' => 'Výchozí Přebal Tématu',
                    'main' => 'Přebal fóra',
                ],
            ],
        ],
    ],

    'logs' => [
        'index' => [
            'title' => 'Prohlížeč záznamů',
        ],
    ],

    'pages' => [
        'root' => [
            'sections' => [
                'beatmapsets' => '',
                'forum' => 'Fórum',
                'general' => 'Obecné',
                'store' => 'Obchod',
            ],
        ],
    ],

    'store' => [
        'orders' => [
            'index' => [
                'title' => 'Seznam objednávek',
            ],
        ],
    ],

    'users' => [
        'restricted_banner' => [
            'title' => 'Tento uživatel je momentálně omezen.',
            'message' => '(toto vidí pouze administrátoři)',
        ],
    ],

];

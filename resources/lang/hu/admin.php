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
            'regenerate' => 'Újragenerálni',
            'regenerating' => 'Újragenerálás...',
            'remove' => 'Eltávolítás',
            'removing' => 'Eltávolítás...',
            'title' => '',
        ],
        'show' => [
            'covers' => 'Beatmap fejlécek kezelése',
            'discussion' => [
                '_' => 'Modding v2',
                'activate' => 'aktiválás',
                'activate_confirm' => 'aktiválod a modding v2-t erre a beatmap-re?',
                'active' => 'aktív',
                'inactive' => 'inaktív',
            ],
        ],
    ],

    'forum' => [
        'forum-covers' => [
            'index' => [
                'delete' => 'Törlés',

                'forum-name' => 'Fórum #:id: :name',

                'no-cover' => 'Nincs fejléc beállítva',

                'submit' => [
                    'save' => 'Mentés',
                    'update' => 'Frissítés',
                ],

                'title' => 'Fórum fejléc lista',

                'type-title' => [
                    'default-topic' => 'Alapértelmezett téma fejléc',
                    'main' => 'Fórum fejléc',
                ],
            ],
        ],
    ],

    'logs' => [
        'index' => [
            'title' => 'Naplófájl-megjelenítő',
        ],
    ],

    'pages' => [
        'root' => [
            'sections' => [
                'beatmapsets' => '',
                'forum' => 'Fórum',
                'general' => 'Általános',
                'store' => 'Bolt',
            ],
        ],
    ],

    'store' => [
        'orders' => [
            'index' => [
                'title' => 'Kosár',
            ],
        ],
    ],

    'users' => [
        'restricted_banner' => [
            'title' => 'Ez a felhasználó jelenleg fel van függesztve.',
            'message' => '(ezt csak adminok láthatják)',
        ],
    ],

];

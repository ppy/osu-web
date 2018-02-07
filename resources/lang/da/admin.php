<?php

/**
 *    Copyright 2015-2017 ppy Pty. Ltd.
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
            'regenerate' => 'Regenerer',
            'regenerating' => 'Regenererer...',
            'remove' => 'Fjern',
            'removing' => 'Fjerner...',
        ],
        'show' => [
            'covers' => 'Administrer Beatmapset Covers',
            'discussion' => [
                '_' => 'Modding v2',
                'activate' => 'aktiver',
                'activate_confirm' => 'aktiver modding v2 for denne beatmap?',
                'active' => 'aktiv',
                'inactive' => 'inaktiv',
            ],
        ],
    ],

    'forum' => [
        'forum-covers' => [
            'index' => [
                'delete' => 'Fjern',

                'forum-name' => 'Forum #:id: :name',

                'no-cover' => 'Intet cover set',

                'submit' => [
                    'save' => 'Gem',
                    'update' => 'Opdater',
                ],

                'title' => 'Forum Covers Liste',

                'type-title' => [
                    'default-topic' => 'Standard Topic Cover',
                    'main' => 'Forum Cover',
                ],
            ],
        ],
    ],

    'logs' => [
        'index' => [
            'title' => 'Logbog',
        ],
    ],

    'pages' => [
        'root' => [
            'title' => 'Administrator Konsol Tingest',

            'sections' => [
                'forum' => 'Forum',
                'general' => 'Generelt',
                'store' => 'Butik',
            ],
        ],
    ],

    'store' => [
        'orders' => [
            'index' => [
                'title' => 'Ordre Katalogisering',
            ],
        ],
    ],

    'users' => [
        'restricted_banner' => [
            'title' => 'Denne bruger er i øjeblikket begrænset.',
            'message' => '(kun administratorer kan se dette)',
        ],
    ],

];

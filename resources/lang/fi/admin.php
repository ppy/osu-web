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
            'regenerate' => 'Luo uudelleen',
            'regenerating' => 'Luodaan uudelleen...',
            'remove' => 'Poista',
            'removing' => 'Poistetaan...',
            'title' => '',
        ],
        'show' => [
            'covers' => 'Hallitse rytmikarttojen kansia',
            'discussion' => [
                '_' => 'Modaus v2',
                'activate' => 'aktivoi',
                'activate_confirm' => 'aktivoi modaus v2 tälle rytmikartalle?',
                'active' => 'aktiivinen',
                'inactive' => 'epäaktiivinen',
            ],
        ],
    ],

    'forum' => [
        'forum-covers' => [
            'index' => [
                'delete' => 'Poista',

                'forum-name' => 'Foorumi #:id: :nimi',

                'no-cover' => 'Kantta ei ole asetettu',

                'submit' => [
                    'save' => 'Tallenna',
                    'update' => 'Päivitä',
                ],

                'title' => 'Foorumin Kansi Luettelo',

                'type-title' => [
                    'default-topic' => 'Oletus Aiheen Kansi',
                    'main' => 'Foorumin kansi',
                ],
            ],
        ],
    ],

    'logs' => [
        'index' => [
            'title' => 'Loki Katselija',
        ],
    ],

    'pages' => [
        'root' => [
            'sections' => [
                'beatmapsets' => '',
                'forum' => 'Foorumi',
                'general' => 'Yleinen',
                'store' => 'Kauppa',
            ],
        ],
    ],

    'store' => [
        'orders' => [
            'index' => [
                'title' => 'Tilaus listaus',
            ],
        ],
    ],

    'users' => [
        'restricted_banner' => [
            'title' => 'Tämä käyttäjä on tällähetkellä rajoitettu.',
            'message' => '(Vain ylläpitäjät näkevät tämän)',
        ],
    ],

];

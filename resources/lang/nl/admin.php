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
            'regenerate' => 'Regenereer',
            'regenerating' => 'Regenereren...',
            'remove' => 'Verwijder',
            'removing' => 'Verwijderen...',
            'title' => 'Beatmapset covers',
        ],
        'show' => [
            'covers' => 'Beheer Beatmapset Covers',
            'discussion' => [
                '_' => 'Modding v2',
                'activate' => 'activeer',
                'activate_confirm' => 'modding v2 activeren voor deze beatmap?',
                'active' => 'actief',
                'inactive' => 'inactief',
            ],
        ],
    ],

    'forum' => [
        'forum-covers' => [
            'index' => [
                'delete' => 'Verwijder',

                'forum-name' => 'Forum #:id: :name',

                'no-cover' => 'Geen cover ingesteld',

                'submit' => [
                    'save' => 'Opslaan',
                    'update' => 'Bijwerken',
                ],

                'title' => 'Forumcovers Lijst',

                'type-title' => [
                    'default-topic' => 'Standaardonderwerp Cover',
                    'main' => 'Forum Cover',
                ],
            ],
        ],
    ],

    'logs' => [
        'index' => [
            'title' => 'Log Bekijken',
        ],
    ],

    'pages' => [
        'root' => [
            'sections' => [
                'beatmapsets' => 'Beatmapsets',
                'forum' => 'Forum',
                'general' => 'Algemeen',
                'store' => 'Winkel',
            ],
        ],
    ],

    'store' => [
        'orders' => [
            'index' => [
                'title' => 'Bestellingslijst',
            ],
        ],
    ],

    'users' => [
        'restricted_banner' => [
            'title' => 'Deze gebruiker is momenteel gerestricteerd.',
            'message' => '(enkel administrators kunnen dit zien)',
        ],
    ],

];

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
            'regenerate' => 'Regenerera',
            'regenerating' => 'Regenererar...',
            'remove' => 'Ta bort',
            'removing' => 'Tar bort...',
            'title' => '',
        ],
        'show' => [
            'covers' => 'Hantera Beatmapsetomslag',
            'discussion' => [
                '_' => 'Modding v2',
                'activate' => 'aktivera',
                'activate_confirm' => 'aktivera modding v2 på denna beatmap?',
                'active' => 'aktiv',
                'inactive' => 'inaktiv',
            ],
        ],
    ],

    'forum' => [
        'forum-covers' => [
            'index' => [
                'delete' => 'Radera',

                'forum-name' => 'Forum #:id: :name',

                'no-cover' => 'Inget omslag satt',

                'submit' => [
                    'save' => 'Spara',
                    'update' => 'Uppdatera',
                ],

                'title' => 'Forumomslagslista',

                'type-title' => [
                    'default-topic' => 'Ordinarie Ämne Omslag',
                    'main' => 'Forumomslag',
                ],
            ],
        ],
    ],

    'logs' => [
        'index' => [
            'title' => 'Logg',
        ],
    ],

    'pages' => [
        'root' => [
            'sections' => [
                'beatmapsets' => '',
                'forum' => 'Forum',
                'general' => 'Allmänt',
                'store' => 'Affär',
            ],
        ],
    ],

    'store' => [
        'orders' => [
            'index' => [
                'title' => 'Orderlista',
            ],
        ],
    ],

    'users' => [
        'restricted_banner' => [
            'title' => 'Denna användare är för närvarande avstängd.',
            'message' => '(endast administratörer kan se detta)',
        ],
    ],

];

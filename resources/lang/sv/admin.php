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
        'show' => [
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

                'title' => 'Forum Omslag Lista',

                'type-title' => [
                    'default-topic' => 'Ordinarie Ämne Omslag',
                    'main' => 'Forum Omslag',
                ],
            ],
        ],
    ],

    'logs' => [
        'index' => [
            'title' => 'Logg Visare',
        ],
    ],

    'pages' => [
        'root' => [
            'title' => 'Admin Konsol Sak',

            'sections' => [
                'forum' => 'Forum',
                'general' => 'Allmänt',
                'store' => 'Affär',
            ],
        ],
    ],

    'store' => [
        'orders' => [
            'index' => [
                'title' => 'Order Lista',
            ],
        ],
    ],

    'users' => [
        'restricted_banner' => [
            'title' => 'Denna användare är begränsad.',
            'message' => '(endast admins kan se detta)',
        ],
    ],

];

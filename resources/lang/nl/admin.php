<?php

/**
 *    Copyright 2016 ppy Pty. Ltd.
 *
 *    This file is part of osu!web. osu!web is distributed in the hopes of
 *    attracting more community contributions to the core ecosystem of osu!
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

                'title' => 'Forum Cover Lijst',

                'type-title' => [
                    'default-topic' => 'Standaard Onderwerp Cover',
                    'main' => 'Forum Cover',
                ],
            ],
        ],
    ],

    'logs' => [
        'index' => [
            'title' => 'Log Viewer',
        ],
    ],

    'pages' => [
        'root' => [
            'title' => 'Admin Paneel Geval',

            'sections' => [
                'forum' => 'Forum',
                'general' => 'Algemeen',
                'store' => 'Winkel',
            ],
        ],
    ],

    'store' => [
        'orders' => [
            'index' => [
                'title' => 'Bestelling Lijst',
            ],
        ],
    ],

];

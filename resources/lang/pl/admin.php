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
            'regenerate' => 'Wygeneruj ponownie',
            'regenerating' => 'Ponowne generowanie...',
            'remove' => 'Usuń',
            'removing' => 'Usuwanie...',
            'title' => 'Tła zestawów beatmap',
        ],
        'show' => [
            'covers' => 'Zarządzaj tłami zestawu beatmap',
            'discussion' => [
                '_' => 'Modowanie v2',
                'activate' => 'aktywuj',
                'activate_confirm' => 'aktywować modowanie v2 dla tej beatmapy?',
                'active' => 'aktywne',
                'inactive' => 'nieaktywne',
            ],
        ],
    ],

    'forum' => [
        'forum-covers' => [
            'index' => [
                'delete' => 'Usuń',

                'forum-name' => 'Forum #:id: :name',

                'no-cover' => 'Nie ustawiono tła',

                'submit' => [
                    'save' => 'Zapisz',
                    'update' => 'Zaktualizuj',
                ],

                'title' => 'Lista teł forum',

                'type-title' => [
                    'default-topic' => 'Domyślne tło wątku',
                    'main' => 'Tło forum',
                ],
            ],
        ],
    ],

    'logs' => [
        'index' => [
            'title' => 'Podgląd logów',
        ],
    ],

    'pages' => [
        'root' => [
            'sections' => [
                'beatmapsets' => 'Zestawy beatmap',
                'forum' => 'Forum',
                'general' => 'Ogólne',
                'store' => 'Sklep',
            ],
        ],
    ],

    'store' => [
        'orders' => [
            'index' => [
                'title' => 'Lista zamówień',
            ],
        ],
    ],

    'users' => [
        'restricted_banner' => [
            'title' => 'Konto tego użytkownika jest obecnie zablokowane.',
            'message' => '(tylko administratorzy widzą tę wiadomość)',
        ],
    ],

];

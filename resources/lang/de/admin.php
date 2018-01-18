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
            'regenerate' => 'Regenerieren',
            'regenerating' => 'Regeneriert...',
            'remove' => 'Entfernen',
            'removing' => 'Entfernt...',
        ],
        'show' => [
            'covers' => 'Beatmapset-Covers bearbeiten',
            'discussion' => [
                '_' => 'Modding v2',
                'activate' => 'aktivieren',
                'activate_confirm' => 'modding v2 für diese beatmap aktivieren?',
                'active' => 'aktiv',
                'inactive' => 'inaktiv',
            ],
        ],
    ],

    'forum' => [
        'forum-covers' => [
            'index' => [
                'delete' => 'Löschen',

                'forum-name' => 'Forum #:id: :name',

                'no-cover' => 'Kein Cover ausgewählt',

                'submit' => [
                    'save' => 'Speichern',
                    'update' => 'Aktualisieren',
                ],
                
                'title' => 'Liste der Forencover',

                'type-title' => [
                    'default-topic' => 'Standard-Forencover',
                    'main' => 'Forencover',
                ],
            ],
        ],
    ],

    'logs' => [
        'index' => [
            // todo: evtl. ein wort für "viewer" finden
            'title' => 'Logs',
        ],
    ],

    'pages' => [
        'root' => [
            'title' => 'Adminkonsole',

            'sections' => [
                'forum' => 'Forum',
                'general' => 'Allgemein',
                'store' => 'Shop',
            ],
        ],
    ],

    'store' => [
        'orders' => [
            'index' => [
                'title' => 'Bestellungen',
            ],
        ],
    ],

    'users' => [
        'restricted_banner' => [
            // todo: übersetzung 'restricted'
            'title' => 'Dieser Benutzer ist momentan ',
            'message' => '(nur admins können dies sehen)',
        ],
    ],

];

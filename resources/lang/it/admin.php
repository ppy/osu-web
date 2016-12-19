<?php

/**
 *    Copyright 2015 ppy Pty. Ltd.
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
                'activate' => 'attivare',
                'activate_confirm' => 'attivare il modding v2 per questa mappa?',
                'active' => 'attivo',
                'inactive' => 'inattivo',
            ],
        ],
    ],

    'forum' => [
        'forum-covers' => [
            'index' => [
                'delete' => 'Elimina',

                'forum-name' => 'Forum #:id: :name',

                'no-cover' => 'Nessuna cover impostata',

                'submit' => [
                    'save' => 'Salva',
                    'update' => 'Aggiorna',
                ],

                'title' => 'Lista cover del forum',

                'type-title' => [
                    'default-topic' => 'Cover di default del topic',
                    'main' => 'Cover del forum',
                ],
            ],
        ],
    ],

    'logs' => [
        'index' => [
            'title' => 'Visualizzatore Log',
        ],
    ],

    'pages' => [
        'root' => [
            'title' => 'Console degli Amministratori',

            'sections' => [
                'forum' => 'Forum',
                'general' => 'Generale',
                'store' => 'Negozio',
            ],
        ],
    ],

    'store' => [
        'orders' => [
            'index' => [
                'title' => 'Elenco degli Ordini',
            ],
        ],
    ],

];

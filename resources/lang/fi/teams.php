<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'applications' => [
        'accept' => [
            'ok' => '',
        ],
        'destroy' => [
            'ok' => '',
        ],
        'reject' => [
            'ok' => '',
        ],
        'store' => [
            'ok' => '',
        ],
    ],

    'create' => [
        'submit' => 'Luo Tiimi',

        'form' => [
            'name_help' => 'Sinun tiimisi nimi. Nimi on pysyvä tällä hetkellä.',
            'short_name_help' => 'Enintään 4 merkkiä.',
            'title' => "Perustetaan uusi tiimi",
        ],

        'intro' => [
            'description' => "Pelaa yhdessä kavereidesi kanssa; entisten tai uusien. Et ole tällä hetkellä tiimissä. Liity olemassa olevaan tiimiin vierailemalla heidän tiimisivullaan tai luo oma tiimisi tältä sivulta.",
            'title' => 'Tiimi!',
        ],
    ],

    'destroy' => [
        'ok' => '',
    ],

    'edit' => [
        'ok' => 'Asetukset tallennettu onnistuneesti.',
        'title' => '',

        'description' => [
            'label' => 'Kuvaus',
            'title' => '',
        ],

        'flag' => [
            'label' => 'Tiimin lippu',
            'title' => 'Aseta Tiimin Lippu',
        ],

        'header' => [
            'label' => '',
            'title' => '',
        ],

        'settings' => [
            'application_help' => '',
            'default_ruleset_help' => '',
            'flag_help' => 'Enimmäiskoko :width×:height',
            'header_help' => 'Enimmäiskoko :width×:height',
            'title' => '',

            'application_state' => [
                'state_0' => 'Suljettu',
                'state_1' => 'Avaa',
            ],
        ],
    ],

    'header_links' => [
        'edit' => '',
        'leaderboard' => '',
        'show' => '',

        'members' => [
            'index' => '',
        ],
    ],

    'leaderboard' => [
        'global_rank' => '',
    ],

    'members' => [
        'destroy' => [
            'success' => '',
        ],

        'index' => [
            'title' => '',

            'applications' => [
                'empty' => '',
                'empty_slots' => '',
                'title' => '',
                'created_at' => '',
            ],

            'table' => [
                'status' => '',
                'joined_at' => '',
                'remove' => '',
                'title' => '',
            ],

            'status' => [
                'status_0' => '',
                'status_1' => '',
            ],
        ],
    ],

    'part' => [
        'ok' => '',
    ],

    'show' => [
        'bar' => [
            'chat' => 'Tiimikeskustelu',
            'destroy' => '',
            'join' => '',
            'join_cancel' => '',
            'part' => '',
        ],

        'info' => [
            'created' => '',
        ],

        'members' => [
            'members' => '',
            'owner' => '',
        ],

        'sections' => [
            'about' => '',
            'info' => '',
            'members' => '',
        ],

        'statistics' => [
            'rank' => '',
            'leader' => '',
        ],
    ],

    'store' => [
        'ok' => 'Tiimi luotu.',
    ],
];

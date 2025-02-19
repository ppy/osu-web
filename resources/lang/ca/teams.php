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

    'destroy' => [
        'ok' => '',
    ],

    'edit' => [
        'saved' => 'Configuració desada correctament',
        'title' => 'Configuracions de l\'Equip',

        'description' => [
            'label' => 'Descripció',
            'title' => 'Descripció de l\'equip',
        ],

        'header' => [
            'label' => 'Capçalera de la Imatge',
            'title' => 'Posar Capçalera a la Imatge',
        ],

        'logo' => [
            'label' => 'Bandera de l\'Equip',
            'title' => 'Posar Bandera de l\'Equip',
        ],

        'settings' => [
            'application' => 'Sol·licitud de l\'Equip',
            'application_help' => 'Si permetre que la gent sol·liciti unir-se a l\'equip',
            'default_ruleset' => 'Mode de joc Predeterminat',
            'default_ruleset_help' => 'El Mode de joc a ser seleccionat per defecte quan visites la pàgina de l\'equip',
            'title' => 'Configuració de l\'Equip',
            'url' => 'URL',

            'application_state' => [
                'state_0' => 'Tancat',
                'state_1' => 'Obert',
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
        'performance' => '',
        'total_score' => '',
    ],

    'members' => [
        'destroy' => [
            'success' => 'Membre de l\'equip eliminat',
        ],

        'index' => [
            'title' => 'Gestionar els Membres',

            'applications' => [
                'empty' => '',
                'empty_slots' => '',
                'title' => '',
                'created_at' => '',
            ],

            'table' => [
                'status' => 'Estatus',
                'joined_at' => 'Data d\'Unió',
                'remove' => 'Eliminar',
                'title' => 'Membres Actuals',
            ],

            'status' => [
                'status_0' => 'Inactiu',
                'status_1' => 'Actiu',
            ],
        ],
    ],

    'part' => [
        'ok' => '',
    ],

    'show' => [
        'bar' => [
            'destroy' => '',
            'join' => '',
            'join_cancel' => '',
            'part' => '',
        ],

        'info' => [
            'created' => 'Format',
            'website' => 'Lloc web',
        ],

        'members' => [
            'members' => 'Membres de l\'Equip',
            'owner' => 'Líder de l\'Equip',
        ],

        'sections' => [
            'info' => 'Info',
            'members' => 'Membres',
        ],
    ],
];

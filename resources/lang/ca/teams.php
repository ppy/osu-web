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
        'submit' => '',

        'form' => [
            'name_help' => '',
            'short_name_help' => '',
            'title' => "",
        ],

        'intro' => [
            'description' => "",
            'title' => '',
        ],
    ],

    'destroy' => [
        'ok' => 'Equip eliminat',
    ],

    'edit' => [
        'ok' => '',
        'title' => 'Configuracions de l\'Equip',

        'description' => [
            'label' => 'Descripció',
            'title' => 'Descripció de l\'equip',
        ],

        'flag' => [
            'label' => '',
            'title' => '',
        ],

        'header' => [
            'label' => 'Capçalera de la Imatge',
            'title' => 'Posar Capçalera a la Imatge',
        ],

        'settings' => [
            'application_help' => 'Si permetre que la gent sol·liciti unir-se a l\'equip',
            'default_ruleset_help' => 'El Mode de joc a ser seleccionat per defecte quan visites la pàgina de l\'equip',
            'flag_help' => '',
            'header_help' => '',
            'title' => 'Configuració de l\'Equip',

            'application_state' => [
                'state_0' => 'Tancat',
                'state_1' => 'Obert',
            ],
        ],
    ],

    'header_links' => [
        'edit' => 'configuració',
        'leaderboard' => '',
        'show' => '',

        'members' => [
            'index' => '',
        ],
    ],

    'leaderboard' => [
        'global_rank' => 'Classificació global',
    ],

    'members' => [
        'destroy' => [
            'success' => 'Membre de l\'equip eliminat',
        ],

        'index' => [
            'title' => 'Gestionar els Membres',

            'applications' => [
                'empty' => '',
                'empty_slots' => 'Places disponibles',
                'title' => 'Sol·licituds d\'accés',
                'created_at' => 'Sol·licitat a',
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
        'ok' => 'Has abandonat l\'equip ;_;',
    ],

    'show' => [
        'bar' => [
            'chat' => '',
            'destroy' => 'Dissol l\'Equip',
            'join' => 'Sol·licitar accés',
            'join_cancel' => 'Cancel·la la sol·licitud d\'accés',
            'part' => 'Abandona l\'Equip',
        ],

        'info' => [
            'created' => 'Format',
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

    'store' => [
        'ok' => '',
    ],
];

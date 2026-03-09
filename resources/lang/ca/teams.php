<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'applications' => [
        'accept' => [
            'ok' => 'Usuari afegit a l\'equip.',
        ],
        'destroy' => [
            'ok' => 'Petició d\'unió cancel·lada.',
        ],
        'reject' => [
            'ok' => 'Petició d\'unió rebutjada.',
        ],
        'store' => [
            'ok' => 'Petició per unir-se a l\'equip.',
        ],
    ],

    'card' => [
        'members' => ':count_delimited membre|:count_delimited membres',
    ],

    'create' => [
        'submit' => 'Crear equip',

        'form' => [
            'name_help' => 'Nom del teu equip. El nom serà permanent.',
            'short_name_help' => 'Màxim 4 lletres.',
            'title' => "Creem un nou equip",
        ],

        'intro' => [
            'description' => "Juga amb els teus amics; veterans o principiants. Actualment no pertanys a cap equip. Uneix-te a un visitant la nostra pàgina d'equips, o crea el teu propi des d'aquesta pàgina.",
            'title' => 'Equip!',
        ],
    ],

    'destroy' => [
        'ok' => 'Equip eliminat.',
    ],

    'edit' => [
        'ok' => 'Configuració guardada correctament.',
        'title' => 'Configuracions de l\'Equip',

        'description' => [
            'label' => 'Descripció',
            'title' => 'Descripció de l\'equip',
        ],

        'flag' => [
            'label' => 'Bandera de l\'equip',
            'title' => 'Estableix una bandera per a l\'equip',
        ],

        'header' => [
            'label' => 'Capçalera de la Imatge',
            'title' => 'Posar Capçalera a la Imatge',
        ],

        'settings' => [
            'application_help' => 'Si permetre que la gent sol·liciti unir-se a l\'equip',
            'default_ruleset_help' => 'El mode de joc a ser seleccionat per defecte quan visites la pàgina de l\'equip',
            'flag_help' => 'Mida màxima :width×:height',
            'header_help' => 'Mida màxima :width×:height',
            'title' => 'Configuració de l\'Equip',

            'application_state' => [
                'state_0' => 'Tancat',
                'state_1' => 'Obert',
            ],
        ],
    ],

    'header_links' => [
        'edit' => 'configuració',
        'leaderboard' => 'puntuacions',
        'show' => 'info',

        'members' => [
            'index' => 'editar els membres',
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
                'accept_confirm' => 'Afegir jugador :user a l\'equip?',
                'created_at' => 'Sol·licitat a',
                'empty' => 'Sense peticions d\'unió en aquests moments.',
                'empty_slots' => 'Places disponibles',
                'empty_slots_overflow' => ':count_delimited límit d\'usuaris|:count_delimited límit d\'usuaris',
                'reject_confirm' => 'Rebutjar la petició d\'unió del jugador :user?',
                'title' => 'Sol·licituds d\'accés',
            ],

            'table' => [
                'joined_at' => 'Data d\'Unió',
                'remove' => 'Eliminar',
                'remove_confirm' => 'Eliminar el jugador :user de l\'equip?',
                'set_leader' => 'Transferir el lideratge de l\'equip',
                'set_leader_confirm' => 'Transferir el lideratge de l\'equip al jugador :user?',
                'status' => 'Estatus',
                'title' => 'Membres Actuals',
            ],

            'status' => [
                'status_0' => 'Inactiu',
                'status_1' => 'Actiu',
            ],
        ],

        'set_leader' => [
            'success' => 'Jugador :user és el líder de l\'equip.',
        ],
    ],

    'part' => [
        'ok' => 'Has abandonat l\'equip ;_;',
    ],

    'show' => [
        'bar' => [
            'chat' => 'Xat de l\'equip',
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
            'about' => 'Sobre nosaltres!',
            'info' => 'Info',
            'members' => 'Membres',
        ],

        'statistics' => [
            'empty_slots' => ':count_delimited ranura disponible|:count_delimited ranures disponibles',
            'first_places' => '',
            'leader' => 'Líder de l\'equip',
            'rank' => 'Posició',
            'ranked_beatmapsets' => '',
        ],
    ],

    'store' => [
        'ok' => 'Equip creat.',
    ],
];

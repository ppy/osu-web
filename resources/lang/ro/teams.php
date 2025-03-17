<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'applications' => [
        'accept' => [
            'ok' => 'Utilizator adăugat în echipă.',
        ],
        'destroy' => [
            'ok' => 'Cerere de înscriere anulată.',
        ],
        'reject' => [
            'ok' => 'Cerere de înscriere respinsă.',
        ],
        'store' => [
            'ok' => 'Alăturarea în echipa a fost solicitată.',
        ],
    ],

    'create' => [
        'submit' => 'Creează Echipă',

        'form' => [
            'name_help' => 'Numele echipei. Acest nume este permanent pe moment.',
            'short_name_help' => 'Maxim 4 caractere.',
            'title' => "Hai să configurăm o nouă echipă",
        ],

        'intro' => [
            'description' => "Jucați împreună cu prieteni, existenți sau noi. Nu sunteți într-o echipă momentan. Alătură-te unei echipe existente vizitând pagina echipei sau creează-ți propria echipă de pe această pagină.",
            'title' => 'Echipă!',
        ],
    ],

    'destroy' => [
        'ok' => 'Echipă ștearsă',
    ],

    'edit' => [
        'ok' => 'Setările au fost salvate cu succes.',
        'title' => 'Setări Echipă',

        'description' => [
            'label' => 'Descriere',
            'title' => 'Descrierea Echipei',
        ],

        'flag' => [
            'label' => 'Steagul Echipei',
            'title' => 'Setează Steagul Echipei',
        ],

        'header' => [
            'label' => 'Imagine Antet',
            'title' => 'Setează Imagine Antet',
        ],

        'settings' => [
            'application_help' => 'Dacă este permis altora să trimită cereri de înscriere în echipă',
            'default_ruleset_help' => 'Ruleset-ul care va fi selectat implicit la vizitarea paginii echipei',
            'flag_help' => 'Dimensiunea maximă de :width×:height',
            'header_help' => 'Dimensiunea maximă de :width×:height',
            'title' => 'Setări Echipă',

            'application_state' => [
                'state_0' => 'Închise',
                'state_1' => 'Deschise',
            ],
        ],
    ],

    'header_links' => [
        'edit' => 'setări',
        'leaderboard' => 'clasament',
        'show' => 'info',

        'members' => [
            'index' => 'gestionează membrii',
        ],
    ],

    'leaderboard' => [
        'global_rank' => 'Clasament Global',
    ],

    'members' => [
        'destroy' => [
            'success' => 'Membru al echipei eliminat',
        ],

        'index' => [
            'title' => 'Gestionare Membri',

            'applications' => [
                'empty' => 'Nici o cerere de înscriere în acest moment.',
                'empty_slots' => 'Locuri disponibile',
                'title' => 'Cereri de Înscriere',
                'created_at' => 'Solicitat La',
            ],

            'table' => [
                'status' => 'Status',
                'joined_at' => 'Data Înscrierii',
                'remove' => 'Elimină',
                'title' => 'Membrii Actuali',
            ],

            'status' => [
                'status_0' => 'Inactiv',
                'status_1' => 'Activ',
            ],
        ],
    ],

    'part' => [
        'ok' => 'Ai părăsit echipa ;_;',
    ],

    'show' => [
        'bar' => [
            'chat' => 'Chat Echipă',
            'destroy' => 'Dizolvă Echipa',
            'join' => 'Cere Înscrierea',
            'join_cancel' => 'Anulează Cererea',
            'part' => 'Părăsește Echipa',
        ],

        'info' => [
            'created' => 'Formată',
        ],

        'members' => [
            'members' => 'Membrii Echipei',
            'owner' => 'Liderul Echipei',
        ],

        'sections' => [
            'about' => '',
            'info' => 'Info',
            'members' => 'Membri',
        ],

        'statistics' => [
            'rank' => '',
            'leader' => '',
        ],
    ],

    'store' => [
        'ok' => 'Echipă creată.',
    ],
];

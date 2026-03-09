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

    'card' => [
        'members' => 'un membru|:count_delimited membrii|:count_delimited de membrii',
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
                'accept_confirm' => 'Adăugați utilizatorul :user la echipă?',
                'created_at' => 'Solicitat La',
                'empty' => 'Nici o cerere de înscriere în acest moment.',
                'empty_slots' => 'Locuri disponibile',
                'empty_slots_overflow' => 'un utilizator în plus|:count_delimited utilizatori în plus|:count_delimited de utilizatori în plus',
                'reject_confirm' => 'Refuzați cererea de înscriere de la utilizatorul :user?',
                'title' => 'Cereri de Înscriere',
            ],

            'table' => [
                'joined_at' => 'Data Înscrierii',
                'remove' => 'Elimină',
                'remove_confirm' => 'Eliminați utilizatorul :user din echipă?',
                'set_leader' => 'Transferați conducerea echipei',
                'set_leader_confirm' => 'Transferați conducerea echipei către utilizatorul :user?',
                'status' => 'Status',
                'title' => 'Membrii Actuali',
            ],

            'status' => [
                'status_0' => 'Inactiv',
                'status_1' => 'Activ',
            ],
        ],

        'set_leader' => [
            'success' => 'Utilizatorul :user este acum liderul echipei.',
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
            'about' => 'Despre Noi!',
            'info' => 'Info',
            'members' => 'Membri',
        ],

        'statistics' => [
            'empty_slots' => '',
            'first_places' => '',
            'leader' => 'Liderul Echipei',
            'rank' => 'Rang',
            'ranked_beatmapsets' => '',
        ],
    ],

    'store' => [
        'ok' => 'Echipă creată.',
    ],
];

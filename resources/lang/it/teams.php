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
        'saved' => 'Impostazioni salvate',
        'title' => 'Impostazioni Squadra',

        'description' => [
            'label' => 'Descrizione',
            'title' => 'Descrizione Squadra',
        ],

        'header' => [
            'label' => 'Copertina',
            'title' => 'Imposta Copertina',
        ],

        'logo' => [
            'label' => 'Bandiera Squadra',
            'title' => 'Imposta Bandiera Squadra',
        ],

        'settings' => [
            'application' => 'Candidature Squadra',
            'application_help' => 'Indica se consentire alle persone di candidarsi per la squadra',
            'default_ruleset' => 'Modalità Predefinita di Gioco',
            'default_ruleset_help' => 'La modalità di gioco impostata come predefinita quando si visita la pagina della squadra',
            'title' => 'Impostazioni Squadra',
            'url' => 'URL',

            'application_state' => [
                'state_0' => 'Chiuse',
                'state_1' => 'Aperte',
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
            'success' => 'Rimosso membro della squadra',
        ],

        'index' => [
            'title' => 'Gestisci Membri',

            'applications' => [
                'empty' => '',
                'empty_slots' => '',
                'title' => '',
                'created_at' => '',
            ],

            'table' => [
                'status' => 'Stato',
                'joined_at' => 'Data Iscrizione',
                'remove' => 'Espelli',
                'title' => 'Membri Attuali',
            ],

            'status' => [
                'status_0' => 'Inattivo',
                'status_1' => 'Attivo',
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
            'created' => 'Creato',
            'website' => 'Sito Web',
        ],

        'members' => [
            'members' => 'Membri della Squadra',
            'owner' => 'Capitano della Squadra',
        ],

        'sections' => [
            'info' => 'Info',
            'members' => 'Membri',
        ],
    ],
];

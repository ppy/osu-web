<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'applications' => [
        'accept' => [
            'ok' => 'Utente aggiunto alla squadra.',
        ],
        'destroy' => [
            'ok' => 'Richiesta di adesione annullata.',
        ],
        'reject' => [
            'ok' => 'Richiesta di adesione respinta.',
        ],
        'store' => [
            'ok' => 'Richiesto di unirsi al team.',
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
        'ok' => 'Squadra rimossa',
    ],

    'edit' => [
        'ok' => '',
        'title' => 'Impostazioni Squadra',

        'description' => [
            'label' => 'Descrizione',
            'title' => 'Descrizione Squadra',
        ],

        'flag' => [
            'label' => '',
            'title' => '',
        ],

        'header' => [
            'label' => 'Copertina',
            'title' => 'Imposta immagine di sfondo',
        ],

        'settings' => [
            'application_help' => 'Indica se consentire alle persone di candidarsi per la squadra',
            'default_ruleset_help' => 'La modalità di gioco impostata come predefinita quando si visita la pagina della squadra',
            'flag_help' => '',
            'header_help' => '',
            'title' => 'Impostazioni Squadra',

            'application_state' => [
                'state_0' => 'Chiuse',
                'state_1' => 'Aperte',
            ],
        ],
    ],

    'header_links' => [
        'edit' => 'impostazioni',
        'leaderboard' => 'classifica',
        'show' => 'dettagli',

        'members' => [
            'index' => 'gestisci membri',
        ],
    ],

    'leaderboard' => [
        'global_rank' => 'Classifica Globale',
    ],

    'members' => [
        'destroy' => [
            'success' => 'Rimosso membro della squadra',
        ],

        'index' => [
            'title' => 'Gestisci Membri',

            'applications' => [
                'empty' => 'Nessuna richiesta di partecipazione per ora.',
                'empty_slots' => 'Posti disponibili',
                'title' => 'Richieste di partecipazione',
                'created_at' => 'Data',
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
        'ok' => 'Abbandonato la squadra ;_;',
    ],

    'show' => [
        'bar' => [
            'chat' => '',
            'destroy' => 'Sciogli la squadra',
            'join' => 'Richiedi Partecipazione',
            'join_cancel' => 'Annulla Partecipazione',
            'part' => 'Abbandona la squadra',
        ],

        'info' => [
            'created' => 'Creato',
        ],

        'members' => [
            'members' => 'Membri della Squadra',
            'owner' => 'Capitano della squadra',
        ],

        'sections' => [
            'info' => 'Dettagli',
            'members' => 'Membri',
        ],
    ],

    'store' => [
        'ok' => '',
    ],
];

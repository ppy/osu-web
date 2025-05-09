<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'applications' => [
        'accept' => [
            'ok' => 'Utente aggiunto alla squadra.',
        ],
        'destroy' => [
            'ok' => 'Richiesta di partecipazione annullata.',
        ],
        'reject' => [
            'ok' => 'Richiesta di partecipazione respinta.',
        ],
        'store' => [
            'ok' => 'Richiesto di partecipare al team.',
        ],
    ],

    'create' => [
        'submit' => 'Crea Squadra',

        'form' => [
            'name_help' => 'Il nome della tua squadra. Il nome è permanente al momento.',
            'short_name_help' => 'Massimo 4 caratteri.',
            'title' => "Creiamo una nuova squadra",
        ],

        'intro' => [
            'description' => "Gioca insieme ad amici; presenti o nuovi. Al momento non sei in una squadra. Unisciti a squadre esistenti visitando la loro pagina oppure crea la tua squadra attraverso questa pagina.",
            'title' => 'Squadra!',
        ],
    ],

    'destroy' => [
        'ok' => 'Squadra rimossa.',
    ],

    'edit' => [
        'ok' => 'Impostazioni salvate con successo.',
        'title' => 'Impostazioni Squadra',

        'description' => [
            'label' => 'Descrizione',
            'title' => 'Descrizione Squadra',
        ],

        'flag' => [
            'label' => 'Bandiera della squadra',
            'title' => 'Imposta bandiera della squadra',
        ],

        'header' => [
            'label' => 'Copertina',
            'title' => 'Imposta immagine di sfondo',
        ],

        'settings' => [
            'application_help' => 'Indica se consentire alle persone di candidarsi per la squadra',
            'default_ruleset_help' => 'La modalità di gioco impostata come predefinita quando si visita la pagina della squadra',
            'flag_help' => 'Dimensione massima di :width×:height',
            'header_help' => 'Dimensione massima di :width×:height',
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
                'accept_confirm' => '',
                'created_at' => 'Data',
                'empty' => 'Nessuna richiesta di partecipazione per ora.',
                'empty_slots' => 'Posti disponibili',
                'empty_slots_overflow' => '',
                'reject_confirm' => '',
                'title' => 'Richieste di partecipazione',
            ],

            'table' => [
                'joined_at' => 'Data Iscrizione',
                'remove' => 'Espelli',
                'remove_confirm' => '',
                'set_leader' => '',
                'set_leader_confirm' => '',
                'status' => 'Stato',
                'title' => 'Membri Attuali',
            ],

            'status' => [
                'status_0' => 'Inattivo',
                'status_1' => 'Attivo',
            ],
        ],

        'set_leader' => [
            'success' => '',
        ],
    ],

    'part' => [
        'ok' => 'Abbandonata la squadra ;_;',
    ],

    'show' => [
        'bar' => [
            'chat' => 'Chat della squadra',
            'destroy' => 'Sciogli la squadra',
            'join' => 'Richiedi Partecipazione',
            'join_cancel' => 'Annulla Partecipazione',
            'part' => 'Abbandona squadra',
        ],

        'info' => [
            'created' => 'Creata',
        ],

        'members' => [
            'members' => 'Membri della squadra',
            'owner' => 'Capitano',
        ],

        'sections' => [
            'about' => 'Su di noi!',
            'info' => 'Dettagli',
            'members' => 'Membri',
        ],

        'statistics' => [
            'rank' => 'Posizione',
            'leader' => 'Capitano',
        ],
    ],

    'store' => [
        'ok' => 'Squadra creata.',
    ],
];

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
        'saved' => 'Einstellungen gespeichert',
        'title' => 'Teameinstellungen',

        'description' => [
            'label' => 'Beschreibung',
            'title' => 'Teambeschreibung',
        ],

        'header' => [
            'label' => 'Bannerlogo',
            'title' => 'Bannerlogo hinzufügen',
        ],

        'logo' => [
            'label' => 'Teamflagge',
            'title' => 'Teamflagge einstellen',
        ],

        'settings' => [
            'application' => 'Team-Bewerbungen',
            'application_help' => 'Ob Personen sich für das Team bewerben können',
            'default_ruleset' => 'Standardspielmodus',
            'default_ruleset_help' => 'Der Spielmodus, der beim Besuchen der Teamseite standardmäßig ausgewählt ist',
            'title' => 'Teameinstellungen',
            'url' => 'URL',

            'application_state' => [
                'state_0' => 'Geschlossen',
                'state_1' => 'Offen',
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
            'success' => 'Teammitglied entfernt',
        ],

        'index' => [
            'title' => 'Mitglieder verwalten',

            'applications' => [
                'empty' => '',
                'empty_slots' => '',
                'title' => '',
                'created_at' => '',
            ],

            'table' => [
                'status' => 'Status',
                'joined_at' => 'Beitrittsdatum',
                'remove' => 'Entfernen',
                'title' => 'Aktuelle Mitglieder',
            ],

            'status' => [
                'status_0' => 'Inaktiv',
                'status_1' => 'Aktiv',
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
            'created' => 'Gegründet',
            'website' => 'Webseite',
        ],

        'members' => [
            'members' => 'Teammitglieder',
            'owner' => 'Teamleiter',
        ],

        'sections' => [
            'info' => 'Info',
            'members' => 'Mitglieder',
        ],
    ],
];

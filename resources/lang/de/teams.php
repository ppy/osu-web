<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'applications' => [
        'accept' => [
            'ok' => 'Benutzer zum Team hinzugefügt.',
        ],
        'destroy' => [
            'ok' => 'Beitrittsanfrage abgebrochen.',
        ],
        'reject' => [
            'ok' => 'Beitrittsanfrage abgelehnt.',
        ],
        'store' => [
            'ok' => 'Beitrittsanfrage abgesendet.',
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
        'ok' => 'Team entfernt',
    ],

    'edit' => [
        'ok' => '',
        'title' => 'Teameinstellungen',

        'description' => [
            'label' => 'Beschreibung',
            'title' => 'Teambeschreibung',
        ],

        'flag' => [
            'label' => '',
            'title' => '',
        ],

        'header' => [
            'label' => 'Bannerlogo',
            'title' => 'Bannerlogo hinzufügen',
        ],

        'settings' => [
            'application_help' => 'Ob Personen sich für das Team bewerben können',
            'default_ruleset_help' => 'Der Spielmodus, der beim Besuchen der Teamseite standardmäßig ausgewählt ist',
            'flag_help' => '',
            'header_help' => '',
            'title' => 'Teameinstellungen',

            'application_state' => [
                'state_0' => 'Geschlossen',
                'state_1' => 'Offen',
            ],
        ],
    ],

    'header_links' => [
        'edit' => 'Einstellungen',
        'leaderboard' => 'Rangliste',
        'show' => 'Info',

        'members' => [
            'index' => 'Mitglieder verwalten',
        ],
    ],

    'leaderboard' => [
        'global_rank' => 'Globaler Rang',
    ],

    'members' => [
        'destroy' => [
            'success' => 'Teammitglied entfernt',
        ],

        'index' => [
            'title' => 'Mitglieder verwalten',

            'applications' => [
                'empty' => 'Keine Beitrittsanfragen zurzeit.',
                'empty_slots' => 'Verfügbare Plätze',
                'title' => 'Beitrittsanfragen',
                'created_at' => 'Anfrage am',
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
        'ok' => 'Team verlassen ;_;',
    ],

    'show' => [
        'bar' => [
            'chat' => '',
            'destroy' => 'Team auflösen',
            'join' => 'Beitrittsanfrage stellen',
            'join_cancel' => 'Beitritt abbrechen',
            'part' => 'Team verlassen',
        ],

        'info' => [
            'created' => 'Gegründet',
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

    'store' => [
        'ok' => '',
    ],
];

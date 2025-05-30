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

    'card' => [
        'members' => '',
    ],

    'create' => [
        'submit' => 'Team erstellen',

        'form' => [
            'name_help' => 'Dein Teamname. Der Name kann nicht mehr geändert werden.',
            'short_name_help' => 'Maximal 4 Zeichen.',
            'title' => "Ein neues Team anlegen",
        ],

        'intro' => [
            'description' => "Spiele zusammen mit Freunden, egal ob bereits erfahrene Spieler oder Anfänger. Du bist aktuell in keinem Team. Tritt einem existierendem Team bei, indem du die Teamseite besuchst oder hier dein eigenes Team erstellst.",
            'title' => 'Team!',
        ],
    ],

    'destroy' => [
        'ok' => 'Team entfernt.',
    ],

    'edit' => [
        'ok' => 'Einstellungen gespeichert.',
        'title' => 'Teameinstellungen',

        'description' => [
            'label' => 'Beschreibung',
            'title' => 'Teambeschreibung',
        ],

        'flag' => [
            'label' => 'Teamflagge',
            'title' => 'Teamflagge einstellen',
        ],

        'header' => [
            'label' => 'Bannerlogo',
            'title' => 'Bannerlogo hinzufügen',
        ],

        'settings' => [
            'application_help' => 'Ob Personen sich für das Team bewerben können',
            'default_ruleset_help' => 'Der Spielmodus, der beim Besuchen der Teamseite standardmäßig ausgewählt ist',
            'flag_help' => 'Maximale Größe von :width × :height',
            'header_help' => 'Maximale Größe von :width × :height',
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
                'accept_confirm' => ':user zum Team hinzufügen?',
                'created_at' => 'Anfrage am',
                'empty' => 'Keine Beitrittsanfragen zurzeit.',
                'empty_slots' => 'Verfügbare Plätze',
                'empty_slots_overflow' => ':count_delimited Benutzer zu viel|:count_delimited Benutzer zu viel',
                'reject_confirm' => 'Beitrittsanfrage von :user ablehnen?',
                'title' => 'Beitrittsanfragen',
            ],

            'table' => [
                'joined_at' => 'Beitrittsdatum',
                'remove' => 'Entfernen',
                'remove_confirm' => ':user aus dem Team entfernen?',
                'set_leader' => 'Teamleitung übertragen',
                'set_leader_confirm' => 'Teamführung auf :user übertragen?',
                'status' => 'Status',
                'title' => 'Aktuelle Mitglieder',
            ],

            'status' => [
                'status_0' => 'Inaktiv',
                'status_1' => 'Aktiv',
            ],
        ],

        'set_leader' => [
            'success' => ':user ist jetzt Teamleiter.',
        ],
    ],

    'part' => [
        'ok' => 'Team verlassen ;_;',
    ],

    'show' => [
        'bar' => [
            'chat' => 'Teamchat',
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
            'about' => 'Über uns!',
            'info' => 'Info',
            'members' => 'Mitglieder',
        ],

        'statistics' => [
            'rank' => 'Rang',
            'leader' => 'Teamleiter',
        ],
    ],

    'store' => [
        'ok' => 'Team erstellt.',
    ],
];

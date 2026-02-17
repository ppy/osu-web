<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'applications' => [
        'accept' => [
            'ok' => 'Gebruiker aan team toegevoegd.',
        ],
        'destroy' => [
            'ok' => 'Verzoek ingetrokken.',
        ],
        'reject' => [
            'ok' => 'Verzoek afgewezen.',
        ],
        'store' => [
            'ok' => 'Wilt lid worden.',
        ],
    ],

    'card' => [
        'members' => '',
    ],

    'create' => [
        'submit' => 'Team Aanmaken',

        'form' => [
            'name_help' => 'Hoe je team heet. Voor nu kan je het niet veranderen.',
            'short_name_help' => 'Maximaal vier letters.',
            'title' => "Zullen we een team opzetten? ",
        ],

        'intro' => [
            'description' => "Speel samen met je vrienden; bekend of nieuw. Je bent nog niet lid van een team. Word lid van een bestaand team door hun pagina te bezoeken, of maak hier je eigen team.",
            'title' => 'Team!',
        ],
    ],

    'destroy' => [
        'ok' => 'Team verwijderd.',
    ],

    'edit' => [
        'ok' => 'De instellingen zijn opgeslagen.',
        'title' => 'Teaminstellingen',

        'description' => [
            'label' => 'Beschrijving',
            'title' => 'Teambeschrijving',
        ],

        'flag' => [
            'label' => 'Teamvlag',
            'title' => 'Teamvlag instellen',
        ],

        'header' => [
            'label' => 'Bannerafbeelding',
            'title' => 'Bannerafbeelding instellen',
        ],

        'settings' => [
            'application_help' => 'Of mensen mogen vragen om lid te worden van het team',
            'default_ruleset_help' => 'Deze spelmodus wordt als eerste weergegeven wanneer iemand de pagina van het team bezoekt',
            'flag_help' => 'Mag maximaal :width×:height groot zijn',
            'header_help' => 'Mag maximaal :width×:height groot zijn',
            'title' => 'Teaminstellingen',

            'application_state' => [
                'state_0' => 'Gesloten',
                'state_1' => 'Open',
            ],
        ],
    ],

    'header_links' => [
        'edit' => 'instellingen',
        'leaderboard' => 'ranglijst',
        'show' => 'gegevens',

        'members' => [
            'index' => 'leden beheren',
        ],
    ],

    'leaderboard' => [
        'global_rank' => 'Wereldwijde Ranking',
    ],

    'members' => [
        'destroy' => [
            'success' => 'Lidmaatschap is opgeheven',
        ],

        'index' => [
            'title' => 'Leden Beheren',

            'applications' => [
                'accept_confirm' => 'Gebruiker :user aan het team toevoegen?',
                'created_at' => 'Ingestuurd',
                'empty' => 'Op dit moment heeft niemand een verzoek ingestuurd.',
                'empty_slots' => 'Vrije plaatsen',
                'empty_slots_overflow' => ':count_delimited te veel|:count_delimited te veel',
                'reject_confirm' => 'Wil je het verzoek van gebruiker :user afwijzen?',
                'title' => 'Verzoeken om lid te worden',
            ],

            'table' => [
                'joined_at' => 'Lid Geworden Op',
                'remove' => 'Lidmaatschap Beëindigen',
                'remove_confirm' => 'De gebruiker :user uit het team gooien?',
                'set_leader' => 'Benoemen als teamcaptain',
                'set_leader_confirm' => 'Wil je gebruiker :user teamcaptain maken?',
                'status' => 'Status',
                'title' => 'Huidige Leden',
            ],

            'status' => [
                'status_0' => 'Niet actief',
                'status_1' => 'Actief',
            ],
        ],

        'set_leader' => [
            'success' => 'Gebruiker :user is nu de teamcaptain.',
        ],
    ],

    'part' => [
        'ok' => 'Je bent eruit ;_;',
    ],

    'show' => [
        'bar' => [
            'chat' => 'Teamchat',
            'destroy' => 'Team Opheffen',
            'join' => 'Lid Worden',
            'join_cancel' => 'Verzoek Intrekken',
            'part' => 'Team Verlaten',
        ],

        'info' => [
            'created' => 'Gesticht',
        ],

        'members' => [
            'members' => 'Teamleden',
            'owner' => 'Teamcaptain',
        ],

        'sections' => [
            'about' => 'Over Ons!',
            'info' => 'Gegevens',
            'members' => 'Leden',
        ],

        'statistics' => [
            'empty_slots' => '',
            'first_places' => '',
            'leader' => 'Teamcaptain',
            'rank' => 'Ranking',
            'ranked_beatmapsets' => '',
        ],
    ],

    'store' => [
        'ok' => 'Team is aangemaakt.',
    ],
];

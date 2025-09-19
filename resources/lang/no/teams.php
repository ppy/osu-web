<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'applications' => [
        'accept' => [
            'ok' => 'La til bruker i teamet.',
        ],
        'destroy' => [
            'ok' => 'Kansellerte invitasjonsforespørsel.',
        ],
        'reject' => [
            'ok' => 'Avslo invitasjonsforespørsel.',
        ],
        'store' => [
            'ok' => 'Forespurt å delta i teamet.',
        ],
    ],

    'card' => [
        'members' => ':count_delimited medlem|:count_delimited medlemmer',
    ],

    'create' => [
        'submit' => 'Opprett Team',

        'form' => [
            'name_help' => 'Ditt teamnavn. Navnet er permanent for øyeblikket.',
            'short_name_help' => 'Maks 4 tegn.',
            'title' => "La oss sette opp et nytt team",
        ],

        'intro' => [
            'description' => "Spill sammen med venner; både kjente og nye. Du er for øyeblikket ikke i et team. Bli med i et eksisterende team ved å gå til deres teamside eller lag ditt eget team fra denne siden.",
            'title' => 'Team!',
        ],
    ],

    'destroy' => [
        'ok' => 'Team fjernet.',
    ],

    'edit' => [
        'ok' => 'Innstillinger er lagret.',
        'title' => 'Teaminnstillinger',

        'description' => [
            'label' => 'Beskrivelse',
            'title' => 'Team Beskrivelse',
        ],

        'flag' => [
            'label' => 'Team Flagg',
            'title' => 'Angi Team Flagg',
        ],

        'header' => [
            'label' => '',
            'title' => '',
        ],

        'settings' => [
            'application_help' => '',
            'default_ruleset_help' => '',
            'flag_help' => 'Maksimal størrelse på :width×:height',
            'header_help' => 'Maksimal størrelse på :width×:height',
            'title' => 'Team Innstillinger',

            'application_state' => [
                'state_0' => 'Stengt',
                'state_1' => 'Åpent',
            ],
        ],
    ],

    'header_links' => [
        'edit' => 'innstillinger',
        'leaderboard' => 'toppliste',
        'show' => 'info',

        'members' => [
            'index' => '',
        ],
    ],

    'leaderboard' => [
        'global_rank' => '',
    ],

    'members' => [
        'destroy' => [
            'success' => '',
        ],

        'index' => [
            'title' => '',

            'applications' => [
                'accept_confirm' => '',
                'created_at' => '',
                'empty' => '',
                'empty_slots' => '',
                'empty_slots_overflow' => '',
                'reject_confirm' => '',
                'title' => '',
            ],

            'table' => [
                'joined_at' => '',
                'remove' => '',
                'remove_confirm' => '',
                'set_leader' => '',
                'set_leader_confirm' => '',
                'status' => '',
                'title' => '',
            ],

            'status' => [
                'status_0' => '',
                'status_1' => '',
            ],
        ],

        'set_leader' => [
            'success' => '',
        ],
    ],

    'part' => [
        'ok' => '',
    ],

    'show' => [
        'bar' => [
            'chat' => '',
            'destroy' => '',
            'join' => '',
            'join_cancel' => '',
            'part' => 'Forlat Team',
        ],

        'info' => [
            'created' => '',
        ],

        'members' => [
            'members' => '',
            'owner' => '',
        ],

        'sections' => [
            'about' => '',
            'info' => '',
            'members' => '',
        ],

        'statistics' => [
            'empty_slots' => '',
            'leader' => '',
            'rank' => '',
        ],
    ],

    'store' => [
        'ok' => '',
    ],
];

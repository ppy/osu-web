<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'applications' => [
        'accept' => [
            'ok' => 'La till användare till laget.',
        ],
        'destroy' => [
            'ok' => 'Avbröt anslutningsbegäran.',
        ],
        'reject' => [
            'ok' => 'Avvisad anslutningsbegäran.',
        ],
        'store' => [
            'ok' => 'Har begärt att få gå med i laget.',
        ],
    ],

    'card' => [
        'members' => '',
    ],

    'create' => [
        'submit' => 'Skapa lag',

        'form' => [
            'name_help' => 'Ditt lagnamn. Namnet är permanent just nu.',
            'short_name_help' => 'Maximalt 4 bokstäver.',
            'title' => "Låt oss sätta upp ett nytt lag",
        ],

        'intro' => [
            'description' => "Spela tillsammans med vänner, befintliga eller nya. Du är inte med i ett lag för närvarande. Gå med i ett befintligt lag genom att besöka deras lagsida eller skapa ditt eget lag från den här sidan.",
            'title' => 'Lag!',
        ],
    ],

    'destroy' => [
        'ok' => 'Lag borttaget.',
    ],

    'edit' => [
        'ok' => 'Inställningarna har sparats.',
        'title' => 'Lag inställningar ',

        'description' => [
            'label' => 'Beskrivning',
            'title' => 'Lag beskrivning',
        ],

        'flag' => [
            'label' => 'Lag flagga',
            'title' => 'Sätt lagflagga',
        ],

        'header' => [
            'label' => 'Rubrikbild',
            'title' => 'Sätt rubrikbild',
        ],

        'settings' => [
            'application_help' => 'Huruvida man ska tillåta att personer ansöker till laget ',
            'default_ruleset_help' => 'Regeluppsättningen som ska väljas som standard när du besöker lagsidan',
            'flag_help' => 'Maximal storlek av :width×:height',
            'header_help' => 'Maximal storlek av :width×:height',
            'title' => 'Lag inställningar ',

            'application_state' => [
                'state_0' => 'Stängd',
                'state_1' => 'Öppen',
            ],
        ],
    ],

    'header_links' => [
        'edit' => 'inställningar',
        'leaderboard' => 'topplistan',
        'show' => 'info',

        'members' => [
            'index' => 'hantera medlemmar',
        ],
    ],

    'leaderboard' => [
        'global_rank' => 'Global rang',
    ],

    'members' => [
        'destroy' => [
            'success' => 'Lagmedlem borttagen',
        ],

        'index' => [
            'title' => 'Hantera medlemmar',

            'applications' => [
                'accept_confirm' => 'Lägga till användare :user i laget?',
                'created_at' => 'Begärt vid',
                'empty' => 'Inga förfrågningar om anslutning för tillfället.',
                'empty_slots' => 'Tillgängliga platser',
                'empty_slots_overflow' => ':count_delimited användaröverflöde|:count_delimited användaröverflöde',
                'reject_confirm' => 'Avvisa anslutningsbegäran från användare :user?',
                'title' => 'Anslutningsförfrågningar',
            ],

            'table' => [
                'joined_at' => 'Anslutningsdatum',
                'remove' => 'Ta bort ',
                'remove_confirm' => 'Ta bort användare :user från laget?',
                'set_leader' => 'Överför lag ledare',
                'set_leader_confirm' => 'Överför lag ledare till användare :user?',
                'status' => 'Status',
                'title' => 'Nuvarande medlemmar',
            ],

            'status' => [
                'status_0' => 'Inaktiv',
                'status_1' => 'Aktiv',
            ],
        ],

        'set_leader' => [
            'success' => 'Användare :user är nu lagledare.',
        ],
    ],

    'part' => [
        'ok' => 'Lämnade laget ;_;',
    ],

    'show' => [
        'bar' => [
            'chat' => 'Lagchatt',
            'destroy' => 'Upplös laget',
            'join' => 'Begär medlemskap',
            'join_cancel' => 'Avbryt Gå med',
            'part' => 'Lämna laget',
        ],

        'info' => [
            'created' => 'Bildades',
        ],

        'members' => [
            'members' => 'Lag medlemmar ',
            'owner' => 'Lag ledare ',
        ],

        'sections' => [
            'about' => 'Om oss!',
            'info' => 'Info',
            'members' => 'Medlemmar ',
        ],

        'statistics' => [
            'empty_slots' => '',
            'leader' => 'Lagledare ',
            'rank' => 'Rank',
        ],
    ],

    'store' => [
        'ok' => 'Lag skapat.',
    ],
];

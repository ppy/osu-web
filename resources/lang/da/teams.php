<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'applications' => [
        'accept' => [
            'ok' => 'Tilføjede bruger til teamet.',
        ],
        'destroy' => [
            'ok' => 'Annullerede tilmeldingsanmodning.',
        ],
        'reject' => [
            'ok' => 'Afviste tilmeldingsanmodning.',
        ],
        'store' => [
            'ok' => 'Anmodede om at deltage i hold.',
        ],
    ],

    'card' => [
        'members' => ':count_delimited medlem|:count_delimited medlemmer',
    ],

    'create' => [
        'submit' => 'Opret Team',

        'form' => [
            'name_help' => 'Dit teams navn. Navnet er permanent i øjeblikket.',
            'short_name_help' => 'Højst 4 tegn.',
            'title' => "Lad os oprette et nyt hold",
        ],

        'intro' => [
            'description' => "Spil sammen med eksisterende eller nye venner. Du er ikke i et team lige nu. Du kan melde dig ind i et team ved at besøge teamets side, eller lav dit eget team fra denne side.",
            'title' => 'Team!',
        ],
    ],

    'destroy' => [
        'ok' => 'Team fjernet.',
    ],

    'edit' => [
        'ok' => 'Indstillinger gemt.',
        'title' => 'Team-indstillinger',

        'description' => [
            'label' => 'Beskrivelse',
            'title' => 'Team-beskrivelse',
        ],

        'flag' => [
            'label' => 'Hold Flag',
            'title' => 'Angiv Hold Flag',
        ],

        'header' => [
            'label' => 'Headerbillede',
            'title' => 'Angiv Headerbillede',
        ],

        'settings' => [
            'application_help' => 'Om folk skal kunne ansøge om at blive en del af holdet',
            'default_ruleset_help' => 'Regelsættet som vælgæes som standard, når holdsiden besøges',
            'flag_help' => 'Maksimum størrelse af :width×:height',
            'header_help' => 'Maksimum størrelse af :width×:height',
            'title' => 'Holdindstillinger',

            'application_state' => [
                'state_0' => 'Lukket',
                'state_1' => 'Åben',
            ],
        ],
    ],

    'header_links' => [
        'edit' => 'indstillinger',
        'leaderboard' => 'rangliste',
        'show' => 'info',

        'members' => [
            'index' => 'administrér medlemmer',
        ],
    ],

    'leaderboard' => [
        'global_rank' => 'Global Rang',
    ],

    'members' => [
        'destroy' => [
            'success' => 'Holdmedlem fjernet',
        ],

        'index' => [
            'title' => 'Administrér Medlemmer',

            'applications' => [
                'accept_confirm' => 'Tilføj brugeren :user til holdet?',
                'created_at' => 'Ansøgt Ved',
                'empty' => 'Ingen tilmeldningsanmodninger i øjeblikket.',
                'empty_slots' => 'Tilgængelige pladser',
                'empty_slots_overflow' => ':count_delimited bruger opfyldt|:count_delimited brugere opfyldt',
                'reject_confirm' => 'Afvis tilmeldingsanmodning  fra :user?',
                'title' => 'Deltageranmodning',
            ],

            'table' => [
                'joined_at' => 'Tilmeldingsdato',
                'remove' => 'Fjern',
                'remove_confirm' => 'Fjern brugeren :user fra teamet?',
                'set_leader' => 'Overfør holdlederskab',
                'set_leader_confirm' => 'Overfør holdlederskab til brugeren :user?',
                'status' => 'Status',
                'title' => 'Nuværende Medlemmer',
            ],

            'status' => [
                'status_0' => 'Inaktive',
                'status_1' => 'Aktive',
            ],
        ],

        'set_leader' => [
            'success' => 'Brugeren :user er nu holdlederen.',
        ],
    ],

    'part' => [
        'ok' => 'Forlod holdet ;_;',
    ],

    'show' => [
        'bar' => [
            'chat' => 'Holdchat',
            'destroy' => 'Opløs Hold',
            'join' => 'Anmod om at deltage',
            'join_cancel' => 'Annullér Deltagelse',
            'part' => 'Forlad Hold',
        ],

        'info' => [
            'created' => 'Dannet',
        ],

        'members' => [
            'members' => 'Holdmedlemmer',
            'owner' => 'Holdleder',
        ],

        'sections' => [
            'about' => 'Om Os!',
            'info' => 'Info',
            'members' => 'Medlemmer',
        ],

        'statistics' => [
            'empty_slots' => ':count_delimited plads til rådighed|:count_delimited pladser til rådighed',
            'first_places' => 'Første plads',
            'leader' => 'Holdleder',
            'rank' => 'Rang',
            'ranked_beatmapsets' => 'Rangerede Beatmaps',
        ],
    ],

    'store' => [
        'ok' => 'Hold oprettet.',
    ],
];

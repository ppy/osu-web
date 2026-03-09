<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'applications' => [
        'accept' => [
            'ok' => 'Pridėti vartotoją į komandą.',
        ],
        'destroy' => [
            'ok' => 'Atšauktas prisijungimo prašymas.',
        ],
        'reject' => [
            'ok' => 'Atmestas prisijungimo prašymas.',
        ],
        'store' => [
            'ok' => 'Prašoma leisti prisijungti prie komandos.',
        ],
    ],

    'card' => [
        'members' => ':count_delimited narys|:count_delimited narių',
    ],

    'create' => [
        'submit' => 'Sukurti Komanda',

        'form' => [
            'name_help' => 'Jūsų komandos pavadinimas. Kol kas pavadinimas negalės buti pakeistas.',
            'short_name_help' => 'Daugiausiai 4 simboliai.',
            'title' => "Sukurkime naują komandą",
        ],

        'intro' => [
            'description' => "Žaiskite su draugais, dabartiniais ar naujais. Jus šiuo metu ne esate jokioje komandoje. Prisijunkite prie egzistuojančios komandos aplankydami jų komandos puslapį arba sukurkite savo komanda šiame puslapyje.",
            'title' => 'Komanda!',
        ],
    ],

    'destroy' => [
        'ok' => 'Komanda pašalinta.',
    ],

    'edit' => [
        'ok' => 'Nustatymai sėkmingai išsaugoti.',
        'title' => 'Komandos Nustatymai',

        'description' => [
            'label' => 'Aprašymas',
            'title' => 'Komandos Aprašymas',
        ],

        'flag' => [
            'label' => 'Komandos Vėliava',
            'title' => 'Nustatyti Komandos Vėliavą',
        ],

        'header' => [
            'label' => 'Antraštės Paveikslėlis',
            'title' => 'Nustatyti Antraštės Paveikslėlį',
        ],

        'settings' => [
            'application_help' => 'Ar leisti žmonėms pateikti prisijungimo prie komandos prašymą',
            'default_ruleset_help' => 'Šis rėžimas pasirenkamas automatiškai kai aplankomas komandos puslapis',
            'flag_help' => 'Didžiausias galimas dydis :width×:height',
            'header_help' => 'Didžiausias galimas dydis :width×:height',
            'title' => 'Komandos Nustatymai',

            'application_state' => [
                'state_0' => 'Uždara',
                'state_1' => 'Atvira',
            ],
        ],
    ],

    'header_links' => [
        'edit' => 'nustatymai',
        'leaderboard' => 'rezultatų lenta',
        'show' => 'info',

        'members' => [
            'index' => 'tvarkyti narius',
        ],
    ],

    'leaderboard' => [
        'global_rank' => 'Pasaulinis Reitingas',
    ],

    'members' => [
        'destroy' => [
            'success' => 'Komandos narys pašalintas',
        ],

        'index' => [
            'title' => 'Tvarkyti Narius',

            'applications' => [
                'accept_confirm' => 'Pridėti vartotoją :user į komandą?',
                'created_at' => 'Prašyta',
                'empty' => 'Nėra šiuo metu prisijungimo prašymų.',
                'empty_slots' => 'Laisvos vietos',
                'empty_slots_overflow' => ':count_delimited vartotojų perteklius|:count_delimited vartotojų perteklius',
                'reject_confirm' => 'Atmesti vartotojo :user prisijungimo prašymą?',
                'title' => 'Prisijungimo Prašymai',
            ],

            'table' => [
                'joined_at' => 'Prisijungė',
                'remove' => 'Pašalinti',
                'remove_confirm' => 'Pašalinti vartotoją :user iš komandos?',
                'set_leader' => 'Perleisti komandos vadovavimą',
                'set_leader_confirm' => 'Perleisti komandos vadovavimą vartotojui :user?',
                'status' => 'Būsena',
                'title' => 'Dabartiniai Nariai',
            ],

            'status' => [
                'status_0' => 'Neaktyvus',
                'status_1' => 'Aktyvus',
            ],
        ],

        'set_leader' => [
            'success' => 'Vartotojoas :user tapo komandos vadovų.',
        ],
    ],

    'part' => [
        'ok' => 'Paliko komandą ;_;',
    ],

    'show' => [
        'bar' => [
            'chat' => 'Komandos Pokalbiai',
            'destroy' => 'Išardyti Komandą',
            'join' => 'Prisijungimo Prašymas',
            'join_cancel' => 'Atšaukti Prisijungimą',
            'part' => 'Palikti Komandą',
        ],

        'info' => [
            'created' => 'Sukurta',
        ],

        'members' => [
            'members' => 'Komandos Nariai',
            'owner' => 'Komandos Vadovas',
        ],

        'sections' => [
            'about' => 'Apie Mus!',
            'info' => 'Info',
            'members' => 'Nariai',
        ],

        'statistics' => [
            'empty_slots' => ':count_delimited laisva vieta|:count_delimited laisvų vietų',
            'first_places' => '',
            'leader' => 'Komandos Vadovas',
            'rank' => 'Reitingas',
            'ranked_beatmapsets' => '',
        ],
    ],

    'store' => [
        'ok' => 'Komanda sukurta.',
    ],
];

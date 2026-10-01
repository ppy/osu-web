<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'applications' => [
        'accept' => [
            'ok' => 'Používateľ pridaný do tímu.',
        ],
        'destroy' => [
            'ok' => 'Žiadosť o pripojenie zrušená.',
        ],
        'reject' => [
            'ok' => 'Žiadosť o pripojenie zamietnutá.',
        ],
        'store' => [
            'ok' => 'Požiadal si o pripojenie k tímu.',
        ],
    ],

    'card' => [
        'members' => ':count_delimited člen|:count_delimited členovia',
    ],

    'create' => [
        'submit' => 'Vytvoriť tím',

        'form' => [
            'name_help' => 'Meno tvojho tímu. Meno je na teraz permanentné.',
            'short_name_help' => 'Najviac 4 znaky.',
            'title' => "Poďme založiť nový tím",
        ],

        'intro' => [
            'description' => "Hraj spolu s priateľmi: existujúci alebo noví. Nie si v tíme. Pripoj sa do :search_link navštívením ich tímovej stránky alebo si vytvor svoj vlastný tím na tejto stránke.",
            'search_link' => 'existujúceho tímu',
            'title' => 'Tím!',
        ],
    ],

    'destroy' => [
        'ok' => 'Tím vymazaný.',
    ],

    'edit' => [
        'ok' => 'Nastavenia úspešne uložené.',
        'title' => 'Nastavenia tímu',

        'description' => [
            'label' => 'Popis',
            'title' => 'Popis tímu',
        ],

        'flag' => [
            'label' => 'Vlajka tímu',
            'title' => 'Nastaviť vlajku tímu',
        ],

        'header' => [
            'label' => 'Obrázok v hlavičke',
            'title' => 'Nastaviť obrázok v hlavičke',
        ],

        'settings' => [
            'application_help' => 'Povoliť používateľom požiadať o pripojenie do tímu',
            'default_ruleset_help' => 'Herný mód ktorý sa používa ako predvolená pri návšteve stránky tímu',
            'flag_help' => 'Maximálna veľkosť :width×:height',
            'header_help' => 'Maximálna veľkosť :width×:height',
            'title' => 'Nastavenia tímu',

            'application_state' => [
                'state_0' => 'Zavreté',
                'state_1' => 'Otvorené',
            ],
        ],
    ],

    'header_links' => [
        'edit' => 'nastavenia',
        'leaderboard' => 'rebríček',
        'show' => 'info',

        'members' => [
            'index' => 'spravovať členov',
        ],
    ],

    'leaderboard' => [
        'global_rank' => 'Globálne Umiestnenie',
    ],

    'members' => [
        'destroy' => [
            'success' => 'Člen tímu odstránený',
        ],

        'index' => [
            'title' => 'Spravovať Členov',

            'applications' => [
                'accept_confirm' => 'Pridať používateľa :user do tímu?',
                'created_at' => 'Vyžiadané',
                'empty' => 'Žiadne žiadosti o pripojenie.',
                'empty_slots' => 'Volné miesta',
                'empty_slots_overflow' => ':count_delimited používateľ navyše|:count_delimited používateľov navyše',
                'reject_confirm' => 'Odmietnuť žiadosť o pripojenie od používateľa :user?',
                'title' => 'Žiadosti o Pripojenie',
            ],

            'table' => [
                'joined_at' => 'Dátum Pripojenia',
                'remove' => 'Odstrániť',
                'remove_confirm' => 'Odstrániť používateľa :user z tímu?',
                'set_leader' => 'Presunúť vedenie tímu',
                'set_leader_confirm' => 'Presunúť vedenie tímu používateľovi :user?',
                'status' => 'Status',
                'title' => 'Členovia',
            ],

            'status' => [
                'status_0' => 'Neaktívny',
                'status_1' => 'Aktívny',
            ],
        ],

        'set_leader' => [
            'success' => 'Používateľ :user je teraz veliteľ tímu.',
        ],
    ],

    'part' => [
        'ok' => 'Odišiel si z tímu ;_;',
    ],

    'show' => [
        'bar' => [
            'chat' => 'Tímový Chat',
            'destroy' => 'Rozpustiť Tím',
            'join' => 'Požiadať o Pripojenie',
            'join_cancel' => 'Zrušiť Pripojenie',
            'part' => 'Odísť z Tímu',
        ],

        'info' => [
            'created' => 'Vytvorený',
        ],

        'members' => [
            'members' => 'Členovia Tímu',
            'owner' => 'Veliteľ Tímu',
        ],

        'sections' => [
            'about' => 'O Nás!',
            'info' => 'Info',
            'members' => 'Členovia',
        ],

        'statistics' => [
            'empty_slots' => ':count_delimited miesto volné|:count_delimited voľných miest',
            'first_places' => 'Prvé miesta',
            'leader' => 'Veliteľ Tímu',
            'rank' => 'Umiestnenie',
            'ranked_beatmapsets' => 'Hodnotené beatmapy',
        ],
    ],

    'store' => [
        'ok' => 'Tím vytvorený.',
    ],
];

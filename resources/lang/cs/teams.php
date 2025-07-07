<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'applications' => [
        'accept' => [
            'ok' => 'Uživatel byl přidán do týmu.',
        ],
        'destroy' => [
            'ok' => 'Žádost o připojení byla zrušena.',
        ],
        'reject' => [
            'ok' => 'Žádost o připojení byla zamítnuta.',
        ],
        'store' => [
            'ok' => 'Požádáno o připojení k týmu.',
        ],
    ],

    'card' => [
        'members' => ':count_delimited člen|:count_delimited členové|:count_delimited členů',
    ],

    'create' => [
        'submit' => 'Vytvořit tým',

        'form' => [
            'name_help' => 'Jméno tvého týmu. Toto jméno je v tuto chvíli trvalé.',
            'short_name_help' => 'Maximálně 4 znaky.',
            'title' => "Pojďme vytvořit nový tým",
        ],

        'intro' => [
            'description' => "Hraj společně s přáteli; existujícími nebo novými. V současné době nejsi v týmu. Připoj se k existujícímu týmu navštívením jejich týmové stránky nebo vytvoř svůj vlastní tým na této stránce.",
            'title' => 'Tým!',
        ],
    ],

    'destroy' => [
        'ok' => 'Tým odebrán',
    ],

    'edit' => [
        'ok' => 'Nastavení byla úspěšně uložena.',
        'title' => 'Nastavení týmu',

        'description' => [
            'label' => 'Popis',
            'title' => 'Popis týmu',
        ],

        'flag' => [
            'label' => 'Vlajka týmu',
            'title' => 'Nastavit vlajku týmu',
        ],

        'header' => [
            'label' => 'Obrázek záhlaví',
            'title' => 'Nastavit obrázek záhlaví',
        ],

        'settings' => [
            'application_help' => 'Zdali umožnit lidem, aby mohli podávat přihlášky do týmu',
            'default_ruleset_help' => 'Ruleset, který má být automaticky vybrán při návštěvě stránky týmu',
            'flag_help' => 'Maximální velikost :width×:height',
            'header_help' => 'Maximální velikost :width×:height',
            'title' => 'Nastavení týmu',

            'application_state' => [
                'state_0' => 'Zavřené',
                'state_1' => 'Otevřené',
            ],
        ],
    ],

    'header_links' => [
        'edit' => 'nastavení',
        'leaderboard' => 'žebříček',
        'show' => 'info',

        'members' => [
            'index' => 'spravovat členy',
        ],
    ],

    'leaderboard' => [
        'global_rank' => 'Globální umístění',
    ],

    'members' => [
        'destroy' => [
            'success' => 'Člen týmu byl odebrán',
        ],

        'index' => [
            'title' => 'Spravovat členy',

            'applications' => [
                'accept_confirm' => 'Přidat uživatele :user do týmu?',
                'created_at' => 'Žádost vytvořena',
                'empty' => 'Momentálně nemáte žádné žádosti o připojení.',
                'empty_slots' => 'Dostupná místa',
                'empty_slots_overflow' => ':count_delimited uživatel nad limit|:count_delimited uživatelé nad limit|:count_delimited uživatelů nad limit',
                'reject_confirm' => 'Odmítnout žádost o připojení od uživatele :user?',
                'title' => 'Žádosti o připojení',
            ],

            'table' => [
                'joined_at' => 'Členem od',
                'remove' => 'Odebrat',
                'remove_confirm' => 'Odebrat uživatele :user z týmu?',
                'set_leader' => 'Převést vedení týmu',
                'set_leader_confirm' => 'Převést vedení týmu na uživatele :user?',
                'status' => 'Stav',
                'title' => 'Aktuální členové',
            ],

            'status' => [
                'status_0' => 'Neaktivní',
                'status_1' => 'Aktivní',
            ],
        ],

        'set_leader' => [
            'success' => 'Uživatel :user je nyní vedoucím týmu.',
        ],
    ],

    'part' => [
        'ok' => 'Opustil jsi tento tým ;_;',
    ],

    'show' => [
        'bar' => [
            'chat' => 'Týmový chat',
            'destroy' => 'Rozpustit tým',
            'join' => 'Požádat o připojení',
            'join_cancel' => 'Zrušit žádost',
            'part' => 'Opustit tým',
        ],

        'info' => [
            'created' => 'Založen',
        ],

        'members' => [
            'members' => 'Členové týmu',
            'owner' => 'Vedoucí týmu',
        ],

        'sections' => [
            'about' => 'O nás!',
            'info' => 'Info',
            'members' => 'Členové',
        ],

        'statistics' => [
            'rank' => 'Umístění',
            'leader' => 'Vedoucí týmu',
        ],
    ],

    'store' => [
        'ok' => 'Tým vytvořen.',
    ],
];

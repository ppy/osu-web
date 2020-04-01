<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'authorizations' => [
        'update' => [
            'null_user' => 'K upravování musíte být přihlášeni.',
            'system_generated' => 'Systémově generované příspěvky nemohou být upravovány.',
            'wrong_user' => 'Pro upravování musíte být vlastníkem příspěvku.',
        ],
    ],

    'events' => [
        'empty' => 'Nic se nestalo... zatím.',
    ],

    'index' => [
        'deleted_beatmap' => 'odstraněno',
        'none_found' => 'Nenalezeny žádné diskuze, odpovídající zadaným požadavkům.',
        'title' => 'Diskuze o beatmapě',

        'form' => [
            '_' => 'Hledat',
            'deleted' => 'Zahrnout smazané diskuze',
            'only_unresolved' => '',
            'types' => 'Typy zpráv',
            'username' => 'Uživatelské jméno',

            'beatmapset_status' => [
                '_' => 'Stav Beatmapy',
                'all' => 'Všechny',
                'disqualified' => 'Diskvalifikovaný',
                'never_qualified' => '',
                'qualified' => 'Kvalifikovaný',
                'ranked' => 'Hodnocené',
            ],

            'user' => [
                'label' => 'Uživatel',
                'overview' => 'Přehled činností',
            ],
        ],
    ],

    'item' => [
        'created_at' => 'Datum zveřejnění',
        'deleted_at' => 'Datum odstranění',
        'message_type' => 'Typ',
        'permalink' => 'Trvalý odkaz',
    ],

    'nearby_posts' => [
        'confirm' => 'Žádný z příspěvků neřeší mé obavy',
        'notice' => 'Poblíž :timestamp (:existing_timestamps) se už nějaké příspěvky nacházejí. Prosím zkontroluj je před zveřejněním tvého přispěvku.',
    ],

    'reply' => [
        'open' => [
            'guest' => 'Pro přidání odpovědi se musíš přihlásit',
            'user' => 'Odpovědět',
        ],
    ],

    'review' => [
        'go_to_parent' => '',
        'go_to_child' => 'Zobrazit diskuzi',
        'validation' => [
            'invalid_block_type' => '',
            'invalid_document' => '',
            'minimum_issues' => '',
            'missing_text' => '',
            'too_many_blocks' => '',
        ],
    ],

    'system' => [
        'resolved' => [
            'true' => 'Označeno jako vyřešeno uživatelem :user',
            'false' => 'Znovu otevřeno uživatelem :user',
        ],
    ],

    'timestamp_display' => [
        'general' => 'obecné',
        'general_all' => '',
    ],

    'user_filter' => [
        'everyone' => 'Všichni',
        'label' => 'Filtrovat podle uživatele',
    ],
];

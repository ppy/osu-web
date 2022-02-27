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
            'mode' => 'Režim beatmapy',
            'only_unresolved' => 'Ukaž pouze nerozluštěné diskuze',
            'types' => 'Typy zpráv',
            'username' => 'Uživatelské jméno',

            'beatmapset_status' => [
                '_' => 'Stav Beatmapy',
                'all' => 'Všechny',
                'disqualified' => 'Diskvalifikovaný',
                'never_qualified' => 'Nikdy nekvalifikované',
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
        'unsaved' => ':count v této recenzi',
    ],

    'owner_editor' => [
        'button' => 'Vlastník obtížnosti',
        'reset_confirm' => 'Resetovat vlastníka pro tuto obtížnost?',
        'user' => 'Vlastník',
        'version' => 'Obtížnost',
    ],

    'reply' => [
        'open' => [
            'guest' => 'Pro přidání odpovědi se musíš přihlásit',
            'user' => 'Odpovědět',
        ],
    ],

    'review' => [
        'block_count' => ':used z :max bloků použito',
        'go_to_parent' => 'Zobrazit příspěvek recenze',
        'go_to_child' => 'Zobrazit diskuzi',
        'validation' => [
            'block_too_large' => 'každý blok může obsahovat maximálně :limit znaků',
            'external_references' => 'recenze obsahuje odkazy na problémy, které nepatří do této recenze',
            'invalid_block_type' => 'neplatný typ bloku',
            'invalid_document' => 'neplatná recenze',
            'invalid_discussion_type' => 'neplatný typ diskuze',
            'minimum_issues' => 'recenze musí obsahovat minimálně :count problém|recenze musí obsahovat minimálně :count problémů',
            'missing_text' => 'bloku chybí text',
            'too_many_blocks' => 'recenze mohou obsahovat pouze :count odstavec/problém|recenze mohou obsahovat pouze :count odstavců/problémů',
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
        'general_all' => 'obecné (všechny)',
    ],

    'user_filter' => [
        'everyone' => 'Všichni',
        'label' => 'Filtrovat podle uživatele',
    ],
];

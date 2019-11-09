<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
 */

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
        'title' => 'Diskuze o beatmapě',

        'form' => [
            '_' => 'Hledat',
            'deleted' => 'Zahrnout smazané diskuze',
            'only_unresolved' => '',
            'types' => 'Typy zpráv',
            'username' => 'Uživatelské jméno',

            'beatmapset_status' => [
                '_' => '',
                'all' => '',
                'disqualified' => '',
                'never_qualified' => '',
                'qualified' => '',
                'ranked' => '',
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

    'system' => [
        'resolved' => [
            'true' => 'Označeno jako vyřešeno uživatelem :user',
            'false' => 'Znovu otevřeno uživatelem :user',
        ],
    ],

    'user_filter' => [
        'everyone' => 'Všichni',
        'label' => 'Filtrovat podle uživatele',
    ],
];

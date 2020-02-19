<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
 *
 *    This file is part of osu!web. osu!web is distributed with the hope of
 *    attracting more community contributions to the core ecosystem of osu!.
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License version 3
 *    as published by the Free Software Foundation.
 *
 *    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
 *    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *    See the GNU Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public License
 *    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
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
        'go_to_child' => '',
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

<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'authorizations' => [
        'update' => [
            'null_user' => 'Pre úpravu musíte byť prihlásený.',
            'system_generated' => 'Príspevky generované systémom nemôžu byť upravené.',
            'wrong_user' => 'Aby ste mohli upraviť príspevok, musíte byť jeho vlastníkom.',
        ],
    ],

    'events' => [
        'empty' => 'Nič sa nestalo... zatiaľ.',
    ],

    'index' => [
        'deleted_beatmap' => 'odstránené',
        'none_found' => 'Nenašli sa žiadne diskusie, zodpovedajúci zadaným požiadavkám.',
        'title' => 'Diskusie ohľadom Beatmapy',

        'form' => [
            '_' => 'Hľadať',
            'deleted' => 'Zahrnúť odstránené diskusie',
            'mode' => '',
            'only_unresolved' => 'Ukázať iba nevyriešené diskusie',
            'types' => 'Typy správ',
            'username' => 'Meno Uživateľa',

            'beatmapset_status' => [
                '_' => 'Status beatmapy',
                'all' => 'Všetko',
                'disqualified' => 'Diskvalifikovaný',
                'never_qualified' => 'Nikdy kvalifikovaný',
                'qualified' => 'Kvalifikovaný',
                'ranked' => 'Hodnotené',
            ],

            'user' => [
                'label' => 'Používateľ',
                'overview' => 'Prehľad aktivity',
            ],
        ],
    ],

    'item' => [
        'created_at' => 'Dátum príspevku',
        'deleted_at' => 'Dátum odstránenia',
        'message_type' => 'Typ',
        'permalink' => 'Trvalý odkaz',
    ],

    'nearby_posts' => [
        'confirm' => 'Žiadny z príspevkov nerieši môj problém',
        'notice' => 'Príspevky okolo času :timestamp (:existing_timestamps) už existujú. Prosím, skontrolujte ich pred prispievaním.',
        'unsaved' => '',
    ],

    'owner_editor' => [
        'button' => '',
        'reset_confirm' => '',
        'user' => '',
        'version' => '',
    ],

    'reply' => [
        'open' => [
            'guest' => 'Prosím, prihláste sa, aby ste mohli odpovedať',
            'user' => 'Odpoveď',
        ],
    ],

    'review' => [
        'block_count' => '',
        'go_to_parent' => 'Zobraziť recenziu',
        'go_to_child' => 'Nová diskusia',
        'validation' => [
            'block_too_large' => '',
            'external_references' => '',
            'invalid_block_type' => 'neplatný typ bloku',
            'invalid_document' => 'neplatná recenzia',
            'minimum_issues' => 'kontrola musí obsahovať minimálne :count problémov|kontrola musí obsahovať minimálne :count problémov',
            'missing_text' => 'v bloku nie je žiadny text',
            'too_many_blocks' => 'recenzie môžu obsahovať iba :count odsekov/vydaní|recenzie môžu obsahovať iba :count odsekov/čísel',
        ],
    ],

    'system' => [
        'resolved' => [
            'true' => 'Označené ako vyriešené uživateľom :user',
            'false' => 'Znovu otvorené uživateľom :user',
        ],
    ],

    'timestamp_display' => [
        'general' => 'všeobecné',
        'general_all' => 'všeobecné (všetky)',
    ],

    'user_filter' => [
        'everyone' => 'Ktokoľvek',
        'label' => 'Filtrovať podľa užívateľa',
    ],
];

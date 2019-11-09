<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
 */

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
        'title' => 'Diskusie ohľadom Beatmapy',

        'form' => [
            '_' => 'Hľadať',
            'deleted' => 'Zahrnúť odstránené diskusie',
            'types' => 'Typy správ',
            'username' => 'Meno Uživateľa',

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
    ],

    'reply' => [
        'open' => [
            'guest' => 'Prosím, prihláste sa, aby ste mohli odpovedať',
            'user' => 'Odpoveď',
        ],
    ],

    'system' => [
        'resolved' => [
            'true' => 'Označené ako vyriešené uživateľom :user',
            'false' => 'Znovu otvorené uživateľom :user',
        ],
    ],

    'user' => [
        'admin' => 'administrátor',
        'bng' => 'nominátor',
        'owner' => 'mapper',
    ],

    'user_filter' => [
        'everyone' => 'Ktokoľvek',
        'label' => 'Filtrovať podľa užívateľa',
    ],
];

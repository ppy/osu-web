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

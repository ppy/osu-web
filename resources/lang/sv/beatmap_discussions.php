<?php

/**
 *    Copyright 2015-2017 ppy Pty. Ltd.
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
            'null_user' => 'Måste vara inloggad för att redigera.',
            'system_generated' => 'System-genererade inlägg kan inte redigeras.',
            'wrong_user' => 'Måste vara ägare av inlägget för att redigera.',
        ],
    ],

    'events' => [
        'empty' => 'Inget har hänt... än.',
    ],

    'nearby_posts' => [
        'confirm' => 'Inga av dessa inlägg har med mig att göra',
        'notice' => 'Dessa är inlägg runt :timestamp (:existing_timestamps). Var vänlig kontrollera innan du lägger upp ett inlägg.',
    ],

    'reply' => [
        'open' => [
            'guest' => 'Logga in för att svara',
            'user' => 'Svara',
        ],
    ],

    'system' => [
        'resolved' => [
            'true' => 'Markerad som löst av :user',
            'false' => 'Öppnad igen av :user',
        ],
    ],

    'user' => [
        'admin' => 'admin',
        'bng' => 'nominerade',
        'owner' => 'mapper',
        'qat' => 'qat',
    ],
];

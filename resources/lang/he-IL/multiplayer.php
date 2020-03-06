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
    'match' => [
        'beatmap-deleted' => 'מפה שנמחקה',
        'difference' => 'על ידי :difference',
        'failed' => 'נכשל',
        'header' => 'משחקים מרובי משתתפים',
        'in-progress' => '(משחק בתהליך)',
        'in_progress_spinner_label' => 'משחק בתהליך',
        'loading-events' => 'טוען אירועים...',
        'winner' => ':team ניצחו',

        'events' => [
            'player-left' => ':user עזב את המשחק',
            'player-joined' => ':user הצטרף למשחק',
            'player-kicked' => ':user נבעט מהמשחק',
            'match-created' => ':user יצר את המשחק',
            'match-disbanded' => 'המשחק פורק',
            'host-changed' => ':user נהיה המארח',

            'player-left-no-user' => 'שחקן עזב את המשחק',
            'player-joined-no-user' => 'שחקן הצטרף למשחק',
            'player-kicked-no-user' => 'שחקן נבעט מהמשחק',
            'match-created-no-user' => 'המשחק נוצר',
            'match-disbanded-no-user' => 'המשחק פורק',
            'host-changed-no-user' => 'המארח השתנה',
        ],

        'score' => [
            'stats' => [
                'accuracy' => 'דיוק',
                'combo' => 'רצף',
                'score' => 'תוצאה',
            ],
        ],

        'team-types' => [
            'head-to-head' => 'ראש בראש',
            'tag-coop' => 'משחק משותף',
            'team-vs' => 'קבוצות',
            'tag-team-vs' => 'משחק משותף קבוצות',
        ],

        'teams' => [
            'blue' => 'קבוצה כחולה',
            'red' => 'קבוצה אדומה',
        ],
    ],
    'game' => [
        'scoring-type' => [
            'score' => 'התוצאה הכי גבוהה',
            'accuracy' => 'הדיוק הכי גבוה',
            'combo' => 'הרצף הכי גבוה',
            'scorev2' => 'תוצאה V2',
        ],
    ],
];

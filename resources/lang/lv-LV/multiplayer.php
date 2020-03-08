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
        'beatmap-deleted' => '',
        'difference' => '',
        'failed' => '',
        'header' => '',
        'in-progress' => '',
        'in_progress_spinner_label' => '',
        'loading-events' => '',
        'winner' => '',

        'events' => [
            'player-left' => '',
            'player-joined' => '',
            'player-kicked' => '',
            'match-created' => '',
            'match-disbanded' => '',
            'host-changed' => '',

            'player-left-no-user' => 'spēlētājs pameta maču',
            'player-joined-no-user' => 'spēlētājs pievienojās mačam',
            'player-kicked-no-user' => 'spēlētājs tika izraidīts no mača',
            'match-created-no-user' => 'mačs tika izveidots',
            'match-disbanded-no-user' => '',
            'host-changed-no-user' => '',
        ],

        'score' => [
            'stats' => [
                'accuracy' => 'Precizitāte',
                'combo' => '',
                'score' => '',
            ],
        ],

        'team-types' => [
            'head-to-head' => '',
            'tag-coop' => '',
            'team-vs' => '',
            'tag-team-vs' => '',
        ],

        'teams' => [
            'blue' => 'Zilā Komanda',
            'red' => 'Sarkanā Komanda',
        ],
    ],
    'game' => [
        'scoring-type' => [
            'score' => '',
            'accuracy' => 'Augstākā Precizitāte',
            'combo' => 'Augstākais Kombo',
            'scorev2' => '',
        ],
    ],
];

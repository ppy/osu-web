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
        'beatmap-deleted' => 'deleted beatmap',
        'difference' => 'by :difference',
        'failed' => 'FAILED',
        'header' => 'Multi Matches',
        'in-progress' => '(match in progress)',
        'in_progress_spinner_label' => 'match in progress',
        'loading-events' => 'Loading events...',
        'winner' => ':team wins',

        'events' => [
            'player-left' => ':user left the match',
            'player-joined' => ':user joined the match',
            'player-kicked' => ':user has been kicked from the match',
            'match-created' => ':user created the match',
            'match-disbanded' => 'the match was disbanded',
            'host-changed' => ':user became the host',

            'player-left-no-user' => 'a player left the match',
            'player-joined-no-user' => 'a player joined the match',
            'player-kicked-no-user' => 'a player has been kicked from the match',
            'match-created-no-user' => 'the match was created',
            'match-disbanded-no-user' => 'the match was disbanded',
            'host-changed-no-user' => 'the host was changed',
        ],

        'score' => [
            'stats' => [
                'accuracy' => 'Accuracy',
                'combo' => 'Combo',
                'score' => 'Score',
            ],
        ],

        'team-types' => [
            'head-to-head' => 'Head-to-head',
            'tag-coop' => 'Tag Co-op',
            'team-vs' => 'Team VS',
            'tag-team-vs' => 'Tag Team VS',
        ],

        'teams' => [
            'blue' => 'Blue Team',
            'red' => 'Red Team',
        ],
    ],
    'game' => [
        'scoring-type' => [
            'score' => 'Highest Score',
            'accuracy' => 'Highest Accuracy',
            'combo' => 'Highest Combo',
            'scorev2' => 'Score V2',
        ],
    ],
];

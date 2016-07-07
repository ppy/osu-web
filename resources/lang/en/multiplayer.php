<?php

/**
 *    Copyright 2016 ppy Pty. Ltd.
 *
 *    This file is part of osu!web. osu!web is distributed in the hopes of
 *    attracting more community contributions to the core ecosystem of osu!
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
        'header' => 'Multiplayer Matches',
        'team-types' => [
            'head-to-head' => 'Head-to-head',
            'tag-coop' => 'Tag Co-op',
            'team-vs' => 'Team VS',
            'tag-team-vs' => 'Tag Team VS',
        ],
        'events' => [
            'player-left' => 'left the match',
            'player-joined' => 'joined the match',
            'played-kicked' => 'has been kicked from the match',
            'match-created' => 'created the match',
            'match-disbanded' => 'the match was disbanded',
            'host-changed' => 'became the host',
        ],
        'in-progress' => '(match in progress)',
        'score' => [
            'stats' => [
                'combo' => 'Combo',
                'accuracy' => 'Accuracy',
                'score' => 'Score',
                'countgeki' => 'MAX',
                'count300' => '300s',
                'countkatu' => '200s',
                'count100' => '100s',
                'count50' => '50s',
                'countmiss' => 'Miss',
            ],
        ],
        'failed' => 'FAILED',
        'teams' => [
            'blue' => 'Team Blue',
            'red' => 'Team Red',
        ],
        'winner' => ':team wins',
        'difference' => 'by :difference',
        'loading-events' => 'Loading events...',
        'more-events' => 'view all...',
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

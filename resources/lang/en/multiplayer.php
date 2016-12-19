<?php
/**
 *    Copyright 2015-2016 ppy Pty. Ltd.
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
            'player-left' => ':user left the match',
            'player-joined' => ':user joined the match',
            'player-kicked' => ':user has been kicked from the match',
            'match-created' => ':user created the match',
            'match-disbanded' => ':the match was disbanded',
            'host-changed' => ':user became the host',
            'player-left-no-user' => 'a player left the match',
            'player-joined-no-user' => 'a player joined the match',
            'player-kicked-no-user' => 'a player has been kicked from the match',
            'match-created-no-user' => 'the match was created',
            'match-disbanded-no-user' => 'the match was disbanded',
            'host-changed-no-user' => 'the host was changed',
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
            'blue' => 'Blue Team',
            'red' => 'Red Team',
        ],
        'winner' => ':team wins',
        'difference' => 'by :difference',
        'loading-events' => 'Loading events...',
        'more-events' => 'view all...',
        'beatmap-deleted' => 'deleted beatmap',
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

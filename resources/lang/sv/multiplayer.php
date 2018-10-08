<?php

/**
 *    Copyright 2015-2018 ppy Pty. Ltd.
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
        'beatmap-deleted' => 'raderad beatmap',
        'difference' => 'med :difference',
        'failed' => 'MISSLYCKADES',
        'header' => 'Multiplayer Matcher',
        'in-progress' => '(pågående match)',
        'in_progress_spinner_label' => 'matchen är pågående',
        'loading-events' => 'Laddar händelser...',
        'winner' => ':team vann',

        'events' => [
            'player-left' => ':user lämnade spelet',
            'player-joined' => ':user gick med i spelet',
            'player-kicked' => ':user har blivit kickad från spelet',
            'match-created' => ':user skapade spelet',
            'match-disbanded' => 'spelet upplöstes',
            'host-changed' => ':user blev värd',

            'player-left-no-user' => 'en spelare lämnade spelet',
            'player-joined-no-user' => 'en spelare gick med i spelet',
            'player-kicked-no-user' => 'en spelare har blivit kickad från spelet',
            'match-created-no-user' => 'spelet skapades',
            'match-disbanded-no-user' => 'spelet upplöstes',
            'host-changed-no-user' => 'värden ändrades',
        ],

        'score' => [
            'stats' => [
                'accuracy' => 'Precision',
                'combo' => 'Kombo',
                'score' => 'Poäng',
            ],
        ],

        'team-types' => [
            'head-to-head' => 'Head-to-head',
            'tag-coop' => 'Tag Co-op',
            'team-vs' => 'Lag mot lag',
            'tag-team-vs' => 'Tag Lag VS',
        ],

        'teams' => [
            'blue' => 'Blått Lag',
            'red' => 'Rött Lag',
        ],
    ],
    'game' => [
        'scoring-type' => [
            'score' => 'Högsta Poäng',
            'accuracy' => 'Högsta Precision',
            'combo' => 'Högsta Kombo',
            'scorev2' => 'Score V2',
        ],
    ],
];

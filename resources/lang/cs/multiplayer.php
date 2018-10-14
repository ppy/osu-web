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
        'beatmap-deleted' => 'smazaná mapa',
        'difference' => 'o :difference',
        'failed' => 'SELHAL',
        'header' => 'Multiplayer zápasy',
        'in-progress' => '(zápas probíhá)',
        'in_progress_spinner_label' => 'probíhá zápas',
        'loading-events' => 'Načítání událostí...',
        'winner' => ':team vyhrává',

        'events' => [
            'player-left' => ':user opustil zápas',
            'player-joined' => ':user se připojil',
            'player-kicked' => ':user byl vyhozen ze zápasu',
            'match-created' => ':user vytvořil zápas',
            'match-disbanded' => 'zápas byl zrušen',
            'host-changed' => ':user se stal hostitelem zápasu',

            'player-left-no-user' => 'hráč opustil zápas',
            'player-joined-no-user' => 'hráč se připojil k zápasu',
            'player-kicked-no-user' => 'hráč byl ze zápasu vyhozen',
            'match-created-no-user' => 'zápas byl vytvořen',
            'match-disbanded-no-user' => 'zápas byl zrušen',
            'host-changed-no-user' => 'hostitel byl změněn',
        ],

        'score' => [
            'stats' => [
                'accuracy' => 'Přesnost',
                'combo' => 'Combo',
                'score' => 'Skóre',
            ],
        ],

        'team-types' => [
            'head-to-head' => 'Head-to-head',
            'tag-coop' => 'Tag Co-op',
            'team-vs' => 'Team VS',
            'tag-team-vs' => 'Tag Team VS',
        ],

        'teams' => [
            'blue' => 'Modrý tým',
            'red' => 'Červený tým',
        ],
    ],
    'game' => [
        'scoring-type' => [
            'score' => 'Nejvyšší skóre',
            'accuracy' => 'Nejvyšší přesnost',
            'combo' => 'Nejvyšší combo',
            'scorev2' => 'Score V2',
        ],
    ],
];

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
        'beatmap-deleted' => 'vymazaná beatmapa',
        'difference' => 'o :difference',
        'failed' => 'ZLYHAL',
        'header' => 'Multiplayer Zápasy',
        'in-progress' => '(prebieha zápas)',
        'in_progress_spinner_label' => 'prebieha zápas',
        'loading-events' => 'Načítanie udalosti...',
        'winner' => ':team vyhráva',

        'events' => [
            'player-left' => ':user opustil zápas',
            'player-joined' => ':user sa pripojil',
            'player-kicked' => ':user bol vyhodený zo zápasu',
            'match-created' => ':user vytvoril zápas',
            'match-disbanded' => 'zápas bol zrušený',
            'host-changed' => ':user sa stal hostom zápasu',

            'player-left-no-user' => 'hráč opustil zápas',
            'player-joined-no-user' => 'hráč sa pripojil k zápasu',
            'player-kicked-no-user' => 'hráč bol vyhodený zo zápasu',
            'match-created-no-user' => 'zápas bol vytvorený',
            'match-disbanded-no-user' => 'zápas bol zrušený',
            'host-changed-no-user' => 'host bol zmenený',
        ],

        'score' => [
            'stats' => [
                'accuracy' => 'Presnosť',
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
            'blue' => 'Modrý tím',
            'red' => 'Červený tím',
        ],
    ],
    'game' => [
        'scoring-type' => [
            'score' => 'Najvyššie Skóre',
            'accuracy' => 'Najvyššia Presnosť',
            'combo' => 'Najvyššie Combo',
            'scorev2' => 'Score V2',
        ],
    ],
];

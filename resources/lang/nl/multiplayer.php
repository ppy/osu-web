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
        'header' => 'Multiplayer Spellen',
        'team-types' => [
            'head-to-head' => '',
            'tag-coop' => '',
            'team-vs' => '',
            'tag-team-vs' => '',
        ],
        'events' => [
            'player-left' => ':user heeft het spel verlaten',
            'player-joined' => ':user speelt nu mee',
            'player-kicked' => ':user was verwijderd van het spel',
            'match-created' => ':user heeft het spel gecreëerd',
            'match-disbanded' => '',
            'host-changed' => ':user is nu de spelleider',

            'player-left-no-user' => 'een speler heeft het spel verlaten',
            'player-joined-no-user' => 'een speler speelt nu mee',
            'player-kicked-no-user' => 'een speler was verwijderd van het spel',
            'match-created-no-user' => 'het spel is gecreëerd',
            'match-disbanded-no-user' => '',
            'host-changed-no-user' => 'de spelleider is veranderd',
        ],
        'in-progress' => '(spel is al bezig)',
        'score' => [
            'stats' => [
                'accuracy' => '',
                'combo' => '',
                'score' => 'Score',
            ],
        ],
        'failed' => 'GEFAALD',
        'teams' => [
            'blue' => 'Team Blauw',
            'red' => 'Team Rood',
        ],
        'winner' => ':team heeft gewonnen',
        'difference' => 'met :difference',
        'loading-events' => 'Gebeurtenissen laden...',
        'more-events' => 'alles weergeven...',
        'beatmap-deleted' => '',
    ],
    'game' => [
        'scoring-type' => [
            'score' => 'Hoogste Score',
            'accuracy' => '',
            'combo' => 'Hoogste Combo',
            'scorev2' => 'Score V2',
        ],
    ],
];

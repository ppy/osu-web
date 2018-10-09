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
        'beatmap-deleted' => 'törölt beatmap',
        'difference' => ':difference különbséggel',
        'failed' => 'ELBUKOTT',
        'header' => 'Többjátékos meccsek',
        'in-progress' => '(a mérkőzés folyamatban van)',
        'in_progress_spinner_label' => 'a meccs folyamatban',
        'loading-events' => 'Események betöltése...',
        'winner' => ':team nyer',

        'events' => [
            'player-left' => ':user elhagyta a mérkőzést',
            'player-joined' => ':user csatlakozott a mérkőzéshez',
            'player-kicked' => ':user ki lett rúgva a mérkőzésből',
            'match-created' => ':user létrehozta a mérkőzést',
            'match-disbanded' => 'a mérkőzés felbomlott',
            'host-changed' => ':user lett a házigazda',

            'player-left-no-user' => 'egy játékos elhagyta a mérkőzést',
            'player-joined-no-user' => 'egy játékos csatlakozott a mérkőzéshez',
            'player-kicked-no-user' => 'egy játékos ki lett rúgva a mérkőzésből',
            'match-created-no-user' => 'a mérkőzés létrejött',
            'match-disbanded-no-user' => 'a mérkőzés felbomlott',
            'host-changed-no-user' => 'a házigazda megváltozott',
        ],

        'score' => [
            'stats' => [
                'accuracy' => 'Pontosság',
                'combo' => 'Kombó',
                'score' => 'Pontszám',
            ],
        ],

        'team-types' => [
            'head-to-head' => 'Head-to-head',
            'tag-coop' => 'Tag Co-op',
            'team-vs' => 'Csapat VS',
            'tag-team-vs' => 'Tag Csapat VS',
        ],

        'teams' => [
            'blue' => 'Kék Csapat',
            'red' => 'Piros Csapat',
        ],
    ],
    'game' => [
        'scoring-type' => [
            'score' => 'Legmagasabb Pontszám',
            'accuracy' => 'Legmagasabb pontosság',
            'combo' => 'Legmagasabb Kombó',
            'scorev2' => 'Score V2',
        ],
    ],
];

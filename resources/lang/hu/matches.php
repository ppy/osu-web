<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'match' => [
        'beatmap-deleted' => 'törölt beatmap',
        'failed' => 'ELBUKOTT',
        'header' => 'Többjátékos meccsek',
        'in-progress' => '(a meccs folyamatban)',
        'in_progress_spinner_label' => 'a meccs folyamatban',
        'loading-events' => 'Események betöltése...',
        'winner' => ':team nyer',
        'winner_by' => '',

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

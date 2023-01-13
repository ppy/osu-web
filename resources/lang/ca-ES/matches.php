<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'match' => [
        'beatmap-deleted' => 'beatmap eliminat',
        'difference' => 'per :difference',
        'failed' => 'FRACASSAT',
        'header' => 'Partides Multijugador',
        'in-progress' => '(partida en progrés)',
        'in_progress_spinner_label' => 'partida en progrés',
        'loading-events' => 'Carregant esdeveniments...',
        'winner' => 'guanya :team',

        'events' => [
            'player-left' => ':user ha abandonat la partida',
            'player-joined' => ':user s\'ha unit',
            'player-kicked' => ':user ha estat expulsat',
            'match-created' => ':user ha creat la partida',
            'match-disbanded' => 'la partida ha estat dissolta',
            'host-changed' => ':user és ara l\'amfitrió',

            'player-left-no-user' => 'un jugador ha abandonat la partida',
            'player-joined-no-user' => 'un jugador s\'ha unit',
            'player-kicked-no-user' => 'un jugador ha estat expulsat',
            'match-created-no-user' => 's\'ha creat la partida',
            'match-disbanded-no-user' => 'la partida s\'ha dissolt',
            'host-changed-no-user' => 'l\'amfitrió ha canviat',
        ],

        'score' => [
            'stats' => [
                'accuracy' => 'Precisió',
                'combo' => 'Combo',
                'score' => 'Puntuació',
            ],
        ],

        'team-types' => [
            'head-to-head' => 'Head-to-head',
            'tag-coop' => 'Tag Co-op',
            'team-vs' => 'Team VS',
            'tag-team-vs' => 'Tag Team VS',
        ],

        'teams' => [
            'blue' => 'Equip Blau',
            'red' => 'Equip Vermell',
        ],
    ],
    'game' => [
        'scoring-type' => [
            'score' => 'Equip Blau',
            'accuracy' => 'Precisió més alta',
            'combo' => 'Combo més alt',
            'scorev2' => 'Puntuació V2',
        ],
    ],
];

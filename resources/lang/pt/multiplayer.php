<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
 */

return [
    'match' => [
        'beatmap-deleted' => 'beatmap eliminado',
        'difference' => 'por :difference',
        'failed' => 'FALHADO',
        'header' => 'Batalhas de Multijogador',
        'in-progress' => '(partida em andamento)',
        'in_progress_spinner_label' => 'partida em andamento',
        'loading-events' => 'A carregar eventos...',
        'winner' => ':team ganha',

        'events' => [
            'player-left' => ':user abandonou a partida',
            'player-joined' => ':user juntou-se à partida',
            'player-kicked' => ':user foi expulso da partida',
            'match-created' => ':user criou a partida',
            'match-disbanded' => 'a partida foi dissolvida',
            'host-changed' => ':user tornou-se no anfitrião',

            'player-left-no-user' => 'um jogador abandonou a partida',
            'player-joined-no-user' => 'um jogador juntou-se à partida',
            'player-kicked-no-user' => 'um jogador foi expulso da partida',
            'match-created-no-user' => 'a partida foi criada',
            'match-disbanded-no-user' => 'a partida foi dissolvida',
            'host-changed-no-user' => 'o anfitrião foi alterado',
        ],

        'score' => [
            'stats' => [
                'accuracy' => 'Precisão',
                'combo' => 'Combo',
                'score' => 'Pontuação',
            ],
        ],

        'team-types' => [
            'head-to-head' => 'Frente-a-frente',
            'tag-coop' => 'Tag Co-op',
            'team-vs' => 'Equipa VS',
            'tag-team-vs' => 'Equipa Tag VS',
        ],

        'teams' => [
            'blue' => 'Equipa Azul',
            'red' => 'Equipa Vermelha',
        ],
    ],
    'game' => [
        'scoring-type' => [
            'score' => 'Maior Pontuação',
            'accuracy' => 'Maior Precisão',
            'combo' => 'Maior Combo',
            'scorev2' => 'Pontuação V2',
        ],
    ],
];

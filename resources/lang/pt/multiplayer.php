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
        'header' => 'Jogos de Multijogador',
        'team-types' => [
            'head-to-head' => 'Frente-a-frente',
            'tag-coop' => 'Cooperação em Alternância',
            'team-vs' => 'Contra Equipa',
            'tag-team-vs' => 'Contra Equipa em Alternância',
        ],
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
        'in-progress' => '(partida em andamento)',
        'score' => [
            'stats' => [
                'accuracy' => 'Precisão',
                'combo' => 'Combo',
                'score' => 'Pontuação',
            ],
        ],
        'failed' => 'FALHADO',
        'teams' => [
            'blue' => 'Equipa Azul',
            'red' => 'Equipa Vermelha',
        ],
        'winner' => ':team ganha',
        'difference' => 'por :difference',
        'loading-events' => 'A carregar eventos...',
        'more-events' => 'ver todos...',
        'beatmap-deleted' => 'beatmap eliminado',
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

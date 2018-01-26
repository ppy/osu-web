<?php

/**
 *    Copyright 2015-2017 ppy Pty. Ltd.
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
        'header' => 'Partidas multiplayer',
        'team-types' => [
            'head-to-head' => 'Head-to-head',
            'tag-coop' => 'Tag Co-op',
            'team-vs' => 'Team VS',
            'tag-team-vs' => 'Tag Team VS',
        ],
        'events' => [
            'player-left' => ':user saiu da partida',
            'player-joined' => ':user entrou na partida',
            'player-kicked' => ':user foi expulso da partida',
            'match-created' => ':user criou a partida',
            'match-disbanded' => ':the partida foi desfeita',
            'host-changed' => ':user tornou-se o líder',

            'player-left-no-user' => 'um jogador deixou a partida',
            'player-joined-no-user' => 'um jogador entrou na partida',
            'player-kicked-no-user' => 'um jogador foi expulso da partida',
            'match-created-no-user' => 'a partida foi criada',
            'match-disbanded-no-user' => 'a partida foi desfeita',
            'host-changed-no-user' => 'o líder foi alterado',
        ],
        'in-progress' => '(partida em progresso)',
        'score' => [
            'stats' => [
                'accuracy' => 'Precisão',
                'combo' => 'Combo',
                'score' => 'Pontuação',
            ],
        ],
        'failed' => 'FALHOU',
        'teams' => [
            'blue' => 'Equipe Azul',
            'red' => 'Equipe Vermelha',
        ],
        'winner' => ':team venceu',
        'difference' => 'por :difference',
        'loading-events' => 'Carregando eventos...',
        'more-events' => 'ver tudo...',
        'beatmap-deleted' => 'mapa excluído',
    ],
    'game' => [
        'scoring-type' => [
            'score' => 'Maior pontuação',
            'accuracy' => 'Maior precisão',
            'combo' => 'Maior combo',
            'scorev2' => 'Pontuação V2',
        ],
    ],
];

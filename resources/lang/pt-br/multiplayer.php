<?php

/**
 *    Copyright 2016 ppy Pty. Ltd.
 *
 *    This file is part of osu!web. osu!web is distributed in the hopes of
 *    attracting more community contributions to the core ecosystem of osu!
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
        'header' => 'Partidas Multiplayer',
        'team-types' => [
            'head-to-head' => 'Head-to-head',
            'tag-coop' => 'Tag Co-op',
            'team-vs' => 'Team VS',
            'tag-team-vs' => 'Tag Team VS',
        ],
        'events' => [
            'player-left' => ':user saiu da partida',
            'player-joined' => ':user juntou-se à partida',
            'player-kicked' => ':user foi expulso da partida',
            'match-created' => ':user criou a partida',
            'match-disbanded' => ':the partida foi cancelada',
            'host-changed' => ':user tornou-se o host',

            'player-left-no-user' => 'um jogador deixou a partida',
            'player-joined-no-user' => 'um jogador se juntou à partida',
            'player-kicked-no-user' => 'um jogador foi expulso da partida',
            'match-created-no-user' => 'a partida foi criada',
            'match-disbanded-no-user' => 'a partida foi cancelada',
            'host-changed-no-user' => 'o host foi alterado',
        ],
        'in-progress' => '(partida em progresso)',
        'score' => [
            'stats' => [
                'combo' => 'Combo',
                'accuracy' => 'Precisão',
                'score' => 'Pontuação',
                'countgeki' => 'MAX',
                'count300' => '300s',
                'countkatu' => '200s',
                'count100' => '100s',
                'count50' => '50s',
                'countmiss' => 'Erro',
            ],
        ],
        'failed' => 'FALHOU',
        'teams' => [
            'blue' => 'Time Azul',
            'red' => 'Time Vermelho',
        ],
        'winner' => ':team venceu',
        'difference' => 'por :difference',
        'loading-events' => 'Carregando eventos...',
        'more-events' => 'ver tudo...',
        'beatmap-deleted' => 'beatmap deletado',
    ],
    'game' => [
        'scoring-type' => [
            'score' => 'Maior Pontuação',
            'accuracy' => 'Melhor Precisão',
            'combo' => 'Maior Combo',
            'scorev2' => 'Pontuação V2',
        ],
    ],
];

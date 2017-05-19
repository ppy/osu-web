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
    'availability' => [
        'disabled' => 'Este beatmap não está disponível para download.',
        'parts-removed' => 'Partes deste beatmap foram removidas a pedido do criador ou de um detentor de direitos de terceiros.',
        'more-info' => 'Clique aqui para mais informações.',
    ],
    'index' => [
        'title' => 'Lista de beatmaps',
        'guest_title' => 'Beatmaps',
    ],
    'show' => [
        'discussion' => 'Discussão',

        'details' => [
            'made-by' => 'criado por ',
            'submitted' => 'enviado em ',
            'updated' => 'última atualização em ',
            'ranked' => 'ranqueado em ',
            'approved' => 'aprovado em ',
            'qualified' => 'qualificado em ',
            'loved' => 'loved em ',
            'logged-out' => 'Você precisa iniciar a sessão antes de baixar beatmaps!',
            'download' => [
                '_' => 'Baixar',
                'video' => 'com vídeo',
                'no-video' => 'sem vídeo',
                'direct' => 'osu!direct',
            ],
            'favourite' => 'Adicionar aos favoritos',
            'unfavourite' => 'Remover dos favoritos',
        ],
        'stats' => [
            'cs' => 'Circle Size',
            'cs-mania' => 'Número de teclas',
            'drain' => 'Dreno de HP',
            'accuracy' => 'Precisão',
            'ar' => 'Approach Rate',
            'stars' => 'Dificuldade',
            'total_length' => 'Duração',
            'bpm' => 'BPM',
            'count_circles' => 'Quantidade de círculos',
            'count_sliders' => 'Quantidade de sliders',
            'user-rating' => 'Avaliação de usuários',
            'rating-spread' => 'Gráfico de avaliações',
        ],
        'info' => [
            'no_scores' => 'Beatmap não ranqueado',
            'points-of-failure' => 'Pontos de falha',
            'success-rate' => 'Taxa de sucesso',

            'description' => 'Descrição',

            'source' => 'Fonte',
            'tags' => 'Marcadores',
        ],
        'scoreboard' => [
            'achieved' => 'alcançado há :when',
            'country' => 'Ranking de país',
            'friend' => 'Ranking de amigos',
            'global' => 'Ranking global',
            'supporter-link' => 'Clique <a href=":link">aqui</a> para ver todas as novas funções às quais você ganha acesso!',
            'supporter-only' => 'Você precisa de uma supporter tag para acessar rankings de amigos e de países!',
            'title' => 'Placar',

            'list' => [
                'accuracy' => 'Precisão',
                'player-header' => 'Jogador',
                'rank-header' => 'Colocação',
                'score' => 'Pontuação',
            ],
            'no_scores' => [
                'country' => 'Ninguém do seu país fez uma pontuação neste mapa ainda!',
                'friend' => 'Nenhum dos seus amigos fez uma pontuação neste mapa ainda!',
                'global' => 'Sem pontuações ainda. Não quer tentar marcar alguma?',
                'loading' => 'Carregando pontuações...',
                'unranked' => 'Beatmap não rankeado.',
            ],
            'score' => [
                'first' => 'Na liderança',
                'own' => 'Seu melhor',
            ],
            'stats' => [
                'accuracy' => 'Precisão',
                'score' => 'Pontuação',
            ],
        ],
    ],
];

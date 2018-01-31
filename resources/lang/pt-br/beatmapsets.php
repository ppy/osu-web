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
        'disabled' => 'Este mapa não está mais disponível para download.',
        'parts-removed' => 'Partes deste beatmap foram removidas a pedido do criador ou de um detentor de direitos de terceiros.',
        'more-info' => 'Procure aqui por mais informações.',
    ],

    'index' => [
        'title' => 'Lista de mapas',
        'guest_title' => 'Mapas',
    ],

    'show' => [
        'discussion' => 'Discussão',

        'details' => [
            'made-by' => 'feito por ',
            'submitted' => 'enviado em ',
            'updated' => 'última atualização em ',
            'ranked' => 'ranqueado em ',
            'approved' => 'aprovado em ',
            'qualified' => 'qualificado em ',
            'loved' => 'loved em ',
            'logged-out' => 'Você precisa conectar-se antes de baixar qualquer mapa!',
            'download' => [
                '_' => 'Baixar',
                'video' => 'com Vídeo',
                'no-video' => 'sem Vídeo',
                'direct' => 'osu!direct',
            ],
            'favourite' => 'Favoritar esse mapa',
            'unfavourite' => 'Remover dos favoritos',
            'favourited_count' => '+ 1 favorito!|+ :count outros favoritos!',
        ],
        'stats' => [
            'cs' => 'Tamanho do círculo',
            'cs-mania' => 'Número de teclas',
            'drain' => 'Dreno de HP',
            'accuracy' => 'Precisão',
            'ar' => 'Círculo de aproximação',
            'stars' => 'Dificuldade',
            'total_length' => 'Duração',
            'bpm' => 'BPM',
            'count_circles' => 'Quantidade de círculos',
            'count_sliders' => 'Quantidade de sliders',
            'user-rating' => 'Avaliação',
            'rating-spread' => 'Gráfico de avaliações',
        ],
        'info' => [
            'no_scores' => 'Mapa não ranqueado',
            'points-of-failure' => 'Taxa de falha',
            'success-rate' => 'Taxa de sucesso',

            'description' => 'Descrição',

            'source' => 'Fonte',
            'tags' => 'Marcadores',
        ],
        'scoreboard' => [
            'achieved' => 'conquistado em :when',
            'country' => 'Ranking nacional',
            'friend' => 'Ranking de amigos',
            'global' => 'Ranking Global',
            'miss_count' => ':count erros',
            'supporter-link' => 'Clique <a href=":link">aqui</a> para ver todas as novas funções às quais você ganha acesso!',
            'supporter-only' => 'Você precisa de uma supporter tag para acessar rankings de amigos e de países!',
            'title' => 'Placar',

            'headers' => [
                'accuracy' => 'Precisão',
                'combo' => 'Combo máximo',
                'miss' => 'Erro',
                'mods' => 'Mods',
                'player' => 'Jogador',
                'pp' => 'pp',
                'rank' => 'Colocação',
                'score_total' => 'Pontuação total',
                'score' => 'Pontuação',
            ],

            'no_scores' => [
                'country' => 'Ninguém do seu país fez uma pontuação nesse mapa ainda!',
                'friend' => 'Nenhum de seus amigos fez uma pontuação nesse mapa ainda',
                'global' => 'Nenhuma pontuação ainda. Não quer tentar fazer uma?',
                'loading' => 'Carregando pontuações...',
                'unranked' => 'Mapa não ranqueado.',
            ],
            'score' => [
                'first' => 'In the Lead',
                'own' => 'Your Best',
            ],
        ],
    ],
];

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
    'availability' => [
        'disabled' => 'Este mapa não está mais disponível para baixar.',
        'parts-removed' => 'Partes deste mapa foram removidas a pedido do criador ou de um detentor de direitos de terceiros.',
        'more-info' => 'Clique aqui para mais informações.',
    ],

    'index' => [
        'title' => 'Lista de mapas',
        'guest_title' => 'Mapas',
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
            'logged-out' => 'Você precisa conectar-se antes de baixar qualquer mapa!',
            'download' => [
                '_' => 'Baixar',
                'video' => 'com Vídeo',
                'no-video' => 'sem Vídeo',
                'direct' => 'osu!direct',
            ],
            'favourite' => 'Favoritar este mapa',
            'unfavourite' => 'Remover dos favoritos',
            'favourited_count' => '+ 1 favorito!|+ :count outros favoritos!',
        ],
        'stats' => [
            'cs' => 'Tamanho do Círculo',
            'cs-mania' => 'Número de Teclas',
            'drain' => 'Dreno de HP',
            'accuracy' => 'Precisão',
            'ar' => 'Velocidade de Aproximação',
            'stars' => 'Dificuldade',
            'total_length' => 'Duração',
            'bpm' => 'BPM',
            'count_circles' => 'Quantidade de Círculos',
            'count_sliders' => 'Quantidade de Sliders',
            'user-rating' => 'Avaliação de Usuários',
            'rating-spread' => 'Gráfico de Avaliações',
            'nominations' => 'Nomeações',
            'playcount' => 'Vezes jogado',
        ],
        'info' => [
            'description' => 'Descrição',
            'genre' => 'Gênero',
            'language' => 'Idioma',
            'no_scores' => 'Dados ainda sendo calculados...',
            'points-of-failure' => 'Pontos de Falha',
            'source' => 'Fonte',
            'success-rate' => 'Taxa de Sucesso',
            'tags' => 'Palavras-chave',
            'unranked' => 'Mapa não ranqueado',
        ],
        'scoreboard' => [
            'achieved' => 'conquistado em :when',
            'country' => 'Ranking Nacional',
            'friend' => 'Ranking de Amigos',
            'global' => 'Ranking Global',
            'supporter-link' => 'Clique <a href=":link">aqui</a> para ver todas as novas funções às quais você ganha acesso!',
            'supporter-only' => 'Você precisa ser um osu!supporter para acessar rankings de amigos e de países!',
            'title' => 'Placar',

            'headers' => [
                'accuracy' => 'Precisão',
                'combo' => 'Combo Máximo',
                'miss' => 'Erro',
                'mods' => 'Mods',
                'player' => 'Jogador',
                'pp' => 'pp',
                'rank' => 'Rank',
                'score_total' => 'Pontuação Total',
                'score' => 'Pontuação',
            ],

            'no_scores' => [
                'country' => 'Ninguém do seu país fez uma pontuação nesse mapa ainda!',
                'friend' => 'Nenhum de seus amigos fez uma pontuação nesse mapa ainda!',
                'global' => 'Nenhuma pontuação ainda. Não quer tentar fazer uma?',
                'loading' => 'Carregando pontuações...',
                'unranked' => 'Mapa não ranqueado.',
            ],
            'score' => [
                'first' => 'Na Liderança',
                'own' => 'Seu melhor',
            ],
        ],
    ],
];

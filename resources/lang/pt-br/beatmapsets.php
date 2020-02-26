<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
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
        'disabled' => 'Este beatmap não está mais disponível para baixar.',
        'parts-removed' => 'Partes deste beatmap foram removidas a pedido do criador ou de um detentor de direitos de terceiros.',
        'more-info' => 'Clique aqui para mais informações.',
    ],

    'index' => [
        'title' => 'Lista de Beatmaps',
        'guest_title' => 'Beatmaps',
    ],

    'show' => [
        'discussion' => 'Discussão',

        'details' => [
            'favourite' => 'Favoritar este beatmap',
            'logged-out' => 'Você precisa conectar-se antes de baixar qualquer beatmap!',
            'mapped_by' => 'mapeado por :mapper',
            'unfavourite' => 'Remover dos favoritos',
            'updated_timeago' => 'última atualização :timeago',

            'download' => [
                '_' => 'Baixar',
                'direct' => 'osu!direct',
                'no-video' => 'sem Vídeo',
                'video' => 'com Vídeo',
            ],

            'login_required' => [
                'bottom' => 'para acessar mais funcionalidades',
                'top' => 'Conectar-se',
            ],
        ],

        'favourites' => [
            'limit_reached' => 'Você tem muitos beatmaps favoritados! Remova alguns e tente novamente.',
        ],

        'hype' => [
            'action' => 'Dê um hype se você se divertiu jogando este map para ajudá-lo no processo de <strong>Ranqueamento</strong>.',

            'current' => [
                '_' => 'Este map está atualmente :status.',

                'status' => [
                    'pending' => 'pendente',
                    'qualified' => 'qualificado',
                    'wip' => 'em processo de criação',
                ],
            ],

            'disqualify' => [
                '_' => 'Se você encontrar um problema com este beatmap, por favor desqualifique-o :link.',
                'button_title' => 'Desqualificar um beatmap qualificado.',
            ],

            'report' => [
                '_' => 'Se você encontrar um problema com este beatmap, por favor reporte-o :link para alertar a equipe.',
                'button' => 'Reportar Problema',
                'button_title' => 'Relatar um problema em um beatmap qualificado.',
                'link' => 'aqui',
            ],
        ],

        'info' => [
            'description' => 'Descrição',
            'genre' => 'Gênero',
            'language' => 'Idioma',
            'no_scores' => 'Dados ainda sendo calculados...',
            'points-of-failure' => 'Pontos de Falha',
            'source' => 'Fonte',
            'success-rate' => 'Taxa de Sucesso',
            'tags' => 'Tags',
            'unranked' => 'Beatmap não ranqueado',
        ],

        'scoreboard' => [
            'achieved' => 'conquistado :when',
            'country' => 'Ranking Nacional',
            'friend' => 'Ranking de Amigos',
            'global' => 'Ranking Global',
            'supporter-link' => 'Clique <a href=":link">aqui</a> para ver todas as novas funções às quais você ganha acesso!',
            'supporter-only' => 'Você precisa ser um osu!supporter para acessar rankings de amigos e de países!',
            'title' => 'Placar',

            'headers' => [
                'accuracy' => 'Precisão',
                'combo' => 'Combo Máximo',
                'miss' => 'Erros',
                'mods' => 'Mods',
                'player' => 'Jogador',
                'pp' => 'pp',
                'rank' => 'Rank',
                'score_total' => 'Pontuação Total',
                'score' => 'Pontuação',
            ],

            'no_scores' => [
                'country' => 'Ninguém do seu país fez uma pontuação nesse beatmap ainda!',
                'friend' => 'Nenhum de seus amigos fez uma pontuação nesse beatmap ainda!',
                'global' => 'Nenhuma pontuação ainda. Não quer tentar fazer uma?',
                'loading' => 'Carregando pontuações...',
                'unranked' => 'Beatmap não ranqueado.',
            ],
            'score' => [
                'first' => 'Na Liderança',
                'own' => 'Seu Melhor',
            ],
        ],

        'stats' => [
            'cs' => 'Tamanho dos Círculos',
            'cs-mania' => 'Número de Teclas',
            'drain' => 'Dreno de HP',
            'accuracy' => 'Precisão',
            'ar' => 'Velocidade de Aproximação',
            'stars' => 'Dificuldade',
            'total_length' => 'Duração',
            'bpm' => 'BPM',
            'count_circles' => 'Quantidade de Círculos',
            'count_sliders' => 'Quantidade de Sliders',
            'user-rating' => 'Avaliação',
            'rating-spread' => 'Gráfico de Avaliações',
            'nominations' => 'Nomeações',
            'playcount' => 'Vezes Jogadas',
        ],

        'status' => [
            'ranked' => 'Ranqueado',
            'approved' => 'Aprovado',
            'loved' => 'Amado',
            'qualified' => 'Qualificado',
            'wip' => 'Em Progresso',
            'pending' => 'Pendente',
            'graveyard' => 'Cemitério',
        ],
    ],
];

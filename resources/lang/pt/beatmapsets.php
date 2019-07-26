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
        'disabled' => 'Este beatmap não está disponível atualmente para transferência.',
        'parts-removed' => 'Porções deste beatmap foram removidas a pedido do criador ou dum titular de direitos de terceiros.',
        'more-info' => 'Clica aqui para mais informações.',
    ],

    'index' => [
        'title' => 'Listagem de Beatmaps',
        'guest_title' => 'Beatmaps',
    ],

    'show' => [
        'discussion' => 'Discussão',

        'details' => [
            'approved' => 'aprovado em ',
            'favourite' => 'Marcar este beatmapset como favorito',
            'favourited_count' => '+ 1 outro!|+ :count outros!',
            'logged-out' => 'Precisas de iniciar sessão antes de transferir quaisquer beatmaps!',
            'loved' => 'adorado em ',
            'mapped_by' => 'mapeado por :mapper',
            'qualified' => 'qualificado em ',
            'ranked' => 'classificado em ',
            'submitted' => 'submetido em ',
            'unfavourite' => 'Desmarcar este beatmapset como favorito',
            'updated' => 'última atualização em ',
            'updated_timeago' => 'última atualização :timeago',

            'download' => [
                '_' => 'Descarregar',
                'direct' => '',
                'no-video' => 'sem Vídeo',
                'video' => 'com Vídeo',
            ],

            'login_required' => [
                'bottom' => 'para aceder a mais funcionalidades',
                'top' => 'Iniciar Sessão',
            ],
        ],

        'favourites' => [
            'limit_reached' => 'Tens demasiados beatmaps como favoritos! Por favor remove alguns antes de tentares novamente.',
        ],

        'hype' => [
            'action' => 'Hypeia este mapa se gostaste de o jogar para ajudá-lo a progredir ao estado <strong>Classificado</strong>.',

            'current' => [
                '_' => 'Este mapa está atualmente :status.',

                'status' => [
                    'pending' => 'pendente',
                    'qualified' => 'qualificado',
                    'wip' => 'trabalho em progresso',
                ],
            ],
        ],

        'info' => [
            'description' => 'Descrição',
            'genre' => 'Género',
            'language' => 'Linguagem',
            'no_scores' => 'Os dados ainda estão a ser calculados...',
            'points-of-failure' => 'Pontos de Falha',
            'source' => 'Fonte',
            'success-rate' => 'Taxa de Sucesso',
            'tags' => 'Etiquetas',
            'unranked' => 'Beatmap sem classificação',
        ],

        'scoreboard' => [
            'achieved' => 'conseguido :when',
            'country' => 'Classificação Nacional',
            'friend' => 'Classificação de Amigos',
            'global' => 'Classificação Global',
            'supporter-link' => 'Clica <a href=":link">aqui</a> para ver todas as funcionalidades chiques que obténs!',
            'supporter-only' => 'Precisas de ser um apoiante para ter acesso às classificações de amigos e nacional!',
            'title' => 'Tabela de Pontuações',

            'headers' => [
                'accuracy' => 'Precisão',
                'combo' => 'Combo Máximo',
                'miss' => 'Erros',
                'mods' => 'Mods',
                'player' => 'Jogador',
                'pp' => '',
                'rank' => 'Posição',
                'score_total' => 'Pontuação Total',
                'score' => 'Pontuação',
            ],

            'no_scores' => [
                'country' => 'Ainda ninguém do teu país estabeleceu uma pontuação neste mapa!',
                'friend' => 'Ainda nenhum dos teus amigos estabeleceu uma pontuação neste mapa!',
                'global' => 'Ainda sem pontuações. Talvez deverias estabelecer algumas?',
                'loading' => 'A carregar pontuações...',
                'unranked' => 'Beatmap sem classificação.',
            ],
            'score' => [
                'first' => 'Na Liderança',
                'own' => 'A Tua Melhor',
            ],
        ],

        'stats' => [
            'cs' => 'Tamanho do Círculo',
            'cs-mania' => 'Quantidade de Teclas',
            'drain' => 'HP Drenado',
            'accuracy' => 'Precisão',
            'ar' => 'Taxa de Aproximação',
            'stars' => 'Dificuldade Estrela',
            'total_length' => 'Duração',
            'bpm' => 'BPM',
            'count_circles' => 'Número de Círculos',
            'count_sliders' => 'Número de Deslizadores',
            'user-rating' => 'Classificação de Utilizador',
            'rating-spread' => 'Avaliação Dispersada',
            'nominations' => 'Nomeações',
            'playcount' => 'Número de Partidas',
        ],
    ],
];

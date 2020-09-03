<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

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

    'panel' => [
        'download' => [
            'all' => 'baixar',
            'video' => 'baixar com vídeo',
            'no_video' => 'baixar sem vídeo',
            'direct' => 'abrir no osu!direct',
        ],
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

        'details_date' => [
            'approved' => 'aprovado :timeago',
            'loved' => 'loved :timeago',
            'qualified' => 'qualificado :timeago',
            'ranked' => 'ranqueado :timeago',
            'submitted' => 'enviado :timeago',
            'updated' => 'atualizado :timeago',
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
            ],

            'report' => [
                '_' => 'Se você encontrar um problema com este beatmap, por favor reporte-o :link para alertar a equipe.',
                'button' => 'Reportar Problema',
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
                'time' => 'Tempo',
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
            'loved' => 'Loved',
            'qualified' => 'Qualificado',
            'wip' => 'Em Progresso',
            'pending' => 'Pendente',
            'graveyard' => 'Cemitério',
        ],
    ],
];

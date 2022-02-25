<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'availability' => [
        'disabled' => 'Este beatmap não está mais disponível para baixar.',
        'parts-removed' => 'Partes deste beatmap foram removidas a pedido do criador ou de um detentor de direitos de terceiros.',
        'more-info' => 'Clique aqui para mais informações.',
        'rule_violation' => 'Alguns arquivos contidos neste mapa foram removidos depois de serem julgados como não sendo adequados para uso no osu!.',
    ],

    'download' => [
        'limit_exceeded' => 'Vá devagar, jogue mais.',
    ],

    'featured_artist_badge' => [
        'label' => 'Artista em destaque',
    ],

    'index' => [
        'title' => 'Lista de Beatmaps',
        'guest_title' => 'Beatmaps',
    ],

    'panel' => [
        'empty' => 'sem beatmaps',

        'download' => [
            'all' => 'baixar',
            'video' => 'baixar com vídeo',
            'no_video' => 'baixar sem vídeo',
            'direct' => 'abrir no osu!direct',
        ],
    ],

    'nominate' => [
        'hybrid_requires_modes' => 'Um beatmap híbrido requer que você selecione pelo menos um modo de jogo para nomear.',
        'incorrect_mode' => 'Você não tem permissão para nomear para o modo: :mode',
        'full_bn_required' => 'Você precisa ser um nominator completo para realizar essa nomeação de qualificação.',
        'too_many' => 'Exigência de nomeação já cumprida.',

        'dialog' => [
            'confirmation' => 'Tem certeza que deseja nomear este Beatmap?',
            'header' => 'Nomear Beatmap',
            'hybrid_warning' => 'nota: você pode apenas nomear uma vez, então por favor, certifique-se de que você está nomeando para todos os modos de jogo que você pretende',
            'which_modes' => 'Nomear para quais modos?',
        ],
    ],

    'nsfw_badge' => [
        'label' => 'Explícito',
    ],

    'show' => [
        'discussion' => 'Discussão',

        'details' => [
            'by_artist' => 'por :artist',
            'favourite' => 'Favoritar este beatmap',
            'favourite_login' => 'Inicie a sessão favoritar este beatmap',
            'logged-out' => 'Você precisa conectar-se antes de baixar qualquer beatmap!',
            'mapped_by' => 'mapeado por :mapper',
            'unfavourite' => 'Remover dos favoritos',
            'updated_timeago' => 'última atualização :timeago',

            'download' => [
                '_' => 'Baixar',
                'direct' => '',
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
            'nsfw' => 'Conteúdo explícito',
            'points-of-failure' => 'Pontos de Falha',
            'source' => 'Fonte',
            'storyboard' => 'Este beatmap contém storyboard',
            'success-rate' => 'Taxa de Sucesso',
            'tags' => 'Tags',
            'video' => 'Esse beatmap contém vídeo',
        ],

        'nsfw_warning' => [
            'details' => 'Este beatmap contém conteúdo explícito, ofensivo ou perturbador. Você gostaria de visualizá-lo mesmo assim?',
            'title' => 'Conteúdo explícito',

            'buttons' => [
                'disable' => 'Desativar o aviso',
                'listing' => 'Lista de beatmaps',
                'show' => 'Exibir',
            ],
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
                'pin' => 'Fixar',
                'player' => 'Jogador',
                'pp' => '',
                'rank' => 'Rank',
                'score' => 'Pontuação',
                'score_total' => 'Pontuação Total',
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
            'supporter_link' => [
                '_' => '',
                'here' => '',
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

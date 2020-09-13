<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'availability' => [
        'disabled' => 'Este beatmap não está disponível atualmente para transferência.',
        'parts-removed' => 'Algumas porções deste beatmap foram removidas a pedido do criador ou dum titular de direitos de terceiros.',
        'more-info' => 'Clica aqui para mais informações.',
    ],

    'index' => [
        'title' => 'Listagem de beatmaps',
        'guest_title' => 'Beatmaps',
    ],

    'panel' => [
        'download' => [
            'all' => 'transferir',
            'video' => 'transferir com vídeo',
            'no_video' => 'transferir sem vídeo',
            'direct' => 'abrir em osu!direct',
        ],
    ],

    'show' => [
        'discussion' => 'Discussão',

        'details' => [
            'favourite' => 'Marcar este beatmapset como favorito',
            'logged-out' => 'Precisas de iniciar sessão antes de transferir quaisquer beatmaps!',
            'mapped_by' => 'mapeado por :mapper',
            'unfavourite' => 'Desmarcar este beatmapset como favorito',
            'updated_timeago' => 'atualizado há :timeago',

            'download' => [
                '_' => 'Descarregar',
                'direct' => '',
                'no-video' => 'sem vídeo',
                'video' => 'com vídeo',
            ],

            'login_required' => [
                'bottom' => 'para aceder a mais funcionalidades',
                'top' => 'Iniciar sessão',
            ],
        ],

        'details_date' => [
            'approved' => 'aprovado há :timeago',
            'loved' => 'adorado há :timeago',
            'qualified' => 'qualificado há :timeago',
            'ranked' => 'classificado há :timeago',
            'submitted' => 'submetido há :timeago',
            'updated' => 'atualizado há :timeago',
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

            'disqualify' => [
                '_' => 'Se encontrares um problema com este beatmap, por favor desqualifica-o :link.',
            ],

            'report' => [
                '_' => 'Se encontrares um problema com este beatmap, por favor transmite-o :link para avisar a equipa.',
                'button' => 'Relatar problema',
                'link' => 'aqui',
            ],
        ],

        'info' => [
            'description' => 'Descrição',
            'genre' => 'Género',
            'language' => 'Língua',
            'no_scores' => 'Os dados ainda estão a ser calculados...',
            'points-of-failure' => 'Pontos de falha',
            'source' => 'Fonte',
            'success-rate' => 'Taxa de sucesso',
            'tags' => 'Etiquetas',
        ],

        'scoreboard' => [
            'achieved' => 'conseguido :when',
            'country' => 'Classificação nacional',
            'friend' => 'Classificação de amigos',
            'global' => 'Classificação global',
            'supporter-link' => 'Clica <a href=":link">aqui</a> para ver todas as funcionalidades extravagantes que obténs!',
            'supporter-only' => 'Precisas de ser um osu!supporter para ter acesso às classificações de amigos e nacional!',
            'title' => 'Tabela de pontuações',

            'headers' => [
                'accuracy' => 'Precisão',
                'combo' => 'Combo máximo',
                'miss' => 'Erros',
                'mods' => 'Mods',
                'player' => 'Jogador',
                'pp' => '',
                'rank' => 'Posição',
                'score_total' => 'Pontuação total',
                'score' => 'Pontuação',
                'time' => 'Tempo',
            ],

            'no_scores' => [
                'country' => 'Ainda ninguém do teu país estabeleceu uma pontuação neste mapa!',
                'friend' => 'Ainda nenhum dos teus amigos estabeleceu uma pontuação neste mapa!',
                'global' => 'Ainda sem pontuações. Talvez deverias estabelecer algumas?',
                'loading' => 'A carregar pontuações...',
                'unranked' => 'Beatmap sem classificação.',
            ],
            'score' => [
                'first' => 'Na liderança',
                'own' => 'A tua melhor',
            ],
        ],

        'stats' => [
            'cs' => 'Tamanho do círculo',
            'cs-mania' => 'Quantidade de teclas',
            'drain' => 'HP drenado',
            'accuracy' => 'Precisão',
            'ar' => 'Taxa de aproximação',
            'stars' => 'Dificuldade estrela',
            'total_length' => 'Duração',
            'bpm' => 'BPM',
            'count_circles' => 'Número de círculos',
            'count_sliders' => 'Número de deslizadores',
            'user-rating' => 'Classificação de utilizador',
            'rating-spread' => 'Avaliação dispersada',
            'nominations' => 'Nomeações',
            'playcount' => 'Número de partidas',
        ],

        'status' => [
            'ranked' => 'Classificado',
            'approved' => 'Aprovado',
            'loved' => 'Adorado',
            'qualified' => 'Qualificado',
            'wip' => 'Trabalho em progresso',
            'pending' => 'Pendente',
            'graveyard' => 'Cemitério',
        ],
    ],
];

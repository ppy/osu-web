<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'availability' => [
        'disabled' => 'Este mapa não está disponível para transferência de momento.',
        'parts-removed' => 'Partes deste mapa foram removidas a pedido do criador ou de um detentor de direitos de terceiros.',
        'more-info' => 'Consulte aqui para mais informações.',
        'rule_violation' => 'Alguns recursos incluídos neste mapa foram removidos após terem sido considerados inadequados para utilização no osu!.',
    ],

    'cover' => [
        'deleted' => 'Mapas eliminados',
    ],

    'download' => [
        'limit_exceeded' => 'Abrande, jogue mais.',
        'no_mirrors' => 'Nenhum servidor de transferência disponível.',
    ],

    'featured_artist_badge' => [
        'label' => 'Artista destacado',
    ],

    'index' => [
        'title' => 'Listagem de mapas',
        'guest_title' => 'Mapas',
    ],

    'panel' => [
        'empty' => 'sem mapas',

        'download' => [
            'all' => 'transferir',
            'video' => 'transferir com vídeo',
            'no_video' => 'transferir sem vídeo',
            'direct' => 'abrir no osu!direct',
        ],
    ],

    'nominate' => [
        'bng_limited_too_many_rulesets' => 'Os nomeadores probatórios não podem nomear múltiplos conjuntos de modos de jogo.',
        'full_nomination_required' => 'Tem de ser um nomeador completo para realizar a nomeação final de um conjunto de modos de jogo.',
        'hybrid_requires_modes' => 'Um mapa híbrido exige que selecione pelo menos um modo de jogo para nomear.',
        'incorrect_mode' => 'Não tem permissão para nomear o seguinte modo: :mode',
        'invalid_limited_nomination' => 'Este mapa tem nomeações inválidas e não pode ser qualificado neste estado.',
        'invalid_ruleset' => 'Esta nomeação tem conjuntos de modos de jogo inválidos.',
        'too_many' => 'O requisito de nomeação já foi cumprido.',
        'too_many_non_main_ruleset' => 'O requisito de nomeação para o conjunto de modos de jogo não principal já foi cumprido.',

        'dialog' => [
            'confirmation' => 'Tem a certeza de que deseja nomear este mapa?',
            'different_nominator_warning' => 'Qualificar este mapa com nomeadores diferentes irá redefinir a sua posição na fila de qualificação.',
            'header' => 'Nomear mapa',
            'hybrid_warning' => 'nota: só pode nomear uma vez, por isso certifique‑se de que está a nomear para todos os modos de jogo pretendidos',
            'current_main_ruleset' => 'O conjunto de modos de jogo principal é de momento: :ruleset',
            'which_modes' => 'Para que modos deseja nomear?',
        ],
    ],

    'nsfw_badge' => [
        'label' => 'Explícito',
    ],

    'show' => [
        'discussion' => 'Discussão',

        'admin' => [
            'full_size_cover' => 'Ver imagem de capa em tamanho completo',
            'page' => 'Ver a página de administração',
        ],

        'deleted_banner' => [
            'title' => 'Este mapa foi apagado.',
            'message' => '(apenas os moderadores podem ver isto)',
        ],

        'details' => [
            'by_artist' => 'por :artist',
            'favourite' => 'Marcar este mapa como favorito',
            'favourite_login' => 'Inicie sessão para marcar este mapa como favorito',
            'logged-out' => 'Tem de iniciar sessão antes de descarregar qualquer mapa!',
            'mapped_by' => 'mapa criado por :mapper',
            'mapped_by_guest' => 'dificuldade de convidado por :mapper',
            'unfavourite' => 'Remover este mapa dos favoritos',
            'updated_timeago' => 'atualizado há :timeago',

            'download' => [
                '_' => 'Transferir',
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
            'limit_reached' => 'Tem demasiados mapas como favoritos! Remova alguns mapas dos favoritos antes de tentar novamente.',
        ],

        'hype' => [
            'action' => 'Hypeie este mapa se gostou de jogá-lo para o ajudar a progredir ao estado <strong>Classificado</strong>.',

            'current' => [
                '_' => 'Este mapa está atualmente :status.',

                'status' => [
                    'pending' => 'pendente',
                    'qualified' => 'qualificado',
                    'wip' => 'trabalho em curso',
                ],
            ],

            'disqualify' => [
                '_' => 'Se encontrar um problema com este mapa, desqualifique-o :link.',
            ],

            'report' => [
                '_' => 'Se encontrar um problema com este mapa, denuncie-o :link para avisar a equipa.',
                'button' => 'Relatar problema',
                'link' => 'aqui',
            ],
        ],

        'info' => [
            'description' => 'Descrição',
            'genre' => 'Género',
            'language' => 'Língua',
            'mapper_tags' => 'Etiquetas do mapeador',
            'no_scores' => 'Os dados ainda estão a ser calculados...',
            'nominators' => 'Nomeadores',
            'nsfw' => 'Conteúdo explícito',
            'offset' => 'Desvio do online',
            'pack_tags' => 'Pacotes de mapas',
            'points-of-failure' => 'Pontos de falha',
            'source' => 'Fonte',
            'storyboard' => 'Este mapa contém sequências gráficas',
            'success-rate' => 'Taxa de sucesso',
            'success_rate_plays' => ':passes de :count_delimited partida|:passes de :count_delimited partidas',
            'user_tags' => 'Etiquetas do utilizador',
            'video' => 'Este mapa contém um vídeo',
        ],

        'nsfw_warning' => [
            'details' => 'Este mapa contém conteúdo explícito, ofensivo ou perturbador. Gostaria de vê-lo mesmo assim?',
            'title' => 'Conteúdo explícito',

            'buttons' => [
                'disable' => 'Desativar aviso',
                'listing' => 'Listagem de mapas',
                'show' => 'Mostrar',
            ],
        ],

        'scoreboard' => [
            'achieved' => 'conseguido :when',
            'country' => 'Classificação nacional',
            'error' => 'Falha ao carregar a classificação',
            'friend' => 'Classificação de amigos',
            'global' => 'Classificação global',
            'supporter-link' => 'Clique <a href=":link">aqui</a> para ver todas as funcionalidades extravagantes que obtém!',
            'supporter-only' => 'Precisa de ser um osu!supporter para aceder às classificações de amigos e países!',
            'team' => 'Classificação da equipa',
            'title' => 'Tabela de pontuações',

            'headers' => [
                'accuracy' => 'Precisão',
                'combo' => 'Combinação máxima',
                'miss' => 'Erros',
                'mods' => 'Modificações',
                'pin' => 'Afixar',
                'player' => 'Jogador',
                'pp' => '',
                'rank' => 'Posição',
                'score' => 'Pontuação',
                'score_total' => 'Pontuação total',
                'time' => 'Tempo',
            ],

            'no_scores' => [
                'country' => 'Ninguém do seu país definiu uma pontuação neste mapa ainda!',
                'friend' => 'Nenhum dos seus amigos definiu uma pontuação neste mapa ainda!',
                'global' => 'Ainda não há pontuações. Talvez deva tentar definir algumas?',
                'loading' => 'A carregar pontuações...',
                'team' => 'Ninguém da sua equipa definiu uma pontuação neste mapa ainda!',
                'unranked' => 'Mapa sem classificação.',
            ],
            'score' => [
                'first' => 'Na liderança',
                'own' => 'O seu recorde',
            ],
            'supporter_link' => [
                '_' => 'Clique :here para ver todas as funcionalidades catitas que recebe!',
                'here' => 'aqui',
            ],
        ],

        'stats' => [
            'cs' => 'Tamanho do círculo',
            'cs-mania' => 'Quantidade de teclas',
            'drain' => 'Dreno de HP',
            'accuracy' => 'Precisão',
            'ar' => 'Taxa de aproximação',
            'stars' => 'Dificuldade estrela',
            'total_length' => 'Duração (Duração de drenagem: :hit_length)',
            'bpm' => 'BPM',
            'count_circles' => 'Número de círculos',
            'count_sliders' => 'Número de deslizadores',
            'offset' => 'Desvio do online: :offset',
            'user-rating' => 'Classificação de utilizador',
            'rating-spread' => 'Classificação dispersada',
            'nominations' => 'Nomeações',
            'playcount' => 'Número de partidas',
            'favourites' => 'Favoritos',
            'no_favourites' => 'Ainda não há favoritos',
        ],

        'status' => [
            'ranked' => 'Classificado',
            'approved' => 'Aprovado',
            'loved' => 'Adorado',
            'qualified' => 'Qualificado',
            'wip' => 'Trabalho em curso',
            'pending' => 'Pendente',
            'graveyard' => 'Cemitério',
        ],
    ],

    'spotlight_badge' => [
        'label' => 'Em destaque',
    ],
];

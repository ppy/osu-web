<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'availability' => [
        'disabled' => 'Este beatmap não está disponível atualmente para transferência.',
        'parts-removed' => 'Algumas porções deste beatmap foram removidas a pedido do criador ou dum titular de direitos de terceiros.',
        'more-info' => 'Clica aqui para mais informações.',
        'rule_violation' => 'Alguns elementos contidos neste mapa foram removidos após terem sido considerados como não sendo adequados para utilização no osu!',
    ],

    'cover' => [
        'deleted' => 'Beatmaps eliminados',
    ],

    'download' => [
        'limit_exceeded' => 'Abranda, joga mais.',
        'no_mirrors' => 'Nenhum servidor de transferência disponível.',
    ],

    'featured_artist_badge' => [
        'label' => 'Artista destacado',
    ],

    'index' => [
        'title' => 'Listagem de beatmaps',
        'guest_title' => 'Beatmaps',
    ],

    'panel' => [
        'empty' => 'sem beatmaps',

        'download' => [
            'all' => 'transferir',
            'video' => 'transferir com vídeo',
            'no_video' => 'transferir sem vídeo',
            'direct' => 'abrir em osu!direct',
        ],
    ],

    'nominate' => [
        'bng_limited_too_many_rulesets' => 'Os nomeadores novatos não podem nomear vários conjuntos de regras.',
        'full_nomination_required' => 'Precisas de ser um nomeador efetivo para realizar a nomeação final dum conjunto de regras.',
        'hybrid_requires_modes' => 'Um conjunto de beatmaps híbrido necessita que seleciones pelo menos um modo de jogo para nomear.',
        'incorrect_mode' => 'Não tens permissão de nomear para o modo: :mode',
        'invalid_limited_nomination' => 'Este beatmap tem nomeações inválidas e não pode ser qualificado neste estado.',
        'invalid_ruleset' => 'Esta nomeação tem conjuntos de regras inválidos.',
        'too_many' => 'O requisito de nomeação já foi realizado.',
        'too_many_non_main_ruleset' => 'O requisito de nomeação para o conjunto de regras não principal já foi cumprido.',

        'dialog' => [
            'confirmation' => 'Tens a certeza que queres nomear este beatmap?',
            'different_nominator_warning' => 'Qualificar este beatmaps com nominadores diferentes irá redefinir a tua posição na fila de qualificação.',
            'header' => 'Nomear beatmap',
            'hybrid_warning' => 'nota: poderás apenas nomear uma vez, por isso certifica-te de que estás a nomear para todos os modos de jogo que pretendes',
            'current_main_ruleset' => 'O conjunto de regras principal está de momento: :ruleset',
            'which_modes' => 'Nomear para quais modos?',
        ],
    ],

    'nsfw_badge' => [
        'label' => 'Explícito',
    ],

    'show' => [
        'discussion' => 'Discussão',

        'admin' => [
            'full_size_cover' => 'Ver imagem da capa em tamanho real',
            'page' => '',
        ],

        'deleted_banner' => [
            'title' => 'Este beatmap foi apagado.',
            'message' => '(apenas os moderadores podem ver isto)',
        ],

        'details' => [
            'by_artist' => 'por :artist',
            'favourite' => 'Marcar este beatmapset como favorito',
            'favourite_login' => 'Inicia sessão para pôr este beatmap nos favoritos',
            'logged-out' => 'Precisas de iniciar sessão antes de transferir quaisquer beatmaps!',
            'mapped_by' => 'mapeado por :mapper',
            'mapped_by_guest' => 'dificuldade de convidado por :mapper',
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
            'limit_reached' => 'Tens demasiados beatmaps como favoritos! Remove alguns antes de tentares novamente.',
        ],

        'hype' => [
            'action' => 'Hypeia este mapa se gostaste de jogá-lo para o ajudar a progredir ao estado <strong>Classificado</strong>.',

            'current' => [
                '_' => 'Este mapa está atualmente :status.',

                'status' => [
                    'pending' => 'pendente',
                    'qualified' => 'qualificado',
                    'wip' => 'trabalho em curso',
                ],
            ],

            'disqualify' => [
                '_' => 'Se encontrares um problema com este beatmap, desqualifica-o :link.',
            ],

            'report' => [
                '_' => 'Se encontrares um problema com este beatmap, denuncia-o :link para avisar a equipa.',
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
            'points-of-failure' => 'Pontos de falha',
            'source' => 'Fonte',
            'storyboard' => 'Este beatmap contém um cenário',
            'success-rate' => 'Taxa de sucesso',
            'user_tags' => 'Etiquetas do utilizador',
            'video' => 'Este beatmap contém vídeo',
        ],

        'nsfw_warning' => [
            'details' => 'Este beatmap contém conteúdo explícito, ofensivo ou perturbador. Gostarias de vê-lo mesmo assim?',
            'title' => 'Conteúdo explícito',

            'buttons' => [
                'disable' => 'Desativar aviso',
                'listing' => 'Listagem de beatmaps',
                'show' => 'Mostrar',
            ],
        ],

        'scoreboard' => [
            'achieved' => 'conseguido :when',
            'country' => 'Classificação nacional',
            'error' => 'Falha ao carregar a classificação',
            'friend' => 'Classificação de amigos',
            'global' => 'Classificação global',
            'supporter-link' => 'Clica <a href=":link">aqui</a> para ver todas as funcionalidades extravagantes que obténs!',
            'supporter-only' => 'Precisas de ser um osu!supporter para acederes às classificações de amigos e países!',
            'team' => 'Classificação da equipa',
            'title' => 'Tabela de pontuações',

            'headers' => [
                'accuracy' => 'Precisão',
                'combo' => 'Combo máximo',
                'miss' => 'Erros',
                'mods' => 'Mods',
                'pin' => 'Afixar',
                'player' => 'Jogador',
                'pp' => '',
                'rank' => 'Posição',
                'score' => 'Pontuação',
                'score_total' => 'Pontuação total',
                'time' => 'Tempo',
            ],

            'no_scores' => [
                'country' => 'Ainda ninguém do teu país estabeleceu uma pontuação neste mapa!',
                'friend' => 'Ainda nenhum dos teus amigos estabeleceu uma pontuação neste mapa!',
                'global' => 'Ainda sem pontuações. Talvez deverias estabelecer algumas?',
                'loading' => 'A carregar pontuações...',
                'team' => 'Ainda ninguém da tua equipa estabeleceu uma pontuação neste mapa!',
                'unranked' => 'Beatmap sem classificação.',
            ],
            'score' => [
                'first' => 'Na liderança',
                'own' => 'A tua melhor',
            ],
            'supporter_link' => [
                '_' => 'Clica :here para veres todas as funcionalidades catitas que recebes!',
                'here' => 'aqui',
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
            'offset' => 'Desvio do online :offset',
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
            'wip' => 'Trabalho em curso',
            'pending' => 'Pendente',
            'graveyard' => 'Cemitério',
        ],
    ],

    'spotlight_badge' => [
        'label' => 'Em destaque',
    ],
];

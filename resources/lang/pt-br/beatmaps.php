<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'discussion-votes' => [
        'update' => [
            'error' => 'Falha ao atualizar votos',
        ],
    ],

    'discussions' => [
        'allow_kudosu' => 'permitir kudosu',
        'beatmap_information' => 'Página do Beatmap',
        'delete' => 'excluir',
        'deleted' => 'Excluído por :editor às :delete_time.',
        'deny_kudosu' => 'negar kudosu',
        'edit' => 'editar',
        'edited' => 'Última vez editado por :editor :update_time.',
        'guest' => 'Dificuldade de convidado feita por :user',
        'kudosu_denied' => 'Impossibilitado de receber kudosu.',
        'message_placeholder_deleted_beatmap' => 'Esta dificuldade foi deletada e uma dicussão não poderá ser aberta.',
        'message_placeholder_locked' => 'A discussão para este beatmap foi desabilitada.',
        'message_placeholder_silenced' => "Não é possível postar na discussão enquanto silenciado.",
        'message_type_select' => 'Selecione o Tipo de Comentário',
        'reply_notice' => 'Pressione enter para responder.',
        'reply_placeholder' => 'Digite sua resposta aqui',
        'require-login' => 'Por favor, conecte-se para postar ou responder',
        'resolved' => 'Resolvido',
        'restore' => 'restaurar',
        'show_deleted' => 'Mostrar excluídos',
        'title' => 'Discussões',

        'collapse' => [
            'all-collapse' => 'Juntar',
            'all-expand' => 'Expandir',
        ],

        'empty' => [
            'empty' => 'Nenhuma discussão ainda!',
            'hidden' => 'Nenhuma discussão encontrada com o filtro selecionado.',
        ],

        'lock' => [
            'button' => [
                'lock' => 'Trancar discussão',
                'unlock' => 'Destrancar discussão',
            ],

            'prompt' => [
                'lock' => 'Motivo para trancar',
                'unlock' => 'Quer mesmo destrancar?',
            ],
        ],

        'message_hint' => [
            'in_general' => 'Esta postagem vai para a discussão geral do beatmap. Para fazer uma sugestão neste beatmap, inicie a mensagem com uma marcação de tempo (ex.: 00:12:345).',
            'in_timeline' => 'Para fazer várias sugestões ao mesmo tempo, poste várias marcações (uma publicação por marcação de tempo).',
        ],

        'message_placeholder' => [
            'general' => 'Digite aqui para publicar em Geral (:version)',
            'generalAll' => 'Digite aqui para publicar em Geral (Todas as dificuldades)',
            'review' => 'Digite aqui para postar uma revisão',
            'timeline' => 'Digite aqui para publicar em Linha do Tempo (:version)',
        ],

        'message_type' => [
            'disqualify' => 'Desqualificar',
            'hype' => 'Hype!',
            'mapper_note' => 'Nota',
            'nomination_reset' => 'Reiniciar nomeação',
            'praise' => 'Elogio',
            'problem' => 'Problema',
            'review' => 'Revisão',
            'suggestion' => 'Sugestão',
        ],

        'mode' => [
            'events' => 'Histórico',
            'general' => 'Geral :scope',
            'reviews' => 'Revisões',
            'timeline' => 'Linha do tempo',
            'scopes' => [
                'general' => 'Esta dificuldade',
                'generalAll' => 'Todas as dificuldades',
            ],
        ],

        'new' => [
            'pin' => 'Fixar',
            'timestamp' => 'Marcação de tempo',
            'timestamp_missing' => 'ctrl-c no editor e ctrl-v na sua mensagem para adicionar uma timestamp!',
            'title' => 'Nova Discussão',
            'unpin' => 'Desafixar',
        ],

        'review' => [
            'new' => 'Nova Revisão',
            'embed' => [
                'delete' => 'Excluir',
                'missing' => '[DISCUSSÃO EXCLUÍDA]',
                'unlink' => 'Desvincular',
                'unsaved' => 'Não salvo',
                'timestamp' => [
                    'all-diff' => 'As postagens em "Todas as dificuldades" não podem ser temporizadas.',
                    'diff' => 'Se este :type começa com marcação de tempo, será mostrado na Linha do Tempo.',
                ],
            ],
            'insert-block' => [
                'paragraph' => 'inserir parágrafo',
                'praise' => 'inserir elogio',
                'problem' => 'inserir problema',
                'suggestion' => 'inserir sugestão',
            ],
        ],

        'show' => [
            'title' => ':title mapeado por :mapper',
        ],

        'sort' => [
            'created_at' => 'Data de criação',
            'timeline' => 'Linha do tempo',
            'updated_at' => 'Última atualização',
        ],

        'stats' => [
            'deleted' => 'Excluído',
            'mapper_notes' => 'Notas',
            'mine' => 'Meus',
            'pending' => 'Pendentes',
            'praises' => 'Elogios',
            'resolved' => 'Resolvidos',
            'total' => 'Tudo',
        ],

        'status-messages' => [
            'approved' => 'Esse beatmap foi aprovado em :date!',
            'graveyard' => "Esse beatmap não foi atualizado desde :date e provavelmente já foi abandonado pelo seu criador...",
            'loved' => 'Esse beatmap foi adicionado ao loved em :date!',
            'ranked' => 'Esse beatmap foi ranqueado em :date!',
            'wip' => 'Nota: Esse beatmap ainda não foi finalizado pelo seu criador.',
        ],

        'votes' => [
            'none' => [
                'down' => 'Sem votos negativos ainda',
                'up' => 'Sem votos positivos ainda',
            ],
            'latest' => [
                'down' => 'Últimos votos negativos',
                'up' => 'Últimos votos positivos',
            ],
        ],
    ],

    'hype' => [
        'button' => 'Dar um Hype!',
        'button_done' => 'Já deu um Hype!',
        'confirm' => "Você tem certeza? Isso irá utilizar um dos seus :n hypes e não poderá ser desfeito.",
        'explanation' => 'Adicione um Hype nesse beatmap e torne-o mais visível para que um Beatmap Nominator possa ranqueá-lo!',
        'explanation_guest' => 'Conecte-se e adicione um Hype nesse beatmap e torne-o mais visível para que um Beatmap Nominator possa ranqueá-lo!',
        'new_time' => "Você ganhará um novo hype em :new_time.",
        'remaining' => 'Você ainda tem :remaining hypes sobrando.',
        'required_text' => 'Hype: :current/:required',
        'section_title' => 'Trenzinho do Hype',
        'title' => 'Hype',
    ],

    'feedback' => [
        'button' => 'Deixar Feedback',
    ],

    'nominations' => [
        'delete' => 'Excluir',
        'delete_own_confirm' => 'Você tem certeza? Esse beatmap será deletado e você será redirecionado de volta para seu perfil.',
        'delete_other_confirm' => 'Você tem certeza? Esse beatmap será deletado e você será redirecionado de volta para seu perfil de usuário.',
        'disqualification_prompt' => 'Motivo da desqualificação?',
        'disqualified_at' => 'Desqualificado :time_ago (:reason).',
        'disqualified_no_reason' => 'sem motivo específico',
        'disqualify' => 'Desqualificar',
        'incorrect_state' => 'Erro ao realizar essa ação, tente atualizar a página.',
        'love' => 'Amar',
        'love_choose' => '',
        'love_confirm' => 'Amar esse beatmap?',
        'nominate' => 'Nomear',
        'nominate_confirm' => 'Nomear este beatmap?',
        'nominated_by' => 'nomeado por :users',
        'not_enough_hype' => "Não há hype suficiente.",
        'remove_from_loved' => 'Remover dos Loved',
        'remove_from_loved_prompt' => 'Motivo da remoção dos Loved:',
        'required_text' => 'Nomeações: :current/:required',
        'reset_message_deleted' => 'excluído',
        'title' => 'Estado de nomeação',
        'unresolved_issues' => 'Ainda há problemas não resolvidos que precisam de uma resposta.',

        'rank_estimate' => [
            '_' => 'Este mapa é estimado a ser ranqueado em :date se nenhum problema for encontrado. É o #:position na :queue.',
            'queue' => 'fila de ranqueamento',
            'soon' => 'em breve',
        ],

        'reset_at' => [
            'nomination_reset' => 'Processo de nomeação reiniciado :time_ago por :user com um novo problema :discussion (:message).',
            'disqualify' => 'Desqualificado :time_ago por :user com um novo problema :discussion (:message).',
        ],

        'reset_confirm' => [
            'nomination_reset' => 'Você tem certeza? Postar um novo problema reiniciará as nomeações.',
            'disqualify' => 'Você tem certeza? Isso irá remover este beatmap da qualificação e reiniciará o processo de nomeação.',
        ],
    ],

    'listing' => [
        'search' => [
            'prompt' => 'digite em palavras-chave...',
            'login_required' => 'Conecte-se para pesquisar.',
            'options' => 'Mais opções de busca',
            'supporter_filter' => 'Filtrar por :filters requer uma osu!supporter tag ativa',
            'not-found' => 'nenhum resultado',
            'not-found-quote' => '... não, nada encontrado.',
            'filters' => [
                'extra' => 'Extra',
                'general' => 'Geral',
                'genre' => 'Gênero',
                'language' => 'Idioma',
                'mode' => 'Modo',
                'nsfw' => 'Beatmaps explícitos',
                'played' => 'Jogado',
                'rank' => 'Rank Conquistado',
                'status' => 'Categorias',
            ],
            'sorting' => [
                'title' => 'Título',
                'artist' => 'Artista',
                'difficulty' => 'Dificuldade',
                'favourites' => 'Favoritos',
                'updated' => 'Atualizado',
                'ranked' => 'Ranqueados',
                'rating' => 'Avaliação',
                'plays' => 'Vezes jogadas',
                'relevance' => 'Relevância',
                'nominations' => 'Nomeações',
            ],
            'supporter_filter_quote' => [
                '_' => 'Filtrar por :filters requer uma :link',
                'link_text' => 'osu!supporter tag',
            ],
        ],
    ],
    'general' => [
        'converts' => 'Incluir beatmaps convertidos',
        'follows' => 'Mappers inscritos',
        'recommended' => 'Dificuldade recomendada',
    ],
    'mode' => [
        'all' => 'Todos',
        'any' => 'Todos',
        'osu' => '',
        'taiko' => '',
        'fruits' => '',
        'mania' => '',
    ],
    'status' => [
        'any' => 'Todos',
        'approved' => 'Aprovado',
        'favourites' => 'Favoritos',
        'graveyard' => 'Cemitério',
        'leaderboard' => 'Possuem Classificações',
        'loved' => 'Loved',
        'mine' => 'Meus Maps',
        'pending' => 'Pendentes & Em Progresso',
        'qualified' => 'Qualificados',
        'ranked' => 'Ranqueados',
    ],
    'genre' => [
        'any' => 'Todos',
        'unspecified' => 'Não Especificado',
        'video-game' => 'Vídeo Game',
        'anime' => 'Anime',
        'rock' => 'Rock',
        'pop' => 'Pop',
        'other' => 'Outro',
        'novelty' => 'Novelty',
        'hip-hop' => 'Hip Hop',
        'electronic' => 'Electronic',
        'metal' => 'Metal',
        'classical' => 'Clássica',
        'folk' => 'Música popular',
        'jazz' => 'Jazz',
    ],
    'mods' => [
        '4K' => '',
        '5K' => '',
        '6K' => '',
        '7K' => '',
        '8K' => '',
        '9K' => '',
        'AP' => '',
        'DT' => '',
        'EZ' => '',
        'FI' => '',
        'FL' => '',
        'HD' => '',
        'HR' => '',
        'HT' => '',
        'MR' => '',
        'NC' => '',
        'NF' => '',
        'NM' => '',
        'PF' => '',
        'RX' => '',
        'SD' => '',
        'SO' => '',
        'TD' => '',
        'V2' => '',
    ],
    'language' => [
        'any' => 'Todos',
        'english' => 'Inglês',
        'chinese' => 'Chinês',
        'french' => 'Francês',
        'german' => 'Alemão',
        'italian' => 'Italiano',
        'japanese' => 'Japonês',
        'korean' => 'Coreano',
        'spanish' => 'Espanhol',
        'swedish' => 'Sueco',
        'russian' => 'Russo',
        'polish' => 'Polonês',
        'instrumental' => 'Instrumental',
        'other' => 'Outro',
        'unspecified' => 'Não especificada',
    ],

    'nsfw' => [
        'exclude' => 'Ocultar',
        'include' => 'Exibir',
    ],

    'played' => [
        'any' => 'Todos',
        'played' => 'Jogado',
        'unplayed' => 'Não jogado',
    ],
    'extra' => [
        'video' => 'Possui Vídeo',
        'storyboard' => 'Possui Storyboard',
    ],
    'rank' => [
        'any' => 'Todos',
        'XH' => 'Silver SS',
        'X' => '',
        'SH' => 'Silver S',
        'S' => '',
        'A' => '',
        'B' => '',
        'C' => '',
        'D' => '',
    ],
    'panel' => [
        'playcount' => 'Vezes jogadas :count',
        'favourites' => 'Favoritos :count',
    ],
    'variant' => [
        'mania' => [
            '4k' => '4K',
            '7k' => '7K',
            'all' => 'Todos',
        ],
    ],
];

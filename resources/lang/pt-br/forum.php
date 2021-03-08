<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'pinned_topics' => 'Tópicos Fixados',
    'slogan' => "é perigoso jogar sozinho.",
    'subforums' => 'Subfóruns',
    'title' => 'osu! fóruns',

    'covers' => [
        'edit' => 'Editar capa',

        'create' => [
            '_' => 'Definir imagem de capa',
            'button' => 'Enviar imagem',
            'info' => 'O tamanho da capa deve ser :dimensions. Você também pode arrastar sua imagem aqui para enviar.',
        ],

        'destroy' => [
            '_' => 'Remover imagem de capa',
            'confirm' => 'Tem certeza de que deseja remover a imagem de capa?',
        ],
    ],

    'forums' => [
        'latest_post' => 'Última Publicação',

        'index' => [
            'title' => 'Índice do Fórum',
        ],

        'topics' => [
            'empty' => 'Sem tópicos!',
        ],
    ],

    'mark_as_read' => [
        'forum' => 'Marcar fórum como lido',
        'forums' => 'Marcar fóruns como lido',
        'busy' => 'Marcando como lido...',
    ],

    'post' => [
        'confirm_destroy' => 'Deseja mesmo a excluir publicação?',
        'confirm_restore' => 'Deseja mesmo restaurar a publicação?',
        'edited' => 'Última edição por :user :when, editado :count vezes no total.',
        'posted_at' => 'publicado :when',
        'posted_by' => 'publicado por :username',

        'actions' => [
            'destroy' => 'Excluir publicação',
            'edit' => 'Editar publicação',
            'report' => 'Denunciar publicação',
            'restore' => 'Restaurar publicação',
        ],

        'create' => [
            'title' => [
                'reply' => 'Nova resposta',
            ],
        ],

        'info' => [
            'post_count' => ':count_delimited publicação|:count_delimited publicações',
            'topic_starter' => 'Autor do tópico',
        ],
    ],

    'search' => [
        'go_to_post' => 'Ir para a publicação',
        'post_number_input' => 'insira o número da publicação',
        'total_posts' => ':posts_count publicações no total',
    ],

    'topic' => [
        'confirm_destroy' => 'Realmente excluir tópico?',
        'confirm_restore' => 'Realmente restaurar tópico?',
        'deleted' => 'tópico excluído',
        'go_to_latest' => 'ver a ultima publicação',
        'has_replied' => 'Você respondeu a este tópico',
        'in_forum' => 'em :forum',
        'latest_post' => ':when por :user',
        'latest_reply_by' => 'última resposta por :user',
        'new_topic' => 'Criar novo tópico',
        'new_topic_login' => 'Conecte-se para criar um novo tópico',
        'post_reply' => 'Publicar',
        'reply_box_placeholder' => 'Escreva aqui para responder',
        'reply_title_prefix' => 'Re',
        'started_by' => 'por :user',
        'started_by_verbose' => 'publicado por :user',

        'actions' => [
            'destroy' => 'Excluir tópico',
            'restore' => 'Restaurar tópico',
        ],

        'create' => [
            'close' => 'Fechar',
            'preview' => 'Pré-visualizar',
            // TL note: this is used in the topic reply preview, when
            // the user goes back from previewing to editing the reply
            'preview_hide' => 'Escrever',
            'submit' => 'Publicar',

            'necropost' => [
                'default' => 'Este tópico está inativo por um tempo. Apenas publique aqui se você tiver um motivo específico para isso.',

                'new_topic' => [
                    '_' => "Este tópico está inativo por um tempo. Se não tiver uma razão especifica para publicar aqui, por favor :create como alternativa.",
                    'create' => 'criar um novo tópico',
                ],
            ],

            'placeholder' => [
                'body' => 'Escreva o conteúdo da publicação aqui',
                'title' => 'Clique aqui para definir o título',
            ],
        ],

        'jump' => [
            'enter' => 'clique para inserir o número específico da publicação',
            'first' => 'ir para a primeira publicação',
            'last' => 'ir para a última publicação',
            'next' => 'pular as próximas 10 publicações',
            'previous' => 'voltar 10 publicações',
        ],

        'post_edit' => [
            'cancel' => 'Cancelar',
            'post' => 'Salvar',
        ],
    ],

    'topic_watches' => [
        'index' => [
            'title_compact' => 'inscrições de fórum',

            'box' => [
                'total' => 'Tópicos inscritos',
                'unread' => 'Tópicos com novas respostas',
            ],

            'info' => [
                'total' => 'Você se inscreveu em :total tópicos.',
                'unread' => 'Você tem :unread respostas não lidas de tópicos inscritos.',
            ],
        ],

        'topic_buttons' => [
            'remove' => [
                'confirmation' => 'Cancelar inscrição no tópico?',
                'title' => 'Cancelar Inscrição',
            ],
        ],
    ],

    'topics' => [
        '_' => 'Tópicos',

        'actions' => [
            'login_reply' => 'Conecte-se para Responder',
            'reply' => 'Responder',
            'reply_with_quote' => 'Citar publicação na resposta',
            'search' => 'Pesquisar',
        ],

        'create' => [
            'create_poll' => 'Criação de Enquete',

            'preview' => 'Pré-visualizar a publicação',

            'create_poll_button' => [
                'add' => 'Criar enquete',
                'remove' => 'Cancelar criação de enquete',
            ],

            'poll' => [
                'hide_results' => 'Esconder os resultados da enquete.',
                'hide_results_info' => 'Eles apenas serão exibidos após a conclusão da enquete.',
                'length' => 'Manter enquete aberta por',
                'length_days_suffix' => 'dias',
                'length_info' => 'Deixe em branco para uma votação sem fim',
                'max_options' => 'Opções por usuário',
                'max_options_info' => 'Este é o número de opções que cada usuário pode selecionar ao votar.',
                'options' => 'Opções',
                'options_info' => 'Coloque cada uma das opções em uma nova linha. Você pode inserir até 10 opções.',
                'title' => 'Pergunta',
                'vote_change' => 'Permitir alteração de voto.',
                'vote_change_info' => 'Caso ativado, usuários poderão alterar o voto.',
            ],
        ],

        'edit_title' => [
            'start' => 'Editar título',
        ],

        'index' => [
            'feature_votes' => 'prioridade de estrela',
            'replies' => 'respostas',
            'views' => 'visualizações',
        ],

        'issue_tag_added' => [
            'to_0' => 'Remover marcador "adicionado"',
            'to_0_done' => 'Marcador "adicionado" removido',
            'to_1' => 'Adicionar marcador "adicionado"',
            'to_1_done' => 'Marcador "adicionado" adicionado',
        ],

        'issue_tag_assigned' => [
            'to_0' => 'Remover marcador "nomeado"',
            'to_0_done' => 'Marcador "nomeado" removido',
            'to_1' => 'Adicionar marcador "nomeado"',
            'to_1_done' => 'Marcador "nomeado" adicionado',
        ],

        'issue_tag_confirmed' => [
            'to_0' => 'Remover marcador "confirmado"',
            'to_0_done' => 'Marcador "confirmado" removido',
            'to_1' => 'Adicionar marcador "confirmado"',
            'to_1_done' => 'Marcador "confirmado" adicionado',
        ],

        'issue_tag_duplicate' => [
            'to_0' => 'Remover marcador "duplicado"',
            'to_0_done' => 'Marcador "duplicado" removido',
            'to_1' => 'Adicionar marcador "duplicado"',
            'to_1_done' => 'Marcador "duplicado" adicionado',
        ],

        'issue_tag_invalid' => [
            'to_0' => 'Remover marcador "inválido"',
            'to_0_done' => 'Marcador "inválido" removido',
            'to_1' => 'Adicionar marcador "inválido"',
            'to_1_done' => 'Marcador "inválido" adicionado',
        ],

        'issue_tag_resolved' => [
            'to_0' => 'Remover marcador "resolvido"',
            'to_0_done' => 'Marcador "resolvido" removido',
            'to_1' => 'Adicionar marcador "resolvido"',
            'to_1_done' => 'Marcador "resolvido" adicionado',
        ],

        'lock' => [
            'is_locked' => 'Este tópico está trancado e não pode mais ser respondido',
            'to_0' => 'Destrancar tópico',
            'to_0_confirm' => 'Destrancar tópico?',
            'to_0_done' => 'Tópico destrancado',
            'to_1' => 'Trancar tópico',
            'to_1_confirm' => 'Trancar tópico?',
            'to_1_done' => 'Tópico trancado',
        ],

        'moderate_move' => [
            'title' => 'Mover para outro fórum',
        ],

        'moderate_pin' => [
            'to_0' => 'Desafixar tópico',
            'to_0_confirm' => 'Desafixar tópico?',
            'to_0_done' => 'Tópico desafixado',
            'to_1' => 'Fixar tópico',
            'to_1_confirm' => 'Fixar tópico?',
            'to_1_done' => 'Tópico fixado',
            'to_2' => 'Fixar tópico e marcar como anúncio',
            'to_2_confirm' => 'Fixar tópico e marcar como anúncio?',
            'to_2_done' => 'Tópico fixado e marcado como anúncio',
        ],

        'moderate_toggle_deleted' => [
            'show' => 'Exibir publicações excluídas',
            'hide' => 'Ocultar publicações excluídas',
        ],

        'show' => [
            'deleted-posts' => 'Publicações Excluídas',
            'total_posts' => 'Total de publicações',

            'feature_vote' => [
                'current' => 'Prioridade Atual: +:count',
                'do' => 'Promover este pedido',

                'info' => [
                    '_' => 'Esse é um :feature_request. Pedidos de recursos podem ser votados por :supporters.',
                    'feature_request' => 'pedido de recurso',
                    'supporters' => 'supporters',
                ],

                'user' => [
                    'count' => '{0} sem votos|{1} :count voto|[2,*] :count votos',
                    'current' => 'Você tem :votes restantes.',
                    'not_enough' => "Você não tem mais votos restantes",
                ],
            ],

            'poll' => [
                'edit' => 'Edição de enquete',
                'edit_warning' => 'Editar uma enquete irá remover os resultados atuais!',
                'vote' => 'Votar',

                'button' => [
                    'change_vote' => 'Alterar voto',
                    'edit' => 'Editar enquete',
                    'view_results' => 'Ir para resultados',
                    'vote' => 'Votar',
                ],

                'detail' => [
                    'end_time' => 'A votação encerrará às :time',
                    'ended' => 'Votação encerrada :time',
                    'results_hidden' => 'Os resultados serão exibidos após a conclusão da enquete.',
                    'total' => 'Total de votos: :count',
                ],
            ],
        ],

        'watch' => [
            'to_not_watching' => 'Não marcada',
            'to_watching' => 'Marcar',
            'to_watching_mail' => 'Marcar com notificação',
            'tooltip_mail_disable' => 'Notificação está habilitada. Clique para desativar',
            'tooltip_mail_enable' => 'Notificação está desativada. Clique para habilitar',
        ],
    ],
];

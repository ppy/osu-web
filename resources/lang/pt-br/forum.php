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
    'pinned_topics' => 'Tópicos Fixados',
    'slogan' => "é perigoso jogar sozinho.",
    'subforums' => 'Subfóruns',
    'title' => 'osu! fóruns',

    'covers' => [
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

    'email' => [
        'new_reply' => '[osu!] Nova resposta no tópico ":title"',
    ],

    'forums' => [
        'topics' => [
            'empty' => 'Sem tópicos!',
        ],
    ],

    'post' => [
        'confirm_destroy' => 'Excluir mesmo a publicação?',
        'confirm_restore' => 'Restaurar mesmo a publicação?',
        'edited' => 'Última edição por :user :when, editado :count vezes no total.',
        'posted_at' => 'publicado :when',

        'actions' => [
            'destroy' => 'Excluir publicação',
            'restore' => 'Restaurar publicação',
            'edit' => 'Editar publicação',
        ],
    ],

    'search' => [
        'go_to_post' => 'Ir para a publicação',
        'post_number_input' => 'insira o número da publicação',
        'total_posts' => ':posts_count publicações no total',
    ],

    'topic' => [
        'deleted' => 'tópico excluído',
        'go_to_latest' => 'ver a ultima publicação',
        'latest_post' => ':when por :user',
        'latest_reply_by' => 'última resposta por :user',
        'new_topic' => 'Publicar um novo tópico',
        'new_topic_login' => 'Conecte-se para criar um novo tópico',
        'post_reply' => 'Publicar',
        'reply_box_placeholder' => 'Escreva aqui para responder',
        'reply_title_prefix' => 'Re',
        'started_by' => 'por :user',
        'started_by_verbose' => 'publicado por :user',

        'create' => [
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
            'title' => 'Inscrições de Fórum',
            'title_compact' => 'inscrições de fórum',
            'title_main' => '<strong>Inscrições</strong> de Fórum',

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

            'create_poll_button' => [
                'add' => 'Criar enquete',
                'remove' => 'Cancelar criação de enquete',
            ],

            'poll' => [
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
            'views' => 'visualizações',
            'replies' => 'respostas',
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
            'to_0_done' => 'Tópico destrancado',
            'to_1' => 'Trancar tópico',
            'to_1_done' => 'Tópico trancado',
        ],

        'moderate_move' => [
            'title' => 'Mover para outro fórum',
        ],

        'moderate_pin' => [
            'to_0' => 'Desafixar tópico',
            'to_0_done' => 'Tópico desafixado',
            'to_1' => 'Fixar tópico',
            'to_1_done' => 'Tópico fixado',
            'to_2' => 'Fixar tópico e marcar como anúncio',
            'to_2_done' => 'Tópico fixado e marcado como anúncio',
        ],

        'show' => [
            'deleted-posts' => 'Publicações Excluídas',
            'total_posts' => 'Total de publicações',

            'feature_vote' => [
                'current' => 'Prioridade Atual: +:count',
                'do' => 'Promover este pedido',

                'user' => [
                    'count' => '{0} sem votos|{1} :count voto|[2,*] :count votos',
                    'current' => 'Você tem :votes restantes.',
                    'not_enough' => "Você não tem mais votos restantes",
                ],
            ],

            'poll' => [
                'vote' => 'Votar',

                'detail' => [
                    'end_time' => 'A votação encerrará às :time',
                    'ended' => 'Votação encerrada :time',
                    'total' => 'Total de votos: :count',
                ],
            ],
        ],

        'watch' => [
            'to_not_watching' => 'Não marcada',
            'to_watching' => 'Marcar',
            'to_watching_mail' => 'Marcar com notificação',
            'mail_disable' => 'Desabilitar notificação',
        ],
    ],
];

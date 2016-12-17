<?php
/**
 *    Copyright 2015 ppy Pty. Ltd.
 *
 *    This file is part of osu!web. osu!web is distributed in the hopes of
 *    attracting more community contributions to the core ecosystem of osu!
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
    'covers' => [
        'create' => [
            '_' => 'Definir imagem de capa',
            'button' => 'Enviar imagem',
            'info' => 'O tamanho da capa deve ser :dimensions. Você também pode arrastar sua imagem aqui para enviar.'
        ],
        'destroy' => [
            '_' => 'Remover imagem de capa',
            'confirm' => 'Tem certeza de que deseja remover a imagem da capa?'
        ]
    ],
    'email' => [
        'new_reply' => '[osu!] Nova resposta no tópico ":title"'
    ],
    'forums' => [
        'topics' => [
            'empty' => 'Sem tópicos!'
        ]
    ],
    'pinned_topics' => 'Tópicos fixados',
    'post' => [
        'confirm_delete' => 'Excluir mesmo a publicação?',
        'edited' => 'Última edição por :user em :when, editado :count vezes no total.',
        'posted_at' => 'publicado em :when',
        'actions' => [
            'delete' => 'Excluir publicação?',
            'edit' => 'Editar publicação'
        ]
    ],
    'search' => [
        'go_to_post' => 'Ir para a publicação',
        'post_number_input' => 'digite o número da publicação',
        'total_posts' => ':posts_count publicações no total'
    ],
    'subforums' => 'Subfóruns',
    'title' => 'osu!community',
    'topic' => [
        'create' => [
            'placeholder' => [
                'body' => 'Digite o conteúdo da publicação aqui',
                'title' => 'Clique aqui para definir o título'
            ],
            'preview' => 'Pré-visualização',
            'submit' => 'Publicar'
        ],
        'go_to_latest' => 'ver a última publicação',
        'jump' => [
            'enter' => 'clique para inserir um número de publicação específico',
            'first' => 'ir para a primeira publicação',
            'last' => 'ir para a última publicação',
            'next' => 'pular as próximas 10 publicações',
            'previous' => 'voltar 10 publicações'
        ],
        'latest_post' => ':when por :user',
        'latest_reply_by' => 'última resposta por :user',
        'new_topic' => 'Publicar novo tópico',
        'post_edit' => [
            'cancel' => 'Cancelar',
            'post' => 'Salvar',
            'zoom' => [
                'start' => 'Tela cheia',
                'end' => 'Sair da tela cheia'
            ]
        ],
        'post_reply' => 'Publicar',
        'reply_box_placeholder' => 'Digite aqui para responder',
        'started_by' => 'por :user'
    ],
    'topic_watches' => [
        'index' => [
            'title' => 'Inscrições de tópico',
            'title_compact' => 'inscrições',
            'box' => [
                'total' => 'Tópicos inscritos',
                'unread' => 'Tópicos com novas respostas'
            ],
            'info' => [
                'total' => 'Você se inscreveu em :total tópicos.',
                'unread' => 'Você tem :unread respostas não lidas de tópicos inscritos.'
            ]
        ],
        'topic_buttons' => [
            'remove' => [
                'confirmation' => 'Cancelar inscrição no tópico?',
                'title' => 'Cancelar inscrição'
            ]
        ]
    ],
    'topics' => [
        '_' => 'Tópicos',
        'actions' => [
            'reply' => 'Exibir caixa de resposta',
            'reply_with_quote' => 'Citar publicação na resposta'
        ],
        'create' => [
            'create_poll' => 'Criação de enquete',
            'create_poll_button' => [
                'add' => 'Criar enquete',
                'remove' => 'Cancelar criação de enquete'
            ],
            'poll' => [
                'length' => 'Manter enquete aberta por',
                'length_days_prefix' => '',
                'length_days_suffix' => 'dias',
                'length_info' => 'Deixe em branco para uma votação sem fim',
                'max_options' => 'Opções por usuário',
                'max_options_info' => 'Este é o número de opções que cada usuário pode selecionar ao votar.',
                'options' => 'Opções',
                'options_info' => 'Coloque cada uma das opções em uma nova linha. Você pode inserir até 10 opções.',
                'title' => 'Pergunta',
                'vote_change' => 'Permitir alteração de voto.',
                'vote_change_info' => 'Caso ativado, usuários poderão alterar o voto.'
            ]
        ],
        'index' => [
            'views' => 'visualizações',
            'replies' => 'respostas'
        ],
        'lock' => [
            'is_locked' => 'Este tópico está trancado e não pode mais ser respondido',
            'lock-0' => 'Destrancar tópico',
            'lock-1' => 'Trancar tópico',
            'state-0' => 'Tópico destrancado',
            'state-1' => 'Tópico trancado'
        ],
        'moderate_move' => [
            'title' => 'Mover para outro fórum'
        ],
        'moderate_pin' => [
            'pin-0' => 'Desafixar tópico',
            'pin-1' => 'Fixar tópico',
            'state-0' => 'Tópico desafixado',
            'state-1' => 'Tópico fixado'
        ],
        'show' => [
            'total_posts' => 'Total de publicações',
            'feature_vote' => [
                'current' => 'Prioridade atual: +:count',
                'do' => 'Promover este pedido',
                'user' => [
                    'count' => '{0} sem votos|{1} :count voto|[2,Inf] :count votos',
                    'current' => 'Você tem :votes restantes.',
                    'not_enough' => 'Você não tem mais votos restantes'
                ]
            ],
            'poll' => [
                'vote' => 'Votar',
                'detail' => [
                    'total' => 'Total de votos: :count',
                    'ended' => 'Votação encerrada :time',
                    'end_time' => 'A votação encerrará às :time'
                ]
            ]
        ],
        'watch' => [
            'state-0' => 'Inscrição cancelada',
            'state-1' => 'Inscrito no tópico',
            'watch-0' => 'Cancelar inscrição no tópico',
            'watch-1' => 'Inscrever-se no tópico'
        ]
    ]
];

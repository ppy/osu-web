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
            'info' => 'O tamanho da capa deve ser :dimensions. Você também pode arrastar sua imagem aqui para enviar.',
        ],

        'destroy' => [
            '_' => 'Remover imagem de capa',
            'confirm' => 'Você tem certeza que quer remover esta imagem de capa?',
        ],
    ],

    'email' => [
        'new_reply' => '[osu!] :title',
    ],

    'forums' => [
        'topics' => [
            'empty' => 'Sem tópicos!',
        ],
    ],

    'pinned_topics' => 'Tópicos Fixados',
    'post' => [
        'confirm_delete' => 'Deletar post?',
        'edited' => 'Editado pela última vez por :user em :when, editado :count vezes no total.',
        'posted_at' => 'postado :when',
        'actions' => [
            'delete' => 'Deletar post',
            'edit' => 'Editar post',
        ],
    ],
    'search' => [
        'go_to_post' => 'Ir para post',
        'post_number_input' => 'digite número do post',
        'total_posts' => ':posts_count posts no total',
    ],
    'subforums' => 'Subfórums',
    'title' => 'osu!community',
    'topic' => [
        'create' => [
            'placeholder' => [
                'body' => 'Digite conteúdo do post aqui',
                'title' => 'Clique aqui para ver o título',
            ],
            'preview' => 'Preview',
            'submit' => 'Post',
        ],
        'go_to_latest' => 'ver último post',
        'jump' => [
            'enter' => 'clique para digitar um número de post específico',
            'first' => 'ir para o primeiro post',
            'last' => 'ir para o último post',
            'next' => 'pular os próximos 10 posts',
            'previous' => 'voltar 10 posts',
        ],
        'latest_post' => ':when por :user',
        'latest_reply_by' => 'última resposta por :user',
        'new_topic' => 'Postar novo tópico',
        'post_edit' => [
            'cancel' => 'Cancelar',
            'post' => 'Salvar',
            'zoom' => [
                'start' => 'Tela Cheia',
                'end' => 'Sair de Tela Cheia',
            ],
        ],
        'post_reply' => 'Post',
        'reply_box_placeholder' => 'Digite aqui para responder',
        'started_by' => 'por :user',
    ],

    'topic_watches' => [
        'index' => [
            'title' => 'Tópico de Aincrições',
            'title_compact' => 'inscrição',

            'box' => [
                'total' => 'Tópicos inscritos',
                'unread' => 'Tópicos com novas respostas',
            ],
            'info' => [
                'total' => 'Vcoê se inscreveu em :total tópicos.',
                'unread' => 'Vcoê tem :unread respostas não lidas de tópicos inscritos.',
            ],
        ],

        'topic_buttons' => [
            'remove' => [
                'confirmation' => 'Cancelar a inscrição do tópico?',
                'title' => 'Cancelar inscrição',
            ],
        ],
    ],

    'topics' => [
        '_' => 'Tópicos',

        'actions' => [
            'reply' => 'Mostrar caixa de resposta',
            'reply_with_quote' => 'Citar post para resposta',
        ],

    'create' => [
        'create_poll' => 'Criação de votação',

        'create_poll_button' => [
            'add' => 'Criar uma votação',
            'remove' => 'Cancelar criação de votação',
            ],

            'poll' => [
                'length' => 'Ir para a votação',
                'length_days_prefix' => '',
                'length_days_suffix' => 'dias',
                'length_info' => 'Deixe em branco para uma votação sem fim',
                'max_options' => 'Opções por usuário',
                'max_options_info' => 'Este é o número de opções de cada usuário pode selecionar ao votar.',
                'options' => 'Opções',
                'options_info' => 'Coloque cada uma das opções em uma nova linha. Você pode inserir até 10 opções.',
                'title' => 'Questão',
                'vote_change' => 'Permitir re-votação.',
                'vote_change_info' => 'Se ativado, os usuários são capazes de mudar o seu voto.',
            ],
        ],

        'index' => [
            'views' => 'visualizações',
            'replies' => 'respostas',
        ],

        'lock' => [
            'is_locked' => 'Este tópico está trancado e não pode mais ser respondido',
            'lock-0' => 'Tópico destrancado',
            'lock-1' => 'Tópico trancado',
            'state-0' => 'Tópico foi destrancado',
            'state-1' => 'Tópico foi trancado',
        ],

        'moderate_move' => [
            'title' => 'Mover para outro fórum',
        ],

        'pin' => [
            'pin-0' => 'Desprender tópico',
            'pin-1' => 'Prender tópico',
            'pinned-0' => 'Tópico foi desprendido',
            'pinned-1' => 'Tópico foi preso',
        ],

        'show' => [
            'feature_vote' => [
                'current' => 'Prioridade Atual: +:count',
                'do' => 'Promover este pedido',

                'user' => [
                    'current' => 'Você tem :votes restantes.',
                    'count' => '{0} sem votos|{1} :count voto|[2,Inf] :count votos',
                    'not_enough' => 'Você não tem mais votos sobrando',
                ],
            ],

        'poll' => [
                'vote' => 'Voto',

                'detail' => [
                    'total' => 'Total de votos: :count',
                    'ended' => 'Votação encerrada :time',
                    'end_time' => 'A votação encerrará às :time',
                ],
            ],
    ],

    'watch' => [
            'state-0' => 'Cancelar inscrição do tópico',
            'state-1' => 'Inscrever no tópico',
            'watch-0' => 'Inscrição cancelada no tópico',
            'watch-1' => 'Inscrito no tópico',
        ],
    ],

];

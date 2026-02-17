<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'applications' => [
        'accept' => [
            'ok' => 'Usuário adicionado à equipe.',
        ],
        'destroy' => [
            'ok' => 'Pedido de adesão cancelado.',
        ],
        'reject' => [
            'ok' => 'Pedido de adesão rejeitado.',
        ],
        'store' => [
            'ok' => 'Solicitado para se juntar à equipe.',
        ],
    ],

    'card' => [
        'members' => ':count_delimited jogador|:count_delimited jogadores',
    ],

    'create' => [
        'submit' => 'Criar Equipe',

        'form' => [
            'name_help' => 'O nome da sua equipe. O nome é permanente no momento.',
            'short_name_help' => 'Máximo de 4 caracteres.',
            'title' => "Vamos criar uma equipe",
        ],

        'intro' => [
            'description' => "Jogue com seus amigos; atuais ou novos. Você não está em uma equipe no momento. Junte-se a uma equipe existente ao visitar a sua página ou crie sua própria equipe a partir dessa página.",
            'title' => 'Equipe!',
        ],
    ],

    'destroy' => [
        'ok' => 'Time removido',
    ],

    'edit' => [
        'ok' => 'Configurações salvas com sucesso.',
        'title' => 'Configurações da Equipe',

        'description' => [
            'label' => 'Descrição',
            'title' => 'Descrição da Equipe',
        ],

        'flag' => [
            'label' => 'Tag da Equipe',
            'title' => 'Definir Bandeira da Equipe',
        ],

        'header' => [
            'label' => 'Imagem do cabeçalho',
            'title' => 'Definir imagem do cabeçalho',
        ],

        'settings' => [
            'application_help' => 'Se deve permitir que as pessoas se inscrevam para a equipe',
            'default_ruleset_help' => 'O conjunto de regras a ser selecionado por padrão quando visitar a página da equipe',
            'flag_help' => 'Tamanho máximo de :width×:height',
            'header_help' => 'Tamanho máximo de :width×:height',
            'title' => 'Configurações da Equipe',

            'application_state' => [
                'state_0' => 'Fechado',
                'state_1' => 'Aberto',
            ],
        ],
    ],

    'header_links' => [
        'edit' => 'configurações',
        'leaderboard' => 'placar',
        'show' => 'informações',

        'members' => [
            'index' => 'gerenciar membros',
        ],
    ],

    'leaderboard' => [
        'global_rank' => 'Classificação Global',
    ],

    'members' => [
        'destroy' => [
            'success' => 'Membro da equipe removido',
        ],

        'index' => [
            'title' => 'Gerenciar Membros',

            'applications' => [
                'accept_confirm' => 'Adicionar usuário :user para a equipe?',
                'created_at' => 'Solicitado em',
                'empty' => 'Nenhum pedido de adesão no momento.',
                'empty_slots' => 'Vagas disponíveis',
                'empty_slots_overflow' => ':count_delimited excedente de usuário|:count_delimited excedente de usuários',
                'reject_confirm' => 'Recusar solicitação de adesão do usuário :user?',
                'title' => 'Pedidos de Adesão',
            ],

            'table' => [
                'joined_at' => 'Data de Registro',
                'remove' => 'Remover',
                'remove_confirm' => 'Remover usuário :user da equipe?',
                'set_leader' => 'Transferir liderança da equipe',
                'set_leader_confirm' => 'Transferir liderança da equipe para usuário :user?',
                'status' => 'Situação',
                'title' => 'Membros atuais',
            ],

            'status' => [
                'status_0' => 'Inativo',
                'status_1' => 'Ativo',
            ],
        ],

        'set_leader' => [
            'success' => 'O usuário :user agora é o líder da equipe.',
        ],
    ],

    'part' => [
        'ok' => 'Deixou a equipe ;_;',
    ],

    'show' => [
        'bar' => [
            'chat' => 'Chat da Equipe',
            'destroy' => 'Dispensar Equipe',
            'join' => 'Pedir para juntar-se',
            'join_cancel' => 'Cancelar Entrada',
            'part' => 'Deixar a equipe',
        ],

        'info' => [
            'created' => 'Formado',
        ],

        'members' => [
            'members' => 'Membros da equipe',
            'owner' => 'Líder da Equipe',
        ],

        'sections' => [
            'about' => 'Sobre Nós!',
            'info' => 'Info',
            'members' => 'Membros',
        ],

        'statistics' => [
            'empty_slots' => ':count_delimited de espaço disponível|:count_delimited de espaços disponíveis',
            'first_places' => '',
            'leader' => 'Líder da Equipe',
            'rank' => 'Classificação',
            'ranked_beatmapsets' => '',
        ],
    ],

    'store' => [
        'ok' => 'Equipe criada.',
    ],
];

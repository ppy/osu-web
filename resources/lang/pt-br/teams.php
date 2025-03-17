<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'applications' => [
        'accept' => [
            'ok' => 'Adicionado usuário à equipe.',
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

    'create' => [
        'submit' => '',

        'form' => [
            'name_help' => '',
            'short_name_help' => '',
            'title' => "",
        ],

        'intro' => [
            'description' => "",
            'title' => '',
        ],
    ],

    'destroy' => [
        'ok' => 'Time removido',
    ],

    'edit' => [
        'ok' => '',
        'title' => 'Configurações da Equipe',

        'description' => [
            'label' => 'Descrição',
            'title' => 'Descrição da Equipe',
        ],

        'flag' => [
            'label' => '',
            'title' => '',
        ],

        'header' => [
            'label' => 'Imagem do cabeçalho',
            'title' => 'Definir imagem do cabeçalho',
        ],

        'settings' => [
            'application_help' => 'Se deve permitir que as pessoas se inscrevam para a equipe',
            'default_ruleset_help' => 'O conjunto de regras a ser selecionado por padrão quando visitar a página da equipe',
            'flag_help' => '',
            'header_help' => '',
            'title' => 'Configurações da Equipe',

            'application_state' => [
                'state_0' => 'Fechado',
                'state_1' => 'Abrir',
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
        'global_rank' => 'Ranking Global',
    ],

    'members' => [
        'destroy' => [
            'success' => 'Membro da equipe removido',
        ],

        'index' => [
            'title' => 'Gerenciar Membros',

            'applications' => [
                'empty' => 'Nenhum pedido de adesão no momento.',
                'empty_slots' => 'Espaços disponíveis',
                'title' => 'Pedidos de Adesão',
                'created_at' => 'Solicitado em',
            ],

            'table' => [
                'status' => 'Situação',
                'joined_at' => 'Data de Registro',
                'remove' => 'Remover',
                'title' => 'Membros atuais',
            ],

            'status' => [
                'status_0' => 'Inativo',
                'status_1' => 'Ativo',
            ],
        ],
    ],

    'part' => [
        'ok' => 'Deixou a equipe ;_;',
    ],

    'show' => [
        'bar' => [
            'chat' => '',
            'destroy' => 'Dispensar Equipe',
            'join' => 'Pedir para juntar-se',
            'join_cancel' => 'Cancelar Entrada',
            'part' => 'Deixe a equipe',
        ],

        'info' => [
            'created' => 'Formado',
        ],

        'members' => [
            'members' => 'Membros da equipe',
            'owner' => 'Líder de Equipe',
        ],

        'sections' => [
            'about' => '',
            'info' => 'Info',
            'members' => 'Membros',
        ],

        'statistics' => [
            'rank' => '',
            'leader' => '',
        ],
    ],

    'store' => [
        'ok' => '',
    ],
];

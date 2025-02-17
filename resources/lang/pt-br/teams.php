<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'applications' => [
        'accept' => [
            'ok' => '',
        ],
        'destroy' => [
            'ok' => '',
        ],
        'reject' => [
            'ok' => '',
        ],
        'store' => [
            'ok' => '',
        ],
    ],

    'destroy' => [
        'ok' => '',
    ],

    'edit' => [
        'saved' => 'Configurações salvas com sucesso',
        'title' => 'Configurações da Equipe',

        'description' => [
            'label' => 'Descrição',
            'title' => 'Descrição da Equipe',
        ],

        'header' => [
            'label' => 'Imagem do cabeçalho',
            'title' => 'Definir imagem do cabeçalho',
        ],

        'logo' => [
            'label' => 'Bandeira da Equipe',
            'title' => 'Definir Bandeira da Equipe',
        ],

        'settings' => [
            'application' => 'Aplicativo de Equipe',
            'application_help' => 'Se deve permitir que as pessoas se inscrevam para a equipe',
            'default_ruleset' => 'Regras padrão',
            'default_ruleset_help' => 'O conjunto de regras a ser selecionado por padrão quando visitar a página da equipe',
            'title' => 'Configurações da Equipe',
            'url' => 'URL',

            'application_state' => [
                'state_0' => 'Fechado',
                'state_1' => 'Abrir',
            ],
        ],
    ],

    'header_links' => [
        'edit' => '',
        'leaderboard' => '',
        'show' => '',

        'members' => [
            'index' => '',
        ],
    ],

    'leaderboard' => [
        'global_rank' => '',
        'performance' => '',
        'total_score' => '',
    ],

    'members' => [
        'destroy' => [
            'success' => 'Membro da equipe removido',
        ],

        'index' => [
            'title' => 'Gerenciar Membros',

            'applications' => [
                'empty' => '',
                'empty_slots' => '',
                'title' => '',
                'created_at' => '',
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
        'ok' => '',
    ],

    'show' => [
        'bar' => [
            'destroy' => '',
            'join' => '',
            'join_cancel' => '',
            'part' => '',
        ],

        'info' => [
            'created' => 'Formado',
            'website' => 'Website',
        ],

        'members' => [
            'members' => 'Membros da equipe',
            'owner' => 'Líder de Equipe',
        ],

        'sections' => [
            'info' => 'Info',
            'members' => 'Membros',
        ],
    ],
];

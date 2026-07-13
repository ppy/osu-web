<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'applications' => [
        'accept' => [
            'ok' => 'Jogador adicionado à equipa.',
        ],
        'destroy' => [
            'ok' => 'Pedido de adesão cancelado.',
        ],
        'reject' => [
            'ok' => 'Pedido de adesão rejeitado.',
        ],
        'store' => [
            'ok' => 'Pediu para se juntar à equipa.',
        ],
    ],

    'card' => [
        'members' => ':count_delimited membro|:count_delimited membros',
    ],

    'create' => [
        'submit' => 'Criar uma Equipa',

        'form' => [
            'name_help' => 'O nome da sua equipa. De momento, o nome é permanente.',
            'short_name_help' => 'Máximo de 4 caracteres.',
            'title' => "Vamos criar uma equipa",
        ],

        'intro' => [
            'description' => "Jogue com amigos, sejam eles já existentes ou novos. De momento, não pertence a nenhuma equipa. Junte‑se a uma equipa existente visitando a página dessa equipa ou crie a sua própria equipa a partir desta página.",
            'search_link' => '',
            'title' => 'Equipa!',
        ],
    ],

    'destroy' => [
        'ok' => 'Equipa removida.',
    ],

    'edit' => [
        'ok' => 'Definições guardadas com êxito.',
        'title' => 'Definições da equipa',

        'description' => [
            'label' => 'Descrição',
            'title' => 'Descrição da equipa',
        ],

        'flag' => [
            'label' => 'Bandeira da equipa',
            'title' => 'Definir a bandeira da equipa',
        ],

        'header' => [
            'label' => 'Imagem do cabeçalho',
            'title' => 'Definir a imagem do cabeçalho',
        ],

        'settings' => [
            'application_help' => 'Permitir que as pessoas se candidatem à equipa',
            'default_ruleset_help' => 'O conjunto de modos de jogo a selecionar por omissão quando se visita a página da equipa',
            'flag_help' => 'Tamanho máximo de :width×:height',
            'header_help' => 'Tamanho máximo de :width×:height',
            'title' => 'Definições da equipa',

            'application_state' => [
                'state_0' => 'Fechadas',
                'state_1' => 'Abertas',
            ],
        ],
    ],

    'header_links' => [
        'edit' => 'definições',
        'leaderboard' => 'tabela de classificação',
        'show' => 'informações',

        'members' => [
            'index' => 'gerir membros',
        ],
    ],

    'leaderboard' => [
        'global_rank' => 'Classificação Global',
    ],

    'members' => [
        'destroy' => [
            'success' => 'Membro da equipa removido',
        ],

        'index' => [
            'title' => 'Gerir Membros',

            'applications' => [
                'accept_confirm' => 'Quer adicionar o jogador :user à equipa?',
                'created_at' => 'Pedido a',
                'empty' => 'Não existem pedidos de adesão agora.',
                'empty_slots' => 'Vagas disponíveis',
                'empty_slots_overflow' => ':count_delimited utilizador em excesso|:count_delimited utilizadores em excesso',
                'reject_confirm' => 'Quer negar o pedido de adesão do jogador :user?',
                'title' => 'Pedidos de adesão',
            ],

            'table' => [
                'joined_at' => 'Data de adesão',
                'remove' => 'Remover',
                'remove_confirm' => 'Quer eliminar o jogador :user da equipa?',
                'set_leader' => 'Transferir a liderança da equipa',
                'set_leader_confirm' => 'Quer transferir a liderança da equipa ao jogador :user?',
                'status' => 'Estado',
                'title' => 'Membros atuais',
            ],

            'status' => [
                'status_0' => 'Inativos',
                'status_1' => 'Ativos',
            ],
        ],

        'set_leader' => [
            'success' => 'O utilizador :user é agora o líder da equipa.',
        ],
    ],

    'part' => [
        'ok' => 'Deixou a equipa ;_;',
    ],

    'show' => [
        'bar' => [
            'chat' => 'Conversa da equipa',
            'destroy' => 'Dissolver equipa',
            'join' => 'Pedir para aderir',
            'join_cancel' => 'Cancelar pedido de adesão',
            'part' => 'Sair da equipa',
        ],

        'info' => [
            'created' => 'Formada a',
        ],

        'members' => [
            'members' => 'Membros da equipa',
            'owner' => 'Líder da equipa',
        ],

        'sections' => [
            'about' => 'Sobre nós!',
            'info' => 'Informações',
            'members' => 'Membros',
        ],

        'statistics' => [
            'empty_slots' => ':count_delimited vaga disponível|:count_delimited vagas disponíveis',
            'first_places' => 'Primeiros lugares',
            'leader' => 'Líder da Equipa',
            'rank' => 'Classificação',
            'ranked_beatmapsets' => 'Mapas classificados',
        ],
    ],

    'store' => [
        'ok' => 'Equipa criada.',
    ],
];

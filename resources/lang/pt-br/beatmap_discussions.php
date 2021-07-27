<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'authorizations' => [
        'update' => [
            'null_user' => 'Precisa estar conectado para editar.',
            'system_generated' => 'Postagens geradas pelo sistema não podem ser editadas.',
            'wrong_user' => 'É necessário ser o dono da publicação para editá-la.',
        ],
    ],

    'events' => [
        'empty' => 'Nada aconteceu... ainda.',
    ],

    'index' => [
        'deleted_beatmap' => 'excluído',
        'none_found' => 'Não foram encontradas discussões que correspondam aos critérios de pesquisa.',
        'title' => 'Discussão do Beatmap',

        'form' => [
            '_' => 'Pesquisar',
            'deleted' => 'Incluir discussões excluídas',
            'mode' => 'Modo de jogo',
            'only_unresolved' => 'Mostrar apenas discussões não resolvidas',
            'types' => 'Tipos de mensagem',
            'username' => 'Nome de Usuário',

            'beatmapset_status' => [
                '_' => 'Status do Beatmap',
                'all' => 'Todos',
                'disqualified' => 'Desqualificado',
                'never_qualified' => 'Nunca Qualificado',
                'qualified' => 'Qualificado',
                'ranked' => 'Ranqueado',
            ],

            'user' => [
                'label' => 'Usuário',
                'overview' => 'Supervisão de atividades',
            ],
        ],
    ],

    'item' => [
        'created_at' => 'Data de publicação',
        'deleted_at' => 'Data de exclusão',
        'message_type' => 'Tipo',
        'permalink' => 'Copiar link da publicação',
    ],

    'nearby_posts' => [
        'confirm' => 'Nenhuma das postagens corresponde ao que procuro',
        'notice' => 'Existem postagens próximas de :timestamp (:existing_timestamps). Por favor, visualize-as antes de postar.',
        'unsaved' => ':count nesta revisão',
    ],

    'owner_editor' => [
        'button' => 'Dono da Dificuldade',
        'reset_confirm' => 'Redefinir o proprietário para esta dificuldade?',
        'user' => 'Dono',
        'version' => 'Dificuldade',
    ],

    'reply' => [
        'open' => [
            'guest' => 'Conecte-se para Responder',
            'user' => 'Responder',
        ],
    ],

    'review' => [
        'block_count' => ':used / :max blocos usados',
        'go_to_parent' => 'Ver Publicação de Revisão',
        'go_to_child' => 'Ver Discussão',
        'validation' => [
            'block_too_large' => 'cada bloco só pode conter até :limit caracteres',
            'external_references' => 'revisão contém referências a problemas que não pertencem a esta revisão',
            'invalid_block_type' => 'tipo de bloco inválido',
            'invalid_document' => 'revisão inválida',
            'invalid_discussion_type' => '',
            'minimum_issues' => 'revisão deve conter um mínimo de :count problema|revisão deve conter um mínimo de :count problemas',
            'missing_text' => 'bloco está sem texto',
            'too_many_blocks' => 'revisões podem conter apenas :count parágrafo/problema|revisões só podem conter até :count parágrafos/problemas',
        ],
    ],

    'system' => [
        'resolved' => [
            'true' => 'Marcado como resolvido por :user',
            'false' => 'Reaberto por :user',
        ],
    ],

    'timestamp_display' => [
        'general' => 'geral',
        'general_all' => 'geral (tudo)',
    ],

    'user_filter' => [
        'everyone' => 'Todos',
        'label' => 'Filtrar por usuário',
    ],
];

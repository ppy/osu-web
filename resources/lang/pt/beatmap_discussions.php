<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'authorizations' => [
        'update' => [
            'null_user' => 'Tens que ter sessão iniciada para editar.',
            'system_generated' => 'Não se pode editar uma publicação gerada pelo sistema.',
            'wrong_user' => 'Tens que ser dono da publicação para editar.',
        ],
    ],

    'events' => [
        'empty' => 'Nada aconteceu... por enquanto.',
    ],

    'index' => [
        'deleted_beatmap' => 'apagado',
        'none_found' => 'Não foram encontradas discussões que correspondam a esse critério de pesquisa.',
        'title' => 'Discussões do beatmap',

        'form' => [
            '_' => 'Pesquisar',
            'deleted' => 'Incluir discussões eliminadas',
            'mode' => 'Modo beatmap',
            'only_unresolved' => 'Mostrar apenas as discussões não resolvidas',
            'types' => 'Tipos de mensagem',
            'username' => 'Nome de utilizador',

            'beatmapset_status' => [
                '_' => 'Estado do beatmap',
                'all' => 'Todos',
                'disqualified' => 'Desqualificado',
                'never_qualified' => 'Nunca qualificado',
                'qualified' => 'Qualificado',
                'ranked' => 'Classificado',
            ],

            'user' => [
                'label' => 'Utilizador',
                'overview' => 'Visão geral de atividades',
            ],
        ],
    ],

    'item' => [
        'created_at' => 'Data da publicação',
        'deleted_at' => 'Data da eliminação',
        'message_type' => 'Tipo',
        'permalink' => 'Link permanente',
    ],

    'nearby_posts' => [
        'confirm' => 'Nenhuma das publicações abordam a minha preocupação',
        'notice' => 'Há publicações à volta de :timestamp (:existing_timestamps). Por favor consulta-as antes de publicar.',
        'unsaved' => ':count nesta revisão',
    ],

    'owner_editor' => [
        'button' => '',
        'reset_confirm' => '',
        'user' => 'Dono',
        'version' => 'Dificuldade',
    ],

    'reply' => [
        'open' => [
            'guest' => 'Inicia sessão para responder',
            'user' => 'Responder',
        ],
    ],

    'review' => [
        'block_count' => ':used / :max blocos usados',
        'go_to_parent' => 'Ver publicação de análise',
        'go_to_child' => 'Ver discussão',
        'validation' => [
            'block_too_large' => 'cada bloco apenas pode conter até :limit caracteres',
            'external_references' => 'a revisão contém referências a problemas que não pertencem a esta revisão',
            'invalid_block_type' => 'tipo de bloco inválido',
            'invalid_document' => 'análise inválida',
            'minimum_issues' => 'a revisão deve conter um mínimo de :count problema|a revisão deve conter um mínimo de :count problemas',
            'missing_text' => 'o bloco tem texto em falta',
            'too_many_blocks' => 'as revisões só podem conter :count parágrafo/problema|as revisões só podem conter até :count parágrafos/problemas',
        ],
    ],

    'system' => [
        'resolved' => [
            'true' => 'Marcada como resolvida por :user',
            'false' => 'Reaberta por :user',
        ],
    ],

    'timestamp_display' => [
        'general' => 'geral',
        'general_all' => 'geral (todas)',
    ],

    'user_filter' => [
        'everyone' => 'Toda a gente',
        'label' => 'Filtrar por utilizador',
    ],
];

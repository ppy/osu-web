<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'hidden_replies' => ':count_delimited resposta está oculta.|:count_delimited respostas estão ocultas.',

    'authorizations' => [
        'update' => [
            'null_user' => 'Precisa de estar autenticado para editar.',
            'system_generated' => 'Uma publicação gerada pelo sistema não pode ser editada.',
            'wrong_user' => 'Tem de ser o proprietário da publicação para a editar.',
        ],
    ],

    'events' => [
        'empty' => 'Ainda não aconteceu nada… por agora.',
    ],

    'index' => [
        'deleted_beatmap' => 'apagado',
        'none_found' => 'Nenhuma discussão correspondente aos critérios de pesquisa foi encontrada.',
        'title' => 'Discussões do mapa',

        'form' => [
            '_' => 'Pesquisar',
            'deleted' => 'Incluir discussões eliminadas',
            'mode' => 'Modo do mapa',
            'only_unresolved' => 'Mostrar apenas as discussões não resolvidas',
            'show_review_embeds' => 'Mostrar publicações de revisão',
            'types' => 'Tipos de mensagem',
            'username' => 'Nome de utilizador',

            'beatmapset_status' => [
                '_' => 'Estado do mapa',
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
        'confirm' => 'Nenhuma das publicações responde à minha questão',
        'notice' => 'Existem publicações por volta de :timestamp (:existing_timestamps). Por favor, verifique‑as antes de publicar.',
        'unsaved' => ':count nesta revisão',
    ],

    'owner_editor' => [
        'button' => 'Dono da Dificuldade',
        'reset_confirm' => 'Redefinir o proprietário para esta dificuldade?',
        'user' => 'Dono',
        'version' => 'Dificuldade',
    ],

    'refresh' => [
        'checking' => 'A procurar atualizações...',
        'has_updates' => 'A discussão possui atualizações. Clique para atualizá‑la.',
        'no_updates' => 'Não há atualizações.',
        'updating' => 'A atualizar...',
    ],

    'reply' => [
        'open' => [
            'guest' => 'Inicie sessão para responder',
            'user' => 'Responder',
        ],
    ],

    'review' => [
        'block_count' => ':used / :max blocos usados',
        'go_to_parent' => 'Ver publicação de análise',
        'go_to_child' => 'Ver discussão',
        'validation' => [
            'block_too_large' => 'cada bloco deve limitar‑se a :limit caracteres',
            'external_references' => 'a revisão contém menções a problemas que não estão associados a esta revisão',
            'invalid_block_type' => 'tipo de bloco inválido',
            'invalid_document' => 'análise inválida',
            'invalid_discussion_type' => 'tipo de discussão inválido',
            'minimum_issues' => 'a revisão deve conter um mínimo de :count problema|a revisão deve conter um mínimo de :count problemas',
            'missing_text' => 'o bloco não contém texto',
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
        'everyone' => 'Todos',
        'label' => 'Filtrar por utilizador',
        'multiple' => '',
    ],
];

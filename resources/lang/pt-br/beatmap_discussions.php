<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
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
    'authorizations' => [
        'update' => [
            'null_user' => 'Precisa estar conectado para editar.',
            'system_generated' => 'Postagens geradas pelo sistema não podem ser editadas.',
            'wrong_user' => 'Precisa ser dono da postagem para editá-la.',
        ],
    ],

    'events' => [
        'empty' => 'Nada aconteceu... ainda.',
    ],

    'index' => [
        'deleted_beatmap' => 'excluído',
        'title' => 'Discussão do Beatmap',

        'form' => [
            '_' => 'Pesquisar',
            'deleted' => 'Incluir discussões excluídas',
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
    ],

    'reply' => [
        'open' => [
            'guest' => 'Conecte-se para Responder',
            'user' => 'Responder',
        ],
    ],

    'review' => [
        'go_to_parent' => 'Ver Publicação de Revisão',
        'go_to_child' => 'Ver Discussão',
        'validation' => [
            'invalid_block_type' => '',
            'invalid_document' => '',
            'minimum_issues' => '',
            'missing_text' => '',
            'too_many_blocks' => '',
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

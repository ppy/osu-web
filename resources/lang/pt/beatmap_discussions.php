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
        'title' => 'Discussões do beatmap',

        'form' => [
            '_' => 'Pesquisar',
            'deleted' => 'Incluir discussões eliminadas',
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
    ],

    'reply' => [
        'open' => [
            'guest' => 'Inicia sessão para responder',
            'user' => 'Responder',
        ],
    ],

    'review' => [
        'go_to_parent' => 'Ver publicação de análise',
        'go_to_child' => 'Ver discussão',
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

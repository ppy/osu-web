<?php

/**
 *    Copyright 2015-2017 ppy Pty. Ltd.
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
            'null_user' => 'Precisa conectar-se para editar.',
            'system_generated' => 'Postagens geradas pelo sistema não podem ser editadas.',
            'wrong_user' => 'Precisa ser dono da postagem para editá-la.',
        ],
    ],

    'events' => [
        'empty' => 'Nada aconteceu... ainda.',
    ],

    'index' => [
        'deleted_beatmap' => 'excluído',
        'title' => 'Discussão do mapa',

        'form' => [
            'deleted' => 'Incluir discussões excluídas',

            'user' => [
                'label' => 'Usuário',
                'overview' => 'Supervisão de atividades',
            ],
        ],
    ],

    'item' => [
        'created_at' => 'Data de postagem',
        'deleted_at' => 'Data de exclusão',
        'message_type' => 'Tipo',
        'permalink' => 'Copiar link da postagem',
    ],

    'nearby_posts' => [
        'confirm' => 'Nenhuma das postagens corresponde ao que procuro',
        'notice' => 'Existem postagens próximas de :timestamp (:existing_timestamps). Por favor, visualize-as antes de postar.',
    ],

    'reply' => [
        'open' => [
            'guest' => 'Conecte-se para responder',
            'user' => 'Responder',
        ],
    ],

    'system' => [
        'resolved' => [
            'true' => 'Marcada como resolvida por :user',
            'false' => 'Reaberto por :user',
        ],
    ],

    'user' => [
        'admin' => 'admin',
        'bng' => 'nominator',
        'owner' => 'mapper',
        'qat' => 'qat',
    ],
];

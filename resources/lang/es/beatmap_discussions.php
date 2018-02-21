<?php

/**
 *    Copyright 2015-2018 ppy Pty. Ltd.
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
            'null_user' => 'Debes iniciar sesión para editar.',
            'system_generated' => 'No se puede editar una publicación generada por el sistema.',
            'wrong_user' => 'Debes ser dueño del post para editarlo.',
        ],
    ],

    'events' => [
        'empty' => 'Aún... no ha ocurrido nada.',
    ],

    'index' => [
        'deleted_beatmap' => 'eliminado',
        'title' => 'Discusiones del beatmap',

        'form' => [
            'deleted' => 'Incluir discusiones eliminadas',

            'user' => [
                'label' => 'Usuario',
                'overview' => 'Actividades generales',
            ],
        ],
    ],

    'item' => [
        'created_at' => 'Fecha de posting',
        'deleted_at' => 'Fecha de eliminación',
        'message_type' => 'Tipo',
        'permalink' => 'Enlace permanente',
    ],

    'nearby_posts' => [
        'confirm' => 'Ninguno de estos posts se relaciona con mi caso',
        'notice' => 'Ya hay posts cerca de :timestamp (:existing_timestamps). Por favor revísalos antes de publicar.',
    ],

    'reply' => [
        'open' => [
            'guest' => 'Inicia sesión para responder',
            'user' => 'Responder',
        ],
    ],

    'system' => [
        'resolved' => [
            'true' => 'Marcado como resuelto por :user',
            'false' => 'Reabierto por :user',
        ],
    ],

    'user' => [
        'admin' => 'admin',
        'bng' => 'nominador',
        'owner' => 'mapper',
        'qat' => 'qat',
    ],
];

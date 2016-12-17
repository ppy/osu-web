<?php
/**
 *    Copyright 2015-2016 ppy Pty. Ltd.
 *
 *    This file is part of osu!web. osu!web is distributed in the hopes of
 *    attracting more community contributions to the core ecosystem of osu!
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
    'beatmap_discussion' => [
        'resolve' => [
            'general_discussion' => 'La discusión general no puede ser resuelta.',
            'not_owner' => 'Únicamente el iniciador del hilo y el dueño del beatmap pueden resolver una discusión.'
        ]
    ],
    'beatmap_discussion_post' => [
        'edit' => [
            'system_generated' => 'Un post automáticamente generado no puede ser editado.',
            'not_owner' => 'El post solo puede ser editado por su creador.'
        ]
    ],
    'chat' => [
        'channel' => [
            'read' => [
                'no_access' => 'No tienes permiso para acceder al canal solicitado.'
            ]
        ],
        'message' => [
            'send' => [
                'channel' => [
                    'no_access' => 'Se requiere acceso al canal.',
                    'moderated' => 'El canal está actualmente moderado.'
                ],
                'not_allowed' => 'No se puede enviar un mensaje mientras se esté baneado/restringido/silenciado.'
            ]
        ]
    ],
    'forum' => [
        'post' => [
            'delete' => [
                'can_not_post' => 'No se puede eliminar un post a cuyo hilo no se puede responder.',
                'can_only_delete_last_post' => 'Solo se puede eliminar el último post.',
                'not_owner' => 'Solo el creador del post puede eliminarlo.'
            ],
            'edit' => [
                'can_not_post' => 'No se puede editar un post cuyo hilo no se puede responder.',
                'locked' => 'La edición del post está bloqueada.',
                'not_owner' => 'Solo el creador del post puede editarlo.'
            ]
        ],
        'topic' => [
            'reply' => [
                'can_not_post' => 'Se requiere acceso al foro solicitado.',
                'locked' => 'No se puede responder a un hilo cerrado.'
            ],
            'store' => [
                'can_not_view_forum' => 'Se requiere acceso al foro.',
                'can_not_post' => 'No estás autorizado para escribir un post.',
                'forum_closed' => 'El foro está cerrado y no se puede escribir en él.',
                'user' => [
                    'silenced' => 'No puedes hacer un post mientras estés silenciado.',
                    'restricted' => 'No puedes hacer un post mientras estés restringido.'
                ]
            ]
        ],
        'topic_cover' => [
            'edit' => [
                'uneditable' => 'Portada inválida especificada.',
                'not_owner' => 'Solo el dueño puede cambiar la portada.'
            ]
        ],
        'view' => [
            'admin_only' => 'Solo los administradores pueden ver este foro.'
        ]
    ],
    'require_login' => 'Inicia sesión para continuar.',
    'unauthorized' => 'Acceso denegado.',
    'silenced' => 'No puedes hacer eso mientras estés silenciado.',
    'restricted' => 'No puedes hacer eso mientras estés restringido.',
    'user' => [
        'page' => [
            'edit' => [
                'locked' => 'La página de usuario está bloqueada.',
                'require_support_to_create' => 'Necesitas ser supporter.',
                'user' => [
                    'silenced' => 'No puedes editar tu página de usuario mientras estás silenciado.',
                    'restricted' => 'No puedes editar tu página de usuario mientras estás restringido.'
                ]
            ]
        ]
    ]
];

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
    'beatmap_discussion' => [
        'destroy' => [
            'is_hype' => 'No se puede deshacer el hyping.',
            'has_reply' => 'No es posible eliminar una discusión con respuestas',
        ],
        'nominate' => [
            'exhausted' => 'Has alcanzado tu límite de nominaciones diarias, inténtalo de nuevo mañana.',
        ],
        'resolve' => [
            'not_owner' => 'Solo el creador del tema y el dueño del beatmap pueden resolver una discusión.',
        ],

        'vote' => [
            'limit_exceeded' => 'Espera un poco antes de seguir votando',
            'owner' => '¡No puedes votar discusiones propias!',
            'wrong_beatmapset_state' => 'Solo puedes votar en discusiones de beatmaps pendientes.',
        ],
    ],

    'beatmap_discussion_post' => [
        'edit' => [
            'system_generated' => 'Una publiación generada automáticamente no puede ser editada.',
            'not_owner' => 'La publicación solo puede ser editada por su creador.',
        ],
    ],

    'chat' => [
        'channel' => [
            'read' => [
                'no_access' => 'No tienes permiso para acceder al canal solicitado.',
            ],
        ],
        'message' => [
            'send' => [
                'channel' => [
                    'no_access' => 'Se requiere acceso al canal.',
                    'moderated' => 'El canal está actualmente moderado.',
                    'not_lazer' => 'Solo puedes hablar en #lazer en este momento.',
                ],

                'not_allowed' => 'No se puede enviar un mensaje mientras estés baneado/restringido/silenciado.',
            ],
        ],
    ],

    'contest' => [
        'voting_over' => 'No puedes cambiar tu voto después de haber concluido el periodo de votación.',
    ],

    'forum' => [
        'post' => [
            'delete' => [
                'only_last_post' => 'Solo se puede eliminar la última publicación.',
                'locked' => 'No se puede eliminar una publicación en un hilo cerrado.',
                'no_forum_access' => 'Necesitas acceso al foro solicitado.',
                'not_owner' => 'Solo el creador de la publicación puede eliminarla.',
            ],

            'edit' => [
                'deleted' => 'No puedes editar una publicación eliminada.',
                'locked' => 'La edición del post está bloqueada.',
                'no_forum_access' => 'Necesitas acceso al foro solicitado.',
                'not_owner' => 'Solo el creador del post puede editarlo.',
                'topic_locked' => 'No puedes editar una publicación en un hilo cerrado.',
            ],
        ],

        'topic' => [
            'reply' => [
                'double_post' => 'Acabas de publicar. Espera un momento o edita tu última publicación.',
                'locked' => 'No puedes responder a un hilo cerrado.',
                'no_forum_access' => 'Necesitas acceso al foro solicitado.',
                'no_permission' => 'No tienes permisos para responder.',

                'user' => [
                    'require_login' => 'Inicia sesión para responder.',
                    'restricted' => 'No puedes responder mientras estés restringido.',
                    'silenced' => 'No puedes responder mientras estés silenciado.',
                ],
            ],

            'store' => [
                'no_forum_access' => 'Necesitas acceso al foro solicitado.',
                'no_permission' => 'No tienes permisos para crear un nuevo hilo.',
                'forum_closed' => 'Este foro está cerrado y no puedes publicar en él.',
            ],

            'vote' => [
                'no_forum_access' => 'Necesitas acceso al foro solicitado.',
                'over' => 'La encuesta ha terminado y ya no puedes votar.',
                'voted' => 'No se puede cambiar tu voto.',

                'user' => [
                    'require_login' => 'Inicia sesión para votar.',
                    'restricted' => 'No puedes votar mientras estés restringido.',
                    'silenced' => 'No puedes votar mientras estés silenciado.',
                ],
            ],

            'watch' => [
                'no_forum_access' => 'Necesitas acceso al foro solicitado.',
            ],
        ],

        'topic_cover' => [
            'edit' => [
                'uneditable' => 'Portada inválida.',
                'not_owner' => 'Solo el dueño puede cambiar la portada.',
            ],
        ],

        'view' => [
            'admin_only' => 'Solo los administradores pueden ver este foro.',
        ],
    ],

    'require_login' => 'Inicia sesión para continuar.',

    'unauthorized' => 'Acceso denegado.',

    'silenced' => 'No puedes hacer eso mientras estés silenciado.',

    'restricted' => 'No puedes hacer eso mientras estés restringido.',

    'user' => [
        'page' => [
            'edit' => [
                'locked' => 'La página de usuario está bloqueada.',
                'not_owner' => 'Solo puedes editar tu página de usuario.',
                'require_supporter_tag' => 'Necesitas ser supporter.',
            ],
        ],
    ],
];

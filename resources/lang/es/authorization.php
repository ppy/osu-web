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
            'is_hype' => 'No puedes deshacer el hyping.',
            'has_reply' => 'No se puede eliminar una discusión con respuestas',
        ],
        'nominate' => [
            'exhausted' => 'Has alcanzado tu límite de nominaciones diarias, por favor inténtalo de nuevo mañana.',
            'incorrect_state' => 'Error al realizar esa acción, intenta actualizando la página.',
            'owner' => "No puedes nominar tu propio beatmap.",
        ],
        'resolve' => [
            'not_owner' => 'Solo el creador del tema y dueño del beatmap puede resolver una discusión.',
        ],

        'store' => [
            'mapper_note_wrong_user' => 'Sólo el dueño del beatmap o un miembro de un grupo de nominaciones/QAT puede publicar notas de mapeador.',
        ],

        'vote' => [
            'limit_exceeded' => 'Espera un poco antes de seguir votando',
            'owner' => "No puedes votar tus propias discusiones.",
            'wrong_beatmapset_state' => 'Solo puedes votar en discusiones de mapas pendientes.',
        ],
    ],

    'beatmap_discussion_post' => [
        'edit' => [
            'system_generated' => 'Una publicación generada automáticamente no se puede editar.',
            'not_owner' => 'Solo el creador puede editar la publicación.',
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

                'not_allowed' => 'No puedes enviar un mensaje mientras estás baneado/restringido/silenciado.',
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
                'no_forum_access' => 'Se requiere acceso al foro solicitado.',
                'not_owner' => 'Solo el creador de la publicación puede eliminarla.',
            ],

            'edit' => [
                'deleted' => 'No puedes editar una publicación eliminada.',
                'locked' => 'La edición de la publicación está bloqueada.',
                'no_forum_access' => 'Se requiere acceso al foro solicitado.',
                'not_owner' => 'Solo el creador puede editar la publicación.',
                'topic_locked' => 'No puedes editar una publicación en un hilo cerrado.',
            ],

            'store' => [
                'play_more' => '¡Intenta jugar antes de publicar en los foros, por favor! Si tiene un problema jugando, publícalo en el foro de Ayuda y Soporte.',
                'too_many_help_posts' => "Necesitas jugar más el juego antes de poder hacer publicaciones adicionales. Si aún tienes problemas para jugar, envía un correo electrónico a support@ppy.sh", // FIXME: unhardcode email address.
            ],
        ],

        'topic' => [
            'reply' => [
                'double_post' => 'Por favor edita tu última publicación en vez de publicar otra vez.',
                'locked' => 'No puedes responder a un hilo cerrado.',
                'no_forum_access' => 'Se requiere acceso al foro solicitado.',
                'no_permission' => 'No tienes permisos para responder.',

                'user' => [
                    'require_login' => 'Por favor, inicia sesión para responder.',
                    'restricted' => "No puedo responder mientras estás restringido.",
                    'silenced' => "No puedes responder mientras estás silenciado.",
                ],
            ],

            'store' => [
                'no_forum_access' => 'Se requiere acceso al foro solicitado.',
                'no_permission' => 'No tienes permisos para crear un nuevo hilo.',
                'forum_closed' => 'Este foro está cerrado y no puedes publicar en él.',
            ],

            'vote' => [
                'no_forum_access' => 'Se requiere acceso al foro solicitado.',
                'over' => 'La encuesta terminó y ya no se puede votar.',
                'voted' => 'Cambiar el voto no está permitido.',

                'user' => [
                    'require_login' => 'Por favor, Inicia sesión para votar.',
                    'restricted' => "No puedes votar mientras estés restringido.",
                    'silenced' => "No puedes votar mientras estés silenciado.",
                ],
            ],

            'watch' => [
                'no_forum_access' => 'Se requiere acceso al foro solicitado.',
            ],
        ],

        'topic_cover' => [
            'edit' => [
                'uneditable' => 'Portada especificada inválida.',
                'not_owner' => 'Solo el dueño puede editar la portada.',
            ],
        ],

        'view' => [
            'admin_only' => 'Solo los administradores pueden ver este foro.',
        ],
    ],

    'require_login' => 'Por favor, inicia sesión para continuar.',

    'unauthorized' => 'Acceso denegado.',

    'silenced' => "No puedes hacer eso mientras estés silenciado.",

    'restricted' => "No puedes hacer eso mientras estés restringido.",

    'user' => [
        'page' => [
            'edit' => [
                'locked' => 'La página de usuario está bloqueada.',
                'not_owner' => 'Solo puedes editar tu página de usuario.',
                'require_supporter_tag' => 'Se requiere el osu!supporter tag.',
            ],
        ],
    ],
];

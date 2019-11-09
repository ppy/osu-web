<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
 */

return [
    'beatmap_discussion' => [
        'destroy' => [
            'is_hype' => 'No puedes deshacer el hyping.',
            'has_reply' => 'No se puede eliminar una discusión con respuestas',
        ],
        'nominate' => [
            'exhausted' => 'Has alcanzado tu límite de nominaciones diarias, por favor inténtalo de nuevo mañana.',
            'full_bn_required' => 'Debes ser un nominador para realizar esta nominación.',
            'full_bn_required_hybrid' => 'Debes ser un nominador para nominar conjuntos de beatmaps con más de un modo de juego.',
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
        'destroy' => [
            'not_owner' => 'Solo puedes eliminar tus publicaciones.',
            'resolved' => 'No puedes eliminar una publicación de una discusión resuelta.',
            'system_generated' => 'La publicación generada automáticamente no puede ser eliminada.',
        ],

        'edit' => [
            'not_owner' => 'Solo el creador puede editar la publicación.',
            'resolved' => 'No puedes editar una publicación de una discusión resuelta.',
            'system_generated' => 'Una publicación generada automáticamente no se puede editar.',
        ],

        'store' => [
            'beatmapset_locked' => 'Este beatmap está bloqueado para discusión.',
        ],
    ],

    'chat' => [
        'blocked' => 'No puedes enviar mensajes a un usuario que bloqueaste o que te haya bloqueado.',
        'friends_only' => 'Este usuario está bloqueando mensajes de usuarios que no estén en su lista de amigos.',
        'moderated' => 'Ese canal está actualmente siendo moderado.',
        'no_access' => 'No tienes acceso a ese canal.',
        'restricted' => 'No puedes enviar mensajes mientras estés silenciado, restringido o baneado.',
    ],

    'comment' => [
        'update' => [
            'deleted' => "No puedes editar una publicación borrada.",
        ],
    ],

    'contest' => [
        'voting_over' => 'No puedes cambiar tu voto después de haber concluido el periodo de votación.',
    ],

    'forum' => [
        'moderate' => [
            'no_permission' => 'Sin permisos para moderar este foro.',
        ],

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
                'play_more' => 'Necesitas jugar más antes de votar en el foro.',
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
            'store' => [
                'forum_not_allowed' => 'Este foro no acepta portadas de temas.',
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

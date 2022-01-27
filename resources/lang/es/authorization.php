<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'play_more' => '¿Qué tal si en vez de eso jugamos un poco de osu!?',
    'require_login' => 'Por favor, inicia sesión para continuar.',
    'require_verification' => 'Verifique para continuar.',
    'restricted' => "No puede hacer eso mientras esté restringido.",
    'silenced' => "No puede hacer eso mientras esté silenciado.",
    'unauthorized' => 'Acceso denegado.',

    'beatmap_discussion' => [
        'destroy' => [
            'is_hype' => 'No se puede deshacer el hyping.',
            'has_reply' => 'No se puede eliminar una discusión con respuestas',
        ],
        'nominate' => [
            'exhausted' => 'Has alcanzado tu límite de nominaciones diarias, por favor inténtalo de nuevo mañana.',
            'incorrect_state' => 'Error al realizar esa acción, intente actualizar la página.',
            'owner' => "No puedes nominar tu propio mapa.",
            'set_metadata' => 'Debe establecer el género y el idioma antes de nominar.',
        ],
        'resolve' => [
            'not_owner' => 'Solo el creador del tema y el dueño del mapa pueden resolver una discusión.',
        ],

        'store' => [
            'mapper_note_wrong_user' => 'Sólo el dueño del mapa o el nominador/miembro del grupo NAT puede publicar notas de mapeo.',
        ],

        'vote' => [
            'bot' => "No puede votar en una discusión hecha por un bot",
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
            'beatmapset_locked' => 'Este mapa está bloqueado para discusión.',
        ],
    ],

    'beatmapset' => [
        'metadata' => [
            'nominated' => 'No puedes cambiar los metadatos de un mapa nominado. Contacta con un miembro de los BN o del NAT si crees que están establecidos incorrectamente.',
        ],
    ],

    'chat' => [
        'blocked' => 'No puedes enviar mensajes a un usuario que bloqueaste o que te haya bloqueado.',
        'friends_only' => 'Este usuario está bloqueando los mensajes de personas que no están en su lista de amigos.',
        'moderated' => 'Ese canal está actualmente siendo moderado.',
        'no_access' => 'No tienes acceso a ese canal.',
        'receive_friends_only' => '',
        'restricted' => 'No puede enviar mensajes mientras esté silenciado, restringido o baneado.',
        'silenced' => 'No puede enviar mensajes mientras esté silenciado, restringido o baneado.',
    ],

    'comment' => [
        'update' => [
            'deleted' => "No puedes editar una publicación eliminada.",
        ],
    ],

    'contest' => [
        'voting_over' => 'No puedes cambiar tu voto después de haber concluido el periodo de votación.',

        'entry' => [
            'limit_reached' => 'Has alcanzado el límite de entradas para este concurso',
            'over' => '¡Gracias por su participación! Los envíos se han cerrado para este concurso y la votación se abrirá pronto.',
        ],
    ],

    'forum' => [
        'moderate' => [
            'no_permission' => 'Sin permisos para moderar este foro.',
        ],

        'post' => [
            'delete' => [
                'only_last_post' => 'Solo se puede eliminar la última publicación.',
                'locked' => 'No se puede eliminar la publicación de un tema cerrado.',
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
                    'restricted' => "No puede responder mientras esté restringido.",
                    'silenced' => "No puede responder mientras esté silenciado.",
                ],
            ],

            'store' => [
                'no_forum_access' => 'Se requiere acceso al foro solicitado.',
                'no_permission' => 'No tienes permisos para crear un nuevo tema.',
                'forum_closed' => 'Este foro está cerrado y no puedes publicar en él.',
            ],

            'vote' => [
                'no_forum_access' => 'Se requiere acceso al foro solicitado.',
                'over' => 'La encuesta terminó y ya no se puede votar.',
                'play_more' => 'Necesitas jugar más antes de votar en el foro.',
                'voted' => 'Cambiar el voto no está permitido.',

                'user' => [
                    'require_login' => 'Inicie sesión para votar.',
                    'restricted' => "No puede votar mientras esté restringido.",
                    'silenced' => "No puede votar mientras esté silenciado.",
                ],
            ],

            'watch' => [
                'no_forum_access' => 'Se requiere acceso al foro solicitado.',
            ],
        ],

        'topic_cover' => [
            'edit' => [
                'uneditable' => 'Portada especificada no válida.',
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

    'score' => [
        'pin' => [
            'not_owner' => '',
            'too_many' => '',
        ],
    ],

    'user' => [
        'page' => [
            'edit' => [
                'locked' => 'La página de usuario está bloqueada.',
                'not_owner' => 'Solo puedes editar tu página de usuario.',
                'require_supporter_tag' => 'Se requiere el tag de osu!supporter.',
            ],
        ],
    ],
];

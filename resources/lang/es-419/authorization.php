<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'play_more' => '¿Qué tal si en vez de eso jugamos un poco de osu!?',
    'require_login' => 'Inicia sesión para continuar.',
    'require_verification' => 'Verifica la cuenta para continuar.',
    'restricted' => "No puedes hacer eso mientras estés restringido.",
    'silenced' => "No puedes hacer eso mientras estés silenciado.",
    'unauthorized' => 'Acceso denegado.',

    'beatmap_discussion' => [
        'destroy' => [
            'is_hype' => 'No se puede quitar el hype.',
            'has_reply' => 'No se puede eliminar una discusión con respuestas',
        ],
        'nominate' => [
            'exhausted' => 'Has alcanzado tu límite de nominaciones diarias, inténtalo de nuevo mañana.',
            'incorrect_state' => 'Se ha producido un error al realizar esa acción, intenta actualizar la página.',
            'owner' => "No puedes nominar tu propio mapa.",
            'set_metadata' => 'Debes establecer el género y el idioma antes de nominar.',
        ],
        'resolve' => [
            'not_owner' => 'Solo el creador del tema y el dueño del mapa pueden resolver una discusión.',
        ],

        'store' => [
            'mapper_note_wrong_user' => 'Solo el dueño del mapa o el nominador/miembro del NAT puede publicar notas de mapeo.',
        ],

        'vote' => [
            'bot' => "No puedes votar en una discusión hecha por un bot",
            'limit_exceeded' => 'Espera un poco antes de seguir votando',
            'owner' => "No puedes votar en tus propias discusiones.",
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
    ],

    'beatmapset' => [
        'discussion_locked' => 'La discusión de este mapa está bloqueada.',

        'metadata' => [
            'nominated' => 'No puedes cambiar los metadatos de un mapa nominado. Contacta con un miembro de los BN o del NAT si crees que están establecidos incorrectamente.',
        ],
    ],

    'beatmap_tag' => [
        'store' => [
            'no_score' => 'Debes establecer una puntuación en un mapa para añadir una etiqueta.',
        ],
    ],

    'chat' => [
        'blocked' => 'No puedes enviar mensajes a un usuario que bloqueaste o que te haya bloqueado.',
        'friends_only' => 'Este usuario está bloqueando los mensajes de las personas que no estén en su lista de amigos.',
        'moderated' => 'Este canal está actualmente siendo moderado.',
        'no_access' => 'No tienes acceso a ese canal.',
        'no_announce' => 'No tienes permiso para publicar anuncios.',
        'receive_friends_only' => 'Es posible que el usuario no pueda responder porque solo aceptas mensajes de las personas en tu lista de amigos.',
        'restricted' => 'No puedes enviar mensajes mientras estés silenciado, restringido o baneado.',
        'silenced' => 'No puedes enviar mensajes mientras estés silenciado, restringido o baneado.',
    ],

    'comment' => [
        'store' => [
            'disabled' => 'Los comentarios están desactivados',
        ],
        'update' => [
            'deleted' => "No puedes editar una publicación eliminada.",
        ],
    ],

    'contest' => [
        'judging_not_active' => 'La evaluación para este concurso no está activa.',
        'voting_over' => 'No podrás cambiar tu voto una vez finalizado el periodo de votación de este concurso.',

        'entry' => [
            'limit_reached' => 'Has alcanzado el límite de participaciones para este concurso',
            'over' => '¡Gracias por tu participación! El plazo de envíos para este concurso ha finalizado y la votación se abrirá pronto.',
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
                'no_permission' => '',
                'not_owner' => 'Solo el creador puede editar la publicación.',
                'topic_locked' => 'No puedes editar una publicación de un tema cerrado.',
            ],

            'store' => [
                'play_more' => '¡Por favor, intenta jugar antes de escribir en los foros! Si tienes algún problema jugando, publícalo en el foro de ayuda y soporte.',
                'too_many_help_posts' => "Necesitas jugar más el juego antes de poder hacer publicaciones adicionales. Si sigues teniendo problemas para jugar, envía un correo a support@ppy.sh", // FIXME: unhardcode email address.
            ],
        ],

        'topic' => [
            'reply' => [
                'double_post' => 'Edita tu última publicación en lugar de volver a publicarla.',
                'locked' => 'No puedes responder a un hilo cerrado.',
                'no_forum_access' => 'Se requiere acceso al foro solicitado.',
                'no_permission' => 'No tienes permisos para responder.',

                'user' => [
                    'require_login' => 'Inicia sesión para responder.',
                    'restricted' => "No puedes responder mientras estés restringido.",
                    'silenced' => "No puedes responder mientras estés silenciado.",
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
                    'require_login' => 'Inicia sesión para votar.',
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
                'uneditable' => 'La portada especificada no es válida.',
                'not_owner' => 'Solo el dueño puede editar la portada.',
            ],
            'store' => [
                'forum_not_allowed' => 'Este foro no acepta las portadas de los temas.',
            ],
        ],

        'view' => [
            'admin_only' => 'Solo los administradores pueden ver este foro.',
        ],
    ],

    'room' => [
        'destroy' => [
            'not_owner' => 'Solo el propietario de la sala puede cerrarla.',
        ],
    ],

    'score' => [
        'pin' => [
            'disabled_type' => "No puedes fijar este tipo de puntuación",
            'failed' => "No puedes fijar una puntuación fallida.",
            'not_owner' => 'Solo el propietario de la puntuación puede fijar la puntuación.',
            'too_many' => 'Se han fijado demasiadas puntuaciones.',
        ],
    ],

    'team' => [
        'application' => [
            'store' => [
                'already_member' => "Ya formas parte del equipo.",
                'already_other_member' => "Ya formas parte de otro equipo.",
                'currently_applying' => 'Tienes pendiente una solicitud para unirte a un equipo.',
                'team_closed' => 'Por el momento, el equipo no está aceptando solicitudes para formar parte de él.',
                'team_full' => "El equipo está completo y no puede aceptar a más miembros.",
            ],
        ],
        'part' => [
            'is_leader' => "El líder del equipo no puede abandonar el equipo.",
            'not_member' => 'No es miembro del equipo.',
        ],
        'store' => [
            'require_supporter_tag' => 'Se requiere una etiqueta de osu!supporter para crear un equipo.',
        ],
    ],

    'user' => [
        'page' => [
            'edit' => [
                'locked' => 'La página de usuario está bloqueada.',
                'not_owner' => 'Solo puedes editar tu propia página de usuario.',
                'require_supporter_tag' => 'Necesitas una etiqueta de osu!supporter.',
            ],
        ],
        'update_email' => [
            'locked' => 'la dirección de correo electrónico está bloqueada',
        ],
    ],
];

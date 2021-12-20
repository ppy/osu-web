<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'invalid' => ':attribute especificado no válido.',
    'not_negative' => ':attribute no puede ser negativo.',
    'required' => ':attribute es requerido.',
    'too_long' => ':attribute ha excedido el límite máximo - sólo puede ser de hasta :limit caracteres.',
    'wrong_confirmation' => 'La confirmación no coincide.',

    'beatmapset_discussion' => [
        'beatmap_missing' => 'La marca de tiempo ha sido especificada pero el mapa no se encontró.',
        'beatmapset_no_hype' => "El mapa no puede ser hypeado.",
        'hype_requires_null_beatmap' => 'El hype debe ser realizado en la sección de General (todas las dificultades).',
        'invalid_beatmap_id' => 'Dificultad especificada no válida.',
        'invalid_beatmapset_id' => 'Mapa especificado no válido.',
        'locked' => 'La discusión está cerrada.',

        'attributes' => [
            'message_type' => 'Tipo de mensaje',
            'timestamp' => 'Marca de tiempo',
        ],

        'hype' => [
            'discussion_locked' => "Este mapa está actualmente bloqueado para discusión y no puede ser hypeado",
            'guest' => 'Debes iniciar sesión para hypear.',
            'hyped' => 'Ya hypeaste este mapa.',
            'limit_exceeded' => 'Ya has utilizado todos tus hype.',
            'not_hypeable' => 'Este mapa no puede ser hypeado',
            'owner' => 'No puedes hypear tu propio mapa.',
        ],

        'timestamp' => [
            'exceeds_beatmapset_length' => 'La marca de tiempo especificada está más allá de la duración del mapa.',
            'negative' => "La marca de tiempo no puede ser negativa.",
        ],
    ],

    'beatmapset_discussion_post' => [
        'discussion_locked' => 'La discusión está cerrada.',
        'first_post' => 'No se puede eliminar la publicación inicial.',

        'attributes' => [
            'message' => 'El mensaje',
        ],
    ],

    'comment' => [
        'deleted_parent' => 'Responder a un comentario eliminado no está permitido.',
        'top_only' => 'Anclar la respuesta de un comentario no está permitido.',

        'attributes' => [
            'message' => 'El mensaje',
        ],
    ],

    'follow' => [
        'invalid' => ':attribute especificado no válido.',
    ],

    'forum' => [
        'feature_vote' => [
            'not_feature_topic' => 'Solo se puede votar en solicitudes de características.',
            'not_enough_feature_votes' => 'Votos insuficientes.',
        ],

        'poll_vote' => [
            'invalid' => 'Opción especificada no válida.',
        ],

        'post' => [
            'beatmapset_post_no_delete' => 'Eliminar la publicación de los metadatos del mapa no está permitido.',
            'beatmapset_post_no_edit' => 'Editar la publicación de los metadatos del mapa no está permitido.',
            'first_post_no_delete' => 'No se puede eliminar la publicación inicial',
            'missing_topic' => 'Falta el tema de la publicación',
            'only_quote' => 'Tu respuesta sólo contiene una cita.',

            'attributes' => [
                'post_text' => 'Cuerpo de la publicación',
            ],
        ],

        'topic' => [
            'attributes' => [
                'topic_title' => 'Título del tema',
            ],
        ],

        'topic_poll' => [
            'duplicate_options' => 'Opciones duplicadas no permitidas.',
            'grace_period_expired' => 'No se puede editar una encuesta después de :limit horas',
            'hiding_results_forever' => 'No se pueden ocultar los resultados de una encuesta que nunca finaliza.',
            'invalid_max_options' => 'La opciones por usuario no pueden exceder el número de opciones disponibles.',
            'minimum_one_selection' => 'Se requiere un mínimo de una opción por usuario.',
            'minimum_two_options' => 'Se necesitan al menos dos opciones.',
            'too_many_options' => 'Número de opciones permitidas excedidas.',

            'attributes' => [
                'title' => 'Título de encuesta',
            ],
        ],

        'topic_vote' => [
            'required' => 'Selecciona una opción para votar.',
            'too_many' => 'Seleccionadas más opciones de las permitidas.',
        ],
    ],

    'oauth' => [
        'client' => [
            'too_many' => 'Excedió el número máximo de aplicaciones de OAuth permitidas.',
            'url' => 'Por favor, ingrese una URL válida.',

            'attributes' => [
                'name' => 'Nombre de Aplicación',
                'redirect' => 'URL de llamada de Aplicación',
            ],
        ],
    ],

    'user' => [
        'contains_username' => 'La contraseña no puede contener el nombre de usuario.',
        'email_already_used' => 'El correo electrónico ya está siendo utilizado.',
        'email_not_allowed' => 'Dirección de correo electrónico no permitida.',
        'invalid_country' => 'El país no está en la base de datos.',
        'invalid_discord' => 'Nombre de usuario de Discord no válido.',
        'invalid_email' => "No parece ser una dirección de correo electrónico válida.",
        'invalid_twitter' => 'Nombre de usuario de Twitter no válido.',
        'too_short' => 'La nueva contraseña es muy corta.',
        'unknown_duplicate' => 'El nombre de usuario o correo electrónico ya está siendo utilizado.',
        'username_available_in' => 'Este nombre de usuario estará disponible para su uso en :duration.',
        'username_available_soon' => '¡Este nombre de usuario estará disponible para su uso en cualquier momento!',
        'username_invalid_characters' => 'El nombre de usuario solicitado contiene caracteres no válidos.',
        'username_in_use' => '¡El nombre de usuario ya está en uso!',
        'username_locked' => '¡El nombre de usuario ya está en uso!', // TODO: language for this should be slightly different.
        'username_no_space_userscore_mix' => 'Por favor utiliza guiones bajos o espacios, ¡no ambas!',
        'username_no_spaces' => "¡El nombre no puede iniciar o finalizar con espacios!",
        'username_not_allowed' => 'Esta elección de nombre de usuario no está permitida.',
        'username_too_short' => 'El nombre de usuario solicitado es muy corto.',
        'username_too_long' => 'El nombre de usuario solicitado es muy largo.',
        'weak' => 'Contraseña no permitida.',
        'wrong_current_password' => 'La contraseña actual es incorrecta.',
        'wrong_email_confirmation' => 'La confirmación de correo electrónico no coincide.',
        'wrong_password_confirmation' => 'La confirmación de contraseña no coincide.',
        'too_long' => 'Se excedió el límite máximo - puedes usar hasta :limit caracteres.',

        'attributes' => [
            'username' => 'Nombre de usuario',
            'user_email' => 'Correo electrónico',
            'password' => 'Contraseña',
        ],

        'change_username' => [
            'restricted' => 'No puede cambiar su nombre de usuario mientras esté restringido.',
            'supporter_required' => [
                '_' => '¡Debes tener :link para cambiar tu nombre!',
                'link_text' => 'apoyar a osu!',
            ],
            'username_is_same' => '¡Este ya es tu nombre de usuario, tonto!',
        ],
    ],

    'user_report' => [
        'no_ranked_beatmapset' => 'Los mapas clasificados no pueden ser denunciados',
        'reason_not_valid' => ':reason no válido para este tipo de denuncia.',
        'self' => "¡No puede denunciarse a sí mismo!",
    ],

    'store' => [
        'order_item' => [
            'attributes' => [
                'quantity' => 'Cantidad',
                'cost' => 'Costo',
            ],
        ],
    ],
];

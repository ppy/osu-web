<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'edit' => [
        'title_compact' => 'configuración de la cuenta',
        'username' => 'nombre de usuario',

        'avatar' => [
            'title' => 'Avatar',
            'reset' => 'restablecer',
            'rules' => 'Por favor, asegúrate de que tu avatar se adhiera a :link.<br/>Esto significa que debe ser <strong>adecuado para todas las edades</strong>. Es decir, sin desnudos, contenido ofensivo o sugerente.',
            'rules_link' => 'las consideraciones de contenido visual',
        ],

        'email' => [
            'new' => 'nuevo correo electrónico',
            'new_confirmation' => 'confirmar correo electrónico',
            'title' => 'Correo electrónico',
            'locked' => [
                '_' => 'Ponte en contacto con el :accounts si necesitas actualizar tu correo electrónico.',
                'accounts' => 'equipo de soporte de cuentas',
            ],
        ],

        'legacy_api' => [
            'api' => 'api',
            'irc' => 'irc',
            'title' => 'API heredada',
        ],

        'password' => [
            'current' => 'contraseña actual',
            'new' => 'nueva contraseña',
            'new_confirmation' => 'confirmar contraseña',
            'title' => 'Contraseña',
        ],

        'profile' => [
            'country' => 'país',
            'title' => 'Perfil',

            'country_change' => [
                '_' => "Parece que el país de tu cuenta no coincide con tu país de residencia. :update_link.",
                'update_link' => 'Actualizar a :country',
            ],

            'user' => [
                'user_discord' => '',
                'user_from' => 'ubicación actual',
                'user_interests' => 'intereses',
                'user_occ' => 'ocupación',
                'user_twitter' => '',
                'user_website' => 'sitio web',
            ],
        ],

        'signature' => [
            'title' => 'Firma',
            'update' => 'actualizar',
        ],
    ],

    'github_user' => [
        'info' => "Si eres un contribuidor en los repositorios de código abierto de osu!, vincular tu cuenta de GitHub aquí asociará tus entradas en el registro de cambios con tu perfil de osu!. Las cuentas de GitHub sin historial de contribuciones a osu! no pueden ser vinculadas.",
        'link' => 'Vincular cuenta de GitHub',
        'title' => 'GitHub',
        'unlink' => 'Desvincular cuenta de GitHub',

        'error' => [
            'already_linked' => 'Esta cuenta de GitHub ya está vinculada a un usuario diferente.',
            'no_contribution' => 'No se puede vincular la cuenta de GitHub sin ningún historial de contribuciones en los repositorios de osu!.',
            'unverified_email' => 'Verifica tu correo electrónico principal en GitHub y vuelve a intentar vincular tu cuenta.',
        ],
    ],

    'notifications' => [
        'beatmapset_discussion_qualified_problem' => 'recibir notificaciones de nuevos problemas en mapas calificados de los siguientes modos',
        'beatmapset_disqualify' => 'recibir notificaciones para cuando se descalifiquen los mapas de los siguientes modos',
        'comment_reply' => 'recibir notificaciones de las respuestas a tus comentarios',
        'title' => 'Notificaciones',
        'topic_auto_subscribe' => 'activar automáticamente las notificaciones en los nuevos temas del foro que crees',

        'options' => [
            '_' => 'opciones de entrega',
            'beatmap_owner_change' => 'dificultades de invitados',
            'beatmapset:modding' => 'modding de mapas',
            'channel_message' => 'mensajes de chat privados',
            'comment_new' => 'nuevos comentarios',
            'forum_topic_reply' => 'respuestas a temas',
            'mail' => 'correo',
            'mapping' => 'creadores de mapas',
            'push' => 'push',
        ],
    ],

    'oauth' => [
        'authorized_clients' => 'clientes autorizados',
        'own_clients' => 'clientes propios',
        'title' => 'OAuth',
    ],

    'options' => [
        'beatmapset_show_nsfw' => 'ocultar las advertencias de contenido explícito en los mapas',
        'beatmapset_title_show_original' => 'mostrar los metadatos de los mapas en su idioma original',
        'title' => 'Opciones',

        'beatmapset_download' => [
            '_' => 'tipo predeterminado de descarga de los mapas',
            'all' => 'con video si está disponible',
            'direct' => 'abrir en osu!direct',
            'no_video' => 'sin video',
        ],
    ],

    'playstyles' => [
        'keyboard' => 'teclado',
        'mouse' => 'ratón',
        'tablet' => 'tableta',
        'title' => 'Estilos de juego',
        'touch' => 'táctil',
    ],

    'privacy' => [
        'friends_only' => 'bloquear los mensajes privados de las personas que no estén en tu lista de amigos',
        'hide_online' => 'ocultar tu presencia en línea',
        'title' => 'Privacidad',
    ],

    'security' => [
        'current_session' => 'actual',
        'end_session' => 'Cerrar sesión',
        'end_session_confirmation' => 'Esto cerrará inmediatamente tu sesión en ese dispositivo. ¿Estás seguro?',
        'last_active' => 'Última conexión:',
        'title' => 'Seguridad',
        'web_sessions' => 'sesiones web',
    ],

    'update_email' => [
        'update' => 'actualizar',
    ],

    'update_password' => [
        'update' => 'actualizar',
    ],

    'verification_completed' => [
        'text' => 'Ya puedes cerrar esta pestaña/ventana',
        'title' => 'Verificación completada',
    ],

    'verification_invalid' => [
        'title' => 'Enlace de verificación no válido o caducado',
    ],
];

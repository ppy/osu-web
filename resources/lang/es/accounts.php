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
            'rules' => 'Por favor, asegúrate de que tu avatar se adhiera a :link.<br/>Esto significa que debe ser <strong>adecuado para todas las edades</strong>. Es decir, sin desnudez, contenido ofensivo o sugerente.',
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
        'info' => "Si eres un contribuidor en los repositorios de código abierto de osu!, vincular tu cuenta de GitHub aquí asociará tus entradas del registro de cambios con tu perfil de osu!. Las cuentas de GitHub sin historial de contribuciones a osu! no pueden ser enlazadas.",
        'link' => 'Enlazar cuenta de GitHub',
        'title' => 'GitHub',
        'unlink' => 'Desenlazar cuenta de GitHub',

        'error' => [
            'already_linked' => 'Esta cuenta de GitHub ya está vinculada a un usuario diferente.',
            'no_contribution' => 'No se puede vincular la cuenta de GitHub sin ningún historial de contribuciones en los repositorios de osu!.',
            'unverified_email' => 'Por favor, verifica tu correo principal en GitHub, luego intenta vincular tu cuenta de nuevo.',
        ],
    ],

    'notifications' => [
        'beatmapset_discussion_qualified_problem' => 'recibir notificaciones de nuevos problemas en mapas calificados de los siguientes modos',
        'beatmapset_disqualify' => 'recibir notificaciones para cuando se descalifiquen los mapas de los siguientes modos',
        'comment_reply' => 'recibir notificaciones de respuestas a tus comentarios',
        'news_post' => 'recibir notificaciones de nuevas noticias',
        'title' => 'Notificaciones',
        'topic_auto_subscribe' => 'activar automáticamente las notificaciones en nuevos temas del foro que cree',

        'options' => [
            '_' => 'opciones de entrega',
            'beatmap_owner_change' => 'dificultades de invitados',
            'beatmapset:modding' => 'modding de mapas',
            'channel_message' => 'mensajes de chat privados',
            'channel_team' => 'mensajes del chat del equipo',
            'comment_new' => 'nuevos comentarios',
            'forum_topic_reply' => 'respuestas a temas',
            'mail' => 'correo',
            'mapping' => 'creadores de mapas',
            'news_post' => 'noticias',
            'push' => 'push',
        ],
    ],

    'oauth' => [
        'authorized_clients' => 'clientes autorizados',
        'own_clients' => 'clientes propios',
        'title' => 'OAuth',
    ],

    'options' => [
        'beatmapset_show_nsfw' => 'ocultar advertencias para contenido explícito en mapas',
        'beatmapset_title_show_original' => 'mostrar datos de mapas en su idioma original',
        'title' => 'Opciones',

        'beatmapset_download' => [
            '_' => 'tipo de descarga de mapa predeterminado',
            'all' => 'con vídeo si está disponible',
            'direct' => 'abrir en osu!direct',
            'no_video' => 'sin vídeo',
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
        'friends_only' => 'bloquear los mensajes privados de personas que no están en tu lista de amigos',
        'hide_online' => 'ocultar tu presencia en línea',
        'hide_online_info' => 'esto se relaciona con el modo «aparecer desconectado» en osu!lazer',
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

    'user_totp' => [
        'title' => 'Aplicación de autenticación',
        'usage_note' => 'Usa una aplicación de autenticación en lugar del correo electrónico para la verificación. La verificación por correo electrónico seguirá estando disponible como alternativa.',

        'button' => [
            'remove' => 'Eliminar',
            'setup' => 'Añadir aplicación de autenticación',
        ],
        'status' => [
            'label' => 'estado',
            'not_set' => 'No configurado',
            'set' => 'Configurado',
        ],
    ],

    'verification_completed' => [
        'text' => 'Ya puedes cerrar esta pestaña/ventana',
        'title' => 'Verificación completada',
    ],

    'verification_invalid' => [
        'title' => 'Enlace de verificación no válido o caducado',
    ],
];

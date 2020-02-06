<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
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
    'edit' => [
        'title_compact' => 'ajustes',
        'username' => 'nombre de usuario',

        'avatar' => [
            'title' => 'Avatar',
            'rules' => 'Por favor asegúrese de que su avatar se adhiere a :link.<br/>Esto significa que debe ser <strong>adecuado para todas las edades</strong>. Es decir, no desnudez, profanidad o contenido sugestivo.',
            'rules_link' => 'las reglas de la comunidad',
        ],

        'email' => [
            'current' => 'correo electrónico actual',
            'new' => 'nuevo correo electrónico',
            'new_confirmation' => 'confirmar correo electrónico',
            'title' => 'Correo electrónico',
        ],

        'password' => [
            'current' => 'contraseña actual',
            'new' => 'nueva contraseña',
            'new_confirmation' => 'confirmar contraseña',
            'title' => 'Contraseña',
        ],

        'profile' => [
            'title' => 'Perfil',

            'user' => [
                'user_discord' => 'discord',
                'user_from' => 'ubicación actual',
                'user_interests' => 'intereses',
                'user_msnm' => 'skype',
                'user_occ' => 'ocupación',
                'user_twitter' => 'twitter',
                'user_website' => 'sitio web',
            ],
        ],

        'signature' => [
            'title' => 'Firma',
            'update' => 'actualizar',
        ],
    ],

    'notifications' => [
        'title' => 'Notificaciones',
        'topic_auto_subscribe' => 'activa automáticamente las notificaciones en nuevos temas del foro que crees',
        'beatmapset_discussion_qualified_problem' => 'recibir notificaciones de nuevos problemas en beatmaps calificados de los siguientes modos',

        'mail' => [
            '_' => 'recibir notifiaciones por correo',
            'beatmapset:modding' => 'beatmap modding',
            'forum_topic_reply' => 'respuesta al tema',
        ],
    ],

    'oauth' => [
        'authorized_clients' => 'clientes autorizados',
        'own_clients' => 'clientes propios',
        'title' => 'OAuth',
    ],

    'playstyles' => [
        'keyboard' => 'teclado',
        'mouse' => 'ratón',
        'tablet' => 'tableta',
        'title' => 'Estilos de juego',
        'touch' => 'táctil',
    ],

    'privacy' => [
        'friends_only' => 'bloquear los mensajes privados de usuarios que no están en tu lista de amigos',
        'hide_online' => 'mostrarse como desconectado',
        'title' => 'Privacidad',
    ],

    'security' => [
        'current_session' => 'actual',
        'end_session' => 'Cerrar sesión',
        'end_session_confirmation' => 'Esto cerrará inmediatamente su sesión en ese dispositivo. ¿Esta seguro?',
        'last_active' => 'Última vez activo:',
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
        'title' => 'Enlace de verificación inválido o caducado',
    ],
];

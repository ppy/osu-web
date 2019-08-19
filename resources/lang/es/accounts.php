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
        'title' => '<strong>Ajustes</strong> de la cuenta',
        'title_compact' => 'ajustes',
        'username' => 'nombre de usuario',

        'avatar' => [
            'title' => 'Avatar',
            'rules' => '',
            'rules_link' => '',
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
    ],

    'oauth' => [
        'authorized_clients' => 'clientes autorizados',
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
        'friends_only' => 'Bloquear mensajes privados de gente que no está en tu lista de amigos',
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
        'email_subject' => 'Confirmación de cambio de correo electrónico de osu!',
        'update' => 'actualizar',
    ],

    'update_password' => [
        'email_subject' => 'Confirmación de cambio de contraseña de osu!',
        'update' => 'actualizar',
    ],

    'verification_completed' => [
        'text' => '',
        'title' => '',
    ],

    'verification_invalid' => [
        'title' => '',
    ],
];

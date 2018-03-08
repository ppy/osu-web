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
    'edit' => [
        'title' => '<strong>Ajustes</strong> de la Cuenta',
        'title_compact' => 'ajustes',

        'avatar' => [
            'title' => 'Editar Avatar',
        ],

        'email' => [
            'current' => 'correo electrónico actual',
            'new' => 'nuevo correo electrónico',
            'new_confirmation' => 'verificar correo electrónico',
            'title' => 'Correo Electrónico',
        ],

        'password' => [
            'current' => 'contraseña actual',
            'new' => 'nueva contraseña',
            'new_confirmation' => 'verificar contraseña',
            'title' => 'Contraseña',
        ],

        'profile' => [
            'title' => 'Editar Perfil',

            'user' => [
                'user_from' => 'ubicación actual',
                'user_msnm' => 'skype',
                'user_interests' => 'intereses',
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

    'update_email' => [
        'email_subject' => 'osu! - Confirmación de cambio de correo electrónico',
        'update' => 'actualizar',
    ],

    'update_password' => [
        'email_subject' => 'osu! - Confirmación de cambio de contraseña',
        'update' => 'actualizar',
    ],

    'playstyles' => [
        'title' => 'Estilos de juego',
        'mouse' => 'ratón',
        'keyboard' => 'teclado',
        'tablet' => 'tableta',
        'touch' => 'táctil',
    ],
];

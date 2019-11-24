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
    'title' => 'Reestablecer contraseña',

    'button' => [
        'cancel' => 'Cancelar',
        'resend' => 'Reenviar verificación por correo electrónico',
        'set' => 'Establecer contraseña',
        'start' => 'Empezar',
    ],

    'email' => [
        'subject' => 'Recuperación de tu cuenta de osu!',
    ],

    'error' => [
        'contact_support' => 'Contacta al soporte técnico para recuperar tu contraseña.',
        'is_privileged' => 'Por favor, póngase en contacto con un administrador de alto nivel para recuperar la cuenta.',
        'missing_key' => 'Requerido.',
        'too_many_tries' => 'Demasiados intentos fallidos.',
        'user_not_found' => 'El usuario solicitado no existe.',
        'wrong_key' => 'Código incorrecto.',
    ],

    'notice' => [
        'sent' => 'Revisa tu correo electrónico por tu código de verificación.',
        'saved' => '¡Nueva contraseña guardada!',
    ],

    'started' => [
        'password' => 'Nueva contraseña',
        'password_confirmation' => 'Confirmar contraseña',
        'title' => 'Restableciendo contraseña para la cuenta <strong>:username</strong>.',
        'verification_key' => 'Código de verificación',
    ],

    'starting' => [
        'username' => 'Ingresa correo electrónico o nombre de usuario',

        'support' => [
            '_' => '¿Necesitas asistencia? Contáctanos a través de nuestro :button.',
            'button' => 'sistema de soporte',
        ],
    ],
];

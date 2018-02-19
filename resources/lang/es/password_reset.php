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
    'title' => 'Reestablecer Contraseña',

    'button' => [
        'cancel' => 'Cancelar',
        'resend' => 'Reenviar verificación por correo electrónico',
        'set' => 'Definir contraseña',
        'start' => 'Empezar',
    ],

    'email' => [
        'subject' => 'Recuperación de tu cuenta de osu!',
    ],

    'error' => [
        'contact_support' => 'Contacta al soporte técnico para recuperar tu contraseña.',
        'is_privileged' => 'Contacta a peppy lulz.',
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
        'password_confirmation' => 'Verifica tu contraseña',
        'title' => 'Restableciendo contraseña para la cuenta <strong>:username</strong>.',
        'verification_key' => 'Código de verificación',
    ],

    'starting' => [
        'username' => 'Ingresa correo electrónico o nombre de usuario',
    ],
];

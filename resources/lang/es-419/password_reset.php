<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'button' => [
        'resend' => 'Reenviar correo electrónico de verificación',
        'set' => 'Establecer contraseña',
        'start' => 'Empezar',
    ],

    'error' => [
        'contact_support' => 'Ponte en contacto con el soporte técnico para recuperar tu cuenta.',
        'expired' => 'El código de verificación ha expirado.',
        'invalid' => 'Error inesperado en el código de verificación.',
        'is_privileged' => 'Ponte en contacto con un administrador autorizado para recuperar la cuenta.',
        'missing_key' => 'Requerido.',
        'too_many_requests' => '',
        'too_many_tries' => 'Demasiados intentos fallidos.',
        'user_not_found' => 'El usuario solicitado no existe.',
        'wait_resend' => '',
        'wrong_key' => 'Código incorrecto.',
    ],

    'notice' => [
        'sent' => 'Revisa tu correo electrónico para ver el código de verificación.',
        'saved' => '¡Nueva contraseña guardada!',
    ],

    'started' => [
        'password' => 'Nueva contraseña',
        'password_confirmation' => 'Confirmar contraseña',
        'title' => 'Se está restableciendo la contraseña de la cuenta <strong>:username</strong>.',
        'verification_key' => 'Código de verificación',
    ],

    'starting' => [
        'username' => 'Introduce la dirección de correo electrónico o el nombre de usuario',

        'reason' => [
            'inactive_different_country' => "Tu cuenta no ha sido utilizada desde hace mucho tiempo. Para garantizar la seguridad de tu cuenta, restablece tu contraseña.",
        ],
        'support' => [
            '_' => '¿Necesitas más ayuda? Ponte en contacto con nosotros a través de nuestro :button.',
            'button' => 'sistema de soporte',
        ],
    ],
];

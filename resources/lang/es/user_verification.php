<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'box' => [
        'sent' => 'Un correo electrónico ha sido enviado a :mail con un código de verificación. Ingresa ese código.',
        'title' => 'Verificación de la Cuenta',
        'verifying' => 'Verificando..',
        'issuing' => 'Emitiendo nuevo código...',

        'info' => [
            'check_spam' => "Asegúrate de revisar tu carpeta de spam si no puede encontrar el correo electrónico.",
            'recover' => "Si no puede acceder a tu correo electrónico o has olvidado cual usaste, por favor sigue el :link.",
            'recover_link' => 'proceso de recuperación de correo electrónico aquí',
            'reissue' => 'También puedes :reissue_link o :logout_link.',
            'reissue_link' => 'solicitar otro código',
            'logout_link' => 'cerrar sesión',
        ],
    ],

    'errors' => [
        'expired' => 'El código de verificación ha expirado, nuevo correo de verificación enviado.',
        'incorrect_key' => 'Código de verificación incorrecto.',
        'retries_exceeded' => 'Código de verificación incorrecto. Límite de intentos excedido, nuevo correo de verificación enviado.',
        'reissued' => 'Código de verificación reemitido, nuevo correo de verificación enviado.',
        'unknown' => 'Ha ocurrido un problema desconocido, nuevo correo de verificación enviado.',
    ],
];

<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'box' => [
        'sent' => 'Se ha enviado un correo a :mail con un código de verificación. Introduzca el código.',
        'title' => 'Verificación de la cuenta',
        'verifying' => 'Verificando...',
        'issuing' => 'Emitiendo nuevo código...',

        'info' => [
            'check_spam' => "Asegúrese de revisar su carpeta de spam (correo no deseado) si no puede encontrar el correo.",
            'recover' => "Si no puede acceder a su correo o ha olvidado el que usó, siga el :link.",
            'recover_link' => 'proceso de recuperación de correo electrónico aquí',
            'reissue' => 'También puede :reissue_link o :logout_link.',
            'reissue_link' => 'solicitar otro código',
            'logout_link' => 'cerrar la sesión',
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

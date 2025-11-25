<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'box' => [
        'sent' => 'Se ha enviado un correo a :mail con un código de verificación. Introduce el código.',
        'title' => 'Verificación de la cuenta',
        'verifying' => 'Verificando...',
        'issuing' => 'Emitiendo un nuevo código...',

        'info' => [
            'check_spam' => "Asegúrate de revisar tu carpeta de spam si no encuentras el correo electrónico.",
            'recover' => "Si no puedes acceder a tu correo electrónico o has olvidado el que utilizaste, sigue el :link.",
            'recover_link' => 'proceso de recuperación de correo electrónico aquí',
            'reissue' => 'También puedes :reissue_link o :logout_link.',
            'reissue_link' => 'solicitar otro código',
            'logout_link' => 'cerrar la sesión',
        ],
    ],

    'box_totp' => [
        'heading' => '',

        'info' => [
            'logout' => [
                '_' => '',
                'link' => '',
            ],
            'mail_fallback' => [
                '_' => '',
                'link' => '',
            ],
        ],
    ],

    'errors' => [
        'expired' => 'El código de verificación ha expirado, se ha enviado un nuevo correo electrónico de verificación.',
        'incorrect_key' => 'Código de verificación incorrecto.',
        'retries_exceeded' => 'Código de verificación incorrecto. Se ha excedido el límite de intentos, se ha enviado un nuevo correo de verificación.',
        'reissued' => 'El código de verificación se ha vuelto a emitir, se ha enviado un nuevo correo electrónico de verificación.',
        'totp_used_key' => '',
        'totp_gone' => '',
        'unknown' => 'Se ha producido un problema desconocido, se ha enviado un nuevo correo electrónico de verificación.',
    ],
];

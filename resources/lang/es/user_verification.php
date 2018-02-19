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
    'box' => [
        'sent' => 'Un correo electrónico ha sido enviado a :mail con un código de verificación. Ingresa ese código.',
        'title' => 'Verificación de la Cuenta',
        'verifying' => 'Verificando..',
        'issuing' => 'Emitiendo nuevo código...',

        'info' => [
            'check_spam' => 'Asegúrate de revisar la carpeta de correos no deseados si no logras encontrar el correo.',
            'recover' => 'Si no puedes entrar a tu correo o has olvidado cuál usaste, sigue este :link.',
            'recover_link' => 'proceso de recuperación de correo electrónico aquí',
            'reissue' => 'También puedes :reissue_link o :logout_link.',
            'reissue_link' => 'solicitar otro código',
            'logout_link' => 'cerrar sesión',
        ],
    ],

    'email' => [
        'subject' => 'Verificación de la cuenta de osu!',
    ],

    'errors' => [
        'expired' => 'El código de verificación ha expirado, nuevo correo de verificación enviado.',
        'incorrect_key' => 'Código de verificación incorrecto.',
        'retries_exceeded' => 'Código de verificación incorrecto. Límite de intentos excedido, nuevo correo de verificación enviado.',
        'reissued' => 'Código de verificación reemitido, nuevo correo de verificación enviado.',
        'unknown' => 'Ha ocurrido un problema desconocido, nuevo correo de verificación enviado.',
    ],
];

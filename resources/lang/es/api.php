<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'error' => [
        'chat' => [
            'empty' => 'No se puede enviar un mensaje en blanco.',
            'limit_exceeded' => 'Estás enviando mensajes demasiado rápido, espera un poco e inténtalo de nuevo.',
            'too_long' => 'El mensaje que intentas enviar es demasiado largo.',
        ],
    ],

    'scopes' => [
        'identify' => 'Identificarte y leer tu perfil público.',

        'friends' => [
            'read' => 'Mirar quien sigues.',
        ],

        'users' => [
            'read' => 'Lea el perfil público de cualquier usuario en su nombre.',
        ],
    ],
];

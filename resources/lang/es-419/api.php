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
        'bot' => 'Actuar como un bot del chat.',
        'identify' => 'Identificarte y leer tu perfil público.',

        'chat' => [
            'read' => 'Leer mensajes en tu nombre.',
            'write' => 'Enviar mensajes en tu nombre.',
            'write_manage' => 'Unirse y abandonar canales en tu nombre.',
        ],

        'forum' => [
            'write' => 'Crear y editar temas y publicaciones del foro en tu nombre.',
            'write_manage' => '',
        ],

        'friends' => [
            'read' => 'Ver a quién sigues.',
        ],

        'public' => 'Leer datos públicos en tu nombre.',
    ],
];

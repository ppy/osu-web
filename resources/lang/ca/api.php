<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'error' => [
        'chat' => [
            'empty' => 'No es pot enviar un missatge en blanc.',
            'limit_exceeded' => 'Esteu enviant missatges massa ràpid, espereu una mica abans de tornar-ho a provar.',
            'too_long' => 'El missatge que intenteu enviar és massa llarg.',
        ],
    ],

    'scopes' => [
        'bot' => 'Actuar com a bot de xat.',
        'identify' => 'Identificar-te i llegir el teu perfil públic.',

        'chat' => [
            'write' => 'Enviar missatges en nom vostre.',
        ],

        'forum' => [
            'write' => 'Crear i editar temes i publicacions del fòrum en nom seu.',
        ],

        'friends' => [
            'read' => 'Veure qui segueixes.',
        ],

        'public' => 'Llegir dades públiques en nom seu.',
    ],
];

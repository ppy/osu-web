<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'error' => [
        'chat' => [
            'empty' => 'No es pot enviar un missatge buit.',
            'limit_exceeded' => 'Estàs enviant missatges massa ràpid, espera una mica i intenta-ho de nou.',
            'too_long' => 'El missatge que intentes enviar és massa llarg.',
        ],
    ],

    'scopes' => [
        'bot' => 'Actuar com un bot de xat.',
        'identify' => 'Identifiqueu-vos i llegiu el vostre perfil públic.',

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

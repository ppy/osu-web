<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'box' => [
        'sent' => 'S\'ha enviat un correu electrònic a :mail amb un codi de verificació. Introduïu el codi.',
        'title' => 'Verificació del compte',
        'verifying' => 'Verificant...',
        'issuing' => 'S\'està emetent un codi nou...',

        'info' => [
            'check_spam' => "Assegureu-vos de comprovar la vostra carpeta de correu brossa si no podeu trobar el correu electrònic.",
            'recover' => "Si no pots accedir al teu correu electrònic o has oblidat el que has utilitzat, segueix l'enllaç :link.",
            'recover_link' => 'procés de recuperació del correu electrònic aquí',
            'reissue' => 'També podeu :reissue_link o :logout_link.',
            'reissue_link' => 'sol·licita un altre codi',
            'logout_link' => 'tanca la sessió',
        ],
    ],

    'box_totp' => [
        'heading' => 'Escriviu el codi de l\'Authenticator.',

        'info' => [
            'logout' => [
                '_' => 'També podeu :link.',
                'link' => 'tancar la sessió',
            ],
            'mail_fallback' => [
                '_' => 'Si no podeu entrar a l\'aplicació, :link.',
                'link' => 'podeu fer la verificació amb el correu electrònic',
            ],
        ],
    ],

    'errors' => [
        'expired' => 'El codi de verificació ha caducat, s\'ha enviat un correu electrònic de verificació nou.',
        'incorrect_key' => 'Codi de verificació incorrecte.',
        'retries_exceeded' => 'Codi de verificació incorrecte. S\'ha excedit el límit de reintents, s\'ha enviat un correu electrònic de verificació nou.',
        'reissued' => 'S\'ha reeditat el codi de verificació, s\'ha enviat un nou correu electrònic de verificació.',
        'totp_used_key' => 'El codi de verificació ja s\'ha fet servir. Espereu un moment i feu-ne servir un de nou.',
        'totp_gone' => 'El testimoni d\'autenticació s\'ha eliminat. Es canvia a verificació per correu electrònic. S\'ha enviat un correu electrònic.',
        'unknown' => 'S\'ha produït un problema desconegut, s\'ha enviat un correu electrònic de verificació nou.',
    ],
];

<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'error' => [
        'chat' => [
            'empty' => 'Vous ne pouvez pas envoyer un message vide.',
            'limit_exceeded' => 'Vous envoyez des messages trop rapidement, veuillez attendre un peu avant de réessayer.',
            'too_long' => 'Le message que vous essayez d\'envoyer est trop long.',
        ],
    ],

    'scopes' => [
        'identify' => 'Vous identifie et lis votre profil public.',

        'friends' => [
            'read' => 'Voir qui vous suivez.',
        ],

        'users' => [
            'read' => 'Lire le profil public de tout utilisateur en votre nom.',
        ],
    ],
];

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
        'bot' => 'Agir en tant que Chatbot.',
        'identify' => 'Vous identifier et lire votre profil public.',

        'chat' => [
            'write' => 'Envoyer des messages en votre nom.',
        ],

        'forum' => [
            'write' => 'Créer et modifier des sujets et des messages sur le forum en votre nom.',
        ],

        'friends' => [
            'read' => 'Voir qui vous suivez.',
        ],

        'public' => 'Lire des données publiques en votre nom.',
    ],
];

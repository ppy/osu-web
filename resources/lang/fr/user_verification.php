<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'box' => [
        'sent' => 'Un mail a été envoyé à :mail avec un code de vérification. Entrez le code.',
        'title' => 'Vérification du compte',
        'verifying' => 'Vérification...',
        'issuing' => 'Envoi d\'un nouveau code...',

        'info' => [
            'check_spam' => "Veuillez vérifier votre dossier spam si vous ne voyez pas le mail.",
            'recover' => "Si vous ne pouvez pas accéder à votre boîte mail ou si vous ne savez plus laquelle vous avez utilisée, cliquez sur ce lien :link.",
            'recover_link' => 'processus de récupération de mail ici',
            'reissue' => 'Vous pouvez :reissue_link ou :logout_link.',
            'reissue_link' => 'demander un autre code',
            'logout_link' => 'se déconnecter',
        ],
    ],

    'errors' => [
        'expired' => 'Le code de vérification a expiré, un nouvel email de vérification a été envoyé.',
        'incorrect_key' => 'Code de vérification incorrect.',
        'retries_exceeded' => 'Code de vérification incorrect. Limite de tentatives dépassées, envoi d\'un nouvel email de vérification.',
        'reissued' => 'Un nouveau code de vérification a été généré et envoyé, merci de vérifier votre boîte mail.',
        'unknown' => 'Un problème inconnu est survenu, nouvel email de vérification envoyé.',
    ],
];

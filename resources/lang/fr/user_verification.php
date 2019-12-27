<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
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
        'sent' => 'Un mail a été envoyé à :mail avec un code de vérification. Entrez le code.',
        'title' => 'Vérification de compte',
        'verifying' => 'Vérification...',
        'issuing' => 'Envoi d\'un nouveau code...',

        'info' => [
            'check_spam' => "Merci de vérifier votre dossier spam si vous ne voyez pas le mail.",
            'recover' => "Si vous ne pouvez pas accéder à votre boîte mail ou si vous ne savez plus laquelle vous avez utilisée, cliquez sur ce lien :link.",
            'recover_link' => 'processus de récupération de mail ici',
            'reissue' => 'Vous pouvez :reissue_link ou :logout_link.',
            'reissue_link' => 'demander un autre code',
            'logout_link' => 'vous déconnecter',
        ],
    ],

    'errors' => [
        'expired' => 'Le code de vérification a expiré, un nouvel email de vérification a été envoyé.',
        'incorrect_key' => 'Code de vérification incorrect.',
        'retries_exceeded' => 'Code de vérification incorrect. Limite de tentatives dépassées, envoi d\'un nouvel email de vérification.',
        'reissued' => 'Un nouveau code de vérification a été généré et envoyé, merci de vérifier votre boîte mail',
        'unknown' => 'Un problème inconnu est survenu, nouvel email de vérification envoyé.',
    ],
];

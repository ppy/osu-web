<?php

/**
 *    Copyright 2015-2016 ppy Pty. Ltd.
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
            'check_spam' => 'Merci de vérifier votre dossier spam si vous voyez pas le mail.',
            'recover' => 'Si vous ne pouvez pas accéder au mail ou si vous avez oublié ce que vous avez mis, cliquez sur ce lien :link.',
            'recover_link' => 'processus de récupération de mail ici',
            'reissue' => 'Vous pouvez :reissue_link ou :logout_link.',
            'reissue_link' => 'demander un autre code',
            'logout_link' => 'vous déconnecter',
        ],
    ],

    'email' => [
        'subject' => 'vérification du compte osu!',
    ],

    'errors' => [
        'expired' => 'Le code de vérification a expiré, un nouvel e-mail de vérification a été envoyé.',
        'incorrect_key' => 'Code de vérification incorrect.',
        'retries_exceeded' => 'Code de vérification incorrect. Limite de tentavies dépassées, envoi d\'un nouveau mail de vérification.',
        'reissued' => 'Code de vérification regénéré, nouveau mail de vérification envoyé.',
        'unknown' => 'Un problème inconnu est survenu, nouveau mail de vérification envoyé.',
    ],
];

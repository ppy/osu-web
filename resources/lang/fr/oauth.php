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
    'cancel' => 'Annuler',

    'authorise' => [
        'request' => 'demande la permission d\'accéder à votre compte.',
        'scopes_title' => 'Cette application pourra :',
        'title' => 'Demande d’autorisation',
    ],

    'authorized_clients' => [
        'confirm_revoke' => 'Êtes-vous sûr de vouloir révoquer les permissions de ce client ?',
        'scopes_title' => 'Cette application peut :',
        'owned_by' => 'Crée par :user',
        'none' => 'Aucun client',

        'revoked' => [
            'false' => 'Révoquer l\'accès',
            'true' => 'Accès révoqué',
        ],
    ],

    'client' => [
        'id' => 'ID du client',
        'name' => 'Nom de l\'application',
        'redirect' => 'URL de retour de l\'application',
        'secret' => 'Client Secret',
    ],

    'new_client' => [
        'header' => 'Inscrire une nouvelle application OAuth',
        'register' => 'Inscrire une application',
        'terms_of_use' => [
            '_' => 'En utilisant cette API vous acceptez :link.',
            'link' => 'Termes d\'utilisation',
        ],
    ],

    'own_clients' => [
        'confirm_delete' => 'Êtes-vous sûr de vouloir supprimer ce client ?',
        'new' => 'Nouvelle application OAuth',
        'none' => 'Aucun client',

        'revoked' => [
            'false' => 'Supprimer',
            'true' => 'Supprimé',
        ],
    ],
];

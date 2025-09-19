<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'cancel' => 'Annuler',

    'authorise' => [
        'app_owner' => 'Application créée par :owner',
        'request' => 'demande la permission d\'accéder à votre compte.',
        'scopes_title' => 'Cette application pourra :',
        'title' => 'Demande d’autorisation',
    ],

    'authorized_clients' => [
        'confirm_revoke' => 'Êtes-vous sûr de vouloir révoquer les permissions de ce client ?',
        'scopes_title' => 'Cette application peut :',
        'owned_by' => 'Créé par :user',
        'none' => 'Aucun client',

        'revoked' => [
            'false' => 'Révoquer l\'accès',
            'true' => 'Accès révoqué',
        ],
    ],

    'client' => [
        'id' => 'ID du client',
        'name' => 'Nom de l\'application',
        'redirect' => 'Callback URL de l\'application',
        'reset' => 'Réinitialiser le Client Secret',
        'reset_failed' => 'La réinitialisation du Client Secret a échoué.',
        'secret' => 'Client Secret',

        'secret_visible' => [
            'false' => 'Afficher le Client Secret',
            'true' => 'Masquer le Client Secret',
        ],
    ],

    'new_client' => [
        'header' => 'Ajouter une nouvelle application via OAuth',
        'register' => 'Ajouter une application',
        'terms_of_use' => [
            '_' => 'En utilisant cette API, vous acceptez les :link.',
            'link' => 'Conditions d’Utilisations',
        ],
    ],

    'own_clients' => [
        'confirm_delete' => 'Êtes-vous sûr de vouloir supprimer ce client ?',
        'confirm_reset' => 'Êtes-vous sûr de vouloir réinitialiser le Client Secret ? Cela révoquera tous les tokens existants.',
        'new' => 'Nouvelle application OAuth',
        'none' => 'Aucun client',

        'revoked' => [
            'false' => 'Supprimer',
            'true' => 'Supprimé',
        ],
    ],
];

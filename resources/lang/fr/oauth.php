<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

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
        'owned_by' => 'Créer par :user',
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
        'reset' => 'Réinitialiser le secret du client',
        'reset_failed' => 'Impossible de réinitialiser le secret du client',
        'secret' => 'Client Secret',

        'secret_visible' => [
            'false' => 'Afficher le secret du client',
            'true' => 'Masquer le secret du client',
        ],
    ],

    'new_client' => [
        'header' => 'Inscrire une nouvelle application OAuth',
        'register' => 'Inscrire une application',
        'terms_of_use' => [
            '_' => 'En utilisant cette API vous acceptez :link.',
            'link' => 'Conditions d’Utilisations',
        ],
    ],

    'own_clients' => [
        'confirm_delete' => 'Êtes-vous sûr de vouloir supprimer ce client ?',
        'confirm_reset' => 'Êtes-vous sûr de vouloir réinitialiser le secret du client ? Cela révoquera tous les jetons existants.',
        'new' => 'Nouvelle application OAuth',
        'none' => 'Aucun client',

        'revoked' => [
            'false' => 'Supprimer',
            'true' => 'Supprimé',
        ],
    ],
];

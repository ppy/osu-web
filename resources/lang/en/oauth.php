<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'cancel' => 'Cancel',

    'authorise' => [
        'request' => 'is requesting permission to access your account.',
        'scopes_title' => 'This application will be able to:',
        'title' => 'Authorisation Request',
    ],

    'authorized_clients' => [
        'confirm_revoke' => 'Are you sure you want to revoke this client\'s permissions?',
        'scopes_title' => 'This application can:',
        'owned_by' => 'Owned by :user',
        'none' => 'No Clients',

        'revoked' => [
            'false' => 'Revoke Access',
            'true' => 'Access Revoked',
        ],
    ],

    'client' => [
        'id' => 'Client ID',
        'name' => 'Application Name',
        'redirect' => 'Application Callback URLs',
        'reset' => 'Reset client secret',
        'reset_failed' => 'Failed to reset client secret',
        'secret' => 'Client Secret',

        'secret_visible' => [
            'false' => 'Show client secret',
            'true' => 'Hide client secret',
        ],
    ],

    'new_client' => [
        'header' => 'Register a new OAuth application',
        'register' => 'Register application',
        'terms_of_use' => [
            '_' => 'By using the API you are agreeing to the :link.',
            'link' => 'Terms of Use',
        ],
    ],

    'own_clients' => [
        'confirm_delete' => 'Are you sure you want to delete this client?',
        'confirm_reset' => 'Are you sure you want to reset the client secret? This will revoke all existing tokens.',
        'new' => 'New OAuth Application',
        'none' => 'No Clients',

        'revoked' => [
            'false' => 'Delete',
            'true' => 'Deleted',
        ],
    ],
];

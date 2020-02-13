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
        'redirect' => 'Application Callback URL',
        'secret' => 'Client Secret',
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
        'new' => 'New OAuth Application',
        'none' => 'No Clients',

        'revoked' => [
            'false' => 'Delete',
            'true' => 'Deleted',
        ],
    ],
];

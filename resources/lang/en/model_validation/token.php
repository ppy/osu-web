<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'invalid_scope' => [
        'all_scope_no_client_credentials' => '* is not allowed with Client Credentials',
        'all_scope_no_mix' => '* is not valid with other scopes',
        'client_missing_owner' => 'The client is missing owner.',
        'client_unauthorized' => 'The client is not authorized.',
        'delegate_bot_only' => 'Delegation with Client Credentials is only available to chat bots.',
        'client_credentials_only' => 'This scope is only valid for client_credentials tokens.',
        'delegate_invalid_combination' => 'Delegation is not supported for this combination of scopes.',
        'delegate_required' => 'delegate scope is required.',
        'empty' => 'Tokens without scopes are not valid.',
        'bot_only' => 'This scope is only available for chat bots or your own clients.',
    ],
];

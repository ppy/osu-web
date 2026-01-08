<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'invalid_scope' => [
        'all_scope_no_client_credentials' => '* n\'est pas autorisé avec "Client Credentials"',
        'all_scope_no_mix' => '* n\'est pas valide avec d\'autres scopes',
        'client_missing_owner' => 'Le propriétaire de ce client n\'est pas spécifié.',
        'client_unauthorized' => 'Ce client n\'est pas autorisé.',
        'delegate_bot_only' => 'La délégation avec des "Client Credentials" n\'est disponible que pour les bots de tchat.',
        'client_credentials_only' => '',
        'delegate_invalid_combination' => 'La délégation n\'est pas supportée pour cette combinaison de scopes.',
        'delegate_required' => 'Le scope "delegate" est requis.',
        'empty' => 'Les jetons sans scopes ne sont pas valides.',
        'bot_only' => 'Ce scope n\'est disponible que pour les bots de tchat ou pour vos propres clients.',
    ],
];

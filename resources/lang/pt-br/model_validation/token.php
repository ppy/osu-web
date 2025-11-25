<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'invalid_scope' => [
        'all_scope_no_client_credentials' => '* não é permitido com as credenciais de cliente',
        'all_scope_no_mix' => '* não é permitido com outros escopos',
        'client_missing_owner' => 'O cliente está sem dono.',
        'client_unauthorized' => 'O cliente não está autorizado.',
        'delegate_bot_only' => 'Ordens com as Credenciais de Cliente só estão disponíveis para chat bots.',
        'client_credentials_only' => '',
        'delegate_invalid_combination' => 'Ordens não são permitidas com essa combinação de escopos.',
        'delegate_required' => 'Delegar escopos é necessário.',
        'empty' => 'Tokens sem escopos não são necessários.',
        'bot_only' => 'Este escopo só está disponível para chat bots ou para seus próprios clientes.',
    ],
];

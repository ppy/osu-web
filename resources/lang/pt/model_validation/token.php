<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'invalid_scope' => [
        'all_scope_no_client_credentials' => '* não é permitido com credenciais de cliente',
        'all_scope_no_mix' => '* não é válido para um diferente âmbito',
        'client_missing_owner' => 'O cliente não tem proprietário.',
        'client_unauthorized' => 'O cliente não está autorizado.',
        'delegate_bot_only' => 'A delegação com credenciais de cliente está disponível apenas para chatbots.',
        'client_credentials_only' => '',
        'delegate_invalid_combination' => 'A delegação não é suportada para esta combinação de âmbitos.',
        'delegate_required' => 'É necessário um âmbito delegado.',
        'empty' => 'Os tokens sem âmbitos não são válidos.',
        'bot_only' => 'Este âmbito está disponível apenas para chatbots ou os próprios clientes.',
    ],
];

<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'invalid_scope' => [
        'all_scope_no_client_credentials' => '* non è consentito con le Credenziali del Client',
        'all_scope_no_mix' => '',
        'client_missing_owner' => 'Il client ha un proprietario mancante.',
        'client_unauthorized' => 'Il client non è autorizzato.',
        'delegate_bot_only' => 'La delegazione con le credenziali del client è solo disponibile ai chat bot.',
        'client_credentials_only' => 'Questo scope è valido solo per token client_credentials.',
        'delegate_invalid_combination' => 'La delegazione non è supportata per questa combinazione di scope.',
        'delegate_required' => 'scope delegato è richiesto.',
        'empty' => 'I token senza scope non sono validi.',
        'bot_only' => 'Questo scopo è solo disponibile ai chat bot o ai tuoi client.',
    ],
];

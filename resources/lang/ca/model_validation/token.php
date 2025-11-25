<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'invalid_scope' => [
        'all_scope_no_client_credentials' => '* no està permès amb credencials de client',
        'all_scope_no_mix' => '* no està permès amb altres àmbits',
        'client_missing_owner' => 'Al client li falta el propietari.',
        'client_unauthorized' => 'El client no està autoritzat.',
        'delegate_bot_only' => 'La delegació amb credencials de client només és disponible per a bots del xat.',
        'client_credentials_only' => '',
        'delegate_invalid_combination' => 'La delegació no suporta aquesta combinació d\'àmbits.',
        'delegate_required' => 'es requereix un àmbit delegat.',
        'empty' => 'Els testimonis sense àmbit no són vàlids.',
        'bot_only' => 'Aquest àmbit només està disponible per als bots del xat i els vostres propis clients.',
    ],
];

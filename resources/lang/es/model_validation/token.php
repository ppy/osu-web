<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'invalid_scope' => [
        'all_scope_no_client_credentials' => '* no está permitido con credenciales de cliente',
        'all_scope_no_mix' => '* no es válido con otros ámbitos',
        'client_missing_owner' => 'El cliente no tiene propietario.',
        'client_unauthorized' => 'El cliente no está autorizado.',
        'delegate_bot_only' => 'La delegación con credenciales de cliente solo está disponible para los bots del chat.',
        'client_credentials_only' => 'Este ámbito solo es válido para tokens de client_credentials.',
        'delegate_invalid_combination' => 'La delegación no es compatible con esta combinación de ámbitos.',
        'delegate_required' => 'se requiere un ámbito delegado.',
        'empty' => 'Los tokens sin ámbito no son válidos.',
        'bot_only' => 'Este ámbito solo está disponible para los bots del chat o tus propios clientes.',
    ],
];

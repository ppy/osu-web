<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'invalid_scope' => [
        'all_scope_no_client_credentials' => '* ist mit Client-Zugangsdaten nicht erlaubt',
        'all_scope_no_mix' => '* ist mit anderen Typen nicht gültig',
        'client_missing_owner' => 'Der Anwendung fehlt der Besitzer.',
        'client_unauthorized' => 'Die Anwendung ist nicht autorisiert.',
        'delegate_bot_only' => 'Delegation mit Client-Zugangsdaten ist nur für Chat-Bots verfügbar.',
        'client_credentials_only' => 'Diese Berechtigung ist nur für Token des Typs "client_credentials" gültig.',
        'delegate_invalid_combination' => 'Die Delegation wird für diese Typen nicht unterstützt.',
        'delegate_required' => 'Typ "delegate" ist erforderlich.',
        'empty' => 'Tokens ohne Typen sind nicht gültig.',
        'bot_only' => 'Dieser Typ ist nur für Chat-Bots oder eigene Anwendungen verfügbar.',
    ],
];

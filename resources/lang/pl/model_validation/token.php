<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'invalid_scope' => [
        'all_scope_no_client_credentials' => '* nie jest dozwolone przy uwierzytelnianiu poprzez dane klienta',
        'all_scope_no_mix' => '* nie jest kompatybilne z innymi uprawnieniami',
        'client_missing_owner' => 'Klient nie posiada właściciela.',
        'client_unauthorized' => 'Klient nie jest uwierzytelniony.',
        'delegate_bot_only' => 'Uprawnienie „delegate” jest dopuszczalne wyłącznie dla botów czatu.',
        'client_credentials_only' => 'To uprawnienie jest dozwolone wyłącznie dla tokenów wygenerowanych przez uwierzytelnianie poprzez dane klienta.',
        'delegate_invalid_combination' => 'Użycie „delegate” nie jest dozwolone przy tej kombinacji uprawnień.',
        'delegate_required' => 'Wymagane jest uprawnienie „delegate”.',
        'empty' => 'Tokeny bez zdefiniowanych uprawnień są nieprawidłowe.',
        'bot_only' => 'To uprawnienie jest dostępne wyłącznie dla botów czatu i Twoich własnych klientów.',
    ],
];

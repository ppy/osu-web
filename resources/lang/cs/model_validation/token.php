<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'invalid_scope' => [
        'all_scope_no_client_credentials' => '* není povoleno s klientskými údaji',
        'all_scope_no_mix' => '* není platný s jinými rozsahy',
        'client_missing_owner' => 'Klientovi chybí vlastník.',
        'client_unauthorized' => 'Klient není autorizován.',
        'delegate_bot_only' => 'Delegace s klientskými údaji je k dispozici pouze pro chatboty.',
        'client_credentials_only' => 'Tento rozsah je platný pouze pro client_credentials tokeny.',
        'delegate_invalid_combination' => 'Pro tuto kombinaci rozsahů není delegace podporována.',
        'delegate_required' => 'rozsah delegáta je vyžadován.',
        'empty' => 'Tokeny bez rozsahu nejsou platné.',
        'bot_only' => 'Tento rozsah je dostupný pouze pro chatboty nebo pro vaše vlastní klienty.',
    ],
];

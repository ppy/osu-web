<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'signature' => [
        'not_match' => 'Le firme non corrispondono',
    ],
    'notification_type' => 'notification_type non è un tipo :type valido',
    'order' => [
        'invalid' => 'L\'ordine non è valido',
        'items' => [
            'virtual_only' => 'Il pagamento con `:provider` non è valido per prodotti fisici.',
        ],
        'status' => [
            'not_checkout' => '',
            'not_paid' => '',
        ],
    ],
    'param' => [
        'invalid' => 'Il parametro \':param\' non corrisponde',
    ],
    'paypal' => [
        'not_echeck' => '',
    ],
    'purchase' => [
        'checkout' => [
            'amount' => 'L\'importo del pagamento non corrisponde: :actual != :expected',
            'currency' => 'Il pagamento non è in USD. (:type)',
        ],
    ],
    'order_number' => [
        'malformed' => '',
        'user_id_mismatch' => '',
    ],
];

<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'signature' => [
        'not_match' => 'Signaturerne matcher ikke hinanden',
    ],
    'notification_type' => 'notification_type er ikke gyldig :type',
    'order' => [
        'invalid' => 'Ordren er ugyldig',
        'items' => [
            'virtual_only' => '`:provider` betalingsmetode er ikke mulig for fysiske produkter.',
        ],
        'status' => [
            'not_checkout' => 'Forsøger at acceptere betaling for en ordre i den forkerte tilstand `:state`.',
            'not_paid' => 'Forsøger at refundere betaling for en ordre i den forkerte tilstand `:state`.',
        ],
    ],
    'param' => [
        'invalid' => '`:param` param matcher ikke',
    ],
    'paypal' => [
        'not_echeck' => 'Afventende betaling er ikke echeck. (:actual)',
    ],
    'purchase' => [
        'checkout' => [
            'amount' => 'Beløbet matcher ikke: :actual != :expected',
            'currency' => 'Beløbet er ikke i USD. (:type)',
        ],
    ],
    'order_number' => [
        'malformed' => 'Det modtagne transaktions-id er misdannet',
        'user_id_mismatch' => 'external_id indeholder det forkerte bruger-id',
    ],
];

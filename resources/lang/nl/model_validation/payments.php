<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'signature' => [
        'not_match' => 'Digitale handtekeningen komen niet overeen',
    ],
    'notification_type' => 'notification_type is geen geldig :type',
    'order' => [
        'invalid' => 'Order is niet geldig',
        'items' => [
            'virtual_only' => '`:provider` is niet geldig voor fysieke items.',
        ],
        'status' => [
            'not_checkout' => 'Proberen betaling te accepteren voor foute state `:state`.',
            'not_paid' => 'Proberen terugbetaling te accepteren voor foute state `:state`.',
        ],
    ],
    'param' => [
        'invalid' => '`:param` parameter komt niet overeen',
    ],
    'paypal' => [
        'not_echeck' => 'Betaling in afwachting is geen echeck. (:actual)',
    ],
    'purchase' => [
        'checkout' => [
            'amount' => 'Betalingsbedrag komt niet overeen: :actual != :expected',
            'currency' => 'Betaling is niet in USD. (:type)',
        ],
    ],
    'order_number' => [
        'malformed' => 'Ontvangen order transactie-id is ongeldig',
        'user_id_mismatch' => 'external_id bevat verkeerde gebruikersid',
    ],
];

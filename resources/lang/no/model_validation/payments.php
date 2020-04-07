<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'signature' => [
        'not_match' => 'Signaturer samsvarer ikke',
    ],
    'notification_type' => 'notification_type er ikke en gyldig :type',
    'order' => [
        'invalid' => 'Bestilling er ikke gyldig',
        'items' => [
            'virtual_only' => 'Betaling fra`:provider` er ikke gyldig for fysiske varer.',
        ],
        'status' => [
            'not_checkout' => '',
            'not_paid' => '',
        ],
    ],
    'param' => [
        'invalid' => '',
    ],
    'paypal' => [
        'not_echeck' => '',
    ],
    'purchase' => [
        'checkout' => [
            'amount' => '',
            'currency' => 'Betaling er ikke i USD. (:type)',
        ],
    ],
    'order_number' => [
        'malformed' => '',
        'user_id_mismatch' => '',
    ],
];

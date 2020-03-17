<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'signature' => [
        'not_match' => 'Signatures do not match',
    ],
    'notification_type' => 'notification_type is not valid :type',
    'order' => [
        'invalid' => 'Order is not valid',
        'items' => [
            'virtual_only' => '`:provider` payment is not valid for physical items.',
        ],
        'status' => [
            'not_checkout' => 'Trying to accept payment for an order in the wrong state `:state`.',
            'not_paid' => 'Trying to refund payment for an order in the wrong state `:state`.',
        ],
    ],
    'param' => [
        'invalid' => '`:param` param does not match',
    ],
    'paypal' => [
        'not_echeck' => 'Pending payment is not an echeck. (:actual)',
    ],
    'purchase' => [
        'checkout' => [
            'amount' => 'Payment amount does not match: :actual != :expected',
            'currency' => 'Payment is not in USD. (:type)',
        ],
    ],
    'order_number' => [
        'malformed' => 'Received order transaction id is malformed',
        'user_id_mismatch' => 'external_id contains wrong user id',
    ],
];

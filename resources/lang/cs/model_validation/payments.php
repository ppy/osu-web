<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'signature' => [
        'not_match' => 'Podpisy se neshodují',
    ],
    'notification_type' => '',
    'order' => [
        'invalid' => 'Neplatný formát',
        'items' => [
            'virtual_only' => '`:provider` platba není platná pro fyzické zboží.',
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
            'currency' => '',
        ],
    ],
    'order_number' => [
        'malformed' => '',
        'user_id_mismatch' => '',
    ],
];

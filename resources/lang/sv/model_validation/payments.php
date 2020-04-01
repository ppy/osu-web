<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'signature' => [
        'not_match' => 'Signaturer stämmer inte överens',
    ],
    'notification_type' => 'notification_type är inte en giltigt :type',
    'order' => [
        'invalid' => 'Order är inte giltigt',
        'items' => [
            'virtual_only' => '`:provider` betalning är inte giltigt för fysiska föremål.',
        ],
        'status' => [
            'not_checkout' => 'Försöker acceptera betalning för en order i fel stat `:state`.',
            'not_paid' => 'Försöker återbetala betalning för en order i fel stat `:state`.',
        ],
    ],
    'param' => [
        'invalid' => '`:param` parameter stämmer inte överens',
    ],
    'paypal' => [
        'not_echeck' => 'Pågående betalning är inte en echeck. (:actual)',
    ],
    'purchase' => [
        'checkout' => [
            'amount' => 'Betalningssumma stämmer inte överens: :actual != :expected',
            'currency' => 'Betalning är inte i USD. (:type)',
        ],
    ],
    'order_number' => [
        'malformed' => 'Mottagen order transaktion id är missformad',
        'user_id_mismatch' => 'external_id innehåller fel användar id',
    ],
];

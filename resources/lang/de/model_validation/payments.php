<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'signature' => [
        'not_match' => 'Signaturen stimmen nicht überein',
    ],
    'notification_type' => 'notification_type ist nicht gültig :type',
    'order' => [
        'invalid' => 'Bestellung ist ungültig',
        'items' => [
            'virtual_only' => '`:provider` Zahlung nicht möglich für physische Gegenstände.',
        ],
        'status' => [
            'not_checkout' => 'Versuche, eine Bezahlung für eine Bestellung in dem falschen Zustand `:state` zu akzeptieren.',
            'not_paid' => 'Versuche, eine Zahlung für eine Bestellung im falschen Status `:state:` zurückzuerstatten.',
        ],
    ],
    'param' => [
        'invalid' => '`:param`Param stimmt nicht überein',
    ],
    'paypal' => [
        'not_echeck' => 'Ausstehende Zahlung ist kein echeck (:actual)',
    ],
    'purchase' => [
        'checkout' => [
            'amount' => 'Zahlungsbetrag ist ungültig: :actual != :expected',
            'currency' => 'Zahlung ist nicht in USD. (:type)',
        ],
    ],
    'order_number' => [
        'malformed' => 'Erhaltene Transaktions-ID ist fehlerhaft',
        'user_id_mismatch' => 'external_id enthält die falsche Nutzer-ID',
    ],
];

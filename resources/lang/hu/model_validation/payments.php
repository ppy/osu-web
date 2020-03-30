<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'signature' => [
        'not_match' => 'Az aláírások nem egyeznek',
    ],
    'notification_type' => 'notification_type helytelen :type',
    'order' => [
        'invalid' => 'Érvénytelen rendelés',
        'items' => [
            'virtual_only' => '`:provider` fizetés nem érvényes kézzel fogható termékekre.',
        ],
        'status' => [
            'not_checkout' => 'Rossz államból próbálod elfogadtatni a kifizetést `:state`.',
            'not_paid' => 'Próbáljuk visszatéríteni egy másik államból `:state` való vásárlásod.',
        ],
    ],
    'param' => [
        'invalid' => '`:param` paraméter nem egyezik',
    ],
    'paypal' => [
        'not_echeck' => 'A függőben lévő vásárlás nem echeck. (:actual)',
    ],
    'purchase' => [
        'checkout' => [
            'amount' => 'Fizetett összeg nem egyezik: :actual != :expected',
            'currency' => 'Nem USD-vel fizetsz. (:type)',
        ],
    ],
    'order_number' => [
        'malformed' => 'A rendelés tranzakciós azonosítója sérült',
        'user_id_mismatch' => 'external_id hibás user id-t tartalmaz',
    ],
];

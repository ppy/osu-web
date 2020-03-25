<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'signature' => [
        'not_match' => 'Allekirjoitukset eivät täsmää',
    ],
    'notification_type' => 'ilmoituksen_tyyppi ei kelpaa :tyyppi',
    'order' => [
        'invalid' => 'Tilaus ei kelpaa',
        'items' => [
            'virtual_only' => '`:provider` maksu ei ole kelvollinen fyysisille tavaroille.',
        ],
        'status' => [
            'not_checkout' => '',
            'not_paid' => 'Maksun takaisinsaannin yrittäminen väärässä tilassa `:state`.',
        ],
    ],
    'param' => [
        'invalid' => '`:param` parametri ei ole sama',
    ],
    'paypal' => [
        'not_echeck' => 'Odottava maksu ei ole emaksu. (:actual)',
    ],
    'purchase' => [
        'checkout' => [
            'amount' => 'Maksun summa ei ole sama: :actual != :expected',
            'currency' => 'Maksu ei ole Yhdysvaltain dollareissa. (:type)',
        ],
    ],
    'order_number' => [
        'malformed' => 'Vastaanotetun tilauksen maksutunnus on virheellinen',
        'user_id_mismatch' => 'ulkoinen_tunnus sisältää väärän käyttäjätunnuksen',
    ],
];

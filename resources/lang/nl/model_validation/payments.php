<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
 *
 *    This file is part of osu!web. osu!web is distributed with the hope of
 *    attracting more community contributions to the core ecosystem of osu!.
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License version 3
 *    as published by the Free Software Foundation.
 *
 *    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
 *    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *    See the GNU Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public License
 *    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
 */

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

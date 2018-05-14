<?php

/**
 *    Copyright 2015-2017 ppy Pty. Ltd.
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

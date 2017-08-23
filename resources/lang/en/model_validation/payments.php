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
    'notification_type' => 'notification_type is not valid :type',
    'order' => [
        'invalid' => 'Order is not valid',
        'status' => [
            'not_checkout' => 'Trying to accept payment for an order that is not in checkout state.',
        ],
    ],
    'purchase' => [
        'checkout' => [
            'amount' => 'Payment is insufficient: :expected < :received',
            'currency' => 'Payment is not in USD. (:type)',
        ],
    ],
    'transaction' => [
        'external_id' => 'Received order transaction id is malformed',
        'user_id_mismatch' => 'external_id contains wrong user id',
    ],
];

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

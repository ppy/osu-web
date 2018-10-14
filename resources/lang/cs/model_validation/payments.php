<?php

/**
 *    Copyright 2015-2018 ppy Pty. Ltd.
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

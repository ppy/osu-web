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
        'not_match' => 'Signaturen stimmen nicht überein',
    ],
    'notification_type' => 'notification_type ist nicht gültig :typ',
    'order' => [
        'invalid' => 'Bestellung ist nicht gültig',
        'items' => [
            'virtual_only' => '`:anbieter`Bezahlung nicht möglich für physische Gegenstände.',
        ],
        'status' => [
            'not_checkout' => 'Versucht, eine Bezahlung für eine Bestellung mit dem falschen Zustand zu akzeptieren. `:status`.',
            'not_paid' => '',
        ],
    ],
    'param' => [
        'invalid' => '`:param`Param stimmt nicht überein',
    ],
    'paypal' => [
        'not_echeck' => '',
    ],
    'purchase' => [
        'checkout' => [
            'amount' => 'Zahlungsbetrag ist ungültig: :actual != :expected',
            'currency' => 'Zahlung ist nicht in USD. (:type)',
        ],
    ],
    'order_number' => [
        'malformed' => '',
        'user_id_mismatch' => '',
    ],
];

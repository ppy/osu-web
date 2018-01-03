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

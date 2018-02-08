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
        'not_match' => 'Signaturerne matcher ikke hinanden',
    ],
    'notification_type' => 'notification_type er ikke gyldig :type',
    'order' => [
        'invalid' => 'Ordren er ugyldig',
        'items' => [
            'virtual_only' => '`:provider` betalingsmetode er ikke mulig for fysiske produkter.',
        ],
        'status' => [
            'not_checkout' => 'Forsøger at acceptere betaling for en ordre i den forkerte tilstand `:state`.',
            'not_paid' => 'Forsøger at refundere betaling for en ordre i den forkerte tilstand `:state`.',
        ],
    ],
    'param' => [
        'invalid' => '`:param` param matcher ikke',
    ],
    'paypal' => [
        'not_echeck' => 'Afventende betaling er ikke echeck. (:actual)',
    ],
    'purchase' => [
        'checkout' => [
            'amount' => 'Beløbet matcher ikke: :actual != :expected',
            'currency' => 'Beløbet er ikke i USD. (:type)',
        ],
    ],
    'order_number' => [
        'malformed' => 'Det modtagne transaktions-id er misdannet',
        'user_id_mismatch' => 'external_id indeholder det forkerte bruger-id',
    ],
];

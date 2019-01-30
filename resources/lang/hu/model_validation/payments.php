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

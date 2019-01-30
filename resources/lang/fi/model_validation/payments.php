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

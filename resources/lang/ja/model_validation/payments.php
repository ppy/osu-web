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
        'not_match' => '署名が一致していません。',
    ],
    'notification_type' => 'notification_type が無効の:typeです',
    'order' => [
        'invalid' => '注文が無効です',
        'items' => [
            'virtual_only' => '`:provider`による支払いは物質的な製品にはご利用できません。',
        ],
        'status' => [
            'not_checkout' => '`:state`は精算するには正常でない状態です.',
            'not_paid' => '`:state`は返金するには正常でない状態です',
        ],
    ],
    'param' => [
        'invalid' => '`:param` パラメータが一致しません',
    ],
    'paypal' => [
        'not_echeck' => '保留の支払いはecheckではありません。(:actual)',
    ],
    'purchase' => [
        'checkout' => [
            'amount' => '支払い金額が一致しません： :actual != :expected',
            'currency' => '支払い通貨がUSDではありません。(:type)',
        ],
    ],
    'order_number' => [
        'malformed' => '受け取った取引IDが不正な形式です',
        'user_id_mismatch' => 'external_id の含むuser idが異なります',
    ],
];

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
        'not_match' => '签名不一致',
    ],
    'notification_type' => 'notification_type 不可用 :type',
    'order' => [
        'invalid' => '订单不可用',
        'items' => [
            'virtual_only' => '`:provider` 支付方式无法在实物订单中使用。',
        ],
        'status' => [
            'not_checkout' => '尝试在异常订单中支付 `:state`.',
            'not_paid' => '尝试在异常订单中退款 `:state`.',
        ],
    ],
    'param' => [
        'invalid' => '`:param` 参数不匹配',
    ],
    'paypal' => [
        'not_echeck' => '订单未付款。（:actual）',
    ],
    'purchase' => [
        'checkout' => [
            'amount' => '支付金额不符： :actual != :expected',
            'currency' => '未以美元结算（:type）',
        ],
    ],
    'order_number' => [
        'malformed' => '订单 ID 格式错误',
        'user_id_mismatch' => 'external_id 包含了错误的用户 ID',
    ],
];

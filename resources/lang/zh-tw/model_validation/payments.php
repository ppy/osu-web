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
        'not_match' => '簽名不一致',
    ],
    'notification_type' => 'notification_type 不可用 :type', //需要幫助
    'order' => [
        'invalid' => '訂單不可用',
        'items' => [
            'virtual_only' => '`:provider` 支付方式無法在實物訂單中使用。',
        ],
        'status' => [
            'not_checkout' => '嘗試在異常訂單中支付 `:state`.', //需要幫助
            'not_paid' => '嘗試在異常訂單中退款 `:state`.', //需要幫助
        ],
    ],
    'param' => [
        'invalid' => '`:param` 參數不匹配',
    ],
    'paypal' => [
        'not_echeck' => '訂單未付款。（:actual）',
    ],
    'purchase' => [
        'checkout' => [
            'amount' => '支付金額不符： :actual != :expected',
            'currency' => '未以美元結算（:type）', //需要幫助
        ],
    ],
    'order_number' => [
        'malformed' => '訂單 ID 格式錯誤',
        'user_id_mismatch' => 'external_id 包含了錯誤的用戶 ID', //需要幫助
    ],
];

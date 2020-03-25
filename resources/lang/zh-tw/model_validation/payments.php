<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'signature' => [
        'not_match' => '簽名不一致',
    ],
    'notification_type' => 'notification_type 無效 :type',
    'order' => [
        'invalid' => '訂單無效',
        'items' => [
            'virtual_only' => '`:provider` 付款方式無法實體商品訂單中使用。',
        ],
        'status' => [
            'not_checkout' => '嘗試在異常訂單中付款 `:state`.',
            'not_paid' => '嘗試在異常訂單中退款 `:state`.',
        ],
    ],
    'param' => [
        'invalid' => '`:param` 參數不正確',
    ],
    'paypal' => [
        'not_echeck' => '訂單未付款。（:actual）',
    ],
    'purchase' => [
        'checkout' => [
            'amount' => '付款金額不正確： :actual != :expected',
            'currency' => '並非以美元結算（:type）',
        ],
    ],
    'order_number' => [
        'malformed' => '訂單 ID 格式錯誤',
        'user_id_mismatch' => 'external_id 包含了錯誤的使用者 ID',
    ],
];

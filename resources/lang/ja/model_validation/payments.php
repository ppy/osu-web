<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

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

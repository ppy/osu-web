<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'signature' => [
        'not_match' => '서명이 일치하지 않습니다',
    ],
    'notification_type' => 'notification_type 이 적합한 :type이 아닙니다',
    'order' => [
        'invalid' => '유효하지 않은 주문입니다',
        'items' => [
            'virtual_only' => '`:provider`의 결제는 실물 상품 결제에는 적용되지 않습니다.',
        ],
        'status' => [
            'not_checkout' => '비정상적인 상태(`:state`)에서 주문의 결제를 수락하고 있습니다.',
            'not_paid' => '비정상적인 상태(`:state`)에서 주문의 환불을 수락하고 있습니다.',
        ],
    ],
    'param' => [
        'invalid' => '`:param` 파라미터가 일치하지 않습니다',
    ],
    'paypal' => [
        'not_echeck' => '보류중인 결제방식이 eCheck방식이 아닙니다. (:actual)',
    ],
    'purchase' => [
        'checkout' => [
            'amount' => '결제 금액이 일치하지 않습니다: :actual != :expected',
            'currency' => '결제 화폐가 USD가 아닙니다. (:type)',
        ],
    ],
    'order_number' => [
        'malformed' => '주문의 거래 ID가 변형되었습니다',
        'user_id_mismatch' => 'external_id 값이 잘못된 유저 ID를 포함하고 있습니다',
    ],
];

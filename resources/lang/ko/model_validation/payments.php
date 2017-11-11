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
        'not_match' => '서명이 일치하지 않습니다',
    ],
    'notification_type' => 'notification_type 이 적합한 :type이 아닙니다',
    'order' => [
        'invalid' => '유효하지 않은 주문입니다',
        'items' => [
            'virtual_only' => '`:provider`의 결제는 실물 상품 결제에는 적용되지 않습니다.', // `:provider` payment is not valid for physical items
        ],
        'status' => [
            'not_checkout' => '비정상적인 상태(`:state`)에서 주문의 결제를 수락하고 있습니다.', // Trying to accept payment for an order in the wrong state `:state`.
            'not_paid' => '비정상적인 상태(`:state`)에서 주문의 환불을 수락하고 있습니다.', // Trying to refund payment for an order in the wrong state `:state`.
        ],
    ],
    'param' => [
        'invalid' => '`:param` 파라미터가 일치하지 않습니다', // param does not match
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
        'malformed' => '주문의 거래 ID가 변형되었습니다', // Received order transaction id is malformed
        'user_id_mismatch' => 'external_id 값이 잘못된 유저 ID를 포함하고 있습니다',
    ],
];

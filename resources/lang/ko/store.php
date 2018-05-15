<?php

/**
 *    Copyright 2015-2018 ppy Pty. Ltd.
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
    'admin' => [
        'warehouse' => '보급 창고',
    ],

    'checkout' => [
        'cart_problems' => '장바구니에 문제가 생겼어요!',
        'cart_problems_edit' => '편집하려면 클릭하세요.',
        'declined' => '결제 실패했어요',
        'error' => '결제하는데 문제가 생겨버렸네요:(',
        'old_cart' => '',
        'pay' => 'Paypal로 결제',
        'pending_checkout' => [
            'line_1' => '',
            'line_2' => '',
            'link_text' => '여기를 클릭하세요',
        ],
        'delayed_shipping' => '현재 주문이 밀려있습니다! 주문을 해주시는건 기쁘지만, 지금 주문을 처리하는데 **1~2 주 지연**될 수 있다는 걸 알려드립니다.',
    ],

    'discount' => ':percent% 절약 가능',

    'mail' => [
        'payment_completed' => [
            'subject' => '',
        ],
    ],

    'order' => [
        'item' => [
            'display_name' => [
                'supporter_tag' => ':name for :username (:duration)',
            ],
            'quantity' => '수량',
        ],
    ],

    'product' => [
        'name' => '상품명',

        'stock' => [
            'out' => '현재 재고가 모두 떨어졌네요 :(. 나중에 다시 확인해주세요.',
            'out_with_alternative' => '이 옵션은 재고가 모두 떨어졌네요 :(. 다른 옵션을 선택하시거나, 나중에 다시 확인해주세요.',
        ],

        'add_to_cart' => '장바구니에 추가',
        'notify' => '구매할 수 있을 때 알려주세요!',

        'notification_success' => '재고가 들어오면 알려드리겠습니다. 취소하려면 :link를 누르세요.',
        'notification_remove_text' => '여기',

        'notification_in_stock' => '이 상품의 재고가 있습니다!',
    ],

    'supporter_tag' => [
        'gift' => '선물하기',
        'require_login' => [
            '_' => '서포터 권한을 구매하려면 :link하셔야 합니다!',
            'link_text' => '로그인',
        ],
    ],

    'username_change' => [
        'check' => '사용 가능한 이름인지 확인하려면 입력하세요!',
        'checking' => ':username의 유효성 검사하는 중...',
        'require_login' => [
            '_' => '유저이름을 바꾸려면 :link하셔야 합니다!',
            'link_text' => '로그인',
        ],
    ],
];

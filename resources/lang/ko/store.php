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

    'cart' => [
        'checkout' => '결제',
        'more_goodies' => '주문을 끝내기 전에 더 둘러볼게요',
        'shipping_fees' => '배송료',
        'title' => '장바구니',
        'total' => '합계',

        'errors_no_checkout' => [
            'line_1' => '음, 장바구니에 문제가 있어 결제할 수 없네요!',
            'line_2' => '위에 있는 항목을 제거하거나 수정해서 계속하세요.',
        ],

        'empty' => [
            'text' => '장바구니가 비어 있습니다.',
            'return_link' => [
                '_' => ':link으로 돌아가 상품을 찾아보세요!',
                'link_text' => '상품 목록',
            ],
        ],
    ],

    'checkout' => [
        'cart_problems' => '장바구니에 문제가 생겼어요!',
        'cart_problems_edit' => '편집하려면 클릭하세요.',
        'declined' => '결제가 취소되었습니다.',
        'delayed_shipping' => '현재 주문이 밀려있습니다! 주문을 해주시는건 기쁘지만, 지금 주문을 처리하는데 **1~2 주 지연**될 수 있다는 걸 알려드립니다.',
        'old_cart' => '장바구니가 오래되어 새로 고쳐졌습니다, 다시 시도해 주세요.',
        'pay' => 'Paypal로 결제',

        'has_pending' => [
            '_' => '',
            'link_text' => '여기',
        ],

        'pending_checkout' => [
            'line_1' => '이전 결제가 시작 됐지만 끝나지 않았습니다.',
            'line_2' => '결제 수단을 선택하여 결제를 계속하세요.',
        ],
    ],

    'discount' => ':percent% 절약 가능',

    'invoice' => [
        'echeck_delay' => '',
        'status' => [
            'processing' => [
                'title' => '당신의 결제가 아직 확인되지 않았습니다!',
                'line_1' => '당신이 이미 결제하셨다면, 저희는 아직 당신의 결제의 확인을 받는것을 기다리고 있을 수 있습니다. 1~2분 후 이 페이지를 새로고침 해주세요!',
                'line_2' => [
                    '_' => '결제 도중 문제가 발생하셨다면, :link',
                    'link_text' => '',
                ],
            ],
        ],
    ],

    'mail' => [
        'payment_completed' => [
            'subject' => '귀하의 osu!store 주문을 받았습니다!',
        ],
    ],

    'order' => [
        'paid_on' => ':date에 주문함',

        'invoice' => '청구서 보기',

        'item' => [
            'display_name' => [
                'supporter_tag' => ':name for :username (:duration)',
            ],
            'quantity' => '수량',
        ],

        'not_modifiable_exception' => [
            'cancelled' => '취소된 주문은 수정할 수 없습니다.',
            'checkout' => '제품 처리 중인 경우엔 주문을 수정할 수 없습니다.', // checkout and processing should have the same message.
            'default' => '주문을 수정할 수 없음',
            'delivered' => '배달된 주문을 수정할 수 없습니다.',
            'paid' => '이미 결제하여 주문을 수정할 수 없습니다.',
            'processing' => '제품 처리 중인 경우엔 주문을 수정할 수 없습니다.',
            'shipped' => '배송된 주문을 수정할 수 없습니다.',
        ],

        'status' => [
            'cancelled' => '취소됨',
            'checkout' => '준비 중',
            'delivered' => '배송 완료',
            'paid' => '결제 완료',
            'processing' => '확인 대기 중',
            'shipped' => '운송 중',
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
        'checking' => ':username 사용 가능 여부 확인중..',
        'require_login' => [
            '_' => '유저이름을 바꾸려면 :link하셔야 합니다!',
            'link_text' => '로그인',
        ],
    ],
];

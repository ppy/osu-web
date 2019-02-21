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
    'admin' => [
        'warehouse' => '倉庫',
    ],

    'cart' => [
        'checkout' => '結帳',
        'more_goodies' => '我想在完成訂單之前查看更多的東西',
        'shipping_fees' => '運費',
        'title' => '購物車',
        'total' => '合計',

        'errors_no_checkout' => [
            'line_1' => '呃哦，您的購物車存在問題以致您無法結帳！',
            'line_2' => '刪除或更新上述項目以繼續。',
        ],

        'empty' => [
            'text' => '您的購物車是空的。',
            'return_link' => [
                '_' => '返回到 :link 來找些好東西！',
                'link_text' => '商店列表',
            ],
        ],
    ],

    'checkout' => [
        'cart_problems' => '糟糕，您的購物車出現問題！',
        'cart_problems_edit' => '點擊此處以編輯。',
        'declined' => '付款被取消。',
        'delayed_shipping' => '感謝您的訂購，由於近期湧入訂單過多，故該訂單恐將**延後1~2週的時間**',
        'old_cart' => '您的購物車已過期，請重試。',
        'pay' => '使用 Paypal 付款',

        'has_pending' => [
            '_' => '客官您還有結帳還沒完成呢，點選 :link 查看他們',
            'link_text' => '這裡',
        ],

        'pending_checkout' => [
            'line_1' => '先前的訂單尚未完成',
            'line_2' => '透過選擇付款方式來恢復訂單。',
        ],
    ],

    'discount' => '折扣 :percent%',

    'invoice' => [
        'echeck_delay' => '',
        'status' => [
            'processing' => [
                'title' => '您的付款尚未被確認!',
                'line_1' => '如果您已經付款, 我們可能還在等待收到您付款的確認。請在一兩分鐘內重新整理此頁面!',
                'line_2' => [
                    '_' => '如果您在結帳時遇到問題，請查看 :link',
                    'link_text' => '點擊這裡繼續您的結帳',
                ],
            ],
        ],
    ],

    'mail' => [
        'payment_completed' => [
            'subject' => '我們已收到您的 osu!商店 訂單！',
        ],
    ],

    'order' => [
        'paid_on' => '下訂單 :date',

        'invoice' => '查看收據',
        'no_orders' => '沒有訂單',

        'item' => [
            'display_name' => [
                'supporter_tag' => ':name 給 :username （:duration）',
            ],
            'quantity' => '數量',
        ],

        'not_modifiable_exception' => [
            'cancelled' => '您的訂單已被取消，因此無法修改。',
            'checkout' => '您不能修改正在處理的訂單。', // checkout and processing should have the same message.
            'default' => '訂單不可修改',
            'delivered' => '您不能修改已經交付的訂單。',
            'paid' => '您不能修改您的訂單，因為它已經支付。',
            'processing' => '您不能修改正在處理的訂單。',
            'shipped' => '您不能修改已經出貨的訂單。',
        ],

        'status' => [
            'cancelled' => '已取消',
            'checkout' => '準備中…',
            'delivered' => '已送達',
            'paid' => '已付款',
            'processing' => '待確認',
            'shipped' => '',
        ],
    ],

    'product' => [
        'name' => '名稱',

        'stock' => [
            'out' => '賣完了呢( ´_ゝ｀) 過段時間再回來看看吧。',
            'out_with_alternative' => '很抱歉您所選擇的項目已售完(´；ω；`) 請選擇其他項目或過段時間再回來看看吧。',
        ],

        'add_to_cart' => '加入到購物車',
        'notify' => '可訂購時通知我 !',

        'notification_success' => '當商品有貨時會收到通知，點擊 :link 以取消該通知',
        'notification_remove_text' => '這裡',

        'notification_in_stock' => '新商品，快來買買買！',
    ],

    'supporter_tag' => [
        'gift' => '要贈與的玩家',
        'require_login' => [
            '_' => '您需要 :link 以獲得 osu!supporter 標籤！',
            'link_text' => '登入',
        ],
    ],

    'username_change' => [
        'check' => '输入使用者名稱並檢查是否可用',
        'checking' => '正在檢查 :username 是否可用。。。',
        'require_login' => [
            '_' => '需要 :link 才能變更使用者名稱！',
            'link_text' => '登入',
        ],
    ],
];

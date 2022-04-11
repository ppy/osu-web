<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'cart' => [
        'checkout' => '結帳',
        'info' => '購物車裡有 :count_delimited 件商品（$:subtotal）|購物車裡有 :count_delimited 件商品（$:subtotal）',
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
        'title_compact' => '結帳',

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
        'echeck_delay' => '由於您是用 eCheck 付款，請等待至多 10 天以使該支付通過 PayPal 完成！',
        'title_compact' => '帳單',

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

    'order' => [
        'cancel' => '取消訂單',
        'cancel_confirm' => '此訂單將被取消且款項不會被收取。付款供應商可能不會立即退回任何預收款項。您確定嗎？',
        'cancel_not_allowed' => '目前無法取消訂單。',
        'invoice' => '查看收據',
        'no_orders' => '沒有訂單',
        'paid_on' => '下訂單 :date',
        'resume' => '繼續結賬',
        'shopify_expired' => '此訂單的結帳網址已經過期。',

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
            'checkout' => '準備中',
            'delivered' => '已送達',
            'paid' => '已付款',
            'processing' => '待確認',
            'shipped' => '已出貨',
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
            '_' => '您需要 :link 以獲得 osu!贊助者標籤！',
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

    'xsolla' => [
        'distributor' => '',
    ],
];

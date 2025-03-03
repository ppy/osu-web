<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'cart' => [
        'checkout' => '結帳',
        'empty_cart' => '清空購物車',
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
                'link_text' => '商店清單',
            ],
        ],
    ],

    'checkout' => [
        'cart_problems' => '糟糕，您的購物車出現問題！',
        'cart_problems_edit' => '點擊此處以編輯。',
        'declined' => '付款被取消。',
        'delayed_shipping' => '感謝您的訂購，由於近期湧入訂單過多，故該訂單恐將**延後1~2週的時間**',
        'hide_from_activity' => '不要在最近活動中顯示這項 osu! 贊助者標籤訂單',
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
    'free' => '免費！',

    'invoice' => [
        'contact' => '聯絡:',
        'date' => '日期：',
        'echeck_delay' => '由於您是用 eCheck 付款，請等待至多 10 天以使該支付通過 PayPal 完成！',
        'echeck_denied' => '您的電子支票付款已被 PayPal 拒絕。',
        'hide_from_activity' => '這項 osu! 贊助者訂單未在您的最近活動中顯示。',
        'sent_via' => '透過:',
        'shipping_to' => '運送至：',
        'title' => '帳單',
        'title_compact' => '帳單',

        'status' => [
            'cancelled' => [
                'title' => '你的訂單已取消',
                'line_1' => [
                    '_' => "如果不是您本人所取消，請聯絡 :link 並提供您的訂單編號 (#:order_number)。",
                    'link_text' => 'osu!store 支援',
                ],
            ],
            'delivered' => [
                'title' => '您的貨已送達！希望你能喜歡！',
                'line_1' => [
                    '_' => '如果您對於您的購買有任何疑問，請咨詢 :link。',
                    'link_text' => 'osu!store 支援',
                ],
            ],
            'prepared' => [
                'title' => '正在準備您的訂單！',
                'line_1' => '在訂單出貨前敬請耐心等待。一旦訂單已經處理完成並已經出貨，此處將會顯示最新的運輸資訊。由於我們的繁忙程度所不同，這段時間可能會長達 5 日 (一般情況下不會這麽久！)。',
                'line_2' => '所有訂單都將自日本發出，訂單會依商品重量和價值使用對應的運輸物流業務。若已經出貨，此處將顯示物流詳細資訊。',
            ],
            'processing' => [
                'title' => '您的付款尚未被確認!',
                'line_1' => '如果您已經付款，我們可能還在等待收到您付款的確認。請在一兩分鐘內重新載入此頁面！',
                'line_2' => [
                    '_' => '如果您在結帳時遇到問題，請查看 :link',
                    'link_text' => '按這裡繼續您的結帳',
                ],
            ],
            'shipped' => [
                'title' => '您的訂單已出貨!',
                'tracking_details' => '物流追蹤詳情如下:',
                'no_tracking_details' => [
                    '_' => "因為我們使用 Air Mail 出貨，所以我們無法紀錄物流資訊。但是您可以在 1-3 個星期內收到包裹。如果收貨地址位於歐洲，海關可能會依此延長訂單運輸時間。如果您有任何問題，請回覆您收到的 :link 郵件。",
                    'link_text' => '向我們發送電子郵件',
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
        'shipping_and_handling' => '運輸與處理',
        'shopify_expired' => '此訂單的結帳網址已經過期。',
        'subtotal' => '小計',
        'total' => '總計',

        'details' => [
            'order_number' => '訂單 #',
            'payment_terms' => '支付條款',
            'salesperson' => '銷售員',
            'shipping_method' => '運送方式',
            'shipping_terms' => '運輸條款',
            'title' => '訂單詳情:',
        ],

        'item' => [
            'quantity' => '數量',

            'display_name' => [
                'supporter_tag' => ':name 給 :username （:duration）',
            ],

            'subtext' => [
                'supporter_tag' => '留言: :message',
            ],
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
            'title' => '訂單狀態',
        ],

        'thanks' => [
            'title' => '多謝惠顧！',
            'line_1' => [
                '_' => '您將會收到驗證郵件。如果有任何疑問，請咨詢 :link！',
                'link_text' => '聯絡我們',
            ],
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
        'gift_message' => '為這份禮物寫些留言吧！ (最多 :length 個字符)',

        'require_login' => [
            '_' => '您需要 :link 以獲得 osu!贊助者標籤！',
            'link_text' => '已登入',
        ],
    ],

    'username_change' => [
        'check' => '輸入使用者名稱並檢查是否可用！',
        'checking' => '正在檢查 :username 是否可用。。。',
        'placeholder' => '請求的使用者名稱',
        'label' => '新的使用者名稱',
        'current' => '您目前的使用者名稱是 ":username"。',

        'require_login' => [
            '_' => '需要 :link 才能變更使用者名稱！',
            'link_text' => '已登入',
        ],
    ],

    'xsolla' => [
        'distributor' => '',
    ],
];

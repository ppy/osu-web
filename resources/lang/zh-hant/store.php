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
    'admin' => [
        'warehouse' => '倉庫',
    ],

    'checkout' => [
        'cart_problems' => '啊哦，你的購物車中存在問題！',
        'cart_problems_edit' => '點擊此處以編輯。',
        'declined' => '支付被取消。',
        'error' => '結賬時出現錯誤 :(',
        'pay' => '使用 Paypal 支付',
        'pending_checkout' => [
            'line_1' => '先前的訂單未完成',
            'line_2' => '通過選擇支付方式以恢復訂單，或者 :link 取消訂單。',
            'link_text' => '點擊這裡',
        ],
        'delayed_shipping' => '歡迎購買，但是我們正在處理大量的訂單，所以訂單**可能會有 1-2 周的延遲**。',
    ],

    'discount' => '節省 :percent%',

    'order' => [
        'item' => [
            'display_name' => [
                'supporter_tag' => ':name 給 :username （:duration）',
            ],
            'quantity' => '數量',
        ],
    ],

    'product' => [
        'name' => '名稱',

        'stock' => [
            'out' => '賣完了呢( ´_ゝ｀) 過段時間再回來看看吧。',
            'out_with_alternative' => '選擇的類型已售罄(´；ω；`) 試試另外幾種或者過段時間再回來看看吧。',
        ],

        'add_to_cart' => '添加到購物車',
        'notify' => '當可以購買時提醒我！',

        'notification_success' => '當商品有貨時會收到提醒，點擊 :link 以取消該提醒',
        'notification_remove_text' => '這裡',

        'notification_in_stock' => '新貨到，快來買買買！',
    ],

    'supporter_tag' => [
        'gift' => '要贈與的玩家',
        'require_login' => [
            '_' => '你需要 :link 以獲得 Supporter 標籤！',
            'link_text' => '登錄',
        ],
    ],

    'username_change' => [
        'require_login' => [
            '_' => '需要 :link 才能改變用戶名！',
            'link_text' => '登錄',
        ],
    ],
];

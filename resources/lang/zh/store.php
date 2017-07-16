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
        'warehouse' => '仓库',
    ],

    'checkout' => [
        'pay' => '使用 Paypal 支付',
        'delayed_shipping' => '欢迎您购买，但是我们正在处理大量的订单，所以您的订单**可能会有1-2天的延迟**。',
    ],

    'discount' => '节省 :percent%',

    'order' => [
        'item' => [
            'display_name' => [
                'supporter_tag' => ':name 给 :username （:duration）',
            ],
            'quantity' => '数量',
        ],
    ],

    'product' => [
        'name' => '名称',

        'stock' => [
            'out' => '卖完了呢( ´_ゝ｀) 过段时间再回来看看吧。',
            'out_with_alternative' => '您选择的类型已经卖完了(´；ω；`) 试试另外几种或者过段时间再回来看看吧。',
        ],

        'add_to_cart' => '添加到购物车',
        'notify' => '当可以购买时提醒我！',

        'notification_success' => '当我们进货时您将收到提醒，点击 :link 以取消该提醒',
        'notification_remove_text' => '这里',

        'notification_in_stock' => '这件商品已经进货！',
    ],

    'supporter_tag' => [
        'require_login' => [
            '_' => '你需要 :link 以获得 Supporter 标签！',
            'link_text' => '登录',
        ],
    ],

    'username_change' => [
        'require_login' => [
            '_' => '你需要 :link 才能改变你的用户名！',
            'link_text' => '登录',
        ],
    ],
];

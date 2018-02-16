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
        'cart_problems' => '啊哦，你的购物车中存在问题！',
        'cart_problems_edit' => '点击此处以编辑。',
        'declined' => '支付被取消。',
        'error' => '结账时出现错误 :(',
        'pay' => '使用 Paypal 支付',
        'pending_checkout' => [
            'line_1' => '先前的订单未完成',
            'line_2' => '通过选择支付方式以恢复订单，或者 :link 取消订单。',
            'link_text' => '点击这里',
        ],
        'delayed_shipping' => '欢迎购买，但是我们正在处理大量的订单，所以订单**可能会有 1-2 周的延迟**。',
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
            'out_with_alternative' => '选择的类型已售罄(´；ω；`) 试试另外几种或者过段时间再回来看看吧。',
        ],

        'add_to_cart' => '添加到购物车',
        'notify' => '当可以购买时提醒我！',

        'notification_success' => '当商品有货时会收到提醒，点击 :link 以取消该提醒',
        'notification_remove_text' => '这里',

        'notification_in_stock' => '新货到，快来买买买！',
    ],

    'supporter_tag' => [
        'gift' => '要赠与的玩家',
        'require_login' => [
            '_' => '你需要 :link 以获得 Supporter 标签！',
            'link_text' => '登录',
        ],
    ],

    'username_change' => [
        'require_login' => [
            '_' => '需要 :link 才能改变用户名！',
            'link_text' => '登录',
        ],
    ],
];

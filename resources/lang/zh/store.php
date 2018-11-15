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
        'warehouse' => '仓库',
    ],

    'cart' => [
        'checkout' => '结账',
        'more_goodies' => '在完成订单之前，我想看看其他商品',
        'shipping_fees' => '运费',
        'title' => '购物车',
        'total' => '总计',

        'errors_no_checkout' => [
            'line_1' => '啊哦，你的购物车中存在问题导致你无法结账！',
            'line_2' => '移除或更新上面的物品以继续。',
        ],

        'empty' => [
            'text' => '你的购物车是空的。',
            'return_link' => [
                '_' => '返回到 :link 查看别的商品吧！',
                'link_text' => '商店列表',
            ],
        ],
    ],

    'checkout' => [
        'cart_problems' => '啊哦，你的购物车中存在问题！',
        'cart_problems_edit' => '点击此处以编辑。',
        'declined' => '支付被取消。',
        'delayed_shipping' => '欢迎购买，但是我们正在处理大量的订单，所以订单**可能会有 1-2 周的延迟**。',
        'old_cart' => '你的购物车已经过期，请重试。',
        'pay' => '使用 Paypal 支付',

        'has_pending' => [
            '_' => '你有未完成的支付，点击 :link 查看。',
            'link_text' => '这里',
        ],

        'pending_checkout' => [
            'line_1' => '先前的订单未完成',
            'line_2' => '通过选择支付方式以恢复订单。',
        ],
    ],

    'discount' => '节省 :percent%',

    'invoice' => [
        'echeck_delay' => '由于你的支付是通过 eCheck 进行的，请再等待至多 10 天以使你的支付通过 PayPal 完成！',
        'status' => [
            'processing' => [
                'title' => '您的付款信息尚未确认！',
                'line_1' => '如果你已经支付，请等待我们收到支付信息，稍后再来看看吧。',
                'line_2' => [
                    '_' => '如果你在结账中遇到问题，:link',
                    'link_text' => '点击此处以恢复',
                ],
            ],
        ],
    ],

    'mail' => [
        'payment_completed' => [
            'subject' => '我们已收到你的 osu!商店 订单！',
        ],
    ],

    'order' => [
        'paid_on' => '订单支付于 :date',

        'invoice' => '查看发票',

        'item' => [
            'display_name' => [
                'supporter_tag' => ':name 给 :username （:duration）',
            ],
            'quantity' => '数量',
        ],

        'not_modifiable_exception' => [
            'cancelled' => '你不能修改此订单，因为它已经被取消了。',
            'checkout' => '你不能修改正在处理的订单。', // checkout and processing should have the same message.
            'default' => '订单不可修改',
            'delivered' => '你不能修改此订单，因为它已经送达了。',
            'paid' => '你不能修改此订单，因为它已经完成付款了。',
            'processing' => '你不能修改正在处理的订单。',
            'shipped' => '你不能修改此订单，因为已经发货了。',
        ],

        'status' => [
            'cancelled' => '已取消',
            'checkout' => '准备中',
            'delivered' => '已送达',
            'paid' => '已付款',
            'processing' => '待确认',
            'shipped' => '运输中',
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
            '_' => '你需要 :link 以获得 osu!Supporter 标签！',
            'link_text' => '登录',
        ],
    ],

    'username_change' => [
        'check' => '输入用户名并检查是否可用',
        'checking' => '正在检查 :username 是否可用...',
        'require_login' => [
            '_' => '需要 :link 才能改变用户名！',
            'link_text' => '登录',
        ],
    ],
];

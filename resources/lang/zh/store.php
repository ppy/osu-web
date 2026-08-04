<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'cart' => [
        'checkout' => '去结算',
        'empty_cart' => '清空购物车',
        'info' => '购物车里有 :count_delimited 件商品（$:subtotal）',
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
        'cart_problems' => '啊哦，您的购物车中存在问题！',
        'cart_problems_edit' => '点击此处编辑。',
        'declined' => '支付被取消。',
        'delayed_shipping' => '欢迎购买，但是我们正在处理大量的订单，所以订单可能会有 **1-2 周的延迟**。',
        'hide_from_activity' => '不把此订单中的支持者标签购买同步到个人活动',
        'old_cart' => '您的购物车已经过期，请重试。',
        'pay' => '使用 Paypal 支付',
        'title_compact' => '结算',

        'has_pending' => [
            '_' => '您有未完成的支付，点击 :link 查看。',
            'link_text' => '这里',
        ],

        'pending_checkout' => [
            'line_1' => '先前的订单未完成',
            'line_2' => '通过选择支付方式以恢复订单。',
        ],
    ],

    'discount' => '节省 :percent%',
    'free' => '免费！',

    'invoice' => [
        'contact' => '联系：',
        'date' => '日期：',
        'echeck_delay' => '由于您的支付是通过 eCheck 进行的，请再等待至多 10 天来让 PayPal 完成支付。',
        'echeck_denied' => 'Paypal 拒绝受理 eCheck 支付。',
        'hide_from_activity' => '此订单的支持者标签购买未显示在你的个人活动中。',
        'sent_via' => '通过：',
        'shipping_to' => '送货到：',
        'title' => '账单',
        'title_compact' => '账单',

        'status' => [
            'cancelled' => [
                'title' => '已取消您的订单',
                'line_1' => [
                    '_' => "如果并不是您本人取消，请联系 :link 并提供您的订单号 (#:order_number)。",
                    'link_text' => 'osu!store 支持',
                ],
            ],
            'delivered' => [
                'title' => '您的订单已经送达！享受这一刻吧！',
                'line_1' => [
                    '_' => '如果您对此次购买有任何疑问，请联系 :link。',
                    'link_text' => 'osu!store 支持',
                ],
            ],
            'prepared' => [
                'title' => '正在准备您的订单！',
                'line_1' => '在订单发货前请耐心等待。一旦订单处理完毕并发货，此处将会显示最新的运输信息。取决于我们的繁忙程度，这段时间可能会长达五天（通常不会这么久！）。',
                'line_2' => '所有订单都将从日本发出，订单会根据商品的重量和价值使用对应的物流运输业务。一旦开始发货，这里将会显示物流的细节。',
            ],
            'processing' => [
                'title' => '您的付款信息尚未确认！',
                'line_1' => '如果您已经支付，请等待我们收到支付信息，稍后再来看看吧。',
                'line_2' => [
                    '_' => '如果您在结账中遇到问题，请 :link',
                    'link_text' => '点击此处以恢复',
                ],
            ],
            'shipped' => [
                'title' => '您的订单已发货！',
                'tracking_details' => '物流信息如下：',
                'no_tracking_details' => [
                    '_' => "由于商品包裹通过航空邮件寄送，我们无法提供物流追踪信息，通常包裹预计 1 至 3 周内可送达。对于欧洲地区，清关流程可能导致包裹延误（此情况非商店可控）。如有疑问，请直接回复您收到的订单确认邮件（或通过 :link 联系）。",
                    'link_text' => '给我们发送邮件',
                ],
            ],
        ],
    ],

    'order' => [
        'cancel' => '取消订单',
        'cancel_confirm' => '您确定取消订单吗？（支付平台可能不会立即退回已支付款项或即时解冻预授权资金）',
        'cancel_not_allowed' => '目前无法取消订单。',
        'invoice' => '查看购物小票',
        'no_orders' => '没有可显示的订单。',
        'paid_on' => '订单支付于 :date',
        'resume' => '继续结算',
        'shipping_and_handling' => '运输和处理',
        'shopify_expired' => '此订单的结算链接已失效。',
        'subtotal' => '小计',
        'total' => '总计',

        'details' => [
            'order_number' => '订单 #',
            'payment_terms' => '支付条款',
            'salesperson' => '销售方',
            'shipping_method' => '运输方式',
            'shipping_terms' => '运输条款',
            'title' => '订单详情',
        ],

        'item' => [
            'quantity' => '数量',

            'display_name' => [
                'supporter_tag' => ':name 给 :username （:duration）',
            ],

            'subtext' => [
                'supporter_tag' => '留言：:message',
            ],
        ],

        'not_modifiable_exception' => [
            'cancelled' => '该订单已取消，无法进行修改。',
            'checkout' => '该订单正在处理中，无法进行修改。', // checkout and processing should have the same message.
            'default' => '订单不可修改',
            'delivered' => '该订单已签收，无法进行修改。',
            'paid' => '该订单已完成支付，无法进行修改。',
            'processing' => '该订单正在处理中，无法进行修改。',
            'shipped' => '该订单已发货，无法进行修改。',
        ],

        'status' => [
            'cancelled' => '已取消',
            'checkout' => '准备中',
            'delivered' => '已送达',
            'paid' => '已付款',
            'processing' => '待确认',
            'shipped' => '运送中',
            'title' => '订单状态',
        ],

        'thanks' => [
            'title' => '感谢惠顾！',
            'line_1' => [
                '_' => '您将收到一封确认邮件。如果您有任何疑问，请 :link！',
                'link_text' => '联系我们',
            ],
        ],
    ],

    'product' => [
        'name' => '名称',

        'stock' => [
            'out' => '卖完了呢( ´_ゝ｀) 过段时间再回来看看吧。',
            'out_with_alternative' => '选择的款式已售罄(´；ω；`) 试试另外几种款式或者过段时间再回来看看吧。',
        ],

        'add_to_cart' => '添加到购物车',
        'notify' => '当可以购买时提醒我！',
        'out_of_stock' => '售罄',

        'notification_success' => '当商品有货时会收到提醒，点击 :link 以取消该提醒',
        'notification_remove_text' => '这里',

        'notification_in_stock' => '新货到，快来买买买！',
    ],

    'supporter_tag' => [
        'gift' => '要赠与的玩家',
        'gift_message' => '给礼物留下附言吧！（可选，至多 :length 个字符）',

        'require_login' => [
            '_' => '您需要 :link 以获得 osu! 支持者标签！',
            'link_text' => '登录',
        ],
    ],

    'username_change' => [
        'check' => '输入玩家名并检查是否可用',
        'checking' => '正在检查 :username 是否可用...',
        'placeholder' => '想要使用的玩家名',
        'label' => '新玩家名',
        'current' => '您现在的玩家名是 ":username"。',

        'require_login' => [
            '_' => '需要 :link 才能改变玩家名！',
            'link_text' => '登录',
        ],
    ],

    'xsolla' => [
        'distributor' => '',
    ],
];

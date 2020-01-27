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
    'beatmapset_update_notice' => [
        'new' => '提醒您谱面 ":title" 在您上次访问之后有了新动态。',
        'subject' => '谱面“:title”有更新',
        'unwatch' => '如果您不想再关注该谱面，您可以点击之前页面或谱面关注列表中的 “取消关注” 链接：',
        'visit' => '点击此处访问讨论区',
    ],

    'common' => [
        'closing' => '祝您生活顺利',
        'hello' => '您好，:user，',
        'report' => '如果您没有进行此操作，请立刻回复此邮件！',
    ],

    'forum_new_reply' => [
        'new' => ':title 话题下又有了新的回复。',
        'subject' => '[osu!] 主题 ":title" 有新回复',
        'unwatch' => '如果您不想再关注本主题，您可以点击主题页下面的 “取消关注该主题” 链接，或者从订阅管理页面中取消订阅。',
        'visit' => '点击下面的链接跳转到最新的回复：',
    ],

    'password_reset' => [
        'code' => '您的验证码是：',
        'requested' => '您（或者他人）请求重置您 osu! 账户的密码。',
        'subject' => 'osu! 账户找回',
    ],

    'store_payment_completed' => [
        'prepare_shipping' => '我们收到了您的付款，正在准备发货。通常来说，这可能需要几天时间。发货日期取决于订单的数量。您可以在这里检查您的订单详情：',
        'processing' => '我们已收到您的付款，目前正在处理您的订单。您可以在这里关注您的订单进度：',
        'questions' => "如果您有什么问题的话，您可以直接回复这封邮件。",
        'shipping' => '配送',
        'subject' => '我们已收到你的 osu!商店 订单！',
        'thank_you' => '感谢您在 osu!store 的购买！',
        'total' => '总计',
    ],

    'supporter_gift' => [
        'anonymous_gift' => '赠予您支持者标签的人想要保持匿名，所以在这个通知中并没有提到他（们）。',
        'anonymous_gift_maybe_not' => '话虽如此，您可能已经猜到是谁了。 =w=',
        'duration' => '感谢赠送者，您可以在接下来的 :duration 内享受到 osu!direct 等 osu! 支持者所享有的特权。',
        'features' => '您可以在此处找到更多关于特权的信息：',
        'gifted' => '有人刚刚赠予您 osu!supporter 标签！',
        'subject' => '你收到了一份礼物：osu! 支持者标签。',
    ],

    'user_email_updated' => [
        'changed_to' => '您的osu账户邮箱地址已被更改为:email。',
        'check' => '请确认您修改后的新邮箱收到了此邮件，以防绑定失败造成您以后无法登录osu!账号。',
        'sent' => '为了保证账户安全，我们将此邮件发送给了您的原邮箱和修改后的邮箱地址。',
        'subject' => 'osu! 帐户邮箱更改确认',
    ],

    'user_force_reactivation' => [
        'main' => '您的账户可能已经被泄露。可能是您的账户最近出现了可疑活动，或者密码实在是太弱了。我们强烈要求您更新密码，并确保这个密码足够安全。',
        'perform_reset' => '您可以点击该链接来重置密码：:url',
        'reason' => '原因：',
        'subject' => '您需要重新激活您的 osu! 账户',
    ],

    'user_password_updated' => [
        'confirmation' => '您的osu!账户密码已被修改。',
        'subject' => 'osu! 帐户密码更改确认',
    ],

    'user_verification' => [
        'code' => '您的验证码是：',
        'code_hint' => '您可以带/不带空格地输入该验证码',
        'link' => '如果您无法完成验证，您还可以访问下面的链接来完成验证。',
        'report' => '如果您没有进行此操作，请立刻回复此邮件！您的账户信息可能遭到了泄漏。',
        'subject' => 'osu! 账户认证',

        'action_from' => [
            '_' => '您的帐号有一次来自 :country 的操作需要认证。',
            'unknown_country' => '未知国家',
        ],
    ],
];

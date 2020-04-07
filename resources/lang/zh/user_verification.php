<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'box' => [
        'sent' => '一封包含验证码的邮件已经发送到 :mail ，请输入该验证码。',
        'title' => '账户认证',
        'verifying' => '认证中',
        'issuing' => '正在生成新的验证码',

        'info' => [
            'check_spam' => "如果找不到这封邮件，请检查垃圾箱。",
            'recover' => "无法登录邮箱或者忘记了所使用的邮箱？:link.",
            'recover_link' => '点击此处',
            'reissue' => '也可以 :reissue_link 或者 :logout_link.',
            'reissue_link' => '重发验证码',
            'logout_link' => '退出',
        ],
    ],

    'errors' => [
        'expired' => '该验证码已经过期，新验证码已经重新发送。',
        'incorrect_key' => '验证码错误。',
        'retries_exceeded' => '验证码错误次数超过限定次数，新验证码已经重新发送。',
        'reissued' => '新验证码已经重新发送。',
        'unknown' => '发生了未知的错误，新验证码已经重新发送。',
    ],
];

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

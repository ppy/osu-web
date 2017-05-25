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
    'title' => '重置密码',

    'button' => [
        'cancel' => '取消',
        'resend' => '重新发送确认邮件',
        'set' => '设置密码',
        'start' => '开始',
    ],

    'email' => [
        'subject' => 'osu! 账户找回',
    ],

    'error' => [
        'contact_support' => '请联系客服以找回账户.',
        'is_privileged' => '联系 peppy.', //原文的lulz几个意思?
        'missing_key' => '必填.', //需要上下文
        'too_many_tries' => '失败尝试次数过多.',
        'user_not_found' => '请求的用户不存在.',
        'wrong_key' => '不正确的验证码.',
    ],

    'notice' => [
        'sent' => '检查您邮箱中的验证码.',
        'saved' => '新密码已经保存!',
    ],

    'started' => [
        'password' => '新密码',
        'password_confirmation' => '确认密码',
        'title' => '为 <strong>:username</strong> 重置密码.',
        'verification_key' => '验证码',
    ],

    'starting' => [
        'username' => '输入邮箱或用户名',
    ],
];

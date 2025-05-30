<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'button' => [
        'resend' => '重新发送确认邮件',
        'set' => '重设密码',
        'start' => '开始',
    ],

    'error' => [
        'contact_support' => '请联系支持团队以找回账户。',
        'expired' => '验证码已过期。',
        'invalid' => '发送验证码时出现意外错误。',
        'is_privileged' => '请联系高级管理员进行账户恢复。',
        'missing_key' => '必填',
        'too_many_tries' => '重试次数过多',
        'user_not_found' => '请求的用户不存在',
        'wrong_key' => '验证码不正确。',
    ],

    'notice' => [
        'sent' => '检查您邮箱中的验证码',
        'saved' => '密码已重设！',
    ],

    'started' => [
        'password' => '新密码',
        'password_confirmation' => '确认新密码',
        'title' => '重置 <strong>:username</strong> 的密码',
        'verification_key' => '验证码',
    ],

    'starting' => [
        'username' => '输入邮箱或用户名',

        'reason' => [
            'inactive_different_country' => "您的账户已经很长时间没有被使用。为了确保您的账户安全，请重置密码。",
        ],
        'support' => [
            '_' => '需要进一步的帮助？通过我们的 :button 联系我们。',
            'button' => '支持系统',
        ],
    ],
];

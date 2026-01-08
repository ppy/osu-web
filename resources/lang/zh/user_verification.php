<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'box' => [
        'sent' => '验证邮件已发送至 :mail ，请输入邮件中的验证码。',
        'title' => '账户验证',
        'verifying' => '验证中……',
        'issuing' => '正在生成新的验证码……',

        'info' => [
            'check_spam' => "如果未能找到邮件，请检查垃圾邮件文件夹。",
            'recover' => "无法访问或忘记了所使用的邮箱？请通过 :link 以重设绑定邮箱地址和密码。",
            'recover_link' => '点击此处',
            'reissue' => '也可以尝试 :reissue_link 或者 :logout_link。',
            'reissue_link' => '重发验证码',
            'logout_link' => '登出',
        ],
    ],

    'box_totp' => [
        'heading' => '请输入您身份验证器应用中的验证码。',

        'info' => [
            'logout' => [
                '_' => '或者您可以 :link 。',
                'link' => '登出',
            ],
            'mail_fallback' => [
                '_' => '如果您不能访问您的应用，:link。',
                'link' => '您可以使用电子邮件验证',
            ],
        ],
    ],

    'errors' => [
        'expired' => '该验证码已经过期，已重新发送新的验证邮件至绑定邮箱。',
        'incorrect_key' => '验证码错误。',
        'retries_exceeded' => '验证码错误且重试次数已达上限，已重新发送新的验证邮件至绑定邮箱。',
        'reissued' => '已重新发送新的验证邮件至绑定邮箱。',
        'totp_used_key' => '验证码已被使用。请等待并使用新的验证码。',
        'totp_gone' => '身份验证器密钥已移除，将切换到电子邮件验证。已发送验证邮件。',
        'unknown' => '发生了未知的错误，已重新发送新的验证邮件至绑定邮箱。',
    ],
];

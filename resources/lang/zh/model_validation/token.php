<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'invalid_scope' => [
        'all_scope_no_client_credentials' => '* 不允许使用客户端证书',
        'all_scope_no_mix' => '* 在其他作用域内无效',
        'client_missing_owner' => '客户端缺少所有者。',
        'client_unauthorized' => '客户端未授权。',
        'delegate_bot_only' => '只有聊天机器人可以使用包含客户端认证的委托。',
        'client_credentials_only' => '该权限范围仅对客户端凭证模式的令牌有效。',
        'delegate_invalid_combination' => '在此作用域组合下无法使用委托。',
        'delegate_required' => '需要填写委托作用域。',
        'empty' => '不包含作用域的令牌无效。',
        'bot_only' => '此作用域仅适用于聊天机器人和你自己的客户端。',
    ],
];

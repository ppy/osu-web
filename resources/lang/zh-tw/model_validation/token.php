<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'invalid_scope' => [
        'all_scope_no_client_credentials' => '* 不是允許的憑證',
        'all_scope_no_mix' => '* 不符合其他類型',
        'client_missing_owner' => '這個使用者缺乏擁有者。',
        'client_unauthorized' => '這個使用者沒有被授權。',
        'delegate_bot_only' => '委託使用者憑證只能用於聊天室機器人。',
        'delegate_client_credentials_only' => '委託範圍只能用於使用者憑證。',
        'delegate_invalid_combination' => '委託不適用於多重範圍。',
        'delegate_required' => '必須包含委託範圍。',
        'empty' => '沒有範圍的憑證碼是不合格的。',
        'bot_only' => '這個範圍僅適用於聊天室機器人或你自己的使用者。',
    ],
];

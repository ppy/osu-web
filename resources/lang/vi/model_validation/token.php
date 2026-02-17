<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'invalid_scope' => [
        'all_scope_no_client_credentials' => '* Không thể sử dụng với Client Credentials',
        'all_scope_no_mix' => '* Không hợp lệ khi dùng chung với các scope khác',
        'client_missing_owner' => 'Thiết bị này không có chủ sở hữu.',
        'client_unauthorized' => 'Client không được cấp quyền.',
        'delegate_bot_only' => 'Delegation với Client Credentials chỉ khả dụng cho chat bot.',
        'client_credentials_only' => 'Scope này chỉ hợp lệ với token client_credentials.',
        'delegate_invalid_combination' => 'Không hỗ trợ Delegation cho cách kết hợp scope này.',
        'delegate_required' => 'cần có scope delegate.',
        'empty' => 'Token không có scope là không hợp lệ.',
        'bot_only' => 'Chỉ chat bot hoặc client do bạn sở hữu mới dùng được scope này.',
    ],
];

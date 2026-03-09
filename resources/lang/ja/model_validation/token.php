<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'invalid_scope' => [
        'all_scope_no_client_credentials' => 'Client Credentialsでは * は許可されていません',
        'all_scope_no_mix' => '* は他のスコープと併用できません',
        'client_missing_owner' => 'クライアントのオーナーが見つかりません。',
        'client_unauthorized' => 'クライアントは承認されていません。',
        'delegate_bot_only' => 'クライアント資格情報を使用した委任は、チャットボットのみ利用可能です。',
        'client_credentials_only' => 'このスコープは、client_credentialsトークンに対してのみ有効です。',
        'delegate_invalid_combination' => 'このスコープの組み合わせでは、権限の委譲はサポートされていません。',
        'delegate_required' => '委任スコープが必要です。',
        'empty' => 'スコープが設定されていないトークンは無効です。',
        'bot_only' => 'このスコープは、チャットボットまたは自身で作成したクライアントでのみ利用可能です。',
    ],
];

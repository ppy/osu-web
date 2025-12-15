<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'invalid_scope' => [
        'all_scope_no_client_credentials' => '* 은 클라이언트 자격 증명에 허용되지 않아요',
        'all_scope_no_mix' => '* 은 다른 범위에 적합하지 않아요',
        'client_missing_owner' => '본 클라이언트의 소유자가 없어요.',
        'client_unauthorized' => '본 클라이언트는 승인되지 않았어요.',
        'delegate_bot_only' => '클라이언트 자격 증명 위임은 챗봇에게만 허용돼요.',
        'client_credentials_only' => '이 스코프는 client_credentials 토큰에만 유효합니다.',
        'delegate_invalid_combination' => '지금의 범위 조합에서는 위임을 지원하지 않아요.',
        'delegate_required' => '대표인 범위를 정해 주세요.',
        'empty' => '범위가 없는 토큰들은 유효하지 않아요.',
        'bot_only' => '본 범위는 오직 챗봇 또는 사용자 자신의 클라이언트로만 설정 가능해요.',
    ],
];

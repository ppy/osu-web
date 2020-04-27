<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'cancel' => '취소',

    'authorise' => [
        'request' => '는 당신의 계정에 접근할 수 있는 권한을 요청합니다.',
        'scopes_title' => '이 애플리케이션은 다음 기능을 할 수 있습니다:',
        'title' => '권한 요청',
    ],

    'authorized_clients' => [
        'confirm_revoke' => '정말로 이 클라이언트의 권한을 회수하시겠어요?',
        'scopes_title' => '이 애플리케이션이 할 수 있는 작업:',
        'owned_by' => ':user님이 소유 중',
        'none' => '클라이언트 없음',

        'revoked' => [
            'false' => '접근 권한 회수',
            'true' => '접근 권한 회수됨',
        ],
    ],

    'client' => [
        'id' => '클라이언트 ID',
        'name' => '애플리케이션 이름',
        'redirect' => '애플리케이션 Callback URL',
        'reset' => '클라이언트 Secret 재설정',
        'reset_failed' => '클라이언트 Secret을 초기화하는데 실패했습니다.',
        'secret' => '클라이언트 비밀 키',

        'secret_visible' => [
            'false' => '클라이언트 Secret 보기',
            'true' => '클라이언트 Secret 숨기기',
        ],
    ],

    'new_client' => [
        'header' => '새 OAuth 애플리케이션 등록',
        'register' => '애플리케이션 등록',
        'terms_of_use' => [
            '_' => 'API를 사용함으로써 :link에 동의하는 것으로 간주됩니다.',
            'link' => '이용약관',
        ],
    ],

    'own_clients' => [
        'confirm_delete' => '정말로 이 클라이언트를 삭제하시겠어요?',
        'confirm_reset' => '정말 클라이언트 Secret을 초기화하실 건가요? 이 작업은 존재하는 모든 토큰을 무효화시킵니다.',
        'new' => '새 OAuth 애플리케이션',
        'none' => '클라이언트 없음',

        'revoked' => [
            'false' => '삭제',
            'true' => '삭제됨',
        ],
    ],
];

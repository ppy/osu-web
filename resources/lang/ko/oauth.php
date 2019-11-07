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
    'cancel' => '취소',

    'authorise' => [
        'authorise' => '권한 부여',
        'request' => '는 당신의 계정에 접근할 수 있는 권한을 요청합니다.',
        'scopes_title' => '이 애플리케이션은 다음 기능을 할 수 있습니다:',
        'title' => '권한 요청',

        'wrong_user' => [
            '_' => ':user로 로그인되었습니다. :logout_link.',
            'logout_link' => '다른 사용자로 로그인하려면 이곳을 클릭하세요',
        ],
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
        'secret' => '클라이언트 비밀 키',
    ],

    'login' => [
        'download' => '이곳을 눌러 게임을 다운로드하고 계정을 생성하세요',
        'label' => '우선 로그인해봅시다!',
        'title' => '계정 로그인',
    ],

    'new_client' => [
        'header' => '새 OAuth 애플리케이션 등록',
        'register' => '애플리케이션 등록',
        'terms_of_use' => [
            '_' => 'API를 사용함으로써 :link을 동의하는 것으로 간주됩니다.',
            'link' => '이용약관',
        ],
    ],

    'own_clients' => [
        'confirm_delete' => '정말로 이 클라이언트를 삭제하시겠어요?',
        'new' => '새 OAuth 애플리케이션',
        'none' => '클라이언트 없음',

        'revoked' => [
            'false' => '삭제',
            'true' => '삭제됨',
        ],
    ],
];

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
    'edit' => [
        'title' => '<strong>계정</strong> 설정',
        'title_compact' => '설정',
        'username' => '사용자 이름',

        'avatar' => [
            'title' => '아바타',
        ],

        'email' => [
            'current' => '현재 이메일 주소',
            'new' => '새 이메일 주소',
            'new_confirmation' => '이메일 주소 확인',
            'title' => '이메일',
        ],

        'password' => [
            'current' => '현재 비밀번호',
            'new' => '새 비밀번호',
            'new_confirmation' => '비밀번호 확인',
            'title' => '비밀번호',
        ],

        'profile' => [
            'title' => '프로필',

            'user' => [
                'user_from' => '거주지',
                'user_interests' => '관심 분야',
                'user_msnm' => 'Skype',
                'user_occ' => '직업',
                'user_twitter' => 'Twitter',
                'user_website' => '웹사이트',
                'user_discord' => 'Discord',
            ],
        ],

        'signature' => [
            'title' => '서명',
            'update' => '적용',
        ],
    ],

    'update_email' => [
        'email_subject' => 'osu! 이메일 주소 변경 확인',
        'update' => '변경',
    ],

    'update_password' => [
        'email_subject' => 'osu! 비밀번호 변경 확인',
        'update' => '변경',
    ],

    'playstyles' => [
        'title' => '플레이 방식',
        'mouse' => '마우스',
        'keyboard' => '키보드',
        'tablet' => '태블릿',
        'touch' => '터치스크린',
    ],

    'privacy' => [
        'title' => '개인 정보',
        'friends_only' => '친구 목록에 없는 사람들이 보낸 개인 메시지를 차단하기',
        'hide_online' => '온라인 상태 숨기기',
    ],

    'security' => [
        'current_session' => '현재 세션',
        'end_session' => '세션 종료',
        'end_session_confirmation' => '이 작업은 그 장치의 세션을 즉시 종료합니다. 확실한가요?',
        'last_active' => '최근 활동:',
        'title' => '보안',
        'web_sessions' => '웹 세션',
    ],
];

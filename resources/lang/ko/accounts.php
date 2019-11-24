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
            'rules' => '당신의 아바타가 :link를 지키도록 해주십시오.<br/>이는 아바타가 <strong>모든 연령에 적합해야 한다</strong>는 것을 의미합니다. 즉, 나체, 남에게 모욕적인 표현 또는 이러한 것을 암시하는 내용이 없어야 합니다.',
            'rules_link' => '커뮤니티 규칙',
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
                'user_discord' => 'Discord',
                'user_from' => '거주지',
                'user_interests' => '관심 분야',
                'user_msnm' => 'Skype',
                'user_occ' => '직업',
                'user_twitter' => 'Twitter',
                'user_website' => '웹사이트',
            ],
        ],

        'signature' => [
            'title' => '서명',
            'update' => '적용',
        ],
    ],

    'notifications' => [
        'title' => '알림',
        'topic_auto_subscribe' => '당신이 만드는 새로운 포럼 주제에 대한 알림을 자동적으로 활성화합니다.',
        'beatmapset_discussion_qualified_problem' => '',
    ],

    'oauth' => [
        'authorized_clients' => '인증된 클라이언트',
        'own_clients' => '소유 중인 클라이언트',
        'title' => 'OAuth',
    ],

    'playstyles' => [
        'keyboard' => '키보드',
        'mouse' => '마우스',
        'tablet' => '태블릿',
        'title' => '플레이 방식',
        'touch' => '터치스크린',
    ],

    'privacy' => [
        'friends_only' => '친구 목록에 없는 사람들이 보낸 개인 메시지를 차단하기',
        'hide_online' => '온라인 상태 숨기기',
        'title' => '개인 정보',
    ],

    'security' => [
        'current_session' => '현재 세션',
        'end_session' => '세션 종료',
        'end_session_confirmation' => '이 작업은 그 장치의 세션을 즉시 종료합니다. 확실한가요?',
        'last_active' => '최근 활동:',
        'title' => '보안',
        'web_sessions' => '웹 세션',
    ],

    'update_email' => [
        'email_subject' => 'osu! 이메일 주소 변경 확인',
        'update' => '변경',
    ],

    'update_password' => [
        'email_subject' => 'osu! 비밀번호 변경 확인',
        'update' => '변경',
    ],

    'verification_completed' => [
        'text' => '이제 창을 닫으셔도 됩니다.',
        'title' => '인증이 완료되었습니다.',
    ],

    'verification_invalid' => [
        'title' => '유효하지 않거나 만료된 인증 링크입니다.',
    ],
];

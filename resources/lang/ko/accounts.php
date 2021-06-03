<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'edit' => [
        'title_compact' => '설정',
        'username' => '사용자 이름',

        'avatar' => [
            'title' => '아바타',
            'rules' => '아바타는 :link을 따라야 합니다.<br/>이는 아바타가 <strong>모든 연령에 적합해야 한다</strong>는 것을 의미하므로, 나체, 남에게 모욕적인 표현 또는 이러한 것을 암시하는 내용이 없어야 합니다.',
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
                'user_discord' => '',
                'user_from' => '거주지',
                'user_interests' => '관심 분야',
                'user_occ' => '직업',
                'user_twitter' => '',
                'user_website' => '웹사이트',
            ],
        ],

        'signature' => [
            'title' => '서명',
            'update' => '적용',
        ],
    ],

    'notifications' => [
        'beatmapset_discussion_qualified_problem' => 'Qualified 비트맵에 문제가 생길 경우 알림을 수신할 모드',
        'beatmapset_disqualify' => '비트맵이 Disqualified 처리됐을 때 알림을 수신할 모드',
        'comment_reply' => '댓글에 답글이 달리면 알림 받기',
        'title' => '알림',
        'topic_auto_subscribe' => '새로 만드는 포럼 주제에 대한 알림을 자동으로 활성화',

        'options' => [
            '_' => '수신 옵션',
            'beatmap_owner_change' => '',
            'beatmapset:modding' => '비트맵 모딩',
            'channel_message' => '개인 채팅 메시지',
            'comment_new' => '새 댓글',
            'forum_topic_reply' => '주제 답글',
            'mail' => '메일',
            'mapping' => '비트맵 제작자',
            'push' => '푸시 알림',
            'user_achievement_unlock' => '메달 획득',
        ],
    ],

    'oauth' => [
        'authorized_clients' => '인증된 클라이언트',
        'own_clients' => '소유 중인 클라이언트',
        'title' => 'OAuth',
    ],

    'options' => [
        'beatmapset_show_nsfw' => '부적절한 내용의 비트맵 경고 숨기기',
        'beatmapset_title_show_original' => '원본 언어로 비트맵 메타데이터 표시',
        'title' => '설정',

        'beatmapset_download' => [
            '_' => '기본 비트맵 다운로드 형식',
            'all' => '가능하면 영상이 있는 비트맵으로 받기',
            'direct' => 'osu!direct에서 열기',
            'no_video' => '영상이 없는 비트맵으로 받기',
        ],
    ],

    'playstyles' => [
        'keyboard' => '키보드',
        'mouse' => '마우스',
        'tablet' => '태블릿',
        'title' => '플레이 방식',
        'touch' => '터치스크린',
    ],

    'privacy' => [
        'friends_only' => '친구 목록에 없는 사람들이 보낸 개인 메시지를 차단',
        'hide_online' => '온라인 상태 숨기기',
        'title' => '개인 정보',
    ],

    'security' => [
        'current_session' => '현재 세션',
        'end_session' => '세션 종료',
        'end_session_confirmation' => '이 작업은 해당 장치의 세션을 즉시 종료합니다. 계속할까요?',
        'last_active' => '최근 활동:',
        'title' => '보안',
        'web_sessions' => '웹 세션',
    ],

    'update_email' => [
        'update' => '변경',
    ],

    'update_password' => [
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

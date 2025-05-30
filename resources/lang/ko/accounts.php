<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'edit' => [
        'title_compact' => '설정',
        'username' => '아이디',

        'avatar' => [
            'title' => '아바타',
            'reset' => '초기화',
            'rules' => '아바타가 :link을 따르고 있는지 확인해 주세요. <br/>표시되는 아바타가 <strong>모든 연령에 적합</strong>해야 해요. 예를 들어, 나체, 폭력, 또는 이를 암시하는 내용이 없어야 합니다.',
            'rules_link' => '커뮤니티 규칙',
        ],

        'email' => [
            'new' => '새 이메일 주소',
            'new_confirmation' => '이메일 주소 확인',
            'title' => '이메일',
            'locked' => [
                '_' => '이메일 변경이 필요하시다면 :accounts에 연락해 주세요.',
                'accounts' => '계정 지원 팀',
            ],
        ],

        'legacy_api' => [
            'api' => 'api',
            'irc' => 'irc',
            'title' => '레거시 API',
        ],

        'password' => [
            'current' => '현재 비밀번호',
            'new' => '새 비밀번호',
            'new_confirmation' => '비밀번호 확인',
            'title' => '비밀번호',
        ],

        'profile' => [
            'country' => '국가',
            'title' => '프로필',

            'country_change' => [
                '_' => "현재 거주 중인 국가와 계정에 설정된 국가가 틀린 것 같아요. :update_link.",
                'update_link' => ':country(으)로 변경',
            ],

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

    'github_user' => [
        'info' => "만약 osu! 오픈 소스 리포지토리의 기여자이신 경우, GitHub 계정을 연동하시면 변경 사항 항목이 osu! 프로필과 연동돼요. 기여 이력이 없는 GitHub 계정의 경우에는 osu!와 연동할 수 없어요.",
        'link' => 'GitHub 계정 연결',
        'title' => 'GitHub',
        'unlink' => 'GitHub 계정 연결 해제',

        'error' => [
            'already_linked' => '본 GitHub 계정은 이미 다른 사용자에게 연동되어 있어요.',
            'no_contribution' => 'osu! 레포지토리에 기여한 이력이 없는 GitHub 계정은 연동할 수 없어요.',
            'unverified_email' => 'GitHub에 등록된 주 이메일 인증 후, 계정을 다시 연동해 주세요.',
        ],
    ],

    'notifications' => [
        'beatmapset_discussion_qualified_problem' => 'Qualified 상태의 비트맵에 새로운 문제가 생겼을 경우 알림을 수신받을 모드',
        'beatmapset_disqualify' => '비트맵이 Disqualified 처리됐을 때 알림을 수신할 모드',
        'comment_reply' => '댓글에 답글이 달리면 알림 받기',
        'title' => '알림',
        'topic_auto_subscribe' => '생성했거나 답변을 게시한 포럼 주제에 대한 알림을 자동으로 활성화',

        'options' => [
            '_' => '수신 옵션',
            'beatmap_owner_change' => '게스트 난이도',
            'beatmapset:modding' => '비트맵 모딩',
            'channel_message' => '개인 채팅 메시지',
            'channel_team' => '',
            'comment_new' => '새 댓글',
            'forum_topic_reply' => '주제 답글',
            'mail' => '메일',
            'mapping' => '비트맵 제작자',
            'push' => '푸시 알림',
        ],
    ],

    'oauth' => [
        'authorized_clients' => '인증된 클라이언트',
        'own_clients' => '소유 중인 클라이언트',
        'title' => 'OAuth',
    ],

    'options' => [
        'beatmapset_show_nsfw' => '부적절한 내용에 대한 비트맵 경고 숨기기',
        'beatmapset_title_show_original' => '원본 언어로 비트맵 메타데이터 표시하기',
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

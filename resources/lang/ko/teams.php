<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'applications' => [
        'accept' => [
            'ok' => '유저를 팀에 추가했습니다.',
        ],
        'destroy' => [
            'ok' => '가입 요청을 취소했습니다.',
        ],
        'reject' => [
            'ok' => '가입 요청을 거부했습니다.',
        ],
        'store' => [
            'ok' => '가입을 요청하였습니다.',
        ],
    ],

    'create' => [
        'submit' => '팀 만들기',

        'form' => [
            'name_help' => '',
            'short_name_help' => '',
            'title' => "팀을 만들어 볼까요?",
        ],

        'intro' => [
            'description' => "",
            'title' => '팀!',
        ],
    ],

    'destroy' => [
        'ok' => '팀 삭제됨',
    ],

    'edit' => [
        'ok' => '설정이 저장되었습니다.',
        'title' => '팀 설정',

        'description' => [
            'label' => '설명',
            'title' => '팀 설명',
        ],

        'flag' => [
            'label' => '팀 깃발',
            'title' => '팀 깃발 설정',
        ],

        'header' => [
            'label' => '헤더 이미지',
            'title' => '헤더 이미지 설정',
        ],

        'settings' => [
            'application_help' => '사람들이 팀에 가입 요청을 보낼 수 있을지에 대한 여부',
            'default_ruleset_help' => '팀 페이지를 방문할 때 기본적으로 선택될 룰셋을 정합니다.',
            'flag_help' => '',
            'header_help' => '',
            'title' => '팀 설정',

            'application_state' => [
                'state_0' => '닫힘',
                'state_1' => '열림',
            ],
        ],
    ],

    'header_links' => [
        'edit' => '설정',
        'leaderboard' => '리더보드',
        'show' => '정보',

        'members' => [
            'index' => '팀원 관리',
        ],
    ],

    'leaderboard' => [
        'global_rank' => '세계 순위',
    ],

    'members' => [
        'destroy' => [
            'success' => '팀원이 삭제되었습니다',
        ],

        'index' => [
            'title' => '멤버 관리',

            'applications' => [
                'empty' => '현재 가입 요청이 없습니다.',
                'empty_slots' => '빈 슬롯',
                'title' => '가입 요청',
                'created_at' => '요청 일시',
            ],

            'table' => [
                'status' => '상태',
                'joined_at' => '가입일자',
                'remove' => '제거',
                'title' => '현재 멤버',
            ],

            'status' => [
                'status_0' => '비활성',
                'status_1' => '활성',
            ],
        ],
    ],

    'part' => [
        'ok' => '팀을 나갔어요 ;_;',
    ],

    'show' => [
        'bar' => [
            'chat' => '팀 채팅',
            'destroy' => '팀 해체',
            'join' => '가입 요청',
            'join_cancel' => '가입 취소',
            'part' => '팀 나가기',
        ],

        'info' => [
            'created' => '결성일',
        ],

        'members' => [
            'members' => '팀 멤버',
            'owner' => '팀장',
        ],

        'sections' => [
            'info' => '정보',
            'members' => '멤버',
        ],
    ],

    'store' => [
        'ok' => '',
    ],
];

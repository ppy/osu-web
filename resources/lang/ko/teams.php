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

    'destroy' => [
        'ok' => '팀 삭제됨',
    ],

    'edit' => [
        'saved' => '설정이 저장되었습니다',
        'title' => '팀 설정',

        'description' => [
            'label' => '설명',
            'title' => '팀 설명',
        ],

        'header' => [
            'label' => '헤더 이미지',
            'title' => '헤더 이미지 설정',
        ],

        'logo' => [
            'label' => '팀 깃발',
            'title' => '팀 깃발 설정',
        ],

        'settings' => [
            'application' => '',
            'application_help' => '사람들이 팀에 가입 요청을 보낼 수 있을지에 대한 여부',
            'default_ruleset' => '기본 룰셋',
            'default_ruleset_help' => '',
            'title' => '팀 설정',
            'url' => 'URL',

            'application_state' => [
                'state_0' => '닫힘',
                'state_1' => '열림',
            ],
        ],
    ],

    'header_links' => [
        'edit' => '설정',
        'leaderboard' => '리더보드',
        'show' => '',

        'members' => [
            'index' => '팀원 관리',
        ],
    ],

    'leaderboard' => [
        'global_rank' => '세계 순위',
        'performance' => '퍼포먼스 점수',
        'total_score' => '총 점수',
    ],

    'members' => [
        'destroy' => [
            'success' => '팀원이 삭제되었습니다',
        ],

        'index' => [
            'title' => '멤버 관리',

            'applications' => [
                'empty' => '',
                'empty_slots' => '',
                'title' => '',
                'created_at' => '',
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
        'ok' => '',
    ],

    'show' => [
        'bar' => [
            'destroy' => '',
            'join' => '',
            'join_cancel' => '',
            'part' => '',
        ],

        'info' => [
            'created' => '결성일',
            'website' => '웹사이트',
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
];

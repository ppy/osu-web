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

    'card' => [
        'members' => ':count_delimited명의 회원',
    ],

    'create' => [
        'submit' => '팀 만들기',

        'form' => [
            'name_help' => '당신의 팀 이름입니다. 아직까지는 이름을 변경할 수 없어요.',
            'short_name_help' => '최대 4자.',
            'title' => "팀을 만들어 볼까요?",
        ],

        'intro' => [
            'description' => "현재 팀에 속해 있지 않습니다. 팀에 참가하거나 새로 만들어 친구와 함께 플레이해 보세요. 팀 페이지에 방문하여 팀에 가입하거나 이 페이지에서 팀을 새로 만들 수 있습니다.",
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
            'flag_help' => '최대 :widthx:height',
            'header_help' => '최대 :widthx:height',
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
                'accept_confirm' => '유저 :user 님을 팀에 추가할까요?',
                'created_at' => '요청 일시',
                'empty' => '현재 가입 요청이 없습니다.',
                'empty_slots' => '빈 슬롯',
                'empty_slots_overflow' => ':count_delimited 명 초과|:count_delimited 명 초과',
                'reject_confirm' => ':user 님의 참가 신청을 거절할까요?',
                'title' => '가입 요청',
            ],

            'table' => [
                'joined_at' => '가입일자',
                'remove' => '제거',
                'remove_confirm' => ':user 님을 팀으로부터 추방할까요?',
                'set_leader' => '팀 대표 이관',
                'set_leader_confirm' => ':user 님에게 팀 대표 자격을 이관할까요?',
                'status' => '상태',
                'title' => '현재 멤버',
            ],

            'status' => [
                'status_0' => '비활성',
                'status_1' => '활성',
            ],
        ],

        'set_leader' => [
            'success' => ':user 님이 팀의 리더가 되었어요.',
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
            'about' => '소개',
            'info' => '정보',
            'members' => '멤버',
        ],

        'statistics' => [
            'rank' => '순위',
            'leader' => '팀장',
        ],
    ],

    'store' => [
        'ok' => '팀이 만들어졌습니다.',
    ],
];

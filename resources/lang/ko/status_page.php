<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'header' => [
        'title' => '상태',
        'description' => '뭔 일이 일어나고 있는거지?',
    ],

    'incidents' => [
        'title' => '진행중인 문제',
        'automated' => '자동',
    ],

    'online' => [
        'title' => [
            'users' => '지난 24시간 동안 접속자 수',
            'score' => '지난 24시간 동안 점수 제출 횟수',
        ],
        'current' => '현재 접속자',
        'score' => '초당 점수 제출 횟수',
    ],

    'recent' => [
        'incidents' => [
            'title' => '최근 사건',
            'state' => [
                'resolved' => '해결됨',
                'resolving' => '해결 중',
                'unknown' => '알 수 없음',
            ],
        ],

        'uptime' => [
            'title' => '가동 시간',
            'graphs' => [
                'server' => '게임 서버',
                'web' => '웹 서버',
            ],
        ],

        'when' => [
            'today' => '오늘',
            'week' => '이번 주',
            'month' => '이번 달',
            'all_time' => '항상',
            'last_week' => '저번 주',
            'weeks_ago' => ':count주 전',
        ],
    ],
];

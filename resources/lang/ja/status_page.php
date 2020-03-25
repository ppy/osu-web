<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'header' => [
        'title' => 'ステータス',
        'description' => '最近どう？',
    ],

    'incidents' => [
        'title' => '進行中の問題',
        'automated' => '自動',
    ],

    'online' => [
        'title' => [
            'users' => '過去24時間のオンラインユーザー',
            'score' => '過去24時間のスコア提出',
        ],
        'current' => '現在のオンラインユーザー',
        'score' => '秒間のスコア提出',
    ],

    'recent' => [
        'incidents' => [
            'title' => '最近の問題',
            'state' => [
                'resolved' => '解決済み',
                'resolving' => '解決中',
                'unknown' => '不明',
            ],
        ],

        'uptime' => [
            'title' => '稼働時間',
            'graphs' => [
                'server' => 'サーバー',
                'web' => 'ウェブ',
            ],
        ],

        'when' => [
            'today' => '今日',
            'week' => '今週',
            'month' => '今月',
            'all_time' => '全期間',
            'last_week' => '先週',
            'weeks_ago' => ':count_delimited 週間前',
        ],
    ],
];

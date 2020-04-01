<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'header' => [
        'title' => '狀態',
        'description' => '發生了什麼？',
    ],

    'incidents' => [
        'title' => '活動事件',
        'automated' => '自動',
    ],

    'online' => [
        'title' => [
            'users' => '最近24小時內在線的使用者',
            'score' => '最近 24 小時內上傳的分數',
        ],
        'current' => '目前在線的使用者',
        'score' => '每秒提交的分數',
    ],

    'recent' => [
        'incidents' => [
            'title' => '最近事件',
            'state' => [
                'resolved' => '已解決',
                'resolving' => '解決中',
                'unknown' => '未知',
            ],
        ],

        'uptime' => [
            'title' => '在線時間',
            'graphs' => [
                'server' => '伺服器',
                'web' => '網頁',
            ],
        ],

        'when' => [
            'today' => '今日',
            'week' => '本週',
            'month' => '本月',
            'all_time' => '所有時間',
            'last_week' => '上週',
            'weeks_ago' => ':count_delimited 周前|:count_delimited 幾週前',
        ],
    ],
];

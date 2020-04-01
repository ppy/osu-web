<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'header' => [
        'title' => '状态',
        'description' => '发生了什么？',
    ],

    'incidents' => [
        'title' => '活动事件',
        'automated' => '自动',
    ],

    'online' => [
        'title' => [
            'users' => '最近 24 小时的在线用户',
            'score' => '最近 24 小时的分数上传',
        ],
        'current' => '当前在线用户',
        'score' => '每秒提交分数',
    ],

    'recent' => [
        'incidents' => [
            'title' => '最近事件',
            'state' => [
                'resolved' => '已解决',
                'resolving' => '解决中',
                'unknown' => '未知',
            ],
        ],

        'uptime' => [
            'title' => '运行时间',
            'graphs' => [
                'server' => '服务器',
                'web' => '网页',
            ],
        ],

        'when' => [
            'today' => '今日',
            'week' => '本周',
            'month' => '本月',
            'all_time' => '所有时间',
            'last_week' => '上周',
            'weeks_ago' => ':count 周前',
        ],
    ],
];

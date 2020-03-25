<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'header' => [
        'title' => 'trạng thái',
        'description' => 'whats going on mah dude?',
    ],

    'incidents' => [
        'title' => 'Sự Cố Đang Diễn Ra',
        'automated' => 'tự động',
    ],

    'online' => [
        'title' => [
            'users' => 'Người Dùng Online trong 24 giờ qua',
            'score' => 'Số Điểm Được Gửi trong 24 giờ qua',
        ],
        'current' => 'Người Dùng Online Hiện Tại',
        'score' => 'Số Điểm Được Gửi mỗi Giây',
    ],

    'recent' => [
        'incidents' => [
            'title' => 'Sự Cố Gần Đây',
            'state' => [
                'resolved' => 'Đã giải quyết',
                'resolving' => 'Đang giải quyết',
                'unknown' => 'Không xác định',
            ],
        ],

        'uptime' => [
            'title' => 'Thời Gian Hoạt Động',
            'graphs' => [
                'server' => 'server',
                'web' => 'web',
            ],
        ],

        'when' => [
            'today' => 'hôm nay',
            'week' => 'tuần',
            'month' => 'tháng',
            'all_time' => 'mọi lúc',
            'last_week' => 'tuần trước',
            'weeks_ago' => ':count tuần trước',
        ],
    ],
];

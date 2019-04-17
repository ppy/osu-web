<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
 *
 *    This file is part of osu!web. osu!web is distributed with the hope of
 *    attracting more community contributions to the core ecosystem of osu!.
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License version 3
 *    as published by the Free Software Foundation.
 *
 *    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
 *    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *    See the GNU Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public License
 *    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
 */

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

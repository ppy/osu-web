<?php

/**
 *    Copyright 2015-2017 ppy Pty. Ltd.
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
        'title' => '狀態',
        'description' => '發生了什麼？',
    ],

    'incidents' => [
        'title' => '活動事件',
        'automated' => '自動',
    ],

    'online' => [
        'title' => [
            'users' => '最近 24 小時的在線用戶',
            'score' => '最近 24 小時的分數上傳',
        ],
        'current' => '當前在線用戶',
        'score' => '每秒提交分數',
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
            'title' => '運行時間',
            'graphs' => [
                'server' => '服務器',
                'web' => '網頁',
            ],
        ],

        'when' => [
            'today' => '今日',
            'week' => '本週',
            'month' => '本月',
            'all_time' => '所有時間',
            'last_week' => '上週',
            'weeks_ago' => ':count 周前',
        ],
    ],
];

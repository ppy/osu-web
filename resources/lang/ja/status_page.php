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
            'weeks_ago' => ':count週間前',
        ],
    ],
];

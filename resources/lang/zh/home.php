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
    'landing' => [
        'slogans' => [//这两句保持原文可能比较好
            '1' => 'free-to-win<br/>circle simulator',
            '2' => 'rhythm is just<br/> a click away',
        ],

        'download' => [
            '_' => '下载',
            'for' => ':os版',
            'other' => '点击这里下载 :os1 或 :os2 版',
        ],

        'players' => '<strong>:count</strong> 注册玩家',
        'online' => '<strong>:players</strong> 玩家在 <strong>:games</strong> 场游戏中',
        'peak' => '最高在线人数 :count 人',
    ],
    'user' => [
        'title' => '新闻',
        'news' => [
            'title' => '新闻',
            'error' => '加载新闻失败,试试刷新一下?...',
        ],
        'header' => [
            'welcome' => '欢迎,<strong>:username</strong>!',
            'messages' => '你有 1 条新消息|你有 :count 条新消息',
            'stats' => [
                'online' => '在线玩家',
            ],
        ],
        'beatmaps' => [
            'new' => '新 Approved 的谱面', //mapping相关,暂时不译
            'popular' => '最受欢迎的谱面',
        ],
        'buttons' => [
            'download' => '下载 osu!',
            'support' => '支持 osu!',
            'store' => 'osu!商店',
        ],
    ],
];

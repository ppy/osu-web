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
        'download' => '下载',
        'online' => '<strong>:players</strong> 名在线玩家, <strong>:games</strong> 个游戏房间',
        'peak' => '最高在线人数 :count 人',
        'players' => '<strong>:count</strong> 名已注册玩家',

        'slogan' => [
            'main' => '免费音乐游戏',
            'sub' => '节奏跃然指上',
        ],
    ],

    'search' => [
        'advanced_link' => '高级搜索',
        'button' => '搜索',
        'empty_result' => '没有结果！',
        'missing_query' => '搜索内容不少于 :n 个字符',
        'title' => '搜索结果',

        'beatmapset' => [
            'more' => '搜索到 :count 张谱面',
            'more_simple' => '查看更多搜索结果',
            'title' => '谱面',
        ],

        'forum_post' => [
            'all' => '所有论坛',
            'link' => '在论坛中搜索',
            'more_simple' => '查看更多搜索结果',
            'title' => '论坛',

            'label' => [
                'forum' => '在论坛中搜索',
                'forum_children' => '包括子版块',
                'topic_id' => '主题 #',
                'username' => '作者',
            ],
        ],

        'mode' => [
            'all' => '所有',
            'beatmapset' => '谱面',
            'forum_post' => '论坛',
            'user' => '玩家',
            'wiki_page' => 'wiki',
        ],

        'user' => [
            'more' => '搜索到 :count 个玩家',
            'more_simple' => '查看更多搜索结果',
            'more_hidden' => '玩家搜索超出 :max 个限制，请修改搜索内容。',
            'title' => '玩家',
        ],

        'wiki_page' => [
            'link' => '在 Wiki 中搜索',
            'more_simple' => '查看更多搜索结果',
            'title' => 'Wiki',
        ],
    ],

    'download' => [
        'tagline' => '让我们<br>开始吧！',
        'action' => '下载 osu!',
        'os' => [
            'windows' => 'Windows 版',
            'macos' => 'macOS 版',
            'linux' => 'Linux 版',
        ],
        'mirror' => '镜像',
        'macos-fallback' => 'macOS 用户',
        'steps' => [
            'register' => [
                'title' => '注册帐号',
                'description' => '根据游戏提示进行登录或注册',
            ],
            'download' => [
                'title' => '下载游戏',
                'description' => '点击上面的按钮下载安装器，然后运行它！',
            ],
            'beatmaps' => [
                'title' => '下载谱面',
                'description' => [
                    '_' => ':browse 玩家们创造的谱面然后开始游戏吧！',
                    'browse' => '浏览',
                ],
            ],
        ],
        'video-guide' => '视频教程',
    ],

    'user' => [
        'news' => [
            'title' => '新闻',
            'error' => '载入新闻失败，刷新页面试试看？...',
        ],
        'header' => [
            'welcome' => '哈喽，<strong>:username</strong>！',
            'messages' => '你有 :count 条新消息|{0}',
            'stats' => [
                'friends' => '在线好友',
                'games' => '房间',
                'online' => '在线用户',
            ],
        ],
        'beatmaps' => [
            'new' => '新 Approved 谱面',
            'popular' => '高人气谱面',
            'by' => '作者：',
            'plays' => ':count 次游玩',
        ],
        'buttons' => [
            'download' => '下载 osu!',
            'support' => '支持 osu!',
            'store' => 'osu! 商店',
        ],
    ],

    'support-osu' => [
        'title' => '喔！',
        'subtitle' => '看起来你玩得很开心！',
        'body' => [
            'part-1' => '你知道吗？ osu! 是一款没有广告，完全依赖玩家支持以维持开发及运营的游戏。',
            'part-2' => '如果你选择给 osu! 捐赠，就可以解锁额外的功能，例如<strong>游戏内自动下载</strong>。',
        ],
        'find-out-more' => '点击这里以了解更多',
        'download-starting' => '对了，别担心 - 下载已经开始了 ;)',
    ],
];

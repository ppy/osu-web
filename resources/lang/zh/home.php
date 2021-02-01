<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'landing' => [
        'download' => '立即下载',
        'online' => '<strong>:players</strong> 名在线玩家，<strong>:games</strong> 个游戏房间',
        'peak' => '最高在线人数 :count 人',
        'players' => '<strong>:count</strong> 名已注册玩家',
        'title' => '欢迎',
        'see_more_news' => '查看更多新闻',

        'slogan' => [
            'main' => '棒到不行的免费音乐游戏',
            'sub' => '节奏跃然指上',
        ],
    ],

    'search' => [
        'advanced_link' => '高级搜索',
        'button' => '搜索',
        'empty_result' => '没有结果！',
        'keyword_required' => '需要关键字',
        'placeholder' => '输入以搜索',
        'title' => '搜索',

        'beatmapset' => [
            'login_required' => '登录以搜索谱面',
            'more' => '搜索到 :count 张谱面',
            'more_simple' => '查看更多搜索结果',
            'title' => '谱面',
        ],

        'forum_post' => [
            'all' => '所有论坛',
            'link' => '在论坛中搜索',
            'login_required' => '登录以搜索论坛帖',
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
            'login_required' => '登录以搜索玩家',
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
        'tagline' => "让我们<br>开始吧！",
        'action' => '下载 osu!',

        'help' => [
            '_' => '如果您在开始游戏或注册帐户时遇到问题，请 :help_forum_link 或 :support_button。',
            'help_forum_link' => '查看帮助论坛',
            'support_button' => '联系支持团队',
        ],

        'os' => [
            'windows' => 'Windows 版',
            'macos' => 'macOS 版',
            'linux' => 'Linux 版',
        ],
        'mirror' => '从镜像服务器下载',
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
        'title' => '总览',
        'news' => [
            'title' => '新闻',
            'error' => '载入新闻失败，刷新页面试试看？...',
        ],
        'header' => [
            'stats' => [
                'friends' => '在线好友',
                'games' => '房间',
                'online' => '在线用户',
            ],
        ],
        'beatmaps' => [
            'new' => '新 Ranked 谱面',
            'popular' => '高人气谱面',
            'by_user' => '作者：:user',
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
        'download-starting' => "对了，别担心 - 下载已经开始了 ;)",
    ],
];

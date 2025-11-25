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

        'artist_track' => [
            'more_simple' => '查看更多精选艺术家曲目搜索结果',
        ],
        'beatmapset' => [
            'login_required' => '登录以搜索谱面',
            'more' => '搜索到 :count 张谱面',
            'more_simple' => '查看更多谱面搜索结果',
            'title' => '谱面',
        ],

        'forum_post' => [
            'all' => '所有论坛',
            'link' => '在论坛中搜索',
            'login_required' => '登录以搜索论坛帖',
            'more_simple' => '查看更多论坛搜索结果',
            'title' => '论坛',

            'label' => [
                'forum' => '在论坛中搜索',
                'forum_children' => '包括子版块',
                'include_deleted' => '包括已删除的帖子',
                'topic_id' => '主题 #',
                'username' => '作者',
            ],
        ],

        'mode' => [
            'all' => '所有',
            'artist_track' => '精选艺术家曲目',
            'beatmapset' => '谱面',
            'forum_post' => '论坛',
            'team' => '战队',
            'user' => '玩家',
            'wiki_page' => 'wiki',
        ],

        'team' => [
            'more_simple' => '查看更多战队搜索结果',
        ],

        'user' => [
            'login_required' => '登录以搜索玩家',
            'more' => '搜索到 :count 个玩家',
            'more_simple' => '查看更多玩家搜索结果',
            'more_hidden' => '玩家搜索结果上限为 :max 个，请优化搜索条件以获取更精准结果。',
            'title' => '玩家',
        ],

        'wiki_page' => [
            'link' => '在 wiki 中搜索',
            'more_simple' => '查看更多维基搜索结果',
            'title' => 'Wiki',
        ],
    ],

    'download' => [
        'action_lazer_info' => '更多详情请查阅本页面',
        'download' => '',
        'for_os' => '适用于 :os',
        'macos-fallback' => 'macOS 用户',
        'mirror' => '从镜像服务器下载',
        'or' => '或',
        'os_version_or_later' => ':os_version 或更高版本',
        'other_os' => '其他平台',
        'quick_start_guide' => '快速入门指南',
        'stable_text' => '',
        'tagline_1' => '',
        'tagline_2' => '',
        'video-guide' => '视频教程',

        'help' => [
            '_' => '如果您在启动游戏或注册账户时遇到问题，请 :help_forum_link 或 :support_button。',
            'help_forum_link' => '查看论坛帮助板块',
            'support_button' => '联系支持团队',
        ],

        'os' => [
            'windows' => '适用于 Windows',
            'macos' => '适用于 macOS',
            'linux' => '适用于 Linux',
        ],
        'steps' => [
            'register' => [
                'title' => '注册账号',
                'description' => '根据游戏提示登录或注册',
            ],
            'download' => [
                'title' => '安装游戏',
                'description' => '点击上方按钮下载安装程序，双击文件开启节奏宇宙！',
            ],
            'beatmaps' => [
                'title' => '下载谱面',
                'description' => [
                    '_' => ':browse 玩家们创造的谱面然后开始你的节奏之旅吧！',
                    'browse' => '浏览',
                ],
            ],
        ],
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
            'daily_challenge' => '每日挑战谱面',
            'new' => '新上架 (Ranked) 谱面',
            'popular' => '热门谱面',
            'by_user' => '作者：:user',
            'resets' => ':ends 重置',
        ],
        'buttons' => [
            'download' => '下载 osu!',
            'support' => '支持 osu!',
            'store' => 'osu! 商店',
        ],
        'show' => [
            'admin' => [
                'page' => '打开管理控制台',
            ],
        ],
    ],
];

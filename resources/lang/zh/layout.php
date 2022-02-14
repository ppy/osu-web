<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'audio' => [
        'autoplay' => '自动播放下一曲目',
    ],

    'defaults' => [
        'page_description' => 'osu! - 节奏跃然指上！内含来自「押忍！战斗应援团」、「精英节拍特工」、太鼓的以及 osu! 原创的游戏模式，以及为其设计的全功能谱面编辑器。',
    ],

    'header' => [
        'admin' => [
            'beatmapset' => '谱面集',
            'beatmapset_covers' => '谱面集封面',
            'contest' => '竞赛',
            'contests' => '竞赛',
            'root' => '控制中心',
        ],

        'artists' => [
            'index' => '列表',
        ],

        'changelog' => [
            'index' => '列表',
        ],

        'help' => [
            'index' => '主页',
            'sitemap' => '站点地图',
        ],

        'store' => [
            'cart' => '购物车',
            'orders' => '历史订单',
            'products' => '商品',
        ],

        'tournaments' => [
            'index' => '列表',
        ],

        'users' => [
            'modding' => '摸图',
            'playlists' => '歌单',
            'realtime' => '多人游戏',
            'show' => '信息',
        ],
    ],

    'gallery' => [
        'close' => '关闭（ESC）',
        'fullscreen' => '切换全屏',
        'zoom' => '放大/缩小',
        'previous' => '前一个（左箭头）',
        'next' => '后一个（右箭头）',
    ],

    'menu' => [
        'beatmaps' => [
            '_' => '谱面',
        ],
        'community' => [
            '_' => '社区',
            'dev' => '开发',
        ],
        'help' => [
            '_' => '帮助',
            'getAbuse' => '报告不当行为',
            'getFaq' => '常见问题',
            'getRules' => '规章制度',
            'getSupport' => '帮助中心',
        ],
        'home' => [
            '_' => '主页',
            'team' => '团队',
        ],
        'rankings' => [
            '_' => '排名',
            'kudosu' => 'kudosu',
        ],
        'store' => [
            '_' => '商店',
        ],
    ],

    'footer' => [
        'general' => [
            '_' => '常用',
            'home' => '主页',
            'changelog-index' => '更新日志',
            'beatmaps' => '谱面列表',
            'download' => '下载 osu!',
        ],
        'help' => [
            '_' => '帮助 & 社区',
            'faq' => '常见问题',
            'forum' => '论坛',
            'livestreams' => '直播',
            'report' => '报告问题',
            'wiki' => '维基',
        ],
        'legal' => [
            '_' => '法律 & 状态',
            'copyright' => '版权（DMCA）',
            'privacy' => '隐私政策',
            'server_status' => '服务器状态',
            'source_code' => '源代码',
            'terms' => '服务条款',
        ],
    ],

    'errors' => [
        '400' => [
            'error' => '请求参数无效',
            'description' => '',
        ],
        '404' => [
            'error' => '无法找到网页',
            'description' => "抱歉，您正在尝试访问的页面不存在！",
        ],
        '403' => [
            'error' => "这里不是你该来的地方。",
            'description' => '不过，你可以选择往回走。',
        ],
        '401' => [
            'error' => "这里不是你该来的地方。",
            'description' => '不过，你可以选择往回走。或者试试登录？',
        ],
        '405' => [
            'error' => '无法找到网页',
            'description' => "抱歉，您正在尝试访问的页面不存在！",
        ],
        '422' => [
            'error' => '请求参数无效',
            'description' => '',
        ],
        '429' => [
            'error' => '超出速率限制',
            'description' => '',
        ],
        '500' => [
            'error' => '哎呀，服务器崩溃了！;_;',
            'description' => "服务器一旦出错，我们都会收到通知。请返回到上一个页面。",
        ],
        'fatal' => [
            'error' => '哎呀，服务器被外星人带走了！;_;',
            'description' => "服务器一旦出错，我们都会收到通知。请返回到上一个页面。",
        ],
        '503' => [
            'error' => '服务器维护中！',
            'description' => "一般情况下，维护工作只需要 5 秒到 10 分钟的时间。如果服务器一直处于维护状态，请查看 :link 以获得更多信息。",
            'link' => [
                'text' => '',
                'href' => '',
            ],
        ],
        // used by sentry if it returns an error
        'reference' => "如果需要的话，请把这里的代码发送给支持团队！",
    ],

    'popup_login' => [
        'button' => '登录/注册',

        'login' => [
            'forgot' => "我忘记了我的登录信息",
            'password' => '密码',
            'title' => '登录以继续',
            'username' => '用户名',

            'error' => [
                'email' => "用户名或邮箱不存在",
                'password' => '密码错误',
            ],
        ],

        'register' => [
            'download' => '下载',
            'info' => '立刻下载 osu! 并且注册帐号吧！',
            'title' => "没有账号？",
        ],
    ],

    'popup_user' => [
        'links' => [
            'account-edit' => '设置',
            'follows' => '订阅',
            'friends' => '好友',
            'logout' => '登出',
            'profile' => '资料',
        ],
    ],

    'popup_search' => [
        'initial' => '输入以搜索！',
        'retry' => '搜索失败。点此重试。',
    ],
];

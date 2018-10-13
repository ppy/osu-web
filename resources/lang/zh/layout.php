<?php

/**
 *    Copyright 2015-2018 ppy Pty. Ltd.
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
    'defaults' => [
        'page_description' => 'osu! - 节奏跃然指上！内含来自「押忍！战斗应援团」、「精英节拍特工」、太鼓的以及 osu! 原创的游戏模式，以及为其设计的全功能谱面编辑器。',
    ],

    'menu' => [
        'home' => [
            '_' => '主页',
            'account-edit' => '设置',
            'friends-index' => '好友',
            'changelog-index' => '更新日志',
            'changelog-build' => '版本',
            'getDownload' => '下载',
            'getIcons' => '图标',
            'groups-show' => '用户组',
            'index' => '看板',
            'legal-show' => '信息',
            'news-index' => '新闻',
            'news-show' => '新闻',
            'password-reset-index' => '重置密码',
            'search' => '搜索',
            'supportTheGame' => '支持 osu!',
            'team' => '团队',
        ],
        'help' => [
            '_' => '帮助',
            'getFaq' => '常见问题',
            'getRules' => '规章制度',
            'getSupport' => '帮助中心',
            'getWiki' => 'wiki',
            'wiki-show' => 'wiki',
        ],
        'beatmaps' => [
            '_' => '谱面',
            'artists' => '精选艺术家',
            'beatmap_discussion_posts-index' => '谱面讨论帖',
            'beatmap_discussions-index' => '谱面讨论',
            'beatmapset-watches-index' => '谱面关注列表',
            'beatmapset_discussion_votes-index' => '谱面讨论投票',
            'beatmapset_events-index' => '谱面事件',
            'index' => '列表',
            'packs' => '曲包',
            'show' => '信息',
        ],
        'beatmapsets' => [
            '_' => '谱面',
            'discussion' => '修改',
        ],
        'rankings' => [
            '_' => '排名',
            'index' => '表现',
            'performance' => '表现',
            'charts' => '月赛',
            'score' => '得分',
            'country' => '国家',
            'kudosu' => 'kudosu',
        ],
        'community' => [
            '_' => '社区',
            'dev' => '开发',
            'getForum' => '论坛',
            'getChat' => '聊天',
            'getLive' => '直播',
            'contests' => '评选',
            'profile' => '个人资料',
            'tournaments' => '官方比赛',
            'tournaments-index' => '官方比赛',
            'tournaments-show' => '官方比赛信息',
            'forum-topic-watches-index' => '订阅',
            'forum-topics-create' => '论坛',
            'forum-topics-show' => '论坛',
            'forum-forums-index' => '论坛',
            'forum-forums-show' => '论坛',
        ],
        'multiplayer' => [
            '_' => '多人游戏',
            'show' => '比赛',
        ],
        'error' => [
            '_' => '错误',
            '404' => '无法找到网页',
            '403' => '拒绝访问',
            '401' => '权限不足',
            '405' => '资源被禁止',
            '500' => '内部错误',
            '503' => '维护中',
        ],
        'user' => [
            '_' => '用户',
            'getLogin' => '登录',
            'disabled' => '禁用',

            'register' => '注册',
            'reset' => '重置',
            'new' => '新增',

            'messages' => '信息',
            'settings' => '设置',
            'logout' => '退出',
            'help' => '帮助',
            'modding-history-discussions' => '用户摸图讨论',
            'modding-history-events' => '用户摸图事件',
            'modding-history-index' => '用户摸图历史',
            'modding-history-posts' => '用户摸图帖',
            'modding-history-votesGiven' => '用户摸图投票数',
            'modding-history-votesReceived' => '用户摸图获得票数',
        ],
        'store' => [
            '_' => '商店',
            'checkout-show' => '结账',
            'getListing' => '列表',
            'cart-show' => '购物车',

            'getCheckout' => '结账',
            'getInvoice' => '发票',
            'products-show' => '商品',

            'new' => '新增',
            'home' => '首页',
            'index' => '主页',
            'thanks' => '感谢',
        ],
        'admin-forum' => [
            '_' => '',
            'forum-covers-index' => '论坛封面',
        ],
        'admin-store' => [
            '_' => '',
            'orders-index' => '订单',
            'orders-show' => '订单',
        ],
        'admin' => [
            '_' => '管理',
            'beatmapsets-covers' => '谱面封面',
            'logs-index' => '日志',
            'root' => '主页',

            'beatmapsets' => [
                '_' => '谱面',
                'show' => '详细',
            ],
        ],
    ],

    'footer' => [
        'general' => [
            '_' => '常用',
            'home' => '主页',
            'changelog-index' => '更新日志',
            'beatmaps' => '谱面列表',
            'download' => '下载 osu!',
            'wiki' => 'Wiki',
        ],
        'help' => [
            '_' => '帮助 & 社区',
            'faq' => '常见问题',
            'forum' => '论坛',
            'livestreams' => '直播',
            'report' => '报告问题',
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
                'text' => '@osustatus',
                'href' => 'https://twitter.com/osustatus',
            ],
        ],
        // used by sentry if it returns an error
        'reference' => "如果需要的话，请把这里的代码发送给支持团队！",
    ],

    'popup_login' => [
        'login' => [
            'email' => '用户名/邮箱',
            'forgot' => "我忘记了我的登录信息",
            'password' => '密码',
            'title' => '登录以继续',

            'error' => [
                'email' => "用户名或邮箱不存在",
                'password' => '密码错误',
            ],
        ],

        'register' => [
            'info' => "点击下方的注册按钮以成为 osu! 大家庭中的一员！",
            'title' => "没有账号？",
        ],
    ],

    'popup_user' => [
        'links' => [
            'account-edit' => '设置',
            'friends' => '好友',
            'logout' => '退出',
            'profile' => '我的资料',
        ],
    ],

    'popup_search' => [
        'initial' => '键入以搜索！',
        'retry' => '搜索失败。点此重试。',
    ],
];

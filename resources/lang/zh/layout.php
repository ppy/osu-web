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
    'defaults' => [ //TODO 好长,之后再翻译吧
        'page_description' => 'osu! - Rhythm is just a *click* away!  With Ouendan/EBA, Taiko and original gameplay modes, as well as a fully functional level editor.',
    ],

    'menu' => [
        'home' => [
            '_' => '主页',
            'account-edit' => '设置',
            'friends-index' => '好友',
            'changelog-index' => '更新日志',
            'changelog-show' => '版本',
            'getDownload' => '下载',
            'getIcons' => '图标',
            'groups-show' => '用户组',
            'legal-show' => '信息',
            'news-index' => '新闻',
            'news-show' => '新闻',
            'password-reset-index' => '重置密码',
            'search' => '搜索',
            'supportTheGame' => '支持 osu!',
        ],
        'help' => [
            '_' => '帮助',
            'getFaq' => '常见问题',
            'getSupport' => '获取帮助', //obsolete
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
            'dev' => 'osu! 开发',
            'getForum' => '论坛', // Base text changed to plural, please check.
            'getChat' => '聊天',
            'getLive' => '直播',
            'contests' => '评选',
            'profile' => '个人资料',
            'tournaments' => '官方比赛',
            'tournaments-index' => '官方比赛',
            'tournaments-show' => '官方比赛信息',
            'forum-topic-watches-index' => '订阅',
            'forum-topics-create' => '论坛', // Base text changed to plural, please check.
            'forum-topics-show' => '论坛', // Base text changed to plural, please check.
            'forum-forums-index' => '论坛', // Base text changed to plural, please check.
            'forum-forums-show' => '论坛', // Base text changed to plural, please check.
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
            'new' => 'new', //TODO 需要上下文

            'messages' => '信息',
            'settings' => '设置',
            'logout' => '退出', // Base text changed from "Log Out" to "Sign Out", please check.
            'help' => '帮助',
            'beatmapset_activities' => '玩家谱面活动', //需要上下文
        ],
        'store' => [
            '_' => '商店',
            'checkout-show' => '结账',
            'getListing' => '列表',
            'cart-show' => '购物车',

            'getCheckout' => '结账',
            'getInvoice' => '发票',
            'products-show' => '商品',

            'new' => 'new', //TODO 需要上下文
            'home' => 'home', //TODO 需要上下文
            'index' => 'home', //TODO 需要上下文
            'thanks' => '感谢',
        ],
        'admin-forum' => [
            '_' => 'admin::forum', //TODO 需要上下文
            'forum-covers-index' => '论坛封面',
        ],
        'admin-store' => [
            '_' => 'admin::store', //TODO 需要上下文
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
            '_' => '网站地图',
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
        'support' => [
            '_' => '支持 osu!',
            'tags' => '成为支持者',
            'merchandise' => '商店',
        ],
        'legal' => [
            '_' => '法律 & 状态',
            'copyright' => '版权（DMCA）',
            'osu_status' => '@osustatus',
            'server_status' => '服务器状态',
            'terms' => '服务条款',
        ],
    ],

    'errors' => [
        '404' => [
            'error' => '无法找到网页',
            'description' => '很抱歉，您访问的页面不存在...请返回到上一个页面',
            'link' => false,
        ],
        '403' => [
            'error' => '没有权限',
            'description' => '没有权限访问该页面，建议检查一下再试，或者返回到上一个页面',
            'link' => false,
        ],
        '401' => [
            'error' => '没有权限',
            'description' => '没有权限访问该页面，建议检查一下再试，或者返回到上一个页面（说不定因为没登录）',
            'link' => false,
        ],
        '405' => [
            'error' => '无法找到网页',
            'description' => '很抱歉，您访问的页面不存在...请返回到上一个页面',
            'link' => false,
        ],
        '500' => [
            'error' => '哎呀，服务器崩溃了',
            'description' => '我们会自动报告每一个错误，请返回到上一个页面。',
            'link' => false,
        ],
        'fatal' => [
            'error' => '哎呀，服务器被外星人带走了',
            'description' => '我们会自动报告每一个错误，请返回到上一个页面。',
            'link' => false,
        ],
        '503' => [
            'error' => '啊哦...服务器正在维护中',
            'description' => '每次维护需要5秒到10分钟的时间。如果维护时间太长，查看 :link 以获得更多信息。',
            'link' => [
                'text' => '@osustatus',
                'href' => 'https://twitter.com/osustatus',
            ],
        ],
        // used by sentry if it returns an error
        'reference' => '以防万一，你可以将这里的代码发给我们！',
    ],

    'popup_login' => [
        'login' => [
            'email' => '用户名/邮箱',
            'forgot' => '我忘记了我的登录信息',
            'password' => '密码',
            'title' => '登录以继续',

            'error' => [
                'email' => '用户名或邮箱不存在',
                'password' => '密码错误',
            ],
        ],

        'register' => [
            'info' => '点击下方的注册按钮以成为 osu! 大家庭中的一员！',
            'title' => '没有帐号？',
        ],
    ],

    'popup_user' => [
        'links' => [
            'account-edit' => '设置',
            'friends' => '好友',
            'logout' => '退出', // Base text changed from "Log Out" to "Sign Out", please check.
            'profile' => '我的资料',
        ],
    ],

    'popup_search' => [
        'initial' => '键入以搜索！',
        'retry' => '搜索失败，点击以重试。',
    ],
];

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
            'getChangelog' => '更新日志',
            'getDownload' => '下载',
            'getIcons' => '图标',
            'getNews' => '新闻',
            'index' => 'osu!',
            'news-index' => '新闻',
            'news-show' => '新闻',
            'password-reset-index' => '重置密码',
            'supportTheGame' => '支持osu!',
        ],
        'help' => [
            '_' => '帮助',
            'getFaq' => '常见问题',
            'getSupport' => '获取帮助',
            'getWiki' => 'wiki',
            'wiki-show' => 'wiki',
        ],
        'beatmaps' => [
            '_' => '谱面',
            'show' => '信息',
            'index' => '列表',
            'artists' => '杰出艺术家',
            // 'getPacks' => 'packs',
            // 'getCharts' => 'charts',
        ],
        'beatmapsets' => [
            '_' => '谱面',
            'discussion' => '修改',
        ],
        'rankings' => [
            '_' => '排名',
            'index' => '表现',
            'performance' => '表现',
            'charts' => 'charts',
            'country' => '国家',
            'kudosu' => 'kudosu', //mapping相关，暂时不翻译
        ],
        'community' => [
            '_' => '社区',
            'dev' => 'osu!开发',
            'getForum' => '论坛',
            'getChat' => '聊天',
            'getSupport' => '获取帮助',
            'getLive' => '直播',
            'contests' => '评选',
            'profile' => '个人资料',
            'tournaments' => '锦标赛',
            'tournaments-index' => '锦标赛',
            'tournaments-show' => '锦标赛信息',
            'forum-topic-watches-index' => '捐赠',
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
            '404' => '找不到',
            '403' => '禁止',
            '401' => '权限不足',
            '405' => '找不到',
            '500' => '发生了一些错误',
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
            'logout' => '退出',
            'help' => '帮助',
        ],
        'store' => [
            '_' => '商店',
            'getListing' => '列表',
            'getCart' => '购物车',

            'getCheckout' => '结账',
            'getInvoice' => '发票',
            'getProduct' => '商品',

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
            'root' => 'index', //TODO 需要上下文
            'logs-index' => '日志',
            'beatmapsets' => [
                '_' => '谱面',
                'covers' => '封面',
                'show' => '细节',
            ],
        ],
    ],

    'footer' => [
        'general' => [
            '_' => '常规', //可能不准确
            'home' => '主页',
            'changelog' => '更新日志',
            'beatmaps' => '谱面列表',
            'download' => '下载osu!',
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
            '_' => '支持osu!',
            'tags' => '成为支持者',
            'merchandise' => '商店',
        ],
        'legal' => [
            '_' => '法律 & 状态',
            'copyright' => 'Copyright (DMCA)',
            'osu_status' => '@osustatus',
            'server_status' => '服务器状态',
            'terms' => '服务条款',
        ],
    ],

    'errors' => [
        '404' => [
            'error' => '页面未找到',
            'description' => '抱歉,您请求的界面不在这里!',
            'link' => false,
        ],
        '403' => [
            'error' => '您不应该在这里.',
            'description' => '您可以尝试返回.',
            'link' => false,
        ],
        '401' => [
            'error' => '您不应该在这里.',
            'description' => '您可以尝试返回,或者先登录',
            'link' => false,
        ],
        '405' => [
            'error' => '页面未找到',
            'description' => '抱歉,您请求的界面不在这里!',
            'link' => false,
        ],
        '500' => [
            'error' => '噢,发生了一些错误',
            'description' => '我们会自动报告每一个错误.',
            'link' => false,
        ],
        'fatal' => [
            'error' => '噢,发生了一些严重的错误',
            'description' => '我们会自动报告每一个错误.',
            'link' => false,
        ],
        '503' => [
            'error' => '维护中!',
            'description' => '每次维护需要5秒到10分钟的时间.如果我们维护时间太长,查看 :link 以获得更多信息.',
            'link' => [
                'text' => '@osustatus',
                'href' => 'https://twitter.com/osustatus',
            ],
        ],
        // used by sentry if it returns an error
        'reference' => '以防万一,您可以将这里的代码发给我们!',
    ],

    'popup_login' => [
        'login' => [
            'email' => 'email地址',
            'forgot' => '我忘记了我的登录信息',
            'password' => '密码',
            'title' => '登录以继续',

            'error' => [
                'email' => '用户名或email不存在',
                'password' => '密码错误',
            ],
        ],

        'register' => [
            'info' => '您需要一个帐号.为什么不现在注册一个呢?',
            'title' => '没有帐号?',
        ],
    ],

    'popup_user' => [
        'links' => [
            'account-edit' => '设置',
            'logout' => '退出',
            'profile' => '我的资料',
        ],
    ],

    'popup_search' => [
        'initial' => '输入以搜索!',
    ],
];

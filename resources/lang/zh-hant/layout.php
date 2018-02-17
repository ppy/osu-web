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
    'defaults' => [ //TODO 好長,之後再翻譯吧
        'page_description' => 'osu! - Rhythm is just a *click* away!  With Ouendan/EBA, Taiko and original gameplay modes, as well as a fully functional level editor.',
    ],

    'menu' => [
        'home' => [
            '_' => '主頁',
            'account-edit' => '設置',
            'friends' => '好友',
            'friends-index' => '好友',
            'changelog-index' => '更新日誌',
            'changelog-show' => '版本',
            'getDownload' => '下載',
            'getIcons' => '圖標',
            'groups-show' => '用戶組',
            'index' => 'osu!',
            'legal-show' => '信息',
            'news-index' => '新聞',
            'news-show' => '新聞',
            'password-reset-index' => '重置密碼',
            'search' => '搜索',
            'supportTheGame' => '支持 osu!',
        ],
        'help' => [
            '_' => '幫助',
            'getFaq' => '常見問題',
            'getSupport' => '獲取幫助',
            'getWiki' => 'wiki',
            'wiki-show' => 'wiki',
        ],
        'beatmaps' => [
            '_' => '譜面',
            'artists' => '精選藝術家',
            'beatmap_discussion_posts-index' => '譜面討論帖',
            'beatmap_discussions-index' => '譜面討論',
            'beatmapset-watches-index' => '譜面關注列表',
            'beatmapset_discussion_votes-index' => '譜面討論投票',
            'beatmapset_events-index' => '譜面事件',
            'index' => '列表',
            'packs' => '曲包',
            'show' => '信息',
        ],
        'beatmapsets' => [
            '_' => '譜面',
            'discussion' => '修改',
        ],
        'rankings' => [
            '_' => '排名',
            'index' => '表現',
            'performance' => '表現',
            'charts' => '月賽',
            'score' => '得分',
            'country' => '國家',
            'kudosu' => 'kudosu',
        ],
        'community' => [
            '_' => '社區',
            'dev' => 'osu! 開發',
            'getForum' => '論壇',
            'getChat' => '聊天',
            'getSupport' => '獲取幫助',
            'getLive' => '直播',
            'contests' => '評選',
            'profile' => '個人資料',
            'tournaments' => '官方比賽',
            'tournaments-index' => '官方比賽',
            'tournaments-show' => '官方比賽信息',
            'forum-topic-watches-index' => '訂閱',
            'forum-topics-create' => '論壇',
            'forum-topics-show' => '論壇',
            'forum-forums-index' => '論壇',
            'forum-forums-show' => '論壇',
        ],
        'multiplayer' => [
            '_' => '多人遊戲',
            'show' => '比賽',
        ],
        'error' => [
            '_' => '錯誤',
            '404' => '無法找到網頁',
            '403' => '拒絕訪問',
            '401' => '權限不足',
            '405' => '資源被禁止',
            '500' => '內部錯誤',
            '503' => '維護中',
        ],
        'user' => [
            '_' => '用戶',
            'getLogin' => '登錄',
            'disabled' => '禁用',

            'register' => '註冊',
            'reset' => '重置',
            'new' => 'new', //TODO 需要上下文

            'messages' => '信息',
            'settings' => '設置',
            'logout' => '退出',
            'help' => '幫助',
            'beatmapset_activities' => '玩家譜面活動', //需要上下文
        ],
        'store' => [
            '_' => '商店',
            'checkout-show' => '結賬',
            'getListing' => '列表',
            'cart-show' => '購物車',

            'getCheckout' => '結賬',
            'getInvoice' => '發票',
            'products-show' => '商品',

            'new' => 'new', //TODO 需要上下文
            'home' => 'home', //TODO 需要上下文
            'index' => 'home', //TODO 需要上下文
            'thanks' => '感謝',
        ],
        'admin-forum' => [
            '_' => 'admin::forum', //TODO 需要上下文
            'forum-covers-index' => '論壇封面',
        ],
        'admin-store' => [
            '_' => 'admin::store', //TODO 需要上下文
            'orders-index' => '訂單',
            'orders-show' => '訂單',
        ],
        'admin' => [
            '_' => '管理',
            'beatmapsets-covers' => '譜面封面',
            'logs-index' => '日誌',
            'root' => '主頁',

            'beatmapsets' => [
                '_' => '譜面',
                'show' => '詳細',
            ],
        ],
    ],

    'footer' => [
        'general' => [
            '_' => '網站地圖',
            'home' => '主頁',
            'changelog-index' => '更新日誌',
            'beatmaps' => '譜面列表',
            'download' => '下載 osu!',
            'wiki' => 'Wiki',
        ],
        'help' => [
            '_' => '幫助 & 社區',
            'faq' => '常見問題',
            'forum' => '論壇',
            'livestreams' => '直播',
            'report' => '報告問題',
        ],
        'support' => [
            '_' => '支持 osu!',
            'tags' => '成爲支持者',
            'merchandise' => '商店',
        ],
        'legal' => [
            '_' => '法律 & 狀態',
            'copyright' => '版權（DMCA）',
            'osu_status' => '@osustatus',
            'server_status' => '服務器狀態',
            'terms' => '服務條款',
        ],
    ],

    'errors' => [
        '404' => [
            'error' => '無法找到網頁',
            'description' => '很抱歉，您訪問的頁面不存在...請返回到上一個頁面',
            'link' => false,
        ],
        '403' => [
            'error' => '沒有權限',
            'description' => '沒有權限訪問該頁面，建議檢查一下再試，或者返回到上一個頁面',
            'link' => false,
        ],
        '401' => [
            'error' => '沒有權限',
            'description' => '沒有權限訪問該頁面，建議檢查一下再試，或者返回到上一個頁面（說不定因爲沒登錄）',
            'link' => false,
        ],
        '405' => [
            'error' => '無法找到網頁',
            'description' => '很抱歉，您訪問的頁面不存在...請返回到上一個頁面',
            'link' => false,
        ],
        '500' => [
            'error' => '哎呀，服務器崩潰了',
            'description' => '我們會自動報告每一個錯誤，請返回到上一個頁面。',
            'link' => false,
        ],
        'fatal' => [
            'error' => '哎呀，服務器被外星人帶走了',
            'description' => '我們會自動報告每一個錯誤，請返回到上一個頁面。',
            'link' => false,
        ],
        '503' => [
            'error' => '啊哦...服務器正在維護中',
            'description' => '每次維護需要5秒到10分鐘的時間。如果維護時間太長，查看 :link 以獲得更多信息。',
            'link' => [
                'text' => '@osustatus',
                'href' => 'https://twitter.com/osustatus',
            ],
        ],
        // used by sentry if it returns an error
        'reference' => '以防萬一，你可以將這裏的代碼發給我們！',
    ],

    'popup_login' => [
        'login' => [
            'email' => '用戶名/郵箱',
            'forgot' => '我忘記了我的登錄信息',
            'password' => '密碼',
            'title' => '登錄以繼續',

            'error' => [
                'email' => '用戶名或郵箱不存在',
                'password' => '密碼錯誤',
            ],
        ],

        'register' => [
            'info' => '點擊下方的註冊按鈕以成爲 osu! 大家庭中的一員！',
            'title' => '沒有帳號？',
        ],
    ],

    'popup_user' => [
        'links' => [
            'account-edit' => '設置',
            'friends' => '好友',
            'logout' => '退出',
            'profile' => '我的資料',
        ],
    ],

    'popup_search' => [
        'initial' => '鍵入以搜索！',
        'retry' => '搜索失敗，點擊以重試。',
    ],
];

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
        'page_description' => 'osu! - Rhythm is just a *click* away!  With Ouendan/EBA, Taiko and original gameplay modes, as well as a fully functional level editor.',
    ],

    'menu' => [
        'home' => [
            '_' => '首頁',
            'account-edit' => '設定',
            'friends-index' => '好友',
            'changelog-index' => '更新日誌',
            'changelog-build' => '版本',
            'getDownload' => '下載',
            'getIcons' => '圖示',
            'groups-show' => '群組',
            'index' => '看板',
            'legal-show' => '資訊',
            'news-index' => '新聞',
            'news-show' => '新聞',
            'password-reset-index' => '重設密碼',
            'search' => '搜尋',
            'supportTheGame' => '贊助 osu!',
            'team' => '團隊',
        ],
        'help' => [
            '_' => '幫助',
            'getFaq' => '常見問題',
            'getRules' => '規則準則',
            'getSupport' => '支援服務',
            'getWiki' => 'wiki',
            'wiki-show' => 'wiki',
        ],
        'beatmaps' => [
            '_' => '圖譜',
            'artists' => '精選藝術家',
            'beatmap_discussion_posts-index' => '譜面討論帖',
            'beatmap_discussions-index' => '譜面討論',
            'beatmapset-watches-index' => '譜面關注列表',
            'beatmapset_discussion_votes-index' => '譜面討論投票',
            'beatmapset_events-index' => '譜面事件',
            'index' => '圖譜列表',
            'packs' => '圖譜壓縮檔',
            'show' => '資訊',
        ],
        'beatmapsets' => [
            '_' => '圖譜',
            'discussion' => '修改',
        ],
        'rankings' => [
            '_' => '排行榜',
            'index' => '成績',
            'performance' => '成績',
            'charts' => '月賽',
            'score' => '總分',
            'country' => '國家',
            'kudosu' => 'kudosu',
        ],
        'community' => [
            '_' => '社群',
            'dev' => '開發',
            'getForum' => '論壇',
            'getChat' => '聊天',
            'getLive' => '直播',
            'contests' => '評選',
            'profile' => '個人簡介',
            'tournaments' => '官方比賽',
            'tournaments-index' => '官方比賽',
            'tournaments-show' => '官方比賽訊息',
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
            '403' => '拒絕存取',
            '401' => '權限不足',
            '405' => '資源被禁止',
            '500' => '內部錯誤',
            '503' => '維護中',
        ],
        'user' => [
            '_' => '使用者',
            'getLogin' => '登入',
            'disabled' => '禁用',

            'register' => '註冊',
            'reset' => '復原',
            'new' => '新增',

            'messages' => '訊息',
            'settings' => '設定',
            'logout' => '登出',
            'help' => '幫助',
            'modding-history-discussions' => '使用者摸圖討論區',
            'modding-history-events' => '使用者摸圖事件',
            'modding-history-index' => '使用者摸圖歷史紀錄',
            'modding-history-posts' => '使用者摸圖貼文',
            'modding-history-votesGiven' => '使用者摸圖投票數',
            'modding-history-votesReceived' => '使用者摸圖得票数',
        ],
        'store' => [
            '_' => '商店',
            'checkout-show' => '結帳',
            'getListing' => '商品列表',
            'cart-show' => '購物車',

            'getCheckout' => '結帳',
            'getInvoice' => '發票',
            'products-show' => '商品',

            'new' => '最新消息',
            'home' => '首頁',
            'index' => '首頁',
            'thanks' => '感謝',
        ],
        'admin-forum' => [
            '_' => 'admin::forum',
            'forum-covers-index' => '論壇封面',
        ],
        'admin-store' => [
            '_' => 'admin::store',
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
            'home' => '首頁',
            'changelog-index' => '更新日誌',
            'beatmaps' => '圖譜列表',
            'download' => '下載 osu!',
            'wiki' => 'Wiki',
        ],
        'help' => [
            '_' => '幫助 & 社區',
            'faq' => '常見問題',
            'forum' => '論壇',
            'livestreams' => '直播',
            'report' => '問題回報',
        ],
        'legal' => [
            '_' => '法律 & 狀態',
            'copyright' => '版權（DMCA）',
            'privacy' => '隱私政策',
            'server_status' => '伺服器狀態',
            'source_code' => '原始碼',
            'terms' => '服務條款',
        ],
    ],

    'errors' => [
        '404' => [
            'error' => '無法找到網頁',
            'description' => "很抱歉，您訪問的頁面不存在...請返回到上一個頁面",
        ],
        '403' => [
            'error' => "沒有權限",
            'description' => '沒有權限訪問該頁面，建議檢查一下再試，或者返回到上一個頁面',
        ],
        '401' => [
            'error' => "沒有權限",
            'description' => '沒有權限訪問該頁面，建議檢查一下再試，或者返回到上一個頁面（說不定因為沒登錄）',
        ],
        '405' => [
            'error' => '無法找到網頁',
            'description' => "很抱歉，您訪問的頁面不存在...請返回到上一個頁面",
        ],
        '500' => [
            'error' => '糟糕，伺服器崩潰了',
            'description' => "我們會自動回報任何一個錯誤，請返回到上一個頁面。",
        ],
        'fatal' => [
            'error' => '哎呀，服務器被外星人帶走了',
            'description' => "我們會自動回報任何一個錯誤，請返回到上一個頁面。",
        ],
        '503' => [
            'error' => '啊...伺服器正在維護中',
            'description' => "每次維護需要5秒到10分鐘的時間。如果維護時間太長，查看 :link 以獲得更多信息。",
            'link' => [
                'text' => '@osustatus',
                'href' => 'https://twitter.com/osustatus',
            ],
        ],
        // used by sentry if it returns an error
        'reference' => "以防萬一，你可以將這裡的代碼發給我們！",
    ],

    'popup_login' => [
        'login' => [
            'email' => '用戶名/郵箱',
            'forgot' => "我忘記了我的登錄信息",
            'password' => '密碼',
            'title' => '登錄以繼續',

            'error' => [
                'email' => "用戶名或郵箱不存在",
                'password' => '密碼錯誤',
            ],
        ],

        'register' => [
            'info' => "點擊下方的註冊按鈕以成為 osu! 大家庭中的一員！",
            'title' => "沒有帳號？",
        ],
    ],

    'popup_user' => [
        'links' => [
            'account-edit' => '設定',
            'friends' => '好友',
            'logout' => '登出',
            'profile' => '我的資料',
        ],
    ],

    'popup_search' => [
        'initial' => '請輸入以搜尋!',
        'retry' => '搜索失敗，點擊以重試。',
    ],
];

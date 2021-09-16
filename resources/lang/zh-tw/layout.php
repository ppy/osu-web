<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'audio' => [
        'autoplay' => '自動播放下一首曲目',
    ],

    'defaults' => [
        'page_description' => 'osu! - Rhythm is just a *click* away!  With Ouendan/EBA, Taiko and original gameplay modes, as well as a fully functional level editor.',
    ],

    'header' => [
        'admin' => [
            'beatmapset' => '圖譜',
            'beatmapset_covers' => '圖譜封面',
            'contest' => '比賽',
            'contests' => '競賽',
            'root' => '控制中心',
            'store_orders' => '商店管理',
        ],

        'artists' => [
            'index' => '清單',
        ],

        'changelog' => [
            'index' => '列表',
        ],

        'help' => [
            'index' => '主頁',
            'sitemap' => '網站地圖',
        ],

        'store' => [
            'cart' => '購物車',
            'orders' => '訂單記錄',
            'products' => '商品',
        ],

        'tournaments' => [
            'index' => '清單',
        ],

        'users' => [
            'modding' => '摸圖',
            'multiplayer' => '多人遊戲',
            'show' => '資訊',
        ],
    ],

    'gallery' => [
        'close' => '關閉 (Esc)',
        'fullscreen' => '切換全螢幕',
        'zoom' => '放大/縮小',
        'previous' => '前一個（左箭頭）',
        'next' => '下一個（右箭頭）',
    ],

    'menu' => [
        'beatmaps' => [
            '_' => '圖譜',
        ],
        'community' => [
            '_' => '社群',
            'dev' => '開發',
        ],
        'help' => [
            '_' => '幫助',
            'getAbuse' => '檢舉違規行為',
            'getFaq' => '常見問題',
            'getRules' => '規則',
            'getSupport' => '支援服務',
        ],
        'home' => [
            '_' => '首頁',
            'team' => '團隊',
        ],
        'rankings' => [
            '_' => '排行榜',
            'kudosu' => 'kudosu',
        ],
        'store' => [
            '_' => '商店',
        ],
    ],

    'footer' => [
        'general' => [
            '_' => '網站地圖',
            'home' => '首頁',
            'changelog-index' => '更新日誌',
            'beatmaps' => '圖譜列表',
            'download' => '下載 osu!',
        ],
        'help' => [
            '_' => '幫助 & 社區',
            'faq' => '常見問題',
            'forum' => '論壇',
            'livestreams' => '直播',
            'report' => '問題回報',
            'wiki' => '維基',
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
        '400' => [
            'error' => '請求參數無效',
            'description' => '',
        ],
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
            'description' => '沒有權限訪問該頁面，建議檢查一下再試，或者返回到上一個頁面（說不定因為沒登入）',
        ],
        '405' => [
            'error' => '無法找到網頁',
            'description' => "很抱歉，您訪問的頁面不存在...請返回到上一個頁面",
        ],
        '422' => [
            'error' => '請求參數無效',
            'description' => '',
        ],
        '429' => [
            'error' => '已達速率限制',
            'description' => '',
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
            'description' => "每次維護需要5秒到10分鐘的時間。如果維護時間太長，查看 :link 以取得更多資訊。",
            'link' => [
                'text' => '',
                'href' => '',
            ],
        ],
        // used by sentry if it returns an error
        'reference' => "以防萬一，你可以將這裡的代碼發給我們！",
    ],

    'popup_login' => [
        'button' => '登入/註冊',

        'login' => [
            'forgot' => "忘記登入資訊？",
            'password' => '密碼',
            'title' => '登入以繼續',
            'username' => '使用者名稱',

            'error' => [
                'email' => "用戶名或郵箱不存在",
                'password' => '密碼錯誤',
            ],
        ],

        'register' => [
            'download' => '下載',
            'info' => '立即下載 osu! 來創造您專屬的帳號!',
            'title' => "沒有帳號？",
        ],
    ],

    'popup_user' => [
        'links' => [
            'account-edit' => '設定',
            'follows' => '追蹤清單',
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

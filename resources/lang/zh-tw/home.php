<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'landing' => [
        'download' => '立即下載',
        'online' => '<strong>:players</strong> 名線上玩家, <strong>:games</strong> 個遊戲房間',
        'peak' => '最高線上人數 :count 人',
        'players' => '<strong>:count</strong> 名已註冊玩家',
        'title' => '歡迎',
        'see_more_news' => '顯示更多新聞',

        'slogan' => [
            'main' => '最棒的音樂遊戲',
            'sub' => '節奏躍然指上',
        ],
    ],

    'search' => [
        'advanced_link' => '進階搜尋',
        'button' => '搜尋',
        'empty_result' => '沒有結果！',
        'keyword_required' => '至少需要一個搜尋關鍵字。',
        'placeholder' => '請輸入以搜尋',
        'title' => '搜尋',

        'artist_track' => [
            'more_simple' => '查看更多精選藝術家曲目的搜尋結果',
        ],
        'beatmapset' => [
            'login_required' => '登入以搜尋圖譜',
            'more' => '搜尋到 :count 張圖譜',
            'more_simple' => '查看更多搜尋結果',
            'title' => '圖譜',
        ],

        'forum_post' => [
            'all' => '所有論壇',
            'link' => '在論壇中搜尋',
            'login_required' => '登入以搜尋論壇',
            'more_simple' => '查看更多搜尋結果',
            'title' => '論壇',

            'label' => [
                'forum' => '在論壇中搜尋',
                'forum_children' => '包括小主題',
                'include_deleted' => '包括已刪除的貼文',
                'topic_id' => '主題 #',
                'username' => '作者',
            ],
        ],

        'mode' => [
            'all' => '所有',
            'artist_track' => '精選藝術家曲目',
            'beatmapset' => '圖譜',
            'forum_post' => '論壇',
            'team' => '團隊',
            'user' => '玩家',
            'wiki_page' => 'wiki',
        ],

        'team' => [
            'login_required' => '',
            'more_simple' => '查看更多團隊搜尋結果',
        ],

        'user' => [
            'login_required' => '登入以搜尋玩家',
            'more' => '搜尋到 :count 張圖譜',
            'more_simple' => '查看更多搜尋結果',
            'more_hidden' => '搜尋玩家的人數不可超過 :max 人，請修改搜尋內容。',
            'title' => '玩家',
        ],

        'wiki_page' => [
            'link' => '在 Wiki 中搜尋',
            'more_simple' => '查看更多搜尋結果',
            'title' => 'Wiki',
        ],
    ],

    'download' => [
        'action_lazer_info' => '點此來了解更多',
        'download' => '下載',
        'for_os' => ':os 版',
        'macos-fallback' => 'macOS 使用者',
        'mirror' => '鏡像站',
        'or' => '或',
        'os_version_or_later' => ':os_version或更新版本',
        'other_os' => '其他平台',
        'quick_start_guide' => '三步開始遊玩 osu!',
        'stable_text' => '如果你正在尋找舊版本',
        'tagline_1' => '讓我們',
        'tagline_2' => '開始吧！',
        'video-guide' => '影片教學',

        'help' => [
            '_' => '如果您在啟動遊戲或註冊帳號時遇到問題，請:help_forum_link或:support_button。',
            'help_forum_link' => '查看說明論壇',
            'support_button' => '聯絡支援團隊',
        ],

        'os' => [
            'windows' => 'Windows 版',
            'macos' => 'macOS 版',
            'linux' => 'Linux 版',
        ],
        'steps' => [
            'register' => [
                'title' => '註冊帳號',
                'description' => '進入遊戲後請根據提示登入或註冊帳號',
            ],
            'download' => [
                'title' => '下載遊戲',
                'description' => '點擊上方按鈕下載安裝檔並執行！',
            ],
            'beatmaps' => [
                'title' => '下載圖譜',
                'description' => [
                    '_' => ':browse 玩家們自製的遊戲圖譜，來玩看看吧！',
                    'browse' => '瀏覽',
                ],
            ],
        ],
    ],

    'user' => [
        'title' => '看板',
        'news' => [
            'title' => '最新消息',
            'error' => '載入最新消息發生錯誤，請重新載入頁面？...',
        ],
        'header' => [
            'stats' => [
                'friends' => '線上好友',
                'games' => '房間',
                'online' => '線上使用者',
            ],
        ],
        'beatmaps' => [
            'daily_challenge' => '每日挑戰圖譜',
            'new' => '新進榜圖譜',
            'popular' => '熱門圖譜',
            'by_user' => '由 :user',
            'resets' => '重設時間：:ends',
        ],
        'buttons' => [
            'download' => '下載 osu!',
            'support' => '贊助 osu!',
            'store' => 'osu! 商店',
        ],
        'livestream' => [
            'title' => '',
        ],
        'show' => [
            'admin' => [
                'page' => '開啟管理控制台',
            ],
        ],
    ],
];

<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
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
    'landing' => [
        'download' => '立即下載',
        'online' => '<strong>:players</strong> 名線上玩家, <strong>:games</strong> 個遊戲房間',
        'peak' => '最高線上人數 :count 人',
        'players' => '<strong>:count</strong> 名已註冊玩家',
        'title' => '',

        'slogan' => [
            'main' => '最棒的音樂遊戲',
            'sub' => '節奏躍然指上',
        ],
    ],

    'search' => [
        'advanced_link' => '進階搜尋',
        'button' => '搜尋',
        'empty_result' => '沒有結果！',
        'missing_query' => '搜尋內容至少包含 :n 個字',
        'placeholder' => '請輸入以搜尋',
        'title' => '搜尋',

        'beatmapset' => [
            'more' => '搜尋到 :count 張圖譜',
            'more_simple' => '查看更多搜尋結果',
            'title' => '圖譜',
        ],

        'forum_post' => [
            'all' => '所有論壇',
            'link' => '在論壇中搜尋',
            'more_simple' => '查看更多搜尋結果',
            'title' => '論壇',

            'label' => [
                'forum' => '在論壇中搜尋',
                'forum_children' => '包含小主題',
                'topic_id' => '主題 #',
                'username' => '作者',
            ],
        ],

        'mode' => [
            'all' => '所有',
            'beatmapset' => '圖譜',
            'forum_post' => '論壇',
            'user' => '玩家',
            'wiki_page' => 'wiki',
        ],

        'user' => [
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
        'tagline' => "讓我們<br>開始吧！",
        'action' => '下載 osu!',
        'os' => [
            'windows' => 'Windows 版',
            'macos' => 'macOS 版',
            'linux' => 'Linux 版',
        ],
        'mirror' => '鏡像站',
        'macos-fallback' => 'macOS 使用者',
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
        'video-guide' => '影片教學',
    ],

    'user' => [
        'title' => '看板',
        'news' => [
            'title' => '最新消息',
            'error' => '載入最新消息發生錯誤，請重新載入頁面？...',
        ],
        'header' => [
            'welcome' => '哈嘍，<strong>:username</strong>！',
            'messages' => '你有 :count 條新訊息|{0}',
            'stats' => [
                'friends' => '線上好友',
                'games' => '房間',
                'online' => '線上使用者',
            ],
        ],
        'beatmaps' => [
            'new' => '新進榜圖譜',
            'popular' => '熱門圖譜',
            'by' => '作者：',
            'plays' => ':count 次遊玩',
        ],
        'buttons' => [
            'download' => '下載 osu!',
            'support' => '贊助 osu!',
            'store' => 'osu! 商店',
        ],
    ],

    'support-osu' => [
        'title' => '哇！',
        'subtitle' => '看起來你玩得很開心！',
        'body' => [
            'part-1' => '你知道嗎？ osu! 是一款沒有廣告，完全依賴玩家贊助以維持開發及運營的遊戲。',
            'part-2' => '如果你選擇給 osu! 捐贈，就可以解鎖額外的功能，例如<strong>遊戲內自動下載</strong>。',
        ],
        'find-out-more' => '點擊這裡以瞭解更多',
        'download-starting' => "喔 ! 別擔心 - 下載已經開始了 ;)",
    ],
];

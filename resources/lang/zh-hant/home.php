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
    'landing' => [
        'download' => '下載',
        'online' => '<strong>:players</strong> 名在線玩家, <strong>:games</strong> 個遊戲房間',
        'peak' => '最高在線人數 :count 人',
        'players' => '<strong>:count</strong> 名已註冊玩家',

        'slogan' => [
            'main' => '免費音樂遊戲',
            'sub' => '節奏躍然指上',
        ],
    ],

    'search' => [
        'advanced_link' => '高級搜索',
        'button' => '搜索',
        'empty_result' => '沒有結果！',
        'missing_query' => '搜索內容不少於 :n 個字符',
        'title' => '搜索結果',

        'beatmapset' => [
            'more' => '搜索到 :count 張譜面',
            'more_simple' => '查看更多搜索結果',
            'title' => '譜面',
        ],

        'forum_post' => [
            'all' => '所有論壇',
            'link' => '在論壇中搜索',
            'more_simple' => '查看更多搜索結果',
            'title' => '論壇',

            'label' => [
                'forum' => '在論壇中搜索',
                'forum_children' => '包括子版塊',
                'topic_id' => '主題 #',
                'username' => '作者',
            ],
        ],

        'mode' => [
            'all' => '所有',
            'beatmapset' => '譜面',
            'forum_post' => '論壇',
            'user' => '玩家',
            'wiki_page' => 'wiki',
        ],

        'user' => [
            'more' => '搜索到 :count 個玩家',
            'more_simple' => '查看更多搜索結果',
            'more_hidden' => '玩家搜索超出 :max 個限制，請修改搜索內容。',
            'title' => '玩家',
        ],

        'wiki_page' => [
            'link' => '在 Wiki 中搜索',
            'more_simple' => '查看更多搜索結果',
            'title' => 'Wiki',
        ],
    ],

    'download' => [
        'tagline' => '讓我們<br>開始吧！',
        'action' => '下載 osu!',
        'os' => [
            'windows' => 'Windows 版',
            'macos' => 'macOS 版',
            'linux' => 'Linux 版',
        ],
        'mirror' => '鏡像',
        'macos-fallback' => 'macOS 用戶',
        'steps' => [
            'register' => [
                'title' => '註冊帳號',
                'description' => '根據遊戲提示進行登錄或註冊',
            ],
            'download' => [
                'title' => '下載遊戲',
                'description' => '點擊上面的按鈕下載安裝器，然後運行它！',
            ],
            'beatmaps' => [
                'title' => '下載譜面',
                'description' => [
                    '_' => ':browse 玩家們創造的譜面然後開始遊戲吧！',
                    'browse' => '瀏覽',
                ],
            ],
        ],
        'video-guide' => '視頻教程',
    ],

    'user' => [
        'title' => '新聞',
        'news' => [
            'title' => '新聞',
            'error' => '載入新聞失敗，刷新頁面試試看？...',
        ],
        'header' => [
            'welcome' => '哈嘍，<strong>:username</strong>！',
            'messages' => '你有 :count 條新消息|{0}',
            'stats' => [
                'friends' => '在線好友',
                'games' => '房間',
                'online' => '在線用戶',
            ],
        ],
        'beatmaps' => [
            'new' => '新 Approved 譜面',
            'popular' => '高人氣譜面',
            'by' => '作者：',
            'plays' => ':count 次遊玩',
        ],
        'buttons' => [
            'download' => '下載 osu!',
            'support' => '支持 osu!',
            'store' => 'osu! 商店',
        ],
    ],

    'support-osu' => [
        'title' => '喔！',
        'subtitle' => '看起來你玩得很開心！',
        'body' => [
            'part-1' => '你知道嗎？ osu! 是一款沒有廣告，完全依賴玩家支持以維持開發及運營的遊戲。',
            'part-2' => '如果你選擇給 osu! 捐贈，就可以解鎖額外的功能，例如<strong>遊戲內自動下載</strong>。',
        ],
        'find-out-more' => '點擊這裡以瞭解更多',
        'download-starting' => '對了，別擔心 - 下載已經開始了 ;)',
    ],
];

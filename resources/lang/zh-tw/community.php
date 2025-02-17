<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'support' => [
        'convinced' => [
            'title' => '可以可以，買買買！',
            'support' => '贊助 osu!',
            'gift' => '或者以禮物方式贈送給其他玩家',
            'instructions' => '點選愛心前往 osu! 商店',
        ],
        'why-support' => [
            'title' => '我為什麼要贊助 osu!？錢都花到哪裡了？',

            'team' => [
                'title' => '支持團隊',
                'description' => 'osu! 是一個小團隊在開發和經營的。你的支持能讓他們，你知道的... 活下去。',
            ],
            'infra' => [
                'title' => '伺服器基礎設施',
                'description' => '捐款將用於網站伺服器營運、多人遊戲服務、線上排行榜等。',
            ],
            'featured-artists' => [
                'title' => '精選藝術家',
                'description' => '在你的支持下，我們可以與更多優秀的藝術家合作，並為 osu! 帶來更多出色的音樂',
                'link_text' => '查看目前清單 &raquo;',
            ],
            'ads' => [
                'title' => '維持 osu! 自給自足',
                'description' => '你的幫助可以讓遊戲保持獨立並遠離廣告，不受外部贊助商的控制。',
            ],
            'tournaments' => [
                'title' => '官方比賽',
                'description' => '為官方 osu! 世界盃籌備營運資金（及獎勵）。',
                'link_text' => '探索比賽 &raquo;',
            ],
            'bounty-program' => [
                'title' => '開源賞金計劃',
                'description' => '向社群中花費時間及精力幫助 osu! 變得更好的貢獻者獻上支持。',
                'link_text' => '了解更多 &raquo;',
            ],
        ],
        'perks' => [
            'title' => '酷欸！我能得到什麼？',
            'osu_direct' => [
                'title' => 'osu!direct',
                'description' => '在遊戲內提供圖譜快速下載與搜尋。',
            ],

            'friend_ranking' => [
                'title' => '好友排行榜',
                'description' => "看看你如何在遊戲中與網站內的圖譜排行榜上對抗你的朋友",
            ],

            'country_ranking' => [
                'title' => '國家排行榜',
                'description' => '在征服世界前先征服你的國家',
            ],

            'mod_filtering' => [
                'title' => '依 Mod 篩選',
                'description' => '只想和 HDHR 玩家一起玩？沒問題！',
            ],

            'auto_downloads' => [
                'title' => '自動下載',
                'description' => '本機沒有需要的圖譜時，osu! 會自動下載！',
            ],

            'upload_more' => [
                'title' => '上傳更多圖譜',
                'description' => '譜師能額外上傳待處理的圖譜上限增加至 10 張圖譜。',
            ],

            'early_access' => [
                'title' => '搶先體驗',
                'description' => '搶先體驗正在測試中的新功能！',
            ],

            'customisation' => [
                'title' => '客製化',
                'description' => "客製化您的頁面。",
            ],

            'beatmap_filters' => [
                'title' => '圖譜篩選器',
                'description' => '篩選圖譜搜尋結果，可依據已遊玩或未遊玩地圖，或依據達成的排名進行篩選。',
            ],

            'yellow_fellow' => [
                'title' => '突顯使用者名稱',
                'description' => '聊天時，使用者名稱會變成亮黃色。',
            ],

            'speedy_downloads' => [
                'title' => '高速下載',
                'description' => '更快的下載速度，尤其是使用 osu!direct 時。',
            ],

            'change_username' => [
                'title' => '修改使用者名稱',
                'description' => '您的首次購買贊助者將包含一次免費的修改名稱機會。',
            ],

            'skinnables' => [
                'title' => '更多的訂製外觀元素',
                'description' => '可自訂更多外觀元素，例如主選單背景。',
            ],

            'feature_votes' => [
                'title' => '新功能投票',
                'description' => '為新功能請求投票（每月 2 票）。',
            ],

            'sort_options' => [
                'title' => '排序選項',
                'description' => '能夠在遊戲內查看譜面依國家／好友／特定 mod 的排行榜',
            ],

            'more_favourites' => [
                'title' => '收藏更多圖譜',
                'description' => '你可收藏的圖譜上限將從 :normally &rarr; :supporter',
            ],
            'more_friends' => [
                'title' => '更多好友',
                'description' => '你的好友上限將從 :normally &rarr; :supporter',
            ],
            'more_beatmaps' => [
                'title' => '上傳更多圖譜',
                'description' => '你能擁有的待處理圖譜數量上限是基本上限加上額外上限，額外上限取決於你已進榜的圖譜數量（有最大值）。<br/><br/>通常基本上限為 :base，每進榜一張圖譜獲得 :bonus 額外上限（最大值為 :bonus_max）。若你是贊助者，基本上限增加至 :supporter_base，每進榜一張圖譜獲得 :supporter_bonus 額外上限（最大值為 :supporter_bonus_max）。',
            ],
            'friend_filtering' => [
                'title' => '好友排行榜',
                'description' => '和您的朋友一起競賽，看看你如何超越他們的排名!',
            ],

        ],
        'supporter_status' => [
            'contribution' => '感謝您一直以來的支持！您已經捐贈了 :dollars 並購買了 :tags 次贊助者標籤！',
            'gifted' => "您已經捐贈了 :giftedTags 次贊助者標籤（花費了 :giftedDollars），真慷慨啊！",
            'not_yet' => "您還沒有贊助者標籤 :(",
            'valid_until' => '您的贊助者標籤將在 :date 到期',
            'was_valid_until' => '您的贊助者標籤已於 :date 到期',
        ],
    ],
];

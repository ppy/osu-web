<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'support' => [
        'convinced' => [
            'title' => '可以可以，買買買！',
            'support' => '贊助 osu!',
            'gift' => '或者以禮物方式贈送給其它玩家',
            'instructions' => '點擊愛心前往 osu! 商店',
        ],
        'why-support' => [
            'title' => '我為什麼要贊助 osu! ？錢都花到哪兒了？',

            'team' => [
                'title' => '資助團隊',
                'description' => 'osu! 是由一個小團隊進行開發和營運。您的贊助可以幫助團隊...你知道的，維持生計。',
            ],
            'infra' => [
                'title' => '伺服器基礎設施',
                'description' => '捐款用於網站營運，多人連線服務，在線排行榜...等等。',
            ],
            'featured-artists' => [
                'title' => '精選藝術家',
                'description' => '在你的支持下，我們可以與更多優秀的藝術家合作，並為 osu! 帶來更多出色的音樂',
                'link_text' => '查看當前列表 &raquo;',
            ],
            'ads' => [
                'title' => '維持 osu! 自給自足',
                'description' => '你的幫助可以讓遊戲保持獨立並遠離廣告，不受外部贊助商的控制。',
            ],
            'tournaments' => [
                'title' => '官方比賽',
                'description' => '為官方 osu! 世界杯籌備營運資金（及獎勵）。',
                'link_text' => '探索比賽 &raquo;',
            ],
            'bounty-program' => [
                'title' => '開源賞金計劃',
                'description' => '向社群中花費時間及精力幫助 osu! 變得更好的貢獻者獻上支持。',
                'link_text' => '了解更多 &raquo;',
            ],
        ],
        'perks' => [
            'title' => '我能得到什麼？',
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
                'title' => '按 Mods 篩選',
                'description' => '只想和 HDHR 玩家一起玩？沒問題！',
            ],

            'auto_downloads' => [
                'title' => '自動下載',
                'description' => '當多人遊戲與觀看玩家無圖譜時，osu! 會自動下載！',
            ],

            'upload_more' => [
                'title' => '上傳更多圖譜',
                'description' => '做圖者上傳待處理的圖譜上限增加到 10 張。',
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
                'description' => '更多角度的去篩選圖譜。',
            ],

            'yellow_fellow' => [
                'title' => '高亮使用者名稱',
                'description' => '聊天時，用戶名會變成亮黃色。',
            ],

            'speedy_downloads' => [
                'title' => '高速下載',
                'description' => '更快的下載速度，尤其是使用 osu!direct 時。',
            ],

            'change_username' => [
                'title' => '修改用戶名',
                'description' => '修改用戶名而不需要支付費用（最多 1 次）。',
            ],

            'skinnables' => [
                'title' => '更多的定製',
                'description' => '自定義更多的遊戲界面元素，例如主畫面的背景。',
            ],

            'feature_votes' => [
                'title' => '新特性投票',
                'description' => '為新特性請求投票（每月 2 票）。',
            ],

            'sort_options' => [
                'title' => '排名',
                'description' => '查看排名時可按 國家/好友/所選MOD 進行排名。',
            ],

            'more_favourites' => [
                'title' => '更多收藏',
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
            'gifted' => "您已經捐贈了 :giftedTags 次贊助者標籤（花費了 :giftedDollars ），真慷慨啊！",
            'not_yet' => "您還沒有贊助者標籤 :(",
            'valid_until' => '您的贊助者標籤將在 :date 到期',
            'was_valid_until' => '您的贊助者標籤已於 :date 到期',
        ],
    ],
];

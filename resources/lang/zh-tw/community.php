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
    'support' => [
        'header' => [
            // size in font-size
            'big_description' => '',
            'small_description' => '',
            'support_button' => '我想贊助 osu!',
        ],

        'dev_quote' => 'osu! 是一款完全免費的遊戲，但是經營它卻不是免費的。在我們租用服務器和高速網絡、維護系統及社區、向比賽提供獎品、提供疑難解答以及讓玩家們開心的同時，osu! 已經消耗了大量的金錢！噢，別忘了我們是憑著愛好在做 osu! ，沒有任何的廣告合作！
            <br/><br/>osu! 由我一個人運營著，
            為了維護 osu! 我已經辭去了我的日常工作，
            而我時常感受到使 osu! 維持我所期望的質量是一件很艱難的事情，
            我以個人的名義感謝至今為止所有支持 osu! 的人，
            也包括繼續支持 osu! 的所有人 :)。',

        'supporter_status' => [
            'contribution' => '感謝您一直以來的支持！你已經捐贈了 :dollars 並購買了 :tags 次贊助者標籤！',
            'gifted' => '您已經捐贈了 :giftedTags 次贊助者標籤（花費了 :giftedDollars ），真慷慨啊！',
            'not_yet' => "您還沒有贊助者標籤 :(",
            'title' => '當前贊助者狀態',
            'valid_until' => '您的贊助者標籤將在 :date 到期',
            'was_valid_until' => '您的贊助者標籤已於 :date 到期',
        ],

        'why_support' => [
            'title' => '為什麼要贊助 osu! ？',
            'blocks' => [
                'dev' => 'osu! 最初是由 ppy 個人開發與維護的',
                'time' => '營運它的成本和投入的精力已經不能稱作是興趣了',
                'ads' => '完全無廣告 <br/><br/>
                        不像 99.95% 的網站，我們從不刊登廣告，也沒有從中獲利。',
                'goodies' => '解鎖更多額外的服務！',
            ],
        ],

        'perks' => [
            'title' => '我能得到什麼？',
            'osu_direct' => [
                'title' => 'osu!direct',
                'description' => '在遊戲內提供圖譜快速下載與搜尋。',
            ],

            'auto_downloads' => [
                'title' => '自動下載',
                'description' => '當多人遊戲與觀看玩家無圖譜時，osu! 會自動下載！',
            ],

            'upload_more' => [
                'title' => '上傳更多圖譜',
                'description' => '做圖者上傳待批准的圖譜上限增加到 10 張。',
            ],

            'early_access' => [
                'title' => '搶先體驗',
                'description' => '搶先體驗正在測試中的新功能！',
            ],

            'customisation' => [
                'title' => '客製化',
                'description' => '客製化您的頁面。',
            ],

            'beatmap_filters' => [
                'title' => '譜面篩選器',
                'description' => '更多角度的去篩選譜面。',
            ],

            'yellow_fellow' => [
                'title' => '高亮用戶名',
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
                'description' => '自定義更多的遊戲界面元素，例如主菜單的背景。',
            ],

            'feature_votes' => [
                'title' => '新特性投票',
                'description' => '為新特性請求投票（每月 2 票）。',
            ],

            'sort_options' => [
                'title' => '排名',
                'description' => '查看排名時可按 國家/好友/所選MOD 進行排名。',
            ],

            'feel_special' => [
                'title' => '滿足感',
                'description' => '對 “幫助 osu! 繼續運營” 感到滿足！',
            ],

            'more_to_come' => [
                'title' => '更多特性即將到來',
                'description' => '',
            ],
        ],

        'convinced' => [
            'title' => '可以可以，買買買！',
            'support' => '支持 osu!',
            'gift' => '或者以禮物方式贈送給其它玩家',
            'instructions' => '點擊愛心前往 osu! 商店',
        ],
    ],
];

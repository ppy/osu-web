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
    'availability' => [
        'disabled' => '該譜面現在無法下載。',
        'parts-removed' => '因作者或第三方版權擁有者的要求，故該圖譜已經下架。',
        'more-info' => '點擊這裡查看更多訊息。',
    ],

    'index' => [
        'title' => '譜面列表',
        'guest_title' => '圖譜',
    ],

    'show' => [
        'discussion' => '討論',

        'details' => [
            'approved' => '批准於 ',
            'favourite' => '收藏這張圖譜',
            'favourited_count' => '還有很多人...',
            'logged-out' => '下載圖譜前請先登入！',
            'loved' => 'loved 於 ',
            'mapped_by' => '由 :mapper 製作',
            'qualified' => '提名於 ',
            'ranked' => '進榜於 ',
            'submitted' => '發佈於 ',
            'unfavourite' => '取消收藏',
            'updated' => '上次更新於 ',
            'updated_timeago' => '最後更新時間 :timeago',

            'download' => [
                '_' => '下載',
                'direct' => 'osu!direct',
                'no-video' => '不含影像',
                'video' => '含影像',
            ],

            'login_required' => [
                'bottom' => '',
                'top' => '',
            ],
        ],

        'favourites' => [
            'limit_reached' => '',
        ],

        'hype' => [
            'action' => '',

            'current' => [
                '_' => '',

                'status' => [
                    'pending' => '',
                    'qualified' => '',
                    'wip' => '',
                ],
            ],
        ],

        'info' => [
            'description' => '詳情',
            'genre' => '曲風',
            'language' => '語言',
            'no_scores' => '資料還在計算中。。。',
            'points-of-failure' => '失敗位置',
            'source' => '來源',
            'success-rate' => '成功率',
            'tags' => '標籤',
            'unranked' => '未進榜圖譜',
        ],

        'scoreboard' => [
            'achieved' => '在 :when 達成',
            'country' => '國內排行榜',
            'friend' => '好友排行榜',
            'global' => '世界排行榜',
            'supporter-link' => '點擊 <a href=":link">這裡</a> 來查看你可以得到的精彩功能！',
            'supporter-only' => '你需要成為贊助者才能查看國內與好友排名！',
            'title' => '排行榜',

            'headers' => [
                'accuracy' => '準確率',
                'combo' => '最大連擊',
                'miss' => 'Miss',
                'mods' => 'Mods',
                'player' => '玩家',
                'pp' => 'pp',
                'rank' => '排行榜',
                'score_total' => '總分',
                'score' => '得分',
            ],

            'no_scores' => [
                'country' => '您的所在地玩家尚未上傳成績！',
                'friend' => '您的好友尚未上傳成績！',
                'global' => '沒有任何玩家上傳過成績，來挑戰嗎？',
                'loading' => '加載分數中...',
                'unranked' => '未進榜圖譜',
            ],
            'score' => [
                'first' => '領先者',
                'own' => '您的最佳成績',
            ],
        ],

        'stats' => [
            'cs' => '縮圈大小',
            'cs-mania' => '鍵位數量',
            'drain' => '扣血速度',
            'accuracy' => '準確率',
            'ar' => '縮圈速度',
            'stars' => '難度星級',
            'total_length' => '長度',
            'bpm' => 'BPM',
            'count_circles' => '圓圈總數',
            'count_sliders' => '滑條總數',
            'user-rating' => '玩家評價',
            'rating-spread' => '評分情況',
            'nominations' => '提名',
            'playcount' => '遊玩次数',
        ],
    ],
];

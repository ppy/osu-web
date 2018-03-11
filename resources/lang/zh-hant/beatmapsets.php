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
    'availability' => [
        'disabled' => '該譜面現在無法下載。',
        'parts-removed' => '應作者/第三方版權持有者的要求，這張譜面已經下架。',
        'more-info' => '點擊這裡查看更多信息。',
    ],

    'index' => [
         'title' => '譜面列表',
         'guest_title' => '譜面',
     ],

    'show' => [
        'discussion' => '討論',

        'details' => [
            'made-by' => '作者: ',
            'submitted' => '提交於 ',
            'updated' => '上次更新於 ',
            'ranked' => 'ranked 於 ',
            'approved' => 'approved 於 ',
            'qualified' => 'qualified 於 ',
            'loved' => 'loved 於 ',
            'logged-out' => '下載譜面前請先登錄！',
            'download' => [
                '_' => '下載',
                'video' => '帶視頻',
                'no-video' => '不帶視頻',
                'direct' => 'osu!direct',
            ],
            'favourite' => '收藏這張譜面',
            'unfavourite' => '取消收藏',
            'favourited_count' => '還有很多人...',
        ],
        'stats' => [
            'cs' => '縮圈大小',
            'cs-mania' => '鍵位數量',
            'drain' => '掉血速度',
            'accuracy' => '準確率',
            'ar' => '縮圈速度',
            'stars' => '難度星級',
            'total_length' => '長度',
            'bpm' => 'BPM',
            'count_circles' => '圓圈總數',
            'count_sliders' => '滑條總數',
            'user-rating' => '玩家評價',
            'rating-spread' => '評分情況',
        ],
        'info' => [
            'description' => '介紹',
            'genre' => '流派',
            'language' => '語言',
            'no_scores' => 'Unranked 譜面',
            'points-of-failure' => '失敗位置',
            'source' => '來源',
            'success-rate' => '成功率',
            'tags' => '標籤',
        ],
        'scoreboard' => [
            'achieved' => '在 :when 達成',
            'country' => '國內排名',
            'friend' => '好友排名',
            'global' => '全球排名',
            'miss_count' => ':count miss', //上下文
            'supporter-link' => '點擊 <a href=":link">這裡</a> 來查看你可以得到的精彩功能！',
            'supporter-only' => '你需要成為支持者才能查看國內/好友排名！',
            'title' => '排行榜',

            'headers' => [
                'accuracy' => '準確率',
                'combo' => '最大連擊',
                'miss' => 'Miss',
                'mods' => 'Mods',
                'player' => '玩家',
                'pp' => 'pp',
                'rank' => '排名',
                'score_total' => '得分',
                'score' => '得分',
            ],

            'no_scores' => [
                'country' => '還沒有玩家上傳過成績！',
                'friend' => '還沒有好友上傳成績！',
                'global' => '還沒有玩家上傳過成績，來玩一把？',
                'loading' => '加載分數中...',
                'unranked' => 'Unranked 譜面',
            ],
            'score' => [
                'first' => '領銜者',
                'own' => '你的最佳成績',
            ],
        ],
    ],
];

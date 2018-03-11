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
        'disabled' => '该谱面现在无法下载。',
        'parts-removed' => '应作者/第三方版权持有者的要求，这张谱面已经下架。',
        'more-info' => '点击这里查看更多信息。',
    ],

    'index' => [
         'title' => '谱面列表',
         'guest_title' => '谱面',
     ],

    'show' => [
        'discussion' => '讨论',

        'details' => [
            'made-by' => '作者: ',
            'submitted' => '提交于 ',
            'updated' => '上次更新于 ',
            'ranked' => 'ranked 于 ',
            'approved' => 'approved 于 ',
            'qualified' => 'qualified 于 ',
            'loved' => 'loved 于 ',
            'logged-out' => '下载谱面前请先登录！',
            'download' => [
                '_' => '下载',
                'video' => '带视频',
                'no-video' => '不带视频',
                'direct' => 'osu!direct',
            ],
            'favourite' => '收藏这张谱面',
            'unfavourite' => '取消收藏',
            'favourited_count' => '还有很多人...',
        ],
        'stats' => [
            'cs' => '缩圈大小',
            'cs-mania' => '键位数量',
            'drain' => '掉血速度',
            'accuracy' => '准确率',
            'ar' => '缩圈速度',
            'stars' => '难度星级',
            'total_length' => '长度',
            'bpm' => 'BPM',
            'count_circles' => '圆圈总数',
            'count_sliders' => '滑条总数',
            'user-rating' => '玩家评价',
            'rating-spread' => '评分情况',
        ],
        'info' => [
            'description' => '介绍',
            'genre' => '流派',
            'language' => '语言',
            'no_scores' => 'Unranked 谱面',
            'points-of-failure' => '失败位置',
            'source' => '来源',
            'success-rate' => '成功率',
            'tags' => '标签',
        ],
        'scoreboard' => [
            'achieved' => '在 :when 达成',
            'country' => '国内排名',
            'friend' => '好友排名',
            'global' => '全球排名',
            'miss_count' => ':count miss', //上下文
            'supporter-link' => '点击 <a href=":link">这里</a> 来查看你可以得到的精彩功能！',
            'supporter-only' => '你需要成为支持者才能查看国内/好友排名！',
            'title' => '排行榜',

            'headers' => [
                'accuracy' => '准确率',
                'combo' => '最大连击',
                'miss' => 'Miss',
                'mods' => 'Mods',
                'player' => '玩家',
                'pp' => 'pp',
                'rank' => '排名',
                'score_total' => '得分',
                'score' => '得分',
            ],

            'no_scores' => [
                'country' => '还没有玩家上传过成绩！',
                'friend' => '还没有好友上传成绩！',
                'global' => '还没有玩家上传过成绩，来玩一把？',
                'loading' => '加载分数中...',
                'unranked' => 'Unranked 谱面',
            ],
            'score' => [
                'first' => '领衔者',
                'own' => '你的最佳成绩',
            ],
        ],
    ],
];

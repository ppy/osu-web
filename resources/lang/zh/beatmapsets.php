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
        'disabled' => '这张谱面现在不能下载。',
        'parts-removed' => '由于作者/第三方版权持有者的要求，因此这张谱面已经被移除。', //可能不准确
        'more-info' => '点击这里获得更多信息。',
    ],

    'index' => [
         'title' => '谱面列表',
         'guest_title' => '谱面',
     ],

    'show' => [
        'discussion' => '讨论',

        'details' => [ //TODO 需要帮助
            'made-by' => '制作者: ',
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
            'no_scores' => 'Unranked 谱面',
            'points-of-failure' => '失败位置',
            'success-rate' => '成功率',

            'description' => '介绍',

            'source' => '来源',
            'tags' => '标签',
        ],
        'scoreboard' => [
            'achieved' => '达成于 :when',
            'country' => '国内排名',
            'friend' => '好友排名',
            'global' => '全球排名',
            'supporter-link' => '点击 <a href=":link">这里</a> 来查看你可以得到的精彩功能！',
            'supporter-only' => '你需要成为支持者才能查看国内/好友排名！',
            'title' => '成绩板',

            'list' => [
                'accuracy' => '准确率',
                'player-header' => '玩家',
                'rank-header' => '排名',
                'score' => '得分',
            ],
            'no_scores' => [
                'country' => '国内还没有人在这张谱面上得分！',
                'friend' => '您的好友中还没有人在这张谱面上得分！',
                'global' => '还没有人在这张谱面上得分，或许您可以试一试？',
                'loading' => '加载分数中...',
                'unranked' => 'Unranked谱面',
            ],
            'score' => [
                'first' => '领先者',
                'own' => '你的最佳成绩',
            ],
            'stats' => [
                'accuracy' => '准确率',
                'score' => '得分',
            ],
        ],
    ],
];

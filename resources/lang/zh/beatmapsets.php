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
        'disabled' => '该谱面现在无法下载。',
        'parts-removed' => '应 歌曲作者/第三方版权持有者 的要求，这张谱面已经下架。',
        'more-info' => '点击这里查看更多信息。',
    ],

    'index' => [
        'title' => '谱面列表',
        'guest_title' => '谱面',
    ],

    'show' => [
        'discussion' => '讨论',

        'details' => [
            'favourite' => '收藏这张谱面',
            'logged-out' => '下载谱面前请先登录！',
            'mapped_by' => '作者: :mapper',
            'unfavourite' => '取消收藏',
            'updated_timeago' => '上次更新于 :timeago',

            'download' => [
                '_' => '下载',
                'direct' => 'osu!direct',
                'no-video' => '不包含视频',
                'video' => '包含视频',
            ],

            'login_required' => [
                'bottom' => '以使用更多的功能',
                'top' => '登录',
            ],
        ],

        'favourites' => [
            'limit_reached' => '谱面收藏数超出限制，请删除一些后再试。',
        ],

        'hype' => [
            'action' => '如果你觉得这张谱面很好玩，推荐它来帮助它发展到<strong>Ranked</strong>状态。',

            'current' => [
                '_' => '这张谱面正处于 :status 状态。',

                'status' => [
                    'pending' => 'pending',
                    'qualified' => 'qualified',
                    'wip' => '制作中',
                ],
            ],

            'disqualify' => [
                '_' => '如果你认为此谱面有问题，可以取消提名：:link',
                'button_title' => '取消提名已被Qualified的图',
            ],

            'report' => [
                '_' => '如果您发现此谱面有问题，请在 :link 通知审核团。',
                'button' => '报告问题',
                'button_title' => '在合格的节拍图上报告问题。',
                'link' => '这里',
            ],
        ],

        'info' => [
            'description' => '谱面介绍',
            'genre' => '流派',
            'language' => '语言',
            'no_scores' => '数据还在计算中。。。',
            'points-of-failure' => '失败位置',
            'source' => '来源',
            'success-rate' => '成功率',
            'tags' => '标签',
            'unranked' => 'Unranked 谱面',
        ],

        'scoreboard' => [
            'achieved' => '在 :when 达成',
            'country' => '国内排名',
            'friend' => '好友排名',
            'global' => '全球排名',
            'supporter-link' => '点击 <a href=":link">这里</a> 来查看你得到的精彩功能！',
            'supporter-only' => '你需要成为 osu! 支持者才能查看国内/好友排名！',
            'title' => '排行榜',

            'headers' => [
                'accuracy' => '准确率',
                'combo' => '最大连击',
                'miss' => 'Miss',
                'mods' => 'Mod',
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

        'stats' => [
            'cs' => '圆圈大小',
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
            'nominations' => '提名状态',
            'playcount' => '游玩次数',
        ],

        'status' => [
            'ranked' => 'Ranked',
            'approved' => 'Approved',
            'loved' => 'Loved',
            'qualified' => 'Qualified',
            'wip' => 'WIP',
            'pending' => 'Pending',
            'graveyard' => 'Graveyard',
        ],
    ],
];

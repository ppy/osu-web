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
    'discussion-posts' => [
        'store' => [
            'error' => '保存失败',
        ],
    ],

    'discussion-votes' => [
        'update' => [
            'error' => '更新投票失败',
        ],
    ],

    'discussions' => [
        'allow_kudosu' => '允许kudosu', //可能不准确
        'delete' => '删除',
        'deleted' => '被 :editor 于 :delete_time 删除',
        'deny_kudosu' => '禁止kudosu', //可能不准确
        'edit' => '编辑',
        'edited' => '最后由 :editor 于 :update_time 编辑',
        'message_placeholder' => 'Type here to post',
        'message_type_select' => '选择回复类型',
        'reply_placeholder' => 'Type your response here', //需要上下文
        'require-login' => '请先登录再发表',
        'resolved' => '已解决',
        'restore' => '已修复',
        'title' => '讨论',

        'collapse' => [
            'all-collapse' => '全部折叠',
            'all-expand' => '全部展开',
        ],

        'empty' => [
            'empty' => '还没有讨论!',
            'hidden' => '没有符合条件的讨论.',
        ],

        'message_hint' => [
            'in_general' => '这个信息将提交到整个谱面.如果您想单独针对某处,请在开头使用时间戳(例子: 00:12:345).', //可能不准确
            'in_timeline' => 'To mod multiple timestamps, post multiple times (one post per timestamp).', //TODO 需要帮助
        ],

        'message_type' => [
            'praise' => '赞',
            'problem' => '问题',
            'suggestion' => '建议',
        ],

        'mode' => [
            'general' => 'General', //不好翻译
            'timeline' => '时间线',
        ],

        'new' => [
            'timestamp' => '时间戳',
            'timestamp_missing' => '在编辑模式下按Ctrl+C然后在您的信息中粘贴以添加时间戳!',
            'title' => '新的讨论',
        ],

        'show' => [
            'title' => ':title mapped by :mapper', //TODO 需要帮助
        ],

        'stats' => [
            'deleted' => '已删除',
            'mine' => '我的',
            'pending' => 'Pending', //TODO 需要帮助
            'praises' => '赞',
            'resolved' => '已解决',
            'total' => 'Total', //TODO 需要帮助
        ],
    ],

    'nominations' => [ //TODO 需要帮助
        'disqualifed-at' => 'disqualified :time_ago (:reason).',
        'disqualifed_no_reason' => '没有指定原因',
        'disqualification-prompt' => 'Reason for disqualification?',
        'disqualify' => 'Disqualify',
        'incorrect-state' => 'Error performing that action, try refreshing the page.',
        'nominate' => 'Nominate',
        'nominate-confirm' => 'Nominate this beatmap?',
        'qualified' => 'Estimated to be ranked :date, if no issues are found.',
        'qualified-soon' => 'Estimated to be ranked soon, if no issues are found.',
        'required-text' => 'Nominations: :current/:required',
        'title' => 'Nomination Status',
    ],

    'listing' => [
        'search' => [
            'prompt' => '输入关键字',
            'options' => '更多搜索选项',
            'not-found' => '没有结果',
            'not-found-quote' => '... 呃,什么也没有.',
        ],
        'mode' => '模式',
        'status' => 'Rank 状态',
        'mapped-by' => '制谱人: :mapper', //可能不准确
        'source' => '来自 :source',
        'load-more' => '加载更多...',
    ],
    'beatmapset' => [
        'availability' => [
            'disabled' => '这张谱面现在不能下载',
            'parts-removed' => '根据作者/第三方的要求,这张谱面已经被移除.', //可能不准确
            'more-info' => '点击这里获得更多信息.',
        ],
        'show' => [
            'discussion' => '讨论',

            'details' => [ //TODO 需要帮助
                'made-by' => '制谱人: ',
                'submitted' => '提交于 ',
                'updated' => '上次更新于 ',
                'ranked' => 'ranked on ',
                'approved' => 'approved on ',
                'qualified' => 'qualified on ',
                'loved' => 'loved on ',
                'logged-out' => '下载谱面前请先登录!',
                'download' => [
                    '_' => '下载',
                    'video' => '带视频',
                    'no-video' => '不带视频',
                    'direct' => 'osu!direct',
                ],
                'favourite' => '收藏这张谱面',
                'unfavourite' => '取消收藏',
            ],
            'stats' => [ //TODO 需要帮助
                'cs' => 'Circle Size',
                'cs-mania' => 'Key Amount',
                'drain' => 'HP Drain',
                'accuracy' => 'Accuracy',
                'ar' => 'Approach Rate',
                'stars' => 'Star Difficulty',
                'total_length' => 'Length',
                'bpm' => 'BPM',
                'count_circles' => 'Circle Count',
                'count_sliders' => 'Slider Count',
                'user-rating' => 'User Rating',
                'rating-spread' => 'Rating Spread',
            ],
            'info' => [
                'success-rate' => '成功率',
                'points-of-failure' => '失败位置',

                'description' => '介绍',

                'source' => '来源',
                'tags' => '标签',
            ],
            'scoreboard' => [
                'achieved' => '达成于 :when',
                'country' => '国内排名',
                'friend' => '好友排名',
                'global' => '全球排名',
                'supporter-link' => '点击 <a href=":link">这里</a> 查看你得到的所有特性吧!',
                'supporter-only' => '你需要成为支持者才能查看国内/好友排名!',
                'title' => '得分板',

                'list' => [
                    'accuracy' => '准确率',
                    'player-header' => '玩家',
                    'rank-header' => '排名',
                    'score' => '得分',
                ],
                'no-scores' => [
                    'country' => '国内还没有人在这张谱面上得分!',
                    'friend' => '您的好友中还没有人在这张谱面上得分!',
                    'global' => '还没有人在这张谱面上得分,您或许可以试一试?',
                    'loading' => '加载分数中...',
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
    ],
    'mode' => [ //不翻译
        'any' => '任意',
        'osu' => 'osu!',
        'taiko' => 'osu!taiko',
        'fruits' => 'osu!catch',
        'mania' => 'osu!mania',
    ],
    'status' => [ //需要帮助
        'any' => '任意',
        'ranked-approved' => 'Ranked & Approved',
        'approved' => 'Approved',
        'loved' => '喜欢',
        'faves' => '收藏',
        'modreqs' => 'Mod Requests',
        'pending' => 'Pending',
        'graveyard' => 'Graveyard',
        'my-maps' => '我的',
    ],
    'genre' => [ //不翻译
        'any' => '任意',
        'unspecified' => 'Unspecified',
        'video-game' => 'Video Game',
        'anime' => 'Anime',
        'rock' => 'Rock',
        'pop' => 'Pop',
        'other' => '其他',
        'novelty' => 'Novelty',
        'hip-hop' => 'Hip Hop',
        'electronic' => 'Electronic',
    ],
    'mods' => [ //不翻译
        'NF' => 'No Fail',
        'EZ' => 'Easy Mode',
        'HD' => 'Hidden',
        'HR' => 'Hard Rock',
        'SD' => 'Sudden Death',
        'DT' => 'Double Time',
        'Relax' => 'Relax',
        'HT' => 'Half Time',
        'NC' => 'Nightcore',
        'FL' => 'Flashlight',
        'SO' => 'Spun Out',
        'AP' => 'Auto Pilot',
        'PF' => 'Perfect',
        '4K' => '4K',
        '5K' => '5K',
        '6K' => '6K',
        '7K' => '7K',
        '8K' => '8K',
        'FI' => 'Fade In',
        '9K' => '9K',
        'NM' => 'No mods',
    ],
    'language' => [
        'any' => '任意',
        'english' => '英语',
        'chinese' => '中文',
        'french' => '法语',
        'german' => '德语',
        'italian' => '意大利语',
        'japanese' => '日语',
        'korean' => '韩文',
        'spanish' => '西班牙语',
        'swedish' => '瑞典语',
        'instrumental' => '纯音乐',
        'other' => '其他',
    ],
    'extra' => [
        'video' => '有视频',
        'storyboard' => '有Storyboard', //osu!中没有翻译这个,所以保持原样
    ],
    'rank' => [
        'any' => '任意',
        'XH' => '银SS',
        'X' => 'SS',
        'SH' => '银S',
        'S' => 'S',
        'A' => 'A',
        'B' => 'B',
        'C' => 'C',
        'D' => 'D',
    ],
];

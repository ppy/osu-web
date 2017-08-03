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
        'allow_kudosu' => '给予 kudosu',
        'delete' => '删除',
        'deleted' => '被 :editor 于 :delete_time 删除',
        'deny_kudosu' => '收回 kudosu',
        'edit' => '编辑',
        'edited' => '最后由 :editor 于 :update_time 编辑',
        'message_placeholder' => '在这里输入您的内容',
        'message_type_select' => '选择回复类型',
        'reply_placeholder' => '在这里输入您的回复',
        'require-login' => '请先登录再发表',
        'resolved' => '已解决',
        'restore' => '已修复',
        'title' => '讨论',

        'collapse' => [
            'all-collapse' => '全部折叠',
            'all-expand' => '全部展开',
        ],

        'empty' => [
            'empty' => '还没有讨论！',
            'hidden' => '没有符合过滤条件的讨论。',
        ],

        'message_hint' => [
            'in_general' => '这个信息将提交到整个谱面讨论中。如果您想单独针对某处，请在开头使用时间戳 (例如: 00:12:345)。', //可能不准确
            'in_timeline' => '如果您想 mod 多处，就在每一个时间戳下写一次并发布。', //可能不准确，意译成分大，等看看Kwan那边的吧
        ],

        'message_type' => [
            'praise' => '赞',
            'problem' => '问题',
            'suggestion' => '建议',
        ],

        'mode' => [
            'general' => 'General', //不好翻译
            'general_all' => 'General (all difficulties)', //不好翻译
            'timeline' => '时间线',
        ],

        'new' => [
            'timestamp' => '时间戳',
            'timestamp_missing' => '在编辑模式下按 Ctrl+C 然后在您的输入框中粘贴以添加时间戳！',
            'title' => '新的讨论',
        ],

        'show' => [
            'title' => ':title 由 :mapper 制作',
        ],

        'stats' => [
            'deleted' => '已删除',
            'mine' => '我的',
            'pending' => 'Pending',
            'praises' => '赞',
            'resolved' => '已解决',
        ],
    ],

    'nominations' => [
        'disqualifed-at' => '于 :time_ago 被 DQ (:reason).', //disqualifed现在好像没有很合适的翻译，姑且先写作DQ了
        'disqualifed_no_reason' => '没有指定原因',
        'disqualification-prompt' => 'DQ 的理由？',
        'disqualify' => 'Disqualify',
        'incorrect-state' => '操作出错了，请刷新页面。',
        'nominate' => '提名',
        'nominate-confirm' => '提名这张谱面？',
        'qualified' => '如果没有问题，预计将于 :date 被 ranked.',
        'qualified-soon' => '如果没有问题，预计不久将被 ranked.',
        'required-text' => '提名数: :current/:required',
        'title' => '提名状态',
    ],

    'listing' => [
        'search' => [
            'prompt' => '输入关键字...',
            'options' => '更多搜索选项',
            'not-found' => '没有结果',
            'not-found-quote' => '呃,什么也没有...',
            'filters' => [
                'mode' => '模式',
                'status' => 'Rank 状态',
                'genre' => '流派',
                'language' => '语言',
                'extra' => '额外',
                'rank' => '已 Rank',
            ],
        ],
        'mode' => '模式',
        'status' => 'Rank 状态',
        'mapped-by' => '制谱人: :mapper', //可能不准确
        'source' => '来自 :source',
        'load-more' => '加载更多...',
    ],
    'mode' => [ //不翻译
        'any' => '所有',
        'osu' => 'osu!',
        'taiko' => 'osu!taiko',
        'fruits' => 'osu!catch',
        'mania' => 'osu!mania',
    ],
    'status' => [ //需要帮助
        'any' => '所有',
        'ranked-approved' => 'Ranked & Approved',
        'approved' => 'Approved',
        'loved' => 'Loved',
        'faves' => 'Favourites',
        'modreqs' => 'Mod Requests',
        'pending' => 'Pending',
        'graveyard' => 'Graveyard',
        'my-maps' => '我的',
    ],
    'genre' => [
        'any' => '所有',
        'unspecified' => '尚未指定',
        'video-game' => '电子游戏',
        'anime' => '动漫',
        'rock' => '摇滚',
        'pop' => '流行乐',
        'other' => '其他',
        'novelty' => '新奇',
        'hip-hop' => '嘻哈',
        'electronic' => '电子',
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
        'any' => '所有',
        'english' => '英语',
        'chinese' => '汉语',
        'french' => '法语',
        'german' => '德语',
        'italian' => '意大利语',
        'japanese' => '日语',
        'korean' => '韩语',
        'spanish' => '西班牙语',
        'swedish' => '瑞典语',
        'instrumental' => '器乐',
        'other' => '其他',
    ],
    'extra' => [
        'video' => '有视频',
        'storyboard' => '有 Storyboard', //osu!中没有翻译这个,所以保持原样
    ],
    'rank' => [
        'any' => '任意',
        'XH' => '白银 SS',
        'X' => 'SS',
        'SH' => '白银 S',
        'S' => 'S',
        'A' => 'A',
        'B' => 'B',
        'C' => 'C',
        'D' => 'D',
    ],
];

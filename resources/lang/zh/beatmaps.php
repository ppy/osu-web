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
        'deleted' => '被 :editor 于 :delete_time 删除。',
        'deny_kudosu' => '收回 kudosu',
        'edit' => '编辑',
        'edited' => '最后由 :editor 编辑于 :update_time 。',
        'kudosu_denied' => 'kudosu 被收回',
        'message_placeholder' => '在此处输入您的内容',
        'message_placeholder_deleted_beatmap' => '该难度已被删除，无法继续讨论',
        'message_type_select' => '选择回复类型',
        'reply_notice' => '按下回车以提交',
        'reply_placeholder' => '在此处输入您的回复',
        'require-login' => '登录以继续',
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
            'in_general' => '这个信息将提交到整个谱面讨论中。如果需要单独针对某处，请在开头使用时间戳 (例如: 00:12:345)。',
            'in_timeline' => '需要 Mod 多处，请在每一个时间戳后写下意见并发表。',
        ],

        'message_type' => [
            'hype' => '推荐！',
            'mapper_note' => '备注',
            'praise' => '赞',
            'problem' => '问题',
            'suggestion' => '建议',
        ],

        'mode' => [
            'events' => '历史',
            'general' => '常规',
            'general_all' => '常规（全难度）',
            'timeline' => '时间线',
        ],

        'new' => [
            'timestamp' => '时间戳',
            'timestamp_missing' => '在编辑模式下按 Ctrl+C 然后在您的输入框中粘贴以添加时间戳！',
            'title' => '新的讨论',
        ],

        'show' => [
            'title' => '由 :mapper 制作的 :title',
        ],

        'sort' => [
            '_' => '排序：',
            'created_at' => '创建时间',
            'timeline' => '时间轴',
            'updated_at' => '最后更新时间',
        ],

        'stats' => [
            'deleted' => '已删除',
            'mapper_notes' => '备注',
            'mine' => '我的',
            'pending' => 'Pending',
            'praises' => '赞',
            'resolved' => '已解决',
            'total' => '所有',
        ],

        'status-messages' => [
            'approved' => '这张谱面于 :date 被 Approved !',
            'graveyard' => '这张谱面自 :date 就未更新了，或许它已经被作者抛弃了 ;w;',
            'loved' => '这张谱面于 :date 被 Loved !',
            'ranked' => '这张谱面于 :date 被 Ranked !',
            'wip' => '注意：这张谱面被作者标记为 WIP（work-in-progress）',
        ],

    ],

    'hype' => [
        'button' => '推荐谱面！',
        'button_done' => '已经推荐！',
        'confirm' => '你确定吗？这将会使用你剩下的 :n 次推荐次数并且无法撤销。',
        'explanation' => '推荐这张谱面让它更容易被提名然后 ranked ！',
        'explanation_guest' => '登录并推荐这张谱面让它更容易被提名然后 ranked ！',
        'new_time' => '你将在 :new_time 后获得新的推荐次数。',
        'remaining' => '你还可以推荐 :remaining 次。',
        'required_text' => '推荐进度： :current/:required',
        'section_title' => '推荐进度',
        'title' => '推荐',
    ],

    'nominations' => [
        'disqualification_prompt' => 'DQ 的理由？',
        'disqualified_at' => '于 :time_ago 被 DQ （:reason）。', //disqualified现在好像没有很合适的翻译，姑且先写作DQ了
        'disqualified_no_reason' => '没有指定原因',
        'disqualify' => 'Disqualify',
        'incorrect_state' => '操作出错了，请刷新页面。',
        'nominate' => '提名',
        'nominate_confirm' => '提名这张谱面？',
        'nominated_by' => '被 :users 提名',
        'qualified' => '如果没有问题，预计将于 :date 被 Ranked 。',
        'qualified_soon' => '如果没有问题，预计不久将被 Ranked 。',
        'required_text' => '提名数: :current/:required',
        'reset_at' => '提名于 :time_ago 被新问题 :discussion 重置。',
        'reset_confirm' => '你确定吗？提出新的问题会重置提名。',
        'title' => '提名状态',
        'unresolved_issues' => '仍然有需解决的问题 。',
    ],

    'listing' => [
        'search' => [
            'prompt' => '输入关键字...',
            'options' => '更多搜索选项',
            'not-found' => '没有结果',
            'not-found-quote' => '呃，什么也没有...',
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
        'mapped-by' => '作者: :mapper',
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
        'qualified' => 'Qualified',
        'loved' => 'Loved',
        'faves' => 'Favourites',
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
        'storyboard' => '有 Storyboard',
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

<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'discussion-votes' => [
        'update' => [
            'error' => '更新投票失败',
        ],
    ],

    'discussions' => [
        'allow_kudosu' => '给予 kudosu',
        'beatmap_information' => '谱面信息页',
        'delete' => '删除',
        'deleted' => '被 :editor 于 :delete_time 删除。',
        'deny_kudosu' => '收回 kudosu',
        'edit' => '编辑',
        'edited' => '最后由 :editor 于 :update_time 编辑。',
        'guest' => ':user制作的客串难度',
        'kudosu_denied' => 'kudosu 被收回',
        'message_placeholder_deleted_beatmap' => '该难度已被删除，无法继续讨论',
        'message_placeholder_locked' => '该谱面下的讨论已关闭。',
        'message_placeholder_silenced' => "禁言时无法发布讨论。",
        'message_type_select' => '选择回复类型',
        'reply_notice' => '按下回车以提交',
        'reply_placeholder' => '在此处输入您的回复',
        'require-login' => '登录以继续',
        'resolved' => '已解决',
        'restore' => '已修复',
        'show_deleted' => '显示已删除的消息',
        'title' => '讨论',

        'collapse' => [
            'all-collapse' => '全部折叠',
            'all-expand' => '全部展开',
        ],

        'empty' => [
            'empty' => '还没有讨论！',
            'hidden' => '没有符合过滤条件的讨论。',
        ],

        'lock' => [
            'button' => [
                'lock' => '锁定该讨论',
                'unlock' => '解锁该讨论',
            ],

            'prompt' => [
                'lock' => '锁定讨论的原因',
                'unlock' => '确认解锁该讨论吗？',
            ],
        ],

        'message_hint' => [
            'in_general' => '这个信息将提交到整个谱面集讨论中。如果需要单独针对某处，请在开头使用时间戳 (例如: 00:12:345)。',
            'in_timeline' => '需要 Mod 多处，请在每一个时间戳后写下意见并发表。',
        ],

        'message_placeholder' => [
            'general' => '在此处输入以发布到常规 (:version)',
            'generalAll' => '在此处输入以发布到常规 (所有难度)',
            'review' => '在此处输入以发布审阅',
            'timeline' => '在此处输入以发布到时间轴 (:version)',
        ],

        'message_type' => [
            'disqualify' => '取消提名',
            'hype' => '推荐！',
            'mapper_note' => '备注',
            'nomination_reset' => '取消提名',
            'praise' => '赞',
            'problem' => '问题',
            'review' => '审核',
            'suggestion' => '建议',
        ],

        'mode' => [
            'events' => '历史',
            'general' => '常规 :scope',
            'reviews' => '审阅记录',
            'timeline' => '时间轴',
            'scopes' => [
                'general' => '当前难度',
                'generalAll' => '所有难度',
            ],
        ],

        'new' => [
            'pin' => '置顶',
            'timestamp' => '时间戳',
            'timestamp_missing' => '在编辑模式下按 Ctrl+C 然后在您的输入框中粘贴以添加时间戳！',
            'title' => '新的讨论',
            'unpin' => '取消置顶',
        ],

        'review' => [
            'new' => '新的审阅',
            'embed' => [
                'delete' => '删除',
                'missing' => '[该讨论已删除]',
                'unlink' => '取消链接',
                'unsaved' => '尚未保存',
                'timestamp' => [
                    'all-diff' => '你不能在“所有难度”中发布时间戳。',
                    'diff' => '如果此 :type 以时间戳开头，它将显示在时间轴下。',
                ],
            ],
            'insert-block' => [
                'paragraph' => '插入段落',
                'praise' => '插入赞',
                'problem' => '插入问题',
                'suggestion' => '加入建议',
            ],
        ],

        'show' => [
            'title' => '由 :mapper 制作的 :title',
        ],

        'sort' => [
            'created_at' => '创建时间',
            'timeline' => '时间轴',
            'updated_at' => '最后更新时间',
        ],

        'stats' => [
            'deleted' => '已删除',
            'mapper_notes' => '备注',
            'mine' => '我的',
            'pending' => '待处理',
            'praises' => '赞',
            'resolved' => '已解决',
            'total' => '所有',
        ],

        'status-messages' => [
            'approved' => '这张谱面于 :date 被 Approved !',
            'graveyard' => "这张谱面自 :date 就未更新了，或许它已经被作者抛弃了 ;w;",
            'loved' => '这张谱面于 :date 被 Loved !',
            'ranked' => '这张谱面于 :date 被 Ranked !',
            'wip' => '注意：这张谱面被作者标记为 WIP（work-in-progress）',
        ],

        'votes' => [
            'none' => [
                'down' => '还没有差评',
                'up' => '还没有好评',
            ],
            'latest' => [
                'down' => '最新差评',
                'up' => '最新好评',
            ],
        ],
    ],

    'hype' => [
        'button' => '推荐谱面！',
        'button_done' => '已经推荐！',
        'confirm' => "你确定吗？这将会使用你剩下的 :n 次推荐次数并且无法撤销。",
        'explanation' => '推荐这张谱面让它更容易收到提名然后 ranked！',
        'explanation_guest' => '登录并推荐这张谱面让它更容易收到提名然后 ranked！',
        'new_time' => "你将在 :new_time 获得新的推荐次数。",
        'remaining' => '你还可以推荐 :remaining 次。',
        'required_text' => '推荐进度： :current/:required',
        'section_title' => '推荐进度',
        'title' => '推荐',
    ],

    'feedback' => [
        'button' => '留下建议',
    ],

    'nominations' => [
        'delete' => '删除',
        'delete_own_confirm' => '你确定要删除吗？删除后你将回到个人资料页。',
        'delete_other_confirm' => '你确定要删除吗？删除后你将回到他的个人资料页。',
        'disqualification_prompt' => '认为不合格(DQ)的理由？',
        'disqualified_at' => '于 :time_ago 被 DQ （:reason）。',
        'disqualified_no_reason' => '没有指定原因',
        'disqualify' => 'Disqualify',
        'incorrect_state' => '操作出错了，请刷新页面。',
        'love' => '喜欢',
        'love_choose' => '选择要提名 Loved 的难度',
        'love_confirm' => '喜欢这张谱面吗？',
        'nominate' => '提名',
        'nominate_confirm' => '提名这张谱面？',
        'nominated_by' => '由 :users 提名',
        'not_enough_hype' => "没有足够的推荐。",
        'remove_from_loved' => '从 Loved 中移除',
        'remove_from_loved_prompt' => '从 Loved 中移除的原因：',
        'required_text' => '提名数: :current/:required',
        'reset_message_deleted' => '已删除',
        'title' => '提名状态',
        'unresolved_issues' => '仍然有需解决的问题 。',

        'rank_estimate' => [
            '_' => '如果没有问题，该谱面将于 :date ranked。位于 :queue 中的第 :position 位。',
            'queue' => 'ranking 队列',
            'soon' => '不久后',
        ],

        'reset_at' => [
            'nomination_reset' => '由于 :user 提出的新问题 :discussion（:message），提名过程于 :time_ago 被重置。',
            'disqualify' => ':time_ago 被 :user 因为新问题 :discussion (:message) 而 DQ.',
        ],

        'reset_confirm' => [
            'nomination_reset' => '你确定吗？提出新的问题会重置提名。',
            'disqualify' => '你确定吗？这将 DQ 该谱面并重置提名。',
        ],
    ],

    'listing' => [
        'search' => [
            'prompt' => '输入关键字...',
            'login_required' => '登录以搜索。',
            'options' => '更多搜索选项',
            'supporter_filter' => '需要成为支持者才能按 :filters 筛选',
            'not-found' => '没有结果',
            'not-found-quote' => '呃，什么也没有...',
            'filters' => [
                'extra' => '其他',
                'general' => '常规',
                'genre' => '流派',
                'language' => '语言',
                'mode' => '模式',
                'nsfw' => '少儿不宜谱面',
                'played' => '玩过',
                'rank' => '成绩',
                'status' => '分类',
            ],
            'sorting' => [
                'title' => '标题',
                'artist' => '艺术家',
                'difficulty' => '难度',
                'favourites' => '收藏量',
                'updated' => '已更新',
                'ranked' => 'Ranked 时间',
                'rating' => '评分',
                'plays' => '游玩次数',
                'relevance' => '相关性',
                'nominations' => '提名状态',
            ],
            'supporter_filter_quote' => [
                '_' => '需要成为 :link 才能按 :filters 筛选',
                'link_text' => '支持者',
            ],
        ],
    ],
    'general' => [
        'converts' => '包括转谱',
        'featured_artists' => '精选艺术家',
        'follows' => '已关注谱师',
        'recommended' => '推荐难度',
    ],
    'mode' => [
        'all' => '全部',
        'any' => '所有',
        'osu' => '',
        'taiko' => '',
        'fruits' => '',
        'mania' => '',
    ],
    'status' => [
        'any' => '所有',
        'approved' => 'Approved',
        'favourites' => '收藏夹',
        'graveyard' => '坟图',
        'leaderboard' => '计入排名',
        'loved' => 'Loved',
        'mine' => '我的谱面',
        'pending' => 'Pending & WIP',
        'qualified' => 'Qualified',
        'ranked' => 'Ranked',
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
        'metal' => '金属',
        'classical' => '古典',
        'folk' => '民谣',
        'jazz' => '爵士',
    ],
    'mods' => [
        '4K' => '',
        '5K' => '',
        '6K' => '',
        '7K' => '',
        '8K' => '',
        '9K' => '',
        'AP' => '',
        'DT' => '',
        'EZ' => '',
        'FI' => '',
        'FL' => '',
        'HD' => '',
        'HR' => '',
        'HT' => '',
        'MR' => '',
        'NC' => '',
        'NF' => '',
        'NM' => '',
        'PF' => '',
        'RX' => '',
        'SD' => '',
        'SO' => '',
        'TD' => '',
        'V2' => '',
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
        'russian' => '俄语',
        'polish' => '波兰语',
        'instrumental' => '器乐',
        'other' => '其他',
        'unspecified' => '未指定',
    ],

    'nsfw' => [
        'exclude' => '隐藏',
        'include' => '显示',
    ],

    'played' => [
        'any' => '任意',
        'played' => '玩过',
        'unplayed' => '没玩过',
    ],
    'extra' => [
        'video' => '有视频',
        'storyboard' => '有故事板',
    ],
    'rank' => [
        'any' => '任意',
        'XH' => '银 SS',
        'X' => '',
        'SH' => '银 S',
        'S' => '',
        'A' => '',
        'B' => '',
        'C' => '',
        'D' => '',
    ],
    'panel' => [
        'playcount' => '游戏次数：:count',
        'favourites' => '收藏次数：:count',
    ],
    'variant' => [
        'mania' => [
            '4k' => '4K',
            '7k' => '7K',
            'all' => '全部',
        ],
    ],
];

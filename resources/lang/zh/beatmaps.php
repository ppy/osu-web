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
        'deleted' => ':editor 在 :delete_time 删除。',
        'deny_kudosu' => '收回 kudosu',
        'edit' => '编辑',
        'edited' => ':editor 最后在 :update_time 编辑。',
        'guest' => ':user 制作的客串难度',
        'kudosu_denied' => 'kudosu 已收回',
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
            'in_general' => '这个问题将提交至常规（所有难度）的讨论区。如果想摸单个难度，请在问题描述开头添加时间戳（例如 00:12:345）。',
            'in_timeline' => '若需要提供多个地方的摸，请在每个时间戳下发表提出的问题或建议。',
        ],

        'message_placeholder' => [
            'general' => '在此处输入以发布到常规 (:version)',
            'generalAll' => '在此处输入以发布到常规 (所有难度)',
            'review' => '在此处输入以发布审阅',
            'timeline' => '在此处输入以发布到时间轴 (:version)',
        ],

        'message_type' => [
            'disqualify' => '下架 (DQ)',
            'hype' => '推荐！',
            'mapper_note' => '备注',
            'nomination_reset' => '重置提名流程',
            'praise' => '赞',
            'problem' => '问题',
            'problem_warning' => '报告问题',
            'review' => '审阅',
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
                    'all-diff' => '你不能在“所有难度”讨论区中发布时间戳。',
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
            'title' => ':mapper 制作的 :title',
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
            'approved' => '谱面已在 :date 达标 (Approved)！',
            'graveyard' => "这张谱面自 :date 就未更新了，或许它已经被作者抛弃了 ;w;",
            'loved' => '谱面已在 :date 进入社区喜爱 (Loved)！',
            'ranked' => '谱面已在 :date 上架 (Ranked)！',
            'wip' => '注意：作者标记这张谱面为待更新 (WIP) 状态。',
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
        'explanation' => '推荐这张谱面，让它更容易收到提名并上架 (Ranked)！',
        'explanation_guest' => '登录并推荐这张谱面，让它更容易收到提名并上架 (Ranked)！',
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
        'disqualification_prompt' => '认为谱面应下架 (DQ) 处理的理由？',
        'disqualified_at' => ':time_ago 下架 (:reason)。',
        'disqualified_no_reason' => '没有指定原因',
        'disqualify' => '下架 (DQ)',
        'incorrect_state' => '操作出错了，请刷新页面。',
        'love' => '社区喜爱 (Loved)',
        'love_choose' => '选择要移入社区喜爱 (Loved) 状态的难度',
        'love_confirm' => '喜欢这张谱面吗？',
        'nominate' => '提名',
        'nominate_confirm' => '提名这张谱面？',
        'nominated_by' => ':users 提名',
        'not_enough_hype' => "没有足够的推荐。",
        'remove_from_loved' => '从社区喜爱 (Loved) 状态中移除',
        'remove_from_loved_prompt' => '从社区喜爱 (Loved) 状态中移除的原因：',
        'required_text' => '提名数：:current/:required',
        'reset_message_deleted' => '已删除',
        'title' => '提名状态',
        'unresolved_issues' => '请先解决谱面内未解决的问题。',

        'rank_estimate' => [
            '_' => '谱面正位于 :queue 中第 :position 位。如果没有问题，谱面将在 :date 上架 (Ranked)。',
            'queue' => '谱面上架队列',
            'soon' => '不久后',
        ],

        'reset_at' => [
            'nomination_reset' => '由于 :user 提出新问题 :discussion (:message)，提名过程在 :time_ago 重置。',
            'disqualify' => '由于 :user 提出新问题 :discussion (:message)，谱面在 :time_ago 下架 (DQ)。',
        ],

        'reset_confirm' => [
            'disqualify' => '你确定吗？这将下架 (DQ) 谱面，并重置谱面提名过程。',
            'nomination_reset' => '你确定吗？提出新的问题，将会重置谱面提名流程。',
            'problem_warning' => '你确定要报告这张谱面上的问题吗？这将提醒谱面审核成员 (BN)。',
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
                'nsfw' => '不良内容',
                'played' => '玩过',
                'rank' => '成绩',
                'status' => '分类',
            ],
            'sorting' => [
                'title' => '标题',
                'artist' => '艺术家',
                'difficulty' => '难度',
                'favourites' => '收藏量',
                'updated' => '更新时间',
                'ranked' => '上架 (Ranked) 时间',
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
        'spotlights' => '聚光灯谱面',
    ],
    'mode' => [
        'all' => '全部',
        'any' => '全部',
        'osu' => '',
        'taiko' => '',
        'fruits' => '',
        'mania' => '',
    ],
    'status' => [
        'any' => '全部',
        'approved' => '达标 (Approved)',
        'favourites' => '收藏',
        'graveyard' => '坟场 (Graveyard)',
        'leaderboard' => '拥有排行榜',
        'loved' => '社区喜爱 (Loved)',
        'mine' => '我做的谱面',
        'pending' => '待定 (Pending)',
        'wip' => '制作中 (WIP)',
        'qualified' => '过审 (Qualified)',
        'ranked' => '上架 (Ranked)',
    ],
    'genre' => [
        'any' => '全部',
        'unspecified' => '尚未指定',
        'video-game' => '电子游戏',
        'anime' => '动漫',
        'rock' => '摇滚',
        'pop' => '流行',
        'other' => '其他',
        'novelty' => '新奇',
        'hip-hop' => '嘻哈',
        'electronic' => '电子',
        'metal' => '金属',
        'classical' => '古典',
        'folk' => '民谣',
        'jazz' => '爵士',
    ],
    'language' => [
        'any' => '全部',
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
        'any' => '全部',
        'played' => '玩过',
        'unplayed' => '没玩过',
    ],
    'extra' => [
        'video' => '有视频',
        'storyboard' => '有故事板',
    ],
    'rank' => [
        'any' => '全部',
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

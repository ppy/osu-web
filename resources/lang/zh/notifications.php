<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'all_read' => '已经阅读所有通知！',
    'delete' => '删除 :type',
    'loading' => '加载未读通知…',
    'mark_read' => '清除 :type 类型的通知',
    'none' => '没有新通知',
    'see_all' => '显示所有通知',
    'see_channel' => '前往聊天',
    'verifying' => '请验证会话以查看通知',

    'filters' => [
        '_' => '所有',
        'user' => '个人资料',
        'beatmapset' => '谱面',
        'forum_topic' => '论坛',
        'news_post' => '新闻',
        'build' => '版本',
        'channel' => '聊天',
    ],

    'item' => [
        'beatmapset' => [
            '_' => '谱面',

            'beatmap_owner_change' => [
                '_' => '客串难度',
                'beatmap_owner_change' => '您现在是:title内:beatmap难度的作者
',
                'beatmap_owner_change_compact' => '您现在是谱面 :beatmap 的作者
',
            ],

            'beatmapset_discussion' => [
                '_' => '谱面讨论',
                'beatmapset_discussion_lock' => '谱面 :title 已被锁定以供讨论。',
                'beatmapset_discussion_lock_compact' => '评论被锁定',
                'beatmapset_discussion_post_new' => '用户 :username 在 :title 的谱面讨论中发布了新消息。',
                'beatmapset_discussion_post_new_empty' => ':username 发布了主题为“:title”新的帖子',
                'beatmapset_discussion_post_new_compact' => ':username 的新主题',
                'beatmapset_discussion_post_new_compact_empty' => ':username 发布了新的帖子',
                'beatmapset_discussion_review_new' => ':username 在《:title》上发表了新的审阅，问题：:problems，建议：:suggestions，赞：:praises',
                'beatmapset_discussion_review_new_compact' => ':username 发表了新的审阅，问题：:problems，建议：:suggestions，赞：:praises',
                'beatmapset_discussion_unlock' => '谱面 :title 已被解锁以供讨论。',
                'beatmapset_discussion_unlock_compact' => '评论已解锁',
            ],

            'beatmapset_problem' => [
                '_' => 'Qualified 谱面问题',
                'beatmapset_discussion_qualified_problem' => ':username 在 “:title” 下反馈：“:content”',
                'beatmapset_discussion_qualified_problem_empty' => ':username 在 “:title” 下反馈了问题',
                'beatmapset_discussion_qualified_problem_compact' => ':username 反馈如下：“:content”',
                'beatmapset_discussion_qualified_problem_compact_empty' => ':username 反馈了问题',
            ],

            'beatmapset_state' => [
                '_' => '谱面状态已改变',
                'beatmapset_disqualify' => '谱面 :title 被 :username 取消提名。',
                'beatmapset_disqualify_compact' => '谱面被取消资格',
                'beatmapset_love' => '谱面 :title 已经被 :username 推荐为 loved 。',
                'beatmapset_love_compact' => '谱面已被 Loved',
                'beatmapset_nominate' => '谱面 :title 被 :username 提名。',
                'beatmapset_nominate_compact' => '谱面被提名',
                'beatmapset_qualify' => '谱面 :title 已经得到足够数量的提名并进入到 ranking 队列。',
                'beatmapset_qualify_compact' => '谱面进入 Ranked 序列',
                'beatmapset_rank' => '":title" 已 Rank',
                'beatmapset_rank_compact' => '谱面已 Ranked',
                'beatmapset_remove_from_loved' => '谱面 :title 已被从 Loved 移除',
                'beatmapset_remove_from_loved_compact' => '谱面从 Loved 中移除',
                'beatmapset_reset_nominations' => ':username 提出的问题重置了谱面 :title 的提名过程 ',
                'beatmapset_reset_nominations_compact' => '提名被重置',
            ],

            'comment' => [
                '_' => '新评论',

                'comment_new' => ':username 在 ":title" 中评论道 ":content',
                'comment_new_compact' => ':username 评论道 ":content',
                'comment_reply' => ':username 回复了“:title”：“:content”',
                'comment_reply_compact' => ':username 回复了：“:content”',
            ],
        ],

        'channel' => [
            '_' => '聊天',

            'channel' => [
                '_' => '新消息',
                'pm' => [
                    'channel_message' => ':username 说 ":title"',
                    'channel_message_compact' => ':title',
                    'channel_message_group' => '由 :username',
                ],
            ],
        ],

        'build' => [
            '_' => '更新日志',

            'comment' => [
                '_' => '新评论',

                'comment_new' => ':username 在 ":title" 中评论道 ":content"',
                'comment_new_compact' => ':username 评论道 ":content"',
                'comment_reply' => ':username 回复了“:title”：“:content”',
                'comment_reply_compact' => ':username 回复了：“:content”',
            ],
        ],

        'news_post' => [
            '_' => '新闻',

            'comment' => [
                '_' => '新评论',

                'comment_new' => ':username 在 ":title" 中评论道 ":content',
                'comment_new_compact' => ':username 评论道 ":content"',
                'comment_reply' => ':username 回复了“:title”：“:content”',
                'comment_reply_compact' => ':username 回复了：“:content”',
            ],
        ],

        'forum_topic' => [
            '_' => '论坛主题',

            'forum_topic_reply' => [
                '_' => '论坛回复',
                'forum_topic_reply' => ':username 回复了主题“:title”',
                'forum_topic_reply_compact' => ':username 回复了',
            ],
        ],

        'legacy_pm' => [
            '_' => '旧论坛私信',

            'legacy_pm' => [
                '_' => '',
                'legacy_pm' => ':count_delimited 条未读消息',
            ],
        ],

        'user' => [
            'user_beatmapset_new' => [
                '_' => '新谱面',

                'user_beatmapset_new' => ':username 上传了标题为“:title”的新谱面',
                'user_beatmapset_new_compact' => '新谱面《:title》',
                'user_beatmapset_new_group' => ':username 的新谱面',
            ],
        ],

        'user_achievement' => [
            '_' => '奖章',

            'user_achievement_unlock' => [
                '_' => '新奖章',
                'user_achievement_unlock' => '解锁 ":title"！',
                'user_achievement_unlock_compact' => '您已解锁 ":title" 成就！',
                'user_achievement_unlock_group' => '奖章已解锁！',
            ],
        ],
    ],

    'mail' => [
        'beatmapset' => [
            'beatmap_owner_change' => [
                'beatmap_owner_change' => '您现在是:title的客串作者
',
            ],

            'beatmapset_discussion' => [
                'beatmapset_discussion_lock' => '谱面“:title”的讨论已被锁定',
                'beatmapset_discussion_post_new' => '谱面“:title”的讨论有新动态',
                'beatmapset_discussion_unlock' => '谱面“:title”的讨论已被解锁',
            ],

            'beatmapset_problem' => [
                'beatmapset_discussion_qualified_problem' => '谱面“:title”被反馈了一个新问题',
            ],

            'beatmapset_state' => [
                'beatmapset_disqualify' => '谱面 :title 已被 DQ',
                'beatmapset_love' => '谱面 :title 已被 Loved',
                'beatmapset_nominate' => '“:title”已被提名',
                'beatmapset_qualify' => '谱面 :title 已获得足够的提名，已进入 Ranked 流程',
                'beatmapset_rank' => '“:title”已被 ranked',
                'beatmapset_remove_from_loved' => '谱面 :title 已被从 Loved 移除',
                'beatmapset_reset_nominations' => '“:title”的提名被重置',
            ],

            'comment' => [
                'comment_new' => '谱面“:title”有新的评论',
            ],
        ],

        'channel' => [
            'channel' => [
                'pm' => '您收到了来自 :username 的新消息',
            ],
        ],

        'build' => [
            'comment' => [
                'comment_new' => '更新日志“:title”有新的评论',
            ],
        ],

        'news_post' => [
            'comment' => [
                'comment_new' => '新闻“:title”有新的评论',
            ],
        ],

        'forum_topic' => [
            'forum_topic_reply' => [
                'forum_topic_reply' => '主题“:title”有新的回复',
            ],
        ],

        'user' => [
            'user_achievement_unlock' => [
                'user_achievement_unlock' => ':username 解锁了新成就“:title”！',
                'user_achievement_unlock_self' => '您已解锁了新成就“:title”！',
            ],

            'user_beatmapset_new' => [
                'user_beatmapset_new' => ':username 创建了一张新谱面',
            ],
        ],
    ],
];

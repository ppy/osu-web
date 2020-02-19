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
    'all_read' => '已经阅读所有通知！',
    'mark_all_read' => '清除全部',
    'none' => '',
    'see_all' => '',

    'filters' => [
        '_' => '',
        'user' => '',
        'beatmapset' => '',
        'forum_topic' => '',
        'news_post' => '',
        'build' => '',
        'channel' => '',
    ],

    'item' => [
        'beatmapset' => [
            '_' => '谱面',

            'beatmapset_discussion' => [
                '_' => '谱面讨论',
                'beatmapset_discussion_lock' => '谱面 :title 已被锁定以供讨论。',
                'beatmapset_discussion_lock_compact' => '评论被锁定',
                'beatmapset_discussion_post_new' => '用户 :username 在 :title 的谱面讨论中发布了新消息。',
                'beatmapset_discussion_post_new_empty' => ':username 发布了主题为“:title”新的帖子',
                'beatmapset_discussion_post_new_compact' => ':username 的新主题',
                'beatmapset_discussion_post_new_compact_empty' => ':username 发布了新的帖子',
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
                '_' => '谱面状态已被改变',
                'beatmapset_disqualify' => '谱面 :title 被 :username 取消提名。',
                'beatmapset_disqualify_compact' => '谱面被取消资格',
                'beatmapset_love' => '谱面 :title 已经被 :username 推荐为 loved 。',
                'beatmapset_love_compact' => '谱面被提升至最爱',
                'beatmapset_nominate' => '谱面 :title 被 :username 提名。',
                'beatmapset_nominate_compact' => '谱面被提名',
                'beatmapset_qualify' => '谱面 :title 已经得到足够数量的提名并进入到 ranking 队列。',
                'beatmapset_qualify_compact' => '谱面进入 Ranked 序列',
                'beatmapset_rank' => '":title" 已 Rank',
                'beatmapset_rank_compact' => '谱面已 Ranked',
                'beatmapset_reset_nominations' => ':username 提出的问题重置了谱面 :title 的提名过程 ',
                'beatmapset_reset_nominations_compact' => '提名被重置',
            ],

            'comment' => [
                '_' => '新评论',

                'comment_new' => ':username 在 ":title" 中评论道 ":content',
                'comment_new_compact' => ':username 评论道 ":content',
            ],
        ],

        'channel' => [
            '_' => '聊天',

            'channel' => [
                '_' => '新消息',
                'pm' => [
                    'channel_message' => ':username 发表了 ":title"',
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
            ],
        ],

        'news_post' => [
            '_' => '新闻',

            'comment' => [
                '_' => '新评论',

                'comment_new' => ':username 在 ":title" 中评论道 ":content',
                'comment_new_compact' => ':username 评论道 ":content"',
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

        'user_achievement' => [
            '_' => '奖章',

            'user_achievement_unlock' => [
                '_' => '新奖章',
                'user_achievement_unlock' => '解锁 ":title"！',
                'user_achievement_unlock_compact' => '',
            ],
        ],
    ],
];

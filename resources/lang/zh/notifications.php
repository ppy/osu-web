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
    'message_multi' => '在 :title 中有 :count_delimited 个新消息。|在 :title 中有 :count_delimited 个新消息。',

    'item' => [
        'beatmapset' => [
            '_' => '谱面',

            'beatmapset_discussion' => [
                '_' => '谱面讨论',
                'beatmapset_discussion_lock' => '谱面 :title 已被锁定以供讨论。',
                'beatmapset_discussion_post_new' => '用户 :username 在 :title 的谱面讨论中发布了新消息。',
                'beatmapset_discussion_unlock' => '谱面 :title 已被解锁以供讨论。',
            ],

            'beatmapset_state' => [
                '_' => '谱面状态已被改变',
                'beatmapset_disqualify' => '谱面 :title 被 :username 取消提名。',
                'beatmapset_love' => '谱面 :title 已经被 :username 推荐为 loved 。',
                'beatmapset_nominate' => '谱面 :title 被 :username 提名。',
                'beatmapset_qualify' => '谱面 :title 已经得到足够数量的提名并进入到 ranking 队列。',
                'beatmapset_reset_nominations' => ':username 提出的问题重置了谱面 :title 的提名过程 ',
            ],
        ],

        'forum_topic' => [
            '_' => '论坛主题',

            'forum_topic_reply' => [
                '_' => '论坛回复',
                'forum_topic_reply' => ':username 回复了主题“:title”',
            ],
        ],

        'legacy_pm' => [
            '_' => '旧论坛私信',

            'legacy_pm' => [
                '_' => '',
                'legacy_pm' => ':count_delimited 条未读消息',
            ],
        ],
    ],
];

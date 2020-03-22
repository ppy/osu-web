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
    'all_read' => 'Tất cả các thông báo đã được đọc!',
    'mark_all_read' => 'Xoá tất cả',
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
            '_' => 'Beatmap',

            'beatmapset_discussion' => [
                '_' => 'Góc thảo luận beatmap',
                'beatmapset_discussion_lock' => 'Beatmap ":title" đã bị khóa để thảo luận.',
                'beatmapset_discussion_lock_compact' => 'Cuộc thảo luận đã được khóa',
                'beatmapset_discussion_post_new' => ':username đã đăng tin nhắn mới trong cuộc thảo luận beatmap ":title".',
                'beatmapset_discussion_post_new_empty' => '',
                'beatmapset_discussion_post_new_compact' => 'Bài đăng mới bởi :username',
                'beatmapset_discussion_post_new_compact_empty' => '',
                'beatmapset_discussion_unlock' => 'Cuộc thảo luận trên ":title" đã được mở khóa',
                'beatmapset_discussion_unlock_compact' => 'Cuộc thảo luận đã được mở khóa',
            ],

            'beatmapset_problem' => [
                '_' => '',
                'beatmapset_discussion_qualified_problem' => '',
                'beatmapset_discussion_qualified_problem_empty' => '',
                'beatmapset_discussion_qualified_problem_compact' => '',
                'beatmapset_discussion_qualified_problem_compact_empty' => '',
            ],

            'beatmapset_state' => [
                '_' => 'Trạng thái Beatmap đã thay đổi',
                'beatmapset_disqualify' => '":title" đã bị bỏ xếp hạng',
                'beatmapset_disqualify_compact' => 'Beatmap đã bị bỏ xếp hạng',
                'beatmapset_love' => '":title" đã được tiến vào danh mục Được yêu thích',
                'beatmapset_love_compact' => 'Beatmap đã được tiến vào danh mục Được yêu thích',
                'beatmapset_nominate' => '":title" đã được đề cử',
                'beatmapset_nominate_compact' => 'Beatmap đã được đề cử',
                'beatmapset_qualify' => '":title" đã nhận được đủ đề cử và tiến vào danh mục Được xếp hạng',
                'beatmapset_qualify_compact' => 'Beatmap đã được thêm vào hàng chờ xếp hạng',
                'beatmapset_rank' => '":title" đã được xếp hạng',
                'beatmapset_rank_compact' => 'Beatmap đã được xếp hạng',
                'beatmapset_reset_nominations' => '',
                'beatmapset_reset_nominations_compact' => '',
            ],

            'comment' => [
                '_' => 'Bình luận mới',

                'comment_new' => '',
                'comment_new_compact' => '',
            ],
        ],

        'channel' => [
            '_' => 'Chat',

            'channel' => [
                '_' => 'Tin nhắn mới',
                'pm' => [
                    'channel_message' => '',
                    'channel_message_compact' => ':title',
                    'channel_message_group' => 'từ :username',
                ],
            ],
        ],

        'build' => [
            '_' => 'Chi tiết thay đổi',

            'comment' => [
                '_' => 'Bình luận mới',

                'comment_new' => '',
                'comment_new_compact' => '',
            ],
        ],

        'news_post' => [
            '_' => 'Tin tức',

            'comment' => [
                '_' => 'Bình luận mới',

                'comment_new' => '',
                'comment_new_compact' => '',
            ],
        ],

        'forum_topic' => [
            '_' => 'Chủ đề của diễn đàn',

            'forum_topic_reply' => [
                '_' => 'Bình luận mới trên forum',
                'forum_topic_reply' => ':username đã trả lời ":title"',
                'forum_topic_reply_compact' => ':username đã trả lời',
            ],
        ],

        'legacy_pm' => [
            '_' => '',

            'legacy_pm' => [
                '_' => '',
                'legacy_pm' => ':count_delimited tin nhắn chưa đọc|:count_delimited tin nhắn chưa đọc',
            ],
        ],

        'user_achievement' => [
            '_' => 'Huy chương',

            'user_achievement_unlock' => [
                '_' => 'Huy chương mới',
                'user_achievement_unlock' => 'Đã mở khóa ":title"!',
                'user_achievement_unlock_compact' => '',
            ],
        ],
    ],
];

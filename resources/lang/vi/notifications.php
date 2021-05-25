<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'all_read' => 'Tất cả các thông báo đã được đọc!',
    'delete' => 'Xóa :type',
    'loading' => 'Đang tải thông báo chưa đọc...',
    'mark_read' => '',
    'none' => 'Không có thông báo nào',
    'see_all' => 'xem tất cả thông báo',
    'see_channel' => '',
    'verifying' => '',

    'filters' => [
        '_' => 'tất cả',
        'user' => 'trang cá nhân',
        'beatmapset' => 'beatmap',
        'forum_topic' => 'diễn đàn',
        'news_post' => 'tin tức',
        'build' => '',
        'channel' => 'chat',
    ],

    'item' => [
        'beatmapset' => [
            '_' => 'Beatmap',

            'beatmap_owner_change' => [
                '_' => '',
                'beatmap_owner_change' => '',
                'beatmap_owner_change_compact' => '',
            ],

            'beatmapset_discussion' => [
                '_' => 'Góc thảo luận beatmap',
                'beatmapset_discussion_lock' => 'Beatmap ":title" đã bị khóa để thảo luận.',
                'beatmapset_discussion_lock_compact' => 'Cuộc thảo luận đã được khóa',
                'beatmapset_discussion_post_new' => ':username đã đăng tin nhắn mới trong cuộc thảo luận beatmap ":title".',
                'beatmapset_discussion_post_new_empty' => 'Bài đăng mới trên ":title" bởi :username',
                'beatmapset_discussion_post_new_compact' => 'Bài đăng mới bởi :username',
                'beatmapset_discussion_post_new_compact_empty' => 'Bài đăng mới bởi :username',
                'beatmapset_discussion_review_new' => '',
                'beatmapset_discussion_review_new_compact' => '',
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
                'beatmapset_remove_from_loved' => '',
                'beatmapset_remove_from_loved_compact' => '',
                'beatmapset_reset_nominations' => '',
                'beatmapset_reset_nominations_compact' => '',
            ],

            'comment' => [
                '_' => 'Bình luận mới',

                'comment_new' => '',
                'comment_new_compact' => '',
                'comment_reply' => '',
                'comment_reply_compact' => '',
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
                'comment_reply' => '',
                'comment_reply_compact' => '',
            ],
        ],

        'news_post' => [
            '_' => 'Tin tức',

            'comment' => [
                '_' => 'Bình luận mới',

                'comment_new' => '',
                'comment_new_compact' => '',
                'comment_reply' => '',
                'comment_reply_compact' => '',
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

        'user' => [
            'user_beatmapset_new' => [
                '_' => '',

                'user_beatmapset_new' => '',
                'user_beatmapset_new_compact' => '',
                'user_beatmapset_new_group' => '',
            ],
        ],

        'user_achievement' => [
            '_' => 'Huy chương',

            'user_achievement_unlock' => [
                '_' => 'Huy chương mới',
                'user_achievement_unlock' => 'Đã mở khóa ":title"!',
                'user_achievement_unlock_compact' => 'Đã mở khóa ":title"!',
                'user_achievement_unlock_group' => 'Đã mở khóa huy hiệu!',
            ],
        ],
    ],

    'mail' => [
        'beatmapset' => [
            'beatmap_owner_change' => [
                'beatmap_owner_change' => '',
            ],

            'beatmapset_discussion' => [
                'beatmapset_discussion_lock' => '',
                'beatmapset_discussion_post_new' => '',
                'beatmapset_discussion_unlock' => '',
            ],

            'beatmapset_problem' => [
                'beatmapset_discussion_qualified_problem' => '',
            ],

            'beatmapset_state' => [
                'beatmapset_disqualify' => '',
                'beatmapset_love' => '',
                'beatmapset_nominate' => '',
                'beatmapset_qualify' => '',
                'beatmapset_rank' => '":title" đã được xếp hạng',
                'beatmapset_remove_from_loved' => '',
                'beatmapset_reset_nominations' => '',
            ],

            'comment' => [
                'comment_new' => '',
            ],
        ],

        'channel' => [
            'channel' => [
                'pm' => '',
            ],
        ],

        'build' => [
            'comment' => [
                'comment_new' => '',
            ],
        ],

        'news_post' => [
            'comment' => [
                'comment_new' => '',
            ],
        ],

        'forum_topic' => [
            'forum_topic_reply' => [
                'forum_topic_reply' => '',
            ],
        ],

        'user' => [
            'user_achievement_unlock' => [
                'user_achievement_unlock' => '',
                'user_achievement_unlock_self' => '',
            ],

            'user_beatmapset_new' => [
                'user_beatmapset_new' => '',
            ],
        ],
    ],
];

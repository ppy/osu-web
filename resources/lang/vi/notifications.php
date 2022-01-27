<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'all_read' => 'Tất cả các thông báo đã được đọc!',
    'delete' => 'Xóa :type',
    'loading' => 'Đang tải thông báo chưa đọc...',
    'mark_read' => 'Xóa :type',
    'none' => 'Không có thông báo nào',
    'see_all' => 'xem tất cả thông báo',
    'see_channel' => 'đi đến trò chuyện',
    'verifying' => 'Vui lòng xác minh phiên để xem thông báo',

    'filters' => [
        '_' => 'tất cả',
        'user' => 'trang cá nhân',
        'beatmapset' => 'beatmap',
        'forum_topic' => 'diễn đàn',
        'news_post' => 'tin tức',
        'build' => 'xây dựng',
        'channel' => 'chat',
    ],

    'item' => [
        'beatmapset' => [
            '_' => 'Beatmap',

            'beatmap_owner_change' => [
                '_' => 'Độ khó khách mời',
                'beatmap_owner_change' => 'Bây giờ bạn là chủ sở hữu độ khó ":beatmap" cho beatmap ":title"',
                'beatmap_owner_change_compact' => 'Bây giờ bạn là chủ sở hữu độ khó ":beatmap"',
            ],

            'beatmapset_discussion' => [
                '_' => 'Góc thảo luận beatmap',
                'beatmapset_discussion_lock' => 'Beatmap ":title" đã bị khóa để thảo luận.',
                'beatmapset_discussion_lock_compact' => 'Cuộc thảo luận đã được khóa',
                'beatmapset_discussion_post_new' => ':username đã đăng tin nhắn mới trong cuộc thảo luận beatmap ":title".',
                'beatmapset_discussion_post_new_empty' => 'Bài đăng mới trên ":title" bởi :username',
                'beatmapset_discussion_post_new_compact' => 'Bài đăng mới bởi :username',
                'beatmapset_discussion_post_new_compact_empty' => 'Bài đăng mới bởi :username',
                'beatmapset_discussion_review_new' => 'Đánh giá mời về ":title" bởi :username có vấn đề: :problems, gợi ý:
:suggestions, ca ngợi: :praises',
                'beatmapset_discussion_review_new_compact' => 'Đánh giá mới bởi :username có vấn đề: :problems, gợi ý: :suggestions, ca ngợi: :praises',
                'beatmapset_discussion_unlock' => 'Cuộc thảo luận trên ":title" đã được mở khóa',
                'beatmapset_discussion_unlock_compact' => 'Cuộc thảo luận đã được mở khóa',
            ],

            'beatmapset_problem' => [
                '_' => 'Vấn đề về beatmap đủ điều kiện',
                'beatmapset_discussion_qualified_problem' => 'Báo cáo bởi :username trên ":title": ":content"',
                'beatmapset_discussion_qualified_problem_empty' => 'Báo cáo bởi :username trên ":title"',
                'beatmapset_discussion_qualified_problem_compact' => 'Báo cáo bởi :username: ":content"',
                'beatmapset_discussion_qualified_problem_compact_empty' => 'Báo cáo bởi :username',
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
                'beatmapset_remove_from_loved' => '":title" đã bị xóa bởi Loved',
                'beatmapset_remove_from_loved_compact' => 'Beatmap đã bị xóa bởi Loved',
                'beatmapset_reset_nominations' => 'Đề cử cho ":title" đã được đặt lại',
                'beatmapset_reset_nominations_compact' => 'Đề cử đã đặt lại',
            ],

            'comment' => [
                '_' => 'Bình luận mới',

                'comment_new' => '":username" đã nhận xét:content trên:title',
                'comment_new_compact' => ':username đã nhận xét ":content"',
                'comment_reply' => ':username gửi lại ":content" trên ":title"',
                'comment_reply_compact' => ':username đã gửi lại ":content" ',
            ],
        ],

        'channel' => [
            '_' => 'Chat',

            'channel' => [
                '_' => 'Tin nhắn mới',
                'pm' => [
                    'channel_message' => ':username nói ":title"',
                    'channel_message_compact' => ':title',
                    'channel_message_group' => 'từ :username',
                ],
            ],
        ],

        'build' => [
            '_' => 'Chi tiết thay đổi',

            'comment' => [
                '_' => 'Bình luận mới',

                'comment_new' => ':username đã nhận xét ":content" trên ":title"',
                'comment_new_compact' => ':username đã nhận xét ":content"',
                'comment_reply' => ':username đã gửi lại ":content" trên ":title"',
                'comment_reply_compact' => ':username đã gửi lại ":content"',
            ],
        ],

        'news_post' => [
            '_' => 'Tin tức',

            'comment' => [
                '_' => 'Bình luận mới',

                'comment_new' => ':username đã trả lời ":content" trên ":title"',
                'comment_new_compact' => ':username đã trả lời ":content"',
                'comment_reply' => ':username đã gửi lại ":content" trên ":title"',
                'comment_reply_compact' => ':username đã gửi lại ":content"',
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
            '_' => 'Diễn đàn kế thừa PM',

            'legacy_pm' => [
                '_' => '',
                'legacy_pm' => ':count_delimited tin nhắn chưa đọc|:count_delimited tin nhắn chưa đọc',
            ],
        ],

        'user' => [
            'user_beatmapset_new' => [
                '_' => 'Beatmap mới',

                'user_beatmapset_new' => 'Beatmap mới ":title" bởi :username',
                'user_beatmapset_new_compact' => 'Beatmap mới ":title"',
                'user_beatmapset_new_group' => 'Beatmaps mới bởi :username',

                'user_beatmapset_revive' => '',
                'user_beatmapset_revive_compact' => '',
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
                'beatmap_owner_change' => 'Bạn hiện là khách của beatmap ":title"',
            ],

            'beatmapset_discussion' => [
                'beatmapset_discussion_lock' => 'Cuộc thảo luận về ":title" đã bị khóa',
                'beatmapset_discussion_post_new' => 'Cuộc thảo luận về ":title" đã có cập nhật mới',
                'beatmapset_discussion_unlock' => 'Cuộc thảo luận về ":title" đã mở khóa',
            ],

            'beatmapset_problem' => [
                'beatmapset_discussion_qualified_problem' => 'Một vấn đề mới đã được báo cáo về ":title"',
            ],

            'beatmapset_state' => [
                'beatmapset_disqualify' => '":title" đã bị loại',
                'beatmapset_love' => '":title" đã được thăng chức lên loved',
                'beatmapset_nominate' => '":title" đã được đề cử',
                'beatmapset_qualify' => '":title" đã đạt đủ đề cử và lọt vào hàng đợi xếp hạng',
                'beatmapset_rank' => '":title" đã được xếp hạng',
                'beatmapset_remove_from_loved' => '":title" đã bị xóa bởi Loved',
                'beatmapset_reset_nominations' => 'Đề cử cho ":title" đã được đặt lại',
            ],

            'comment' => [
                'comment_new' => 'Beatmap ":title" đã có bình luận mới',
            ],
        ],

        'channel' => [
            'channel' => [
                'pm' => 'Bạn đã nhận được một tin nhắn mới từ
:username',
            ],
        ],

        'build' => [
            'comment' => [
                'comment_new' => 'Nhật kí thay đổi ":title" đã có bình luận mới',
            ],
        ],

        'news_post' => [
            'comment' => [
                'comment_new' => 'Tin mới ":title" đã có bình luận mới',
            ],
        ],

        'forum_topic' => [
            'forum_topic_reply' => [
                'forum_topic_reply' => 'Có câu trả lời mới trong ":title"',
            ],
        ],

        'user' => [
            'user_achievement_unlock' => [
                'user_achievement_unlock' => ':username đã mở khóa một huy chương mới, ":title"!',
                'user_achievement_unlock_self' => 'Bạn đã mở khóa một huân chương mới, ":title"!',
            ],

            'user_beatmapset_new' => [
                'user_beatmapset_new' => ':username đã tạo beatmap mới',
            ],
        ],
    ],
];

<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'deleted' => '[người dùng đã bị xóa]',

    'beatmapset_activities' => [
        'title' => "Lịch Sử Modding Của :user",
        'title_compact' => 'Modding',

        'discussions' => [
            'title_recent' => 'Cuộc thảo luận gần đây',
        ],

        'events' => [
            'title_recent' => 'Sự kiện gần đây',
        ],

        'posts' => [
            'title_recent' => 'Bài đăng gần đây',
        ],

        'votes_received' => [
            'title_most' => 'Được upvote nhiều nhất bởi (3 tháng qua)',
        ],

        'votes_made' => [
            'title_most' => 'Upvote nhiều nhất (3 tháng qua)',
        ],
    ],

    'blocks' => [
        'banner_text' => 'Bạn đã chặn người dùng này.',
        'blocked_count' => 'người dùng đã bị chặn (:count)',
        'hide_profile' => 'Ẩn trang cá nhân',
        'not_blocked' => 'Người dùng này chưa bị chặn.',
        'show_profile' => 'Hiển thị trang cá nhân',
        'too_many' => 'Đã đạt giới hạn số người bị chặn.',
        'button' => [
            'block' => 'Chặn',
            'unblock' => 'Bỏ chặn',
        ],
    ],

    'card' => [
        'loading' => 'Đang tải...',
        'send_message' => 'Gửi tin nhắn',
    ],

    'disabled' => [
        'title' => 'Ôi không! Có vẻ tài khoản của bạn đã bị vô hiệu hóa.',
        'warning' => "",

        'if_mistake' => [
            '_' => '',
            'email' => 'email',
        ],

        'reasons' => [
            'compromised' => '',
            'opening' => '',

            'tos' => [
                '_' => '',
                'community_rules' => 'tiêu chuẩn cộng đồng',
                'tos' => 'điều khoản dịch vụ',
            ],
        ],
    ],

    'filtering' => [
        'by_game_mode' => 'Thành viên theo chế độ chơi',
    ],

    'force_reactivation' => [
        'reason' => [
            'inactive_different_country' => "Tài khoản của bạn đã không sử dụng trong một thời gian dài.",
        ],
    ],

    'login' => [
        '_' => 'Đăng nhập',
        'button' => 'Đăng nhập',
        'button_posting' => 'Đang đăng nhập...',
        'email_login_disabled' => 'Đăng nhập bằng email hiện đã bị vô hiệu. Vui lòng sử dụng tên người dùng để đăng nhập.',
        'failed' => 'Đăng nhập không chính xác',
        'forgot' => 'Quên mật khẩu?',
        'info' => 'Vui lòng đăng nhập để tiếp tục',
        'invalid_captcha' => 'Quá nhiều lần thử đăng nhập thất bại, vui lòng hoàn tất captcha và thử lại. (Làm mới trang nếu không thấy captcha)',
        'locked_ip' => 'Địa chỉ IP của bạn đã bị khóa. Vui lòng đợi một vài phút.',
        'password' => 'Mật khẩu',
        'register' => "Không có tài khoản osu!? Tạo một tài khoản mới",
        'remember' => 'Nhớ máy tính này',
        'title' => 'Vui lòng đăng nhập để tiếp tục',
        'username' => 'Tên tài khoản',

        'beta' => [
            'main' => 'Quyền truy cập bản thử nghiệm hiện bị hạn chế cho người dùng đặc quyền.',
            'small' => '(người ủng hộ sẽ sớm được tham gia)',
        ],
    ],

    'posts' => [
        'title' => 'Bài đăng của :username',
    ],

    'anonymous' => [
        'login_link' => 'nhấp để đăng nhập',
        'login_text' => 'đăng nhập',
        'username' => 'Khách',
        'error' => 'Bạn cần phải đăng nhập để làm việc này.',
    ],
    'logout_confirm' => 'Bạn có chắc muốn đăng xuất không? :(',
    'report' => [
        'button_text' => 'báo cáo',
        'comments' => 'Bình Luận Khác',
        'placeholder' => 'Vui lòng cung cấp bất kỳ thông tin nào bạn cho rằng có thể hữu ích.',
        'reason' => 'Lý Do',
        'thanks' => 'Cảm ơn bạn đã báo cáo!',
        'title' => 'Báo cáo :username?',

        'actions' => [
            'send' => 'Gửi Báo Cáo',
            'cancel' => 'Hủy',
        ],

        'options' => [
            'cheating' => 'Chơi xấu / Gian lận',
            'multiple_accounts' => 'Sử dụng nhiều tài khoản',
            'insults' => 'Xúc phạm tôi / những người khác',
            'spam' => 'Spamming',
            'unwanted_content' => 'Có những nội dung không phù hợp',
            'nonsense' => 'Phi lý',
            'other' => 'Khác (nhập dưới đây)',
        ],
    ],
    'restricted_banner' => [
        'title' => 'Tài khoản của bạn đã bị hạn chế!',
        'message' => 'Trong khi bị hạn chế, Bạn sẽ không thể tương tác với những người chơi khác và chỉ có bạn thấy được điểm của bạn. Đây thường là kết quả của một quá trình tự động và thường sẽ được gỡ bỏ trong vòng 24 giờ. Nếu bạn muốn kháng nghị về sự hạn chế này, vui lòng <a href="mailto:accounts@ppy.sh">liên hệ hỗ trợ</a>.',
    ],
    'show' => [
        'age' => ':age tuổi',
        'change_avatar' => 'đổi ảnh đại diện!',
        'first_members' => 'Ở đây kể từ khi bắt đầu',
        'is_developer' => 'osu!developer',
        'is_supporter' => 'osu!supporter',
        'joined_at' => 'Đã tham gia :date',
        'lastvisit' => 'Lần cuối hoạt động :date',
        'lastvisit_online' => 'Hiện đang trực tuyến',
        'missingtext' => 'Có thể bạn đã thực hiện một lỗi đánh máy! (hoặc người dùng này có thể đã bị ban)',
        'origin_country' => 'Từ :country',
        'previous_usernames' => 'được biết đến trước đây với',
        'plays_with' => 'Chơi bằng :devices',
        'title' => "Trang cá nhân của :username",

        'comments_count' => [
            '_' => 'Đã đăng :link',
            'count' => ':count_delimited bình luận|:count_delimited bình luận',
        ],
        'edit' => [
            'cover' => [
                'button' => 'Đổi Ảnh Bìa Trang Cá Nhân',
                'defaults_info' => 'Sẽ có thêm lựa chọn ảnh bìa trong tương lai',
                'upload' => [
                    'broken_file' => 'Không xử lý được hình ảnh. Kiểm tra hình ảnh đã tải lên và thử lại sau.',
                    'button' => 'Tải ảnh lên',
                    'dropzone' => 'Thả vào đây để tải lên',
                    'dropzone_info' => 'Bạn cũng có thể thả hình ảnh vào đây để tải lên',
                    'size_info' => 'Kích cỡ ảnh bìa nên là 2400x620',
                    'too_large' => 'Tệp đã tải lên quá lơn.',
                    'unsupported_format' => 'Định dạng không được hỗ trợ.',

                    'restriction_info' => [
                        '_' => 'Tải lên chỉ có sẵn cho :link',
                        'link' => 'osu!supporter',
                    ],
                ],
            ],

            'default_playmode' => [
                'is_default_tooltip' => 'chế độ chơi mặc định',
                'set' => 'đặt :mode làm chế độ chơi mặc định của trang cá nhân',
            ],
        ],

        'extra' => [
            'none' => 'không có',
            'unranked' => 'Không chơi gần đây',

            'achievements' => [
                'achieved-on' => 'Đạt được vào :date',
                'locked' => 'Đã khóa',
                'title' => 'Huy hiệu',
            ],
            'beatmaps' => [
                'by_artist' => 'bởi :artist',
                'title' => 'Beatmaps',

                'favourite' => [
                    'title' => 'Beatmap Yêu Thích',
                ],
                'graveyard' => [
                    'title' => 'Graveyarded Beatmaps',
                ],
                'loved' => [
                    'title' => 'Loved Beatmaps',
                ],
                'pending' => [
                    'title' => 'Beatmap Đang Chờ',
                ],
                'ranked' => [
                    'title' => 'Beatmap Được Xếp Hạng & Được Chấp Nhận',
                ],
            ],
            'discussions' => [
                'title' => 'Thảo luận',
                'title_longer' => 'Thảo luận gần đây',
                'show_more' => 'xem thảo luận khác',
            ],
            'events' => [
                'title' => 'Sự kiện',
                'title_longer' => 'Sự kiện gần đây',
                'show_more' => 'xem sự kiện khác',
            ],
            'historical' => [
                'title' => 'Lịch Sử',

                'monthly_playcounts' => [
                    'title' => 'Lịch Sử Chơi',
                    'count_label' => 'Lượt Chơi',
                ],
                'most_played' => [
                    'count' => 'số lần chơi',
                    'title' => 'Beatmap được chơi nhiều nhất',
                ],
                'recent_plays' => [
                    'accuracy' => 'độ chính xác: :percentage',
                    'title' => 'Những Lần Chơi Gần Đây (24h)',
                ],
                'replays_watched_counts' => [
                    'title' => 'Lịch Sử Replay Được Xem',
                    'count_label' => 'Replay Đã Xem',
                ],
            ],
            'kudosu' => [
                'recent_entries' => 'Lịch Sử Kudosu Gần Đây',
                'title' => 'Kudosu!',
                'total' => 'Tông Số Kudosu Nhận Được',

                'entry' => [
                    'amount' => ':amount kudosu',
                    'empty' => "Người dùng này chưa nhận kudosu nào!",

                    'beatmap_discussion' => [
                        'allow_kudosu' => [
                            'give' => 'Đã nhận :amount từ bãi bỏ sự từ chối kudosu của bài đăng modding :post',
                        ],

                        'deny_kudosu' => [
                            'reset' => 'Từ chối :amount từ bài đăng modding :post',
                        ],

                        'delete' => [
                            'reset' => 'Mất :amount từ bài đăng modding :post bị xóa',
                        ],

                        'restore' => [
                            'give' => 'Nhận được :amount từ bài đăng modding được phục hồi :post',
                        ],

                        'vote' => [
                            'give' => 'Nhận được :amount từ bài đăng modding :post được nhận upvote',
                            'reset' => 'Mất :amount từ bài đăng modding :post mất vote',
                        ],

                        'recalculate' => [
                            'give' => 'Nhận được :amount từ bài đăng modding :post được tính lại vote',
                            'reset' => 'Mất :amount từ bài đăng modding :post được tính lại vote',
                        ],
                    ],

                    'forum_post' => [
                        'give' => 'Nhận được :amount từ :giver cho một bài đăng tại :post',
                        'reset' => 'Kudosu reset bởi :giver cho bài đăng :post',
                        'revoke' => 'Từ chối kudosu kudosu :giver cho bài đăng :post',
                    ],
                ],

                'total_info' => [
                    '_' => 'Dựa trên bao nhiêu đóng góp mà người dùng cho việc điều phối beatmap. Xem :link để biết thêm thông tin.',
                    'link' => 'trang này',
                ],
            ],
            'me' => [
                'title' => 'tôi!',
            ],
            'medals' => [
                'empty' => "Người dùng này chưa có huy chương nào cả. ;_;",
                'recent' => 'Gần Nhất',
                'title' => 'Huy Chương',
            ],
            'multiplayer' => [
                'title' => '',
            ],
            'posts' => [
                'title' => 'Bài viết',
                'title_longer' => 'Bài viết gần đây',
                'show_more' => 'xem bài viết khác',
            ],
            'recent_activity' => [
                'title' => 'Gần Đây',
            ],
            'top_ranks' => [
                'download_replay' => 'Tải Xuống Replay',
                'not_ranked' => 'Chỉ có beatmap được xếp hạng mới có pp.',
                'pp_weight' => 'trọng số :percentage',
                'view_details' => 'Xem chi tiết',
                'title' => 'Xếp Hạng',

                'best' => [
                    'title' => 'Thực Hiện Tốt Nhất',
                ],
                'first' => [
                    'title' => 'Xếp Hạng Nhất',
                ],
            ],
            'votes' => [
                'given' => '',
                'received' => '',
                'title' => '',
                'title_longer' => '',
                'vote_count' => ':count_delimited bình chọn|:count_delimited bình chọn',
            ],
            'account_standing' => [
                'title' => 'Trạng Thái Tài Khoản',
                'bad_standing' => "Tài khoản của <strong>:username</strong> không ở trong trạng thái tốt :(",
                'remaining_silence' => '<strong>:username</strong> sẽ được nói trở lại vào :duration.',

                'recent_infringements' => [
                    'title' => 'Vi Phạm Gần Đây',
                    'date' => 'ngày',
                    'action' => 'hành động',
                    'length' => 'thời lượng',
                    'length_permanent' => 'vĩnh viễn',
                    'description' => 'mô tả',
                    'actor' => 'bởi :username',

                    'actions' => [
                        'restriction' => 'Ban',
                        'silence' => 'Im lặng',
                        'note' => 'Ghi chú',
                    ],
                ],
            ],
        ],

        'info' => [
            'discord' => '',
            'interests' => 'Sở Thích',
            'location' => 'Vị Trí Hiện Tại',
            'occupation' => 'Nghề Nghiệp',
            'twitter' => '',
            'website' => 'Website',
        ],
        'not_found' => [
            'reason_1' => 'Có thể họ đã đổi tên tài khoản.',
            'reason_2' => 'Tài khoản của họ có thể tạm thời không khả dụng vì vấn đề an ninh hoặc lạm dụng.',
            'reason_3' => 'Có thể bạn đã thực hiện một lỗi đánh máy!',
            'reason_header' => 'Có một vài lí do cho vấn đề này:',
            'title' => 'Không tìm thấy người dùng! ;_;',
        ],
        'page' => [
            'button' => 'Chỉnh sửa trang cá nhân',
            'description' => '<strong>tôi!</strong> là một khu vực cá nhân có thể tùy chỉnh trong trang cá nhân của bạn.',
            'edit_big' => 'Chỉnh sửa tôi!',
            'placeholder' => 'Nhập nội dung trang vào đây',

            'restriction_info' => [
                '_' => 'Bạn cần trở thành một :link để mở khoá tính năng này.',
                'link' => 'osu!supporter',
            ],
        ],
        'post_count' => [
            '_' => 'Đã đóng góp :link',
            'count' => ':count bài đăng forum',
        ],
        'rank' => [
            'country' => 'Hạng quốc gia cho :mode',
            'country_simple' => 'Hạng Quốc Gia',
            'global' => 'Hạng quốc tế cho :mode',
            'global_simple' => 'Hạng Toàn Cầu',
        ],
        'stats' => [
            'hit_accuracy' => 'Độ Chính Xác',
            'level' => 'Level :level',
            'level_progress' => 'Tiến độ qua level tiếp theo',
            'maximum_combo' => 'Combo Cao Nhất',
            'medals' => 'Huy Chương',
            'play_count' => 'Số Lần Chơi',
            'play_time' => 'Tổng Thời Gian Chơi',
            'ranked_score' => 'Điểm Được Xếp Hạng',
            'replays_watched_by_others' => 'Replay Được Xem',
            'score_ranks' => 'Điểm Số',
            'total_hits' => 'Tổng Lần Bấm',
            'total_score' => 'Tổng Điểm',
            // modding stats
            'graveyard_beatmapset_count' => '',
            'loved_beatmapset_count' => '',
            'pending_beatmapset_count' => 'Beatmap Đang Chờ',
            'ranked_beatmapset_count' => '',
        ],
    ],

    'silenced_banner' => [
        'title' => '',
        'message' => '',
    ],

    'status' => [
        'all' => 'Tất cả',
        'online' => 'Online',
        'offline' => 'Offline',
    ],
    'store' => [
        'saved' => 'Đã tạo người dùng',
    ],
    'verify' => [
        'title' => 'Xác Thực Tài Khoản',
    ],

    'view_mode' => [
        'brick' => '',
        'card' => '',
        'list' => '',
    ],
];

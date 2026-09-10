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
        'comment_text' => 'Bình luận này bị ẩn.',
        'blocked_count' => 'người dùng đã bị chặn (:count)',
        'hide_profile' => 'Ẩn trang cá nhân',
        'hide_comment' => 'ẩn',
        'forum_post_text' => 'Bài đăng này được ẩn.',
        'not_blocked' => 'Người dùng này chưa bị chặn.',
        'show_profile' => 'Hiển thị trang cá nhân',
        'show_comment' => 'hiện',
        'too_many' => 'Đã đạt giới hạn số người bị chặn.',
        'button' => [
            'block' => 'Chặn',
            'unblock' => 'Bỏ chặn',
        ],
    ],

    'card' => [
        'gift_supporter' => 'Tặng thẻ osu!supporter',
        'loading' => 'Đang tải...',
        'send_message' => 'Gửi tin nhắn',
    ],

    'create' => [
        'form' => [
            'password' => 'mật khẩu',
            'password_confirmation' => 'xác nhận mật khẩu',
            'submit' => 'tạo tài khoản',
            'user_email' => 'email',
            'user_email_confirmation' => 'xác nhận email',
            'username' => 'tên người dùng',

            'tos_notice' => [
                '_' => 'bằng việc tài khoản, bạn đồng ý với :link',
                'link' => 'điều khoản dịch vụ',
            ],
        ],
    ],

    'disabled' => [
        'title' => 'Ôi không! Có vẻ tài khoản của bạn đã bị vô hiệu hóa.',
        'warning' => "Trong trường hợp bạn vi phạm một quy tắc, xin lưu ý rằng thường sẽ có thời gian chờ là một tháng, trong đó chúng tôi sẽ không xem xét bất kỳ yêu cầu ân xá nào. Sau khoảng thời gian này, bạn có thể liên hệ với chúng tôi nếu thấy cần thiết. Xin lưu ý rằng việc tạo tài khoản mới sau khi một tài khoản đã bị vô hiệu hóa sẽ dẫn đến <strong>việc gia hạn thêm thời gian chờ một tháng</strong>. Xin cũng lưu ý rằng với <strong>mỗi tài khoản bạn tạo, bạn lại tiếp tục vi phạm quy tắc</strong>. Chúng tôi thực sự khuyên bạn không nên đi theo hướng này!",

        'if_mistake' => [
            '_' => 'Nếu bạn cảm thấy đây là một sai sót, bạn có thể liên hệ với chúng tôi (qua :email hoặc bằng cách nhấp vào dấu "?" ở góc dưới bên phải của trang này). Xin lưu ý rằng chúng tôi luôn hoàn toàn tự tin với các hành động của mình, vì chúng dựa trên dữ liệu rất chắc chắn. Chúng tôi có quyền từ chối yêu cầu của bạn nếu nhận thấy bạn đang cố tình không trung thực.',
            'email' => 'email',
        ],

        'reasons' => [
            'compromised' => 'Tài khoản của bạn được xác định là đã bị xâm nhập. Nó có thể bị vô hiệu hóa tạm thời trong khi danh tính đang được xác minh.
',
            'opening' => 'Có một số lý do có thể dẫn đến việc tài khoản của bạn bị vô hiệu hóa:',

            'tos' => [
                '_' => 'Bạn đã vi phạm một hoặc nhiều :community_rules hoặc :tos của chúng tôi.',
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
            'inactive' => "Tài khoản của bạn đã không được sử dụng trong một thời gian dài.",
            'inactive_different_country' => "Tài khoản của bạn đã không được sử dụng trong một thời gian dài.",
        ],
    ],

    'login' => [
        '_' => 'Đăng nhập',
        'button' => 'Đăng nhập',
        'button_posting' => 'Đang đăng nhập...',
        'email_login_disabled' => 'Đăng nhập bằng email hiện đã bị vô hiệu. Vui lòng sử dụng tên người dùng để đăng nhập.',
        'failed' => 'Đăng nhập không chính xác',
        'forgot' => 'Bạn quên mật khẩu?',
        'info' => 'Vui lòng đăng nhập để tiếp tục',
        'invalid_captcha' => 'Quá nhiều lần đăng nhập thất bại, vui lòng hoàn tất captcha và thử lại. (Làm mới trang nếu captcha không hiển thị)',
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

    'multiplayer' => [
        'index' => [
            'active' => 'Đang hoạt động',
            'ended' => 'Đã kết thúc',
        ],
    ],

    'ogp' => [
        'modding_description' => 'Beatmap: :counts',
        'modding_description_empty' => 'Người dùng không có bất kỳ beatmap nào...',

        'description' => [
            '_' => 'Hạng (:ruleset): :global | :country',
            'country' => 'Quốc gia :rank',
            'global' => 'Toàn cầu :rank',
        ],
    ],

    'posts' => [
        'title' => 'Bài đăng của :username',
    ],

    'anonymous' => [
        'login_link' => 'nhấn để đăng nhập',
        'login_text' => 'đăng nhập',
        'username' => 'Khách',
        'error' => 'Bạn cần phải đăng nhập để làm việc này.',
    ],
    'logout_confirm' => 'Bạn có chắc muốn đăng xuất không? :(',
    'report' => [
        'button_text' => 'Báo cáo',
        'comments' => 'Các bình luận',
        'placeholder' => 'Vui lòng cung cấp bất kỳ thông tin nào bạn cho rằng có thể hữu ích.',
        'reason' => 'Lý do',
        'thanks' => 'Cảm ơn bạn đã báo cáo!',
        'title' => 'Báo cáo :username?',

        'actions' => [
            'send' => 'Gửi Báo Cáo',
            'cancel' => 'Hủy',
        ],

        'dmca' => [
            'message_1' => [
                '_' => 'Vui lòng gửi báo cáo hành vi vi phạm bản quyền thông qua yêu cầu DMCA tới :mail theo :policy.',
                'policy' => 'chính sách bản quyền của osu!',
            ],
            'message_2' => 'Đây áp dụng cho các trường hợp bài hát, hình ảnh hoặc beatmap bị sử dụng mà không có quyền cho phép.',
        ],

        'options' => [
            'cheating' => 'Gian lận',
            'copyright_infringement' => 'Vi phạm bản quyền',
            'inappropriate_chat' => 'Hành vi trò chuyện không phù hợp',
            'insults' => 'Xúc phạm tôi / những người khác',
            'multiple_accounts' => 'Sử dụng nhiều tài khoản',
            'nonsense' => 'Phi lý',
            'other' => 'Khác (nhập dưới đây)',
            'spam' => 'Spamming',
            'unwanted_content' => 'Nội dung không phù hợp',
        ],
    ],
    'restricted_banner' => [
        'title' => 'Tài khoản của bạn đã bị hạn chế!',
        'message' => 'Trong khi bị hạn chế, bạn sẽ không thể tương tác với những người chơi khác và chỉ có bạn thấy được điểm số của bạn. Đây thường là kết quả của một quá trình tự động và thường sẽ được gỡ bỏ trong vòng 24 giờ. :link',
        'message_link' => 'Kiểm tra trang này để biết thêm chi tiết.',
    ],
    'show' => [
        'age' => ':age tuổi',
        'change_avatar' => 'đổi ảnh đại diện của bạn!',
        'first_members' => 'Tại đây từ thuở xa xưa',
        'is_developer' => 'osu!developer',
        'is_supporter' => 'osu!supporter',
        'joined_at' => 'Đã tham gia :date',
        'lastvisit' => 'Lần cuối hoạt động :date',
        'lastvisit_online' => 'Hiện đang trực tuyến',
        'missingtext' => 'Có thể bạn đã thực hiện một lỗi đánh máy! (hoặc người dùng có thể đã bị cấm)',
        'origin_country' => 'Từ :country',
        'previous_usernames' => 'được biết đến trước đây với',
        'plays_with' => 'Chơi bằng :devices',

        'comments_count' => [
            '_' => 'Đã đăng :link',
            'count' => ':count_delimited bình luận|:count_delimited bình luận',
        ],
        'cover' => [
            'to_0' => 'Ẩn ảnh bìa',
            'to_1' => 'Hiện ảnh bìa',
        ],
        'daily_challenge' => [
            'daily' => 'Chuỗi Hằng Ngày',
            'daily_streak_best' => 'Chuỗi Hằng Ngày Cao Nhất',
            'daily_streak_current' => 'Chuỗi Hằng Ngày Hiện Tại',
            'playcount' => 'Tổng Số Lần Tham Gia',
            'title' => 'Thử thách\nHằng ngày',
            'top_10p_placements' => '10% vị trí hàng đầu',
            'top_50p_placements' => '50% vị trí hàng đầu',
            'weekly' => 'Chuỗi Hằng Tuần',
            'weekly_streak_best' => 'Chuỗi Hằng Tuần Cao Nhất',
            'weekly_streak_current' => 'Chuỗi Hằng Tuần Hiện Tại',

            'unit' => [
                'day' => ':valued',
                'week' => ':valuew',
            ],
        ],
        'detail_switch' => [
            'to_v1' => '',
            'to_v2' => '',
        ],
        'edit' => [
            'cover' => [
                'button' => 'Đổi Ảnh Bìa Trang Cá Nhân',
                'defaults_info' => 'Sẽ có thêm lựa chọn ảnh bìa trong tương lai',
                'holdover_remove_confirm' => "Ảnh bìa đã chọn trước đó giờ không thể chọn được nữa. Bạn không thể chọn lại sau khi đã đổi sang ảnh bìa khác. Tiếp tục?",
                'title' => 'Ảnh bìa',

                'upload' => [
                    'broken_file' => 'Xử lý hình ảnh thất bại. Kiểm tra hình ảnh đã tải lên và thử lại.',
                    'button' => 'Tải ảnh lên',
                    'dropzone' => 'Thả vào đây để tải lên',
                    'dropzone_info' => 'Bạn cũng có thể thả hình ảnh vào đây để tải lên',
                    'size_info' => 'Kích cỡ ảnh bìa nên là 2000x500',
                    'too_large' => 'Tệp đã tải lên quá lớn.',
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

            'hue' => [
                'reset_no_supporter' => 'Muốn đặt về màu mặc định? Sẽ cần thẻ supporter để đổi sang màu khác.',
                'title' => 'Màu sắc',

                'supporter' => [
                    '_' => 'Tùy chọn màu chủ đề chỉ dành cho :link',
                    'link' => 'osu!supporter',
                ],
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
                'guest' => [
                    'title' => 'Beatmap Khách Mời',
                ],
                'loved' => [
                    'title' => 'Beatmap Loved',
                ],
                'nominated' => [
                    'title' => 'Beatmap Được Xếp Hạng Đã Đề Cử',
                ],
                'pending' => [
                    'title' => 'Beatmap Đang Chờ',
                ],
                'ranked' => [
                    'title' => 'Beatmap Được Xếp Hạng',
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
                'score_replay_stats' => [
                    'title' => 'Replay được xem nhiều nhất',
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
            'playlists' => [
                'title' => 'Danh sách phát trò chơi',
            ],
            'posts' => [
                'title' => 'Bài đăng',
                'title_longer' => 'Bài đăng gần đây',
                'show_more' => 'xem bài đăng khác',
            ],
            'ranked-play' => [
                'title' => 'Trận đấu xếp hạng',
            ],
            'recent_activity' => [
                'title' => 'Gần Đây',
            ],
            'realtime' => [
                'title' => 'Màn chơi nhiều người chơi',
            ],
            'top_ranks' => [
                'download_replay' => 'Tải Xuống Phần Phát Lại',
                'not_ranked' => 'Chỉ có beatmap được xếp hạng mới có pp.',
                'pp_weight' => 'trọng số :percentage',
                'view_details' => 'Xem chi tiết',
                'title' => 'Xếp Hạng',

                'best' => [
                    'title' => 'Thành tích tốt nhất',
                ],
                'first' => [
                    'title' => 'Xếp Hạng Nhất',
                ],
                'pin' => [
                    'to_0' => 'Gỡ ghim',
                    'to_0_done' => 'Điểm gỡ ghim',
                    'to_1' => 'Ghim',
                    'to_1_done' => 'Điểm được ghim',
                ],
                'pinned' => [
                    'title' => 'Điểm Được Ghim',
                ],
            ],
            'votes' => [
                'given' => 'Bình chọn đã cho (3 tháng qua)',
                'received' => 'Bình chọn đã nhận (3 tháng qua)',
                'title' => 'Phiếu',
                'title_longer' => 'Phiếu gần đây',
                'vote_count' => ':count_delimited bình chọn|:count_delimited bình chọn',
            ],
            'account_standing' => [
                'title' => 'Trạng Thái Tài Khoản',
                'bad_standing' => "Tài khoản của :username không ở trong trạng thái tốt :(",
                'remaining_silence' => ':username sẽ được nói trở lại vào :duration.',

                'recent_infringements' => [
                    'title' => 'Vi Phạm Gần Đây',
                    'date' => 'ngày',
                    'action' => 'hành động',
                    'length' => 'thời lượng',
                    'length_indefinite' => 'Vô thời hạn',
                    'description' => 'mô tả',
                    'actor' => 'bởi :username',

                    'actions' => [
                        'restriction' => 'Ban',
                        'silence' => 'Im lặng',
                        'tournament_ban' => 'Cấm thi đấu',
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

        'matchmaking' => [
            'losses' => '',
            'plays' => '',
            'rank' => '',
            'rating' => '',
            'recent_history' => '',
            'tier' => '',
            'title' => 'Chơi nhanh',
            'wins' => '',
        ],

        'not_found' => [
            'reason_1' => 'Có thể họ đã đổi tên tài khoản.',
            'reason_2' => 'Tài khoản của họ có thể tạm thời không khả dụng vì vấn đề an ninh hoặc lạm dụng.',
            'reason_3' => 'Có thể bạn đã thực hiện một lỗi đánh máy!',
            'reason_header' => 'Có một vài lí do cho vấn đề này:',
            'title' => 'Không tìm thấy người dùng! ;_;',
        ],
        'page' => [
            'button' => 'chỉnh sửa trang cá nhân',
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
            'count' => ':count_delimited bài đăng forum|:count_delimited bài đăng forum',
        ],
        'rank' => [
            'country' => 'Hạng quốc gia cho :mode',
            'country_simple' => 'Hạng Quốc Gia',
            'global' => 'Hạng quốc tế cho :mode',
            'global_simple' => 'Hạng Toàn Cầu',
            'highest' => 'Hạng cao nhất: :rank vào :date',
        ],
        'score_processing' => [
            'title' => 'Thuật toán tính Độ Khó / PP :link.',
            'title_link' => 'đang được triển khai',
            'message' => 'Điểm số gần đây có thể chưa được cập nhật ngay lập tức trên trang cá nhân của người dùng.',
        ],
        'season_stats' => [
            'division_top_percentage' => 'Top :value',
            'label' => '',
            'total_score' => 'Tổng điểm',
        ],
        'solo' => [
            'title' => '',
        ],
        'stats' => [
            'hit_accuracy' => 'Độ chính xác',
            'hits_per_play' => 'Số lần bấm mỗi khi chơi',
            'level' => 'Level :level',
            'level_progress' => 'tiến trình lên cấp tiếp theo',
            'maximum_combo' => 'Combo Cao Nhất',
            'medals' => 'Huy Chương',
            'play_count' => 'Số lần chơi',
            'play_time' => 'Tổng Thời Gian Chơi',
            'ranked_score' => 'Điểm Được Xếp Hạng',
            'replays_watched_by_others' => 'Replay Được Xem',
            'score_ranks' => 'Thứ hạng điểm',
            'total_hits' => 'Tổng Lần Bấm',
            'total_score' => 'Tổng Điểm',
            // modding stats
            'graveyard_beatmapset_count' => 'Các beatmap bị đắp mộ',
            'loved_beatmapset_count' => 'Số beatmap Loved',
            'pending_beatmapset_count' => 'Beatmap Đang Chờ',
            'ranked_beatmapset_count' => 'Số beatmap đã được xếp hạng',
        ],
    ],

    'silenced_banner' => [
        'title' => 'Bạn đang bị Im lặng.',
        'message' => 'Một vài hành động có thể sẽ không thực hiện được.',
    ],

    'status' => [
        'all' => 'Tất cả',
        'online' => 'Trực Tuyến',
        'offline' => 'Ngoại Tuyến',
    ],
    'store' => [
        'from_client' => 'vui lòng đăng kí thông qua game!',
        'from_web' => 'vui lòng hoàn tất đăng kí thông qua trang web osu!',
        'saved' => 'Đã tạo người dùng',
    ],
    'verify' => [
        'title' => 'Xác Thực Tài Khoản',
    ],

    'view_mode' => [
        'brick' => 'Xem kiểu gạch',
        'card' => 'Xem kiểu thẻ',
        'list' => 'Xem kiểu danh sách',
    ],
];

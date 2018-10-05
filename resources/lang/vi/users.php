<?php

/**
 *    Copyright 2015-2018 ppy Pty. Ltd.
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
    'deleted' => '[người dùng đã bị xóa]',

    'beatmapset_activities' => [
        'title' => "Lịch Sử Modding Của :user",

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
        'hide_profile' => 'ẩn trang cá nhân',
        'not_blocked' => 'Người dùng này chưa bị chặn.',
        'show_profile' => 'hiển thị trang cá nhân',
        'too_many' => 'Đã đạt giới hạn số người bị chặn.',
        'button' => [
            'block' => 'chặn',
            'unblock' => 'bỏ chặn',
        ],
    ],

    'card' => [
        'loading' => 'Đang tải...',
        'send_message' => 'gửi tin nhắn',
    ],

    'login' => [
        '_' => 'Đăng nhập',
        'locked_ip' => 'Địa chỉ IP của bạn đã bị khóa. Vui lòng đợi một vài phút.',
        'username' => 'Tên tài khoản',
        'password' => 'Mật khẩu',
        'button' => 'Đăng nhập',
        'button_posting' => 'Đang đăng nhập...',
        'remember' => 'Nhớ máy tính này',
        'title' => 'Vui lòng đăng nhập để tiếp tục',
        'failed' => 'Đăng nhập không chính xác',
        'register' => "Không có tài khoản osu!? Tạo một tài khoản mới",
        'forgot' => 'Quên mật khẩu?',
        'beta' => [
            'main' => 'Quyền truy cập bản thử nghiệm hiện bị hạn chế cho người dùng đặc quyền.',
            'small' => '(người ủng hộ sẽ sớm được tham gia)',
        ],

        'here' => 'tại đây', // this is substituted in when generating a link above. change it to suit the language.
    ],

    'posts' => [
        'title' => 'Bài đăng của :username',
    ],

    'signup' => [
        '_' => 'Đăng kí',
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
            'insults' => 'Xúc phạm tôi / những người khác',
            'spam' => 'Spamming',
            'unwanted_content' => 'Có những nội dung không phù hợp',
            'nonsense' => 'Phi lý',
            'other' => 'Khác (nhập dưới đây)',
        ],
    ],
    'restricted_banner' => [
        'title' => 'Tài khoản của bạn đã bị hạn chế!',
        'message' => 'Trong khi bị hạn chế, Bạn sẽ không thể tương tác với những người chơi khác và chỉ có bạn thấy được điểm của bạn. Đây thường là kết quả của một quá trình từ động và thường sẽ được gỡ bỏ trong vòng 24 giờ. Nếu bạn muốn kháng nghị về sự hạn chế này, vui lòng <a href="mailto:accounts@ppy.sh">liên hệ hỗ trợ</a>.',
    ],
    'show' => [
        'age' => ':age tuổi',
        'change_avatar' => 'đổi ảnh đại diện!',
        'first_members' => 'Ở đây kể từ khi bắt đầu',
        'is_developer' => 'osu!developer',
        'is_supporter' => 'osu!supporter',
        'joined_at' => 'Đã tham gia :date',
        'lastvisit' => 'Lần cuối hoạt động :date',
        'missingtext' => 'Có thể bạn đã thực hiện một lỗi đánh máy! (hoặc người dùng này có thể đã bị ban)',
        'origin_country' => 'Từ :country',
        'page_description' => 'osu! - Tất cả những bì bạn muốn biết về :username!',
        'previous_usernames' => 'được biết đến trước đây với',
        'plays_with' => 'Chơi bằng :devices',
        'title' => "Trang cá nhân của :username",

        'edit' => [
            'cover' => [
                'button' => 'Đổi Ảnh Bìa Trang Cá Nhân',
                'defaults_info' => 'Sẽ có thêm lựa chọn ảnh bìa trong tương lai',
                'upload' => [
                    'broken_file' => 'Không xử lý được hình ảnh. Kiểm tra hình ảnh đã tải lên và thử lại sau.',
                    'button' => 'Tải ảnh lên',
                    'dropzone' => 'Thả vào đây để tải lên',
                    'dropzone_info' => 'Bạn cũng có thể thả hình ảnh vào đây để tải lên',
                    'restriction_info' => "Tải lên chỉ có sẵn cho <a href='".route('store.products.show', 'supporter-tag')."' target='_blank'>người hỗ trợ osu!</a>",
                    'size_info' => 'Kích cỡ ảnh bìa nên là 2000x700',
                    'too_large' => 'Tệp đã tải lên quá lơn.',
                    'unsupported_format' => 'Định dạng không được hỗ trợ.',
                ],
            ],

            'default_playmode' => [
                'is_default_tooltip' => 'chế độ chơi mặc định',
                'set' => 'đặt :mode làm chế độ chơi mặc định của trang cá nhân',
            ],
        ],

        'extra' => [
            'followers' => ':count người theo dõi',
            'unranked' => 'Không chơi gần đây',

            'achievements' => [
                'title' => 'Huy hiệu',
                'achieved-on' => 'Đạt được vào :date',
            ],
            'beatmaps' => [
                'none' => 'Chưa có... gì cả.',
                'title' => 'Beatmaps',

                'favourite' => [
                    'title' => 'Beatmap Yêu Thích (:count)',
                ],
                'graveyard' => [
                    'title' => 'Graveyarded Beatmaps (:count)',
                ],
                'loved' => [
                    'title' => 'Loved Beatmaps (:count)',
                ],
                'ranked_and_approved' => [
                    'title' => 'Beatmap Được Xếp Hạng & Được Chấp Nhận (:count)',
                ],
                'unranked' => [
                    'title' => 'Beatmap Đang Chờ (:count)',
                ],
            ],
            'historical' => [
                'empty' => 'Chưa ghi nhận điểm. :(',
                'title' => 'Lịch Sử',

                'monthly_playcounts' => [
                    'title' => 'Lịch Sử Chơi',
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
                ],
            ],
            'kudosu' => [
                'available' => 'Kudosu Có Sẵn',
                'available_info' => "Kudosu có thể được chuyển thành kudosu stars, chúng có thể giúp beatmap của bạn nhận được nhiều sự chú ý hơn. Đây là số kudosu bạn chưa chuyển đổi.",
                'recent_entries' => 'Lịch Sử Kudosu Gần Đây',
                'title' => 'Kudosu!',
                'total' => 'Tông Số Kudosu Nhận Được',
                'total_info' => 'Dựa vào số lượng đóng góp mà người dùng này đã thực hiện để điều chỉnh beatmap. Xem <a href="'.osu_url('user.kudosu').'">trang này</a> để biết thêm thông tin.',

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
            ],
            'me' => [
                'title' => 'tôi!',
            ],
            'medals' => [
                'empty' => "Người dùng này chưa có huy chương nào cả. ;_;",
                'title' => 'Huy Chương',
            ],
            'recent_activity' => [
                'title' => 'Gần Đây',
            ],
            'top_ranks' => [
                'empty' => 'Chưa ghi nhận thành tích tuyệt vời nào. :(',
                'not_ranked' => 'Chỉ có beatmap được xếp hạng mới có pp.',
                'pp' => ':amountpp',
                'title' => 'Xếp Hạng',
                'weighted_pp' => 'trọng số: :pp (:percentage)',

                'best' => [
                    'title' => 'Thực Hiện Tốt Nhất',
                ],
                'first' => [
                    'title' => 'Xếp Hạng Nhất',
                ],
            ],
            'account_standing' => [
                'title' => 'Trạng Thái Tài Khoản',
                'bad_standing' => "Tài khoản của <strong>:username</strong> không ở trong trạng thái tốt :(",
                'remaining_silence' => '<strong>:username</strong> sẽ được nói trở lại vào :duration.',

                'recent_infringements' => [
                    'title' => 'Vi Phạm Gần Đây',
                    'date' => 'ngày',
                    'action' => 'hành động',
                    'length' => 'chiều dài',
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
            'discord' => 'Discord',
            'interests' => 'Sở Thích',
            'lastfm' => 'Last.fm',
            'location' => 'Vị Trí Hiện Tại',
            'occupation' => 'Nghề Nghiệp',
            'skype' => 'Skype',
            'twitter' => 'Twitter',
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
            'description' => '<strong>tôi!</strong> là một khu vực cá nhân có thể tùy chỉnh trong trang cá nhân của bạn.',
            'edit_big' => 'Chỉnh sửa tôi!',
            'placeholder' => 'Nhập nội dung trang vào đây',
            'restriction_info' => "Bạn cần phải là <a href='".route('store.products.show', 'supporter-tag')."' target='_blank'>người hỗ trợ osu!</a> để mở khóa tính năng này.",
        ],
        'post_count' => [
            '_' => 'Đã đóng góp :link',
            'count' => ':count bài đăng forum',
        ],
        'rank' => [
            'country' => 'Hạng quốc gia cho :mode',
            'global' => 'Hạng quốc tế cho :mode',
        ],
        'stats' => [
            'hit_accuracy' => 'Độ Chính Xác',
            'level' => 'Level :level',
            'maximum_combo' => 'Combo Cao Nhất',
            'play_count' => 'Số Lần Chơi',
            'play_time' => 'Tổng Thời Gian Chơi',
            'ranked_score' => 'Điểm Được Xếp Hạng',
            'replays_watched_by_others' => 'Replay Được Xem',
            'score_ranks' => 'Điểm Số',
            'total_hits' => 'Tổng Lần Bấm',
            'total_score' => 'Tổng Điểm',
        ],
    ],
    'status' => [
        'online' => 'Online',
        'offline' => 'Offline',
    ],
    'store' => [
        'saved' => 'Đã tạo người dùng',
    ],
    'verify' => [
        'title' => 'Xác Thực Tài Khoản',
    ],
];

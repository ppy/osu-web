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
    'not_negative' => ':attribute không thể âm.',
    'required' => 'Yêu cầu :attribute.',
    'too_long' => ':attribute vượt quá độ dài cho phép - chỉ có thể lên đến :limit kí tự.',
    'wrong_confirmation' => 'Xác nhận không phù hợp.',

    'beatmap_discussion_post' => [
        'discussion_locked' => 'Cuộc thảo luận đã bị khóa.',
        'first_post' => 'Không thể xóa bài đăng mở đầu.',
    ],

    'beatmapset_discussion' => [
        'beatmap_missing' => 'Mốc thời gian đã chỉ định nhưng không có beatmap.',
        'beatmapset_no_hype' => "Không thể hype beatmap này được.",
        'hype_requires_null_beatmap' => 'Hype phải được thực hiện tại phần Chung (tất cả difficulties).',
        'invalid_beatmap_id' => 'Difficulty đã chọn không hợp lệ.',
        'invalid_beatmapset_id' => 'Beatmap đã chọn không hợp lệ.',
        'locked' => 'Cuộc thảo luận đã bị khóa.',

        'hype' => [
            'guest' => 'Cần phải đăng nhập để hype.',
            'hyped' => 'Bạn đã hype beatmap này rồi.',
            'limit_exceeded' => 'Bạn đã sử dụng hết số hype bạn có.',
            'not_hypeable' => 'Beatmap này không thể được hype.',
            'owner' => 'Không thể hype map của bạn.',
        ],

        'timestamp' => [
            'exceeds_beatmapset_length' => 'Mốc thời gian đã chọn vượt quá độ dài beatmap.',
            'negative' => "Mốc thời gian không thể âm.",
        ],
    ],

    'forum' => [
        'feature_vote' => [
            'not_feature_topic' => 'Chỉ có thể bầu chọn một feature request.',
            'not_enough_feature_votes' => 'Không đủ phiếu bầu.',
        ],

        'poll_vote' => [
            'invalid' => 'Lựa chọn không hợp lệ.',
        ],

        'post' => [
            'beatmapset_post_no_delete' => 'Không cho phép xóa beatmap metadata.',
            'beatmapset_post_no_edit' => 'Không cho phép chỉnh sửa beatmap metadata.',
        ],

        'topic_poll' => [
            'duplicate_options' => 'Không cho phép thêm lựa chọn trùng lặp.',
            'invalid_max_options' => 'Số lựa chọn cho một người không được vượt quá số lựa chọn sẵn có.',
            'minimum_one_selection' => 'Yêu cầu tối thiểu một lựa chọn cho mỗi người dùng.',
            'minimum_two_options' => 'Cần ít nhất hai lựa chọn.',
            'too_many_options' => 'Vượt quá số lượng lựa chọn tối đa.',
        ],

        'topic_vote' => [
            'required' => 'Chọn một lựa chọn khi đang bỏ phiếu.',
            'too_many' => 'Vượt quá mức cho phép chọn các lựa chọn.',
        ],
    ],

    'user' => [
        'contains_username' => 'Mật khẩu không thể chứa tên tài khoản.',
        'email_already_used' => 'Địa chỉ email đã được sử dụng.',
        'invalid_country' => 'Quốc gia không có trong cơ sở dữ liệu.',
        'invalid_discord' => 'Tên người dùng Discord không hợp lệ.',
        'invalid_email' => "Dường như đây không phải là địa chỉ email hợp lệ.",
        'too_short' => 'Mật khẩu mới quá ngắn.',
        'unknown_duplicate' => 'Tên người dùng hoặc email đã được sử dụng.',
        'username_available_in' => 'Tên người dùng này sẽ có sẵn để sử dụng trong :duration.',
        'username_available_soon' => 'Tên người dùng này sẽ có sẵn để sử dụng bất cứ lúc nào!',
        'username_invalid_characters' => 'Tên người dùng đã yêu cầu chứa các ký tự không hợp lệ.',
        'username_in_use' => 'Tên người dùng đã được sử dụng!',
        'username_no_space_userscore_mix' => 'Vui lòng sử dụng dấu gạch dưới hoặc dấu cách, không phải cả hai!',
        'username_no_spaces' => "Tên người dùng không thể bắt đầu hoặc kết thúc bằng dấu cách!",
        'username_not_allowed' => 'Không cho phép sử dụng tên người dùng đã chọn.',
        'username_too_short' => 'Tên người dùng đã yêu cầu quá ngắn.',
        'username_too_long' => 'Tên người dùng đã yêu cầu quá dài.',
        'weak' => 'Mật khẩu quá yếu.',
        'wrong_current_password' => 'Mật khẩu hiện tại không đúng.',
        'wrong_email_confirmation' => 'Email xác nhận không phù hợp.',
        'wrong_password_confirmation' => 'Mật khẩu xác nhận không phù hợp.',
        'too_long' => 'Đã vượt quá độ dài tối đa - tối đa :limit kí tự.',

        'change_username' => [
            'supporter_required' => [
                '_' => 'Bạn phải :link để đổi tên người dùng!',
                'link_text' => 'hỗ trợ osu!',
            ],
            'username_is_same' => 'Đây là tên người dùng của bạn mà, đồ ngốc!',
        ],
    ],
];

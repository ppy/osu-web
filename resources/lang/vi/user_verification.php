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
    'box' => [
        'sent' => 'Một email đã được gửi đến :mail với mã xác thực. Hãy nhập mã.',
        'title' => 'Xác Thực Tài Khoản',
        'verifying' => 'Đang xác thực...',
        'issuing' => 'Đang lấy mã mới...',

        'info' => [
            'check_spam' => "Hãy kiểm tra thư mục spam nếu bạn không thể tìm thấy email.",
            'recover' => "Nếu bạn không thể truy cập vào email hoặc đã quên email bạn đã dùng, vui lòng làm theo :link.",
            'recover_link' => 'phục hồi email tại đây',
            'reissue' => 'Bạn cũng có thể :reissue_link hoặc :logout_link.',
            'reissue_link' => 'yêu cầu mã mới',
            'logout_link' => 'đăng xuất',
        ],
    ],

    'errors' => [
        'expired' => 'Mã xác thực này đã hết hạn, email xác thực mới đã được gửi.',
        'incorrect_key' => 'Mã xác thực không chính xác.',
        'retries_exceeded' => 'Mã xác thực không chính xác. Vượt quá giới hạn lần thử lại, email xác thực mới đã được gửi.',
        'reissued' => 'Mã xác thực đã được làm mới, email xác thực mới đã được gửi.',
        'unknown' => 'Một lỗi không xác định đã xảy ra, email xác thực mới đã được gửi.',
    ],
];

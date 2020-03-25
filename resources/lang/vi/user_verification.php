<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

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

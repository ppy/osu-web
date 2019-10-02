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
    'codes' => [
        'http-401' => 'Vui lòng đăng nhập để tiếp tục.',
        'http-403' => 'Truy cập bị từ chối.',
        'http-404' => 'Không tìm thấy.',
        'http-429' => 'Quá nhiều lần thử. Thử lại sau.',
    ],
    'account' => [
        'profile-order' => [
            'generic' => 'Đã xảy ra lỗi. Vui lòng thử tải lại trang.',
        ],
    ],
    'beatmaps' => [
        'invalid_mode' => 'Chế độ đã chỉ định không hợp lệ.',
        'standard_converts_only' => 'Chưa có điểm số nào cho chế độ chơi này cho độ khó này của beatmap.',
    ],
    'checkout' => [
        'generic' => 'Đã xảy ra lỗi trong quá trình thanh toán cho đơn hàng của bạn.',
    ],
    'search' => [
        'default' => 'Không có kết quả, vui lòng thử lại sau.',
        'operation_timeout_exception' => 'Hệ thống tìm kiếm đang quá tải, vui lòng thử lại sau.',
    ],

    'logged_out' => 'Bạn đã bị đăng xuất. Hãy đăng nhập và thử lại.',
    'supporter_only' => 'Bạn phải là một osu!supporter để sử dụng tính năng này.',
    'no_restricted_access' => 'Không thể thực hiện hành động do tài khoản của bạn đang bị hạn chế.',
    'unknown' => 'Đã xảy ra lỗi không xác định.',
];

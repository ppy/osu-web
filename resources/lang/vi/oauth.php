<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'cancel' => 'Hủy',

    'authorise' => [
        'request' => 'yêu cầu quyền truy cập vào tài khoản của bạn.',
        'scopes_title' => 'Ứng dụng này sẽ được:',
        'title' => 'Yêu Cầu Ủy Quyền',
    ],

    'authorized_clients' => [
        'confirm_revoke' => 'Bạn có chắc chắn muốn thu hồi quyền của khách hàng này không?',
        'scopes_title' => 'Ứng dụng này có thể:',
        'owned_by' => 'Được sở hữu bởi :user',
        'none' => 'Không có khách ',

        'revoked' => [
            'false' => 'Thu hồi quyền truy cập',
            'true' => 'Đã thu hồi quyền truy cập',
        ],
    ],

    'client' => [
        'id' => 'ID khách ',
        'name' => 'Tên ứng dụng',
        'redirect' => 'Ứng dụng gọi lại URL',
        'reset' => 'Đặt lại bí mật của khách ',
        'reset_failed' => 'Lỗi không thể đặt lại bí mật của khách ',
        'secret' => 'Bí mật khách ',

        'secret_visible' => [
            'false' => 'Hiện bí mật khách ',
            'true' => 'Ẩn bí mật khách',
        ],
    ],

    'new_client' => [
        'header' => 'Đăng ký ứng dụng "OAuth" mới',
        'register' => 'Đăng kí ứng dụng',
        'terms_of_use' => [
            '_' => 'Bằng cách sử dụng với API bạn đồng ý với :link.',
            'link' => 'Điều khoản sử dụng',
        ],
    ],

    'own_clients' => [
        'confirm_delete' => 'Bạn có chắc chắn rằng muốn xóa khách này?',
        'confirm_reset' => 'Bạn có chắc chắn muốn đặt lại bí mật của ứng dụng khách không? Điều này sẽ thu hồi tất cả các mã thông báo hiện có.',
        'new' => 'Ứng dụng OAuth mới',
        'none' => 'Không có khách',

        'revoked' => [
            'false' => 'Xóa',
            'true' => 'Đã xóa',
        ],
    ],
];

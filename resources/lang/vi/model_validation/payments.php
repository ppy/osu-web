<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'signature' => [
        'not_match' => 'Chữ ký không khớp.',
    ],
    'notification_type' => 'notification_type không hợp lệ :type',
    'order' => [
        'invalid' => 'Đơn đặt hàng không hợp lệ.',
        'items' => [
            'virtual_only' => 'thanh toán `:provider` không hợp lệ cho các vật phẩm thật.',
        ],
        'status' => [
            'not_checkout' => 'Đang cố chấp nhận thanh toán cho mặt hàng trong trạng thái lỗi `:state`.',
            'not_paid' => 'Đang cố hoàn tiền của thanh toán cho mặt hàng trong trạng thái lỗi `:state`.',
        ],
    ],
    'param' => [
        'invalid' => '`:param` param không khớp',
    ],
    'paypal' => [
        'not_echeck' => 'Thanh toán đang chờ không phải là echeck. (:actual)',
    ],
    'purchase' => [
        'checkout' => [
            'amount' => 'Lượng tiền trong thanh toán không khớp: :actual != :expected',
            'currency' => 'Thanh toán không phải bằng USD. (:type)',
        ],
    ],
    'order_number' => [
        'malformed' => 'ID giao dịch của đơn hàng nhận được không bình thường',
        'user_id_mismatch' => 'external_id chứa sai ID của người dùng',
    ],
];

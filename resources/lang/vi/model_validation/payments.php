<?php

/**
 *    Copyright 2015-2017 ppy Pty. Ltd.
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

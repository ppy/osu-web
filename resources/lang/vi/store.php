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
    'admin' => [
        'warehouse' => 'Kho hàng',
    ],

    'cart' => [
        'checkout' => 'Thanh Toán',
        'more_goodies' => 'Tôi muốn xem thêm nhiều mặt hàng nữa trước khi hoàn thành đơn hàng',
        'shipping_fees' => 'phí vận chuyển',
        'title' => 'Giỏ Hàng',
        'total' => 'tổng cộng',

        'errors_no_checkout' => [
            'line_1' => 'Uh oh, đã có vấn đề với giỏ hàng của bạn làm ngăn cản việc thanh toán!',
            'line_2' => 'Loại bỏ hoặc cập nhật các mặt hàng phía trên để tiếp tục.',
        ],

        'empty' => [
            'text' => 'Giỏ hàng của bạn không có gì cả.',
            'return_link' => [
                '_' => 'Trở về :link để tìm thêm nhiều mặt hàng khác!',
                'link_text' => 'danh sách',
            ],
        ],
    ],

    'checkout' => [
        'cart_problems' => 'Uh oh, có vấn đề với giỏ hàng của bạn!',
        'cart_problems_edit' => 'Nhấp vào đây để chỉnh sửa nó.',
        'declined' => 'Thanh toán đã bị hủy.',
        'old_cart' => 'Giỏ hàng của bạn đã hết hạn và đã được nạp lại, vui lòng thử lại sau.',
        'pay' => 'Thanh toán với Paypal',
        'pending_checkout' => [
            'line_1' => 'Lần thanh toán trước đã bắt đầu nhưng chưa kết thúc.',
            'line_2' => 'Tiếp tục thanh toán bằng cách chọn một phương thức thanh toán, hoặc :link để hủy.',
            'link_text' => 'nhấp vào đây',
        ],
        'delayed_shipping' => 'Hiện tại chúng tôi đang có một lượng đơn hàng rất lớn! Bạn vẫn có thể thoải mái đặt hàng, nhưng vui lòng đợi **thêm 1-2 tuần** trong khi chúng tôi bắt kịp với những đơn hàng hiện tại.',
    ],

    'discount' => 'tiết kiệm :percent%',

    'mail' => [
        'payment_completed' => [
            'subject' => 'Chúng tôi đã nhận được đơn hàng osu!store của bạn!',
        ],
    ],

    'order' => [
        'item' => [
            'display_name' => [
                'supporter_tag' => ':name cho :username (:duration)',
            ],
            'quantity' => 'Số lượng',
        ],

        'not_modifiable_exception' => [
            'cancelled' => 'Bạn không thể chỉnh sửa đơn hàng vì nó đã bị hủy bỏ.',
            'checkout' => 'Bạn không thể chỉnh sửa đơn hàng trong khi nó đang được xử lý.', // checkout and processing should have the same message.
            'default' => 'Đơn hàng không thể sửa đổi',
            'delivered' => 'Bạn không thể chỉnh sửa đơn hàng vì nó đã được giao.',
            'paid' => 'Bạn không thể chỉnh sửa đơn hàng vì nó đã được thanh toán.',
            'processing' => 'Bạn không thể chỉnh sửa đơn hàng trong khi nó đang được xử lý.',
            'shipped' => 'Bạn không thể chỉnh sửa đơn hàng vì nó đã được vận chuyển.',
        ],
    ],

    'product' => [
        'name' => 'Tên',

        'stock' => [
            'out' => 'Mặt hàng này hiện đang hết hàng. Kiểm tra lại sau!',
            'out_with_alternative' => 'Rất tiếc, sản phẩm này đã hết hàng. Sử dụng dropdown menu để chọn loại khác hoặc kiểm tra lại sau!',
        ],

        'add_to_cart' => 'Thêm Vào Giỏ Hàng',
        'notify' => 'Thông báo cho tôi khi có hàng!',

        'notification_success' => 'bạn sẽ được thông báo khi chúng tôi có hàng mới. nhấp vào :link để hủy',
        'notification_remove_text' => 'đây',

        'notification_in_stock' => 'Sản phẩm này đã có trong kho!',
    ],

    'supporter_tag' => [
        'gift' => 'tặng người chơi khác',
        'require_login' => [
            '_' => 'Bạn cần phải :link để nhận một osu!supporter tag!',
            'link_text' => 'đăng nhập',
        ],
    ],

    'username_change' => [
        'check' => 'Nhập tên người dùng để kiểm tra tính khả dụng!',
        'checking' => 'Đang kiểm tra tính khả dụng của :username...',
        'require_login' => [
            '_' => 'Bạn cần phải :link để đổi tên!',
            'link_text' => 'đăng nhập',
        ],
    ],
];

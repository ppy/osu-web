<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'cart' => [
        'checkout' => 'Thanh Toán',
        'info' => ':count_delimited sản phẩm trong giỏ ($:subtotal)|:count_delimited sản phẩm trong giỏ ($:subtotal)',
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
        'delayed_shipping' => 'Hiện tại chúng tôi đang có một lượng đơn hàng rất lớn! Bạn vẫn có thể thoải mái đặt hàng, nhưng vui lòng đợi **thêm 1-2 tuần** trong khi chúng tôi bắt kịp với những đơn hàng hiện tại.',
        'old_cart' => 'Giỏ hàng của bạn đã hết hạn và đã được nạp lại, vui lòng thử lại sau.',
        'pay' => 'Thanh toán với Paypal',
        'title_compact' => 'thanh toán',

        'has_pending' => [
            '_' => 'Bạn có thanh toán chưa hoàn thành, nhấp vào :link để xem.',
            'link_text' => 'đây',
        ],

        'pending_checkout' => [
            'line_1' => 'Lần thanh toán trước đã bắt đầu nhưng chưa kết thúc.',
            'line_2' => 'Tiếp tục thanh toán bằng cách chọn một cách thanh toán.',
        ],
    ],

    'discount' => 'tiết kiệm :percent%',

    'invoice' => [
        'echeck_delay' => 'Vì bạn thanh toán bằng eCheck, hãy chờ thêm tối đa 10 ngày để thanh toán qua khỏi PayPal!',
        'title_compact' => 'hóa đơn',

        'status' => [
            'processing' => [
                'title' => 'Thanh toán của bạn chưa được xác nhận!',
                'line_1' => 'Nếu bạn đã thanh toán, chúng tôi có thể vẫn đang đợi xác nhận của thanh toán của bạn. Hãy tải lại trang này trong khoảng một đến hai phút!',
                'line_2' => [
                    '_' => 'Nếu bạn gặp sự cố trong quá trình thanh toán, :link',
                    'link_text' => 'nhấp vào đây để tiếp tục quá trình thanh toán',
                ],
            ],
        ],
    ],

    'order' => [
        'cancel' => 'Huỷ đơn hàng',
        'cancel_confirm' => 'Đơn hàng này sẽ bị hủy và giao dịch sẽ không được chấp nhận. Nhà cung cấp dịch vụ thanh toán có thể sẽ không hoàn tiền ngay. Bạn có chắc không?',
        'cancel_not_allowed' => 'Đơn hàng không thể bị hủy lúc này.',
        'invoice' => 'Xem Hóa Đơn',
        'no_orders' => 'Không có đơn đặt hàng.',
        'paid_on' => 'Đã đặt hàng :date',
        'resume' => 'Tiếp Tục Thanh Toán',
        'shopify_expired' => 'Link thanh toán cho đơn hàng này đã hết hạn.',

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

        'status' => [
            'cancelled' => 'Đã Hủy',
            'checkout' => 'Đang Chuẩn Bị',
            'delivered' => 'Đã Giao Hàng',
            'paid' => 'Đã Thanh Toán',
            'processing' => 'Đang chờ xác nhận',
            'shipped' => 'Đã giao hàng',
        ],
    ],

    'product' => [
        'name' => 'Tên',

        'stock' => [
            'out' => 'Mặt hàng này hiện đang hết hàng. Kiểm tra lại sau!',
            'out_with_alternative' => 'Rất tiếc, sản phẩm này đã hết hàng. Sử dụng bảng chọn thả xuống để chọn loại khác hoặc kiểm tra lại sau!',
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

    'xsolla' => [
        'distributor' => '',
    ],
];

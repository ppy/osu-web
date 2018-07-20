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
        'warehouse' => '',
    ],

    'cart' => [
        'checkout' => '',
        'more_goodies' => '',
        'shipping_fees' => '',
        'title' => '',
        'total' => '',

        'errors_no_checkout' => [
            'line_1' => '',
            'line_2' => '',
        ],

        'empty' => [
            'text' => '',
            'return_link' => [
                '_' => '',
                'link_text' => '',
            ],
        ],
    ],

    'checkout' => [
        'cart_problems' => '',
        'cart_problems_edit' => '',
        'declined' => '',
        'old_cart' => '',
        'pay' => '',
        'pending_checkout' => [
            'line_1' => '',
            'line_2' => '',
            'link_text' => '',
        ],
        'delayed_shipping' => '',
    ],

    'discount' => '',

    'mail' => [
        'payment_completed' => [
            'subject' => '',
        ],
    ],

    'order' => [
        'item' => [
            'display_name' => [
                'supporter_tag' => '',
            ],
            'quantity' => '',
        ],

        'not_modifiable_exception' => [
            'cancelled' => '',
            'checkout' => '', // checkout and processing should have the same message.
            'default' => '',
            'delivered' => '',
            'paid' => '',
            'processing' => '',
            'shipped' => '',
        ],
    ],

    'product' => [
        'name' => '',

        'stock' => [
            'out' => '',
            'out_with_alternative' => '',
        ],

        'add_to_cart' => '',
        'notify' => '',

        'notification_success' => '',
        'notification_remove_text' => '',

        'notification_in_stock' => '',
    ],

    'supporter_tag' => [
        'gift' => '',
        'require_login' => [
            '_' => '',
            'link_text' => '',
        ],
    ],

    'username_change' => [
        'check' => '',
        'checking' => '',
        'require_login' => [
            '_' => '',
            'link_text' => '',
        ],
    ],
];

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
    'admin' => [
        'warehouse' => 'Warehouse',
    ],

    'checkout' => [
        'cart_problems' => 'Uh oh, there are problems with your cart!',
        'cart_problems_edit' => 'Click here to go edit it.',
        'declined' => 'The payment was cancelled.',
        'error' => 'There was a problem completing your checkout :(',
        'pay' => 'Checkout with Paypal',
        'pending_checkout' => [
            'line_1' => 'A previous checkout was started but did not finish.',
            'line_2' => 'Resume your checkout by selecting a payment method, or :link to cancel.',
            'link_text' => 'click here',
        ],
        'delayed_shipping' => 'We are currently overwhelmed with orders! You are welcome to place your order, but please expect an **additional 1-2 week delay** while we catch up with existing orders.',
    ],

    'discount' => 'save :percent%',

    'order' => [
        'item' => [
            'display_name' => [
                'supporter_tag' => ':name for :username (:duration)',
            ],
            'quantity' => 'Quantity',
        ],
    ],

    'product' => [
        'name' => 'Name',

        'stock' => [
            'out' => 'This item is currently out of stock. Check back later!',
            'out_with_alternative' => 'Unfortunately this item is out of stock. Use the dropdown to choose a different type or check back later!',
        ],

        'add_to_cart' => 'Add to Cart',
        'notify' => 'Notify me when available!',

        'notification_success' => 'you will be notified when we have new stock. click :link to cancel',
        'notification_remove_text' => 'here',

        'notification_in_stock' => 'This product is already in stock!',
    ],

    'supporter_tag' => [
        'gift' => 'gift to player',
        'require_login' => [
            '_' => 'You need to be :link to get a supporter tag!',
            'link_text' => 'logged in',
        ],
    ],

    'username_change' => [
        'require_login' => [
            '_' => 'You need to be :link to change your name!',
            'link_text' => 'logged in',
        ],
    ],
];

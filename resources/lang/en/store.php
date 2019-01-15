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
        'warehouse' => 'Warehouse',
    ],

    'cart' => [
        'checkout' => 'Checkout',
        'more_goodies' => 'I want to check out more goodies before completing the order',
        'shipping_fees' => 'shipping fees',
        'title' => 'Shopping Cart',
        'total' => 'total',

        'errors_no_checkout' => [
            'line_1' => 'Uh oh, there are problems with your cart preventing a checkout!',
            'line_2' => 'Remove or update items above to continue.',
        ],

        'empty' => [
            'text' => 'Your cart is empty.',
            'return_link' => [
                '_' => 'Return to the :link to find some goodies!',
                'link_text' => 'store listing',
            ],
        ],
    ],

    'checkout' => [
        'cart_problems' => 'Uh oh, there are problems with your cart!',
        'cart_problems_edit' => 'Click here to go edit it.',
        'declined' => 'The payment was cancelled.',
        'delayed_shipping' => 'We are currently overwhelmed with orders! You are welcome to place your order, but please expect an **additional 1-2 week delay** while we catch up with existing orders.',
        'old_cart' => 'Your cart appears to be out of date and has been reloaded, please try again.',
        'pay' => 'Checkout with Paypal',

        'has_pending' => [
            '_' => 'You have incomplete checkouts, click :link to view them.',
            'link_text' => 'here',
        ],

        'pending_checkout' => [
            'line_1' => 'A previous checkout was started but did not finish.',
            'line_2' => 'Resume your checkout by selecting a payment method.',
        ],
    ],

    'discount' => 'save :percent%',

    'invoice' => [
        'echeck_delay' => 'As your payment was an eCheck, please allow up to 10 extra days for the payment to clear through PayPal!',
        'status' => [
            'processing' => [
                'title' => 'Your payment has not yet been confirmed!',
                'line_1' => 'If you have already paid, we may still be waiting to receive confirmation of your payment. Please refresh this page in a minute or two!',
                'line_2' => [
                    '_' => 'If you encountered a problem during checkout, :link',
                    'link_text' => 'click here to resume your checkout',
                ],
            ],
        ],
    ],

    'mail' => [
        'payment_completed' => [
            'subject' => 'We received your osu!store order!',
        ],
    ],

    'order' => [
        'paid_on' => 'Order placed :date',

        'invoice' => 'View Invoice',
        'no_orders' => 'No orders to view.',

        'item' => [
            'display_name' => [
                'supporter_tag' => ':name for :username (:duration)',
            ],
            'quantity' => 'Quantity',
        ],

        'not_modifiable_exception' => [
            'cancelled' => 'You cannot modify your order as it has been cancelled.',
            'checkout' => 'You cannot modify your order while it is being processed.', // checkout and processing should have the same message.
            'default' => 'Order is not modifiable',
            'delivered' => 'You cannot modify your order as it has already been delivered.',
            'paid' => 'You cannot modify your order as it has already been paid for.',
            'processing' => 'You cannot modify your order while it is being processed.',
            'shipped' => 'You cannot modify your order as it has already been shipped.',
        ],

        'status' => [
            'cancelled' => 'Cancelled',
            'checkout' => 'Preparing',
            'delivered' => 'Delivered',
            'paid' => 'Paid',
            'processing' => 'Pending confirmation',
            'shipped' => 'In Transit',
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
            '_' => 'You need to be :link to get an osu!supporter tag!',
            'link_text' => 'signed in',
        ],
    ],

    'username_change' => [
        'check' => 'Enter a username to check availability!',
        'checking' => 'Checking availability of :username...',
        'require_login' => [
            '_' => 'You need to be :link to change your name!',
            'link_text' => 'signed in',
        ],
    ],
];

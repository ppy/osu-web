<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'cart' => [
        'checkout' => 'Checkout',
        'empty_cart' => 'Remove all items from cart',
        'info' => ':count_delimited item in cart ($:subtotal)|:count_delimited items in cart ($:subtotal)',
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
        'hide_from_activity' => 'Hide all osu!supporter tags in this order from my activity',
        'old_cart' => 'Your cart appears to be out of date and has been reloaded, please try again.',
        'pay' => 'Checkout with Paypal',
        'title_compact' => 'checkout',

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
    'free' => 'free!',

    'invoice' => [
        'contact' => 'Contact:',
        'date' => 'Date:',
        'echeck_delay' => 'As your payment was an eCheck, please allow up to 10 extra days for the payment to clear through PayPal!',
        'hide_from_activity' => 'osu!supporter tags in this order are not displayed in your recent activities.',
        'sent_via' => 'Sent Via:',
        'shipping_to' => 'Shipping To:',
        'title' => 'Invoice',
        'title_compact' => 'invoice',

        'status' => [
            'cancelled' => [
                'title' => 'Your order has been cancelled',
                'line_1' => [
                    '_' => "If you didn't request a cancellation please contact :link quoting your order number (#:order_number).",
                    'link_text' => 'osu!store support',
                ],
            ],
            'delivered' => [
                'title' => 'Your order has been delivered! We hope you are enjoying it!',
                'line_1' => [
                    '_' => 'If you have any issues with your purchase, please contact the :link.',
                    'link_text' => 'osu!store support',
                ],
            ],
            'prepared' => [
                'title' => 'Your order is being prepared!',
                'line_1' => 'Please wait a bit longer for it to be shipped. Tracking information will appear here once the order has been processed and sent. This can take up to 5 days (but usually less!) depending on how busy we are.',
                'line_2' => 'We send all orders from Japan using a variety of shipping services depending on the weight and value. This area will update with specifics once we have shipped the order.',
            ],
            'processing' => [
                'title' => 'Your payment has not yet been confirmed!',
                'line_1' => 'If you have already paid, we may still be waiting to receive confirmation of your payment. Please refresh this page in a minute or two!',
                'line_2' => [
                    '_' => 'If you encountered a problem during checkout, :link',
                    'link_text' => 'click here to resume your checkout',
                ],
            ],
            'shipped' => [
                'title' => 'Your order has been shipped!',
                'tracking_details' => 'Tracking details follow:',
                'no_tracking_details' => [
                    '_' => "We don't have tracking details as we sent your package via Air Mail, but you can expect to receive it within 1-3 weeks. For Europe, sometimes customs can delay the order out of our control. If you have any concerns, please reply to the order confirmation email you received (or :link).",
                    'link_text' => 'send us an email',
                ],
            ],
        ],
    ],

    'order' => [
        'cancel' => 'Cancel Order',
        'cancel_confirm' => 'This order will be cancelled and payment will not be accepted for it. The payment provider might not release any reserved funds immediately. Are you sure?',
        'cancel_not_allowed' => 'This order cannot be cancelled at this time.',
        'invoice' => 'View Invoice',
        'no_orders' => 'No orders to view.',
        'paid_on' => 'Order placed :date',
        'resume' => 'Resume Checkout',
        'shipping_and_handling' => 'Shipping & Handling',
        'shopify_expired' => 'The checkout link for this order has expired.',
        'subtotal' => 'Subtotal',
        'total' => 'Total',

        'details' => [
            'order_number' => 'Order #',
            'payment_terms' => 'Payment Terms',
            'salesperson' => 'Salesperson',
            'shipping_method' => 'Shipping Method',
            'shipping_terms' => 'Shipping Terms',
            'title' => 'Order Details',
        ],

        'item' => [
            'quantity' => 'quantity',

            'display_name' => [
                'supporter_tag' => ':name for :username (:duration)',
            ],

            'subtext' => [
                'supporter_tag' => 'Message: :message',
            ],
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
            'shipped' => 'Shipped',
            'title' => 'Order Status',
        ],

        'thanks' => [
            'title' => 'Thanks for your order!',
            'line_1' => [
                '_' => 'You will receive a confirmation email soon. If you have any enquiries, please :link!',
                'link_text' => 'contact us',
            ],
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
        'gift_message' => 'add an optional message to your gift! (up to :length characters)',

        'require_login' => [
            '_' => 'You need to be :link to get an osu!supporter tag!',
            'link_text' => 'signed in',
        ],
    ],

    'username_change' => [
        'check' => 'Enter a username to check availability!',
        'checking' => 'Checking availability of :username...',
        'placeholder' => 'Requested Username',
        'label' => 'New Username',
        'current' => 'Your current username is ":username".',

        'require_login' => [
            '_' => 'You need to be :link to change your name!',
            'link_text' => 'signed in',
        ],
    ],

    'xsolla' => [
        'distributor' => 'Xsolla is an authorised<br>global distributor of osu!',
    ],
];

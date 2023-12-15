<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'cart' => [
        'checkout' => 'Pirkuma noformēšana',
        'empty_cart' => '',
        'info' => '',
        'more_goodies' => '',
        'shipping_fees' => 'piegādes maksas',
        'title' => 'Iepirkumu grozs',
        'total' => 'kopā',

        'errors_no_checkout' => [
            'line_1' => '',
            'line_2' => '',
        ],

        'empty' => [
            'text' => 'Jūsu grozs ir tukšs.',
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
        'delayed_shipping' => '',
        'hide_from_activity' => 'Slēpt visus osu!supporter tagus šajā pasūtījumā no manas aktivitātes',
        'old_cart' => '',
        'pay' => '',
        'title_compact' => '',

        'has_pending' => [
            '_' => '',
            'link_text' => 'šeit',
        ],

        'pending_checkout' => [
            'line_1' => '',
            'line_2' => '',
        ],
    ],

    'discount' => 'atlaide :percent %',
    'free' => '',

    'invoice' => [
        'contact' => '',
        'date' => '',
        'echeck_delay' => '',
        'hide_from_activity' => 'osu!supporter tagi šajā pasūtījumā netiek rādīti jūsu nesenajās aktivitātēs.',
        'sent_via' => '',
        'shipping_to' => '',
        'title' => '',
        'title_compact' => '',

        'status' => [
            'cancelled' => [
                'title' => '',
                'line_1' => [
                    '_' => "",
                    'link_text' => '',
                ],
            ],
            'delivered' => [
                'title' => '',
                'line_1' => [
                    '_' => '',
                    'link_text' => '',
                ],
            ],
            'prepared' => [
                'title' => '',
                'line_1' => '',
                'line_2' => '',
            ],
            'processing' => [
                'title' => '',
                'line_1' => '',
                'line_2' => [
                    '_' => '',
                    'link_text' => '',
                ],
            ],
            'shipped' => [
                'title' => '',
                'tracking_details' => '',
                'no_tracking_details' => [
                    '_' => "",
                    'link_text' => '',
                ],
            ],
        ],
    ],

    'order' => [
        'cancel' => '',
        'cancel_confirm' => '',
        'cancel_not_allowed' => '',
        'invoice' => '',
        'no_orders' => '',
        'paid_on' => '',
        'resume' => '',
        'shipping_and_handling' => '',
        'shopify_expired' => '',
        'subtotal' => '',
        'total' => '',

        'details' => [
            'order_number' => '',
            'payment_terms' => '',
            'salesperson' => '',
            'shipping_method' => '',
            'shipping_terms' => '',
            'title' => '',
        ],

        'item' => [
            'quantity' => 'Daudzums',

            'display_name' => [
                'supporter_tag' => ':name priekš :username (:duration)',
            ],

            'subtext' => [
                'supporter_tag' => '',
            ],
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

        'status' => [
            'cancelled' => 'Atcelts',
            'checkout' => 'Sagatavošana',
            'delivered' => 'Piegādāts',
            'paid' => 'Samaksāts',
            'processing' => 'Gaida apstiprinājumu',
            'shipped' => 'Izsūtīts',
            'title' => '',
        ],

        'thanks' => [
            'title' => '',
            'line_1' => [
                '_' => '',
                'link_text' => '',
            ],
        ],
    ],

    'product' => [
        'name' => 'Vārds',

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
        'gift_message' => '',

        'require_login' => [
            '_' => 'Jums ir nepiciešams būt :link, lai iegūtu osu!supporter!',
            'link_text' => '',
        ],
    ],

    'username_change' => [
        'check' => '',
        'checking' => '',
        'placeholder' => '',
        'label' => '',
        'current' => '',

        'require_login' => [
            '_' => '',
            'link_text' => '',
        ],
    ],

    'xsolla' => [
        'distributor' => '',
    ],
];

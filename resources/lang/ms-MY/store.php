<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'cart' => [
        'checkout' => 'Daftar keluar',
        'empty_cart' => 'Buang semua barang dari kereta sorong',
        'info' => ':count_delimited barang dalam kereta sorong ($:subtotal)|:count_delimited barang dalam kereta sorong ($:subtotal)',
        'more_goodies' => 'Saya nak tengok lagi cenderahati sebelum habiskan pesanan',
        'shipping_fees' => 'yuran hantaran',
        'title' => 'Kereta Sorong Beli-Belah',
        'total' => 'jumlah',

        'errors_no_checkout' => [
            'line_1' => 'Alamak, ada masalah dengan barang awak yang menghalang daftar keluar!',
            'line_2' => 'Buang atau kemaskini barang diatas untuk sambung.',
        ],

        'empty' => [
            'text' => 'Kereta sorong anda kosong.',
            'return_link' => [
                '_' => 'Kembali ke :link untuk cari beberapa cenderahati!',
                'link_text' => 'senarai kedai',
            ],
        ],
    ],

    'checkout' => [
        'cart_problems' => 'Alamak, ada masalah dengan barang awak!',
        'cart_problems_edit' => 'Tekan sini untuk sunting ia.',
        'declined' => 'Pembayaran telah dibatalkan.',
        'delayed_shipping' => 'Kami sedang mengalami pesanan yang banyak! Anda dialu-alukan meletak pesanan anda tetapi sila jangkakan **kelewatan seminggu atau dua** sambil kami mengurus pesanan semasa.',
        'hide_from_activity' => 'Sorokkan semua tag osu!supporter dalam pesanan ini dari aktiviti saya',
        'old_cart' => 'Kereta sorong anda nampaknya telah tamat tempoh dan sudah dimuatkan semula, sila cuba lagi.',
        'pay' => 'Daftar keluar dengan Paypal',
        'title_compact' => 'daftar keluar',

        'has_pending' => [
            '_' => 'Anda mempunyai daftar keluar tidak lengkap, tekan :link untuk melihatnya.',
            'link_text' => 'sini',
        ],

        'pending_checkout' => [
            'line_1' => 'Daftar keluar dimulakan sebelum ini tetapi tidak dilunaskan.',
            'line_2' => 'Sambung daftar keluar dengan memilih kaedah pembayaran.',
        ],
    ],

    'discount' => 'diskaun :percent%',
    'free' => 'percuma!',

    'invoice' => [
        'contact' => 'Hubungi:',
        'date' => 'Tarikh:',
        'echeck_delay' => 'Oleh kerana bayaran anda berupa eCheck, sila benarkan sampai 10 hari tambahan untuk bayaran ini untuk diproses PayPal!',
        'hide_from_activity' => '',
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
            'quantity' => '',

            'display_name' => [
                'supporter_tag' => '',
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
            'cancelled' => '',
            'checkout' => '',
            'delivered' => '',
            'paid' => '',
            'processing' => '',
            'shipped' => '',
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
        'gift_message' => '',

        'require_login' => [
            '_' => '',
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

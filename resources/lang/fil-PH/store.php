<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'admin' => [
        'warehouse' => 'Bodega',
    ],

    'cart' => [
        'checkout' => 'Checkout',
        'info' => ':count_delimited pirasong item sa kariton ($:subtotal)|:count_delimited pirasong mga item sa kariton ($:subtotal)',
        'more_goodies' => 'Gusto kong tingnan ang higit pang mga goodies bago makumpleto ang order',
        'shipping_fees' => 'mga bayarin sa pagpapadala',
        'title' => 'Shopping Cart',
        'total' => 'kabuuan',

        'errors_no_checkout' => [
            'line_1' => 'Naku, may mga problema sa iyong cart na pumipigil sa pag-checkout!',
            'line_2' => 'Tanggalin o i-update ang mga bagay na nasa itaas upang magpatuloy.',
        ],

        'empty' => [
            'text' => 'Walang laman ang cart mo.',
            'return_link' => [
                '_' => 'Bumalik sa :link upang mahanap ang ilang mga goodies!',
                'link_text' => 'mga bilihin',
            ],
        ],
    ],

    'checkout' => [
        'cart_problems' => 'Naku, may mga problema sa iyong cart!',
        'cart_problems_edit' => 'Mag-click dito para i-edit ito.',
        'declined' => 'Nakansela ang bayad.',
        'delayed_shipping' => 'Kami ay punong puno ng mga order! Maari kang maglagay ng order, pero maaring mahintulot ang iyong order ng mga 1-2 linggo habang inaasikaso namin ang mga order sa ngayon.',
        'old_cart' => 'Dahil matagal na panahon na ang lumipas, ini-load muli ang iyong kariton, mangyaring subukang muli.',
        'pay' => 'Paglabas gamit ang Paypal',
        'title_compact' => 'checkout',

        'has_pending' => [
            '_' => 'Ikaw ay may mga checkout na hindi kumpleto, i-click ang :link para makita.',
            'link_text' => 'dito',
        ],

        'pending_checkout' => [
            'line_1' => 'May nakaraang checkout na nasimulan pero hindi natapos.',
            'line_2' => 'Pumili ng payment method para matuloy ang checkout.',
        ],
    ],

    'discount' => 'makatipid ng :percent%',

    'invoice' => [
        'echeck_delay' => 'Dahil ang pagbayad ay eCheck, maari pong magantay ng 10 araw para dumaan ng PayPal ang iyong bayarin!',
        'title_compact' => 'invoice',

        'status' => [
            'processing' => [
                'title' => 'Hindi pa kumpirmado ang iyong bayad!',
                'line_1' => 'Pag nakapagbayad kana, baka inaantay pa namin na makuha ang confirmation ng bayarin. i refresh ang page mamaya!',
                'line_2' => [
                    '_' => 'Pag nagkaproblema sa checkout, :link',
                    'link_text' => 'click para matuloy ang checkout',
                ],
            ],
        ],
    ],

    'order' => [
        'cancel' => 'Ikansela ang Order',
        'cancel_confirm' => 'Ang order na dito ay iccancel at ang bayarin ay hindi tatanggapin. Ang payment provider ay maaring hindi agad mag release ng nakatagong pondo. Sure ka ba?',
        'cancel_not_allowed' => 'Ang order na ito ay hindi na ma cancel.',
        'invoice' => 'Tingnan ang Invois',
        'no_orders' => 'Walang maipakitang order.',
        'paid_on' => 'Ipinasa ang order noong :date',
        'resume' => 'Bumalik sa Checkout',
        'shopify_expired' => 'Ang link ng checkout para sa order na ito ay nag-expire na.',

        'item' => [
            'display_name' => [
                'supporter_tag' => ':name para kay :username (:duration)',
            ],
            'quantity' => 'Dami',
        ],

        'not_modifiable_exception' => [
            'cancelled' => 'Hindi mo maaaring baguhin ang iyong order dahil nakasela ito.',
            'checkout' => 'Hindi mo maaaring baguhin ang iyong order habang ipinoproseso ito.', // checkout and processing should have the same message.
            'default' => 'Hindi pwedeng baguhin ang order',
            'delivered' => 'Hindi mo maaaring baguhin ang iyong order dahil nahatid na ito.',
            'paid' => 'Hindi mo maaaring baguhin ang iyong order dahil nabayad na ito.',
            'processing' => 'Hindi mo maaaring baguhin ang iyong order habang ipinoproseso ito.',
            'shipped' => 'Hindi mo maaaring baguhin ang iyong order dahil nabayad na ito.',
        ],

        'status' => [
            'cancelled' => 'Kanselado',
            'checkout' => 'Inihahanda',
            'delivered' => 'Naihatid',
            'paid' => 'Paid',
            'processing' => 'Naghihintay ng kumpirmasyon',
            'shipped' => 'Naipadala',
        ],
    ],

    'product' => [
        'name' => 'Pangalan',

        'stock' => [
            'out' => 'Naubos na ang bagay na ito. Tingnan mo muli mamaya!',
            'out_with_alternative' => 'Sa kasamaang palad ang item na ito ay wala sa stock. Gamitin ang dropdown upang pumili ng ibang uri o suriin muli sa ibang pagkakataon!',
        ],

        'add_to_cart' => 'Idagdag sa kart',
        'notify' => 'Abisuhan ako kapag available!',

        'notification_success' => 'maabisuhan ka kapag may mga bagong stock. i-click ang :link upang kanselahin',
        'notification_remove_text' => 'nandito',

        'notification_in_stock' => 'Ang produktong ito ay nasa stock na!',
    ],

    'supporter_tag' => [
        'gift' => 'regalo sa manlalaro',
        'require_login' => [
            '_' => 'Kailangan mong :link upang makakuha ng osu! Supporter tag!',
            'link_text' => 'naka-sign in',
        ],
    ],

    'username_change' => [
        'check' => 'Mag-type ng username upang suriin ang kakayahang magamit!',
        'checking' => 'Sinusuri ang availability ng :username...',
        'require_login' => [
            '_' => 'Kailangan mong maging :link upang baguhin ang iyong pangalan!',
            'link_text' => 'naka-sign in',
        ],
    ],

    'xsolla' => [
        'distributor' => '',
    ],
];

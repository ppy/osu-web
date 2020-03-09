<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
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
        'warehouse' => 'Bodega',
    ],

    'cart' => [
        'checkout' => 'Checkout',
        'info' => '',
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
                'link_text' => '',
            ],
        ],
    ],

    'checkout' => [
        'cart_problems' => 'Naku, may mga problema sa iyong cart!',
        'cart_problems_edit' => 'Mag-click dito para i-edit ito.',
        'declined' => 'Nakansela ang bayad.',
        'delayed_shipping' => '',
        'old_cart' => '',
        'pay' => 'Paglabas gamit ang Paypal',

        'has_pending' => [
            '_' => '',
            'link_text' => '',
        ],

        'pending_checkout' => [
            'line_1' => '',
            'line_2' => '',
        ],
    ],

    'discount' => '',

    'invoice' => [
        'echeck_delay' => '',
        'status' => [
            'processing' => [
                'title' => '',
                'line_1' => '',
                'line_2' => [
                    '_' => '',
                    'link_text' => '',
                ],
            ],
        ],
    ],

    'order' => [
        'paid_on' => '',

        'invoice' => '',
        'no_orders' => '',
        'resume' => '',

        'item' => [
            'display_name' => [
                'supporter_tag' => '',
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
            'cancelled' => '',
            'checkout' => '',
            'delivered' => '',
            'paid' => '',
            'processing' => '',
            'shipped' => '',
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

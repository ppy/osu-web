<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'cart' => [
        'checkout' => 'Checkout',
        'empty_cart' => 'Tanggalin lahat ng items sa cart',
        'info' => ':count_delimited pirasong item sa kariton ($:subtotal)|:count_delimited pirasong mga item sa kariton ($:subtotal)',
        'more_goodies' => 'Gusto kong tingnan ang higit pang mga goodies bago makumpleto ang order',
        'shipping_fees' => 'mga bayarin sa pagpapadala',
        'title' => 'Shopping Cart',
        'total' => 'kabuuan',

        'errors_no_checkout' => [
            'line_1' => 'Naku, may mga problema sa iyong cart na pumipigil sa pag-checkout!',
            'line_2' => 'Mag-alis o mag-update ng mga aytem sa itaas para maipagpatuloy.',
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
        'hide_from_activity' => 'Itago ang lahat ng mga tag ng osu!supporter sa pagkakasunud-sunod na ito mula sa aking aktibidad',
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
    'free' => 'free!',

    'invoice' => [
        'contact' => 'Kontak:',
        'date' => 'Petsa:',
        'echeck_delay' => 'Dahil ang pagbayad ay eCheck, maari pong magantay ng 10 araw para dumaan ng PayPal ang iyong bayarin!',
        'echeck_denied' => '',
        'hide_from_activity' => 'ang mga tag ng osu!supporter sa pagkakasunud-sunod na ito ay hindi ipinapakita sa iyong kamakailang mga aktibidad.',
        'sent_via' => 'Naipadala sa pamamagitan ng:',
        'shipping_to' => 'Ipapadala sa:',
        'title' => 'Invoice',
        'title_compact' => 'invoice',

        'status' => [
            'cancelled' => [
                'title' => 'Ang iyong order ay kinansela',
                'line_1' => [
                    '_' => "Kung hindi ka humiling ng pagkansela, pakikontak sa :link na nakasipi ang numero ng iyong order (#:order_number).",
                    'link_text' => 'suporta ng osu!store',
                ],
            ],
            'delivered' => [
                'title' => 'Ang iyong order ay naihatid na! Umaasa kami na natutuwa ka nito!',
                'line_1' => [
                    '_' => 'Kung mayroon kang anumang mga isyu sa iyong pagbili, pakikontak sa :link.',
                    'link_text' => 'suporta ng osu!store',
                ],
            ],
            'prepared' => [
                'title' => 'Ang iyong order ay inihahanda!',
                'line_1' => 'Pakihintay ng kaunti pa upang maipadala ito. Ang impormasyon sa pagsubaybay ay lalabas dito kapag naproseso at naipadala na ang order. Ito ay maaaring tumagal ng hanggang 5 araw (ngunit kadalasang mas kaunti!) depende sa kung gaano kami ka-busy.',
                'line_2' => 'Ipinapadala namin ang lahat ng mga order mula sa Japan gamit ang iba\'t ibang serbisyo sa pagpapadala depende sa bigat at halaga. Ang lugar na ito ay mag-a-update ng mga espesipiko kapag naipadala na namin ang order.',
            ],
            'processing' => [
                'title' => 'Hindi pa kumpirmado ang iyong bayad!',
                'line_1' => 'Pag nakapagbayad kana, baka inaantay pa namin na makuha ang confirmation ng bayarin. i refresh ang page mamaya!',
                'line_2' => [
                    '_' => 'Pag nagkaproblema sa checkout, :link',
                    'link_text' => 'click para matuloy ang checkout',
                ],
            ],
            'shipped' => [
                'title' => 'Ang iyong order ay naipadala na!',
                'tracking_details' => 'Ang mga detalye ng pagsubaybay ay ang sumusunod:',
                'no_tracking_details' => [
                    '_' => "Wala kaming mga detalye sa pagsubaybay habang ipinadala namin ang iyong package sa pamamagitan ng Air Mail, ngunit maaari mong asahan na matatanggap ito sa loob ng 1-3 linggo. Para sa Europa, kung minsan ang customs ay maaaring magpabagal ng order sa labas ng aming kontrol. Kung mayroon kang anumang mga alalahanin, pakitugon sa email ng kumpirmasyon ng order na natanggap mo (o :link).",
                    'link_text' => 'magpadala sa amin ng isang email',
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
        'shipping_and_handling' => 'Pagpapadala at Pangangasiwa',
        'shopify_expired' => 'Ang link ng checkout para sa order na ito ay nag-expire na.',
        'subtotal' => 'Subtotal',
        'total' => 'Kabuuan',

        'details' => [
            'order_number' => 'Order #',
            'payment_terms' => 'Mga tuntunin sa Pagbabayad',
            'salesperson' => 'Salesperson',
            'shipping_method' => 'Pamamaraan sa Pagpapadala',
            'shipping_terms' => 'Mga tuntunin sa Pagpapadala',
            'title' => 'Mga Detalye ng Pag-order',
        ],

        'item' => [
            'quantity' => 'Dami',

            'display_name' => [
                'supporter_tag' => ':name para kay :username (:duration)',
            ],

            'subtext' => [
                'supporter_tag' => 'Mensahe: :message',
            ],
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
            'title' => 'Status ng Order',
        ],

        'thanks' => [
            'title' => 'Salamat sa iyong order!',
            'line_1' => [
                '_' => 'Makakatanggap ka ng email ng kumpirmasyon sa lalong madaling panahon. Kung mayroon kang anumang mga katanungan, paki :link!',
                'link_text' => 'kontakin kami',
            ],
        ],
    ],

    'product' => [
        'name' => 'Pangalan',

        'stock' => [
            'out' => 'Kasalukuyang wala nang stock ang aytem na ito. Suriin muli sa ibang pagkakataon!',
            'out_with_alternative' => 'Sa kasamaang palad ang aytem na ito ay wala nang stock. Gamitin ang dropdown upang pumili ng ibang uri o suriin muli sa ibang pagkakataon!',
        ],

        'add_to_cart' => 'Idagdag sa kart',
        'notify' => 'Abisuhan ako kapag available!',

        'notification_success' => 'maabisuhan ka kapag may mga bagong stock. i-click ang :link upang kanselahin',
        'notification_remove_text' => 'nandito',

        'notification_in_stock' => 'Ang produktong ito ay nasa stock na!',
    ],

    'supporter_tag' => [
        'gift' => 'regalo sa manlalaro',
        'gift_message' => 'magdagdag ng opsyonal na mensahe sa iyong regalo! (hanggang sa :length ka mga karakter)',

        'require_login' => [
            '_' => 'Kailangan mong :link upang makakuha ng osu! Supporter tag!',
            'link_text' => 'naka-sign in',
        ],
    ],

    'username_change' => [
        'check' => 'Mag-type ng username upang suriin ang kakayahang magamit!',
        'checking' => 'Sinusuri ang availability ng :username...',
        'placeholder' => 'Hiniling na Username',
        'label' => 'Bago na Username',
        'current' => 'Ang iyong kasalukuyang username ay ":username".',

        'require_login' => [
            '_' => 'Kailangan mong maging :link upang baguhin ang iyong pangalan!',
            'link_text' => 'naka-sign in',
        ],
    ],

    'xsolla' => [
        'distributor' => '',
    ],
];

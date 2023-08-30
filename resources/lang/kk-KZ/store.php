<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'cart' => [
        'checkout' => 'Төлеу',
        'info' => 'себеттегі :count_delimited тауар ($:subtotal)',
        'more_goodies' => 'Тапсырысты аяқтамастан бұрын басқа да тауарларды көргім келеді',
        'shipping_fees' => 'жеткізу құны',
        'title' => 'Себет',
        'total' => 'барлығы',

        'errors_no_checkout' => [
            'line_1' => 'Қап, себет мәселелері тапсырысты аяқтауға кедергі келтіруде!',
            'line_2' => 'Жалғастыру үшін жоғарыдағы тауарларды алып тастаңыз немесе жаңартыңыз.',
        ],

        'empty' => [
            'text' => 'Сіздің себетіңіз бос.',
            'return_link' => [
                '_' => 'Басқа да тауарларды табу үшін :linkге оралыңыз!',
                'link_text' => 'дүкен',
            ],
        ],
    ],

    'checkout' => [
        'cart_problems' => 'О жоқ, сіздің себетіңізбен мәселелер бар!',
        'cart_problems_edit' => 'Оны түзеу үшін мында басыңыз.',
        'declined' => 'Төлеміңіз іске аспады.',
        'delayed_shipping' => 'Дәл қазір біздегі тапсырыстар тым көп! Сіз тапсырыс бере аласыз, әрине, алайда біз жиналған тапсырыстармен әуре болып жүргенде жеткізу **1-2 аптаға кешігіп** келе алатындығын ескеріңіз.',
        'hide_from_activity' => 'Осы тапсырыстағы барлық osu!supporter тегтерін менің әрекеттерімнен жасыру ',
        'old_cart' => 'Сіздің себетіңіз ескірген немесе қайта жүктелген көрінеді. Өтініш, қайта қайталап көріңіз.',
        'pay' => 'Paypal-мен төлеу',
        'title_compact' => 'төлеу',

        'has_pending' => [
            '_' => 'Сізде бітпеген төлемдер бар, оларды көру үшін :link басыңыз.',
            'link_text' => 'мында',
        ],

        'pending_checkout' => [
            'line_1' => 'Алдыңғы төлеміңіз басталған бірақ әлі аяқталмады.',
            'line_2' => 'Төлем тәсілін таңдау арқылы төлеуді жалғастырыңыз.',
        ],
    ],

    'discount' => ':percent% үнемдеу',

    'invoice' => [
        'echeck_delay' => 'Төлеміңіз eCheck арқылы жүргізілгендіктен төлемнің Paypal арқылы расталуы 10 күнге дейін созылуы мүмкін!',
        'hide_from_activity' => 'Осы тапсырыстағы osu!supporter тегтері сіздің соңғы әрекеттеріңізде көрсетілмеген.',
        'title_compact' => 'чек',

        'status' => [
            'processing' => [
                'title' => 'Сіздің төлеміңіз әлі расталмады!',
                'line_1' => 'Сіз төлеп қойсаңыз да біз әлі де төлеміңіздің расталуын күтуіміз мүмкін. Өтініш, осы бетті бір-екі минутта жаңартыңыз!',
                'line_2' => [
                    '_' => 'Егер төлеу барысында мәселеге ұшырасаңыз :link',
                    'link_text' => 'төлеміңізді жалғастыру үшін мында басыңыз',
                ],
            ],
        ],
    ],

    'order' => [
        'cancel' => 'Тапсырысты жою',
        'cancel_confirm' => '',
        'cancel_not_allowed' => '',
        'invoice' => '',
        'no_orders' => '',
        'paid_on' => '',
        'resume' => '',
        'shopify_expired' => '',

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
        'require_login' => [
            '_' => '',
            'link_text' => '',
        ],
    ],

    'xsolla' => [
        'distributor' => '',
    ],
];

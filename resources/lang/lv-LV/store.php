<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'cart' => [
        'checkout' => 'Pirkuma norēķināšanās ',
        'empty_cart' => 'Noņemt visas preces no groza',
        'info' => ':count_delimited prece grozā ($:subtotal)|:count_delimited prece grozā ($:subtotal)',
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
                '_' => 'Atgriezties uz :link lai atrastu dažus labumiņus!',
                'link_text' => '',
            ],
        ],
    ],

    'checkout' => [
        'cart_problems' => 'Ak nē, ir izveidojušās problēmas ar tavu grozu!',
        'cart_problems_edit' => '',
        'declined' => '',
        'delayed_shipping' => '',
        'hide_from_activity' => 'Slēpt visus osu!supporter tagus šajā pasūtījumā no manas aktivitātes',
        'old_cart' => '',
        'pay' => 'Norēķināties ar PayPal',
        'title_compact' => 'norēķināšanās',

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
    'free' => 'par brīvu!',

    'invoice' => [
        'contact' => 'Sazinies:',
        'date' => 'Datums:',
        'echeck_delay' => 'Tā kā jūsu samakasa bija e-samaksa, lūdzu pagaidīt līdz 10 papildus dienām, lai samaksa izietu cauri PayPal!',
        'hide_from_activity' => 'osu!supporter tagi šajā pasūtījumā netiek rādīti jūsu nesenajās aktivitātēs.',
        'sent_via' => 'Aizsūtīt Caur:',
        'shipping_to' => 'Aizsūtīt Uz:',
        'title' => 'Rēķins',
        'title_compact' => 'rēķins',

        'status' => [
            'cancelled' => [
                'title' => 'Jūsu pasūtījums ir atcelts ',
                'line_1' => [
                    '_' => "",
                    'link_text' => 'osu!veikala atbalsts',
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
                    '_' => 'Ja tu sastapies ar problēmu, kamēr norēķinājies, :link',
                    'link_text' => 'uzspiest šeit lai turpinātu norēķināšanos',
                ],
            ],
            'shipped' => [
                'title' => 'Tavs pasūtījums ir piegādāts!',
                'tracking_details' => 'Izsekošanas saturs seko:',
                'no_tracking_details' => [
                    '_' => "",
                    'link_text' => 'atsūti mums e-pastu',
                ],
            ],
        ],
    ],

    'order' => [
        'cancel' => 'Atcelt Pasūtījumu',
        'cancel_confirm' => 'Šo pasūtījumu atcels un samaksa netiks pieņemta par to. Samaksas apgādātājs iespējams neatgriezīs naudu uzreiz. Vai tu esi drošs?',
        'cancel_not_allowed' => 'Šo pasūtījumu pašlaik nevar atcelt.',
        'invoice' => 'Apskatīt Čeku',
        'no_orders' => 'Nav redzamu pasūtījumu.',
        'paid_on' => 'Pasūtījums apstiprināts :date',
        'resume' => 'Turpināt Norēķināšanos',
        'shipping_and_handling' => 'Transportēšana & Apstrāde',
        'shopify_expired' => 'Šī pasūtījuma norēķināšanās saitei ir beidzies derīguma termiņš.',
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
            'link_text' => 'pierakstījies',
        ],
    ],

    'username_change' => [
        'check' => 'Ievadi lietotājvārdu lai redzētu tā pieejamību!',
        'checking' => '',
        'placeholder' => '',
        'label' => '',
        'current' => '',

        'require_login' => [
            '_' => '',
            'link_text' => 'pierakstījies',
        ],
    ],

    'xsolla' => [
        'distributor' => '',
    ],
];

<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'admin' => [
        'warehouse' => 'Sandėlys',
    ],

    'cart' => [
        'checkout' => 'Apmokėti',
        'info' => '',
        'more_goodies' => 'Noriu išsirinkti daugiau prekių prieš apmokant',
        'shipping_fees' => 'pristatymo mokesčiai',
        'title' => 'Prekių Krepšelis',
        'total' => 'iš viso',

        'errors_no_checkout' => [
            'line_1' => 'Ups, yra problemų su tavo prekių krepšeliu kurios neleidžia apmokėti!',
            'line_2' => 'Ištrinti arba atnaujinti viršuje esančias prekes prieš tęsiant.',
        ],

        'empty' => [
            'text' => 'Jūsų krepšelis yra tuščias.',
            'return_link' => [
                '_' => 'Tam, kad rastum prekių, grįžk į :link!',
                'link_text' => 'prekių sąrašas',
            ],
        ],
    ],

    'checkout' => [
        'cart_problems' => 'Ups, atsirado problemų su tavo prekių krepšeliu!',
        'cart_problems_edit' => 'Norint redaguoti spausk čia.',
        'declined' => 'Apmokėjimas buvo atšauktas.',
        'delayed_shipping' => 'Šiuo metu yra labai daug užsakymų! Maloniai kviečiame užsakyti prekes, tačiau prekės **papildomai vėluos 1-2 savaites** iki kol mes susidorosime su dabartiniais užsakymais.',
        'old_cart' => 'Tavo prekių krepšelis atrodo nebuvo atnaujintas, pamėgink dar kartą.',
        'pay' => 'Apmokėti su Paypal',
        'title_compact' => '',

        'has_pending' => [
            '_' => '',
            'link_text' => '',
        ],

        'pending_checkout' => [
            'line_1' => 'Ankstesnis apmokėjimas buvo pradėtas bet nebaigtas.',
            'line_2' => '',
        ],
    ],

    'discount' => 'sutaupyk :percent%',

    'invoice' => [
        'echeck_delay' => '',
        'title_compact' => '',

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
        'cancel' => '',
        'cancel_confirm' => '',
        'cancel_not_allowed' => '',
        'invoice' => '',
        'no_orders' => '',
        'paid_on' => '',
        'resume' => '',
        'shopify_expired' => '',

        'item' => [
            'display_name' => [
                'supporter_tag' => '',
            ],
            'quantity' => 'Kiekis',
        ],

        'not_modifiable_exception' => [
            'cancelled' => 'Užsakymo negalima redaguoti nes jis buvo atšauktas.',
            'checkout' => 'Kol užsakymas yra apdorojamas jo negalima redaguoti.', // checkout and processing should have the same message.
            'default' => 'Užsakymo redaguoti negalima',
            'delivered' => 'Užsakymas jau pristatytas, todėl jo redaguoti nebegalima.',
            'paid' => 'Užsakymo negalima redaguoti nes jis jau apmokėtas.',
            'processing' => 'Kol užsakymas yra apdorojamas jo negalima redaguoti.',
            'shipped' => 'Užsakymas jau išsiųstas todėl jo redaguoti nebegalima.',
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
        'name' => 'Vardas',

        'stock' => [
            'out' => 'Šios prekės nebeturime. Patikrinkite vėliau!',
            'out_with_alternative' => 'Deja ši prekė jau išparduota. Naudokite išskleidžiamąjį meniu ir pasirinkite kitą tipą arba užeikite vėliau!',
        ],

        'add_to_cart' => 'Įdėti į krepšelį',
        'notify' => 'Informuokite mane kai bus!',

        'notification_success' => 'kai prekė atsiras mes jums pranešime. Atšaukimui spausk :link',
        'notification_remove_text' => 'čia',

        'notification_in_stock' => 'Ši prekė jau sandėlyje!',
    ],

    'supporter_tag' => [
        'gift' => 'dovanoti žaidėjui',
        'require_login' => [
            '_' => '',
            'link_text' => '',
        ],
    ],

    'username_change' => [
        'check' => 'Patikrinimui įvesk norimą vartotojo vardą!',
        'checking' => 'Tikrinama ar galimas :username...',
        'require_login' => [
            '_' => 'Tau reikia :link, kad pakeistum vardą!',
            'link_text' => '',
        ],
    ],

    'xsolla' => [
        'distributor' => '',
    ],
];

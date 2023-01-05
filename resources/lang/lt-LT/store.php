<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'cart' => [
        'checkout' => 'Apmokėti',
        'info' => ':count_delimited pirkinis krepšelyje ($:subtotal)|:count_delimited pirkiniai krepšelyje ($:subtotal)',
        'more_goodies' => 'Noriu išsirinkti daugiau prekių prieš apmokant',
        'shipping_fees' => 'pristatymo mokesčiai',
        'title' => 'Prekių Krepšelis',
        'total' => 'iš viso',

        'errors_no_checkout' => [
            'line_1' => 'O ne, yra problemų su tavo prekių krepšeliu, kurios neleidžia apmokėti!',
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
        'cart_problems' => 'O ne, atsirado problemų su tavo prekių krepšeliu!',
        'cart_problems_edit' => 'Norint redaguoti spausk čia.',
        'declined' => 'Apmokėjimas buvo atšauktas.',
        'delayed_shipping' => 'Šiuo metu yra labai daug užsakymų! Maloniai kviečiame užsakyti prekes, tačiau prekės **papildomai vėluos 1-2 savaites** iki kol mes susidorosime su dabartiniais užsakymais.',
        'hide_from_activity' => '',
        'old_cart' => 'Tavo prekių krepšelis atrodo nebuvo atnaujintas, pamėgink dar kartą.',
        'pay' => 'Apmokėti su Paypal',
        'title_compact' => 'apmokėti',

        'has_pending' => [
            '_' => 'Turi nebaigtus apmokėjimus, spausk :link, kad juos peržiūrėti.',
            'link_text' => 'čia',
        ],

        'pending_checkout' => [
            'line_1' => 'Ankstesnis apmokėjimas buvo pradėtas bet nebaigtas.',
            'line_2' => 'Pasirink apmokėjimo būdą, kad tęsti.',
        ],
    ],

    'discount' => 'sutaupyk :percent%',

    'invoice' => [
        'echeck_delay' => 'Kadangi jūsų mokėjote el. čekiu, pervedimas gali užtrukti iki 10 dienų kol praeis per PayPal sistemą!',
        'hide_from_activity' => '',
        'title_compact' => 'sąskaita',

        'status' => [
            'processing' => [
                'title' => 'Jūsų pervedimas dar nepatvirtintas!',
                'line_1' => 'Net jei jau sumokėjote, mums dar gali būti neatėjęs jūsų pervedimo patvirtinimas. Prašome atnaujinti puslapį už minutės ar dviejų!',
                'line_2' => [
                    '_' => 'Jei turėjote problemų apmokėjimo metu, :link',
                    'link_text' => 'spauskite čia, kad tęsti apmokėjimą',
                ],
            ],
        ],
    ],

    'order' => [
        'cancel' => 'Atšaukti užsakymą',
        'cancel_confirm' => 'Šis užsakymas bus atšauktas ir mokėjimas bus nepriimtas. Mokėjimų tiekėjas ne iškart gražinti pinigus. Jūs užtikrintas?',
        'cancel_not_allowed' => 'Šio užsakymo nebegali atšaukti.',
        'invoice' => 'Peržiūrėti sąskaitą',
        'no_orders' => 'Nėra užsakymų.',
        'paid_on' => 'Užsakyta :date',
        'resume' => 'Tęsti Apmokėjimą',
        'shopify_expired' => 'Ši apmokėjimo nuoroda nebegalioja.',

        'item' => [
            'quantity' => 'Kiekis',

            'display_name' => [
                'supporter_tag' => ':name vartotojui :username (:duration)',
            ],

            'subtext' => [
                'supporter_tag' => '',
            ],
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
            'cancelled' => 'Atšaukta',
            'checkout' => 'Ruošiama',
            'delivered' => 'Pristatyta',
            'paid' => 'Apmokėta',
            'processing' => 'Laukiantis patvirtinimo',
            'shipped' => 'Išsiųsta',
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
        'gift_message' => '',

        'require_login' => [
            '_' => 'Tu turi būti :link, kad gauti osu!supporter žymę!',
            'link_text' => 'prisijungęs',
        ],
    ],

    'username_change' => [
        'check' => 'Patikrinimui įvesk norimą vartotojo vardą!',
        'checking' => 'Tikrinama ar galimas :username...',
        'require_login' => [
            '_' => 'Tau turi būti :link, kad pakeistum vardą!',
            'link_text' => 'prisijungęs',
        ],
    ],

    'xsolla' => [
        'distributor' => '',
    ],
];

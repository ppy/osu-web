<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'cart' => [
        'checkout' => 'Plačilo',
        'info' => ':count_delimited izdelek v košarici ($:subtotal)|:count_delimited izdelkov v košarici ($:subtotal)',
        'more_goodies' => 'Želim si preveriti več dobrot, preden dokončam svoje naročilo',
        'shipping_fees' => 'stroški pošiljanja',
        'title' => 'Nakupovalna košarica',
        'total' => 'skupaj',

        'errors_no_checkout' => [
            'line_1' => 'Oh ne, prišlo je do težav s tvojo nakupovalno košarico in preprečuje plačilo!',
            'line_2' => 'Preden nadaljuješ, odstrani ali posodobi izdelke zgoraj.',
        ],

        'empty' => [
            'text' => 'Tvoja nakupovalna košarica je prazna.',
            'return_link' => [
                '_' => 'Vrni se na :link, da najdeš več dobrot!',
                'link_text' => 'seznam izdelkov',
            ],
        ],
    ],

    'checkout' => [
        'cart_problems' => 'Oh ne, prišlo je do težav s tvojo nakupovalno košarico!',
        'cart_problems_edit' => 'Klikni tukaj za urejanje.',
        'declined' => 'Plačilo je bilo preklicano.',
        'delayed_shipping' => 'Trenutno imamo preveč naročil! Naročilo je dobrodošlo, ampak pričakuj **dodaten teden ali dva zamika**, da se lahko ujamemo s preostalimi naročili.',
        'hide_from_activity' => '',
        'old_cart' => 'Tvoja nakupovalna košarica je zastarela in je bila osvežena, prosimo poskusi znova.',
        'pay' => 'Plačaj s Paypal-om',
        'title_compact' => 'plačilo',

        'has_pending' => [
            '_' => 'Čakajo te nedokončana plačila, klikni :link, da si jih ogledaš.',
            'link_text' => 'tukaj',
        ],

        'pending_checkout' => [
            'line_1' => 'Prejšnji nakup se je začel, ampak nikoli ni bil zaključen.',
            'line_2' => 'Izberi način plačila preden nadaljuješ z nakupom.',
        ],
    ],

    'discount' => ':percent% popust',

    'invoice' => [
        'echeck_delay' => 'Ker je bilo tvoje plačilo narejeno z eCheck-om, prosimo počakaj vsaj do 10 dodatnih dni, da se plačilo poravna preko PayPal-a!',
        'hide_from_activity' => '',
        'title_compact' => 'račun',

        'status' => [
            'processing' => [
                'title' => 'Tvoje plačilo še ni bilo potrjeno!',
                'line_1' => 'Če si že opravil plačilo, je lahko možnost, da še vedno čakamo na potrdilo o tvojem plačilu. Prosimo osveži to stran čez minuto ali dve!',
                'line_2' => [
                    '_' => 'V primeru, da si naletel na težavo med plačilom, :link',
                    'link_text' => 'za nadaljevanje plačila klikni tukaj',
                ],
            ],
        ],
    ],

    'order' => [
        'cancel' => 'Prekliči naročilo',
        'cancel_confirm' => 'To naročilo bo preklicano in plačilo posledično ne bo sprejeto. Lahko se zgodi, da ponudnik plačilne storitve ne objavi takoj rezerviranih sredstev. Ali si prepričan?',
        'cancel_not_allowed' => 'Tega naročila trenutno ni mogoče preklicati.',
        'invoice' => 'Prikaži račun',
        'no_orders' => 'Ni nobenih naročil.',
        'paid_on' => 'Naročeno :date',
        'resume' => 'Nadaljuj s plačilom',
        'shopify_expired' => 'Povezava za plačilo tega naročila je potekla.',

        'item' => [
            'quantity' => 'Količina',

            'display_name' => [
                'supporter_tag' => ':name za :username (:duration)',
            ],

            'subtext' => [
                'supporter_tag' => '',
            ],
        ],

        'not_modifiable_exception' => [
            'cancelled' => 'Tega naročila ni možno modificirati, saj je bilo preklicano.',
            'checkout' => 'Tega naročila ni možno modificirati medtem, ko je v obdelavi.', // checkout and processing should have the same message.
            'default' => 'Naročila ni možno modificirati',
            'delivered' => 'Tega naročila ni možno modificirati, saj je bilo že dostavljeno.',
            'paid' => 'Tega naročila ni možno modificirati, saj je bilo že plačano.',
            'processing' => 'Tega naročila ni možno modificirati medtem, ko je v obdelavi.',
            'shipped' => 'Tega naročila ni možno modificirati, saj je bilo že odpremljeno.',
        ],

        'status' => [
            'cancelled' => 'Preklicano',
            'checkout' => 'V pripravi',
            'delivered' => 'Dostavljeno',
            'paid' => 'Plačano',
            'processing' => 'Čakanje na potrditev',
            'shipped' => 'Poslano',
        ],
    ],

    'product' => [
        'name' => 'Ime',

        'stock' => [
            'out' => 'Tega izdelka trenutno ni na zalogi. Preveri ponovno pozneje!',
            'out_with_alternative' => 'Žal tega izdelka ni na zalogi. Uporabi spustni meni za izbiro drugega tipa ali preveri pozneje!',
        ],

        'add_to_cart' => 'Dodaj v košarico',
        'notify' => 'Obvesti me, ko bo na voljo!',

        'notification_success' => 'obveščen boš, ko bo nova zaloga. za preklic klikni :link',
        'notification_remove_text' => 'tukaj',

        'notification_in_stock' => 'Ta izdelek je že na zalogi!',
    ],

    'supporter_tag' => [
        'gift' => 'podari igralcu',
        'gift_message' => '',

        'require_login' => [
            '_' => 'Za pridobitev osu!supporter značke moraš biti :link!',
            'link_text' => 'vpisan',
        ],
    ],

    'username_change' => [
        'check' => 'Vnesi uporabniško ime za preverjanje razpoložljivosti! ',
        'checking' => 'Preverjanje razpoložljivosti uporabniškega imena :username...',
        'require_login' => [
            '_' => 'Za spreminjanje uporabniškega imena moraš biti :link!',
            'link_text' => 'vpisan',
        ],
    ],

    'xsolla' => [
        'distributor' => '',
    ],
];

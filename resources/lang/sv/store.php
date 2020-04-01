<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'admin' => [
        'warehouse' => 'Lager',
    ],

    'cart' => [
        'checkout' => 'Checka ut',
        'info' => '',
        'more_goodies' => 'Jag vill ta en titt på fler godsaker innan jag fullbordar beställningen',
        'shipping_fees' => 'fraktavgifter',
        'title' => 'Varukorg',
        'total' => 'totalt',

        'errors_no_checkout' => [
            'line_1' => 'Oj då, det är problem med din varukorg som hindrar en utcheckning!',
            'line_2' => 'Ta bort eller uppdatera produkterna ovan för att fortsätta.',
        ],

        'empty' => [
            'text' => 'Din varukorg är tom.',
            'return_link' => [
                '_' => 'Återvänd till :link för att hitta några godsaker!',
                'link_text' => 'butikslista',
            ],
        ],
    ],

    'checkout' => [
        'cart_problems' => 'Uh oh, det finns problem med din varukorg!',
        'cart_problems_edit' => 'Klicka här för att redigera den.',
        'declined' => 'Betalningen avbröts.',
        'delayed_shipping' => 'Vi är för nuvarande överväldigad med ordrar! Du får gärna placera din order, men kommer kanske få en **extra 1-2 veckors försening** medan vi kommer ikapp alla ordrar.',
        'old_cart' => 'Din varukorg verkar vara inaktuell och har blivit återladdad, var god försök igen.',
        'pay' => 'Betala med Paypal',
        'title_compact' => '',

        'has_pending' => [
            '_' => '',
            'link_text' => 'här',
        ],

        'pending_checkout' => [
            'line_1' => 'En tidigare transaktion startades men avslutades inte.',
            'line_2' => '',
        ],
    ],

    'discount' => 'spara :percent%',

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
        'paid_on' => '',

        'invoice' => 'Visa Faktura',
        'no_orders' => '',
        'resume' => '',

        'item' => [
            'display_name' => [
                'supporter_tag' => ':name för :username (:duration)',
            ],
            'quantity' => 'Antal',
        ],

        'not_modifiable_exception' => [
            'cancelled' => 'Du kan inte ändra din beställning då den har blivit avbruten.',
            'checkout' => 'Du kan inte ändra din beställning när den bearbetas.', // checkout and processing should have the same message.
            'default' => 'Beställningen kan inte ändras',
            'delivered' => 'Du kan inte ändra din beställning då den redan har blivit levererad.',
            'paid' => 'Du kan inte ändra din beställning då den redan har betalats.',
            'processing' => 'Du kan inte ändra din beställning när den bearbetas.',
            'shipped' => 'Du kan inte ändra din beställning då den redan har skeppats.',
        ],

        'status' => [
            'cancelled' => 'Avbruten',
            'checkout' => 'Förbereder',
            'delivered' => 'Levererad',
            'paid' => '',
            'processing' => '',
            'shipped' => 'Skickad',
        ],
    ],

    'product' => [
        'name' => 'Namn',

        'stock' => [
            'out' => 'Slut i lager :(. Kolla igen snart.',
            'out_with_alternative' => 'Denna typ är för närvarande slut i lager :(. Testa andra typer eller kolla igen snart.',
        ],

        'add_to_cart' => 'Lägg till i Varukorgen',
        'notify' => 'Notifiera mig när den är tillgänglig!',

        'notification_success' => 'du kommer bli notifierad när vi har mer i lager. klicka :link för att avbryta',
        'notification_remove_text' => 'här',

        'notification_in_stock' => 'Denna produkt är redan i lager!',
    ],

    'supporter_tag' => [
        'gift' => 'present till spelare',
        'require_login' => [
            '_' => 'Du behöver vara :link för att kunna få en osu!supporter tagg!',
            'link_text' => 'inloggad',
        ],
    ],

    'username_change' => [
        'check' => 'Skriv in ett användarnamn för att kontrollera tillgänglighet!',
        'checking' => 'Kontrollerar om :username är tillgängligt...',
        'require_login' => [
            '_' => 'Du behöver var :link för att ändra ditt namn!',
            'link_text' => 'inloggad',
        ],
    ],

    'xsolla' => [
        'distributor' => '',
    ],
];

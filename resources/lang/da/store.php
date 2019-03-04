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
        'warehouse' => 'Varehus',
    ],

    'cart' => [
        'checkout' => 'Tjek Ud',
        'more_goodies' => 'Jeg ønsker at tjekke flere goodies ud før jeg færdiggører ordren',
        'shipping_fees' => 'fragt gebyrer',
        'title' => 'Indkøbskurv',
        'total' => 'i alt',

        'errors_no_checkout' => [
            'line_1' => 'Uh oh, der er problemer med din Indkøbskurv som forhindrer dig i at gå til kassen!',
            'line_2' => 'Fjern eller opdater tingene oppe over for at fortsætte.',
        ],

        'empty' => [
            'text' => 'Din indkøbskurv er tom.',
            'return_link' => [
                '_' => 'Vend tilbage til :link at finde nogle goodies!',
                'link_text' => 'butik notering',
            ],
        ],
    ],

    'checkout' => [
        'cart_problems' => 'Åh åh, der er problemer med din indkøbskurv!',
        'cart_problems_edit' => 'Klik her for at redigere den.',
        'declined' => 'Betalingen blev annulleret.',
        'delayed_shipping' => 'Vi bliver overvældet med ordrer lige nu! Du skal stadig være velkommen til at afgive din ordre, men forvent **yderligere 1-2 ugers forsinkelse** mens vi forsøger at indhente alle andre ordre.',
        'old_cart' => 'Din indkøbskurv ser ud til at være forældet og er blevet genindlæst, prøv venligst igen.',
        'pay' => 'Betal med PayPal',

        'has_pending' => [
            '_' => 'Du har ufærdige transaktioner, klik :link for at se dem.',
            'link_text' => 'her',
        ],

        'pending_checkout' => [
            'line_1' => 'Et tidligere køb blev startet, men blev ikke færdiggjort.',
            'line_2' => 'Fortsæt dit køb ved at vælge en betalingsmetode.',
        ],
    ],

    'discount' => 'spar :percent%',

    'invoice' => [
        'echeck_delay' => 'Siden du betalte med en eCheck, vent venligst op til 10 ekstra dage for at betalingen kommer igennem med PayPal!',
        'status' => [
            'processing' => [
                'title' => 'Din betaling er endnu ikke blevet bekræftet!',
                'line_1' => 'Hvis du allerede har betalt, kan det være vi stadig venter på at modtage en bekræftelse af din betaling. Opdater venligst siden om et minut eller to!',
                'line_2' => [
                    '_' => 'Hvis der opstod et problem under betaling, :link',
                    'link_text' => 'klik her for at fortsætte din betaling',
                ],
            ],
        ],
    ],

    'mail' => [
        'payment_completed' => [
            'subject' => 'Vi har modtaget din osu!store bestilling!',
        ],
    ],

    'order' => [
        'paid_on' => 'Ordre placeret :date',

        'invoice' => 'Vis faktura',
        'no_orders' => 'Ingen ordrer til at se.',

        'item' => [
            'display_name' => [
                'supporter_tag' => ':name for :username (:duration)',
            ],
            'quantity' => 'Kvantitet',
        ],

        'not_modifiable_exception' => [
            'cancelled' => 'Du kan ikke redigere dine ordre da de er blevet annulleret.',
            'checkout' => 'Du kan ikke ændre din ordre imens den behandles.', // checkout and processing should have the same message.
            'default' => 'Orden kan ikke ændres',
            'delivered' => 'Du kan ikke ændre din ordre, nå det allerede er blevet leveret.',
            'paid' => 'Du kan ikke ændre din ordre, da det allerede er blevet betalt for.',
            'processing' => 'Du kan ikke ændre din ordre imens den behandles.',
            'shipped' => 'Du kan ikke ændre din ordre, nå det allerede er blevet sendt.',
        ],

        'status' => [
            'cancelled' => 'Annulleret',
            'checkout' => 'Forbereder',
            'delivered' => 'Leveret',
            'paid' => 'Betalt',
            'processing' => 'Afventer bekræftelse',
            'shipped' => '',
        ],
    ],

    'product' => [
        'name' => 'Navn',

        'stock' => [
            'out' => 'Dette produkt er i øjeblikket udsolgt :(. Kig forbi senere.',
            'out_with_alternative' => 'Denne type er i øjeblikket udsolgt :(. Prøv en anden, eller kig forbi senere.',
        ],

        'add_to_cart' => 'Lig i Indkøbskurven',
        'notify' => 'Giv mig besked, når varen er tilgængelig igen!',

        'notification_success' => 'du vil modtage en besked når varen er på lager igen. klik :link for at annullere',
        'notification_remove_text' => 'here',

        'notification_in_stock' => 'Dette produkt er allerede på lager!',
    ],

    'supporter_tag' => [
        'gift' => 'giv som gave',
        'require_login' => [
            '_' => 'Du skal være :link for at få et supporter tag!',
            'link_text' => 'logget ind',
        ],
    ],

    'username_change' => [
        'check' => 'Skriv et brugernavn for at tjekke om det er tilgængelig!',
        'checking' => 'Tjekker om navnet :username er tilgængelig...',
        'require_login' => [
            '_' => 'Du skal være :link for at ændre dit brugernavn!',
            'link_text' => 'logget ind',
        ],
    ],
];

<?php

/**
 *    Copyright 2015-2017 ppy Pty. Ltd.
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

    'checkout' => [
        'cart_problems' => 'Åh åh, der er problemer med din indkøbskurv!',
        'cart_problems_edit' => 'Klik her for at redigere den.',
        'declined' => 'Betalingen blev annulleret.',
        'error' => 'Der opstod et problem under betalingen :(',
        'old_cart' => 'Your cart appears to be out of date and has been reloaded, please try again.',
        'pay' => 'Betal med PayPal',
        'pending_checkout' => [
            'line_1' => 'A previous checkout was started but did not finish.',
            'line_2' => 'Resume your checkout by selecting a payment method, or :link to cancel.',
            'link_text' => 'click here',
        ],
        'delayed_shipping' => 'Vi bliver overvældet med ordrer lige nu! Du skal stadig være velkommen til at afgive din ordre, men forvent **yderligere 1-2 ugers forsinkelse** mens vi forsøger at indhente alle andre ordre.',
    ],

    'discount' => 'spar :percent%',

    'mail' => [
        'payment_completed' => [
            'subject' => 'We received your osu!store order!',
        ],
    ],

    'order' => [
        'item' => [
            'display_name' => [
                'supporter_tag' => ':name for :username (:duration)',
            ],
            'quantity' => 'Kvantitet',
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
        'check' => 'Enter a username to check availability!',
        'checking' => 'Checking availability of :username...',
        'require_login' => [
            '_' => 'Du skal være :link for at ændre dit brugernavn!',
            'link_text' => 'logget ind',
        ],
    ],
];

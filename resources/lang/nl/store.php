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
        'warehouse' => 'Warenhuis',
    ],

    'checkout' => [
        'cart_problems' => 'Uh oh, there are problems with your cart!',
        'cart_problems_edit' => 'Click here to go edit it.',
        'declined' => 'The payment was cancelled.',
        'error' => 'There was a problem completing your checkout :(',
        'old_cart' => 'Your cart appears to be out of date and has been reloaded, please try again.',
        'pay' => 'Afrekenen met Paypal',
        'pending_checkout' => [
            'line_1' => 'A previous checkout was started but did not finish.',
            'line_2' => 'Resume your checkout by selecting a payment method, or :link to cancel.',
            'link_text' => 'click here',
        ],
        'delayed_shipping' => 'We zijn momenteel overweldigd met bestellingen! Je kunt nog steeds bestellingen plaatsen maar verwacht dan **een vertraging van 1-2 weken** terwijl wij de bestaande bestellingen verwerken.',
    ],

    'discount' => 'save :percent%',

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
            'quantity' => 'Aantal',
        ],
    ],

    'product' => [
        'name' => 'Naam',

        'stock' => [
            'out' => 'Momenteel niet op voorraad :(. Probeer het later opnieuw.',
            'out_with_alternative' => 'Dit type is momenteel niet op voorraad :(. Probeer een ander type of probeer het later opnieuw.',
        ],

        'add_to_cart' => 'Voeg toe aan winkelwagen',
        'notify' => 'Laat me weten wanneer het beschikbaar is!',

        'notification_success' => 'we zullen het je laten weten wanneer het weer op voorraad is. klik :link om te annuleren',
        'notification_remove_text' => 'hier',

        'notification_in_stock' => 'Dit product is al op voorraad!',
    ],

    'supporter_tag' => [
        'gift' => 'gift to player',
        'require_login' => [
            '_' => 'You need to be :link to get a supporter tag!',
            'link_text' => 'signed in',
        ],
    ],

    'username_change' => [
        'check' => 'Enter a username to check availability!',
        'checking' => 'Checking availability of :username...',
        'require_login' => [
            '_' => 'You need to be :link to change your name!',
            'link_text' => 'signed in',
        ],
    ],
];

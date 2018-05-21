<?php

/**
 *    Copyright 2015-2018 ppy Pty. Ltd.
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
        'warehouse' => 'Raktár',
    ],

    'cart' => [
        'checkout' => '',
        'more_goodies' => '',
        'shipping_fees' => '',
        'title' => '',
        'total' => '',

        'errors_no_checkout' => [
            'line_1' => '',
            'line_2' => '',
        ],

        'empty' => [
            'text' => '',
            'return_link' => [
                '_' => '',
                'link_text' => '',
            ],
        ],
    ],

    'checkout' => [
        'cart_problems' => 'Uh oh, problémák akadtak a kosaraddal!',
        'cart_problems_edit' => 'Kattints ide a szerkesztéséhez.',
        'declined' => 'A fizetés meg lett szakítva.',
        'old_cart' => 'A kosarad réginek tűnik és újra lett töltve, kérlek próbáld újra.',
        'pay' => 'Fizetés Paypal használatával',
        'pending_checkout' => [
            'line_1' => 'Egy fizetés már kezdetét vette, de nem fejeződött be.',
            'line_2' => 'Ugorj a fizetéshez egy fizetési mód kiválasztásával vagy kattints :link a lemondáshoz.',
            'link_text' => 'ide',
        ],
        'delayed_shipping' => 'Jelenleg túlnyomóan sok rendelésünk van. Szivesen várjuk rendelésed viszont arra számíts, hogy **további 1-2 hét késés** is lehet még utolérjük a rendeléseket.',
    ],

    'discount' => ':percent% megtakaritása',

    'mail' => [
        'payment_completed' => [
            'subject' => 'Megkaptuk az osu!store-ban elhelyezett rendelésed!',
        ],
    ],

    'order' => [
        'item' => [
            'display_name' => [
                'supporter_tag' => ':name :username-nek (:duration)',
            ],
            'quantity' => 'Mennyiség',
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
    ],

    'product' => [
        'name' => 'Név',

        'stock' => [
            'out' => 'Ez az elem jelenleg nincs raktáron. Nézz vissza később!',
            'out_with_alternative' => 'Sajnos ez az elem nincs raktáron. A legördülő lista segítségével válassz egyet a különböző típusok között, vagy nézz vissza később!',
        ],

        'add_to_cart' => 'Hozzáadás a kosárhoz',
        'notify' => 'Értesíts engem, mikor elérhető!',

        'notification_success' => 'ha van új készlet értesíts. kattints :link a lemondáshoz',
        'notification_remove_text' => 'itt',

        'notification_in_stock' => 'Ez a termék van már raktáron!',
    ],

    'supporter_tag' => [
        'gift' => 'játékosnak ajándékozás',
        'require_login' => [
            '_' => 'A támogatási cím megszerzéséhez :link!',
            'link_text' => 'lépj be',
        ],
    ],

    'username_change' => [
        'check' => 'Adj meg egy felhasználónevet a készlet ellenörzéséhez!',
        'checking' => ':username elérhetőségének ellenőrzése...',
        'require_login' => [
            '_' => ':link kell lenned a neved megváltoztatásához!',
            'link_text' => 'bejelentkezve',
        ],
    ],
];

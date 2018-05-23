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
        'checkout' => 'Fizetés',
        'more_goodies' => 'Még több jóságot szeretnék mielőtt befejezném a rendelésem',
        'shipping_fees' => 'szállítási költség',
        'title' => 'Kosár',
        'total' => 'összesen',

        'errors_no_checkout' => [
            'line_1' => 'Uh oh, valami probléma van a kosaradban ami megakadályozza a továbblépést!',
            'line_2' => 'Törölj vagy újits tárgyakat a folytatáshoz.',
        ],

        'empty' => [
            'text' => 'Üres a kosarad.',
            'return_link' => [
                '_' => 'Menj vissza a :link-re tovább jóságokért!',
                'link_text' => 'áruház listázás',
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
            'cancelled' => 'Nem változtathatsz a rendelésedem mivel törölve lett.',
            'checkout' => 'Nem változtathatsz a rendeléseden feldolgozás alatt.', // checkout and processing should have the same message.
            'default' => 'A rendelés nem módosítható',
            'delivered' => 'Nem változtathatsz a rendeléseden mivel már ki lett szálítva.',
            'paid' => 'Nem változtathatsz a rendeléseden mivel már kifizetted.',
            'processing' => 'Nem tudod módosítani a rendelésed amíg feldolgozás alatt áll.',
            'shipped' => 'Nem változtathatsz a rendeléseden mivel már ki lett küldve.',
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

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
        'more_goodies' => 'Még több cuccot szeretnék megnézni mielőtt befejezném a rendelésem',
        'shipping_fees' => 'szállítási költség',
        'title' => 'Kosár',
        'total' => 'összesen',

        'errors_no_checkout' => [
            'line_1' => 'Ajjaj, valami probléma van a kosaraddal ami megakadályozza a fizetést!',
            'line_2' => 'Töröld vagy módosítsd a fenti tárgyakat a folytatáshoz.',
        ],

        'empty' => [
            'text' => 'Üres a kosarad.',
            'return_link' => [
                '_' => 'Menj vissza a :link-re további cuccokért!',
                'link_text' => 'áruház lista',
            ],
        ],
    ],

    'checkout' => [
        'cart_problems' => 'Ajjaj, problémák vannak a kosaraddal!',
        'cart_problems_edit' => 'Kattints ide a szerkesztéséhez.',
        'declined' => 'A fizetés meg lett szakítva.',
        'old_cart' => 'A kosarad réginek tűnik és újra lett töltve, kérlek próbáld újra.',
        'pay' => 'Fizetés Paypal használatával',
        'pending_checkout' => [
            'line_1' => 'Egy korábbi fizetés már el lett indítva, de nem ment végbe.',
            'line_2' => 'Folytasd a fizetést egy fizetési módszer kiválasztásával, vagy :link a megszakításhoz.',
            'link_text' => 'kattints ide',
        ],
        'delayed_shipping' => 'Jelenleg túlnyomóan sok rendelésünk van. Szívesen fogadjuk rendelésed, viszont arra számíts, hogy **további 1-2 hét késés** is lehet míg elérünk a jelenlegi rendelésekig.',
    ],

    'discount' => ':percent% megtakaritása',

    'mail' => [
        'payment_completed' => [
            'subject' => 'Megkaptuk az osu!bolt-ban elhelyezett rendelésed!',
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
            'cancelled' => 'Nem változtathatsz visszavont rendelésen.',
            'checkout' => 'Rendeléseden nem változtathatsz amíg feldolgozás alatt áll.', // checkout and processing should have the same message.
            'default' => 'A rendelés nem módosítható',
            'delivered' => 'Nem változtathatsz a rendeléseden mivel már ki lett szállítva.',
            'paid' => 'Nem változtathatsz a rendeléseden mivel már ki lett fizetve.',
            'processing' => 'Nem tudod módosítani a rendelésed amíg feldolgozás alatt áll.',
            'shipped' => 'Nem változtathatsz a rendeléseden mivel már ki lett szállítva.',
        ],
    ],

    'product' => [
        'name' => 'Név',

        'stock' => [
            'out' => 'Ez az elem jelenleg nincs raktáron. Nézz vissza később!',
            'out_with_alternative' => 'Sajnos ez az elem nincs raktáron. A legördülő lista segítségével válassz egy másik fajtát, vagy nézz vissza később!',
        ],

        'add_to_cart' => 'Hozzáadás a kosárhoz',
        'notify' => 'Értesíts amikor elérhető!',

        'notification_success' => 'új készlet esetén értesítve leszel. kattints :link a lemondáshoz',
        'notification_remove_text' => 'itt',

        'notification_in_stock' => 'Ez a termék van már raktáron!',
    ],

    'supporter_tag' => [
        'gift' => 'játékosnak ajándékozás',
        'require_login' => [
            '_' => 'Az osu!támogatói cím megszerzéséhez :link kell lenned!',
            'link_text' => 'lépj be',
        ],
    ],

    'username_change' => [
        'check' => 'Adj meg egy felhasználónevet az elérhetőség ellenőrzéséhez!',
        'checking' => ':username elérhetőségének ellenőrzése...',
        'require_login' => [
            '_' => ':link kell lenned a neved megváltoztatásához!',
            'link_text' => 'bejelentkezve',
        ],
    ],
];

<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'admin' => [
        'warehouse' => 'Raktár',
    ],

    'cart' => [
        'checkout' => 'Fizetés',
        'info' => ':count_delimited elem a kosárban ($:subtotal)|:count_delimited elem a kosárban ($:subtotal)',
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
        'delayed_shipping' => 'Jelenleg túlnyomóan sok rendelésünk van. Szívesen fogadjuk rendelésed, viszont arra számíts, hogy **további 1-2 hét késés** is lehet míg elérünk a jelenlegi rendelésekig.',
        'old_cart' => 'A kosarad réginek tűnik és újra lett töltve, kérlek próbáld újra.',
        'pay' => 'Fizetés Paypal használatával',
        'title_compact' => 'fizetés',

        'has_pending' => [
            '_' => 'Még vannak befejezetlen vételeid, kattints :link a megtekintéshez.',
            'link_text' => 'ide',
        ],

        'pending_checkout' => [
            'line_1' => 'Egy korábbi fizetés már el lett indítva, de nem ment végbe.',
            'line_2' => 'Folytasd a fizetést egy fizetési módszer kiválasztásával.',
        ],
    ],

    'discount' => ':percent% megtakaritása',

    'invoice' => [
        'echeck_delay' => 'Mivel a fizetésed egy eCheck volt, engedj meg neki legalább 10 napot a PayPal-es feldolgozásra!',
        'title_compact' => 'számla',

        'status' => [
            'processing' => [
                'title' => 'A fizetésed még nem lett megerősítve!',
                'line_1' => 'Ha már fizettél, előfordulhat hogy még a megerősítést várjuk róla. Kérlek egy-két percen belül frissítsd az oldalt!',
                'line_2' => [
                    '_' => 'Ha a fizetés során problémába ütköztél, :link',
                    'link_text' => 'kattints ide a fizetés folytatásához',
                ],
            ],
        ],
    ],

    'order' => [
        'cancel' => 'Megrendelés törlése',
        'cancel_confirm' => '',
        'cancel_not_allowed' => '',
        'invoice' => 'Számla megtekintése',
        'no_orders' => 'Nincs megtekinthető megrendelés.',
        'paid_on' => 'Megrendelés feladva :date',
        'resume' => 'Fizetés Folytatása',
        'shopify_expired' => '',

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
            'shipped' => 'Nem változtathatsz a rendeléseden mivel már folyamatban a szállítás.',
        ],

        'status' => [
            'cancelled' => 'Megszakitva',
            'checkout' => 'Előkészítés',
            'delivered' => 'Kézbesítve',
            'paid' => 'Fizetett',
            'processing' => 'Megerősítés függőben',
            'shipped' => 'Szállítás alatt',
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

    'xsolla' => [
        'distributor' => '',
    ],
];

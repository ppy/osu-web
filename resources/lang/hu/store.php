<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'cart' => [
        'checkout' => 'Fizetés',
        'empty_cart' => 'Összes elem törlése a kosárból',
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
        'hide_from_activity' => 'Rejtse el ezeknek az osu!supporter címkék vásárlását az aktivitásomból',
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
    'free' => 'ingyenes!',

    'invoice' => [
        'contact' => 'Kapcsolat:',
        'date' => 'Dátum:',
        'echeck_delay' => 'Mivel a fizetésed egy eCheck volt, engedj meg neki legalább 10 napot a PayPal-es feldolgozásra!',
        'echeck_denied' => '',
        'hide_from_activity' => 'ebben a vásárlásban szereplő osu!supporter címkék nem jelennek meg a legutóbbi aktivitásaid között.',
        'sent_via' => 'Általa küldve:',
        'shipping_to' => 'Szállítás ide:',
        'title' => 'Számla',
        'title_compact' => 'számla',

        'status' => [
            'cancelled' => [
                'title' => 'A rendelés törölve lett',
                'line_1' => [
                    '_' => "Ha nem kérted a lemondást, kérjük, vedd fel a kapcsolatot itt: :link, majd add meg a rendelésed számát (#:order_number).",
                    'link_text' => 'osu!bolt támogatás',
                ],
            ],
            'delivered' => [
                'title' => 'A rendelésed megérkezett! Reméljük, hogy tetszik neked!',
                'line_1' => [
                    '_' => 'Ha bármilyen problémád akad a vásárlással, kérlek lépj kapcsolatba :link helyen.',
                    'link_text' => 'osu!bolt támogatás',
                ],
            ],
            'prepared' => [
                'title' => 'A rendelés feldolgozás alatt!',
                'line_1' => 'Kérjük, várj még egy kicsit a szállításra. A csomagkövetési információk itt fognak majd megjelenni, amikor a rendelés feldolgozása és elküldése megtörtént. Ez akár 5 napot is igénybe vehet (de általában kevesebbet!) attól függően, hogy mennyire vagyunk elfoglaltak.',
                'line_2' => 'Minden megrendelést Japánból küldünk, a súlytól és értéktől függően különböző szállítási szolgáltatásokat használva. Ez a szakasz frissülni fog a részletekkel, amikor a megrendelést elküldtük.',
            ],
            'processing' => [
                'title' => 'A fizetésed még nem lett megerősítve!',
                'line_1' => 'Ha már fizettél, előfordulhat hogy még a megerősítést várjuk róla. Kérlek egy-két percen belül frissítsd az oldalt!',
                'line_2' => [
                    '_' => 'Ha a fizetés során problémába ütköztél, :link',
                    'link_text' => 'kattints ide a fizetés folytatásához',
                ],
            ],
            'shipped' => [
                'title' => 'A rendelés kiszállításra került!',
                'tracking_details' => 'Csomagkövetés részletei:',
                'no_tracking_details' => [
                    '_' => "Nem rendelkezünk csomagkövetési adatokkal, mivel azt az Air Mailen keresztül küldtük el, de 1-3 héten belül várhatóan megkapod a csomagot. Európa esetében a vám néha késleltetheti a rendelést, amit mi nem tudunk befolyásolni. Ha bármilyen aggodalmad van, kérlek válaszolj a megrendelést visszaigazoló emailre, amit kaptál :link.",
                    'link_text' => 'küldj nekünk egy emailt',
                ],
            ],
        ],
    ],

    'order' => [
        'cancel' => 'Megrendelés törlése',
        'cancel_confirm' => 'Ez a megrendelés törlésre kerül, és fizetést nem fogadunk el érte. Előfordulhat, hogy a pénzforgalmi szolgáltató nem enged fel azonnal tartalékot. Biztos vagy ebben?',
        'cancel_not_allowed' => 'Ez a megrendelés jelenleg nem törölhető.',
        'invoice' => 'Számla megtekintése',
        'no_orders' => 'Nincs megtekinthető megrendelés.',
        'paid_on' => 'Megrendelés feladva :date',
        'resume' => 'Fizetés Folytatása',
        'shipping_and_handling' => 'Szállítás és kezelés',
        'shopify_expired' => 'A rendelés fizetési linkje lejárt.',
        'subtotal' => 'Részösszeg',
        'total' => 'Összesen',

        'details' => [
            'order_number' => 'Rendelési szám',
            'payment_terms' => 'Fizetési feltételek',
            'salesperson' => 'Értékesítő',
            'shipping_method' => 'Szállítási mód',
            'shipping_terms' => 'Szállítási feltételek',
            'title' => 'Rendelés részletei',
        ],

        'item' => [
            'quantity' => 'Mennyiség',

            'display_name' => [
                'supporter_tag' => ':name :username-nek (:duration)',
            ],

            'subtext' => [
                'supporter_tag' => 'Üzenet: :message',
            ],
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
            'title' => 'Rendelés állapota',
        ],

        'thanks' => [
            'title' => 'Köszönjük a megrendelést!',
            'line_1' => [
                '_' => 'Hamarosan kapni fogsz egy megerősítő emailt. Ha bármilyen kérdésed van, kérlek :link!',
                'link_text' => 'lépj kapcsolatba velünk',
            ],
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
        'gift_message' => 'adj egy üzenetet az ajándékodhoz, amennyiben szeretnél! (legfeljebb :length karakterű)',

        'require_login' => [
            '_' => 'Az osu!támogatói cím megszerzéséhez :link kell lenned!',
            'link_text' => 'lépj be',
        ],
    ],

    'username_change' => [
        'check' => 'Adj meg egy felhasználónevet az elérhetőség ellenőrzéséhez!',
        'checking' => ':username elérhetőségének ellenőrzése...',
        'placeholder' => 'Kért Felhasználónév',
        'label' => 'Új Felhasználónév',
        'current' => 'A jelenlegi felhasználóneved ":username".',

        'require_login' => [
            '_' => ':link kell lenned a neved megváltoztatásához!',
            'link_text' => 'bejelentkezve',
        ],
    ],

    'xsolla' => [
        'distributor' => '',
    ],
];

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
        'warehouse' => 'Magazyn',
    ],

    'checkout' => [
        'pay' => 'Zapłać przez PayPal',
        'delayed_shipping' => 'Jesteśmy obecnie przeciążeni zamówieniami! Możesz złożyć swoje zamówienie, ale spodziewaj się **dodatkowego opóźnienia 1-2 tygodni** dopóki nie uporamy się z obecnymi zamówieniami.',
    ],

    'discount' => 'zaoszczędź :percent%',

    'order' => [
        'item' => [
            'display_name' => [
                'supporter_tag' => ':name dla :username (:duration)',
            ],
            'quantity' => 'Ilość',
        ],
    ],

    'product' => [
        'name' => 'Nazwa',

        'stock' => [
            'out' => 'Obecnie brak :(. Sprawdź poźniej.',
            'out_with_alternative' => 'Obecnie brak :(. Spróbuj z innym rozmiarem/typem bądź sprawdź później.',
        ],

        'add_to_cart' => 'Dodaj do koszyka',
        'notify' => 'Powiadom mnie, kiedy będzie dostępne!',

        'notification_success' => 'dostaniesz powiadomienie, kiedy produkt będzie dostępny. kliknij :link aby anulować.',
        'notification_remove_text' => 'tutaj',

        'notification_in_stock' => 'Produkt jest dostępny!',
    ],

    'supporter_tag' => [
        'require_login' => [
            '_' => 'Aby zdobyć status donatora, musisz się :link!',
            'link_text' => 'zalogować',
        ],
    ],

    'username_change' => [
        'require_login' => [
            '_' => 'Aby zmienić swój pseudonim, musisz się :link!',
            'link_text' => 'zalogować',
        ],
    ],

];

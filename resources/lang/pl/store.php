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
        'warehouse' => 'Magazyn',
    ],

    'cart' => [
        'checkout' => 'Zapłać',
        'more_goodies' => 'Chcę przejrzeć inne produkty przed zakończeniem zamówienia',
        'shipping_fees' => 'koszt wysyłki',
        'title' => 'Koszyk',
        'total' => 'łącznie',

        'errors_no_checkout' => [
            'line_1' => 'Oho, wystąpił problem z twoim koszykiem uniemożliwiający płatność!',
            'line_2' => 'Usuń lub zmień przedmioty powyżej, aby kontynuować.',
        ],

        'empty' => [
            'text' => 'Twój koszyk jest pusty.',
            'return_link' => [
                '_' => 'Wróć na :link, aby znaleźć coś interesującego!',
                'link_text' => 'listę produktów',
            ],
        ],
    ],

    'checkout' => [
        'cart_problems' => 'O nie, wystąpił problem z twoim koszykiem!',
        'cart_problems_edit' => 'Kliknij tutaj, aby go zedytować.',
        'declined' => 'Płatność została anulowana.',
        'old_cart' => 'Zawartość twojego koszyka była przestarzała i została odświeżona, spróbuj ponownie.',
        'pay' => 'Zapłać przez PayPal',
        'pending_checkout' => [
            'line_1' => 'Poprzednio podjęta próba złożenia zamówienia nie została zakończona.',
            'line_2' => 'Wznów proces poprzez wybór metody płatności lub :link, aby przerwać składanie zamówienia.',
            'link_text' => 'kliknij tutaj',
        ],
        'delayed_shipping' => 'Obecnie jesteśmy przeciążeni zamówieniami! Wciąż możesz złożyć swoje zamówienie, ale spodziewaj się **dodatkowego opóźnienia w postaci 1-2 tygodni**, dopóki te już istniejące nie zostaną zakończone.',
    ],

    'discount' => 'zaoszczędź :percent%',

    'mail' => [
        'payment_completed' => [
            'subject' => 'Otrzymaliśmy twoje zamówienie!',
        ],
    ],

    'order' => [
        'item' => [
            'display_name' => [
                'supporter_tag' => ':name dla :username (:duration)',
            ],
            'quantity' => 'Ilość',
        ],

        'not_modifiable_exception' => [
            'cancelled' => 'Nie możesz edytować swojego zamówienia, ponieważ zostało ono anulowane.',
            'checkout' => 'Nie możesz edytować swojego zamówienia, ponieważ jest ono aktualnie przetwarzane.', // checkout and processing should have the same message.
            'default' => 'Zamówienie nie może zostać zmienione',
            'delivered' => 'Nie możesz edytować swojego zamówienia, ponieważ zostało ono już dostarczone.',
            'paid' => 'Nie możesz edytować swojego zamówienia, ponieważ zostało ono już opłacone.',
            'processing' => 'Nie możesz edytować swojego zamówienia, ponieważ jest ono aktualnie przetwarzane.',
            'shipped' => 'Nie możesz edytować swojego zamówienia, ponieważ zostało ono już wysłane.',
        ],
    ],

    'product' => [
        'name' => 'Nazwa',

        'stock' => [
            'out' => 'Ten przedmiot jest obecnie niedostępny. Sprawdź później!',
            'out_with_alternative' => 'Niestety ten przedmiot jest obecnie niedostępny. Spróbuj z innym rozmiarem/typem bądź sprawdź później.',
        ],

        'add_to_cart' => 'Dodaj do koszyka',
        'notify' => 'Powiadom mnie, kiedy produkt będzie dostępny!',

        'notification_success' => 'dostaniesz powiadomienie, kiedy produkt będzie dostępny. kliknij :link aby anulować.',
        'notification_remove_text' => 'tutaj',

        'notification_in_stock' => 'Ten produkt jest już dostępny!',
    ],

    'supporter_tag' => [
        'gift' => 'podaruj innemu użytkownikowi',
        'require_login' => [
            '_' => 'Aby uzyskać status donatora osu!, musisz się :link!',
            'link_text' => 'zalogować',
        ],
    ],

    'username_change' => [
        'check' => 'Wprowadź nazwę użytkownika, aby sprawdzić, czy jest dostępna!',
        'checking' => 'Sprawdzanie możliwości zmiany na :username...',
        'require_login' => [
            '_' => 'Aby zmienić swoją nazwę użytkownika, musisz się :link!',
            'link_text' => 'zalogować',
        ],
    ],
];

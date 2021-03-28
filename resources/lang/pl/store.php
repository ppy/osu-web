<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'admin' => [
        'warehouse' => 'Magazyn',
    ],

    'cart' => [
        'checkout' => 'Zapłać',
        'info' => ':count_delimited produkt w koszyku (:subtotal$)|:count_delimited produkty w koszyku (:subtotal$)|:count_delimited produktów w koszyku (:subtotal$)',
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
        'delayed_shipping' => 'Obecnie jesteśmy przeciążeni zamówieniami! Wciąż możesz złożyć swoje zamówienie, ale spodziewaj się **dodatkowego opóźnienia w postaci 1-2 tygodni**, dopóki te już istniejące nie zostaną zakończone.',
        'old_cart' => 'Zawartość twojego koszyka była przestarzała i została odświeżona, spróbuj ponownie.',
        'pay' => 'Zapłać przez PayPal',
        'title_compact' => 'kasa',

        'has_pending' => [
            '_' => 'Masz kilka niedokończonych zamówień, kliknij :link, aby je wyświetlić.',
            'link_text' => 'tutaj',
        ],

        'pending_checkout' => [
            'line_1' => 'Poprzednio podjęta próba złożenia zamówienia nie została zakończona.',
            'line_2' => 'Możesz kontynuować proces zamówienia poprzez wybranie metody płatności.',
        ],
    ],

    'discount' => 'zaoszczędź :percent%',

    'invoice' => [
        'echeck_delay' => 'Jako że twoja płatność została przesłana czekiem elektronicznym, odczekaj do 10 dni na przetworzenie transakcji przez PayPal.',
        'title_compact' => 'faktura',

        'status' => [
            'processing' => [
                'title' => 'Twoja płatność nie została jeszcze potwierdzona!',
                'line_1' => 'Jeśli zamówienie zostało już opłacone, możliwe, że wciąż oczekujemy na potwierdzenie. Odśwież tę stronę za kilka minut!',
                'line_2' => [
                    '_' => 'Jeśli napotkasz problem podczas realizacji transakcji, :link',
                    'link_text' => 'kliknij tutaj, by kontynuować proces zamówienia',
                ],
            ],
        ],
    ],

    'order' => [
        'cancel' => 'Anuluj zamówienie',
        'cancel_confirm' => 'Twoje zamówienie zostanie anulowane a płatność za nie nieprzyjęta. Twój dostawca usług płatniczych może nie zwrócić zarezerwowanych środków natychmiastowo. Czy na pewno chcesz to zrobić?',
        'cancel_not_allowed' => 'Nie możesz anulować tego zamówienia w tym momencie.',
        'invoice' => 'Pokaż fakturę',
        'no_orders' => 'Brak zamówień do wyświetlenia.',
        'paid_on' => 'Zamówienie złożone :date',
        'resume' => 'Wznów zamówienie',
        'shopify_expired' => 'Łącze do płatności za to zamówienie wygasło.',

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

        'status' => [
            'cancelled' => 'Anulowane',
            'checkout' => 'Przygotowywane',
            'delivered' => 'Dostarczone',
            'paid' => 'Opłacone',
            'processing' => 'Oczekiwanie na potwierdzenie',
            'shipped' => 'W transporcie',
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

    'xsolla' => [
        'distributor' => '',
    ],
];

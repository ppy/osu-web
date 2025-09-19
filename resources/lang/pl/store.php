<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'cart' => [
        'checkout' => 'Zapłać',
        'empty_cart' => 'Usuń wszystkie produkty z koszyka',
        'info' => ':count_delimited produkt w koszyku (:subtotal$)|:count_delimited produkty w koszyku (:subtotal$)|:count_delimited produktów w koszyku (:subtotal$)',
        'more_goodies' => 'Chcę przejrzeć inne produkty przed zakończeniem zamówienia',
        'shipping_fees' => 'koszt dostawy',
        'title' => 'Koszyk',
        'total' => 'łącznie',

        'errors_no_checkout' => [
            'line_1' => 'Oho, wystąpił problem z twoim koszykiem uniemożliwiający płatność!',
            'line_2' => 'Usuń lub zmień określone produkty w koszyku, aby kontynuować.',
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
        'cart_problems_edit' => 'Kliknij tutaj, aby go edytować.',
        'declined' => 'Płatność została anulowana.',
        'delayed_shipping' => 'Obecnie jesteśmy przeciążeni zamówieniami! Wciąż możesz złożyć swoje zamówienie, ale spodziewaj się **dodatkowego opóźnienia w postaci 1-2 tygodni**, dopóki istniejące zamówienia nie zostaną przetworzone.',
        'hide_from_activity' => 'Ukryj zakup wszystkich statusów donatora osu! z tego zamówienia w mojej aktywności',
        'old_cart' => 'Zawartość twojego koszyka przedawniła się i została odświeżona, spróbuj ponownie.',
        'pay' => 'Zapłać przez PayPal',
        'title_compact' => 'podsumowanie',

        'has_pending' => [
            '_' => 'Masz kilka niedokończonych zamówień. Kliknij :link, aby je wyświetlić.',
            'link_text' => 'tutaj',
        ],

        'pending_checkout' => [
            'line_1' => 'Poprzednio podjęta próba złożenia zamówienia nie została zakończona.',
            'line_2' => 'Możesz kontynuować proces zamówienia poprzez wybranie metody płatności.',
        ],
    ],

    'discount' => 'zaoszczędź :percent%',
    'free' => 'bezpłatne',

    'invoice' => [
        'contact' => 'Kontakt:',
        'date' => 'Data:',
        'echeck_delay' => 'Jako że twoja płatność została przesłana czekiem elektronicznym, odczekaj do 10 dni na przetworzenie transakcji przez PayPal.',
        'echeck_denied' => 'Płatność czekiem elektronicznym została odrzucona przez PayPal.',
        'hide_from_activity' => 'Zakup statusów donatora osu! z tego zamówienia nie zostanie wyświetlony w twojej aktywności.',
        'sent_via' => 'Wysłane z:',
        'shipping_to' => 'Adres dostawy:',
        'title' => 'Faktura',
        'title_compact' => 'faktura',

        'status' => [
            'cancelled' => [
                'title' => 'Twoje zamówienie zostało anulowane',
                'line_1' => [
                    '_' => "Jeżeli nie prosiłeś(-aś) o anulowanie tego zamówienia, skontaktuj się z :link, uwzględniając numer zamówienia (#:order_number).",
                    'link_text' => 'zespołem sklepu osu!',
                ],
            ],
            'delivered' => [
                'title' => 'Twoje zamówienie zostało dostarczone! Mamy nadzieję, że Ci się spodoba!',
                'line_1' => [
                    '_' => 'Jeżeli masz jakiekolwiek uwagi dotyczące tego zamówienia, skontaktuj się z :link.',
                    'link_text' => 'zespołem sklepu osu!',
                ],
            ],
            'prepared' => [
                'title' => 'Twoje zamówienie jest w trakcie realizacji!',
                'line_1' => 'Twoje zamówienie jest aktualnie w przygotowaniu. Śledzenie dostawy będzie możliwe, gdy zamówienie zostanie przetworzone i wysłane. Może to potrwać do 5 dni (zazwyczaj krócej) w zależności od aktualnego nakładu zamówień.',
                'line_2' => 'Wszystkie zamówienia są realizowane w Japonii z wykorzystaniem usług różnych dostawców w zależności od wagi i wartości zamówienia. Informacje w tej sekcji będą aktualizowane na bieżąco, gdy zamówienie zostanie wysłane.',
            ],
            'processing' => [
                'title' => 'Twoja płatność nie została jeszcze potwierdzona!',
                'line_1' => 'Jeśli zamówienie zostało już opłacone, możliwe, że wciąż oczekujemy na potwierdzenie. Odśwież tę stronę za kilka minut!',
                'line_2' => [
                    '_' => 'Jeśli napotkasz problem podczas realizacji transakcji, :link',
                    'link_text' => 'kliknij tutaj, by kontynuować proces zamówienia',
                ],
            ],
            'shipped' => [
                'title' => 'Twoje zamówienie zostało wysłane!',
                'tracking_details' => 'Szczegóły dostawy:',
                'no_tracking_details' => [
                    '_' => "Nie posiadamy informacji o aktualnym statusie dostawy, ponieważ wysłaliśmy Twoje zamówienie przez Air Mail - możesz się go jednak spodziewać w przeciągu 1-3 tygodni. W przypadku zamówień wysłanych do Europy, służby celne mogą opóźniać dostawę, na co nie mamy wpływu. Jeżeli masz jakieś wątpliwości, odpowiedz na e-mail z potwierdzeniem zamówienia lub :link.",
                    'link_text' => 'wyślij nam wiadomość e-mail',
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
        'shipping_and_handling' => 'Dostawa i obsługa zamówienia',
        'shopify_expired' => 'Łącze do płatności za to zamówienie wygasło.',
        'subtotal' => 'Łącznie',
        'total' => 'Łącznie',

        'details' => [
            'order_number' => 'Zamówienie #',
            'payment_terms' => 'Warunki płatności',
            'salesperson' => 'Sprzedawca',
            'shipping_method' => 'Sposób dostawy',
            'shipping_terms' => 'Warunki dostawy',
            'title' => 'Szczegóły zamówienia',
        ],

        'item' => [
            'quantity' => 'liczba',

            'display_name' => [
                'supporter_tag' => ':name dla :username (:duration)',
            ],

            'subtext' => [
                'supporter_tag' => 'Wiadomość: „:message”',
            ],
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
            'checkout' => 'W przygotowaniu',
            'delivered' => 'Dostarczone',
            'paid' => 'Opłacone',
            'processing' => 'Oczekuje na potwierdzenie',
            'shipped' => 'W transporcie',
            'title' => 'Status zamówienia',
        ],

        'thanks' => [
            'title' => 'Dziękujemy za Twoje zamówienie!',
            'line_1' => [
                '_' => 'Wkrótce otrzymasz e-mail z potwierdzeniem zamówienia. Jeżeli masz jakieś pytania, :link!',
                'link_text' => 'skontaktuj się z nami',
            ],
        ],
    ],

    'product' => [
        'name' => 'Nazwa',

        'stock' => [
            'out' => 'Ten produkt jest obecnie niedostępny. Sprawdź później!',
            'out_with_alternative' => 'Niestety ten produkt jest obecnie niedostępny. Spróbuj z innym rozmiarem lub typem albo sprawdź ponownie później.',
        ],

        'add_to_cart' => 'Dodaj do koszyka',
        'notify' => 'Powiadom mnie, kiedy produkt będzie dostępny!',
        'out_of_stock' => 'Produkt niedostępny',

        'notification_success' => 'dostaniesz powiadomienie, kiedy produkt będzie dostępny. kliknij :link aby anulować.',
        'notification_remove_text' => 'tutaj',

        'notification_in_stock' => 'Ten produkt jest już dostępny!',
    ],

    'supporter_tag' => [
        'gift' => 'podaruj innemu użytkownikowi',
        'gift_message' => 'dołącz opcjonalną wiadomość do tego prezentu (do :length znaków)',

        'require_login' => [
            '_' => 'Aby uzyskać status donatora osu!, musisz się :link!',
            'link_text' => 'zalogować',
        ],
    ],

    'username_change' => [
        'check' => 'Wprowadź nazwę użytkownika, aby sprawdzić, czy jest dostępna!',
        'checking' => 'Sprawdzanie dostępności nazwy :username...',
        'placeholder' => 'Żądana nazwa użytkownika',
        'label' => 'Nowa nazwa użytkownika',
        'current' => 'Twoja aktualna nazwa użytkownika to „:username”.',

        'require_login' => [
            '_' => 'Aby zmienić swoją nazwę użytkownika, musisz się :link!',
            'link_text' => 'zalogować',
        ],
    ],

    'xsolla' => [
        'distributor' => '',
    ],
];

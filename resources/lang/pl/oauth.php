<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'cancel' => 'Anuluj',

    'authorise' => [
        'request' => 'żąda pozwolenia na dostęp do twojego konta.',
        'scopes_title' => 'Ta aplikacja będzie mogła:',
        'title' => 'Prośba o autoryzację',
    ],

    'authorized_clients' => [
        'confirm_revoke' => 'Czy na pewno chcesz odebrać uprawnienia temu klientowi?',
        'scopes_title' => 'Ta aplikacja może:',
        'owned_by' => 'Należy do :user',
        'none' => 'Brak klientów',

        'revoked' => [
            'false' => 'Odbierz dostęp',
            'true' => 'Odebrano dostęp',
        ],
    ],

    'client' => [
        'id' => 'Numer ID klienta',
        'name' => 'Nazwa aplikacji',
        'redirect' => 'Adres URL wywołań zwrotnych aplikacji',
        'reset' => 'Zresetuj klucz klienta',
        'reset_failed' => 'Nie udało się zresetować klucza klienta',
        'secret' => 'Klucz klienta',

        'secret_visible' => [
            'false' => 'Pokaż klucz klienta',
            'true' => 'Ukryj klucz klienta',
        ],
    ],

    'new_client' => [
        'header' => 'Zarejestruj nową aplikację OAuth',
        'register' => 'Zarejestruj aplikację',
        'terms_of_use' => [
            '_' => 'Korzystając z API, zgadzasz się na :link.',
            'link' => 'warunki korzystania z usługi',
        ],
    ],

    'own_clients' => [
        'confirm_delete' => 'Czy na pewno chcesz usunąć tego klienta?',
        'confirm_reset' => 'Czy na pewno chcesz zresetować klucz klienta? Odbierze to dostęp wszystkim istniejącym tokenom.',
        'new' => 'Nowa aplikacja OAuth',
        'none' => 'Brak klientów',

        'revoked' => [
            'false' => 'Usuń',
            'true' => 'Usunięto',
        ],
    ],
];

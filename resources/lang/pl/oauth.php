<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
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
        'secret' => 'Klucz klienta',
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
        'new' => 'Nowa aplikacja OAuth',
        'none' => 'Brak klientów',

        'revoked' => [
            'false' => 'Usuń',
            'true' => 'Usunięto',
        ],
    ],
];

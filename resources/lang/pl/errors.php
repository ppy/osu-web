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
    'codes' => [
        'http-401' => 'Zaloguj się, aby kontynuować.',
        'http-403' => 'Odmowa dostępu.',
        'http-404' => 'Nie znaleziono.',
        'http-429' => 'Za dużo prób. Spróbuj ponownie później.',
    ],
    'account' => [
        'profile-order' => [
            'generic' => 'Wystąpił błąd. Spróbuj odświeżyć stronę.',
        ],
    ],
    'beatmaps' => [
        'invalid_mode' => 'Wybrano nieprawidłowy tryb.',
        'standard_converts_only' => 'Brak wyników dla wybranego trybu na tym poziomie trudności.',
    ],
    'checkout' => [
        'generic' => 'Wystąpił błąd podczas przygotowywania twojego zamówienia.',
    ],
    'search' => [
        'default' => 'Nie udało się niczego znaleźć, spróbuj ponownie później.',
        'operation_timeout_exception' => 'Wyszukiwanie jest obecnie bardziej obciążone niż zwykle, spróbuj ponownie później.',
    ],

    'logged_out' => 'Wylogowano. Zaloguj się i spróbuj ponownie.',
    'supporter_only' => 'Potrzebujesz statusu donatora osu!, aby korzystać z tej funkcji.',
    'no_restricted_access' => 'Nie możesz wykonać tej czynności podczas blokady konta.',
    'unknown' => 'Wystąpił nieoczekiwany błąd.',
];

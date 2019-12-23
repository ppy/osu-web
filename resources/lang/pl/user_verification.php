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
    'box' => [
        'sent' => 'E-mail z kodem weryfikacyjnym został wysłany na adres :mail. Wprowadź otrzymany kod.',
        'title' => 'Weryfikacja konta',
        'verifying' => 'Weryfikowanie...',
        'issuing' => 'Tworzenie nowego kodu...',

        'info' => [
            'check_spam' => "Sprawdź folder spam, jeżeli nie możesz znaleźć e-maila.",
            'recover' => "Jeżeli nie masz dostępu do e-maila, lub nie pamiętasz, który jest przypisany do konta, spróbuj :link.",
            'recover_link' => 'odzyskać go tutaj',
            'reissue' => 'Możesz także :reissue_link lub :logout_link.',
            'reissue_link' => 'poprosić o inny kod',
            'logout_link' => 'wylogować się',
        ],
    ],

    'errors' => [
        'expired' => 'Ten kod wygasł. Wysłano nowy kod weryfikacyjny.',
        'incorrect_key' => 'Wprowadzono nieprawidłowy kod weryfikacyjny.',
        'retries_exceeded' => 'Wprowadzono nieprawidłowy kod weryfikacyjny. Liczba prób została przekroczona, w związku z tym wysłaliśmy nowy kod weryfikacyjny.',
        'reissued' => 'Wygenerowano nowy kod weryfikacyjny. Sprawdź swoją skrzynkę odbiorczą.',
        'unknown' => 'Wystąpił nieoczekiwany błąd. Wysłano nowy e-mail weryfikacyjny.',
    ],
];

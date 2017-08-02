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
    'box' => [
        'sent' => 'Mail z kodem weryfikacyjnym został wysłany na email :mail Wpisz kod.',
        'title' => 'Weryfikacja konta',
        'verifying' => 'Weryfikowanie...',
        'issuing' => 'Tworzenie nowego kodu...',
        'info' => [
            'check_spam' => 'Sprawdź folder spam, jeżeli nie możesz znaleźć maila.',
            'recover' => 'Jeżeli nie masz dostępu do maila, lub nie pamiętasz, który jest przypisany do konta, spróbuj :link.',
            'recover_link' => 'odzyskać maila tutaj',
            'reissue' => 'Możesz także :reissue_link lub :logout_link.',
            'reissue_link' => 'poprosić o inny kod',
            'logout_link' => 'wylogować się',
        ],
    ],
    'email' => [
        'subject' => 'weryfikacja konta osu!',
    ],
    'errors' => [
        'expired' => 'Ten kod wygasł. Wysłano nowy kod weryfikacyjny.',
        'incorrect_key' => 'Wprowadzono zły kod weryfikacyjny.',
        'retries_exceeded' => 'Wprowadzono zły kod weryfikacyjny. Przekroczyłeś liczbę prób. Wysłano nowy kod weryfikacyjny.',
        'reissued' => 'Odświeżono kod weryfikacyjny. Wysłano nowy kod weryfikacyjny',
        'unknown' => 'Wystąpił nieoczekiwany błąd. Wysłano nowy kod weryfikacyjny.',
    ],
];

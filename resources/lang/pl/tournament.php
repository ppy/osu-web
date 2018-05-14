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
    'index' => [
        'header' => [
            'subtitle' => 'Lista aktywnych, oficjalnych turniejów',
            'title' => 'Turnieje społeczności',
        ],
        'none_running' => 'Nie ma obecnie żadnych aktywnych turniejów, sprawdź ponownie później!',
        'registration_period' => 'Rejestracja: od :start do :end',
    ],

    'show' => [
        'banner' => 'Wspomóż swoją drużynę',
        'entered' => 'Twoje konto jest zarejestrowane na ten turniej.<br><br>Miej na uwadze, że nie oznacza to, iż zostało ono dołączone do danej drużyny.<br><br>Dalsze informacje zostaną przesłane drogą mailową później, dlatego upewnij się, że twoje konto osu! używa prawidłowego adresu e-mail!',
        'info_page' => 'Strona informacyjna',
        'login_to_register' => 'Prosimy, :login, aby poznać szczegóły rejestracji!',
        'not_yet_entered' => 'Twoje konto nie jest zarejestrowane na ten turniej.',
        'rank_too_low' => 'Przepraszamy, ale twoja pozycja w rankingu nie spełnia wymagań turnieju!',
        'registration_ends' => 'Rejestracja kończy się :date',

        'button' => [
            'cancel' => 'Anuluj rejestrację',
            'register' => 'Zarejestruj mnie!',
        ],

        'state' => [
            'before_registration' => '',
            'ended' => 'Ten turniej zakończył się. Sprawdź stronę informacyjną po wyniki.',
            'registration_closed' => '',
            'running' => 'Ten turniej jest obecnie aktywny. Sprawdź stronę informacyjną po więcej informacji.',
        ],
    ],
    'tournament_period' => 'od :start do :end',
];

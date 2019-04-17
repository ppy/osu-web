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
    'edit' => [
        'title' => 'Ustawienia <strong>konta</strong>',
        'title_compact' => 'ustawienia',
        'username' => 'nazwa użytkownika',

        'avatar' => [
            'title' => 'Awatar',
        ],

        'email' => [
            'current' => 'obecny e-mail',
            'new' => 'nowy e-mail',
            'new_confirmation' => 'potwierdź e-mail',
            'title' => 'E-mail',
        ],

        'password' => [
            'current' => 'obecne hasło',
            'new' => 'nowe hasło',
            'new_confirmation' => 'potwierdź hasło',
            'title' => 'Hasło',
        ],

        'profile' => [
            'title' => 'Profil',

            'user' => [
                'user_from' => 'obecna lokalizacja',
                'user_interests' => 'zainteresowania',
                'user_msnm' => 'skype',
                'user_occ' => 'zajęcia',
                'user_twitter' => 'twitter',
                'user_website' => 'strona internetowa',
                'user_discord' => 'discord',
            ],
        ],

        'signature' => [
            'title' => 'Sygnatura',
            'update' => 'zaktualizuj',
        ],
    ],

    'update_email' => [
        'email_subject' => 'potwierdź zmianę adresu e-mail',
        'update' => 'zaktualizuj',
    ],

    'update_password' => [
        'email_subject' => 'potwierdź zmianę hasła',
        'update' => 'zaktualizuj',
    ],

    'playstyles' => [
        'title' => 'Style gry',
        'mouse' => 'myszka',
        'keyboard' => 'klawiatura',
        'tablet' => 'tablet',
        'touch' => 'ekran dotykowy',
    ],

    'privacy' => [
        'title' => 'Prywatność',
        'friends_only' => 'blokuj prywatne wiadomości od osób spoza listy znajomych',
        'hide_online' => 'ukryj swoją obecność online',
    ],

    'security' => [
        'current_session' => 'obecna',
        'end_session' => 'Zakończ sesję',
        'end_session_confirmation' => 'Ta czynność natychmiastowo zakończy sesję na tym urządzeniu. Czy na pewno chcesz to zrobić?',
        'last_active' => 'Ostatnio aktywna:',
        'title' => 'Bezpieczeństwo',
        'web_sessions' => 'sesje internetowe',
    ],
];

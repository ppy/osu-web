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
        'title_compact' => 'ustawienia konta',
        'username' => 'nazwa użytkownika',

        'avatar' => [
            'title' => 'Awatar',
            'rules' => 'Upewnij się, że twój awatar jest zgodny z :link.<br/>Oznacza to, że musi być <strong>stosowny dla wszystkich grup wiekowych</strong> i nie może ukazywać nagości, wulgarności ani sugestywnej zawartości.',
            'rules_link' => 'zasadami społeczności',
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
                'user_discord' => 'discord',
                'user_from' => 'obecna lokalizacja',
                'user_interests' => 'zainteresowania',
                'user_msnm' => 'skype',
                'user_occ' => 'zajęcia',
                'user_twitter' => 'twitter',
                'user_website' => 'strona internetowa',
            ],
        ],

        'signature' => [
            'title' => 'Sygnatura',
            'update' => 'zaktualizuj',
        ],
    ],

    'notifications' => [
        'title' => 'Powiadomienia',
        'topic_auto_subscribe' => 'automatycznie włączaj powiadomienia dla twoich wątków na forum',
        'beatmapset_discussion_qualified_problem' => 'otrzymuj powiadomienia o nowych problemach z zakwalifikowanymi beatmapami dla następujących trybów',

        'mail' => [
            '_' => 'otrzymuj powiadomienia e-mail dla',
            'beatmapset:modding' => 'dyskusji beatmap',
            'forum_topic_reply' => 'odpowiedzi w wątkach',
        ],
    ],

    'oauth' => [
        'authorized_clients' => 'autoryzowane klienty',
        'own_clients' => 'moje klienty',
        'title' => 'OAuth',
    ],

    'playstyles' => [
        'keyboard' => 'klawiatura',
        'mouse' => 'myszka',
        'tablet' => 'tablet',
        'title' => 'Style gry',
        'touch' => 'ekran dotykowy',
    ],

    'privacy' => [
        'friends_only' => 'blokuj prywatne wiadomości od osób spoza listy znajomych',
        'hide_online' => 'ukryj swoją obecność online',
        'title' => 'Prywatność',
    ],

    'security' => [
        'current_session' => 'obecna',
        'end_session' => 'Zakończ sesję',
        'end_session_confirmation' => 'Ta czynność natychmiastowo zakończy sesję na tym urządzeniu. Czy na pewno chcesz to zrobić?',
        'last_active' => 'Ostatnio aktywna:',
        'title' => 'Bezpieczeństwo',
        'web_sessions' => 'sesje internetowe',
    ],

    'update_email' => [
        'update' => 'zaktualizuj',
    ],

    'update_password' => [
        'update' => 'zaktualizuj',
    ],

    'verification_completed' => [
        'text' => 'Możesz zamknąć to okno',
        'title' => 'Weryfikacja została zakończona',
    ],

    'verification_invalid' => [
        'title' => 'Nieprawidłowy lub przedawniony link weryfikacyjny',
    ],
];

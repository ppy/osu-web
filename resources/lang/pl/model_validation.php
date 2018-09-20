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
    'not_negative' => ':attribute nie może być ujemny.',
    'required' => ':attribute jest wymagany.',
    'too_long' => ':attribute przekroczył maksymalną liczbę znaków - możliwe jest użycie tylko :limit znaków.',
    'wrong_confirmation' => 'Potwierdzenie się nie zgadza.',

    'beatmap_discussion_post' => [
        'discussion_locked' => 'Dyskusja została zablokowana.',
        'first_post' => 'Nie możesz usunąć posta rozpoczynającego.',
    ],

    'beatmapset_discussion' => [
        'beatmap_missing' => 'Został ustawiony znacznik czasu, ale nie odnaleziono beatmapy.',
        'beatmapset_no_hype' => "Nie możesz nagłośnić tej beatmapy.",
        'hype_requires_null_beatmap' => 'Priorytet musi zostać nadany w sekcji Główne (wszystkie poziomy trudności).',
        'invalid_beatmap_id' => 'Ustawiono niewłaściwy poziom trudności.',
        'invalid_beatmapset_id' => 'Ustawiono niewłaściwą beatmapę.',
        'locked' => 'Dyskusja została zablokowana.',

        'hype' => [
            'guest' => 'Musisz się zalogować, aby nagłośnić tę beatmapę.',
            'hyped' => 'Już nagłośniono tę beatmapę.',
            'limit_exceeded' => 'Zużyto całą liczbę nagłośnień.',
            'not_hypeable' => 'Nie można nagłośnić tej beatmapy',
            'owner' => 'Nie możesz nagłośnić własnej beatmapy.',
        ],

        'timestamp' => [
            'exceeds_beatmapset_length' => 'Określony znacznik czasu przekracza długość beatmapy.',
            'negative' => "Znacznik czasu nie może być ujemny.",
        ],
    ],

    'forum' => [
        'feature_vote' => [
            'not_feature_topic' => 'Możesz głosować tylko na prośby o funkcję.',
            'not_enough_feature_votes' => 'Niewystarczająco dużo głosów.',
        ],

        'poll_vote' => [
            'invalid' => 'Wybrano nieprawidłową opcję.',
        ],

        'post' => [
            'beatmapset_post_no_delete' => 'Nie możesz usuwać posta z metadanymi beatmapy.',
            'beatmapset_post_no_edit' => 'Nie możesz edytować posta z metadanymi beatmapy.',
        ],

        'topic_poll' => [
            'duplicate_options' => 'Nie możesz dodawać takich samych możliwości wyboru.',
            'invalid_max_options' => 'Liczba odpowiedzi do zaznaczenia przez użytkownika nie może przekroczyć liczby wyborów.',
            'minimum_one_selection' => 'Wymagany jest conajmniej jeden wybór na użytkownika.',
            'minimum_two_options' => 'Wymagane są conajmniej dwie możliwości wyboru.',
            'too_many_options' => 'Przekroczono maksymalną liczbę możliwości wyboru.',
        ],

        'topic_vote' => [
            'required' => 'Wybierz jedną z opcji, aby zagłosować.',
            'too_many' => 'Wybrano więcej opcji, niż jest to dozwolone.',
        ],
    ],

    'user' => [
        'contains_username' => 'Hasło nie może zawierać nazwy użytkownika.',
        'email_already_used' => 'Ten adres e-mail jest już w użyciu.',
        'invalid_country' => 'Kraj nie występuje w bazie danych.',
        'invalid_discord' => 'Nieprawidłowa nazwa użytkownika na Discordzie.',
        'invalid_email' => "To nie wygląda na poprawny adres e-mail.",
        'too_short' => 'Nowe hasło jest za krótkie.',
        'unknown_duplicate' => 'Nazwa użytkownika lub adres e-mail jest już w użyciu.',
        'username_available_in' => 'Ta nazwa użytkownika będzie dostępna za :duration.',
        'username_available_soon' => 'Ta nazwa użytkownika będzie dostępna niedługo!',
        'username_invalid_characters' => 'Ta nazwa użytkownika zawiera nieprawidłowe znaki.',
        'username_in_use' => 'Ta nazwa użytkownika jest już w użyciu!',
        'username_no_space_userscore_mix' => 'Używaj spacji albo znaków podkreślenia, nie obu naraz!',
        'username_no_spaces' => "Nazwa użytkownika nie może zaczynać się ani kończyć spacjami!",
        'username_not_allowed' => 'Ta nazwa użytkownika nie jest dozwolona.',
        'username_too_short' => 'Ta nazwa użytkownika jest zbyt krótka.',
        'username_too_long' => 'Ta nazwa użytkownika jest zbyt długa.',
        'weak' => 'Hasło jest za słabe.',
        'wrong_current_password' => 'Obecne hasło jest niepoprawne.',
        'wrong_email_confirmation' => 'Podane adresy e-mail nie są zgodne.',
        'wrong_password_confirmation' => 'Podane hasła nie są zgodne.',
        'too_long' => 'Przekroczono maksymalną liczbę znaków - możliwe jest użycie tylko :limit znaków.',

        'change_username' => [
            'supporter_required' => [
                '_' => 'Musisz posiadać :link, aby zmienić nazwę użytkownika!',
                'link_text' => 'status donatora osu!',
            ],
            'username_is_same' => 'To twoja obecna nazwa!',
        ],
    ],
];

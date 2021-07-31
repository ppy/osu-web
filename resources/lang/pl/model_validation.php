<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'invalid' => 'Określono nieprawidłowy atrybut „:attribute”.',
    'not_negative' => 'Atrybut „:attribute” nie może być ujemny.',
    'required' => 'Atrybut „:attribute” jest wymagany.',
    'too_long' => 'Atrybut „:attribute” przekroczył maksymalną liczbę znaków - możliwe jest użycie tylko :limit znaków.',
    'wrong_confirmation' => 'Potwierdzenie się nie zgadza.',

    'beatmapset_discussion' => [
        'beatmap_missing' => 'Został ustawiony znacznik czasu, ale nie odnaleziono poziomu trudności beatmapy.',
        'beatmapset_no_hype' => "Nie możesz nagłośnić tej beatmapy.",
        'hype_requires_null_beatmap' => 'Priorytet musi zostać nadany w sekcji Główne (wszystkie poziomy trudności).',
        'invalid_beatmap_id' => 'Ustawiono nieprawidłowy poziom trudności.',
        'invalid_beatmapset_id' => 'Ustawiono nieprawidłową beatmapę.',
        'locked' => 'Dyskusja została zablokowana.',

        'attributes' => [
            'message_type' => 'Rodzaj wiadomości',
            'timestamp' => 'Znacznik czasu',
        ],

        'hype' => [
            'discussion_locked' => "Tworzenie dyskusji dla tej beatmapy zostało zablokowane i nie można jej nagłośnić.",
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

    'beatmapset_discussion_post' => [
        'discussion_locked' => 'Dyskusja została zablokowana.',
        'first_post' => 'Nie możesz usunąć posta rozpoczynającego.',

        'attributes' => [
            'message' => 'Wiadomość',
        ],
    ],

    'comment' => [
        'deleted_parent' => 'Nie możesz odpowiedzieć na usunięty komentarz.',
        'top_only' => 'Nie możesz przypiąć komentarza.',

        'attributes' => [
            'message' => 'Wiadomość',
        ],
    ],

    'follow' => [
        'invalid' => 'Nieprawidłowa wartość atrybutu „:attribute”.',
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
            'beatmapset_post_no_delete' => 'Nie możesz usunąć posta z metadanymi beatmapy.',
            'beatmapset_post_no_edit' => 'Nie możesz edytować posta z metadanymi beatmapy.',
            'first_post_no_delete' => 'Nie możesz usunąć posta rozpoczynającego',
            'missing_topic' => 'Post nie zawiera tematu.',
            'only_quote' => 'Twoja odpowiedź zawiera tylko cytat.',

            'attributes' => [
                'post_text' => 'Zawartość posta',
            ],
        ],

        'topic' => [
            'attributes' => [
                'topic_title' => 'Tytuł tematu',
            ],
        ],

        'topic_poll' => [
            'duplicate_options' => 'Nie możesz dodać takich samych możliwości wyboru.',
            'grace_period_expired' => 'Nie możesz edytować ankiety po upływie :limit godzin.',
            'hiding_results_forever' => 'Nie możesz ukryć wyników ankiety bez daty zakończenia.',
            'invalid_max_options' => 'Liczba odpowiedzi do zaznaczenia przez użytkownika nie może przekroczyć liczby wyborów.',
            'minimum_one_selection' => 'Wymagany jest conajmniej jeden wybór na użytkownika.',
            'minimum_two_options' => 'Wymagane są conajmniej dwie możliwości wyboru.',
            'too_many_options' => 'Przekroczono maksymalną liczbę możliwości wyboru.',

            'attributes' => [
                'title' => 'Tytuł ankiety',
            ],
        ],

        'topic_vote' => [
            'required' => 'Wybierz jedną z opcji, aby zagłosować.',
            'too_many' => 'Wybrano więcej opcji, niż jest to dozwolone.',
        ],
    ],

    'oauth' => [
        'client' => [
            'too_many' => 'Przekroczono maksymalną liczbę dozwolonych aplikacji OAuth.',
            'url' => 'Wprowadź prawidłowy adres URL.',

            'attributes' => [
                'name' => 'Nazwa aplikacji',
                'redirect' => 'Adres URL wywołań zwrotnych aplikacji',
            ],
        ],
    ],

    'user' => [
        'contains_username' => 'Hasło nie może zawierać nazwy użytkownika.',
        'email_already_used' => 'Ten adres e-mail jest już w użyciu.',
        'email_not_allowed' => 'Niedozwolony adres e-mail',
        'invalid_country' => 'Kraj nie występuje w bazie danych.',
        'invalid_discord' => 'Nieprawidłowa nazwa użytkownika na Discordzie.',
        'invalid_email' => "To nie wygląda na poprawny adres e-mail.",
        'invalid_twitter' => 'Nieprawidłowa nazwa użytkownika na Twitterze.',
        'too_short' => 'Nowe hasło jest za krótkie.',
        'unknown_duplicate' => 'Nazwa użytkownika lub adres e-mail jest już w użyciu.',
        'username_available_in' => 'Ta nazwa użytkownika będzie dostępna za :duration.',
        'username_available_soon' => 'Ta nazwa użytkownika będzie dostępna niedługo!',
        'username_invalid_characters' => 'Ta nazwa użytkownika zawiera nieprawidłowe znaki.',
        'username_in_use' => 'Ta nazwa użytkownika jest już w użyciu!',
        'username_locked' => 'Ta nazwa użytkownika jest już w użyciu!', // TODO: language for this should be slightly different.
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

        'attributes' => [
            'username' => 'Nazwa użytkownika',
            'user_email' => 'Adres e-mail',
            'password' => 'Hasło',
        ],

        'change_username' => [
            'restricted' => 'Nie możesz zmienić swojej nazwy użytkownika podczas blokady konta.',
            'supporter_required' => [
                '_' => 'Musisz posiadać :link, aby zmienić nazwę użytkownika!',
                'link_text' => 'status donatora osu!',
            ],
            'username_is_same' => 'To twoja obecna nazwa!',
        ],
    ],

    'user_report' => [
        'reason_not_valid' => 'Powód „:reason” nie jest właściwy dla tego typu zgłoszenia.',
        'self' => "Nie możesz zgłosić swojego konta!",
    ],

    'store' => [
        'order_item' => [
            'attributes' => [
                'quantity' => 'Liczba',
                'cost' => 'Koszt',
            ],
        ],
    ],
];

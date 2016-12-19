<?php
/**
 *    Copyright 2015-2016 ppy Pty. Ltd.
 *
 *    This file is part of osu!web. osu!web is distributed in the hopes of
 *    attracting more community contributions to the core ecosystem of osu!
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
    'login' => [
        '_' => 'Zaloguj się',
        'username' => 'Nazwa użytkownika',
        'password' => 'Hasło',
        'button' => 'Zaloguj się',
        'remember' => 'Zapamiętaj ten komputer',
        'title' => 'Zaloguj się, aby kontynuować',
        'failed' => 'Niepoprawny login/hasło',
        'register' => 'Nie posiadasz konta osu! ? Stwórz nowe',
        'forgot' => 'Zapomniałeś hasła?',
        'beta' => [
            'main' => 'Dostęp do bety jest obecnie ograniczony do wybranych użytkowników.',
            'small' => '(supporterzy dostaną go wkrótce)',
        ],
        'here' => 'tutaj',
    ],
    'anonymous' => [
        'login_link' => 'kliknij, aby się zalogować',
        'username' => 'Gość',
        'error' => 'Musisz być zalogowany.',
    ],
    'logout_confirm' => 'Na pewno chcesz się wylogować? :(',
    'show' => [
        404 => 'Nie znaleziono gracza! ;_;',
        'current_location' => 'Obecnie w :location.',
        'edit' => [
            'cover' => [
                'button' => 'Zmień nagłówek profilu',
                'defaults_info' => 'Więcej nagłówków pojawi się w przyszłości',
                'upload' => [
                    'broken_file' => 'Nie udało się przetworzyć pliku. Zweryfikuj plik i spróbuj ponownie.',
                    'button' => 'Dodaj tło',
                    'dropzone' => 'Upuść tutaj, aby dodać',
                    'dropzone_info' => 'Możesz także upuścić swoje tło tutaj, aby je dodać',
                    'restriction_info' => 'Dodawanie jest dostępne tylko dla <a href=\'https://osu.ppy.sh/p/support#transactionarea\' target=\'_blank\'>supporterów</a> ',
                    'size_info' => 'Rozmiary nagłówka powinny być przynajmniej 2000x500',
                    'too_large' => 'Plik jest zbyt duży.',
                    'unsupported_format' => 'To rozszerzenie nie jest wspierane.',
                ],
            ],
        ],
        'extra' => [
            'achievements' => [
                'title' => 'Osiągnięcia',
                'achieved-on' => 'Odblokowane dnia :date',
            ],
            'beatmaps' => [
                'title' => 'Beatmapy',
                'favourite' => [
                    'title' => 'Ulubione beatmapy (:count)',
                ],
                'ranked_and_approved' => [
                    'title' => 'Rankingowe & Zatwierdzone beatmapy (:count)',
                ],
                'none' => 'Jeszcze nie ma...',
            ],
            'historical' => [
                'empty' => 'Brak wyników. :(',
                'most_played' => [
                    'count' => 'ilość zagrań',
                    'title' => 'Najczęściej grane mapy',
                ],
                'recent_plays' => [
                    'accuracy' => 'celność: :percentage',
                    'title' => 'Ostatnie wyniki',
                ],
                'title' => 'Historia',
            ],
            'performance' => [
                'title' => 'Osiągi',
            ],
            'kudosu' => [
                'available' => 'Dostępne kudosu',
                'available_info' => 'Kudosu może być wymienione na gwiazdki kudosu, które pomogą twojej mapie zyskać więcej uwagi. To jest liczba kudosu, którego nie wymieniłeś.',
                'entry' => [
                    'empty' => 'Ten gracz nie otrzymał żadnego kudosu!',
                    'give' => 'Otrzymano <strong class="kudosu-entries__amount">:amount kudosu</strong> od :giver za post na :post',
                    'revoke' => 'Odebrano kudosu przezDenied kudosu by :giver for the post :post',
                ],
                'recent_entries' => 'Ostatnio zdobyte kudosu',
                'title' => 'Kudosu!',
                'total' => 'Ilość zdobytego kudosu',
                'total_info' => 'Bazowane na tym, ile użytkownik zrobił dla modowania map. Spojrzyj <a href="https://osu.ppy.sh/wiki/Kudosu">tutaj</a>, aby dowiedzieć się więcej.',
            ],
            'me' => [
                'title' => 'me!',
            ],
            'medals' => [
                'title' => 'Medale',
            ],
            'recent_activities' => [
                'title' => 'Ostatnie',
            ],
            'top_ranks' => [
                'best' => [
                    'title' => 'Najlepsze wyniki',
                ],
                'empty' => 'Brak wyników. :(',
                'first' => [
                    'title' => 'Pierwsze miejsca',
                ],
                'pp' => ':amountpp',
                'title' => 'Wyniki',
                'weighted_pp' => 'ważone: :pp (:percentage)',
            ],
        ],
        'first_members' => 'od samego początku',
        'is_supporter' => 'osu!supporter',
        'is_developer' => 'osu!programista',
        'lastvisit' => 'Ostatnio widziany :date.',
        'joined_at' => 'dołączył :date',
        'more_achievements' => 'i więcej',
        'origin' => [
            'age' => 'Ma :age lat.',
            'country' => 'Pochodzi z :country.',
            'country_age' => 'Ma :age lat i pochodzi z :country.',
        ],
        'page' => [
            'description' => '<strong>ja!</strong> to twoje osobiste, personalizowalne miejsce na twoim profilu.',
            'edit_big' => 'Edytuj mnie!',
            'placeholder' => 'Pisz tutaj',
            'restriction_info' => 'Musisz być <a href=\'https://osu.ppy.sh/p/support#transactionarea\' target=\'_blank\'>supporterem</a>, aby odblokować tę funkcję.',
        ],
        'plays_with' => [
            '_' => 'Gra używając',
            'keyboard' => 'Klawiatury',
            'mouse' => 'Myszki',
            'tablet' => 'Tableta',
            'touch' => 'Ekranu dotykowego',
        ],
        'missingtext' => 'Zrobiłeś literówkę! (albo ten gracz jest zbanowany)',
        'page_description' => 'osu! - Wszystko co chciałbyś wiedzieć o :username!',
        'rank' => [
            'country' => 'Pozycja w rankingu krajowym dla :mode',
            'global' => 'Pozycja w rankingu świadowym dla :mode',
        ],
        'stats' => [
            'hit_accuracy' => 'Celność',
            'level' => 'Poziom :level',
            'maximum_combo' => 'Maksymalne combo',
            'play_count' => 'Ilość zagrań',
            'ranked_score' => 'Łączny rankingowy wynik',
            'replays_watched_by_others' => 'Powtórki obejrzane przez innych',
            'score_ranks' => 'Wyniki',
            'total_hits' => 'Łączna ilość uderzeń',
            'total_score' => 'Łączny wynik',
        ],
        'title' => 'Profil :username',
    ],
];

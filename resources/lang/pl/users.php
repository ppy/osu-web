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
    'login' => [
        '_' => 'Zaloguj się',
        'locked_ip' => 'Twój adres IP jest zablokowany. Poczekaj kilka minut.',
        'username' => 'Nazwa użytkownika',
        'password' => 'Hasło',
        'button' => 'Zaloguj się',
        'button_posting' => 'Logowanie...',
        'remember' => 'Zapamiętaj ten komputer',
        'title' => 'Zaloguj się, aby kontynuować',
        'failed' => 'Niepoprawny login/hasło',
        'register' => 'Nie posiadasz konta osu! ? Stwórz nowe',
        'forgot' => 'Zapomniałeś hasła?',
        'beta' => [
            'main' => 'Dostęp do bety jest obecnie ograniczony do wybranych użytkowników.',
            'small' => '(supporterzy dostaną go wkrótce)',
        ],

        'here' => 'tutaj', // this is substituted in when generating a link above. change it to suit the language.
    ],
    'anonymous' => [
        'login_link' => 'kliknij, aby się zalogować',
        'username' => 'Gość',
        'error' => 'Musisz być zalogowany.',
    ],
    'logout_confirm' => 'Na pewno chcesz się wylogować? :(',
    'show' => [
        '404' => 'Nie znaleziono gracza! ;_;',
        'age' => 'Ma :age lat',
        'current_location' => 'Obecnie w :location',
        'first_members' => 'Od samego początku',
        'is_developer' => 'programista osu!',
        'is_supporter' => 'osu!supporter',
        'joined_at' => 'Dołączył :date',
        'lastvisit' => 'Ostatnio widziany :date',
        'missingtext' => 'Zrobiłeś literówkę! (albo ten gracz jest zbanowany)',
        'origin_age' => ':age',
        'origin_country' => 'Pochodzi z :country',
        'origin_country_age' => ':age i pochodzi z :country',
        'page_description' => 'osu! - Wszystko co chciałbyś wiedzieć o :username!',
        'plays_with' => 'Gra za pomocą :devices',
        'title' => 'Profil :username',

        'edit' => [
            'cover' => [
                'button' => 'Zmień nagłówek profilu',
                'defaults_info' => 'Więcej nagłówków pojawi się w przyszłości',
                'upload' => [
                    'broken_file' => 'Nie udało się przetworzyć pliku. Zweryfikuj plik i spróbuj ponownie.',
                    'button' => 'Dodaj tło',
                    'dropzone' => 'Upuść tutaj, aby dodać',
                    'dropzone_info' => 'Możesz także upuścić swoje tło tutaj, aby je dodać',
                    'restriction_info' => "Dodawanie jest dostępne tylko dla <a href='".osu_url('support-the-game')."' target='_blank'>supporterów</a> ",
                    'size_info' => 'Rozmiary nagłówka powinny być przynajmniej 2000x700',
                    'too_large' => 'Plik jest zbyt duży.',
                    'unsupported_format' => 'To rozszerzenie nie jest wspierane.',
                ],
            ],
        ],
        'extra' => [
            'followers' => '1 śledzący|:count śledzących|:count śledzących',
            'unranked' => 'Ostatnio nie grał',

            'achievements' => [
                'title' => 'Osiągnięcia',
                'achieved-on' => 'Odblokowane dnia :date',
            ],
            'beatmaps' => [
                'title' => 'Beatmapy',
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
            'kudosu' => [
                'available' => 'Dostępne kudosu',
                'available_info' => 'Kudosu może być wymienione na gwiazdki kudosu, które pomogą twojej mapie zyskać więcej uwagi. To jest liczba kudosu, którego nie wymieniłeś.',
                'recent_entries' => 'Ostatnio zdobyte kudosu',
                'title' => 'Kudosu!',
                'total' => 'Ilość zdobytego kudosu',
                'total_info' => 'Bazowane na tym, ile użytkownik zrobił dla modowania map. Spojrzyj <a href="'.osu_url('user.kudosu').'">tutaj</a>, aby dowiedzieć się więcej.',

                'entry' => [
                    'amount' => ':amount kudosu',
                    'empty' => 'Ten gracz nie otrzymał żadnego kudosu!',

                    'forum_post' => [
                        'give' => 'Otrzymano :amount od :giver za post na :post',
                        'reset' => 'Zresetowano kudosu przez :giver za post na :post',
                        'revoke' => 'Odebrano kudosu przez :giver za post na :post',
                    ],
                ],
            ],
            'me' => [
                'title' => 'me!',
            ],
            'medals' => [
                'empty' => 'Ten użytkownik jescze nie otrzymał żadnego medalu. ;_;',
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
        ],
        'page' => [
            'description' => '<strong>ja!</strong> to twoje osobiste, personalizowalne miejsce na twoim profilu.',
            'edit_big' => 'Edytuj mnie!',
            'placeholder' => 'Pisz tutaj',
            'restriction_info' => "Musisz być <a href='".osu_url('support-the-game')."' target='_blank'>supporterem</a>, aby odblokować tę funkcję.",
        ],
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
    ],
    'status' => [
        'online' => 'Online',
        'offline' => 'Offline',
    ],
    'verify' => [
        'title' => 'Weryfikacja Konta',
    ],

];

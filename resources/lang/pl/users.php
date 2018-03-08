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
    'deleted' => '[usunięty użytkownik]',

        'beatmapset_activities' => [
        'discussions' => [
            'title_recent' => 'Ostatnio rozpoczęte dyskusje',
        ],

        'events' => [
            'title_recent' => 'Najnowsze wydarzenia',
        ],

        'posts' => [
            'title_recent' => 'Najnowsze posty',
        ],

        'votes_received' => [
            'title_most' => 'Najwięcej otrzymanych głosów (ostatnie 3 miesiące)',
        ],

        'votes_made' => [
            'title_most' => 'Najwięcej nadanych głosów (ostatnie 3 miesiące)',
        ],
    ],

    'card' => [
        'loading' => 'Ładowanie...',
    ],

    'login' => [
        '_' => 'Zaloguj się',
        'locked_ip' => 'Twój adres IP został zablokowany. Poczekaj kilka minut.',
        'username' => 'Nazwa użytkownika',
        'password' => 'Hasło',
        'button' => 'Zaloguj się',
        'button_posting' => 'Logowanie...',
        'remember' => 'Zapamiętaj ten komputer',
        'title' => 'Zaloguj się, aby kontynuować',
        'failed' => 'Niepoprawny login/hasło',
        'register' => 'Nie posiadasz konta osu!? Utwórz nowe',
        'forgot' => 'Nie pamiętasz hasła?',
        'beta' => [
            'main' => 'Dostęp do bety jest obecnie ograniczony do wybranych użytkowników.',
            'small' => '(donatorzy otrzymają go wkrótce)',
        ],

        'here' => 'tutaj', // this is substituted in when generating a link above. change it to suit the language.
    ],

    'signup' => [
        '_' => 'Zarejestruj się',
    ],

    'anonymous' => [
        'login_link' => 'kliknij, aby się zalogować',
        'login_text' => 'zaloguj się',
        'username' => 'Gość',
        'error' => 'Musisz się zalogować.',
    ],
    'logout_confirm' => 'Na pewno chcesz się wylogować? :(',
    'restricted_banner' => [
        'title' => 'Twoje konto zostało zablokowane!',
        'message' => 'Podczas blokady konta, niemożliwa będzie interakcja z innymi użytkownikami, a twoje wyniki będą widoczne tylko dla ciebie. Jest to zazwyczaj zautomatyzowany proces i może być odwrócony w ciągu 24 godzin. Jeżeli chcesz odwołać się od blokady, skontaktuj się z <a href="mailto:accounts@ppy.sh">pomocą techniczną</a>.',
    ],
    'show' => [
        '404' => 'Nie znaleziono gracza! ;_;',
        'age' => 'Ma :age lat',
        'first_members' => 'Od samego początku',
        'is_developer' => 'programista osu!',
        'is_supporter' => 'donator osu!',
        'joined_at' => 'Na osu! od :date',
        'lastvisit' => 'Ostatnio widziany :date',
        'missingtext' => 'Na pewno nie ma tu żadnej literówki? (albo ten użytkownik jest zablokowany)',
        'origin_age' => ':age',
        'origin_country' => 'Pochodzi z :country',
        'origin_country_age' => ':age i pochodzi z :country',
        'page_description' => 'osu! - Wszystko co chcesz wiedzieć o :username!',
        'plays_with' => 'Gra za pomocą :devices',
        'title' => 'Profil :username',
        'change_avatar' => 'zmień swój awatar!',

        'edit' => [
            'cover' => [
                'button' => 'Zmień nagłówek profilu',
                'defaults_info' => 'Więcej nagłówków pojawi się w przyszłości',
                'upload' => [
                    'broken_file' => 'Nie udało się przetworzyć pliku. Zweryfikuj plik i spróbuj ponownie.',
                    'button' => 'Dodaj tło',
                    'dropzone' => 'Upuść tutaj, aby dodać',
                    'dropzone_info' => 'Możesz także upuścić swoje tło tutaj, aby je dodać',
                    'restriction_info' => "Aby odblokować tę funkcję, potrzebujesz <a href='".route('store.products.show', 'supporter-tag')."' target='_blank'>statusu donatora</a>, aby odblokować tę funkcję.",
                    'size_info' => 'Rozmiary nagłówka powinny wynosić przynajmniej 2000x700',
                    'too_large' => 'Plik jest zbyt duży.',
                    'unsupported_format' => 'To rozszerzenie nie jest wspierane.',
                ],
            ],

            'default_playmode' => [
                'is_default_tooltip' => 'domyślny tryb gry',
                'set' => 'ustaw :mode jako domyślny tryb gry',
            ],
        ],
        'extra' => [
            'followers' => '1 śledzący|:count śledzących|:count śledzących',
            'unranked' => 'Brak nowych wyników',

            'achievements' => [
                'title' => 'Osiągnięcia',
                'achieved-on' => 'Odblokowane dnia :date',
            ],
            'beatmaps' => [
                'none' => 'Jeszcze nie ma...',
                'title' => 'Beatmapy',

                'favourite' => [
                    'title' => 'Ulubione beatmapy (:count)',
                ],
                'graveyard' => [
                    'title' => 'Porzucone beatmapy (:count)',
                ],
                'ranked_and_approved' => [
                    'title' => 'Rankingowe i zatwierdzone beatmapy (:count)',
                ],
                'unranked' => [
                    'title' => 'Oczekujące beatmapy (:count)',
                ],
            ],
            'historical' => [
                'empty' => 'Brak wyników. :(',
                'title' => 'Historia',

                'monthly_playcounts' => [
                    'title' => 'Wykres zagrań',
                ],
                'most_played' => [
                    'count' => 'ilość zagrań',
                    'title' => 'Najczęściej grane beatmapy',
                ],
                'recent_plays' => [
                    'accuracy' => 'precyzja: :percentage',
                    'title' => 'Ostatnie wyniki',
                ],
                'replays_watched_counts' => [
                    'title' => 'Wykres obejrzanych powtórek',
                ],
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

                    'beatmap_discussion' => [
                        'allow_kudosu' => [
                            'give' => 'Otrzymano :amount za uchylenie odmowy otrzymania kudosu w wątku :post',
                        ],

                        'deny_kudosu' => [
                            'reset' => 'Odmówiono :amount za wątek :post',
                        ],

                        'delete' => [
                            'reset' => 'Utracono :amount za usunięcie wątku :post',
                        ],

                        'restore' => [
                            'give' => 'Otrzymano :amount za przywrócenie wątku :post',
                        ],

                        'vote' => [
                            'give' => 'Otrzymano :amount za zdobycie głosów w wątku :post',
                            'reset' => 'Utracono :amount za utratę głosów w wątku :post',
                        ],
                        'recalculate' => [
                            'give' => 'Otrzymano :amount w wyniku przekalkulowania głosów w wątku :post',
                            'reset' => 'Utracono :amount w wyniku przekalkulowania głosów w wątku :post',
                        ],
                    ],

                    'forum_post' => [
                        'give' => 'Otrzymano :amount od :giver za post na :post',
                        'reset' => 'Zresetowano kudosu przez :giver za post na :post',
                        'revoke' => 'Odebrano kudosu przez :giver za post na :post',
                    ],
                ],
            ],
            'me' => [
                'title' => 'ja!',
            ],
            'medals' => [
                'empty' => 'Ten użytkownik nie uzyskał jeszcze żadnych medali. ;_;',
                'title' => 'Medale',
            ],
            'recent_activity' => [
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
        'info' => [
            'interests' => 'Zainteresowania',
            'lastfm' => 'Last.fm',
            'location' => 'Obecna lokalizacja',
            'occupation' => 'Zajęcia',
            'skype' => 'Skype',
            'twitter' => 'Twitter',
            'website' => 'Strona internetowa',
        ],
        'page' => [
            'description' => '<strong>ja!</strong> to twoje osobiste miejsce, które możesz dowolnie dostosować.',
            'edit_big' => 'Edytuj mnie!',
            'placeholder' => 'Pisz tutaj',
            'restriction_info' => "Musisz posiadać <a href='".route('store.products.show', 'supporter-tag')."' target='_blank'>status donatora</a>, aby odblokować tę funkcję.",
        ],
        'post_count' => [
            '_' => ':count',
            'count' => ':count post na forum|:count posty na forum|:count postów na forum',
        ],
        'rank' => [
            'country' => 'Pozycja w rankingu krajowym dla :mode',
            'global' => 'Pozycja w rankingu światowym dla :mode',
        ],
        'stats' => [
            'hit_accuracy' => 'Precyzja',
            'level' => 'Poziom :level',
            'maximum_combo' => 'Maksymalne combo',
            'play_count' => 'Ilość zagrań',
            'play_time' => 'Łączny czas gry',
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
    'store' => [
        'saved' => 'Użytkownik utworzony', //no context
    ],
    'verify' => [
        'title' => 'Weryfikacja Konta',
    ],

];

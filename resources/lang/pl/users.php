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
    'deleted' => '[usunięty użytkownik]',

    'beatmapset_activities' => [
        'title' => "Historia modowania użytkownika :user",

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
            'title_most' => 'Najwięcej oddanych głosów (ostatnie 3 miesiące)',
        ],
    ],

    'blocks' => [
        'banner_text' => 'Ten użytkownik został zablokowany.',
        'blocked_count' => 'zablokowani użytkownicy (:count)',
        'hide_profile' => 'ukryj profil',
        'not_blocked' => 'Ten użytkownik nie jest zablokowany.',
        'show_profile' => 'pokaż profil',
        'too_many' => 'Osiągnięto limit zablokowanych użytkowników.',
        'button' => [
            'block' => 'zablokuj',
            'unblock' => 'odblokuj',
        ],
    ],

    'card' => [
        'loading' => 'Ładowanie...',
        'send_message' => 'wyślij wiadomość',
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
        'failed' => 'Nieprawidłowe dane logowania',
        'register' => "Nie posiadasz konta osu!? Utwórz nowe.",
        'forgot' => 'Nie pamiętasz hasła?',
        'beta' => [
            'main' => 'Beta jest obecnie dostępna tylko dla wybranych użytkowników.',
            'small' => '(donatorzy osu! otrzymają ją wkrótce)',
        ],

        'here' => 'tutaj', // this is substituted in when generating a link above. change it to suit the language.
    ],

    'posts' => [
        'title' => 'Posty użytkownika :username',
    ],

    'signup' => [
        '_' => 'Zarejestruj się',
    ],
    'anonymous' => [
        'login_link' => 'kliknij, aby się zalogować',
        'login_text' => 'zaloguj się',
        'username' => 'Gość',
        'error' => 'Musisz się zalogować, aby to zrobić.',
    ],
    'logout_confirm' => 'Na pewno chcesz się wylogować? :(',
    'report' => [
        'button_text' => 'zgłoś',
        'comments' => 'Dodatkowe informacje',
        'placeholder' => 'Podaj wszystkie informacje, które mogą okazać się przydatne.',
        'reason' => 'Powód',
        'thanks' => 'Dziękujemy za zgłoszenie!',
        'title' => 'Zgłosić gracza :username?',

        'actions' => [
            'send' => 'Wyślij zgłoszenie',
            'cancel' => 'Anuluj',
        ],

        'options' => [
            'cheating' => 'Oszukiwanie',
            'insults' => 'Obrażanie mnie lub innych',
            'spam' => 'Spamowanie',
            'unwanted_content' => 'Zamieszczanie nieodpowiednich treści',
            'nonsense' => 'Pisanie bez sensu',
            'other' => 'Inny (napisz poniżej)',
        ],
    ],
    'restricted_banner' => [
        'title' => 'Twoje konto zostało zablokowane!',
        'message' => 'Podczas blokady konta interakcja z innymi użytkownikami nie będzie możliwa, a twoje wyniki będą widoczne tylko dla ciebie. Zazwyczaj nałożenie blokady jest rezultatem zautomatyzowanego procesu, a jej usunięcie powinno nastąpić w ciągu 24 godzin. Jeżeli chcesz odwołać się od blokady, skontaktuj się z <a href="mailto:accounts@ppy.sh">pomocą techniczną</a>.',
    ],
    'show' => [
        'age' => 'Ma :age lat',
        'change_avatar' => 'zmień swój awatar!',
        'first_members' => 'Od samego początku',
        'is_developer' => 'programista osu!',
        'is_supporter' => 'donator osu!',
        'joined_at' => 'Na osu! od :date',
        'lastvisit' => 'Ostatnio online :date',
        'missingtext' => 'Wprowadzona nazwa użytkownika jest błędna lub użytkownik został zablokowany',
        'origin_country' => 'Pochodzi z :country',
        'page_description' => 'osu! - Wszystko co chcesz wiedzieć o :username!',
        'previous_usernames' => 'poprzednie nazwy użytkownika',
        'plays_with' => 'Gra za pomocą :devices',
        'title' => "Profil :username",

        'edit' => [
            'cover' => [
                'button' => 'Zmień tło profilu',
                'defaults_info' => 'Więcej teł pojawi się w przyszłości',
                'upload' => [
                    'broken_file' => 'Nie udało się przetworzyć pliku. Zweryfikuj plik i spróbuj ponownie.',
                    'button' => 'Dodaj tło',
                    'dropzone' => 'Upuść tutaj, aby dodać',
                    'dropzone_info' => 'Możesz także upuścić swoje tło tutaj, aby je dodać',
                    'restriction_info' => "Aby odblokować tę funkcję, potrzebujesz <a href='".route('store.products.show', 'supporter-tag')."' target='_blank'>statusu donatora</a>.",
                    'size_info' => 'Rozmiary tła powinny wynosić przynajmniej 2000x700',
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
            'followers' => '1 obserwujący|:count obserwujących|:count obserwujących',
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
                'loved' => [
                    'title' => 'Ulubione społeczności (:count)',
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
                    'count' => 'liczba zagrań',
                    'title' => 'Najczęściej grane beatmapy',
                ],
                'recent_plays' => [
                    'accuracy' => 'precyzja: :percentage',
                    'title' => 'Ostatnie wyniki (24 godz.)',
                ],
                'replays_watched_counts' => [
                    'title' => 'Wykres obejrzanych powtórek',
                ],
            ],
            'kudosu' => [
                'available' => 'Dostępne kudosu',
                'available_info' => "Punkty kudosu mogą zostać wymienione na gwiazdki kudosu, które pomogą twojej mapie zyskać więcej uwagi. Powyżej podano liczbę kudosu, którą możesz wymienić.",
                'recent_entries' => 'Ostatnio zdobyte kudosu',
                'title' => 'Kudosu!',
                'total' => 'Zdobyte kudosu',
                'total_info' => 'Oparte na tym, ile użytkownik zrobił dla modowania beatmap. Sprawdź <a href="'.osu_url('user.kudosu').'">tutaj</a>, aby dowiedzieć się więcej.',

                'entry' => [
                    'amount' => ':amount kudosu',
                    'empty' => "Ten gracz nie otrzymał jeszcze żadnego kudosu!",

                    'beatmap_discussion' => [
                        'allow_kudosu' => [
                            'give' => 'Otrzymano :amount za uchylenie odmowy otrzymania kudosu za post :post',
                        ],

                        'deny_kudosu' => [
                            'reset' => 'Odmówiono :amount za post :post',
                        ],

                        'delete' => [
                            'reset' => 'Utracono :amount za usunięcie posta :post',
                        ],

                        'restore' => [
                            'give' => 'Otrzymano :amount za przywrócenie posta :post',
                        ],

                        'vote' => [
                            'give' => 'Otrzymano :amount za zdobycie głosów w poście :post',
                            'reset' => 'Utracono :amount za utratę głosów w poście :post',
                        ],

                        'recalculate' => [
                            'give' => 'Otrzymano :amount w wyniku przekalkulowania głosów w poście :post',
                            'reset' => 'Utracono :amount w wyniku przekalkulowania głosów w poście :post',
                        ],
                    ],

                    'forum_post' => [
                        'give' => 'Otrzymano :amount od :giver za post na :post',
                        'reset' => 'Zresetowano kudosu przez :giver za post :post',
                        'revoke' => 'Odebrano kudosu przez :giver za post :post',
                    ],
                ],
            ],
            'me' => [
                'title' => 'ja!',
            ],
            'medals' => [
                'empty' => "Ten użytkownik nie uzyskał jeszcze żadnych medali. ;_;",
                'title' => 'Medale',
            ],
            'recent_activity' => [
                'title' => 'Ostatnie',
            ],
            'top_ranks' => [
                'empty' => 'Brak wyników. :(',
                'not_ranked' => 'Tylko rankingowe beatmapy przyznają pp.',
                'pp' => ':amountpp',
                'title' => 'Wyniki',
                'weighted_pp' => 'ważone: :pp (:percentage)',

                'best' => [
                    'title' => 'Najlepsze wyniki',
                ],
                'first' => [
                    'title' => 'Pierwsze miejsca',
                ],
            ],
            'account_standing' => [
                'title' => 'Stan konta',
                'bad_standing' => "Konto użytkownika <strong>:username</strong> nie jest w dobrym stanie :(",
                'remaining_silence' => 'Użytkownik <strong>:username</strong> będzie mógł pisać na czacie :duration.',

                'recent_infringements' => [
                    'title' => 'Ostatnie przewinienia',
                    'date' => 'data',
                    'action' => 'typ',
                    'length' => 'długość',
                    'length_permanent' => 'Na zawsze',
                    'description' => 'opis',
                    'actor' => 'przez :username',

                    'actions' => [
                        'restriction' => 'Blokada',
                        'silence' => 'Uciszenie',
                        'note' => 'Adnotacja',
                    ],
                ],
            ],
        ],
        'info' => [
            'discord' => 'Discord',
            'interests' => 'Zainteresowania',
            'lastfm' => 'Last.fm',
            'location' => 'Obecna lokalizacja',
            'occupation' => 'Zajęcia',
            'skype' => 'Skype',
            'twitter' => 'Twitter',
            'website' => 'Strona internetowa',
        ],
        'not_found' => [
            'reason_1' => 'Użytkownik mógł zmienić swoją nazwę.',
            'reason_2' => 'Konto użytkownika mogło zostać zablokowane.',
            'reason_3' => 'Wprowadzona nazwa użytkownika jest błędna.',
            'reason_header' => 'Jest kilka powodów dla których mogło się to zdarzyć:',
            'title' => 'Nie znaleziono użytkownika! ;_;',
        ],
        'page' => [
            'description' => '<strong>ja!</strong> to twoje osobiste miejsce, które możesz dowolnie dostosować.',
            'edit_big' => 'Edytuj mnie!',
            'placeholder' => 'Pisz tutaj',
            'restriction_info' => "Musisz posiadać <a href='".route('store.products.show', 'supporter-tag')."' target='_blank'>status donatora</a>, aby odblokować tę funkcję.",
        ],
        'post_count' => [
            '_' => ':link',
            'count' => ':count post na forum|:count posty na forum|:count postów na forum',
        ],
        'rank' => [
            'country' => 'Pozycja w rankingu krajowym dla :mode',
            'global' => 'Pozycja w rankingu globalnym dla :mode',
        ],
        'stats' => [
            'hit_accuracy' => 'Precyzja',
            'level' => 'Poziom :level',
            'maximum_combo' => 'Maksymalne combo',
            'play_count' => 'Liczba zagrań',
            'play_time' => 'Łączny czas gry',
            'ranked_score' => 'Łączny rankingowy wynik',
            'replays_watched_by_others' => 'Powtórki obejrzane przez innych',
            'score_ranks' => 'Wyniki',
            'total_hits' => 'Łączna liczba uderzeń',
            'total_score' => 'Łączny wynik',
        ],
    ],
    'status' => [
        'online' => 'Online',
        'offline' => 'Offline',
    ],
    'store' => [
        'saved' => 'Użytkownik utworzony',
    ],
    'verify' => [
        'title' => 'Weryfikacja konta',
    ],
];

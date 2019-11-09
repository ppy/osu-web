<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
 */

return [
    'deleted' => '[usunięty użytkownik]',

    'beatmapset_activities' => [
        'title' => "Historia modowania użytkownika :user",
        'title_compact' => 'Modowanie',

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
        'send_message' => 'Wyślij wiadomość',
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
        'lastvisit_online' => 'Obecnie online',
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
                    'size_info' => 'Rozmiary tła powinny wynosić przynajmniej 2800x620',
                    'too_large' => 'Plik jest zbyt duży.',
                    'unsupported_format' => 'To rozszerzenie nie jest wspierane.',

                    'restriction_info' => [
                        '_' => 'Tylko :link mogą przesyłać pliki',
                        'link' => 'donatorzy osu!',
                    ],
                ],
            ],

            'default_playmode' => [
                'is_default_tooltip' => 'domyślny tryb gry',
                'set' => 'ustaw :mode jako domyślny tryb gry',
            ],
        ],

        'extra' => [
            'none' => 'brak',
            'unranked' => 'Brak nowych wyników',

            'achievements' => [
                'achieved-on' => 'Odblokowane dnia :date',
                'locked' => 'Zablokowane',
                'title' => 'Osiągnięcia',
            ],
            'beatmaps' => [
                'by_artist' => 'autorstwa :artist',
                'none' => 'Jeszcze nie ma...',
                'title' => 'Beatmapy',

                'favourite' => [
                    'title' => 'Ulubione beatmapy',
                ],
                'graveyard' => [
                    'title' => 'Porzucone beatmapy',
                ],
                'loved' => [
                    'title' => 'Ulubione beatmapy społeczności',
                ],
                'ranked_and_approved' => [
                    'title' => 'Rankingowe i zatwierdzone beatmapy',
                ],
                'unranked' => [
                    'title' => 'Oczekujące beatmapy',
                ],
            ],
            'discussions' => [
                'title' => 'Dyskusje',
                'title_longer' => 'Ostatnie dyskusje',
                'show_more' => 'zobacz więcej dyskusji',
            ],
            'events' => [
                'title' => 'Wydarzenia',
                'title_longer' => 'Ostatnie wydarzenia',
                'show_more' => 'zobacz więcej wydarzeń',
            ],
            'historical' => [
                'empty' => 'Brak wyników. :(',
                'title' => 'Historia',

                'monthly_playcounts' => [
                    'title' => 'Wykres zagrań',
                    'count_label' => 'Liczba zagrań:',
                ],
                'most_played' => [
                    'count' => 'liczba zagrań',
                    'title' => 'Najczęściej grane beatmapy',
                ],
                'recent_plays' => [
                    'accuracy' => 'celność: :percentage',
                    'title' => 'Ostatnie wyniki (24 godz.)',
                ],
                'replays_watched_counts' => [
                    'title' => 'Wykres obejrzanych powtórek',
                    'count_label' => 'Obejrzane powtórki:',
                ],
            ],
            'kudosu' => [
                'available' => 'Dostępne kudosu',
                'available_info' => "Punkty kudosu mogą zostać wymienione na gwiazdki kudosu, które pomogą twojej mapie zyskać więcej uwagi. Powyżej podano liczbę kudosu, którą możesz wymienić.",
                'recent_entries' => 'Ostatnio zdobyte kudosu',
                'title' => 'Kudosu!',
                'total' => 'Zdobyte kudosu',

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

                'total_info' => [
                    '_' => 'Liczba zdobytych punktów kudosu jest oparta o wkład użytkownika w modowanie beatmap. Sprawdź :link, by dowiedzieć się więcej.',
                    'link' => 'ten artykuł',
                ],
            ],
            'me' => [
                'title' => 'O mnie',
            ],
            'medals' => [
                'empty' => "Ten użytkownik nie uzyskał jeszcze żadnych medali. ;_;",
                'recent' => 'Ostatnie',
                'title' => 'Medale',
            ],
            'posts' => [
                'title' => 'Posty',
                'title_longer' => 'Ostatnie posty',
                'show_more' => 'zobacz więcej postów',
            ],
            'recent_activity' => [
                'title' => 'Ostatnie',
            ],
            'top_ranks' => [
                'download_replay' => 'Pobierz powtórkę',
                'empty' => 'Brak wyników. :(',
                'not_ranked' => 'Tylko rankingowe beatmapy przyznają pp.',
                'pp_weight' => 'ważone :percentage',
                'title' => 'Wyniki',

                'best' => [
                    'title' => 'Najlepsze wyniki',
                ],
                'first' => [
                    'title' => 'Pierwsze miejsca',
                ],
            ],
            'votes' => [
                'given' => 'Oddane głosy (ostatnie 3 miesiące)',
                'received' => 'Otrzymane głosy (ostatnie 3 miesiące)',
                'title' => 'Głosy',
                'title_longer' => 'Ostatnie głosy',
                'vote_count' => ':count_delimited głos|:count_delimited głosy|:count_delimited głosów',
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

        'header_title' => [
            '_' => 'Użytkownik » :info',
            'info' => 'Informacje',
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
            'button' => 'Edytuj stronę użytkownika',
            'description' => '<strong>O mnie</strong> to twoje osobiste miejsce, które możesz dowolnie dostosować.',
            'edit_big' => 'Edytuj mnie!',
            'placeholder' => 'Pisz tutaj',

            'restriction_info' => [
                '_' => 'Musisz być :link, by odblokować tę funkcję.',
                'link' => 'donatorem osu!',
            ],
        ],
        'post_count' => [
            '_' => ':link',
            'count' => ':count_delimited post na forum|:count_delimited posty na forum|:count_delimited postów na forum',
        ],
        'rank' => [
            'country' => 'Pozycja w rankingu krajowym dla :mode',
            'country_simple' => 'Ranking krajowy',
            'global' => 'Pozycja w rankingu globalnym dla :mode',
            'global_simple' => 'Ranking globalny',
        ],
        'stats' => [
            'hit_accuracy' => 'Celność',
            'level' => 'Poziom :level',
            'level_progress' => 'Postęp do następnego poziomu',
            'maximum_combo' => 'Maksymalne combo',
            'medals' => 'Medale',
            'play_count' => 'Liczba zagrań',
            'play_time' => 'Łączny czas gry',
            'ranked_score' => 'Łączny rankingowy wynik',
            'replays_watched_by_others' => 'Powtórki obejrzane przez innych',
            'score_ranks' => 'Wyniki',
            'total_hits' => 'Łączna liczba uderzeń',
            'total_score' => 'Łączny wynik',
            // modding stats
            'ranked_and_approved_beatmapset_count' => 'Rankingowe i zatwierdzone beatmapy',
            'loved_beatmapset_count' => 'Ulubione beatmapy społeczności',
            'unranked_beatmapset_count' => 'Oczekujące beatmapy',
            'graveyard_beatmapset_count' => 'Porzucone beatmapy',
        ],
    ],

    'status' => [
        'all' => 'Wszyscy',
        'online' => 'Online',
        'offline' => 'Offline',
    ],
    'store' => [
        'saved' => 'Użytkownik utworzony',
    ],
    'verify' => [
        'title' => 'Weryfikacja konta',
    ],

    'view_mode' => [
        'card' => 'Widok kart',
        'list' => 'Widok listy',
    ],
];

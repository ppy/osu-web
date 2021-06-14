<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

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

    'disabled' => [
        'title' => 'Och! Wygląda na to, że Twoje konto zostało zdezaktywowane.',
        'warning' => "Jeżeli złamiesz zasady, pamiętaj o tym, że zwyczajowo obowiązuje okres oczekiwania o długości 1 miesiąca, podczas którego nie będziemy przyjmować żadnych próśb o amnestię. Po tym czasie możesz skontaktować się z nami, jeśli uznasz to za konieczne. Miej na uwadze, że tworzenie nowych kont po otrzymaniu blokady na jedno z nich poskutkuje <strong>przedłużeniem tego miesięcznego okresu oczekiwania</strong>. Pamiętaj także, że <strong>każdorazowe utworzenie nowego konta jest dalszym łamaniem zasad</strong>. Stanowczo zalecamy nieobieranie tej ścieżki!",

        'if_mistake' => [
            '_' => 'Jeżeli uważasz, że to pomyłka, skontaktuj się z nami (poprzez :email lub kliknięcie znaku zapytania w prawym dolnym rogu tej strony). Miej na uwadze, że zawsze jesteśmy całkowicie pewni naszych działań, ponieważ opierają się one na wiarygodnych danych. Mamy prawo odrzucić Twój wniosek, jeżeli uważamy, że umyślnie próbujesz wprowadzić nas w błąd.',
            'email' => 'e-mail',
        ],

        'reasons' => [
            'compromised' => 'Bezpieczeństwo twojego konta zostało uznane za naruszone. Zdezaktywowaliśmy je do czasu potwierdzenia twojej tożsamości.',
            'opening' => 'Istnieje kilka powodów, przez które Twoje konto mogło zostać zdezaktywowane:',

            'tos' => [
                '_' => 'Złamałeś(-aś) :community_rules lub :tos osu!.',
                'community_rules' => 'zasady społeczności',
                'tos' => 'warunki świadczenia usług',
            ],
        ],
    ],

    'filtering' => [
        'by_game_mode' => 'Według trybu gry',
    ],

    'force_reactivation' => [
        'reason' => [
            'inactive_different_country' => "Brak aktywności przez długi czas.",
        ],
    ],

    'login' => [
        '_' => 'Zaloguj się',
        'button' => 'Zaloguj się',
        'button_posting' => 'Logowanie...',
        'email_login_disabled' => 'Logowanie się przy użyciu adresu e-mail jest obecnie wyłączone. Użyj swojej nazwy użytkownika.',
        'failed' => 'Nieprawidłowe dane logowania',
        'forgot' => 'Nie pamiętasz hasła?',
        'info' => 'Zaloguj się, aby kontynuować.',
        'invalid_captcha' => 'Zbyt wiele nieudanych prób logowania - wykonaj captchę, by spróbować ponownie (odśwież stronę, jeżeli captcha nie jest widoczna).',
        'locked_ip' => 'Twój adres IP został zablokowany. Poczekaj kilka minut.',
        'password' => 'Hasło',
        'register' => "Nie posiadasz konta osu!? Utwórz nowe.",
        'remember' => 'Zapamiętaj ten komputer',
        'title' => 'Zaloguj się, aby kontynuować',
        'username' => 'Nazwa użytkownika',

        'beta' => [
            'main' => 'Beta jest obecnie dostępna tylko dla wybranych użytkowników.',
            'small' => '(donatorzy osu! otrzymają ją wkrótce)',
        ],
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
        'button_text' => 'Zgłoś',
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
        'previous_usernames' => 'poprzednie nazwy użytkownika',
        'plays_with' => 'Gra za pomocą :devices',
        'title' => "Profil :username",

        'comments_count' => [
            '_' => ':link',
            'count' => ':count_delimited komentarz|:count_delimited komentarze|:count_delimited komentarzy',
        ],
        'edit' => [
            'cover' => [
                'button' => 'Zmień tło profilu',
                'defaults_info' => 'Więcej teł pojawi się w przyszłości',
                'upload' => [
                    'broken_file' => 'Nie udało się przetworzyć pliku. Zweryfikuj plik i spróbuj ponownie.',
                    'button' => 'Dodaj tło',
                    'dropzone' => 'Upuść tutaj, aby dodać',
                    'dropzone_info' => 'Możesz także upuścić swoje tło tutaj, aby je dodać',
                    'size_info' => 'Rozmiary tła powinny wynosić przynajmniej 2400x640',
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
                'pending' => [
                    'title' => '',
                ],
                'ranked' => [
                    'title' => '',
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
                'not_ranked' => 'Tylko rankingowe beatmapy przyznają pp',
                'pp_weight' => 'ważone :percentage',
                'view_details' => 'Pokaż szczegóły',
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

        'info' => [
            'discord' => '',
            'interests' => 'Zainteresowania',
            'location' => 'Obecna lokalizacja',
            'occupation' => 'Zajęcia',
            'twitter' => '',
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
            'graveyard_beatmapset_count' => 'Porzucone beatmapy',
            'loved_beatmapset_count' => 'Ulubione beatmapy społeczności',
            'pending_beatmapset_count' => '',
            'ranked_beatmapset_count' => '',
        ],
    ],

    'silenced_banner' => [
        'title' => 'Twoje konto jest obecnie uciszone.',
        'message' => 'Niektóre działania mogą być niedostępne.',
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
        'brick' => 'Widok cegiełek',
        'card' => 'Widok kart',
        'list' => 'Widok listy',
    ],
];

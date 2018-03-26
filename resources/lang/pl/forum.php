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
    'pinned_topics' => 'Przypięte wątki',
    'slogan' => 'samodzielna rozgrywka jest niebezpieczna.',
    'subforums' => 'Podfora',
    'title' => 'Społeczność osu!',

    'covers' => [
        'create' => [
            '_' => 'Ustaw tło nagłówka',
            'button' => 'Dodaj tło',
            'info' => 'Nagłówek powinien mieć rozdzielczość :dimensions. Możesz także upuścić tutaj swoje tło, aby je dodać.',
        ],

        'destroy' => [
            '_' => 'Usuń tło nagłówka',
            'confirm' => 'Na pewno chcesz usunąć tło nagłówka?',
        ],
    ],

    'email' => [
        'new_reply' => '[osu!] Nowa odpowiedź dla wątku ":title"',
    ],

    'forums' => [
        'topics' => [
            'empty' => 'Brak wątków!',
        ],
    ],

    'post' => [
        'confirm_destroy' => 'Na pewno usunąć odpowiedź?',
        'confirm_restore' => 'Na pewno przywrócić odpowiedź?',
        'edited' => 'Ostatnio edytowe przez :user :when, łącznie edytowane :count razy.',
        'posted_at' => 'opublikowane :when',

        'actions' => [
            'destroy' => 'Usuń odpowiedź',
            'restore' => 'Przywróć odpowiedź',
            'edit' => 'Edytuj odpowiedź',
        ],
    ],

    'search' => [
        'go_to_post' => 'Przejdź do odpowiedzi',
        'post_number_input' => 'wprowadź numer odpowiedzi',
        'total_posts' => 'łącznie :posts_count odpowiedzi',
    ],

    'topic' => [
        'deleted' => 'usunięty wątek',
        'go_to_latest' => 'pokaż najnowszą odpowiedź',
        'latest_post' => ':when przez :user',
        'latest_reply_by' => 'ostatnia odpowiedź od :user',
        'new_topic' => 'Stwórz nowy wątek',
        'post_reply' => 'Opublikuj',
        'reply_box_placeholder' => 'Tutaj napisz swoją odpowiedź',
        'started_by' => 'przez :user',

        'create' => [
            'preview' => 'Podgląd',
            // TL note: this is used in the topic reply preview, when
            // the user goes back from previewing to editing the reply
            'preview_hide' => 'Napisz',
            'submit' => 'Opublikuj',

            'placeholder' => [
                'body' => 'Tutaj wpisz zawartość wątku',
                'title' => 'Kliknij, aby wprowadzić tytuł',
            ],
        ],

        'jump' => [
            'enter' => 'kliknij, aby przejść do specyficznej odpowiedzi',
            'first' => 'przejdź do pierwszej odpowiedzi',
            'last' => 'przejdź do ostatniej odpowiedzi',
            'next' => 'pomiń następne 10 odpowiedzi',
            'previous' => 'cofnij się o 10 odpowiedzi',
        ],

        'post_edit' => [
            'cancel' => 'Anuluj',
            'post' => 'Zapisz',
        ],
    ],

    'topic_watches' => [
        'index' => [
            'title' => 'Zasubskrybowane wątki',
            'title_compact' => 'subskrybcje',
            'title_main' => '<strong>Subskrybcje</strong> wątków',

            'box' => [
                'total' => 'Zasubskrybowane wątki',
                'unread' => 'Wątki z nowymi odpowiedziami',
            ],
            'info' => [
                'total' => 'Liczba zasubskrybowanych wątków: :total.',
                'unread' => 'Liczba zasubskrybowanych wątków z nowymi odpowiedziami: :unread.',
            ],
        ],

        'topic_buttons' => [
            'remove' => [
                'confirmation' => 'Cofnąć subskrybcję wątku?',
                'title' => 'Cofnij subskrybcję',
            ],
        ],
    ],

    'topics' => [
        '_' => 'Wątki',

        'actions' => [
            'reply' => 'Odpowiedz',
            'reply_with_quote' => 'Zacytuj we własnej odpowiedzi',
            'search' => 'Wyszukaj',
        ],

        'create' => [
            'create_poll' => 'Tworzenie ankiety',

            'create_poll_button' => [
                'add' => 'Stwórz ankietę',
                'remove' => 'Anuluj tworzenie ankiety',
            ],

            'poll' => [
                'length' => 'Przeprowadź ankietę przez',
                'length_days_prefix' => '',
                'length_days_suffix' => 'dni',
                'length_info' => 'Zostaw puste dla niekończącej się ankiety',
                'max_options' => 'Możliwości wyboru na każdego użytkownika',
                'max_options_info' => 'Ilość możliwości, które każdy użytkownik może wybrać podczas głosowania.',
                'options' => 'Możliwości wyboru',
                'options_info' => 'Umieszczaj każdą możliwość wyboru na nowej linii. Możesz wprowadzić maksymalnie 10 możliwości.',
                'title' => 'Pytanie',
                'vote_change' => 'Zezwól na zmianę głosów.',
                'vote_change_info' => 'Jeżeli ta opcja będzie zaznaczona, użytkownicy będą mogli zmieniać swoje głosy.',
            ],
        ],

        'edit_title' => [
            'start' => 'Edytuj tytuł',
        ],

        'index' => [
            'views' => 'wyświetleń',
            'replies' => 'odpowiedzi',
        ],

        'issue_tag_added' => [
            'to_0' => 'Usuń tag "dodane"',
            'to_0_done' => 'Usunięto tag "dodane"',
            'to_1' => 'Dodaj tag "dodane"',
            'to_1_done' => 'Dodano tag "dodane"',
        ],

        'issue_tag_assigned' => [
            'to_0' => 'Usuń tag "przypisane"',
            'to_0_done' => 'Usunięto tag "przypisane"',
            'to_1' => 'Dodaj tag "przypisane"',
            'to_1_done' => 'Dodano tag "przypisane"',
        ],

        'issue_tag_confirmed' => [
            'to_0' => 'Usuń tag "potwierdzone"',
            'to_0_done' => 'Usunięto tag "potwierdzone"',
            'to_1' => 'Dodaj tag "potwierdzone"',
            'to_1_done' => 'Dodano tag "potwierdzone"',
        ],

        'issue_tag_duplicate' => [
            'to_0' => 'Usuń tag "duplikat"',
            'to_0_done' => 'Usunięto tag "duplikat"',
            'to_1' => 'Dodaj tag "duplikat"',
            'to_1_done' => 'Dodano tag "duplikat"',
        ],

        'issue_tag_invalid' => [
            'to_0' => 'Usuń tag "nieprawidłowe"',
            'to_0_done' => 'Usunięto tag "nieprawidłowe"',
            'to_1' => 'Dodaj tag "nieprawidłowe"',
            'to_1_done' => 'Dodano tag "nieprawidłowe"',
        ],

        'issue_tag_resolved' => [
            'to_0' => 'Usuń tag "rozwiązane"',
            'to_0_done' => 'Usunięto tag "rozwiązane"',
            'to_1' => 'Dodaj tag "rozwiązane"',
            'to_1_done' => 'Dodano tag "rozwiązane"',
        ],

        'lock' => [
            'is_locked' => 'Ten wątek jest został zablokowany nie można w nim odpowiadać',
            'to_0' => 'Odblokuj wątek',
            'to_0_done' => 'Wątek został odblokowany',
            'to_1' => 'Zablokuj wątek',
            'to_1_done' => 'Wątek został zablokowany',
        ],

        'moderate_move' => [
            'title' => 'Przenieś do innego forum',
        ],

        'moderate_pin' => [
            'to_0' => 'Odepnij ten wątek',
            'to_0_done' => 'Wątek został odpięty',
            'to_1' => 'Przypnij ten wątek',
            'to_1_done' => 'Wątek został przypięty',
            'to_2' => 'Przypnij ten wątek i oznacz jako ogłoszenie',
            'to_2_done' => 'Wątek został przypięty i oznaczony jako ogłosznie',
        ],

        'show' => [
            'deleted-posts' => 'Usunięte odpowiedzi',
            'total_posts' => 'Wszystkie odpowiedzi',

            'feature_vote' => [
                'current' => 'Priorytet: +:count',
                'do' => 'Wspomóż tę prośbę',

                'user' => [
                    'count' => '{0} brak głosów|{1} :count głos|[2,*] :count głosów',
                    'current' => 'Pozostało ci :votes głosów.',
                    'not_enough' => 'Nie posiadasz żadnych głosów',
                ],
            ],

            'poll' => [
                'vote' => 'Zagłosuj',

                'detail' => [
                    'end_time' => 'Ankieta zakończy się :time',
                    'ended' => 'Ankieta zakończona :time',
                    'total' => 'Wszystkich głosów: :count',
                ],
            ],
        ],

        'watch' => [
            'to_not_watching' => 'Nie subskrybuj',
            'to_watching' => 'Zasubskrybuj',
            'to_watching_mail' => 'Zasubskrybuj z powiadomieniami',
            'mail_disable' => 'Wyłącz powiadomienia',
        ],
    ],
];

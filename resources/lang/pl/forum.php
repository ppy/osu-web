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
            'zoom' => [
                'start' => 'Tryb pełnoekranowy',
                'end' => 'Wyjdź z trybu pełnoekranowego',
            ],
        ],
    ],

    'topic_watches' => [
        'index' => [
            'title' => 'Subskrybcje wątków',
            'title_compact' => 'subskrybcje',
            'title_main' => '<strong>Subskrybcje</strong> wątków',

            'box' => [
                'total' => 'Zasubskrybowane wątki',
                'unread' => 'Wątki z nowymi odpowiedziami',
            ],
            'info' => [
                'total' => 'Łącznie zasubskrybowano do :total wątków.',
                'unread' => 'Masz :unread nieprzeczytanych odpowiedzi w zasubskrybowanych wątkach.',
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

        'index' => [
            'views' => 'wyświetleń',
            'replies' => 'odpowiedzi',
        ],

        'issue_tag_added' => [
            'action-0' => 'Usuń tag "dodane"',
            'action-1' => 'Dodaj tag "dodane"',
            'state-0' => 'Usunięto tag "dodane"',
            'state-1' => 'Dodano tag "dodane"',
        ],

        'issue_tag_assigned' => [
            'action-0' => 'Usuń tag "przypisane"',
            'action-1' => 'Dodaj tag "przypisane"',
            'state-0' => 'Usunięto tag "przypisane"',
            'state-1' => 'Dodano tag "przypisane"',
        ],

        'issue_tag_confirmed' => [
            'action-0' => 'Usuń tag "potwierdzone"',
            'action-1' => 'Dodaj tag "potwierdzone"',
            'state-0' => 'Usunięto tag "potwierdzone"',
            'state-1' => 'Dodano tag "potwierdzone"',
        ],

        'issue_tag_duplicate' => [
            'action-0' => 'Usuń tag "duplikat"',
            'action-1' => 'Dodaj tag "duplikat"',
            'state-0' => 'Usunięto tag "duplikat"',
            'state-1' => 'Dodano tag "duplikat"',
        ],

        'issue_tag_invalid' => [
            'action-0' => 'Usuń tag "nieprawidłowe"',
            'action-1' => 'Dodaj tag "nieprawidłowe"',
            'state-0' => 'Usunięto tag "nieprawidłowe"',
            'state-1' => 'Dodano tag "nieprawidłowe"',
        ],

        'issue_tag_resolved' => [
            'action-0' => 'Usuń tag "rozwiązane"',
            'action-1' => 'Dodaj tag "rozwiązane"',
            'state-0' => 'Usunięto tag "rozwiązane"',
            'state-1' => 'Dodano tag "rozwiązane"',
        ],

        'lock' => [
            'is_locked' => 'Ten wątek jest został zablokowany nie można w nim odpowiadać',
            'lock-0' => 'Odblokuj wątek',
            'lock-1' => 'Zablokuj wątek',
            'state-0' => 'Wątek został odblokowany',
            'state-1' => 'Wątek został zablokowany',
        ],

        'moderate_move' => [
            'title' => 'Przenieś do innego forum',
        ],

        'moderate_pin' => [
            'pin-0' => 'Odepnij ten wątek',
            'pin-1' => 'Przypnij ten wątek',
            'state-0' => 'Wątek został odpięty',
            'state-1' => 'Wątek został przypięty',
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
            'state-0' => 'Usunięto subskrybcję tego wątku',
            'state-1' => 'Zasubskrybowano ten wątek',
            'watch-0' => 'Usuń subskrybcję tego wątku',
            'watch-1' => 'Subskrybuj ten wątek',
        ],
    ],
];

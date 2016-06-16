<?php

/**
 *    Copyright 2015 ppy Pty. Ltd.
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

    'covers' => [
        'create' => [
            '_' => 'Ustaw tło nagłówka',
            'button' => 'Dodaj tło',
            'info' => 'Nagłówek powinien być w rozdzielczości :dimensions. Możesz także upuścić swoje tło tutaj, aby je dodać.',
        ],

        'destroy' => [
            '_' => 'Usuń tło nagłówka',
            'confirm' => 'Czy jesteś pewien, że chcesz usunąć tło nagłówka?',
        ],
    ],
    'pinned_topics' => 'Przypięte tematy',
    'post' => [
        'confirm_delete' => 'Na pewno usunąć post?',
        'edited' => 'Ostatnio edytowane przez :user o :when, edytowane :count razy łącznie.',
        'posted_at' => 'dodane :when',
        'actions' => [
            'delete' => 'Usuń post',
            'edit' => 'Edytuj post',
        ],
    ],
    'search' => [
        'go_to_post' => 'Przejdź do posta',
        'post_number_input' => 'wpisz numer posta',
        'total_posts' => 'Łączna ilość postów: :posts_count',
    ],
    'subforums' => 'Podfora',
    'title' => 'Społeczność osu!',
    'topic' => [
        'create' => [
            'placeholder' => [
                'body' => 'Pisz tutaj',
                'title' => 'Kliknij tutaj, aby ustawić tytuł',
            ],
            'preview' => 'Podgląd',
            'submit' => 'Publikuj',
        ],
        'go_to_latest' => 'zobacz najnowszy post',
        'jump' => [
            'enter' => 'kliknij aby wpisać numer posta',
            'first' => 'idź do pierwszego posta',
            'last' => 'idź do ostatniego posta',
            'next' => 'omiń kolejne 10 postów',
            'previous' => 'wróć się o 10 postów',
        ],
        'latest_post' => ':user o :when',
        'latest_reply_by' => 'ostatnia odpowiedź przez :user',
        'move' => 'Przejdź do innego forum',
        'new_topic' => 'Stwórz nowy temat',
        'post_edit' => [
            'cancel' => 'Anuluj',
            'post' => 'Zapisz',
            'zoom' => [
                'start' => 'Pełny ekran',
                'end' => 'Zamknij pełny ekran',
            ],
        ],
        'post_reply' => 'Odpowiedz',
        'reply_box_placeholder' => 'Pisz tutaj, aby odpowiedzieć',
        'started_by' => 'przez :user',
    ],
    'topics' => [
        '_' => 'Tematy',

        'actions' => [
            'reply' => 'Pokaż okno odpowiedzi',
            'reply_with_quote' => 'Cytuj post w odpowiedzi',
        ],

        'index' => [
            'views' => 'wyświetleń',
            'replies' => 'odpowiedzi',
        ],

        'lock' => [
            'locked-0' => 'Temat został odblokowany',
            'locked-1' => 'Temat został zablokowany',
            'is_locked' => 'Ten temat jest zablokowany i nie można na niego odpowiadać',
        ],

        'show' => [
            'feature_vote' => [
                'current' => 'Obecny priorytet: +:count',
                'do' => 'Poprzyj tę prośbę',

                'user' => [
                    'current' => 'Pozostało ci :votes głosów.',
                    'count' => '{0} brak głosów|{1} :count głos|[2,4] :count głosy|[5,Inf] :count głosów',
                    'not_enough' => "Wykorzystałeś już wszystkie głosy.",
                ],
            ],
        ],
    ],

];

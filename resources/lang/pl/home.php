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
    'landing' => [
        'online' => '<strong>:players</strong> użytkowników jest obecnie online w <strong>:games</strong> meczach',
        'peak' => ':count użytkowników online',
        'players' => '<strong>:count</strong> zarejestrowanych użytkowników',
        'download' => [
            '_' => 'Pobierz teraz',
            'soon' => 'osu! na inne systemy operacyjne pojawi się wkrótce',
            'for' => 'dla :os',
            'other' => 'kliknij tutaj po :os1 lub :os2',
        ],
        'slogan' => [
            'main' => 'darmowa gra rytmiczna',
            'sub' => 'rytm jest tylko *kliknięcie* stąd!',
        ],
    ],
    'search' => [
        'advanced_link' => 'Zaawansowane wyszukiwanie',
        'button' => 'Szukaj',
        'empty_result' => 'Nie znaleziono!',
        'missing_query' => 'Wyszukiwane hasło musi mieć minimalnie :n znaki',
        'title' => 'Wyniki wyszukiwania',
        'beatmapset' => [
            'more' => 'Zobacz więcej wyszukanych beatmap: :count',
            'more_simple' => 'Zobacz więcej wyszukanych beatmap',
            'title' => 'Beatmapy',
        ],
        'forum_post' => [
            'all' => 'Wszystkie fora',
            'link' => 'Przeszukaj forum',
            'more_simple' => 'Zobacz więcej znalezionych wątków na forum',
            'title' => 'Forum',
            'label' => [
                'forum' => 'przeszukaj fora',
                'forum_children' => 'uwzględnij subfora',
                'username' => 'autor',
            ],
        ],
        'mode' => [
            'all' => 'wszystkie',
            'beatmapset' => 'beatmapa',
            'forum_post' => 'forum',
            'user' => 'użytkownik',
            'wiki_page' => 'wiki',
        ],
        'user' => [
            'more' => 'Zobacz więcej wyszukanych użytkowników: :count',
            'more_simple' => 'Zobacz więcej wyszukanych użytkowników',
            'title' => 'Użytkownicy',
        ],
        'wiki_page' => [
            'link' => 'Przeszukaj wiki',
            'more_simple' => 'Zobacz więcej wyszukanych artykułów na wiki',
            'title' => 'Wiki',
        ],
    ],
    'download' => [
      'header' => [
          '1' => 'a więc',
          '2' => 'zapoznajmy się z',
          '3' => 'pobieraniem osu! na system Windows',
      ],
      'steps' => [
          '1' => [
              'name' => 'Krok 1',
              'content' => 'Pobierz klienta gry osu!',
          ],
          '2' => [
              'name' => 'Krok 2',
              'content' => 'Załóż konto na osu!',
          ],
          '3' => [
              'name' => 'Krok 3',
              'content' => '???',
          ],
      ],
      'more' => 'Dowiedz się więcej!',
      'more_text' => 'Sprawdź kanał YouTube <a href=https://www.youtube.com/user/osuacademy/">osu!academy</a> po poradniki i wskazówki dotyczące całego świata osu!',
    ],

    'user' => [
        'title' => 'wiadomości',
        'news' => [
            'title' => 'Wiadomości',
            'error' => 'Wystąpił błąd, spróbuj odświeżyć stronę.',
        ],
        'header' => [
            'welcome' => 'Witaj, <strong>:username</strong>!',
            'messages' => 'Masz 1 nową wiadomość|Masz :count nowe wiadomości|Masz :count nowych wiadomości',
            'stats' => [
                'friends' => 'Znajomi online',
                'games' => 'Mecze',
                'online' => 'Użytkownicy online',
            ],
        ],
        'beatmaps' => [
            'new' => 'Nowe rankingowe beatmapy',
            'popular' => 'Popularne beatmapy',
        ],
        'buttons' => [
            'download' => 'Pobierz osu!',
            'support' => 'Wesprzyj osu!',
            'store' => 'Sklep osu!',
        ],
    ],
];

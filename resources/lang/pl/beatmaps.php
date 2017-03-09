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
    'discussion-posts' => [
        'store' => [
            'error' => 'Zapisywanie posta nie powiodło się.',
        ],
    ],

    'discussion-votes' => [
        'update' => [
            'error' => 'Aktualizacja oceny nie powiodła się.',
        ],
    ],

    'discussions' => [
        'collapse' => [
            'all-collapse' => 'Zwiń wszystkie',
            'all-expand' => 'Rozwiń wszystkie',
        ],

        'edit' => 'edytuj',
        'edited' => 'Ostatnio edytowane przez :editor :update_time',
        'empty' => [
            'empty' => 'Brak dyskusji!',
            'filtered' => 'Nie znaleziono żadnych dyskusji zgodnych z wybranym filtrem.',
        ],

        'message_hint' => [
            'in_general' => 'Ten post znajdzie się w generalnej dyskusji tego mapsetu. Aby zmodować tę mapę, zacznij post od konkretnego momentu (np. 00:12:345).',
            'in_timeline' => 'Aby zgłosić uwagi dotyczące kilku różnych momentów piosenki, utwórz dla nich odrębne komentarze (po jednym dla każdego momentu utworu).',
        ],

        'message_placeholder' => 'Pisz tutaj',

        'message_type' => [
            'praise' => 'Pochwała',
            'problem' => 'Problem',
            'suggestion' => 'Sugestia',
        ],

        'message_type_select' => 'Wybierz typ komentarza',

        'mode' => [
            'general' => 'Główne',
            'timeline' => 'Oś czasu',
        ],

        'require-login' => 'Zaloguj się, aby móc postować i odpowiadać.',
        'resolved' => 'Rozwiązane',

        'show' => [
            'title' => 'Dyskusja na temat mapy',
        ],

        'stats' => [
            'mine' => 'Moje',
            'pending' => 'Oczekujące',
            'praises' => 'Pochwały',
            'resolved' => 'Rozwiązane',
            'total' => 'Łącznie',
        ],
    ],

    'listing' => [
        'search' => [
            'prompt' => 'wpisz poszukiwane wyrażenie...',
            'options' => 'Więcej opcji wyszukiwarki',
            'not-found' => 'brak wyników',
            'not-found-quote' => '... nic nie znaleziono.',
        ],
        'mode' => 'Tryb gry',
        'status' => 'Status mapy',
        'mapped-by' => 'zmapowana przez :mapper',
        'source' => 'pochodzi z :source',
        'load-more' => 'Załaduj więcej...',
    ],
    'mode' => [
        'any' => 'Jakikolwiek',
        'osu' => 'osu!',
        'taiko' => 'osu!taiko',
        'fruits' => 'osu!catch',
        'mania' => 'osu!mania',
    ],
    'status' => [
        'any' => 'Jakikolwiek',
        'ranked-approved' => 'Rankingowe & Zatwierdzone',
        'approved' => 'Zatwierdzone',
        'faves' => 'Ulubione',
        'modreqs' => 'Wymagające modów',
        'pending' => 'Oczekujące',
        'graveyard' => 'Cmentarz',
        'my-maps' => 'Moje mapy',
    ],
    'genre' => [
        'any' => 'Jakikolwiek',
        'unspecified' => 'Jakikolwiek',
        'video-game' => 'Gra',
        'anime' => 'Anime',
        'rock' => 'Rock',
        'pop' => 'Pop',
        'other' => 'Inne',
        'novelty' => 'Nowość',
        'hip-hop' => 'Hip Hop',
        'electronic' => 'Electro',
    ],
    'mods' => [
        'NM' => 'Bez modów',
    ],
    'language' => [
    'any' => 'Jakikolwiek',
    'english' => 'Angielski',
    'chinese' => 'Chiński',
    'french' => 'Francuski',
    'german' => 'Niemiecki',
    'italian' => 'Włoski',
    'japanese' => 'Japoński',
    'korean' => 'Koreański',
    'spanish' => 'Hiszpański',
    'swedish' => 'Szwedzki',
    //left over untranslated on purpose
    'instrumental' => 'Instrumental',
    'other' => 'Inne',
    ],
    'extra' => [
        'video' => 'Posiada wideo',
        'storyboard' => 'Posiada storyboard',
    ],
    'rank' => [
        'any' => 'Jakikolwiek',
        'XH' => 'Srebrne SS',
        'X' => 'SS',
        'SH' => 'Srebrne S',
        'S' => 'S',
        'A' => 'A',
        'B' => 'B',
        'C' => 'C',
        'D' => 'D',
    ],
];

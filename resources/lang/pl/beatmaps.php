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
    'beatmapset' => [
        'show' => [
            'details' => [
                'made-by' => 'stworzony przez :user',
                'submitted' => 'dodana ',
                'ranked' => 'rankingowa od ',
                'logged-out' => 'Musisz się zalogować, aby pobierać beatmapy!',
                'download' => [
                    'normal' => 'pobierz',
                    'direct' => 'osu!direct',
                    'no-video' => 'wersja bez wideo',
                ],
            ],
            'stats' => [
                //this is left intentionally in english, you can't translate these so it sounds normal
                'cs' => 'Circle Size',
                'hp' => 'HP Drain',
                'od' => 'Accuracy',
                'ar' => 'Approach Rate',
                'stars' => 'Trudność',
                'length' => 'Długość',
                'bpm' => 'BPM',

                'chart' => [
                    'cs' => 'CS',
                    'hp' => 'HP',
                    'od' => 'OD',
                    'ar' => 'AR',
                    'sd' => 'SD',
                ],

                'source' => 'Źródło',
                'tags' => 'Tagi',
            ],
            'extra' => [
                'description' => [
                    'title' => 'Opis',
                ],
                'success-rate' => [
                    'title' => 'Wskaźnik sukcesu',
                    'rate' => 'Wskaźnik sukcesu: :percentage%',
                    'points' => 'Wykres',
                    'retry' => 'Ponowne próby',
                    //this is left intentionally as well
                    'fail' => 'Fail',
                ],
                'scoreboard' => [
                    'title' => 'Tablica wyników',
                    'no-scores' => [
                        'global' => 'Brak wyników. Może powinieneś jakieś zdobyć?',
                        'loading' => 'Ładowanie wyników...',
                        'country' => 'Nikt z twojego kraju nie ustanowił tutaj wyniku!',
                        'friend' => 'Żaden z twoich znajomych nie ma tutaj wyniku!',
                    ],
                    'supporter-only' => 'Musisz być supporterem, aby uzyskać dostęp do rankingu krajowego i znajomych!',
                    'supporter-link' => 'Kliknij <a href=":link">tutaj</a>, aby zobaczyć, co jeszcze otrzymujesz w zamian za bycie supporterem!',
                    'global' => 'Ranking globalny',
                    'country' => 'Ranking krajowy',
                    'friend' => 'Ranking znajomych',
                    'first' => [
                        'accuracy' => 'Celność',
                        'score' => 'Wynik',
                        'count300' => '300',
                        'count100' => '100',
                        'count50' => '50',
                    ],
                    'list' => [
                        'rank-header' => 'Miejsce',
                        'player-header' => 'Gracz',
                        'score' => 'Wynik',
                        'accuracy' => 'Celność',
                    ],
                ],
            ],
        ],
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

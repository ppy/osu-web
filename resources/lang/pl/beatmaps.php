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
            'error' => 'Zapisywanie wątku nie powiodło się',
        ],
    ],

    'discussion-votes' => [
        'update' => [
            'error' => 'Aktualizacja oceny nie powiodła się',
        ],
    ],

    'discussions' => [
        'allow_kudosu' => 'zezwól kudosu',
        'delete' => 'usuń',
        'deleted' => 'Usunięte przez :editor :delete_time',
        'deny_kudosu' => 'zablokuj kudosu',
        'edit' => 'edytuj',
        'edited' => 'Ostatnio edytowane przez :editor :update_time',
        'message_placeholder' => 'Pisz tutaj',
        'message_type_select' => 'Wybierz typ komentarza',
        'reply_placeholder' => 'Tutaj napisz swoją odpowiedź',
        'require-login' => 'Zaloguj się, aby odpowiedzieć bądź opublikować uwagę',
        'resolved' => 'Rozwiązane',
        'restore' => 'odzyskaj',
        'title' => 'Dyskusje',

        'collapse' => [
            'all-collapse' => 'Zwiń wszystkie',
            'all-expand' => 'Rozwiń wszystkie',
        ],

        'empty' => [
            'empty' => 'Brak dyskusji!',
            'hidden' => 'Żadna dyskusja nie pasuje do wybranego filtru.',
        ],

        'message_hint' => [
            'in_general' => 'Ta odpowiedź znajdzie się w generalnej dyskusji tego beatmapsetu. Aby zmodować tę beatmapę, zacznij odpowiedź od konkretnego momentu (np. 00:12:345).',
            'in_timeline' => 'Aby zgłosić uwagi dotyczące kilku różnych momentów piosenki, utwórz dla nich odrębne komentarze (po jednym dla każdego momentu utworu).',
        ],

        'message_type' => [
            'praise' => 'Pochwała',
            'problem' => 'Problem',
            'suggestion' => 'Sugestia',
        ],

        'mode' => [
            'events' => 'Historia',
            'general' => 'Główne',
            'general_all' => 'Główne (wszystkie poziomy trudności)',
            'timeline' => 'Oś czasu',
        ],

        'new' => [
            'timestamp' => 'Znacznik czasu',
            'timestamp_missing' => 'Naciśnij Ctrl+C w edytorze i wklej swoją wiadomość, aby dodać znacznik czasu!',
            'title' => 'Nowa dyskusja',
        ],

        'show' => [
            'title' => ':title zmapowana przez :mapper',
        ],

        'stats' => [
            'deleted' => 'Usunięte',
            'mine' => 'Moje',
            'pending' => 'Oczekujące',
            'praises' => 'Pochwały',
            'resolved' => 'Rozwiązane',
            'total' => 'Wszystkie',
        ],
    ],

    'nominations' => [
        'disqualification_prompt' => 'Powód dyskwalifikacji?',
        'disqualified_at' => 'zdyskwalifkowane :time_ago (:reason).',
        'disqualified_no_reason' => 'brak określonego powodu',
        'disqualify' => 'Zdyskwalifikuj',
        'incorrect_state' => 'Wystąpił błąd podczas wykonywania tej akcji, spróbuj odświeżyć stronę.',
        'nominate' => 'Nominuj',
        'nominate_confirm' => 'Nominować tę beatmapę?',
        'qualified' => 'Otrzyma status rankingowy :date, jeżeli nie zostaną odnalezione żadne błędy.',
        'qualified_soon' => 'Wkrótce otrzyma status rankingowy, jeżeli nie zostaną odnalezione żadne błędy.',
        'required_text' => 'Nominacjes: :current/:required',
        'title' => 'Status nominacji',
    ],

    'listing' => [
        'search' => [
            'prompt' => 'wpisz poszukiwane wyrażenie...',
            'options' => 'Więcej opcji wyszukiwania',
            'not-found' => 'brak wyników',
            'not-found-quote' => '... niczego nie znaleziono.',
            'filters' => [
                'mode' => 'Tryb gry',
                'status' => 'Status beatmapy',
                'genre' => 'Gatunek',
                'language' => 'Język',
                'extra' => 'Dodatkowe',
                'rank' => 'Uzyskana ocena',
            ],
        ],
        'mode' => 'Tryb gry',
        'status' => 'Status beatmapy',
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
        'loved' => 'Ulubione społeczności',
        'faves' => 'Ulubione',
        'pending' => 'Oczekujące',
        'graveyard' => 'Cmentarz',
        'my-maps' => 'Moje beatmapy',
    ],
    'genre' => [
        'any' => 'Jakikolwiek',
        'unspecified' => 'Nieokreślony',
        'video-game' => 'Gra',
        'anime' => 'Anime',
        'rock' => 'Rock',
        'pop' => 'Pop',
        'other' => 'Inny',
        'novelty' => 'Nowy',
        'hip-hop' => 'Hip Hop',
        'electronic' => 'Muzyka elektroniczna',
    ],
    'mods' => [
        'NF' => 'No Fail',
        'EZ' => 'Easy Mode',
        'HD' => 'Hidden',
        'HR' => 'Hard Rock',
        'SD' => 'Sudden Death',
        'DT' => 'Double Time',
        'Relax' => 'Relax',
        'HT' => 'Half Time',
        'NC' => 'Nightcore',
        'FL' => 'Flashlight',
        'SO' => 'Spun Out',
        'AP' => 'Auto Pilot',
        'PF' => 'Perfect',
        '4K' => '4K',
        '5K' => '5K',
        '6K' => '6K',
        '7K' => '7K',
        '8K' => '8K',
        'FI' => 'Fade In',
        '9K' => '9K',
        'NM' => 'Brak modyfikacji',
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
        'instrumental' => 'Instrumentalny',
        'other' => 'Inne',
    ],
    'extra' => [
        'video' => 'Posiada wideo',
        'storyboard' => 'Posiada storyboard',
    ],
    'rank' => [
        'any' => 'Jakakolwiek',
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

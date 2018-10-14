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
    'discussion-posts' => [
        'store' => [
            'error' => 'Zapisywanie postu nie powiodło się',
        ],
    ],

    'discussion-votes' => [
        'update' => [
            'error' => 'Aktualizacja oceny nie powiodła się',
        ],
    ],

    'discussions' => [
        'allow_kudosu' => 'zezwól na kudosu',
        'delete' => 'usuń',
        'deleted' => 'Usunięte przez :editor :delete_time',
        'deny_kudosu' => 'odrzuć kudosu',
        'edit' => 'edytuj',
        'edited' => 'Ostatnio edytowane przez :editor :update_time',
        'kudosu_denied' => 'Odmówiono uzyskania kudosu.',
        'message_placeholder_deleted_beatmap' => 'Ten poziom trudności został usunięty, więc nie można umieszczać w nim postów.',
        'message_type_select' => 'Wybierz typ komentarza',
        'reply_notice' => 'Naciśnij Enter, aby odpowiedzieć.',
        'reply_placeholder' => 'Napisz tutaj swoją odpowiedź',
        'require-login' => 'Zaloguj się, aby odpowiedzieć bądź opublikować uwagę',
        'resolved' => 'Rozwiązane',
        'restore' => 'przywróć',
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
            'in_general' => 'Ten post znajdzie się w generalnej dyskusji tego zestawu beatmap. Aby zmodować tę beatmapę, zacznij wiadomość od znacznika czasu (np. 00:12:345).',
            'in_timeline' => 'Aby zgłosić uwagi dla kilku różnych znaczników czasu, utwórz dla nich odrębne posty (po jednym dla każdego znacznika czasu).',
        ],

        'message_placeholder' => [
            'general' => 'Utwórz post w ogólnej dyskusji (:version)',
            'generalAll' => 'Utwórz post w ogólnej dyskusji (wszystkie poziomy trudności)',
            'timeline' => 'Utwórz post dla osi czasu (:version)',
        ],

        'message_type' => [
            'disqualify' => 'Zdyskwalifikuj',
            'hype' => 'Priorytet',
            'mapper_note' => 'Adnotacja',
            'nomination_reset' => 'Zresetuj nominację',
            'praise' => 'Pochwała',
            'problem' => 'Problem',
            'suggestion' => 'Sugestia',
        ],

        'mode' => [
            'events' => 'Historia',
            'general' => 'Główne :scope',
            'timeline' => 'Oś czasu',
            'scopes' => [
                'general' => 'Ten poziom trudności',
                'generalAll' => 'Wszystkie poziomy trudności',
            ],
        ],

        'new' => [
            'timestamp' => 'Znacznik czasu',
            'timestamp_missing' => 'Naciśnij Ctrl+C w edytorze i wklej swoją wiadomość, aby dodać znacznik czasu!',
            'title' => 'Nowa dyskusja',
        ],

        'show' => [
            'title' => ':title autorstwa :mapper',
        ],

        'sort' => [
            '_' => 'Sortowane według:',
            'created_at' => 'data utworzenia',
            'timeline' => 'oś czasu',
            'updated_at' => 'ostatnie aktualizacje',
        ],

        'stats' => [
            'deleted' => 'Usunięte',
            'mapper_notes' => 'Adnotacje',
            'mine' => 'Moje',
            'pending' => 'Oczekujące',
            'praises' => 'Pochwały',
            'resolved' => 'Rozwiązane',
            'total' => 'Wszystkie',
        ],

        'status-messages' => [
            'approved' => 'Ta beatmapa została zatwierdzona :date!',
            'graveyard' => "Ta beatmapa nie była aktualizowana od :date i najprawdopodobniej została porzucona przez swojego twórcę...",
            'loved' => 'Ta beatmapa otrzymała status ulubionej społeczności :date!',
            'ranked' => 'Ta beatmapa otrzymała status rankingowy :date!',
            'wip' => 'Ważne: Ta beatmapa została oznaczona przez twórcę jako aktualnie rozwijana.',
        ],

    ],

    'hype' => [
        'button' => 'Nagłośnij beatmapę!',
        'button_done' => 'Już nagłośniono!',
        'confirm' => "Na pewno? Zużyje to jedno z twoich możliwych nagłośnień. Tej czynności nie można cofnąć.",
        'explanation' => 'Nagłośnij tę beatmapę, aby stała się bardziej widoczna dla nominatorów i osób modujących!',
        'explanation_guest' => 'Zaloguj się i nagłośnij tę beatmapę, aby stała się bardziej widoczna dla nominatorów i osób modujących!',
        'new_time' => "Nagłośnienie kolejnej beatmapy będzie możliwe za :new_time.",
        'remaining' => 'Możesz nagłośnić jeszcze :remaining beatmap(y).',
        'required_text' => 'Priorytet: :current/:required',
        'section_title' => 'Priorytet',
        'title' => 'Priorytet',
    ],

    'feedback' => [
        'button' => 'Zostaw ocenę',
    ],

    'nominations' => [
        'disqualification_prompt' => 'Powód dyskwalifikacji?',
        'disqualified_at' => 'Zdyskwalifkowane :time_ago (:reason).',
        'disqualified_no_reason' => 'brak określonego powodu',
        'disqualify' => 'Zdyskwalifikuj',
        'incorrect_state' => 'Wystąpił błąd podczas wykonywania tej akcji, spróbuj odświeżyć stronę.',
        'love' => 'Nadaj status ulubionej społeczności',
        'love_confirm' => 'Czy chcesz nadać tej beatmapie status ulubionej społeczności?',
        'nominate' => 'Nominuj',
        'nominate_confirm' => 'Nominować tę beatmapę?',
        'nominated_by' => 'nominowana przez :users',
        'qualified' => 'Otrzyma status rankingowy :date, jeżeli nie zostaną wykryte żadne błędy.',
        'qualified_soon' => 'Wkrótce otrzyma status rankingowy, jeżeli nie zostaną wykryte żadne błędy.',
        'required_text' => 'Nominacje: :current/:required',
        'reset_message_deleted' => 'usunięta',
        'title' => 'Status nominacji',
        'unresolved_issues' => 'Nadal występują nierozwiązane problemy, do których musisz się odnieść.',

        'reset_at' => [
            'nomination_reset' => ':user zresetował(a) proces nominacji :time_ago z powodu nowego problemu :discussion (:message).',
            'disqualify' => ':user zdyskwalifikował(a) beatmapę :time_ago z powodu nowego problemu :discussion (:message).',
        ],

        'reset_confirm' => [
            'nomination_reset' => 'Na pewno? Zgłoszenie nowego problemu zresetuje proces nominacji.',
        ],
    ],

    'listing' => [
        'search' => [
            'prompt' => 'wpisz poszukiwaną frazę...',
            'login_required' => 'Zaloguj się, aby wyszukać.',
            'options' => 'Więcej opcji wyszukiwania',
            'supporter_filter' => 'Użycie wybranych filtrów (:filters) wymaga aktywnego statusu donatora osu!',
            'not-found' => 'brak wyników',
            'not-found-quote' => '...niczego nie znaleziono.',
            'filters' => [
                'general' => 'Główne',
                'mode' => 'Tryb gry',
                'status' => 'Kategorie',
                'genre' => 'Gatunek',
                'language' => 'Język',
                'extra' => 'Dodatkowe',
                'rank' => 'Uzyskana ocena',
                'played' => 'Ukończenie',
            ],
            'sorting' => [
                'title' => 'tytuł',
                'artist' => 'wykonawca',
                'difficulty' => 'poziom trudności',
                'updated' => 'data modyfikacji',
                'ranked' => 'data',
                'rating' => 'ocena',
                'plays' => 'liczba zagrań',
                'relevance' => 'trafność',
                'nominations' => 'nominacje',
            ],
            'supporter_filter_quote' => [
                '_' => 'Użycie wybranych filtrów (:filters) wymaga :link',
                'link_text' => 'statusu donatora osu!',
            ],
        ],
    ],
    'general' => [
        'recommended' => 'Polecany poziom trudności',
        'converts' => 'Uwzględnij przekonwertowane beatmapy',
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
        'ranked-approved' => 'Rankingowe i zatwierdzone',
        'approved' => 'Zatwierdzone',
        'qualified' => 'Zakwalifikowane',
        'loved' => 'Ulubione społeczności',
        'faves' => 'Ulubione',
        'pending' => 'Oczekujące i rozwijane',
        'graveyard' => 'Porzucone',
        'my-maps' => 'Moje beatmapy',
    ],
    'genre' => [
        'any' => 'Jakikolwiek',
        'unspecified' => 'Nieokreślony',
        'video-game' => 'Gra wideo',
        'anime' => 'Anime',
        'rock' => 'Rock',
        'pop' => 'Pop',
        'other' => 'Inny',
        'novelty' => 'Oryginalny',
        'hip-hop' => 'Hip Hop',
        'electronic' => 'Muzyka elektroniczna',
    ],
    'mods' => [
        '4K' => '4K',
        '5K' => '5K',
        '6K' => '6K',
        '7K' => '7K',
        '8K' => '8K',
        '9K' => '9K',
        'AP' => 'Auto Pilot',
        'DT' => 'Double Time',
        'EZ' => 'Easy Mode',
        'FI' => 'Fade In',
        'FL' => 'Flashlight',
        'HD' => 'Hidden',
        'HR' => 'Hard Rock',
        'HT' => 'Half Time',
        'NC' => 'Nightcore',
        'NF' => 'No Fail',
        'NM' => 'Brak modyfikatorów',
        'PF' => 'Perfect',
        'Relax' => 'Relax',
        'SD' => 'Sudden Death',
        'SO' => 'Spun Out',
        'TD' => 'Urządzenie dotykowe',
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
        'other' => 'Inny',
    ],
    'played' => [
        'any' => 'Jakikolwiek',
        'played' => 'Ukończona',
        'unplayed' => 'Nieukończona',
    ],
    'extra' => [
        'video' => 'Posiada wideo',
        'storyboard' => 'Posiada scenorys',
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

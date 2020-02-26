<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
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
    'availability' => [
        'disabled' => 'Nie możesz pobrać tej beatmapy.',
        'parts-removed' => 'Ta beatmapa została usunięta za prośbą twórcy materiałów w niej użytych.',
        'more-info' => 'Kliknij tutaj, aby dowiedzieć się więcej.',
    ],

    'index' => [
        'title' => 'Lista beatmap',
        'guest_title' => 'Beatmapy',
    ],

    'show' => [
        'discussion' => 'Dyskusja',

        'details' => [
            'favourite' => 'Dodaj do ulubionych',
            'logged-out' => 'Zaloguj się, aby zacząć pobierać beatmapy!',
            'mapped_by' => 'autorstwa :mapper',
            'unfavourite' => 'Usuń z ulubionych',
            'updated_timeago' => 'ostatnio zaktualizowana :timeago',

            'download' => [
                '_' => 'Pobierz',
                'direct' => 'osu!direct',
                'no-video' => 'bez wideo',
                'video' => 'z wideo',
            ],

            'login_required' => [
                'bottom' => 'aby uzyskać dostęp do pozostałych funkcji',
                'top' => 'Zaloguj się',
            ],
        ],

        'favourites' => [
            'limit_reached' => 'Masz za dużo ulubionych beatmap! Usuń kilka, jeżeli chcesz kontynuować.',
        ],

        'hype' => [
            'action' => 'Nagłośnij tę beatmapę, aby pomóc jej w uzyskaniu statusu <strong>rankingowego</strong>.',

            'current' => [
                '_' => 'Ta beatmapa jest obecnie :status.',

                'status' => [
                    'pending' => 'oczekująca',
                    'qualified' => 'zakwalifikowana',
                    'wip' => 'rozwijana',
                ],
            ],

            'disqualify' => [
                '_' => 'Jeżeli znajdziesz problem z tą beatmapą, zdyskwalifikuj ją :link.',
                'button_title' => 'Zdyskwalifikuj beatmapę.',
            ],

            'report' => [
                '_' => 'Jeżeli znajdziesz problem z tą beatmapą, zgłoś go :link, aby powiadomić zespół.',
                'button' => 'Zgłoś problem',
                'button_title' => 'Zgłoś problem z zakwalifikowaną beatmapą.',
                'link' => 'tutaj',
            ],
        ],

        'info' => [
            'description' => 'Opis',
            'genre' => 'Gatunek',
            'language' => 'Język',
            'no_scores' => 'Dane są nadal ładowane...',
            'points-of-failure' => 'Wykres porażek',
            'source' => 'Źródło',
            'success-rate' => 'Wskaźnik ukończonych zagrań',
            'tags' => 'Tagi',
            'unranked' => 'Nierankingowa beatmapa',
        ],

        'scoreboard' => [
            'achieved' => 'osiągnięte :when',
            'country' => 'Ranking krajowy',
            'friend' => 'Ranking znajomych',
            'global' => 'Ranking globalny',
            'supporter-link' => 'Kliknij <a href=":link">tutaj</a>, aby zobaczyć, jakie jeszcze funkcje otrzymasz w zamian za zakup statusu donatora!',
            'supporter-only' => 'Musisz posiadać status donatora, aby uzyskać dostęp do rankingu krajowego i znajomych!',
            'title' => 'Tabela wyników',

            'headers' => [
                'accuracy' => 'Celność',
                'combo' => 'Combo',
                'miss' => 'Pudła',
                'mods' => 'Modyfikatory',
                'player' => 'Gracz',
                'pp' => 'pp',
                'rank' => 'Pozycja',
                'score_total' => 'Wynik',
                'score' => 'Wynik',
            ],

            'no_scores' => [
                'country' => 'Nikt z twojego kraju nie ustanowił jeszcze wyniku na tej beatmapie!',
                'friend' => 'Żaden z twoich znajomych nie ustanowił jeszcze wyniku na tej beatmapie!',
                'global' => 'Brak wyników. Może czas jakieś ustanowić?',
                'loading' => 'Ładowanie wyników...',
                'unranked' => 'Nierankingowa beatmapa.',
            ],
            'score' => [
                'first' => 'Najlepszy wynik',
                'own' => 'Twój wynik',
            ],
        ],

        'stats' => [
            'cs' => 'Wielkość kółek',
            'cs-mania' => 'Liczba klawiszy',
            'drain' => 'Spadek HP',
            'accuracy' => 'Precyzja',
            'ar' => 'Prędkość otoczki',
            'stars' => 'Trudność',
            'total_length' => 'Długość (długość aktywnej gry: :hit_length)',
            'bpm' => 'BPM',
            'count_circles' => 'Liczba kółek',
            'count_sliders' => 'Liczba sliderów',
            'user-rating' => 'Oceny użytkowników',
            'rating-spread' => 'Wykres ocen',
            'nominations' => 'Nominacje',
            'playcount' => 'Liczba zagrań',
        ],

        'status' => [
            'ranked' => 'Rankingowa',
            'approved' => 'Zatwierdzona',
            'loved' => 'Ulubiona społeczności',
            'qualified' => 'Zakwalifikowana',
            'wip' => 'Obecnie rozwijana',
            'pending' => 'Oczekująca',
            'graveyard' => 'Porzucona',
        ],
    ],
];

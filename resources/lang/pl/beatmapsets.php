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
            'mapped_by' => 'autorstwa :mapper',
            'submitted' => 'dodana ',
            'updated' => 'ostatnio aktualizowana ',
            'updated_timeago' => 'ostatnio zaktualizowana :timeago',
            'ranked' => 'rankingowa od ',
            'approved' => 'zatwierdzona od ',
            'qualified' => 'zakwalifikowana od ',
            'loved' => 'ulubiona społeczności od ',
            'logged-out' => 'Zaloguj się, aby zacząć pobierać beatmapy!',
            'download' => [
                '_' => 'Pobierz',
                'video' => 'z wideo',
                'no-video' => 'bez wideo',
                'direct' => 'osu!direct',
            ],
            'favourite' => 'Dodaj do ulubionych',
            'unfavourite' => 'Usuń z ulubionych',
            'favourited_count' => '+ 1 inna!|+ :count inne!|+ :count innych!',
        ],
        'stats' => [
            'cs' => 'Wielkość kółek',
            'cs-mania' => 'Liczba klawiszy',
            'drain' => 'Spadek HP',
            'accuracy' => 'Precyzja',
            'ar' => 'Prędkość otoczki',
            'stars' => 'Trudność',
            'total_length' => 'Długość',
            'bpm' => 'BPM',
            'count_circles' => 'Liczba kółek',
            'count_sliders' => 'Liczba sliderów',
            'user-rating' => 'Oceny użytkowników',
            'rating-spread' => 'Wykres ocen',
            'nominations' => 'Nominacje',
            'playcount' => 'Liczba zagrań',
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
                'accuracy' => 'Precyzja',
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
    ],
];

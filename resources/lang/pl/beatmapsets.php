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
    'show' => [
        'details' => [
            'made-by' => 'stworzony przez ',
            'submitted' => 'dodana ',
            'ranked' => 'rankingowa od ',
            'logged-out' => 'Musisz się zalogować, aby pobierać beatmapy!',
            'download' => [
                '_' => 'pobierz',
                'video' => 'z wideo',
                'no-video' => 'bez wideo',
                'direct' => 'osu!direct',
            ],
        ],
        'stats' => [
            //this is left intentionally in english, you can't translate these so it sounds normal
            'cs' => 'Circle Size',
            'cs-mania' => 'Key Amount',
            'drain' => 'HP Drain',
            'accuracy' => 'Accuracy',
            'ar' => 'Approach Rate',
            'stars' => 'Trudność',
            'total_length' => 'Długość',
            'bpm' => 'BPM',
            'count_circles' => 'Ilość kółek',
            'count_sliders' => 'Ilość sliderów',
        ],
        'info' => [
            'success-rate' => 'Wskaźnik sukcesu',
            'points-of-failure' => 'Wykres',

            'description' => 'Opis',

            'source' => 'Źródło',
            'tags' => 'Tagi',
        ],
        'scoreboard' => [
            'achieved' => 'osiągnięty :when',
            'country' => 'Ranking krajowy',
            'friend' => 'Ranking znajomych',
            'global' => 'Ranking globalny',
            'supporter-link' => 'Kliknij <a href=":link">tutaj</a>, aby zobaczyć, co jeszcze otrzymujesz w zamian za bycie supporterem!',
            'supporter-only' => 'Musisz być supporterem, aby uzyskać dostęp do rankingu krajowego i znajomych!',
            'title' => 'Tablica wyników',

            'list' => [
                'accuracy' => 'Celność',
                'player-header' => 'Gracz',
                'rank-header' => 'Miejsce',
                'score' => 'Wynik',
            ],
            'no_scores' => [
                'country' => 'Nikt z twojego kraju nie ustanowił tutaj wyniku!',
                'friend' => 'Żaden z twoich znajomych nie ma tutaj wyniku!',
                'global' => 'Brak wyników. Może powinieneś jakieś zdobyć?',
                'loading' => 'Ładowanie wyników...',
            ],
            'stats' => [
                'accuracy' => 'Celność',
                'score' => 'Wynik',
            ],
        ],
    ],
];

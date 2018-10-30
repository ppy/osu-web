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
    'header' => [
        'small' => 'Състезавайте се по повече начини освен да кликате на кръгчета.',
        'large' => 'Обществени конкурси',
    ],
    'voting' => [
        'over' => 'Гласуването за този конкурс е приключилo',
        'login_required' => 'Моля влезте в профила си, за да гласувате.',
        'best_of' => [
            'none_played' => "Изглежда не сте играли никои от бийтмаповете, които са определени за този конкурс!",
        ],
    ],
    'entry' => [
        '_' => 'запис',
        'login_required' => 'Моля влезте в профила си, за да се запишете за този конкурс.',
        'silenced_or_restricted' => 'Не можете да се запишете за конкурси докато сте с ограничен статут или заглушени.',
        'preparation' => 'Вмомента подготвяме този конкурс. Моля бъдете търпеливи!',
        'over' => 'Благодарим Ви за участието! Записването затвори за този конкурс и гласуването ще започне скоро.',
        'limit_reached' => 'Достигнахте ограничението на записи за този конкурс',
        'drop_here' => 'Пуснете вашия файл тук',
        'wrong_type' => [
            'art' => 'Само файлове с .jpg или .png формат се приемат за този конкурс.',
            'beatmap' => 'Само файл с .osu формат се приема за този конкурс.',
            'music' => 'Само файл с .mp3 формат се приема за този конкурс.',
        ],
        'too_big' => 'Записите за този конкурс могат да са до :limit пъти.',
    ],
    'beatmaps' => [
        'download' => 'Изтегляне на запис',
    ],
    'vote' => [
        'list' => 'гласове',
        'count' => '1 глас |:count гласа',
    ],
    'dates' => [
        'ended' => 'Завърши на :date',

        'starts' => [
            '_' => 'Започва на :date',
            'soon' => 'скоро™',
        ],
    ],
    'states' => [
        'entry' => 'Отворено записване',
        'voting' => 'Гласуването започна',
        'results' => 'Резултатите са обявени',
    ],
];

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
        'disabled' => 'Този бийтмап вмомента не може да бъде итеглен.',
        'parts-removed' => 'Части от този бийтмап са премахнати по искане на създателя или притежателя на авторските права.',
        'more-info' => 'Щракнете тук за още информация.',
    ],

    'index' => [
        'title' => 'Списък с бийтмапове',
        'guest_title' => 'Бийтмапове',
    ],

    'show' => [
        'discussion' => 'Дискусия',

        'details' => [
            'mapped_by' => 'съпоставено от :mapper',
            'submitted' => 'публикуван на ',
            'updated' => 'последно актуализиран на ',
            'updated_timeago' => 'последно актуализиран :timeago',
            'ranked' => 'класиран на ',
            'approved' => 'одобрен на ',
            'qualified' => 'квалифициран на ',
            'loved' => 'обичан на ',
            'logged-out' => 'Трябва да сте влезли в акаунта си преди да е възможно да теглите бийтмапове!',
            'download' => [
                '_' => 'Изтегли',
                'video' => 'с видео',
                'no-video' => 'без видео',
                'direct' => '',
            ],
            'favourite' => 'Харесай този бийтмап сет',
            'unfavourite' => 'Премахни от харесани бийтмап сетове',
            'favourited_count' => '+ 1 друг!|+ :count други!',
        ],
        'stats' => [
            'cs' => 'Големина на кръгчетата',
            'cs-mania' => 'Брой клавиши',
            'drain' => 'HP Изтощаване',
            'accuracy' => 'Прецизност',
            'ar' => 'Скорост на наближаване',
            'stars' => 'Трудност',
            'total_length' => 'Продължителност',
            'bpm' => 'BPM',
            'count_circles' => 'Брой кръгчета',
            'count_sliders' => 'Брой слайдери',
            'user-rating' => 'Потребителски рейтинг',
            'rating-spread' => 'Разпределение на рейтинга',
            'nominations' => 'Номинации',
            'playcount' => 'Брой игри',
        ],
        'info' => [
            'description' => 'Описание',
            'genre' => 'Жанр',
            'language' => 'Език',
            'no_scores' => 'Информацията все още се обработва...',
            'points-of-failure' => 'Връхни точки на провал',
            'source' => 'Източник',
            'success-rate' => 'Степен на успех (%)',
            'tags' => 'Тагове',
            'unranked' => 'Некласиран бийтмап',
        ],
        'scoreboard' => [
            'achieved' => 'постигнато на :when',
            'country' => 'Държавно класиране',
            'friend' => 'Приятелско класиране',
            'global' => 'Глобално класиране',
            'supporter-link' => 'Щракнете <a href=":link">тук</a>, за да видите всички хубави екстри, които получаваш!',
            'supporter-only' => 'Трябва да сте osu!supporter, за да имате достъп до държавното и приятелско класиране!',
            'title' => 'Табло за точки',

            'headers' => [
                'accuracy' => 'Прецизност',
                'combo' => 'Макс комбо',
                'miss' => 'Пропуски',
                'mods' => 'Модове',
                'player' => 'Играч',
                'pp' => '',
                'rank' => 'Ранк',
                'score_total' => 'Общ брой точки',
                'score' => 'Точки',
            ],

            'no_scores' => [
                'country' => 'Никой от твоята държава не е играл тази карта все още!',
                'friend' => 'Никой от твоите приятели не е играл тази карта все още!',
                'global' => 'Все още няма резултати. Може би се пробвайте да зададете няколко?',
                'loading' => 'Зареждане на резултатите...',
                'unranked' => 'Некласиран бийтмап.',
            ],
            'score' => [
                'first' => 'Начело',
                'own' => 'Твоят най-добър',
            ],
        ],
    ],
];

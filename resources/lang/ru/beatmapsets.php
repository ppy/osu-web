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
    'availability' => [
        'disabled' => 'Данная карта временно недоступна для загрузки.',
        'parts-removed' => 'Некоторые части этой карты были удалены по просьбе создателя или сторонних правообладателей.',
        'more-info' => 'Для подробностей нажми сюда.',
    ],

    'index' => [
        'title' => 'Список карт',
        'guest_title' => 'Карты',
    ],

    'show' => [
        'discussion' => 'Обсуждение',

        'details' => [
            'made-by' => 'карту сделал ',
            'submitted' => 'опубликован ',
            'updated' => 'в последний раз обновлён ',
            'ranked' => 'ранкнут ',
            'approved' => 'одобрен ',
            'qualified' => 'квалифицирован ', // TODO: нужен перевод лучше
            'loved' => 'любим ', // TODO: лол, нужен перевод лучше
            'logged-out' => 'Ты должен войти чтобы скачать эту карту!',
            'download' => [
                '_' => 'Скачать',
                'video' => 'с видео',
                'no-video' => 'без видео',
                'direct' => 'osu!direct',
            ],
            'favourite' => 'Добавить в избранное',
            'unfavourite' => 'Удалить из избранного',
        ],
        'stats' => [ // TODO: нужен перевод лучше, намного.
            'cs' => 'Размер нот',
            'cs-mania' => 'Количество клавиш',
            'drain' => 'HP Drain',
            'accuracy' => 'Точность',
            'ar' => 'Скорость подхода',
            'stars' => 'Сложность',
            'total_length' => 'Длительность',
            'bpm' => 'BPM',
            'count_circles' => 'Количество нот',
            'count_sliders' => 'Количетсво слайдеров',
            'user-rating' => 'Рейтинг пользователей',
            'rating-spread' => 'Шкала рейтинга',
        ],
        'info' => [
            'no_scores' => 'Рейтинг недоступен.',
            'points-of-failure' => 'Количество провалов',
            'success-rate' => 'Шанс успеха',

            'description' => 'Описание',

            'source' => 'Источник',
            'tags' => 'Теги',
        ],
        'scoreboard' => [
            'achieved' => 'достигнут :when',
            'country' => 'Рейтинг стран',
            'friend' => 'Рейтинг друзей',
            'global' => 'Глобальный рейтинг',
            'supporter-link' => 'Нажми <a href=":link">сюда</a> для просмотра всех плюшек, которые ты получишь!',
            'supporter-only' => 'Ты должен быть саппортером чтобы разблокировать данную особенность!',
            'title' => 'Табло',

            'list' => [
                'accuracy' => 'Точность',
                'player-header' => 'Игрок',
                'rank-header' => 'Ранк',
                'score' => 'Очки',
            ],
            'no_scores' => [
                'country' => 'Ещё никто из твоей страны не установил свой результат на этой карте!',
                'friend' => 'Пока никто из твоих друзей не установил свой результат на этой карте!',
                'global' => 'Результаты пусты. Возможно, тебе стоит попробовать установить свой результат?',
                'loading' => 'Загрузка результатов...',
                'unranked' => 'Рейтинг недоступен.',
            ],
            'score' => [
                'first' => 'Лидирует',
                'own' => 'Твой лучший результат',
            ],
        ],
    ],
];

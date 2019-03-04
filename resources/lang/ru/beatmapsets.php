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
        'disabled' => 'Данная карта временно недоступна для загрузки.',
        'parts-removed' => 'Некоторые части этой карты были удалены по требованию автора или правообладателей.',
        'more-info' => 'Для подробностей нажми сюда.',
    ],

    'index' => [
        'title' => 'Библиотека карт',
        'guest_title' => 'Карты',
    ],

    'show' => [
        'discussion' => 'Обсуждение',

        'details' => [
            'approved' => 'одобрен ',
            'favourite' => 'Добавить в избранное',
            'favourited_count' => '+ 1 другой!|+ :count других!',
            'logged-out' => 'Вы должны войти для загрузки карты!',
            'loved' => 'избран ',
            'mapped_by' => 'сделана :mapper',
            'qualified' => 'квалифицирован ',
            'ranked' => 'ранкнут ',
            'submitted' => 'опубликован ',
            'unfavourite' => 'Удалить из избранного',
            'updated' => 'обновлён ',
            'updated_timeago' => 'обновлён :timeago',

            'download' => [
                '_' => 'Скачать',
                'direct' => 'osu!direct',
                'no-video' => 'без видео',
                'video' => 'с видео',
            ],

            'login_required' => [
                'bottom' => 'чтобы скачать',
                'top' => 'Войдите',
            ],
        ],

        'favourites' => [
            'limit_reached' => 'У вас слишком много любимых карт! Удалите некоторые из них и попробуйте снова.',
        ],

        'hype' => [
            'action' => 'Хайпаните эту карту если вам понравилось в неё играть чтобы помочь карте получить <strong>Ранкед</strong>.',

            'current' => [
                '_' => 'Эта карта сейчас :status.',

                'status' => [
                    'pending' => 'на рассмотрении',
                    'qualified' => 'квалифицирована',
                    'wip' => 'работа в процессе',
                ],
            ],
        ],

        'info' => [
            'description' => 'Описание',
            'genre' => 'Жанр',
            'language' => 'Язык',
            'no_scores' => 'Данные всё ещё обрабатываются...',
            'points-of-failure' => 'Шкала провалов',
            'source' => 'Источник',
            'success-rate' => 'Шанс успеха',
            'tags' => 'Теги',
            'unranked' => 'Unranked карта',
        ],

        'scoreboard' => [
            'achieved' => 'достигнут :when',
            'country' => 'Рейтинг стран',
            'friend' => 'Рейтинг друзей',
            'global' => 'Глобальный рейтинг',
            'supporter-link' => 'Нажмите <a href=":link">сюда</a> для просмотра всех возможностей которые Вы получаете!',
            'supporter-only' => 'Вы должны иметь osu!supporter для использования данной возможности!',
            'title' => 'Табло',

            'headers' => [
                'accuracy' => 'Точность',
                'combo' => 'Максимальное комбо',
                'miss' => 'Промах',
                'mods' => 'Моды',
                'player' => 'Игрок',
                'pp' => 'pp',
                'rank' => 'Ранг',
                'score_total' => 'Всего очков',
                'score' => 'Очки',
            ],

            'no_scores' => [
                'country' => 'Никто из вашей страны ещё не играл в эту карту!',
                'friend' => 'Никто из ваших друзей ещё не играл в эту карту!',
                'global' => 'Никто ещё не играл в эту карту! Может быть вы попробуете?',
                'loading' => 'Результаты загружаются...',
                'unranked' => 'Unranked карта.',
            ],
            'score' => [
                'first' => 'Лидирует',
                'own' => 'Ваш рекорд',
            ],
        ],

        'stats' => [
            'cs' => 'Размер нот',
            'cs-mania' => 'Количество нот',
            'drain' => 'Потеря HP',
            'accuracy' => 'Точность',
            'ar' => 'Скорость подхода',
            'stars' => 'Сложность',
            'total_length' => 'Длительность',
            'bpm' => 'BPM',
            'count_circles' => 'Количество нот',
            'count_sliders' => 'Количество слайдеров',
            'user-rating' => 'Рейтинг пользователей',
            'rating-spread' => 'Шкала рейтинга',
            'nominations' => 'Номинации',
            'playcount' => 'Количество игр',
        ],
    ],
];

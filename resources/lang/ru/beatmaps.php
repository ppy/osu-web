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
            'error' => 'Не удалось сохранить пост',
        ],
    ],

    'discussion-votes' => [
        'update' => [
            'error' => 'Не удалось изменить ответ',
        ],
    ],

    'discussions' => [
        'allow_kudosu' => 'разрешить kudosu',
        'delete' => 'удалить',
        'deleted' => 'Удалено :editor в :delete_time',
        'deny_kudosu' => 'запретить kudosu',
        'edit' => 'изменить',
        'edited' => 'Последний раз отредактировал :editor в :update_time',
        'message_placeholder' => 'Введите ответ сюда',
        'message_type_select' => 'Выберите Тип Сообщения',
        'reply_placeholder' => 'Введите ответ сюда',
        'require-login' => 'Пожалуйста, войдите чтобы ответить',
        'resolved' => 'Решено',
        'restore' => 'восстановить',
        'title' => 'Обсуждения',
    ],

    'beatmapset' => [
        'show' => [
            'details' => [
                'made-by' => 'создал',
                'submitted' => 'submitted в ',
                'updated' => 'обновлено в последний раз в ',
                'ranked' => 'ranked в ',
                'approved' => 'approved в ',
                'qualified' => 'qualified в ',
                'loved' => 'loved в ',
                'logged-out' => 'Вам необходимо авторизироваться для загрузки карт!',
                'download' => [
                    '_' => 'Скачать',
                    'video' => 'с Видео',
                    'no-video' => 'без Видео',
                ],
                'favourite' => 'Добавить в избранные',
                'unfavourite' => 'Удалить из избранных',
            ],
            'stats' => [
                'cs' => 'Circle Size',
                'cs-mania' => 'Key Amount',
                'drain' => 'HP Drain',
                'accuracy' => 'Accuracy',
                'ar' => 'Approach Rate',
                'stars' => 'Star Difficulty',
                'total_length' => 'Length',
                'bpm' => 'BPM',
                'count_circles' => 'Circle Count',
                'count_sliders' => 'Slider Count',
                'user-rating' => 'User Rating',
                'rating-spread' => 'Rating Spread',
            ],
            'info' => [
                'description' => 'Описание',

                'source' => 'Источник',
                'tags' => 'Теги',
            ],
            'scoreboard' => [
                'achieved' => 'архивировано в :when',
                'country' => 'Рейтинг Страны',
                'friend' => 'Рейтинг Друзей',
                'global' => 'Мировой Рейтинг',

                'list' => [
                    'accuracy' => 'Точность',
                    'player-header' => 'Игрок',
                    'rank-header' => 'Ранк',
                    'score' => 'Очки',
                ],
                'stats' => [
                    'accuracy' => 'Точность',
                    'score' => 'Очки',
                ],
            ],
        ],
    ],
    'mode' => [
        'any' => 'Все',
    ],
    'status' => [
        'any' => 'Все',
        'ranked-approved' => 'Ранкнутые & Одобренные',
        'approved' => 'Одобренные',
        'faves' => 'Избранные',
        'pending' => 'Ожидающие',
        'my-maps' => 'Мои Карты',
    ],
    'genre' => [
        'any' => 'Любой',
        'unspecified' => 'Неопределенный',
        'video-game' => 'Видео Игры',
        'anime' => 'Аниме',
        'rock' => 'Рок',
        'pop' => 'Поп',
        'other' => 'Другие',
        'novelty' => 'Новинки',
        'hip-hop' => 'Хип Хоп',
        'electronic' => 'Электронный',
    ],
    'language' => [
        'any' => 'Любой',
        'english' => 'Английский',
        'chinese' => 'Китайский',
        'french' => 'Французский',
        'german' => 'Немецкий',
        'italian' => 'Итальянский',
        'japanese' => 'Японский',
        'korean' => 'Корейский',
        'spanish' => 'Испанский',
        'swedish' => 'Шведский',
        'instrumental' => 'Инструментальный',
        'other' => 'Другий',
    ],
    'extra' => [
        'video' => 'Имеет Видео',
        'storyboard' => 'Имеет Раскадровку',
    ],
    'rank' => [
        'any' => 'Любые',
        'XH' => 'Серебрянный SS',
        'SH' => 'Серебрянный S',
    ],
];

<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
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
            'logged-out' => 'Вы должны войти для загрузки карты!',
            'loved' => 'избран ',
            'mapped_by' => 'сделана :mapper',
            'qualified' => 'квалифицирована ',
            'ranked' => 'получила рейтинг ',
            'submitted' => 'опубликована ',
            'unfavourite' => 'Удалить из избранного',
            'updated' => 'обновлена ',
            'updated_timeago' => 'обновлена :timeago',

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
            'action' => 'Хайпаните эту карту если вам понравилось в неё играть, чтобы помочь ей стать <strong>Рейтинговой</strong>.',

            'current' => [
                '_' => 'Эта карта сейчас :status.',

                'status' => [
                    'pending' => 'на рассмотрении',
                    'qualified' => 'квалифицирована',
                    'wip' => 'работа в процессе',
                ],
            ],

            'report' => [
                '_' => '',
                'button' => '',
                'button_title' => '',
                'link' => '',
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
            'unranked' => 'Безрейтинговая карта',
        ],

        'scoreboard' => [
            'achieved' => 'достигнут :when',
            'country' => 'Рейтинг по стране',
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
            'cs-mania' => 'Количество клавиш',
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

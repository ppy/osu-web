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
            'favourite' => 'Добавить в избранное',
            'logged-out' => 'Вы должны войти для загрузки карты!',
            'mapped_by' => 'сделана :mapper',
            'unfavourite' => 'Удалить из избранного',
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
            'limit_reached' => 'У вас слишком много избранных карт! Пожалуйста, удалите некоторые из них из избранных и попробуйте снова.',
        ],

        'hype' => [
            'action' => 'Хайпаните эту карту, если Вам понравилось в неё играть, чтобы помочь ей стать <strong>Рейтинговой</strong>.',

            'current' => [
                '_' => 'Эта карта сейчас :status.',

                'status' => [
                    'pending' => 'на рассмотрении',
                    'qualified' => 'квалифицирована',
                    'wip' => 'в разработке',
                ],
            ],

            'disqualify' => [
                '_' => 'Если Вы обнаружили проблему у этой карты, пожалуйста, дисквалифицируйте её :link.',
                'button_title' => 'Дисквалифицировать квалифицированную карту.',
            ],

            'report' => [
                '_' => 'Если вы обнаружили проблему, связанную с этой картой, пожалуйста, сообщите об этом :link, чтобы оповестить команду osu!.',
                'button' => 'Сообщить о проблеме',
                'button_title' => 'Сообщить о проблеме с квалифицированной картой.',
                'link' => 'здесь',
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
            'friend' => 'Рейтинг среди друзей',
            'global' => 'Глобальный рейтинг',
            'supporter-link' => 'Нажмите <a href=":link">сюда</a> для просмотра всех возможностей, что Вы можете получить!',
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
                'unranked' => 'Безрейтинговая карта.',
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
            'total_length' => 'Длительность (длительность дренажа: :hit_length)',
            'bpm' => 'BPM',
            'count_circles' => 'Количество нот',
            'count_sliders' => 'Количество слайдеров',
            'user-rating' => 'Оценки пользователей',
            'rating-spread' => 'Шкала оценок',
            'nominations' => 'Номинации',
            'playcount' => 'Количество игр',
        ],

        'status' => [
            'ranked' => 'Рейтинговая',
            'approved' => 'Одобренная',
            'loved' => 'Любимая',
            'qualified' => 'Квалифицированная',
            'wip' => 'В разработке',
            'pending' => 'Ожидающая',
            'graveyard' => 'Заброшенная',
        ],
    ],
];

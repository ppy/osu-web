<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

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

    'panel' => [
        'download' => [
            'all' => 'скачать',
            'video' => 'скачать с видео',
            'no_video' => 'скачать без видео',
            'direct' => 'открыть в osu!direct',
        ],
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

        'details_date' => [
            'approved' => 'одобрена :timeago',
            'loved' => 'стала любимой :timeago',
            'qualified' => 'квалифицирована :timeago',
            'ranked' => 'стала рейтинговой :timeago',
            'submitted' => 'загружена :timeago',
            'updated' => 'обновлена :timeago',
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
            ],

            'report' => [
                '_' => 'Если вы обнаружили проблему, связанную с этой картой, пожалуйста, сообщите об этом :link, чтобы оповестить команду osu!.',
                'button' => 'Сообщить о проблеме',
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
                'time' => 'Время',
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

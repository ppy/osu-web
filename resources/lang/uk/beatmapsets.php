<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'availability' => [
        'disabled' => 'Ця карта тимчасово недоступна для завантаження.',
        'parts-removed' => 'Деякі частини цієї карти були видалені на вимогу учасника або правовласників.',
        'more-info' => 'Натисніть тут для отримання більш детальної інформації.',
        'rule_violation' => '',
    ],

    'download' => [
        'limit_exceeded' => '',
    ],

    'index' => [
        'title' => 'Бібліотека карт',
        'guest_title' => 'Карти',
    ],

    'panel' => [
        'empty' => '',

        'download' => [
            'all' => 'завантажити',
            'video' => 'завантажити з вiдео',
            'no_video' => 'завантажити без вiдео',
            'direct' => 'відкрити в osu!direct',
        ],
    ],

    'nominate' => [
        'hybrid_requires_modes' => '',
        'incorrect_mode' => '',
        'full_bn_required' => '',
        'too_many' => '',

        'dialog' => [
            'confirmation' => '',
            'header' => '',
            'hybrid_warning' => '',
            'which_modes' => '',
        ],
    ],

    'nsfw_badge' => [
        'label' => '',
    ],

    'show' => [
        'discussion' => 'Обговорення',

        'details' => [
            'favourite' => 'Додати в обране',
            'logged-out' => 'Ви повинні увійти для завантаження карти!',
            'mapped_by' => 'створена :mapper',
            'unfavourite' => 'Видалити з Обраного',
            'updated_timeago' => 'оновлена :timeago',

            'download' => [
                '_' => 'Завантажити',
                'direct' => '',
                'no-video' => 'без відео',
                'video' => 'з відео',
            ],

            'login_required' => [
                'bottom' => 'щоб завантажити',
                'top' => 'Увійдіть',
            ],
        ],

        'details_date' => [
            'approved' => 'затверджено :timeago',
            'loved' => 'улюблена :timeago',
            'qualified' => 'кваліфікована :timeago',
            'ranked' => 'рейтингова :timeago',
            'submitted' => 'завантажена :timeago',
            'updated' => 'оновлена :timeago',
        ],

        'favourites' => [
            'limit_reached' => 'У вас занадто багато обраних карт! Видаліть деякі з них і спробуйте знову.',
        ],

        'hype' => [
            'action' => 'Хайпніть цю карту якщо вам сподобалося в неї грати щоб допомогти їй отримати статус<strong>Рангової</strong>.',

            'current' => [
                '_' => 'Ця карта зараз :status.',

                'status' => [
                    'pending' => 'на розгляді',
                    'qualified' => 'кваліфікована',
                    'wip' => 'робота в процесі',
                ],
            ],

            'disqualify' => [
                '_' => 'Якщо ви знайшли проблему в цій карті, будь ласка, позбавите її кваліфікації :link.',
            ],

            'report' => [
                '_' => 'Якщо ви знайшли проблему в цій карті, повідомте про це :link щоб наша команда дізналася.',
                'button' => 'Повідомити про проблему',
                'link' => 'тут',
            ],
        ],

        'info' => [
            'description' => 'Опис',
            'genre' => 'Жанр',
            'language' => 'Мова',
            'no_scores' => 'Дані все ще обробляються...',
            'nsfw' => '',
            'points-of-failure' => 'Шкала провалів',
            'source' => 'Джерело',
            'success-rate' => 'Шанс успіху',
            'tags' => 'Теги',
        ],

        'nsfw_warning' => [
            'details' => '',
            'title' => '',

            'buttons' => [
                'disable' => '',
                'listing' => '',
                'show' => '',
            ],
        ],

        'scoreboard' => [
            'achieved' => 'досягнуто :when',
            'country' => 'Рейтинг країн',
            'friend' => 'Рейтинг серед друзів',
            'global' => 'Рейтинг в світі',
            'supporter-link' => 'Натисніть <a href=":link">сюди</a> для перегляду всіх можливостей які ви отримаєте!',
            'supporter-only' => 'Ви повинні мати osu!прихильник для використання даної можливості!',
            'title' => 'Табло',

            'headers' => [
                'accuracy' => 'Точність',
                'combo' => 'Максимальне комбо',
                'miss' => 'Промахи',
                'mods' => 'Модифікатори',
                'player' => 'Гравець',
                'pp' => '',
                'rank' => 'Ранг',
                'score_total' => 'Всього очок',
                'score' => 'Очки',
                'time' => 'Час',
            ],

            'no_scores' => [
                'country' => 'Ніхто з вашої країни ще не грав на цій карті!',
                'friend' => 'Ніхто з ваших друзів ще не грав на цій карті!',
                'global' => 'Ніхто ще не грав на цій карті! Може бути ви спробуєте?',
                'loading' => 'Результати завантажуються...',
                'unranked' => 'Нерангова карта.',
            ],
            'score' => [
                'first' => 'Лідирує',
                'own' => 'Ваш рекорд',
            ],
        ],

        'stats' => [
            'cs' => 'Розмір нот',
            'cs-mania' => 'Кількість нот',
            'drain' => 'Втрата HP',
            'accuracy' => 'Точність',
            'ar' => 'Швидкість проходження',
            'stars' => 'Складність',
            'total_length' => 'Тривалість',
            'bpm' => 'BPM',
            'count_circles' => 'Кількість нот',
            'count_sliders' => 'Кількість слайдерів',
            'user-rating' => 'Рейтинг користувачів',
            'rating-spread' => 'Шкала рейтингу',
            'nominations' => 'Номінації',
            'playcount' => 'Кількість ігор',
        ],

        'status' => [
            'ranked' => 'Ранкнуті',
            'approved' => 'Схвалені',
            'loved' => 'Улюблені',
            'qualified' => 'Кваліфіковані',
            'wip' => 'В процесі створення',
            'pending' => 'На розгляді',
            'graveyard' => 'Закинуті',
        ],
    ],
];

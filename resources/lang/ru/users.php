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
    'deleted' => '[удалённый пользователь]',

    'login' => [
        '_' => 'Войти',
        'locked_ip' => 'Ваш IP адрес заблокирован. Попробуйте ещё раз через несколько минут.',
        'username' => 'Никнейм',
        'password' => 'Пароль',
        'button' => 'Войти',
        'remember' => 'Запомнить этот браузер',
        'title' => 'Пожалуйста войдите для продолжения',
        'failed' => 'Неверный никнейм',
        'register' => 'У Вас нет аккаунта в osu!? Создайте один',
        'forgot' => 'Забыли свой пароль?',
        'beta' => [
            'main' => 'Доступ к бета-версии ограничен.',
            'small' => '(саппортеры получат доступ позже)',
        ],

        'here' => 'тут', // this is substituted in when generating a link above. change it to suit the language.
    ],
    'signup' => [
        '_' => 'Регистрация',
    ],
    'anonymous' => [
        'login_link' => 'нажмите для входа',
        'username' => 'Гость',
        'error' => 'Вы должны быть авторизированным, чтобы сделать это.',
    ],
    'logout_confirm' => 'Вы действительно хотите выйти? :(',
    'show' => [
        '404' => 'Пользователь не найден! ;_;',
        'age' => ':age лет',
        'current_location' => 'Проживает в :location',
        'first_members' => 'Зарегистрирован тут с самого начала',
        'is_developer' => 'osu!developer',
        'is_supporter' => 'osu!supporter',
        'joined_at' => 'Зарегистрирован :date',
        'lastvisit' => 'Был в сети :date',
        'missingtext' => 'Возможно, Вы сделали опечатку! (или может пользователь забанен)',
        'origin_age' => ':age',
        'origin_country' => 'Из страны :country',
        'origin_country_age' => ':age из :country',
        'page_description' => 'osu! - Всё, что вы хотели знать про :username!',
        'plays_with' => 'Играет с :devices',
        'title' => 'Профиль :username',

        'edit' => [
            'cover' => [
                'button' => 'Сменить обложку профиля',
                'defaults_info' => 'Больше вариантов в недалёком будущем',
                'upload' => [
                    'broken_file' => 'Не удалось обработать изображение. Попробуйте ещё раз.',
                    'button' => 'Загрузить изображение',
                    'dropzone' => 'Отпустите тут для загрузки',
                    'dropzone_info' => 'Вы также можете перетащить сюда изображение для загрузки',
                    'restriction_info' => "Загрузка своих обложек доступна только для <a href='".osu_url('support-the-game')."' target='_blank'>osu!supporters</a>",
                    'size_info' => 'Размер обложки должна быть 2000x700',
                    'too_large' => 'Загруженное изображение слишком большое.',
                    'unsupported_format' => 'Неподдерживаемый формат.',
                ],
            ],
        ],
        'extra' => [
            'achievements' => [
                'title' => 'Достижения',
                'achieved-on' => 'Получено :date',
            ],
            'beatmaps' => [
                'title' => 'Карты',
            ],
            'historical' => [
                'empty' => 'Нет записей о производительности. :(',
                'most_played' => [
                    'count' => 'раз сыграно',
                    'title' => 'Наибольше сыгранные карты',
                ],
                'recent_plays' => [
                    'accuracy' => 'точность: :percentage',
                    'title' => 'Последние игры',
                ],
                'title' => 'Хронология',
            ],
            'kudosu' => [
                'available' => 'Кудосу доступно',
                'available_info' => "Kudosu can be traded for kudosu stars, which will help your beatmap get more attention. This is the number of kudosu you haven't traded in yet.",
                'recent_entries' => 'Последние переводы',
                'title' => 'Kudosu!',
                'total' => 'Всего кудосу накоплено',
                'total_info' => 'Based on how much of a contribution the user has made to beatmap moderation. See <a href="'.osu_url('user.kudosu').'">this page</a> for more information.',

                'entry' => [
                    'amount' => ':amount кудосу',
                    'empty' => "Этот пользователь не получал кудосу!",

                    'beatmap_discussion' => [
                        'allow_kudosu' => [
                            'give' => 'Получено :amount from kudosu deny repeal of modding post :post',
                        ],

                        'deny_kudosu' => [
                            'reset' => 'Denied :amount from modding post :post',
                        ],

                        'delete' => [
                            'reset' => 'Lost :amount from modding post deletion of :post',
                        ],

                        'restore' => [
                            'give' => 'Received :amount from modding post restoration of :post',
                        ],

                        'vote' => [
                            'give' => 'Received :amount from obtaining votes in modding post of :post',
                            'reset' => 'Lost :amount from losing votes in modding post of :post',
                        ],
                    ],

                    'forum_post' => [
                        'give' => 'Получено :amount от :giver за пост в :post',
                        'reset' => 'Kudosu reset by :giver for the post :post',
                        'revoke' => 'Denied kudosu by :giver for the post :post',
                    ],
                ],
            ],
            'me' => [
                'title' => 'me!',
            ],
            'medals' => [
                'empty' => "Этот пользователь ничего не получил. ;_;",
                'title' => 'Медали',
            ],
            'recent_activities' => [
                'title' => 'Последняя активность',
            ],
            'top_ranks' => [
                'best' => [
                    'title' => 'Лучшая производительность',
                ],
                'empty' => 'Никакой записи об удивительной производительности. :(',
                'first' => [
                    'title' => 'Первые места в рейтинге',
                ],
                'pp' => ':amountpp',
                'title' => 'Рейтинги',
                'weighted_pp' => 'взвешено: :pp (:percentage)',
            ],
            'beatmaps' => [
                'title' => 'Карты',
                'favourite' => [
                    'title' => 'Любимые карты (:count)',
                ],
                'ranked_and_approved' => [
                    'title' => 'Ранкнутые & одобренные карты (:count)',
                ],
                'none' => 'Ничего нет...',
            ],
        ],
        'page' => [
            'description' => '<strong>я!</strong> - это Ваше личное редактируемое пространство в Вашем профиле.',
            'edit_big' => 'Отредактируй меня!',
            'placeholder' => 'Вводите контент этой страницы',
            'restriction_info' => "Вы должны иметь тег <a href='".osu_url('support-the-game')."' target='_blank'>osu!саппортера</a> для разблокировки данной особенности.",
        ],
        'rank' => [
            'country' => 'Рейтинг страны для :mode',
            'global' => 'Глобальный рейтинг для :mode',
        ],
        'stats' => [
            'hit_accuracy' => 'Точность попаданий',
            'level' => 'Уровень :level',
            'maximum_combo' => 'Максимальное комбо',
            'play_count' => 'Количество игр',
            'ranked_score' => 'Рейтинговое очко',
            'replays_watched_by_others' => 'Реплеев просмотрено другими',
            'score_ranks' => 'Очко рейтинга',
            'total_hits' => 'Всего попаданий',
            'total_score' => 'Всего очков',
        ],
    ],
    'verify' => [
        'title' => 'Подтверждения аккаунта',
    ],
];

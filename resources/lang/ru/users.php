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
        'locked_ip' => 'Твой IP адрес заблокирован. Попробуйте ещё раз через несколько минут.',
        'username' => 'Никнейм',
        'password' => 'Пароль',
        'button' => 'Войти',
        'button_posting' => 'Входим...',
        'remember' => 'Запомнить этот браузер',
        'title' => 'Пожалуйста войди для продолжения',
        'failed' => 'Неверный никнейм',
        'register' => 'У тебя нет аккаунта в osu!? Создай один',
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
        'error' => 'Ты должен быть авторизированным, чтобы сделать это.',
    ],
    'logout_confirm' => 'Ты действительно хочешь выйти? :(',
    'show' => [
        '404' => 'Пользователь не найден! ;_;',
        'age' => ':age лет',
        'first_members' => 'Зарегистрирован тут с самого начала',
        'is_developer' => 'osu!разработчик',
        'is_supporter' => 'osu!саппортер',
        'joined_at' => 'Зарегистрирован :date',
        'lastvisit' => 'Был в сети :date',
        'missingtext' => 'Возможно, ты сделал опечатку! (или пользователь забанен)',
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
                    'broken_file' => 'Не удалось обработать изображение. Попробуй ещё раз.',
                    'button' => 'Загрузить изображение',
                    'dropzone' => 'Брось изображение сюда для загрузки',
                    'dropzone_info' => 'Ты также можешь перетащить изображение сюда для загрузки',
                    'restriction_info' => "Загрузка своих обложек доступна только для <a href='".route('store.products.show', 'supporter-tag')."' target='_blank'>osu! саппортеров</a>",
                    'size_info' => 'Размер обложки должна быть 2000x700',
                    'too_large' => 'Загруженное изображение слишком большое.',
                    'unsupported_format' => 'Неподдерживаемый формат.',
                ],
            ],
        ],
        'extra' => [
            'followers' => '{1} 1 подписчик|[2,3] :count подписчика|[5,*] :count подписчиков',
            'unranked' => 'Нет недавних игр',

            'achievements' => [
                'title' => 'Достижения',
                'achieved-on' => 'Получено :date',
            ],
            'beatmaps' => [
                'none' => 'Ничего нет...',
                'title' => 'Карты',

                'favourite' => [
                    'title' => 'Любимые карты (:count)',
                ],
                'ranked_and_approved' => [
                    'title' => 'Рейтинговые и одобренные карты (:count)',
                ],
            ],
            'historical' => [
                'empty' => 'Нет каких-либо записей. :(',
                'title' => 'Хронология',

                'most_played' => [
                    'count' => 'количество игр',
                    'title' => 'Наибольше сыгранные карты',
                ],
                'recent_plays' => [
                    'accuracy' => 'точность: :percentage',
                    'title' => 'Последние игры',
                ],
            ],
            'kudosu' => [
                'available' => 'Кудосу доступно',
                'available_info' => 'Кудосу могут быть использованы для обмена между другими авторами карт, которые в свою очередь помогут привлечь к Вашей карте больше внимания. Это количество Кудосу, которые Вы не задействовали.',
                'recent_entries' => 'Последние обмены',
                'title' => 'Кудосу!',
                'total' => 'Всего Кудосу накоплено',
                'total_info' => 'Исходя из того, сколько правок внёс пользователь во время модерации карт. Загляните <a href="'.osu_url('user.kudosu').'">сюда</a> для дополнительной информации.',

                'entry' => [
                    'amount' => ':amount Кудосу',
                    'empty' => 'Этот пользователь не обменивался Кудосу!',

                    'beatmap_discussion' => [
                        'allow_kudosu' => [
                            'give' => 'Получено :amount за ответ в :post',
                        ],

                        'deny_kudosu' => [
                            'reset' => 'Отнято :amount за ответ в :post',
                        ],

                        'delete' => [
                            'reset' => 'Потеряно :amount за удаление ответа в посте :post',
                        ],

                        'restore' => [
                            'give' => 'Получено :amount за восстановление ответа в посте :post',
                        ],

                        'vote' => [
                            'give' => 'Получено :amount за получение голосов в посте :post',
                            'reset' => 'Потеряно :amount за потерю голосов в посте :post',
                        ],
                    ],

                    'forum_post' => [
                        'give' => ':giver дал :amount за ответ в посте :post',
                        'revoke' => ':giver отнял Кудосу за ответ в посте :post',
                    ],
                ],
            ],
            'me' => [
                'title' => 'обо мне!',
            ],
            'medals' => [
                'empty' => 'Этот пользователь ничего не получил. ;_;',
                'title' => 'Медали',
            ],
            'recent_activity' => [
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
        ],
        'page' => [
            'description' => '<strong>обо мне!</strong> - это твоё личное редактируемое пространство в твоём профиле.',
            'edit_big' => 'Отредактируй меня!',
            'placeholder' => 'Введи контент этой страницы',
            'restriction_info' => "Ты должен иметь тег <a href='".route('store.products.show', 'supporter-tag')."' target='_blank'>osu!саппортера</a> для разблокировки данной особенности.",
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
            'ranked_score' => 'Рейтинговые очки',
            'replays_watched_by_others' => 'Реплеев просмотрено другими',
            'score_ranks' => 'Очко рейтинга',
            'total_hits' => 'Всего попаданий',
            'total_score' => 'Всего очков',
        ],
    ],
    'status' => [
        'online' => 'В сети',
        'offline' => 'Вне сети',
    ],
    'verify' => [
        'title' => 'Подтверждения аккаунта',
    ],
];

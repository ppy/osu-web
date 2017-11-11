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
        '_' => 'Вход',
        'locked_ip' => 'Ваш IP адрес заблокирован. Подождите несколько минут.',
        'username' => 'Имя пользователя',
        'password' => 'Пароль',
        'button' => 'Войти',
        'button_posting' => 'Входим...',
        'remember' => 'Запомнить это устройство',
        'title' => 'Войдите для продолжения',
        'failed' => 'Неверный логин',
        'register' => 'У Вас нет аккаунта в osu!? Создайте новый',
        'forgot' => 'Забыли свой пароль?',
        'beta' => [
            'main' => 'Доступ к тестируемым функциям временно доступен только привилегированным пользователям.', // idk where it's used
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
        'error' => 'Вы должны войти чтобы сделать это.',
    ],
    'logout_confirm' => 'Вы действительно хотите выйти? :(',
    'restricted_banner' => [
        'title' => 'Ваши права ограничены!', // or just "restricted", need help
        'message' => 'Это значит, что Вы не можете взаимодействовать с другими игроками, и Ваши результаты видны только Вам. Обычно это автоматизированный процесс и обычно длиться примерно 24 часа. Если Вы хотите обжаловать свою блокировку, обратитесь к <a href="mailto:accounts@ppy.sh">поддержке</a>', // help
    ],
    'show' => [
        '404' => 'Пользователь не найден! ;_;',
        'age' => ':age лет',
        'current_location' => 'Проживает в :location',
        'first_members' => 'Зарегистрирован с самого основания', // or just "here from beginning", need help
        'is_developer' => 'osu!разработчик',
        'is_supporter' => 'osu!саппортер',
        'joined_at' => 'Зарегистрирован :date',
        'lastvisit' => 'В последний раз замечен :date',
        'missingtext' => 'Возможно Вы ошиблись! (или пользователь забанен)',
        'origin_age' => ':age',
        'origin_country' => 'Из :country',
        'origin_country_age' => ':age из :country',
        'page_description' => 'osu! - Всё, что Вы хотели знать о :username!',
        'plays_with' => 'Играет с :devices',
        'title' => 'Профиль :username',

        'edit' => [
            'cover' => [
                'button' => 'Сменить обложку',
                'defaults_info' => 'Больше вариантов в недалёком будущем',
                'upload' => [
                    'broken_file' => 'Не удалось установить обложку. Проверьте загружаемое изображение и повторите попытку.',
                    'button' => 'Загрузить обложку',
                    'dropzone' => 'Бросьте тут для загрузки',
                    'dropzone_info' => 'Вы также можете перетащить изображение в это место',
                    'restriction_info' => "Загрузка доступна только для <a href='".route('store.products.show', 'supporter-tag')."' target='_blank'>osu!саппортеров</a>",
                    'size_info' => 'Разрешение изображения должно быть 2000x700',
                    'too_large' => 'Загружаемый файл слишком большой.',
                    'unsupported_format' => 'Неподдерживаемый формат.',
                ],
            ],
        ],
        'extra' => [
            'followers' => '{0} Нет подписчиков|{1} 1 подписчик|[2,4] :count подписчика|[5,*] :count подписчиков',
            'unranked' => 'Нет последних игр',

            'achievements' => [
                'title' => 'Достижения',
                'achieved-on' => 'Получен :date',
            ],
            'beatmaps' => [
                'title' => 'Карты',
            ],
            'historical' => [
                'empty' => 'Нет записей о производительности. :(',
                'most_played' => [
                    'count' => 'раз сыграно',
                    'title' => 'По количествам попыток',
                ],
                'recent_plays' => [
                    'accuracy' => 'точность: :percentage',
                    'title' => 'По последним играм (24 часа)',
                ],
                'title' => 'История',
            ],
            'kudosu' => [
                'available' => 'Кудосу доступно',
                'available_info' => 'Кудосу может быть использован для кудосу звёзд, которые помогут Вашей карте получить больше внимания. Это количество кудосу, которые не были использованы.', // help
                'recent_entries' => 'Последние переводы',
                'title' => 'Кудосу!',
                'total' => 'Всего кудосу заработано',
                'total_info' => 'Исходя из того, сколько пользователь приложил усилии для модерации карт. Откройте <a href="'.osu_url('user.kudosu').'">эту страницу</a> для дополнительной информации.', // help

                'entry' => [
                    'amount' => ':amount кудосу',
                    'empty' => 'Пользователь не получал Кудосу!',

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
                        'give' => 'Получено :amount от :giver за ответ в :post',
                        'reset' => 'Отнято кудосу :giver за ответ в :post',
                        'revoke' => 'Отнято кудосу :giver за ответ в :post',
                    ],
                ],
            ],
            'me' => [
                'title' => 'обо мне!', // or just "me", need help
            ],
            'medals' => [
                'empty' => 'Этот пользователь ничего не получал. ;_;',
                'title' => 'Медали',
            ],
            'recent_activities' => [
                'title' => 'Последняя активность',
            ],
            'top_ranks' => [
                'best' => [
                    'title' => 'Лучший результат',
                ],
                'empty' => 'Нет записей о лучшем результате. :(',
                'first' => [
                    'title' => 'Первые места',
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
                    'title' => 'Рейтинговые и одобренные карты (:count)',
                ],
                'none' => 'Ничего... нет.',
            ],
        ],
        'page' => [
            'description' => 'Это Ваше редактируемое пространство в Вашем профиле.',
            'edit_big' => 'Редактировать',
            'placeholder' => 'Вводите содержимое',
            'restriction_info' => "Вы должны быть <a href='".route('store.products.show', 'supporter-tag')."' target='_blank'>osu!саппортером</a> для разблокировки этой особенности.",
        ],
        'rank' => [
            'country' => 'Рейтинг стран для :mode',
            'global' => 'Глобальный рейтинг для :mode',
        ],
        'stats' => [
            'level' => 'Уровень :level',
            'ranked_score' => 'Рейтинговые очки',
            'hit_accuracy' => 'Точность попаданий',
            'play_count' => 'Количество игр',
            'total_score' => 'Всего очков',
            'total_hits' => 'Всего попаданий',
            'maximum_combo' => 'Максимальное комбо',
            'score_ranks' => 'Score Ranks', // idk where it's used
            'replays_watched_by_others' => 'Повторов просмотрено другими',
        ],
    ],
    'status' => [
        'online' => 'В сети',
        'offline' => 'Вне сети',
    ],
    'store' => [
        'saved' => 'Пользователь создан',
    ],
    'verify' => [
        'title' => 'Верификация аккаунта',
    ],
];

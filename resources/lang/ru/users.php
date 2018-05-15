<?php

/**
 *    Copyright 2015-2018 ppy Pty. Ltd.
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

    'beatmapset_activities' => [
        'title' => "",

        'discussions' => [
            'title_recent' => 'Недавно начатые дискуссии',
        ],

        'events' => [
            'title_recent' => 'Недавние события',
        ],

        'posts' => [
            'title_recent' => 'Недавние публикации',
        ],

        'votes_received' => [
            'title_most' => 'Самые популярные от (за 3 месяца)',
        ],

        'votes_made' => [
            'title_most' => 'Самые популярные (за 3 месяца)',
        ],
    ],

    'card' => [
        'loading' => 'Загрузка...',
        'send_message' => 'отправить сообщение',
    ],

    'login' => [
        '_' => 'Вход',
        'locked_ip' => 'Ваш IP адрес заблокирован. Попробуйте через несколько минут.',
        'username' => 'Никнейм',
        'password' => 'Пароль',
        'button' => 'Войти',
        'button_posting' => 'Входим...',
        'remember' => 'Запомнить этот браузер',
        'title' => 'Войдите для продолжения',
        'failed' => 'Неверный вход',
        'register' => "У вас всё ещё нет аккаунта в osu!? Создайте новый",
        'forgot' => 'Забыли свой пароль?',
        'beta' => [
            'main' => 'Доступ к бета-версии ограничен.',
            'small' => '(саппортеры получат доступ позже)',
        ],

        'here' => 'тут', // this is substituted in when generating a link above. change it to suit the language.
    ],

    'posts' => [
        'title' => 'публикации :username',
    ],

    'signup' => [
        '_' => 'Регистрация',
    ],
    'anonymous' => [
        'login_link' => 'нажмите для входа',
        'login_text' => 'войти',
        'username' => 'Гость',
        'error' => 'Вы должны войти чтобы сделать это.',
    ],
    'logout_confirm' => 'Вы точно хотите выйти? :(',
    'restricted_banner' => [
        'title' => 'Ваш аккаунт был ресктриктед!',
        'message' => 'Пока ваш аккаунт рестриктед, вы не сможете взаимодействовать с другими игроками и ваши результаты будут видны только вам. Обычно это результат автоматизированного процесса и, как правило, ограничение снимается в течении 24 часов. Если вы хотите обжаловать ваше ограничение, пожалуйста <a href="mailto:accounts@ppy.sh">свяжитесь с поддержкой</a>.',
    ],
    'show' => [
        'age' => ':age лет',
        'change_avatar' => 'сменить аватар!',
        'first_members' => 'Здесь с самого начала',
        'is_developer' => 'osu!developer',
        'is_supporter' => 'osu!supporter',
        'joined_at' => 'Присоединился :date',
        'lastvisit' => 'Заходил :date',
        'missingtext' => 'Возможно, вы сделали опечатку! (или игрок заблокирован)',
        'origin_age' => ':age',
        'origin_country_age' => ':age, из :country',
        'origin_country' => 'Из :country',
        'page_description' => 'osu! - Всё, что вы хотели знать о :username!',
        'previous_usernames' => 'также известен как',
        'plays_with' => 'Играет с :devices',
        'title' => "Профиль :username",

        'edit' => [
            'cover' => [
                'button' => 'Сменить обложку профиля',
                'defaults_info' => 'Больше вариантов в недалёком будущем',
                'upload' => [
                    'broken_file' => 'Не удалось обработать изображение. Попробуй ещё раз.',
                    'button' => 'Загрузить изображение',
                    'dropzone' => 'Брось изображение сюда для загрузки',
                    'dropzone_info' => 'Вы также можете перетащить изображение сюда для загрузки',
                    'restriction_info' => "Загрузка своих обложек доступна только для владельцев <a href='".route('store.products.show', 'supporter-tag')."' target='_blank'>osu!supporter</a>",
                    'size_info' => 'Размер обложки должна быть 2000x700',
                    'too_large' => 'Загруженное изображение слишком большое.',
                    'unsupported_format' => 'Неподдерживаемый формат.',
                ],
            ],

            'default_playmode' => [
                'is_default_tooltip' => 'режим игры по умолчанию',
                'set' => 'установить :mode как режим игры по умолчанию',
            ],
        ],

        'extra' => [
            'followers' => ':count подписчик|:count подписчика|:count подписчиков',
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
                'graveyard' => [
                    'title' => 'Заброшенные карты (:count)',
                ],
                'ranked_and_approved' => [
                    'title' => 'Ранкнутые и одобренные карты (:count)',
                ],
                'unranked' => [
                    'title' => 'Ожидающие проверки (:count)',
                ],
            ],
            'historical' => [
                'empty' => 'Нет каких-либо записей. :(',
                'title' => 'Хронология',

                'monthly_playcounts' => [
                    'title' => 'История игр',
                ],
                'most_played' => [
                    'count' => 'количество игр',
                    'title' => 'Наибольше сыгранные карты',
                ],
                'recent_plays' => [
                    'accuracy' => 'точность: :percentage',
                    'title' => 'Последние игры (24ч)',
                ],
                'replays_watched_counts' => [
                    'title' => 'История просмотров реплеев',
                ],
            ],
            'kudosu' => [
                'available' => 'Кудосу доступно',
                'available_info' => "Кудосу могут быть использованы для обмена между другими авторами карт, которые в свою очередь помогут привлечь к вашей карте больше внимания. Это количество кудосу, которые вы не использовали.",
                'recent_entries' => 'Последние обмены',
                'title' => 'Кудосу!',
                'total' => 'Всего кудосу накоплено',
                'total_info' => 'Исходя из того, сколько правок внёс пользователь во время модерации карт. Загляните <a href="'.osu_url('user.kudosu').'">сюда</a> для дополнительной информации.',

                'entry' => [
                    'amount' => ':amount кудосу',
                    'empty' => "Этот пользователь не обменивался кудосу!",

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

                        'recalculate' => [
                            'give' => 'Получено :amount за перерасчёт голосов в посте :post',
                            'reset' => 'Потеряно :amount за перерасчёт голосов в посте :post',
                        ],
                    ],

                    'forum_post' => [
                        'give' => ':giver дал :amount за ответ в посте :post',
                        'reset' => ':giver сбросил кудосу за ответ в посте :post',
                        'revoke' => ':giver отнял кудосу за ответ в посте :post',
                    ],
                ],
            ],
            'me' => [
                'title' => 'обо мне!',
            ],
            'medals' => [
                'empty' => "Этот пользователь ничего не получил. ;_;",
                'title' => 'Медали',
            ],
            'recent_activity' => [
                'title' => 'Последняя активность',
            ],
            'top_ranks' => [
                'empty' => 'Никакой записи об удивительной производительности. :(',
                'not_ranked' => 'Очки производительности выдаются только за ранкнутые карты.',
                'pp' => ':amountpp',
                'title' => 'Рейтинги',
                'weighted_pp' => 'взвешено: :pp (:percentage)',

                'best' => [
                    'title' => 'Лучшая производительность',
                ],
                'first' => [
                    'title' => 'Первые места в рейтинге',
                ],
            ],
            'account_standing' => [
                'title' => 'Состояние аккаунта',
                'bad_standing' => "с аккаунтом <strong>:username</strong> не всё хорошо :(",
                'remaining_silence' => 'пользователю <strong>:username</strong> можно будет говорить через :duration.',

                'recent_infringements' => [
                    'title' => 'Недавние нарушения',
                    'date' => 'Дата',
                    'action' => 'действие',
                    'length' => 'продолжительность',
                    'length_permanent' => 'Навсегда',
                    'description' => 'описание',
                    'actor' => ':username',

                    'actions' => [
                        'restriction' => 'Рестриктед',
                        'silence' => 'Сайленс',
                        'note' => 'Заметка',
                    ],
                ],
            ],
        ],
        'info' => [
            'discord' => 'Discord',
            'interests' => 'Интересы',
            'lastfm' => 'Last.fm',
            'location' => 'Текущее местоположение',
            'occupation' => 'Род деятельности',
            'skype' => 'Skype',
            'twitter' => 'Twitter',
            'website' => 'Веб-сайт',
        ],
        'not_found' => [
            'reason_1' => '',
            'reason_2' => '',
            'reason_3' => '',
            'reason_header' => '',
            'title' => 'Игрок не найден! ;_;',
        ],
        'page' => [
            'description' => '<strong>обо мне!</strong> - это ваше личное редактируемое пространство в профиле.',
            'edit_big' => 'Отредактируйте меня!',
            'placeholder' => 'Введите контент этой страницы',
            'restriction_info' => "Вы должны иметь <a href='".route('store.products.show', 'supporter-tag')."' target='_blank'>osu!supporter</a> для разблокировки данной возможности.",
        ],
        'post_count' => [
            '_' => 'Написал :link',
            'count' => ':count постов|:count постов',
        ],
        'rank' => [
            'country' => 'Рейтинг стран для :mode',
            'global' => 'Глобальный рейтинг для :mode',
        ],
        'stats' => [
            'hit_accuracy' => 'Точность попаданий',
            'level' => 'Уровень :level',
            'maximum_combo' => 'Максимальное комбо',
            'play_count' => 'Количество игр',
            'play_time' => 'Всего времени в игре',
            'ranked_score' => 'Рейтинговые очки',
            'replays_watched_by_others' => 'Реплеев просмотрено другими',
            'score_ranks' => 'Рейтинг по очкам',
            'total_hits' => 'Всего попаданий',
            'total_score' => 'Всего очков',
        ],
    ],
    'status' => [
        'online' => 'В сети',
        'offline' => 'Не в сети',
    ],
    'store' => [
        'saved' => 'Пользователь создан',
    ],
    'verify' => [
        'title' => 'Подтверждения аккаунта',
    ],
];

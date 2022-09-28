<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'deleted' => '[удалённый пользователь]',

    'beatmapset_activities' => [
        'title' => "История моддинга :user",
        'title_compact' => 'Моддинг',

        'discussions' => [
            'title_recent' => 'Недавно начатые обсуждения',
        ],

        'events' => [
            'title_recent' => 'Недавние события',
        ],

        'posts' => [
            'title_recent' => 'Недавние посты',
        ],

        'votes_received' => [
            'title_most' => 'Самые популярные от (за 3 месяца)',
        ],

        'votes_made' => [
            'title_most' => 'Самые популярные (за 3 месяца)',
        ],
    ],

    'blocks' => [
        'banner_text' => 'Вы заблокировали этого пользователя.',
        'comment_text' => 'Этот комментарий скрыт.',
        'blocked_count' => 'чёрный список (:count)',
        'hide_profile' => 'Скрыть профиль',
        'hide_comment' => 'скрыть',
        'not_blocked' => 'Этот пользователь не заблокирован.',
        'show_profile' => 'Показать профиль',
        'show_comment' => 'показать',
        'too_many' => 'Достигнут лимит количества заблокированных.',
        'button' => [
            'block' => 'Заблокировать',
            'unblock' => 'Разблокировать',
        ],
    ],

    'card' => [
        'loading' => 'Загрузка...',
        'send_message' => 'Отправить сообщение',
    ],

    'disabled' => [
        'title' => 'О нет! Похоже, ваш аккаунт был отключен.',
        'warning' => "В случае, если вы нарушили правила, то как минимум месяц ваши попытки обжаловать блокировку рассматриваться не будут. По истечении этого месяца Вы сможете связаться с нами, если посчитаете необходимым. Учтите, что создание новых аккаунтов во обход блокировки лишь <strong>продлит Ваш период блокировки</strong>, в который вы не сможете восстановить свой аккаунт. Вдобавок, <strong>создание мульти-аккаунтов запрещено правилами</strong>, поэтому советуем вам этого не делать!",

        'if_mistake' => [
            '_' => 'Если вы считаете, что это ошибка, то можете связаться с нами (по :email, или нажав на «?» в нижнем правом углу страницы). Пожалуйста, учтите, что мы всегда уверены в своих действиях, так как они основаны на надёжных данных. Мы оставляем за собой право игнорировать ваши жалобы, если посчитаем, что вы ведёте себя недобросовестно.',
            'email' => 'электронной почте',
        ],

        'reasons' => [
            'compromised' => 'Возможно, ваш аккаунт был скомпрометирован. Он может быть временно отключен, пока личность владельца подтверждается.',
            'opening' => 'Есть ряд причин, которые могут привести к отключению вашего аккаунта:',

            'tos' => [
                '_' => 'Вы нарушили одно или больше из :community_rules или :tos.',
                'community_rules' => 'правил сообщества',
                'tos' => 'условий использования',
            ],
        ],
    ],

    'filtering' => [
        'by_game_mode' => 'Участники по игровому режиму',
    ],

    'force_reactivation' => [
        'reason' => [
            'inactive_different_country' => "Ваш аккаунт не использовался в течение долгого времени.",
        ],
    ],

    'login' => [
        '_' => 'Вход',
        'button' => 'Войти',
        'button_posting' => 'Входим...',
        'email_login_disabled' => 'Вход с помощью электронной почты в настоящее время отключён. Вместо этого, пожалуйста, используйте имя пользователя.',
        'failed' => 'Неверный логин/пароль',
        'forgot' => 'Забыли пароль?',
        'info' => 'Пожалуйста, войдите в аккаунт, чтобы продолжить',
        'invalid_captcha' => 'Слишком много попыток входа, пожалуйста, пройдите капчу и попробуйте еще раз. (обновите страницу, если капча не видна)',
        'locked_ip' => 'Ваш IP адрес заблокирован. Попробуйте через несколько минут.',
        'password' => 'Пароль',
        'register' => "У вас всё ещё нет аккаунта в osu!? Создайте новый",
        'remember' => 'Запомнить этот браузер',
        'title' => 'Войдите для продолжения',
        'username' => 'Никнейм',

        'beta' => [
            'main' => 'Доступ к бета-версии ограничен.',
            'small' => '(владельцы osu!supporter получат доступ позже)',
        ],
    ],

    'posts' => [
        'title' => 'посты :username',
    ],

    'anonymous' => [
        'login_link' => 'нажмите для входа',
        'login_text' => 'войти',
        'username' => 'Гость',
        'error' => 'Вы должны войти чтобы сделать это.',
    ],
    'logout_confirm' => 'Вы точно хотите выйти? :(',
    'report' => [
        'button_text' => 'пожаловаться',
        'comments' => 'Дополнительные комментарии',
        'placeholder' => 'Пожалуйста, представьте всю информацию, которую вы считаете нужной.',
        'reason' => 'Причина',
        'thanks' => 'Спасибо за ваше сообщение!',
        'title' => 'Пожаловаться на :username?',

        'actions' => [
            'send' => 'Отправить жалобу',
            'cancel' => 'Отмена',
        ],

        'options' => [
            'cheating' => 'Нечестная игра / читы',
            'multiple_accounts' => 'Использование нескольких аккаунтов',
            'insults' => 'Оскорбление меня / других',
            'spam' => 'Спам',
            'unwanted_content' => 'Неприемлемый контент',
            'nonsense' => 'Оффтоп',
            'other' => 'Другая (введите ниже)',
        ],
    ],
    'restricted_banner' => [
        'title' => 'Права вашего аккаунта ограничены!',
        'message' => 'Пока права вашего аккаунта ограничены, вы не сможете взаимодействовать с другими игроками и ваши результаты будут видны только вам. Обычно это результат автоматизированного процесса и, как правило, ограничение снимается в течении суток. Если вы хотите обжаловать ваше ограничение, пожалуйста <a href="mailto:accounts@ppy.sh">свяжитесь с поддержкой</a>.',
    ],
    'show' => [
        'age' => ':age лет',
        'change_avatar' => 'сменить аватар!',
        'first_members' => 'Здесь с самого начала',
        'is_developer' => 'osu!developer',
        'is_supporter' => 'osu!supporter',
        'joined_at' => 'Дата регистрации: :date',
        'lastvisit' => 'Был в сети :date',
        'lastvisit_online' => 'Сейчас в сети',
        'missingtext' => 'Возможно, вы сделали опечатку! (или игрок заблокирован)',
        'origin_country' => 'Проживает в :country',
        'previous_usernames' => 'ранее известный как',
        'plays_with' => 'Играет с :devices',
        'title' => "Профиль :username",

        'comments_count' => [
            '_' => 'Опубликовано :link',
            'count' => ':count_delimited комментарий|:count_delimited комментария|:count_delimited комментариев',
        ],
        'cover' => [
            'to_0' => 'Скрыть обложку',
            'to_1' => 'Показать обложку',
        ],
        'edit' => [
            'cover' => [
                'button' => 'Сменить обложку профиля',
                'defaults_info' => 'Больше вариантов в недалёком будущем',
                'upload' => [
                    'broken_file' => 'Не удалось обработать изображение. Проверьте загруженное изображение и попробуйте снова.',
                    'button' => 'Загрузить изображение',
                    'dropzone' => 'Перетащите для загрузки',
                    'dropzone_info' => 'Вы также можете перетащить изображение сюда для загрузки',
                    'size_info' => 'Размер обложки должен быть равен 2400x620',
                    'too_large' => 'Загруженное изображение слишком большое.',
                    'unsupported_format' => 'Неподдерживаемый формат.',

                    'restriction_info' => [
                        '_' => 'Загрузка доступна только :link',
                        'link' => 'с тегом osu!supporter',
                    ],
                ],
            ],

            'default_playmode' => [
                'is_default_tooltip' => 'режим игры по умолчанию',
                'set' => 'установить :mode как режим игры по умолчанию',
            ],
        ],

        'extra' => [
            'none' => 'нет',
            'unranked' => 'Нет недавних игр',

            'achievements' => [
                'achieved-on' => 'Получено :date',
                'locked' => 'Не получено',
                'title' => 'Достижения',
            ],
            'beatmaps' => [
                'by_artist' => 'от :artist',
                'title' => 'Карты',

                'favourite' => [
                    'title' => 'Избранные карты',
                ],
                'graveyard' => [
                    'title' => 'Заброшенные карты',
                ],
                'guest' => [
                    'title' => 'Карты с гостевым участием',
                ],
                'loved' => [
                    'title' => 'Любимые карты',
                ],
                'pending' => [
                    'title' => 'На рассмотрении',
                ],
                'ranked' => [
                    'title' => 'Рейтинговые и одобренные карты',
                ],
            ],
            'discussions' => [
                'title' => 'Обсуждения',
                'title_longer' => 'Недавние обсуждения',
                'show_more' => 'посмотреть больше обсуждений',
            ],
            'events' => [
                'title' => 'События',
                'title_longer' => 'Недавние события',
                'show_more' => 'посмотреть больше событий',
            ],
            'historical' => [
                'title' => 'Хронология',

                'monthly_playcounts' => [
                    'title' => 'График игр по месяцам',
                    'count_label' => 'Игр',
                ],
                'most_played' => [
                    'count' => 'количество раз сыграно',
                    'title' => 'Больше всех сыграно',
                ],
                'recent_plays' => [
                    'accuracy' => 'точность: :percentage',
                    'title' => 'Последние игры (за сутки)',
                ],
                'replays_watched_counts' => [
                    'title' => 'История просмотров записей игр',
                    'count_label' => 'Просмотрено записей',
                ],
            ],
            'kudosu' => [
                'recent_entries' => 'История кудосу',
                'title' => 'Кудосу!',
                'total' => 'Кудосу накоплено',

                'entry' => [
                    'amount' => ':amount кудосу',
                    'empty' => "Этот пользователь ещё не получал Кудосу!",

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
                        'give' => 'Получено :amount от :giver за сообщение в посте :post',
                        'reset' => ':giver сбросил кудосу за ответ в посте :post',
                        'revoke' => ':giver отнял кудосу за ответ в посте :post',
                    ],
                ],

                'total_info' => [
                    '_' => 'Зависит от того, сколько вклада пользователь внёс в модерацию карт. Посетите :link для дополнительной информации.',
                    'link' => 'эту страницу',
                ],
            ],
            'me' => [
                'title' => 'обо мне!',
            ],
            'medals' => [
                'empty' => "Этот пользователь ещё ничего не получил. ;_;",
                'recent' => 'Последние полученные медали',
                'title' => 'Медали',
            ],
            'playlists' => [
                'title' => 'Игры в плейлистах',
            ],
            'posts' => [
                'title' => 'Посты',
                'title_longer' => 'Недавние посты',
                'show_more' => 'загрузить больше постов',
            ],
            'recent_activity' => [
                'title' => 'Последняя активность',
            ],
            'realtime' => [
                'title' => 'Игры в мультиплеере',
            ],
            'top_ranks' => [
                'download_replay' => 'Скачать запись',
                'not_ranked' => 'Очки производительности выдаются только за прохождение рейтинговых карт.',
                'pp_weight' => 'засчитано: :percentage pp',
                'view_details' => 'Подробнее',
                'title' => 'Рейтинги',

                'best' => [
                    'title' => 'Лучшие рекорды',
                ],
                'first' => [
                    'title' => 'Первые места',
                ],
                'pin' => [
                    'to_0' => 'Открепить',
                    'to_0_done' => 'Рекорд откреплён',
                    'to_1' => 'Закрепить',
                    'to_1_done' => 'Рекорд закреплён',
                ],
                'pinned' => [
                    'title' => 'Закреплённые рекорды',
                ],
            ],
            'votes' => [
                'given' => 'Отданные голоса (за 3 месяца)',
                'received' => 'Полученные голоса (за 3 месяца)',
                'title' => 'Голоса',
                'title_longer' => 'Недавние голоса',
                'vote_count' => ':count_delimited голос|:count_delimited голоса|:count_delimited голосов',
            ],
            'account_standing' => [
                'title' => 'Нарушения',
                'bad_standing' => "С аккаунтом <strong>:username</strong> не всё хорошо :(",
                'remaining_silence' => ':username сможет говорить снова через :duration.',

                'recent_infringements' => [
                    'title' => 'Недавние',
                    'date' => 'Дата',
                    'action' => 'действие',
                    'length' => 'продолжительность',
                    'length_permanent' => 'Навсегда',
                    'description' => 'описание',
                    'actor' => ':username',

                    'actions' => [
                        'restriction' => 'Бан',
                        'silence' => 'Заглушение',
                        'tournament_ban' => 'Запрет на участие в турнирах',
                        'note' => 'Заметка',
                    ],
                ],
            ],
        ],

        'info' => [
            'discord' => '',
            'interests' => 'Интересы',
            'location' => 'Текущее местоположение',
            'occupation' => 'Род деятельности',
            'twitter' => '',
            'website' => 'Веб-сайт',
        ],
        'not_found' => [
            'reason_1' => 'Они могли изменить свои псевдонимы.',
            'reason_2' => 'Аккаунт может быть временно недоступен в связи с жалобами или проблемами безопасности.',
            'reason_3' => 'Возможно, вы сделали опечатку!',
            'reason_header' => 'Есть несколько возможных причин:',
            'title' => 'Игрок не найден! ;_;',
        ],
        'page' => [
            'button' => 'Отредактировать профиль',
            'description' => '<strong>обо мне!</strong> - это ваше личное редактируемое пространство в профиле.',
            'edit_big' => 'редактировать',
            'placeholder' => 'Введите контент страницы сюда',

            'restriction_info' => [
                '_' => 'Для использования этой функции нужен :link.',
                'link' => 'тег osu!supporter',
            ],
        ],
        'post_count' => [
            '_' => 'Написал :link',
            'count' => ':count пост|:count поста|:count постов',
        ],
        'rank' => [
            'country' => 'Рейтинг стран для :mode',
            'country_simple' => 'Рейтинг в стране',
            'global' => 'Глобальный рейтинг для :mode',
            'global_simple' => 'Рейтинг в мире',
        ],
        'stats' => [
            'hit_accuracy' => 'Точность попаданий',
            'level' => 'Уровень :level',
            'level_progress' => 'Прогресс до следующего уровня',
            'maximum_combo' => 'Максимальное комбо',
            'medals' => 'Медалей',
            'play_count' => 'Количество игр',
            'play_time' => 'Времени в игре',
            'ranked_score' => 'Рейтинговые очки',
            'replays_watched_by_others' => 'Просмотров записей игр другими',
            'score_ranks' => 'Рейтинг по очкам',
            'total_hits' => 'Всего попаданий',
            'total_score' => 'Всего очков',
            // modding stats
            'graveyard_beatmapset_count' => 'Заброшенные карты',
            'loved_beatmapset_count' => 'Любимые сообществом карты',
            'pending_beatmapset_count' => 'Карты на рассмотрении',
            'ranked_beatmapset_count' => 'Рейтинговые и утвержденные карты',
        ],
    ],

    'silenced_banner' => [
        'title' => 'Вы сейчас заглушены.',
        'message' => 'Некоторые действия могут быть недоступны.',
    ],

    'status' => [
        'all' => 'Все',
        'online' => 'В сети',
        'offline' => 'Не в сети',
    ],
    'store' => [
        'saved' => 'Пользователь создан',
    ],
    'verify' => [
        'title' => 'Подтверждения аккаунта',
    ],

    'view_mode' => [
        'brick' => 'Показывать кирпичиками',
        'card' => 'Показывать карточками',
        'list' => 'Показывать списком',
    ],
];

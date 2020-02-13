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
    'discussion-posts' => [
        'store' => [
            'error' => 'Не удалось сохранить публикацию',
        ],
    ],

    'discussion-votes' => [
        'update' => [
            'error' => 'Не удалось обновить ответ',
        ],
    ],

    'discussions' => [
        'allow_kudosu' => 'разрешить кудосу',
        'beatmap_information' => 'Страница карты',
        'delete' => 'удалить',
        'deleted' => 'Удалено :editor в :delete_time',
        'deny_kudosu' => 'запретить кудосу',
        'edit' => 'изменить',
        'edited' => 'Последний раз изменён :editor в :update_time',
        'kudosu_denied' => 'Отказано в получении кудосу.',
        'message_placeholder_deleted_beatmap' => 'Эта сложность была удалена, и поэтому обсуждать её больше нельзя.',
        'message_placeholder_locked' => 'Обсуждение этой карты было отключено.',
        'message_type_select' => 'Выбрать тип комментария',
        'reply_notice' => 'Нажмите Enter для ответа.',
        'reply_placeholder' => 'Введите тут ответ',
        'require-login' => 'Чтобы оставить сообщение или ответить, пожалуйста, войдите в аккаунт',
        'resolved' => 'Решено',
        'restore' => 'восстановить',
        'show_deleted' => 'Показать удалённые',
        'title' => 'Отзывы',

        'collapse' => [
            'all-collapse' => 'Скрыть всё',
            'all-expand' => 'Показать всё',
        ],

        'empty' => [
            'empty' => 'Нет отзывов!',
            'hidden' => 'Ни один отзыв не соответствует указанному фильтру.',
        ],

        'lock' => [
            'button' => [
                'lock' => 'Заблокировать возможность обсуждения',
                'unlock' => 'Разблокировать возможность обсуждения',
            ],

            'prompt' => [
                'lock' => 'Причина блокировки',
                'unlock' => 'Вы уверены, что хотите разблокировать обсуждение?',
            ],
        ],

        'message_hint' => [
            'in_general' => 'Этот пост пойдет в общую ветку отзывов. Чтобы изменить эту карту, начните своё сообщение с временной отметкой (к примеру 00:12:345).',
            'in_timeline' => 'Для модерирования нескольких временных отметок, опубликуйте несколько сообщений (по одному на отметку).',
        ],

        'message_placeholder' => [
            'general' => 'Введите здесь, чтобы запостить в Общий (:version)',
            'generalAll' => 'Введите здесь, чтобы запостить в Общий (Все сложности)',
            'timeline' => 'Введите здесь, чтобы запостить в временную шкалу (:version)',
        ],

        'message_type' => [
            'disqualify' => 'Дисквалифицировать',
            'hype' => 'Хайпануть!',
            'mapper_note' => 'Заметка',
            'nomination_reset' => 'Сбросить номинацию',
            'praise' => 'Похвала',
            'problem' => 'Проблема',
            'review' => 'Отзыв',
            'suggestion' => 'Запрос',
        ],

        'mode' => [
            'events' => 'История',
            'general' => 'Общее :scope',
            'reviews' => 'Отзывы',
            'timeline' => 'Временная шкала',
            'scopes' => [
                'general' => 'эта сложность',
                'generalAll' => 'все сложности',
            ],
        ],

        'new' => [
            'pin' => 'Закрепить',
            'timestamp' => 'Временная отметка',
            'timestamp_missing' => 'нажмите Ctrl + C в режиме редактирования, чтобы скопировать временную отметку и вставить в сообщение!',
            'title' => 'Новый отзыв',
            'unpin' => 'Открепить',
        ],

        'show' => [
            'title' => ':title от :mapper',
        ],

        'sort' => [
            'created_at' => 'дате создания',
            'timeline' => 'хронологии',
            'updated_at' => 'дате изменения',
        ],

        'stats' => [
            'deleted' => 'Удалено',
            'mapper_notes' => 'Заметки',
            'mine' => 'Мои',
            'pending' => 'Ожидающий',
            'praises' => 'Похвалы',
            'resolved' => 'Решено',
            'total' => 'Все',
        ],

        'status-messages' => [
            'approved' => 'Эта карта была одобрена :date!',
            'graveyard' => "Эта карта не обновлялась с :date и похоже, что автор её забросил...",
            'loved' => 'Эта карта была добавлена в «Любимые» :date!',
            'ranked' => 'Эта карта стала рейтинговой :date!',
            'wip' => 'Заметьте: Эта карта была помечена создателем как незавершённая.',
        ],

        'votes' => [
            'none' => [
                'down' => 'Отрицательных оценок пока нет',
                'up' => 'Положительных оценок пока нет',
            ],
            'latest' => [
                'down' => 'Последние не одобрения',
                'up' => 'Последние одобрения',
            ],
        ],
    ],

    'hype' => [
        'button' => 'Хайпануть карту!',
        'button_done' => 'Уже хайпанута!',
        'confirm' => "Вы уверены? Это действие отберёт один из :n хайпов и не может быть отменено.",
        'explanation' => 'Хайпаните карту, чтобы сделать её доступной для номинирования и получения рейтинга!',
        'explanation_guest' => 'Войдите в аккаунт, чтобы сделать карту доступной для номинирования!',
        'new_time' => "Вы получите другой хайп :new_time.",
        'remaining' => 'У вас осталось :remaining хайпа.',
        'required_text' => 'Хайп: :current/:required',
        'section_title' => 'Прогресс хайпа',
        'title' => 'Хайпаните',
    ],

    'feedback' => [
        'button' => 'Оставить отзыв',
    ],

    'nominations' => [
        'delete' => 'Удалить',
        'delete_own_confirm' => 'Уверены? Карта будет удалена, и вы будете перенаправлены обратно в свой профиль.',
        'delete_other_confirm' => 'Уверены? Карта будет удалена, и вы будете перенаправлены в профиль пользователя.',
        'disqualification_prompt' => 'Причина для дисквалификации?',
        'disqualified_at' => 'Дисквалифицирована :time_ago (:reason).',
        'disqualified_no_reason' => 'причина не указана',
        'disqualify' => 'Дисквалифицировать',
        'incorrect_state' => 'Не удалось выполнить данную задачу, попробуйте перезагрузить страницу.',
        'love' => 'Любимое',
        'love_confirm' => 'Отметить карту как любимую?',
        'nominate' => 'Номинировать',
        'nominate_confirm' => 'Номинировать эту карту?',
        'nominated_by' => 'номинирована :users',
        'not_enough_hype' => "Недостаточно хайпа.",
        'qualified' => 'Если проблем больше нет, карта получит статус «Рейтинговая» примерно :date.',
        'qualified_soon' => 'Если проблем больше нет, карта скоро получит статус «Рейтинговая».',
        'required_text' => 'Номинации: :current/:required',
        'reset_message_deleted' => 'удалено',
        'title' => 'Статус номинации',
        'unresolved_issues' => 'Ещё остались нерешенные проблемы, которые необходимо решить в первую очередь.',

        'reset_at' => [
            'nomination_reset' => ':user сбросил прогресс номинаций :time_ago из-за новой проблемы :discussion (:message).',
            'disqualify' => ':user дисквалифицировал :time_ago из-за новой проблемы :discussion (:message).',
        ],

        'reset_confirm' => [
            'nomination_reset' => 'Вы уверены? Сообщение о новой проблеме сбросит статус номинации.',
            'disqualify' => 'Уверены? Карта будет снята с квалификации и статус номинирования будет сброшен.',
        ],
    ],

    'listing' => [
        'search' => [
            'prompt' => 'начните вводить ключевые слова ...',
            'login_required' => 'Войдите, чтобы искать.',
            'options' => 'Больше настроек поиска',
            'supporter_filter' => 'Фильтрация по :filters требует наличия osu!supporter',
            'not-found' => 'нет результатов',
            'not-found-quote' => '... увы, ничего не найдено.',
            'filters' => [
                'general' => 'Общее',
                'mode' => 'Режим игры',
                'status' => 'Категории',
                'genre' => 'Жанр',
                'language' => 'Язык',
                'extra' => 'Дополнительно',
                'rank' => 'Заработан рейтинг',
                'played' => 'Сыграно',
            ],
            'sorting' => [
                'title' => 'Названию',
                'artist' => 'Исполнителю',
                'difficulty' => 'Сложности',
                'favourites' => 'Добавлениям в Избранные',
                'updated' => 'Дате обновления',
                'ranked' => 'Дате получения рейтинга',
                'rating' => 'Оценкам',
                'plays' => 'Количеству игр',
                'relevance' => 'Релевантности',
                'nominations' => 'Номинациям',
            ],
            'supporter_filter_quote' => [
                '_' => 'Фильтрация по :filters требует :link',
                'link_text' => 'тег osu!supporter',
            ],
        ],
    ],
    'general' => [
        'recommended' => 'Рекомендованная сложность',
        'converts' => 'Включить конвертированные карты',
    ],
    'mode' => [
        'any' => 'Все',
        'osu' => 'osu!',
        'taiko' => 'osu!taiko',
        'fruits' => 'osu!catch',
        'mania' => 'osu!mania',
    ],
    'status' => [
        'any' => 'Все',
        'approved' => 'Одобренные',
        'favourites' => 'Избранные',
        'graveyard' => 'Заброшенные',
        'leaderboard' => 'С таблицей рекордов',
        'loved' => 'Любимые',
        'mine' => 'Мои карты',
        'pending' => 'Ожидающие и В разработке',
        'qualified' => 'Квалифицированные',
        'ranked' => 'Рейтинговые',
    ],
    'genre' => [
        'any' => 'Все',
        'unspecified' => 'Не определён',
        'video-game' => 'Видеоигры',
        'anime' => 'Аниме',
        'rock' => 'Рок',
        'pop' => 'Поп',
        'other' => 'Другой',
        'novelty' => 'Новый',
        'hip-hop' => 'Хип-хоп',
        'electronic' => 'Электроника',
    ],
    'mods' => [
        '4K' => '4K',
        '5K' => '5K',
        '6K' => '6K',
        '7K' => '7K',
        '8K' => '8K',
        '9K' => '9K',
        'AP' => 'Auto Pilot',
        'DT' => 'Double Time',
        'EZ' => 'Easy Mode',
        'FI' => 'Fade In',
        'FL' => 'Flashlight',
        'HD' => 'Hidden',
        'HR' => 'Hard Rock',
        'HT' => 'Half Time',
        'MR' => 'Зеркало',
        'NC' => 'Nightcore',
        'NF' => 'No Fail',
        'NM' => 'No mods',
        'PF' => 'Perfect',
        'Relax' => 'Relax',
        'SD' => 'Sudden Death',
        'SO' => 'Spun Out',
        'TD' => 'Touch Device',
    ],
    'language' => [
        'any' => 'Все',
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
        'other' => 'Другой',
    ],
    'played' => [
        'any' => 'Все',
        'played' => 'Сыграно',
        'unplayed' => 'Не сыграно',
    ],
    'extra' => [
        'video' => 'Есть видео',
        'storyboard' => 'Есть сториборд',
    ],
    'rank' => [
        'any' => 'Все',
        'XH' => 'SS+',
        'X' => 'SS',
        'SH' => 'S+',
        'S' => 'S',
        'A' => 'A',
        'B' => 'B',
        'C' => 'C',
        'D' => 'D',
    ],
    'panel' => [
        'playcount' => 'Количество игр: :count',
        'favourites' => 'В любимых: :count',
    ],
];

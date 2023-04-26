<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'discussion-votes' => [
        'update' => [
            'error' => 'Не удалось проголосовать',
        ],
    ],

    'discussions' => [
        'allow_kudosu' => 'разрешить кудосу',
        'beatmap_information' => 'Страница карты',
        'delete' => 'удалить',
        'deleted' => 'Удалено :editor в :delete_time.',
        'deny_kudosu' => 'запретить кудосу',
        'edit' => 'изменить',
        'edited' => 'Последний раз редактировал :editor :update_time.',
        'guest' => 'Гостевая сложность от :user',
        'kudosu_denied' => 'Отказано в получении кудосу.',
        'message_placeholder_deleted_beatmap' => 'Эта сложность была удалена, и поэтому обсуждать её больше нельзя.',
        'message_placeholder_locked' => 'Обсуждение этой карты было отключено.',
        'message_placeholder_silenced' => "Запрещено писать посты в обсуждении, пока вы заглушены.",
        'message_type_select' => 'Выбрать тип комментария',
        'reply_notice' => 'Нажмите Enter, чтобы ответить.',
        'reply_placeholder' => 'Напишите ответ',
        'require-login' => 'Пожалуйста, войдите в аккаунт, чтобы оставить сообщение или ответить',
        'resolved' => 'Решено',
        'restore' => 'восстановить',
        'show_deleted' => 'Показать удалённые',
        'title' => 'Обсуждение',

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
                'lock' => 'Закрыть обсуждение',
                'unlock' => 'Открыть обсуждение',
            ],

            'prompt' => [
                'lock' => 'Причина блокировки',
                'unlock' => 'Вы уверены, что хотите открыть обсуждение?',
            ],
        ],

        'message_hint' => [
            'in_general' => 'Этот пост пойдет в общую ветку отзывов. Чтобы изменить эту карту, начните своё сообщение с временной отметкой (к примеру 00:12:345).',
            'in_timeline' => 'Для модерации нескольких тайм-кодов нужно написать ответ на каждый из них.',
        ],

        'message_placeholder' => [
            'general' => 'Оставьте отзыв в Общее (:version)',
            'generalAll' => 'Оставьте отзыв в Общее (все сложности)',
            'review' => 'Напишите рецензию',
            'timeline' => 'Сообщите о тайм-коде в сложности :version',
        ],

        'message_type' => [
            'disqualify' => 'Дисквалифицировать',
            'hype' => 'Хайпануть!',
            'mapper_note' => 'Заметка',
            'nomination_reset' => 'Сбросить номинацию',
            'praise' => 'Похвала',
            'problem' => 'Проблема',
            'problem_warning' => 'Сообщить о проблеме',
            'review' => 'Рецензия',
            'suggestion' => 'Предложение',
        ],

        'mode' => [
            'events' => 'История',
            'general' => 'Общее :scope',
            'reviews' => 'Рецензии',
            'timeline' => 'Тайм-коды',
            'scopes' => [
                'general' => 'Эта сложность',
                'generalAll' => 'все сложности',
            ],
        ],

        'new' => [
            'pin' => 'Закрепить',
            'timestamp' => 'Тайм-код',
            'timestamp_missing' => 'Чтобы добавить тайм-код, нажмите Ctrl+C в редакторе и Ctrl+V здесь!',
            'title' => 'Новый отзыв',
            'unpin' => 'Открепить',
        ],

        'review' => [
            'new' => 'Новая рецензия',
            'embed' => [
                'delete' => 'Удалить',
                'missing' => '[ОТЗЫВ УДАЛЁН]',
                'unlink' => 'Отвязать',
                'unsaved' => 'Не сохранено',
                'timestamp' => [
                    'all-diff' => 'Отзывы к "Все сложности" не должны содержать тайм-кодов.',
                    'diff' => 'Если :type начинается с тайм-кода, он появится в разделе "Тайм-коды".',
                ],
            ],
            'insert-block' => [
                'paragraph' => 'вставить параграф',
                'praise' => 'вставить похвалу',
                'problem' => 'вставить проблему',
                'suggestion' => 'вставить предложение',
            ],
        ],

        'show' => [
            'title' => ':title от :mapper',
        ],

        'sort' => [
            'created_at' => 'Дате создания',
            'timeline' => 'Хронологии',
            'updated_at' => 'Дате изменения',
        ],

        'stats' => [
            'deleted' => 'Удалено',
            'mapper_notes' => 'Заметки',
            'mine' => 'Мои',
            'pending' => 'Не решено',
            'praises' => 'Похвалы',
            'resolved' => 'Решено',
            'total' => 'Все',
        ],

        'status-messages' => [
            'approved' => 'Эта карта стала одобреной :date!',
            'graveyard' => "Эта карта не обновлялась с :date и, похоже, что автор её забросил...",
            'loved' => 'Эта карта стала любимой :date!',
            'ranked' => 'Эта карта стала рейтинговой :date!',
            'wip' => 'Примечание: Эта карта была помечена создателем как незавершённая.',
        ],

        'votes' => [
            'none' => [
                'down' => 'Пока никто не согласился',
                'up' => 'Пока одобрений нет',
            ],
            'latest' => [
                'down' => 'Не согласились',
                'up' => 'Поддержали',
            ],
        ],
    ],

    'hype' => [
        'button' => 'Хайпануть карту!',
        'button_done' => 'Уже хайпанута!',
        'confirm' => "Вы уверены? Это необратимое действие; будет использован один из :n хайпов.",
        'explanation' => 'Хайпаните карту, чтобы сделать её доступной для номинирования и выхода в рейтинг!',
        'explanation_guest' => 'Войдите в аккаунт, чтобы сделать карту доступной для номинирования!',
        'new_time' => "Вы получите ещё один хайп :new_time.",
        'remaining' => 'У вас осталось :remaining хайпа.',
        'required_text' => 'Хайп: :current/:required',
        'section_title' => 'Прогресс хайпа',
        'title' => 'Хайп',
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
        'love' => 'Присвоить категорию Любимая',
        'love_choose' => 'Выберите сложность для любимой карты',
        'love_confirm' => 'Дать карте категорию Любимая?',
        'nominate' => 'Номинировать',
        'nominate_confirm' => 'Номинировать эту карту?',
        'nominated_by' => 'номинирована :users',
        'not_enough_hype' => "Недостаточно хайпа.",
        'remove_from_loved' => 'Дисквалифицировать',
        'remove_from_loved_prompt' => 'Причина дисквалификации из категории Любимая:',
        'required_text' => 'Номинаций: :current/:required',
        'reset_message_deleted' => 'удалено',
        'title' => 'Статус номинации',
        'unresolved_issues' => 'Ещё остались нерешенные проблемы, которые необходимо решить в первую очередь.',

        'rank_estimate' => [
            '_' => 'Эта карта станет рейтинговой :date, если не будет найдено проблем. Она #:position в :queue.',
            'on' => ':date',
            'queue' => 'очереди ранка',
            'soon' => 'скоро',
        ],

        'reset_at' => [
            'nomination_reset' => ':user сбросил прогресс номинаций :time_ago из-за новой проблемы :discussion (:message).',
            'disqualify' => ':user дисквалифицировал :time_ago из-за новой проблемы :discussion (:message).',
        ],

        'reset_confirm' => [
            'disqualify' => 'Вы уверены? Карта будет дисквалифицирована, а статус номинации будет сброшен.',
            'nomination_reset' => 'Вы уверены? Сообщение о новой проблеме сбросит статус номинации.',
            'problem_warning' => 'Вы действительно хотите сообщить о проблеме в этой карте? Номинаторы будут оповещены.',
        ],
    ],

    'listing' => [
        'search' => [
            'prompt' => 'введите ключевые слова...',
            'login_required' => 'Войдите, чтобы искать.',
            'options' => 'Больше настроек поиска',
            'supporter_filter' => 'Фильтрация по критерию :filters требует наличия тега osu!supporter',
            'not-found' => 'нет результатов',
            'not-found-quote' => '... увы, ничего не найдено.',
            'filters' => [
                'extra' => 'Дополнительно',
                'general' => 'Общее',
                'genre' => 'Жанр',
                'language' => 'Язык',
                'mode' => 'Режим игры',
                'nsfw' => 'С откровенным содержанием',
                'played' => 'Статус прохождения',
                'rank' => 'Достигнутый ранг',
                'status' => 'Категории',
            ],
            'sorting' => [
                'title' => 'Названию',
                'artist' => 'Исполнителю',
                'difficulty' => 'Сложности',
                'favourites' => 'Добавлениям в Избранные',
                'updated' => 'Дате обновления',
                'ranked' => 'Дате появления в категории',
                'rating' => 'Оценкам',
                'plays' => 'Количеству игр',
                'relevance' => 'Релевантности',
                'nominations' => 'Номинациям',
            ],
            'supporter_filter_quote' => [
                '_' => 'Фильтрация по критерию :filters требует :link',
                'link_text' => 'тег osu!supporter',
            ],
        ],
    ],
    'general' => [
        'converts' => 'Показывать конвертированные карты',
        'featured_artists' => 'Избранные исполнители',
        'follows' => 'Отслеживаемые мапперы',
        'recommended' => 'Рекомендованная сложность',
        'spotlights' => 'Карты из чартов',
    ],
    'mode' => [
        'all' => 'Все',
        'any' => 'Любой',
        'osu' => '',
        'taiko' => '',
        'fruits' => '',
        'mania' => '',
    ],
    'status' => [
        'any' => 'Все',
        'approved' => 'Одобренные',
        'favourites' => 'Избранные',
        'graveyard' => 'Заброшенные',
        'leaderboard' => 'С таблицей рекордов',
        'loved' => 'Любимые',
        'mine' => 'Мои карты',
        'pending' => 'На рассмотрении',
        'wip' => 'В разработке',
        'qualified' => 'Квалифицированные',
        'ranked' => 'Рейтинговые',
    ],
    'genre' => [
        'any' => 'Любой',
        'unspecified' => 'Не определён',
        'video-game' => 'Видеоигры',
        'anime' => 'Аниме',
        'rock' => 'Рок',
        'pop' => 'Поп',
        'other' => 'Другой',
        'novelty' => 'Новшество',
        'hip-hop' => 'Хип-хоп',
        'electronic' => 'Электроника',
        'metal' => 'Метал',
        'classical' => 'Классика',
        'folk' => 'Народная',
        'jazz' => 'Джаз',
    ],
    'language' => [
        'any' => 'Любой',
        'english' => 'Английский',
        'chinese' => 'Китайский',
        'french' => 'Французский',
        'german' => 'Немецкий',
        'italian' => 'Итальянский',
        'japanese' => 'Японский',
        'korean' => 'Корейский',
        'spanish' => 'Испанский',
        'swedish' => 'Шведский',
        'russian' => 'Русский',
        'polish' => 'Польский',
        'instrumental' => 'Инструментальный',
        'other' => 'Другой',
        'unspecified' => 'Не определён',
    ],

    'nsfw' => [
        'exclude' => 'Скрыть',
        'include' => 'Показать',
    ],

    'played' => [
        'any' => 'Неважно',
        'played' => 'Пройдена',
        'unplayed' => 'Не пройдена',
    ],
    'extra' => [
        'video' => 'Есть видео',
        'storyboard' => 'Есть сториборд',
    ],
    'rank' => [
        'any' => 'Все',
        'XH' => 'SS+',
        'X' => '',
        'SH' => 'S+',
        'S' => '',
        'A' => '',
        'B' => '',
        'C' => '',
        'D' => '',
    ],
    'panel' => [
        'playcount' => 'Количество игр: :count',
        'favourites' => 'В избранном: :count',
    ],
    'variant' => [
        'mania' => [
            '4k' => '4K',
            '7k' => '7K',
            'all' => 'Все',
        ],
    ],
];

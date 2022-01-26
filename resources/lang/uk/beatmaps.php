<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'discussion-votes' => [
        'update' => [
            'error' => 'Не вдається оновити відповідь',
        ],
    ],

    'discussions' => [
        'allow_kudosu' => 'дозволити кудосу',
        'beatmap_information' => 'Сторінка карти',
        'delete' => 'видалити',
        'deleted' => 'Видалено :editor :delete_time.',
        'deny_kudosu' => 'заборонити кудосу',
        'edit' => 'змінити',
        'edited' => 'Останній раз змінено :editor :update_time.',
        'guest' => 'Гостьова складність від :user',
        'kudosu_denied' => 'Відмовлено в отриманні кудосу.',
        'message_placeholder_deleted_beatmap' => 'Ця складність була видалена і відгукуватися про неї не можна.',
        'message_placeholder_locked' => 'Обговорення цієї карти відключено.',
        'message_placeholder_silenced' => "Не можна коментувати поки заглушений.",
        'message_type_select' => 'Вибрати тип коментаря',
        'reply_notice' => 'Натисніть Enter для відповіді.',
        'reply_placeholder' => 'Введіть відповідь тут',
        'require-login' => 'Зайдіть для публікації або відповіді',
        'resolved' => 'Вирішено',
        'restore' => 'відновити',
        'show_deleted' => 'Показати видалені',
        'title' => 'Обговорення',

        'collapse' => [
            'all-collapse' => 'Приховати все',
            'all-expand' => 'Показати все',
        ],

        'empty' => [
            'empty' => 'Ще немає обговорень!',
            'hidden' => 'Жодне обговорення не відповідає вибраному фільтру.',
        ],

        'lock' => [
            'button' => [
                'lock' => 'Заблокувати можливість обговорення',
                'unlock' => 'Розблокувати можливість обговорення',
            ],

            'prompt' => [
                'lock' => 'Причина блокування',
                'unlock' => 'Ви впевнені, що хочете розблокувати обговорення?',
            ],
        ],

        'message_hint' => [
            'in_general' => 'Цей пост піде в загальну гілку обговорень. Щоб змінити цю карту, почніть своє повідомлення з зазначенням часу (наприклад 00:12:345).',
            'in_timeline' => 'Для зміни декількох позначок, опублікуйте кілька позначок (одна публікація на позначку).',
        ],

        'message_placeholder' => [
            'general' => 'Пишіть тут, щоб розмістити обговорення в Загальний (:version)',
            'generalAll' => 'Пишіть тут, щоб розмістити обговорення в Загальний (Всі складності)',
            'review' => 'Пишіть тут, щоб розмістити відгук',
            'timeline' => 'Пишіть тут, щоб розмістити обговорення на Шкалі часу (:version)',
        ],

        'message_type' => [
            'disqualify' => 'Дискваліфікувати',
            'hype' => 'Хайп!',
            'mapper_note' => 'Замітка',
            'nomination_reset' => 'Зняти номінацію',
            'praise' => 'Хвала',
            'problem' => 'Проблема',
            'review' => 'Відгук',
            'suggestion' => 'Пропозиція',
        ],

        'mode' => [
            'events' => 'Історія',
            'general' => 'Загальні :scope',
            'reviews' => 'Відгуки',
            'timeline' => 'Графік',
            'scopes' => [
                'general' => 'Ця складність',
                'generalAll' => 'Всі складності',
            ],
        ],

        'new' => [
            'pin' => 'Закріпити',
            'timestamp' => 'Мітка часу',
            'timestamp_missing' => 'натисніть ctrl-c в редакторі щоб скопіювати мітку часу!',
            'title' => 'Нове обговорення',
            'unpin' => 'Відкріпити',
        ],

        'review' => [
            'new' => 'Новий відгук',
            'embed' => [
                'delete' => 'Видалити',
                'missing' => '[ТЕМА ВИДАЛЕНА]',
                'unlink' => 'Відв\'язати',
                'unsaved' => 'Не збережено',
                'timestamp' => [
                    'all-diff' => 'Записи для всіх складнощів не можуть мати тимчасових відміток.',
                    'diff' => 'Якщо :type починається з тимчасової позначки, воно буде показано в Тимчасової шкалою.',
                ],
            ],
            'insert-block' => [
                'paragraph' => 'вставити абзац',
                'praise' => 'вставити похвалу',
                'problem' => 'вставити проблему',
                'suggestion' => 'вставити пропозицію',
            ],
        ],

        'show' => [
            'title' => ':title від :mapper',
        ],

        'sort' => [
            'created_at' => 'Час створення',
            'timeline' => 'Хронологія',
            'updated_at' => 'Останнє оновлення',
        ],

        'stats' => [
            'deleted' => 'Видалено',
            'mapper_notes' => 'Примітки',
            'mine' => 'Мої',
            'pending' => 'В очікуванні',
            'praises' => 'Похвала',
            'resolved' => 'Вирішено',
            'total' => 'Всі',
        ],

        'status-messages' => [
            'approved' => 'Ця карта була схвалена :date!',
            'graveyard' => "Ця карта не оновлювалася з :date здається автор її закинув...",
            'loved' => 'Ця карта була визнана "улюбленою" :date!',
            'ranked' => 'Ця карта стала ранговою :date!',
            'wip' => 'Примітка: Ця карта була позначена автором як незавершена.',
        ],

        'votes' => [
            'none' => [
                'down' => 'Голосів "проти" немає',
                'up' => 'Голосів "за" немає',
            ],
            'latest' => [
                'down' => 'Останні голоси "проти"',
                'up' => 'Останні голоси "за"',
            ],
        ],
    ],

    'hype' => [
        'button' => 'Хайпнути карту!',
        'button_done' => 'Вже хайпнута!',
        'confirm' => "Ви впевнені? Ця дія відбере один з :n хайпів і не може бути скасованою.",
        'explanation' => 'Це зробить карту більш помітною для номінації та рейтингу!',
        'explanation_guest' => 'Увійдіть, щоб зробити карту доступною для номінування!',
        'new_time' => "Ви отримаєте інший хайп :new_time.",
        'remaining' => 'У вас залишилося :remaining хайпу.',
        'required_text' => 'Хайп: :current/:required',
        'section_title' => 'Прогрес хайпу',
        'title' => 'Хайп',
    ],

    'feedback' => [
        'button' => 'Залишити відгук',
    ],

    'nominations' => [
        'delete' => 'Видалити',
        'delete_own_confirm' => 'Ви впевнені? Карта буде видалена, а вас буде перенаправлено назад в профіль.',
        'delete_other_confirm' => 'Ви впевнені? Карта буде видалена, а вас буде перенаправлено назад в профіль.',
        'disqualification_prompt' => 'Причина для дискваліфікації?',
        'disqualified_at' => 'Дискваліфікований :time_ago (:reason).',
        'disqualified_no_reason' => 'не вказано причини',
        'disqualify' => 'Дискваліфікувати',
        'incorrect_state' => 'Помилка під час виконання цих дій, спробуйте оновити сторінку.',
        'love' => 'Улюблені',
        'love_choose' => 'Виберіть складність для улюблених',
        'love_confirm' => 'Відмітити карту як улюблену?',
        'nominate' => 'Номінувати',
        'nominate_confirm' => 'Номінувати цю карту?',
        'nominated_by' => 'номінована :users',
        'not_enough_hype' => "Недостатньо хайпа.",
        'remove_from_loved' => 'Вилучено з категорії Loved',
        'remove_from_loved_prompt' => 'Причина вилучення від категорії Loved:',
        'required_text' => 'Номінації: :current/:required',
        'reset_message_deleted' => 'видалено',
        'title' => 'Статус номінації',
        'unresolved_issues' => 'Є ще деякі проблеми, які потребують вирішення.',

        'rank_estimate' => [
            '_' => 'Ця карта стане рейтинговою :date, якщо ніяких проблем не буде знайдено. Вона #:position в :queue.',
            'queue' => 'рейтинговому списку',
            'soon' => 'скоро',
        ],

        'reset_at' => [
            'nomination_reset' => ':user скинув прогрес номінації :time_ago через нову проблему :discussion (:message).',
            'disqualify' => ':user дискваліфікував :time_ago через нову проблему :discussion (:message).',
        ],

        'reset_confirm' => [
            'nomination_reset' => 'Ви впевнені? Повідомлення про нову проблему скине прогрес номінації.',
            'disqualify' => 'Впевнені? Карта буде знята з кваліфікації і прогрес номінування буде скинуто.',
        ],
    ],

    'listing' => [
        'search' => [
            'prompt' => 'почніть вводити ключові слова...',
            'login_required' => 'Увійдіть, щоб шукати.',
            'options' => 'Більше параметрів пошуку',
            'supporter_filter' => 'Сортування по :filters потребує наявності osu!supporter',
            'not-found' => 'немає результатів',
            'not-found-quote' => '... на жаль, нічого не знайдено.',
            'filters' => [
                'extra' => 'Додатково',
                'general' => 'Загальні',
                'genre' => 'Жанр',
                'language' => 'Мова',
                'mode' => 'Режим',
                'nsfw' => 'Відвертий вміст',
                'played' => 'Зіграно',
                'rank' => 'Досягнутий ранг',
                'status' => 'Категорії',
            ],
            'sorting' => [
                'title' => 'Назвою',
                'artist' => 'Виконавцем',
                'difficulty' => 'Складністю',
                'favourites' => 'Вибране',
                'updated' => 'Датою оновлення',
                'ranked' => 'Датою рангу',
                'rating' => 'Рейтингом',
                'plays' => 'Кількістю ігор',
                'relevance' => 'Релевантністю',
                'nominations' => 'Номінаціями',
            ],
            'supporter_filter_quote' => [
                '_' => 'Сортування за :filters вимагає :link',
                'link_text' => 'тег osu!supporter',
            ],
        ],
    ],
    'general' => [
        'converts' => 'Показувати конвертовані карти',
        'featured_artists' => 'Вибрані артисти',
        'follows' => 'Маппери на яких ви підписані',
        'recommended' => 'Рекомендована складність',
    ],
    'mode' => [
        'all' => 'Всі',
        'any' => 'Всі',
        'osu' => '',
        'taiko' => '',
        'fruits' => '',
        'mania' => '',
    ],
    'status' => [
        'any' => 'Всі',
        'approved' => 'Схвалені',
        'favourites' => 'Вибрані',
        'graveyard' => 'Закинуті',
        'leaderboard' => 'З таблицею рекордів',
        'loved' => 'Улюблені',
        'mine' => 'Мої карти',
        'pending' => 'Очікуючі і в процесі розробки',
        'qualified' => 'Кваліфіковані',
        'ranked' => 'Ранкнуті',
    ],
    'genre' => [
        'any' => 'Всі',
        'unspecified' => 'Не визначений',
        'video-game' => 'Відеоігри',
        'anime' => 'Аніме',
        'rock' => 'Рок',
        'pop' => 'Поп',
        'other' => 'Інші',
        'novelty' => 'Нові',
        'hip-hop' => 'Хіп-хоп',
        'electronic' => 'Електро',
        'metal' => 'Метал',
        'classical' => 'Класична',
        'folk' => 'Народна',
        'jazz' => 'Джаз',
    ],
    'mods' => [
        '4K' => '',
        '5K' => '',
        '6K' => '',
        '7K' => '',
        '8K' => '',
        '9K' => '',
        'AP' => '',
        'DT' => '',
        'EZ' => '',
        'FI' => '',
        'FL' => '',
        'HD' => '',
        'HR' => '',
        'HT' => '',
        'MR' => '',
        'NC' => '',
        'NF' => '',
        'NM' => '',
        'PF' => '',
        'RX' => '',
        'SD' => '',
        'SO' => '',
        'TD' => '',
        'V2' => '',
    ],
    'language' => [
        'any' => 'Будь-яка',
        'english' => 'Англійська',
        'chinese' => 'Китайська',
        'french' => 'Французька',
        'german' => 'Німецька',
        'italian' => 'Італійська',
        'japanese' => 'Японська',
        'korean' => 'Корейська',
        'spanish' => 'Іспанська',
        'swedish' => 'Шведська',
        'russian' => 'Російська',
        'polish' => 'Польська',
        'instrumental' => 'Інструментальна',
        'other' => 'Інше',
        'unspecified' => 'Не визначена',
    ],

    'nsfw' => [
        'exclude' => 'Приховати',
        'include' => 'Показати',
    ],

    'played' => [
        'any' => 'Всі',
        'played' => 'Зіграно',
        'unplayed' => 'Не зіграно',
    ],
    'extra' => [
        'video' => 'З відео',
        'storyboard' => 'Є сторіборди',
    ],
    'rank' => [
        'any' => 'Всі',
        'XH' => 'Срібний SS',
        'X' => '',
        'SH' => 'Срібний S',
        'S' => '',
        'A' => '',
        'B' => '',
        'C' => '',
        'D' => '',
    ],
    'panel' => [
        'playcount' => 'Кількість ігор: :count',
        'favourites' => 'В улюблених: :count',
    ],
    'variant' => [
        'mania' => [
            '4k' => '4K',
            '7k' => '7K',
            'all' => 'Усі',
        ],
    ],
];

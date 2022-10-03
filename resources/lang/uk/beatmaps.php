<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'discussion-votes' => [
        'update' => [
            'error' => 'Не вдається оновити голос',
        ],
    ],

    'discussions' => [
        'allow_kudosu' => 'дозволити кудосу',
        'beatmap_information' => 'Сторінка бітмапи',
        'delete' => 'видалити',
        'deleted' => 'Видалено :editor :delete_time.',
        'deny_kudosu' => 'заборонити кудосу',
        'edit' => 'змінити',
        'edited' => 'Останнє редагування :editor :update_time.',
        'guest' => 'Гостьова складність від :user',
        'kudosu_denied' => 'Відмовлено в отриманні кудосу.',
        'message_placeholder_deleted_beatmap' => 'Ця складність була видалена, і більше вона не може бути обговорена.',
        'message_placeholder_locked' => 'Обговорення цієї бітмапи відключено.',
        'message_placeholder_silenced' => "Не можна коментувати поки заглушений.",
        'message_type_select' => 'Вибрати тип коментаря',
        'reply_notice' => 'Натисніть Enter для відповіді.',
        'reply_placeholder' => 'Введіть відповідь тут',
        'require-login' => 'Будь ласка, ввійдіть що б створювати пости або відповідати на них',
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
            'hidden' => 'Жодна дискусія не відповідає вибраному фільтру.',
        ],

        'lock' => [
            'button' => [
                'lock' => 'Заблокувати дискусію',
                'unlock' => 'Розблокувати дискусію',
            ],

            'prompt' => [
                'lock' => 'Причина блокування',
                'unlock' => 'Ви впевнені, що хочете розблокувати дискусію?',
            ],
        ],

        'message_hint' => [
            'in_general' => 'Цей пост потрапить в загальну гілку обговорень. Щоб почати модерувати цю мапу, почніть своє повідомлення з зазначенням часу (наприклад 00:12:345).',
            'in_timeline' => 'Для модингу декількох часових позначок, зробіть декілька дискусій (одна дискусія на позначку).',
        ],

        'message_placeholder' => [
            'general' => 'Пишіть тут, щоб розмістити дискусію в Загальний (:version)',
            'generalAll' => 'Пишіть тут, щоб розмістити дискусію в Загальний (Всі складності)',
            'review' => 'Пишіть тут, щоб розмістити відгук',
            'timeline' => 'Пишіть тут, щоб розмістити дискусію на шкалі часу (:version)',
        ],

        'message_type' => [
            'disqualify' => 'Дискваліфікувати',
            'hype' => 'Хайпнути!',
            'mapper_note' => 'Замітка',
            'nomination_reset' => 'Зняти номінацію',
            'praise' => 'Похвалити',
            'problem' => 'Проблема',
            'problem_warning' => 'Повідомити про проблему',
            'review' => 'Відгук',
            'suggestion' => 'Пропозиція',
        ],

        'mode' => [
            'events' => 'Історія',
            'general' => 'Загальні :scope',
            'reviews' => 'Відгуки',
            'timeline' => 'Шкала часу',
            'scopes' => [
                'general' => 'Ця складність',
                'generalAll' => 'Всі складності',
            ],
        ],

        'new' => [
            'pin' => 'Закріпити',
            'timestamp' => 'Мітка часу',
            'timestamp_missing' => 'натисніть ctrl-c в редакторі та вставте в повідомлення щоб додати мітку часу!',
            'title' => 'Нова дискусія',
            'unpin' => 'Відкріпити',
        ],

        'review' => [
            'new' => 'Новий відгук',
            'embed' => [
                'delete' => 'Видалити',
                'missing' => '[ДИСКУСІЯ ВИДАЛЕНА]',
                'unlink' => 'Відв\'язати',
                'unsaved' => 'Не збережено',
                'timestamp' => [
                    'all-diff' => 'Пости в "Всіх складнощах" не можуть мати часових відміток.',
                    'diff' => 'Якщо цей :type починається з часової відмітки, його буде показано в Шкалі часу.',
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
            'pending' => 'Не вирішені',
            'praises' => 'Похвали',
            'resolved' => 'Вирішені',
            'total' => 'Всі',
        ],

        'status-messages' => [
            'approved' => 'Ця карта була схвалена :date!',
            'graveyard' => "Ця карта не оновлювалася вже з :date і здається автор її покинув...",
            'loved' => 'Ця карта була визнана "улюбленою" :date!',
            'ranked' => 'Ця карта потрапила в рейтингові :date!',
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
        'required_text' => 'Хайпи: :current/:required',
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
        'disqualified_at' => 'Дискваліфіковано :time_ago (:reason).',
        'disqualified_no_reason' => 'без причини',
        'disqualify' => 'Дискваліфікувати',
        'incorrect_state' => 'Помилка під час виконання цієї дії, спробуйте оновити сторінку.',
        'love' => 'Улюблені',
        'love_choose' => 'Виберіть складність для улюблених',
        'love_confirm' => 'Відмітити карту як улюблену?',
        'nominate' => 'Номінувати',
        'nominate_confirm' => 'Номінувати цю карту?',
        'nominated_by' => 'отримала номінацію від :users',
        'not_enough_hype' => "Недостатньо хайпів.",
        'remove_from_loved' => 'Вилучено з категорії Улюблені',
        'remove_from_loved_prompt' => 'Причина вилучення від категорії Улюблені:',
        'required_text' => 'Номінації: :current/:required',
        'reset_message_deleted' => 'видалено',
        'title' => 'Статус номінації',
        'unresolved_issues' => 'Є ще деякі проблеми, які потребують першочергового вирішення.',

        'rank_estimate' => [
            '_' => 'Ця мапа стане рейтинговою :date, якщо ніяких проблем не буде знайдено. Вона #:position в :queue.',
            'queue' => 'черзі на рейтинг',
            'soon' => 'дуже скоро',
        ],

        'reset_at' => [
            'nomination_reset' => ':time_ago номінація була знята :user через нову проблему :discussion (:message)',
            'disqualify' => ':time_ago :user дискваліфікував карту через нову проблему :discussion (:message).',
        ],

        'reset_confirm' => [
            'disqualify' => 'Впевнені? Це зніме кваліфікацію з карти й скине прогрес номінування.',
            'nomination_reset' => 'Ви впевнені? Повідомлення про нову проблему скине прогрес номінації.',
            'problem_warning' => 'Ви впевнені що ви хочете повідомити про проблеми на цій карті? Це звернення сповістить Номінаторів Карт.',
        ],
    ],

    'listing' => [
        'search' => [
            'prompt' => 'почніть вводити ключові слова...',
            'login_required' => 'Ввійдіть, для використання пошуку.',
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
                'favourites' => 'Вподобані',
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
        'featured_artists' => 'Обрані виконавці',
        'follows' => 'Маппери на яких ви підписані',
        'recommended' => 'Рекомендована складність',
        'spotlights' => 'Популярні карти',
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
        'favourites' => 'Вподобані',
        'graveyard' => 'Закинуті',
        'leaderboard' => 'З таблицею рекордів',
        'loved' => 'Улюблені',
        'mine' => 'Мої карти',
        'pending' => 'На розгляді',
        'wip' => 'В розробці',
        'qualified' => 'Кваліфіковані',
        'ranked' => 'Рейтингові',
    ],
    'genre' => [
        'any' => 'Всі',
        'unspecified' => 'Не визначений',
        'video-game' => 'Відеоігри',
        'anime' => 'Аніме',
        'rock' => 'Рок',
        'pop' => 'Поп',
        'other' => 'Інші',
        'novelty' => 'Нестандартні',
        'hip-hop' => 'Хіп-хоп',
        'electronic' => 'Електро',
        'metal' => 'Метал',
        'classical' => 'Класична',
        'folk' => 'Народна',
        'jazz' => 'Джаз',
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
        'storyboard' => 'Має сторіборд',
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
        'favourites' => 'Вподобаних: :count',
    ],
    'variant' => [
        'mania' => [
            '4k' => '4K',
            '7k' => '7K',
            'all' => 'Усі',
        ],
    ],
];

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
            'error' => 'Не вдається зберегти публікацію',
        ],
    ],

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
        'kudosu_denied' => 'Відмовлено в отриманні кудосу.',
        'message_placeholder_deleted_beatmap' => 'Ця складність була видалена і відгукуватися про неї не можна.',
        'message_placeholder_locked' => 'Обговорення цієї карти відключено.',
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
            'general' => 'Напишіть тут, щоб розмістити повідомлення в Загальний (:version)',
            'generalAll' => 'Введіть тут, щоб запостити в Загальний (Всі складності)',
            'timeline' => 'Введіть тут, щоб запостити в шкалу часу (:version)',
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
        'love_confirm' => 'Відмітити карту як улюблену?',
        'nominate' => 'Номінувати',
        'nominate_confirm' => 'Номінувати цю карту?',
        'nominated_by' => 'номінована :users',
        'not_enough_hype' => "Недостатньо хайпа.",
        'qualified' => 'Якщо більше не буде проблем, то карта отримає ранговий статус приблизно :date.',
        'qualified_soon' => 'Якщо більше не буде проблем, то карта отримає ранговий статус дуже скоро.',
        'required_text' => 'Номінації: :current/:required',
        'reset_message_deleted' => 'видалено',
        'title' => 'Статус номінації',
        'unresolved_issues' => 'Є ще деякі проблеми, які потребують вирішення.',

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
            'supporter_filter' => 'Фільтрація по :filters потребує наявності osu!supporter',
            'not-found' => 'немає результатів',
            'not-found-quote' => '... на жаль, нічого не знайдено.',
            'filters' => [
                'general' => 'Загальні',
                'mode' => 'Режим',
                'status' => 'Категорії',
                'genre' => 'Жанр',
                'language' => 'Мова',
                'extra' => 'додатково',
                'rank' => 'Досягнутий ранг',
                'played' => 'Зіграно',
            ],
            'sorting' => [
                'title' => 'назві',
                'artist' => 'виконавцю',
                'difficulty' => 'складністю',
                'favourites' => 'Вибране',
                'updated' => 'датою оновлення',
                'ranked' => 'рангу',
                'rating' => 'рейтингу',
                'plays' => 'кількістю ігор',
                'relevance' => 'релевантності',
                'nominations' => 'номінаціями',
            ],
            'supporter_filter_quote' => [
                '_' => 'Фільтрація по :filters вимагає :link',
                'link_text' => 'тег osu!supporter',
            ],
        ],
    ],
    'general' => [
        'recommended' => 'рекомендована складність',
        'converts' => 'показувати конвертовані карти',
    ],
    'mode' => [
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
        'Relax' => '',
        'SD' => '',
        'SO' => '',
        'TD' => '',
    ],
    'language' => [
        'any' => '',
        'english' => 'Англійська',
        'chinese' => 'Китайська',
        'french' => 'Французька',
        'german' => 'Німецька',
        'italian' => 'Італійська',
        'japanese' => 'Японська',
        'korean' => 'Корейська',
        'spanish' => 'Іспанська',
        'swedish' => 'Шведська',
        'instrumental' => 'Інструментальна',
        'other' => 'Інше',
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
];

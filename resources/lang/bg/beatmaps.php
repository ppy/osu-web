<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'discussion-votes' => [
        'update' => [
            'error' => 'Неуспешно актуализиране на гласуването',
        ],
    ],

    'discussions' => [
        'allow_kudosu' => 'разреши kudosu',
        'beatmap_information' => 'Страница на бийтмап',
        'delete' => 'изтриване',
        'deleted' => 'Изтрито от :editor :delete_time.',
        'deny_kudosu' => 'забрани kudosu',
        'edit' => 'редактиране',
        'edited' => 'Последно редактирано от :editor :update_time.',
        'guest' => 'Трудност, предложена от :user',
        'kudosu_denied' => 'Забранено получаване на kudosu.',
        'message_placeholder_deleted_beatmap' => 'Тази трудност е изтрита, затова вече не може да се обсъжда.',
        'message_placeholder_locked' => 'Изключена е дискусията за този бийтмап.',
        'message_placeholder_silenced' => "Не може да публикувате дискусии, докато сте заглушени.",
        'message_type_select' => 'Избор на вид коментар',
        'reply_notice' => 'Натисни enter за отговор.',
        'reply_placeholder' => 'Въведете вашия отговор тук',
        'require-login' => 'Моля, влез в профила си, за публикуване или отговор',
        'resolved' => 'Приключен',
        'restore' => 'възстанови',
        'show_deleted' => 'Покажи изтрити',
        'title' => 'Дискусии',

        'collapse' => [
            'all-collapse' => 'Свий всички',
            'all-expand' => 'Разшири всички',
        ],

        'empty' => [
            'empty' => 'Няма дискусии все още!',
            'hidden' => 'Не е намерена дискусия за избрания критерий.',
        ],

        'lock' => [
            'button' => [
                'lock' => 'Заключи дискусия',
                'unlock' => 'Отключи дискусия',
            ],

            'prompt' => [
                'lock' => 'Причина за заключване',
                'unlock' => 'Наистина ли искате да отключите?',
            ],
        ],

        'message_hint' => [
            'in_general' => 'Тази публикация ще отиде при общата дискусия. За да редактирате тази трудност, започнете съобщение с времеви етикет (напр. 00:12:345).',
            'in_timeline' => 'При редактиране на няколко времеви етикета, напишете публикация за всеки етикет.',
        ],

        'message_placeholder' => [
            'general' => 'Пишете тук, за публикуване в Обща (:version)',
            'generalAll' => 'Пишете тук, за публикуване в Обща (Всички трудности)',
            'review' => 'Пишете тук, за публикуване на ревю',
            'timeline' => 'Пишете тук, за публикуване във Времева лента (:version)',
        ],

        'message_type' => [
            'disqualify' => 'Дисквалифициране',
            'hype' => 'Надъхване!',
            'mapper_note' => 'Бележка',
            'nomination_reset' => 'Анулиране на номинация',
            'praise' => 'Похвала',
            'problem' => 'Проблем',
            'review' => 'Ревю',
            'suggestion' => 'Предложение',
        ],

        'mode' => [
            'events' => 'История',
            'general' => 'Обща :scope',
            'reviews' => 'Ревюта',
            'timeline' => 'Времева лента',
            'scopes' => [
                'general' => 'Тази трудност',
                'generalAll' => 'Всички трудности',
            ],
        ],

        'new' => [
            'pin' => 'Закачи',
            'timestamp' => 'Времева отметка',
            'timestamp_missing' => 'ctrl-c в редактор и вмъкнете вашето съобщение, за добавяне на времеви етикет!',
            'title' => 'Нова дискусия',
            'unpin' => 'Откачи',
        ],

        'review' => [
            'new' => 'Ново ревю',
            'embed' => [
                'delete' => 'Изтриване',
                'missing' => '[ИЗТРИТА ДИСКУСИЯ]',
                'unlink' => 'Премахни връзка',
                'unsaved' => 'Незапазено',
                'timestamp' => [
                    'all-diff' => 'Публикациите за "Всички трудности" не могат да имат времеви отметки.',
                    'diff' => 'Ако този :type започва с времева отметка, ще бъде показана под времевата лента.',
                ],
            ],
            'insert-block' => [
                'paragraph' => 'добави параграф',
                'praise' => 'добави похвала',
                'problem' => 'добави проблем',
                'suggestion' => 'добави предложение',
            ],
        ],

        'show' => [
            'title' => ':title е създаден от :mapper',
        ],

        'sort' => [
            'created_at' => 'Време на създаване',
            'timeline' => 'Времева лента',
            'updated_at' => 'Последно обновяване',
        ],

        'stats' => [
            'deleted' => 'Изтрито',
            'mapper_notes' => 'Бележки',
            'mine' => 'Мои',
            'pending' => 'Чакащи',
            'praises' => 'Похвали',
            'resolved' => 'Разрешени',
            'total' => 'Всички',
        ],

        'status-messages' => [
            'approved' => 'Този бийтмап е одобрен на :date!',
            'graveyard' => "Този бийтмап не е актуализиран от :date и затова е в гробището...",
            'loved' => 'Този бийтмап е добавен в обичани на :date!',
            'ranked' => 'Този бийтмап е класиран на :date!',
            'wip' => 'Забележка: Този бийтмап е означен от създателя като "работа в прогрес".',
        ],

        'votes' => [
            'none' => [
                'down' => 'Все още няма отрицателни оценки',
                'up' => 'Все още няма положителни оценки',
            ],
            'latest' => [
                'down' => 'Последни отрицателни оценки',
                'up' => 'Последни положителни оценки',
            ],
        ],
    ],

    'hype' => [
        'button' => 'Надъхване на бийтмапа!',
        'button_done' => 'Вече е надъхан!',
        'confirm' => "Сигурни ли сте? Ще бъде използвано едно от вашите :n надъхвания и не може да бъде отменено.",
        'explanation' => 'Надъхай този бийтмап, за увеличаване на шансовете му да бъде номиниран и класиран!',
        'explanation_guest' => 'Влез в профила си и надъхай този бийтмап, за увеличаване на шансовете му да бъде номиниран и класиран!',
        'new_time' => "Ще получите друго надъхване :new_time.",
        'remaining' => 'Имате :remaining надъхвания останали.',
        'required_text' => 'Надъхване: :current/:required',
        'section_title' => 'Надъхващ влак',
        'title' => 'Надъхване',
    ],

    'feedback' => [
        'button' => 'Оставяне на отзив',
    ],

    'nominations' => [
        'delete' => 'Изтриване',
        'delete_own_confirm' => 'Сигурни ли сте? Бийтмапът ще бъде изтрит и ще бъдете пренасочени обратно към вашия профил.',
        'delete_other_confirm' => 'Сигурни ли сте? Бийтмапът ще бъде изтрит и ще бъдете пренасочени обратно към профила на потребителя.',
        'disqualification_prompt' => 'Причина за дисквалифициране?',
        'disqualified_at' => 'Дисквалифициран :time_ago (:reason).',
        'disqualified_no_reason' => 'няма определена причина',
        'disqualify' => 'Дисквалифициране',
        'incorrect_state' => 'Грешка при извършване на това действие, опитайте да презаредите страницата.',
        'love' => 'Обич',
        'love_choose' => 'Избери трудност за обичан',
        'love_confirm' => 'Обич за този бийтмап?',
        'nominate' => 'Номиниране',
        'nominate_confirm' => 'Номиниране на този бийтмап?',
        'nominated_by' => 'номиниран от :users',
        'not_enough_hype' => "Няма достатъчно надъхванe.",
        'remove_from_loved' => 'Премахване от обичани',
        'remove_from_loved_prompt' => 'Причина за премахване от обичани:',
        'required_text' => 'Номинации: :current/:required',
        'reset_message_deleted' => 'изтрито',
        'title' => 'Статус на номиниране',
        'unresolved_issues' => 'Все още има нерешени проблеми, те трябва да бъдат проверени първо.',

        'rank_estimate' => [
            '_' => 'Този бийтмап ще бъде класиран на :date ако не открием проблеми. Той е #:position на :queue.',
            'queue' => 'опашката',
            'soon' => 'скоро',
        ],

        'reset_at' => [
            'nomination_reset' => 'Процесът за номиниране е анулиран :time_ago от :user заради нов проблем :discussion (:message).',
            'disqualify' => 'Дисквалифициран :time_ago от :user заради нов проблем :discussion (:message).',
        ],

        'reset_confirm' => [
            'nomination_reset' => 'Сигурни ли сте? Публикуването на нов проблем ще анулира процесът за номиниране.',
            'disqualify' => 'Сигурни ли сте? Това ще премахне бийтмапа от квалификации и ще занули процеса по номиниране.',
        ],
    ],

    'listing' => [
        'search' => [
            'prompt' => 'въведи ключови думи...',
            'login_required' => 'Моля, влез в профила си, за търсене.',
            'options' => 'Повече опции за търсене',
            'supporter_filter' => 'Подреждане по :filters изисква активен osu!supporter',
            'not-found' => 'няма намерени резултати',
            'not-found-quote' => '... не, нищо не е намерено.',
            'filters' => [
                'extra' => 'Екстри',
                'general' => 'Общи',
                'genre' => 'Жанр',
                'language' => 'Език',
                'mode' => 'Игра',
                'nsfw' => 'Explicit съдържание',
                'played' => 'Изигран',
                'rank' => 'Постигнат ранг',
                'status' => 'Категоря',
            ],
            'sorting' => [
                'title' => 'Заглавие',
                'artist' => 'Изпълнител',
                'difficulty' => 'Трудност',
                'favourites' => 'Любими',
                'updated' => 'Обновен',
                'ranked' => 'Класиран',
                'rating' => 'Рейтинг',
                'plays' => 'Изигран',
                'relevance' => 'Уместност',
                'nominations' => 'Номинации',
            ],
            'supporter_filter_quote' => [
                '_' => 'Подреждане по :filters изисква активен :link',
                'link_text' => 'osu!supporter',
            ],
        ],
    ],
    'general' => [
        'converts' => 'Включи конвертирани бийтмапове',
        'featured_artists' => 'Представени автори',
        'follows' => 'Абонирани създатели',
        'recommended' => 'Препоръчана трудност',
    ],
    'mode' => [
        'all' => 'Всички',
        'any' => 'Всяка',
        'osu' => '',
        'taiko' => '',
        'fruits' => '',
        'mania' => '',
    ],
    'status' => [
        'any' => 'Всяка',
        'approved' => 'Одобрен',
        'favourites' => 'Любими',
        'graveyard' => 'Гробище',
        'leaderboard' => 'Има таблица с класации',
        'loved' => 'Обичан',
        'mine' => 'Мои бийтмапове',
        'pending' => 'Изчаква одобрение или недовършен',
        'qualified' => 'Квалифициран',
        'ranked' => 'Класиран',
    ],
    'genre' => [
        'any' => 'Всеки',
        'unspecified' => 'Неопределен',
        'video-game' => 'Видеоигра',
        'anime' => 'Аниме',
        'rock' => 'Рок',
        'pop' => 'Поп',
        'other' => 'Друг',
        'novelty' => 'Новела',
        'hip-hop' => 'Хип-Хоп',
        'electronic' => 'Електронна',
        'metal' => 'Метъл',
        'classical' => 'Класическа',
        'folk' => 'Фолк',
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
        'any' => 'Всеки',
        'english' => 'Английски',
        'chinese' => 'Китайски',
        'french' => 'Френски',
        'german' => 'Немски',
        'italian' => 'Италиански',
        'japanese' => 'Японски',
        'korean' => 'Корейски',
        'spanish' => 'Испански',
        'swedish' => 'Шведски',
        'russian' => 'Руски',
        'polish' => 'Полски',
        'instrumental' => 'Инструментал',
        'other' => 'Друг',
        'unspecified' => 'Неопределен',
    ],

    'nsfw' => [
        'exclude' => 'Скрито',
        'include' => 'Видимо',
    ],

    'played' => [
        'any' => 'Всички',
        'played' => 'Изигран',
        'unplayed' => 'Неизигран',
    ],
    'extra' => [
        'video' => 'Видео',
        'storyboard' => 'Анимирана история',
    ],
    'rank' => [
        'any' => 'Всички',
        'XH' => 'Сребърен SS',
        'X' => '',
        'SH' => 'Сребърен S',
        'S' => '',
        'A' => '',
        'B' => '',
        'C' => '',
        'D' => '',
    ],
    'panel' => [
        'playcount' => 'Брой игри: :count',
        'favourites' => 'Любими: :count',
    ],
    'variant' => [
        'mania' => [
            '4k' => '4K',
            '7k' => '7K',
            'all' => 'Всички',
        ],
    ],
];

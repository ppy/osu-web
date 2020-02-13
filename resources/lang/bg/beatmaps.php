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
            'error' => 'Неуспешно запазване на публикацията',
        ],
    ],

    'discussion-votes' => [
        'update' => [
            'error' => 'Неуспешно актуализиране на гласуването',
        ],
    ],

    'discussions' => [
        'allow_kudosu' => 'разреши kudosu',
        'beatmap_information' => '',
        'delete' => 'изтрий',
        'deleted' => 'Изтрито от :editor :delete_time.',
        'deny_kudosu' => 'забрани kudosu',
        'edit' => 'редактирай',
        'edited' => 'Последно редактирано от :editor :update_time.',
        'kudosu_denied' => 'Забранено получаване на kudosu.',
        'message_placeholder_deleted_beatmap' => 'Тази трудност е била изтрита, така че тя вече не може да се обсъжда.',
        'message_placeholder_locked' => '',
        'message_type_select' => 'Изберете тип на коментар',
        'reply_notice' => 'Натиснете enter за да отговорите.',
        'reply_placeholder' => 'Въведете вашия отговор тук',
        'require-login' => 'Моля влезте в профила си за да публикувате или отговорите',
        'resolved' => 'Разрешени',
        'restore' => 'възстанови',
        'show_deleted' => 'Покажи изтритите',
        'title' => 'Дискусии',

        'collapse' => [
            'all-collapse' => 'Свий всички',
            'all-expand' => 'Разшири всички',
        ],

        'empty' => [
            'empty' => 'Няма дискусии все още!',
            'hidden' => 'Няма дискусия която съвпада с избрания филтър.',
        ],

        'lock' => [
            'button' => [
                'lock' => 'Заключи дискусията',
                'unlock' => 'Отключи дискусията',
            ],

            'prompt' => [
                'lock' => 'Причина за заключването',
                'unlock' => 'Сигурни ли сте, че искате да отключите дискусията?',
            ],
        ],

        'message_hint' => [
            'in_general' => 'Този пост ще отиде при общата дискусия. За да моднете този бийтмап, започнете с времев етикет (напр. 00:12:345).',
            'in_timeline' => 'За модване на повече времеви етикети, постнете за всяка отделно.',
        ],

        'message_placeholder' => [
            'general' => 'Пишете тук, за да публикувате в General (:version)',
            'generalAll' => 'Пишете тук, за да публикувате в General (Всички трудности)',
            'timeline' => 'Пишете тук, за да публикувате в Timeline (:version)',
        ],

        'message_type' => [
            'disqualify' => 'Дисквалифицирайте',
            'hype' => 'Надъхайте!',
            'mapper_note' => 'Бележка',
            'nomination_reset' => 'Анулирай Номинацията',
            'praise' => 'Възхвали',
            'problem' => 'Проблем',
            'review' => '',
            'suggestion' => 'Предложение',
        ],

        'mode' => [
            'events' => 'История',
            'general' => 'Обща :scope',
            'reviews' => '',
            'timeline' => 'Времева лента',
            'scopes' => [
                'general' => 'Тази трудност',
                'generalAll' => 'Всички трудности',
            ],
        ],

        'new' => [
            'pin' => 'Закачи',
            'timestamp' => 'Времев етикет',
            'timestamp_missing' => 'ctrl-c в редактора и вмъкнете вашето съобщение, за да добавите времев етикет!',
            'title' => 'Нова Дискусия',
            'unpin' => 'Откачи',
        ],

        'show' => [
            'title' => ':title, съпоставен от :mapper',
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
            'pending' => 'Чакащо',
            'praises' => 'Възхвали',
            'resolved' => 'Разрешен',
            'total' => 'Всички',
        ],

        'status-messages' => [
            'approved' => 'Този бийтмап е бил одобрен на :date!',
            'graveyard' => "Този бийтмап не е бил актуализиран от :date и най-вероятно е бил изоставен от създателя...",
            'loved' => 'Този бийтмап е добавен в обичани на :date!',
            'ranked' => 'Този бийтмап е бил класиран на :date!',
            'wip' => 'Забележка: Този бийтмап е маркиран като работа в прогрес от създателя.',
        ],

        'votes' => [
            'none' => [
                'down' => '',
                'up' => '',
            ],
            'latest' => [
                'down' => '',
                'up' => '',
            ],
        ],
    ],

    'hype' => [
        'button' => 'Надъхай Бийтмапа!',
        'button_done' => 'Вече е Надъхан!',
        'confirm' => "Сигурни ли сте? Това ще използва едно от вашите останали :n надъхвания и не може да бъде отменено.",
        'explanation' => 'Надъхайте този бийтмап за да го направите по-видим за номинация и класиране!',
        'explanation_guest' => 'Влезте в профила си и надъхайте този бийтмап, за да го направите по-видим за номинация и класиране!',
        'new_time' => "Вие ще получите друго надъхване :new_time.",
        'remaining' => 'Вие имате :remaining надъхвания останали.',
        'required_text' => 'Надъхване: :current/:required',
        'section_title' => 'Приоритет',
        'title' => 'Надъхване',
    ],

    'feedback' => [
        'button' => 'Остави Отзив',
    ],

    'nominations' => [
        'delete' => 'Изтрий',
        'delete_own_confirm' => 'Сигурни ли сте? Бийтмапът ще бъде изтрит и ще бъдете пренасочени обратно към вашия профил.',
        'delete_other_confirm' => 'Сигурни ли сте? Бийтмапът ще бъде изтрит и ще бъдете пренасочени обратно към профила на потребителя.',
        'disqualification_prompt' => 'Причина за дисквалифициране?',
        'disqualified_at' => 'Дисквалифициран :time_ago (:reason).',
        'disqualified_no_reason' => 'няма определена причина',
        'disqualify' => 'Дисквалифицирайте',
        'incorrect_state' => 'Грешка при извършване на това действие, опитайте да презаредите страницата.',
        'love' => 'Обич',
        'love_confirm' => 'Маркирайте този бийтмап като любим?',
        'nominate' => 'Номинирай',
        'nominate_confirm' => 'Номинирай този бийтмап?',
        'nominated_by' => 'номиниран от :users',
        'not_enough_hype' => "",
        'qualified' => 'Очаква се да бъде класиран :date, ако няма открити проблеми.',
        'qualified_soon' => 'Очаква се да бъде класиран скоро, ако няма открити проблеми.',
        'required_text' => 'Номинации: :current/:required',
        'reset_message_deleted' => 'изтрито',
        'title' => 'Статус на Номиниране',
        'unresolved_issues' => 'Все още има нерешени проблеми, те трябва да бъдат проверени първо.',

        'reset_at' => [
            'nomination_reset' => 'Номинационният процес е бил нулиран :time_ago от :user заради нов проблем :discussion (:message).',
            'disqualify' => 'Дисквалифициран :time_ago от :user заради нов проблем :discussion (:message).',
        ],

        'reset_confirm' => [
            'nomination_reset' => 'Сигурен ли сте? Публикуването на нов проблем ще нулира номинационният процес.',
            'disqualify' => 'Сигурни ли сте? Това ще премахне бийтмапа от квалифицирания му статус и ще нулира целия процес на номинация.',
        ],
    ],

    'listing' => [
        'search' => [
            'prompt' => 'въведи ключови думи...',
            'login_required' => 'Влезте си в акаунта за търсене.',
            'options' => 'Повече опции за търсене',
            'supporter_filter' => 'Филтриране по :filters изисква активен osu!supporter',
            'not-found' => 'няма намерени резултати',
            'not-found-quote' => '... не, нищо не е намерено.',
            'filters' => [
                'general' => 'Общо',
                'mode' => 'Игра',
                'status' => 'Категории',
                'genre' => 'Жанр',
                'language' => 'Език',
                'extra' => 'екстра',
                'rank' => 'Постигнат Ранг',
                'played' => 'Изигран',
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
                '_' => 'Филтриране по :filters изисква активен :link',
                'link_text' => 'osu!supporter tag',
            ],
        ],
    ],
    'general' => [
        'recommended' => 'Препоръчана трудност',
        'converts' => 'Включи конвертирани бийтмапове',
    ],
    'mode' => [
        'any' => 'Всички',
        'osu' => '',
        'taiko' => '',
        'fruits' => '',
        'mania' => '',
    ],
    'status' => [
        'any' => 'Всички',
        'approved' => 'Одобрени',
        'favourites' => '',
        'graveyard' => 'Гробище',
        'leaderboard' => '',
        'loved' => 'Обичани',
        'mine' => '',
        'pending' => 'Изчакващи одобрение или недовършени',
        'qualified' => 'Квалифицирани',
        'ranked' => '',
    ],
    'genre' => [
        'any' => 'Всички',
        'unspecified' => 'Неопределени',
        'video-game' => 'Видеоигра',
        'anime' => 'Аниме',
        'rock' => 'Рок',
        'pop' => 'Поп',
        'other' => 'Други',
        'novelty' => 'Новела',
        'hip-hop' => 'Хип-Хоп',
        'electronic' => 'Електронна',
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
        'english' => 'Английски',
        'chinese' => 'Китайски',
        'french' => 'Френски',
        'german' => 'Немски',
        'italian' => 'Италиански',
        'japanese' => 'Японски',
        'korean' => 'Корейски',
        'spanish' => 'Испански',
        'swedish' => 'Шведски',
        'instrumental' => 'Инструментал',
        'other' => 'Други',
    ],
    'played' => [
        'any' => 'Всички',
        'played' => 'Изиграни',
        'unplayed' => 'Неизиграни',
    ],
    'extra' => [
        'video' => 'С Видео',
        'storyboard' => 'Със Сториборд',
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
];

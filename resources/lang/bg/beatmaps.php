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
    'discussion-posts' => [
        'store' => [
            'error' => 'Неуспешно запазване на пост',
        ],
    ],

    'discussion-votes' => [
        'update' => [
            'error' => 'Неуспешно актуализиране на гласуването',
        ],
    ],

    'discussions' => [
        'allow_kudosu' => 'разреши kudosu',
        'delete' => 'изтрий',
        'deleted' => 'Изтрито от :editor :delete_time.',
        'deny_kudosu' => 'забрани kudosu',
        'edit' => 'редактирай',
        'edited' => 'Последно редактирано от :editor :update_time.',
        'kudosu_denied' => 'Забранено получаване на kudosu.',
        'message_placeholder_deleted_beatmap' => 'Тази трудност е била изтрита, така че тя вече не може да се обсъжда.',
        'message_type_select' => 'Изберете тип на коментар',
        'reply_notice' => 'Натиснете enter за да отговорите.',
        'reply_placeholder' => 'Въведете вашия отговор тук',
        'require-login' => 'Моля влезте в профила си за да публикувате или отговорите',
        'resolved' => 'Разрешени',
        'restore' => 'възстанови',
        'title' => 'Дискусии',

        'collapse' => [
            'all-collapse' => 'Затвори всички',
            'all-expand' => 'Разшири всички',
        ],

        'empty' => [
            'empty' => 'Няма дискусии все още!',
            'hidden' => 'Няма дискусия която съвпада с избрания филтър.',
        ],

        'message_hint' => [
            'in_general' => 'Този пост ще отиде при общата дискусия. За да моднете този бийтмап, започнете с времев етикет (напр. 00:12:345).',
            'in_timeline' => 'За модване на повече времеви етикети, постнете за всяка отделно.',
        ],

        'message_placeholder' => [
            'general' => '',
            'generalAll' => '',
            'timeline' => '',
        ],

        'message_type' => [
            'disqualify' => 'Дисквалифицирайте',
            'hype' => 'Надъхайте!',
            'mapper_note' => 'Бележка',
            'nomination_reset' => 'Анулирай Номинацията',
            'praise' => 'Възхвали',
            'problem' => 'Проблем',
            'suggestion' => 'Предложение',
        ],

        'mode' => [
            'events' => 'История',
            'general' => 'Обща :scope',
            'timeline' => 'Времева лента',
            'scopes' => [
                'general' => 'Тази трудност',
                'generalAll' => 'Всички трудности',
            ],
        ],

        'new' => [
            'timestamp' => 'Времев етикет',
            'timestamp_missing' => 'ctrl-c в редактора и вмъкнете вашето съобщение, за да добавите времев етикет!',
            'title' => 'Нова Дискусия',
        ],

        'show' => [
            'title' => ':title, съпоставен от :mapper',
        ],

        'sort' => [
            '_' => 'Сортирани по:',
            'created_at' => 'време на създаване',
            'timeline' => 'времева лента',
            'updated_at' => 'последна актуализация',
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
        'disqualification_prompt' => 'Причина за дисквалифициране?',
        'disqualified_at' => 'Дисквалифициран :time_ago (:reason).',
        'disqualified_no_reason' => 'няма определена причина',
        'disqualify' => 'Дисквалифицирайте',
        'incorrect_state' => 'Грешка при извършване на това действие, опитайте да презаредите страницата.',
        'love' => '',
        'love_confirm' => '',
        'nominate' => 'Номинирай',
        'nominate_confirm' => 'Номинирай този бийтмап?',
        'nominated_by' => 'номиниран от :users',
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
        ],
    ],

    'listing' => [
        'search' => [
            'prompt' => 'въведи ключови думи...',
            'login_required' => '',
            'options' => 'Повече опции за търсене',
            'supporter_filter' => '',
            'not-found' => 'няма намерени резултати',
            'not-found-quote' => '... не, нищо не е намерено.',
            'filters' => [
                'general' => 'Общо',
                'mode' => 'Игра',
                'status' => '',
                'genre' => 'Жанр',
                'language' => 'Език',
                'extra' => 'екстра',
                'rank' => 'Постигнат Ранк',
                'played' => 'Изигран',
            ],
            'sorting' => [
                'title' => 'заглавие',
                'artist' => 'артист',
                'difficulty' => 'трудност',
                'updated' => 'актуализиран',
                'ranked' => 'класиран',
                'rating' => 'рейтинг',
                'plays' => 'изигран',
                'relevance' => 'уместност',
                'nominations' => 'номинации',
            ],
            'supporter_filter_quote' => [
                '_' => '',
                'link_text' => '',
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
        'ranked-approved' => 'Класирани и Одобрени',
        'approved' => 'Одобрени',
        'qualified' => 'Квалифицирани',
        'loved' => 'Обичани',
        'faves' => 'Фаворити',
        'pending' => '',
        'graveyard' => 'Гробище',
        'my-maps' => 'Моите Мапове',
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
];

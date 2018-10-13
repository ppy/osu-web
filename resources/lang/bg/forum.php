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
    'pinned_topics' => 'Прикрепени теми',
    'slogan' => "опасно е да играете сами.",
    'subforums' => 'Подфоруми',
    'title' => 'osu! форум',

    'covers' => [
        'create' => [
            '_' => 'Задай изображение за корицата',
            'button' => 'Качи изображение',
            'info' => 'Размерът на изображението за корицата трябва да е с размер :dimensions. Можете също да поставите файла на изображението тук да качите.',
        ],

        'destroy' => [
            '_' => 'Премахни изображението на корицата',
            'confirm' => 'Сигурни ли сте, че искате да премахнете изображението на корицата?',
        ],
    ],

    'email' => [
        'new_reply' => '[osu!] Нов отговор на темата ":title"',
    ],

    'forums' => [
        'topics' => [
            'empty' => 'Няма теми!',
        ],
    ],

    'post' => [
        'confirm_destroy' => 'Наистина ли искате да изтриете публикацията?',
        'confirm_restore' => 'Наистина ли искате да възстановите публикацията?',
        'edited' => 'Последно редактирано от :user :when, Редактирано общо :count пъти.',
        'posted_at' => 'публикувано :when',

        'actions' => [
            'destroy' => 'Изтрий публикацията',
            'restore' => 'Възстанови публикацията',
            'edit' => 'Редактиране на публикацията',
        ],
    ],

    'search' => [
        'go_to_post' => 'Отиди до публикацията',
        'post_number_input' => 'въведете номер на публикацията',
        'total_posts' => 'общо :posts_count публикации',
    ],

    'topic' => [
        'deleted' => 'изтрита тема',
        'go_to_latest' => 'виж най-новата публикация',
        'latest_post' => ':when от :user',
        'latest_reply_by' => 'последният отговор от :user',
        'new_topic' => 'Създай нова тема',
        'new_topic_login' => 'Влезте в профила си, за да публикувате нова тема',
        'post_reply' => 'Публикувай',
        'reply_box_placeholder' => 'Пишете тук да отговорите',
        'reply_title_prefix' => 'Отговор',
        'started_by' => 'от :user',
        'started_by_verbose' => 'започнато от :user',

        'create' => [
            'preview' => 'Преглед',
            // TL note: this is used in the topic reply preview, when
            // the user goes back from previewing to editing the reply
            'preview_hide' => 'Запиши',
            'submit' => 'Публикувай',

            'necropost' => [
                'default' => 'Тази тема е неактивна от известно време. Пишете тук само ако имате конкретна причина.',

                'new_topic' => [
                    '_' => "Тази тема е неактивна от известно време. Ако нямате конкретна причина да пишете тук, моля вместо това :create: .",
                    'create' => 'създай нова тема',
                ],
            ],

            'placeholder' => [
                'body' => 'Въведи съдържанието на публикацията тук',
                'title' => 'Кликни тук да зададеш заглавие',
            ],
        ],

        'jump' => [
            'enter' => 'кликни да зададеш конкретен номер на публикация',
            'first' => 'отиди на първото съобщение',
            'last' => 'отиди на последното съобщение',
            'next' => 'пропуснете следващите 10 съобщения',
            'previous' => 'върнете се назад с 10 съобщения',
        ],

        'post_edit' => [
            'cancel' => 'Отмени',
            'post' => 'Запази',
        ],
    ],

    'topic_watches' => [
        'index' => [
            'title' => 'Форум абонаменти',
            'title_compact' => 'форум абонаменти',
            'title_main' => 'Форум <strong>Абонаменти</strong>',

            'box' => [
                'total' => 'Абонирани теми',
                'unread' => 'Теми с нови отговори',
            ],

            'info' => [
                'total' => 'Сте се абонирахте за общо :total теми.',
                'unread' => 'Вие имате :unread непрочетени съобщения на теми от абонамента Ви.',
            ],
        ],

        'topic_buttons' => [
            'remove' => [
                'confirmation' => 'Отписване на абонамент от тази тема?',
                'title' => 'Отписване',
            ],
        ],
    ],

    'topics' => [
        '_' => 'Tеми',

        'actions' => [
            'login_reply' => 'Влезте в профила си, за да отговорите',
            'reply' => 'Отговори',
            'reply_with_quote' => 'Цитирай публикацията за отговор',
            'search' => 'Търсене',
        ],

        'create' => [
            'create_poll' => 'Създаване на анкета',

            'create_poll_button' => [
                'add' => 'Създай анкета',
                'remove' => 'Отмени създаването на анкета',
            ],

            'poll' => [
                'length' => 'Остави анкетата отворена за',
                'length_days_suffix' => 'дни',
                'length_info' => 'Оставете празно за безкрайна анкета',
                'max_options' => 'Възможни опции на човек',
                'max_options_info' => 'Това е броят на опции, които всеки човек има, когато гласува.',
                'options' => 'Опции',
                'options_info' => 'Поставете всяка опция на нов ред. Може да въведете до 10 опции.',
                'title' => 'Въпрос',
                'vote_change' => 'Позволи повторно гласуване.',
                'vote_change_info' => 'Ако е включено, потребителите ще могат да променят своя глас.',
            ],
        ],

        'edit_title' => [
            'start' => 'Редактирай заглавието',
        ],

        'index' => [
            'views' => 'посещения',
            'replies' => 'отговори',
        ],

        'issue_tag_added' => [
            'to_0' => 'Премахни марката "добавено"',
            'to_0_done' => 'Премахната марка "добавено"',
            'to_1' => 'Добави марката "добавено"',
            'to_1_done' => 'Добавена марка "добавено"',
        ],

        'issue_tag_assigned' => [
            'to_0' => 'Премахни марката "възложено"',
            'to_0_done' => 'Премахната марка "възложено"',
            'to_1' => 'Добави марката "възложено"',
            'to_1_done' => 'Добавена марка "възложено"',
        ],

        'issue_tag_confirmed' => [
            'to_0' => 'Премахни марката "потвърдено"',
            'to_0_done' => 'Премахната марка "потвърдено"',
            'to_1' => 'Добави марката "потвърдено"',
            'to_1_done' => 'Добавена марката "потвърдено"',
        ],

        'issue_tag_duplicate' => [
            'to_0' => 'Премахни марката "дубликат"',
            'to_0_done' => 'Премахната марка "дубликат"',
            'to_1' => 'Добави марката "дубликат"',
            'to_1_done' => 'Добавена марка "дубликат"',
        ],

        'issue_tag_invalid' => [
            'to_0' => 'Премахни марката "невалиден"',
            'to_0_done' => 'Премахната марка "невалиден"',
            'to_1' => 'Добави марката "невалиден"',
            'to_1_done' => 'Добавена марка "невалиден"',
        ],

        'issue_tag_resolved' => [
            'to_0' => 'Премахни марката "разрешен"',
            'to_0_done' => 'Премахната марка "разрешен"',
            'to_1' => 'Добави марката "разрешен"',
            'to_1_done' => 'Добавена марка "разрешен"',
        ],

        'lock' => [
            'is_locked' => 'Тази тема е заключена и не може да се отговаря на нея',
            'to_0' => 'Отключи тема',
            'to_0_done' => 'Темата бе отключена',
            'to_1' => 'Заключи тема',
            'to_1_done' => 'Темата бе заключена',
        ],

        'moderate_move' => [
            'title' => 'Премести в друг форум',
        ],

        'moderate_pin' => [
            'to_0' => 'Разкачи прикрепената тема',
            'to_0_done' => 'Темата бе разкачена',
            'to_1' => 'Закачи темата',
            'to_1_done' => 'Темата бе закачена',
            'to_2' => 'Закачи темата и я отбележи като уведомление',
            'to_2_done' => 'Темата бе закачена и я отбелязана като уведомление',
        ],

        'show' => [
            'deleted-posts' => 'Изтрити публикации',
            'total_posts' => 'Общ брой публикации',

            'feature_vote' => [
                'current' => 'Текущ приоритет: +:count',
                'do' => 'Разгласи тази молба',

                'user' => [
                    'count' => '{0} няма гласове | {1} :count глас | [2,*] :count гласове',
                    'current' => 'Вие имате :votes оставащи гласа.',
                    'not_enough' => "Вие не разполагате с повече гласове",
                ],
            ],

            'poll' => [
                'vote' => 'Гласувай',

                'detail' => [
                    'end_time' => 'Гласуването затваря в :time',
                    'ended' => 'Гласуването приключи в :time',
                    'total' => 'Общ брой гласове: :count',
                ],
            ],
        ],

        'watch' => [
            'to_not_watching' => 'Не е отметнато',
            'to_watching' => 'Отметка',
            'to_watching_mail' => 'Отметка с известяване',
            'mail_disable' => 'Изключи известията',
        ],
    ],
];

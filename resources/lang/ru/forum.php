<?php

/**
 *    Copyright 2015-2017 ppy Pty. Ltd.
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
    'pinned_topics' => 'Закреплённые темы',
    'slogan' => 'опасно играть в одиночестве.',
    'subforums' => 'Подфорумы',
    'title' => 'osu!сообщество',

    'covers' => [
        'create' => [
            '_' => 'Установить обложку',
            'button' => 'Загрузить изображение',
            'info' => 'Разрешение изображения должно быть :dimensions. Для загрузки изображения, ты можешь просто бросить его тут.',
        ],

        'destroy' => [
            '_' => 'Удалить обложку',
            'confirm' => 'Ты действительно хочешь удалить обложку?',
        ],
    ],

    'email' => [
        'new_reply' => '[osu!] Новый ответ в теме ":title"',
    ],

    'forums' => [
        'topics' => [
            'empty' => 'Нет тем!',
        ],
    ],

    'post' => [
        'confirm_destroy' => 'Удалить ответ?',
        'confirm_restore' => 'Восстановить ответ?',
        'edited' => 'Последний раз отредактирован :user в :when, отредактирован :count раз.',
        'posted_at' => 'написано :when',

        'actions' => [
            'destroy' => 'Удалить ответ',
            'restore' => 'Восстановить ответ',
            'edit' => 'Редактировать ответ',
        ],
    ],

    'search' => [
        'go_to_post' => 'Перейти к ответу',
        'post_number_input' => 'введи номер ответа',
        'total_posts' => ':posts_count ответов',
    ],

    'topic' => [
        'go_to_latest' => 'перейти к последнему ответу',
        'latest_post' => ':when от :user',
        'latest_reply_by' => 'последний ответ от :user',
        'new_topic' => 'Создать новую тему',
        'post_reply' => 'Ответить',
        'reply_box_placeholder' => 'Нажми тут для ответа',
        'started_by' => 'от :user',

        'create' => [
            'preview' => 'Предпросмотр',
            // TL note: this is used in the topic reply preview, when
            // the user goes back from previewing to editing the reply
            'preview_hide' => 'Редактирование',
            'submit' => 'Опубликовать',

            'placeholder' => [
                'body' => 'Содержимое',
                'title' => 'Заголовок темы',
            ],
        ],

        'jump' => [
            'enter' => 'нажми для ввода определённого номера ответа',
            'first' => 'перейти к первому ответу',
            'last' => 'перейти к последнему ответу',
            'next' => 'пропустить следующие 10 ответов',
            'previous' => 'вернуться на предыдущие 10 ответов',
        ],

        'post_edit' => [
            'cancel' => 'Отмена',
            'post' => 'Сохранить',

            'zoom' => [
                'start' => 'Полный экран',
                'end' => 'Выйти из полного экрана',
            ],
        ],
    ],

    'topic_watches' => [
        'index' => [
            'title' => 'Темы, на которые ты подписан',
            'title_compact' => 'подписки',
            'title_main' => '<strong>Подписки</strong> на темы',

            'box' => [
                'total' => 'Подписок на тем',
                'unread' => 'С новыми ответами',
            ],
            'info' => [
                'total' => 'Всего подписок :total.',
                'unread' => 'У тебя :unread непрочитанных ответов к подписанным темам.',
            ],
        ],

        'topic_buttons' => [
            'remove' => [
                'confirmation' => 'Отписаться от темы?',
                'title' => 'Отписаться',
            ],
        ],
    ],

    'topics' => [
        '_' => 'Темы',

        'actions' => [
            'reply_with_quote' => 'Ответить с цитированием',
        ],

        'create' => [
            'create_poll' => 'Создание опроса',

            'create_poll_button' => [
                'add' => 'Прикрепить опрос',
                'remove' => 'Отменить опрос',
            ],

            'poll' => [
                'length' => 'Ограничить опрос по времени на',
                'length_days_prefix' => '',
                'length_days_suffix' => 'дней',
                'length_info' => 'Оставь пустым для снятия ограничения',
                'max_options' => 'Количество ответов',
                'max_options_info' => 'Укажи количество вариантов, на которое сможет ответить один пользователь.',
                'options' => 'Варианты ответа',
                'options_info' => 'Каждый вариант в новой строке. Ты можешь ввести до 10 вариантов.',
                'title' => 'Вопрос',
                'vote_change' => 'Разрешить повторный ответ.',
                'vote_change_info' => 'Если включено, пользователи могут изменить свой ответ.',
            ],
        ],

        'index' => [
            'views' => 'просмотров',
            'replies' => 'ответов',
        ],

        'issue_tag_added' => [
            'to_0' => 'Убрать тег "добавлено"',
            'to_0_done' => 'Убран тег "добавлено"',
            'to_1' => 'Добавить тег "добавлено"',
            'to_1_done' => 'Добавлен тег "добавлено"',
        ],

        'issue_tag_assigned' => [ // TODO: Непонятно, где встречается эта фраза. Исправить в будущем.
            'to_0' => 'Убрать тег "присвоено"',
            'to_0_done' => 'Убран тег "присвоено"',
            'to_1' => 'Добавить тег "присвоено"',
            'to_1_done' => 'Добавлен тег "присвоено"',
        ],

        'issue_tag_confirmed' => [
            'to_0' => 'Убрать тег "подтверждено"',
            'to_0_done' => 'Убран тег "подтверждено"',
            'to_1' => 'Добавить тег "подтверждено"',
            'to_1_done' => 'Добавлен тег "подтверждено"',
        ],

        'issue_tag_duplicate' => [
            'to_0' => 'Убрать тег "дубликат"',
            'to_0_done' => 'Убран тег "дубликат"',
            'to_1' => 'Добавить тег "дубликат"',
            'to_1_done' => 'Добавлен тег "дубликат"',
        ],

        'issue_tag_invalid' => [
            'to_0' => 'Убрать тег "недействительно"',
            'to_0_done' => 'Убран тег "недействительно"',
            'to_1' => 'Добавить тег "недействительно"',
            'to_1_done' => 'Добавлен тег "недействительно"',
        ],

        'issue_tag_resolved' => [
            'to_0' => 'Убрать тег "решено"',
            'to_0_done' => 'Убран тег "решено"',
            'to_1' => 'Добавить тег "решено"',
            'to_1_done' => 'Добавлен тег "решено"',
        ],

        'lock' => [
            'is_locked' => 'Эта тема закрыта и ответить в нём невозможно',
            'to_0' => 'Открыть тему',
            'to_0_done' => 'Тема открыта',
            'to_1' => 'Закрыть тему',
            'to_1_done' => 'Тема закрыта',
        ],

        'moderate_move' => [
            'title' => 'Переместить в другой форум',
        ],

        'moderate_pin' => [
            'to_0' => 'Открепить тему',
            'to_0_done' => 'Тема откреплена',
            'to_1' => 'Закрепить тему',
            'to_1_done' => 'Тема закреплена',
        ],

        'show' => [
            'deleted-posts' => 'Удалено ответов',
            'total_posts' => 'Всего ответов',

            'feature_vote' => [
                'current' => 'Текущий приоритет: +:count',
                'do' => 'Продвинуть данный запрос',

                'user' => [
                    'count' => '{0} нет голосов|{1} :count голос|[2,*] :count голосов',
                    'current' => 'У тебя осталось :votes голосов.',
                    'not_enough' => 'У тебя больше нет голосов',
                ],
            ],

            'poll' => [
                'vote' => 'Голосовать',

                'detail' => [
                    'end_time' => 'Опрос будет закрыт :time',
                    'ended' => 'Опрос закончен :time',
                    'total' => 'Всего голосов: :count',
                ],
            ],
        ],

        'watch' => [
            'to_0' => 'Отписаться от темы',
            'to_0_done' => 'Отписаны от темы',
            'to_1' => 'Подписаться на тему',
            'to_1_done' => 'Подписано на тему',
        ],
    ],
];

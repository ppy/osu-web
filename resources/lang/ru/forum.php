<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'pinned_topics' => 'Закреплённые темы',
    'slogan' => "опасно играть одному.",
    'subforums' => 'Подфорумы',
    'title' => 'Форумы',

    'covers' => [
        'edit' => 'Редактировать обложку',

        'create' => [
            '_' => 'Установить обложку',
            'button' => 'Загрузить изображение',
            'info' => 'Разрешение изображения должно быть :dimensions. Для загрузки изображения, вы можете просто бросить его сюда.',
        ],

        'destroy' => [
            '_' => 'Удалить обложку',
            'confirm' => 'Вы действительно хотите удалить обложку?',
        ],
    ],

    'forums' => [
        'latest_post' => 'Последнее сообщение',

        'index' => [
            'title' => 'Заглавная страница Форума',
        ],

        'topics' => [
            'empty' => 'Нет тем!',
        ],
    ],

    'mark_as_read' => [
        'forum' => 'Отметить раздел прочитанным',
        'forums' => 'Отметить разделы прочитанными',
        'busy' => 'Отмечается как прочитанное...',
    ],

    'post' => [
        'confirm_destroy' => 'Удалить ответ?',
        'confirm_restore' => 'Восстановить ответ?',
        'edited' => 'Последний раз отредактирован :user :when, отредактирован :count раз.',
        'posted_at' => 'написано :when',
        'posted_by' => 'опубликовано :username',

        'actions' => [
            'destroy' => 'Удалить ответ',
            'edit' => 'Редактировать ответ',
            'report' => 'Пожаловаться на запись',
            'restore' => 'Восстановить ответ',
        ],

        'create' => [
            'title' => [
                'reply' => 'Новый ответ',
            ],
        ],

        'info' => [
            'post_count' => ':count_delimited пост|:count_delimited поста|:count_delimited постов',
            'topic_starter' => 'Автор темы',
        ],
    ],

    'search' => [
        'go_to_post' => 'Перейти к ответу',
        'post_number_input' => 'введи номер ответа',
        'total_posts' => ':posts_count ответов',
    ],

    'topic' => [
        'confirm_destroy' => 'Действительно удалить тему?',
        'confirm_restore' => 'Действительно восстановить тему?',
        'deleted' => 'удалённая тема',
        'go_to_latest' => 'перейти к последнему ответу',
        'has_replied' => 'Вы отвечали на эту тему',
        'in_forum' => 'в :forum',
        'latest_post' => ':when от :user',
        'latest_reply_by' => 'последний ответ от :user',
        'new_topic' => 'Создать новую тему',
        'new_topic_login' => 'Войдите, чтобы создать новую тему',
        'post_reply' => 'Ответить',
        'reply_box_placeholder' => 'Начинайте вводить тут',
        'reply_title_prefix' => 'Ответ',
        'started_by' => 'от :user',
        'started_by_verbose' => 'начато :user',

        'actions' => [
            'destroy' => 'Удалить тему',
            'restore' => 'Восстановить тему',
        ],

        'create' => [
            'close' => 'Закрыть',
            'preview' => 'Предпросмотр',
            // TL note: this is used in the topic reply preview, when
            // the user goes back from previewing to editing the reply
            'preview_hide' => 'Редактирование',
            'submit' => 'Опубликовать',

            'necropost' => [
                'default' => 'Данная тема была долгое время неактивна. Добавляйте сюда записи, только если у вас есть на то веская причина.',

                'new_topic' => [
                    '_' => "Данная тема была долгое время неактивна. Если у вас нет причин добавлять сюда комментарии, пожалуйста :create.",
                    'create' => 'создайте новую тему',
                ],
            ],

            'placeholder' => [
                'body' => 'Оставьте своё мнение',
                'title' => 'Заголовок темы',
            ],
        ],

        'jump' => [
            'enter' => 'нажмите для перехода к определённому ответу',
            'first' => 'перейти к первому ответу',
            'last' => 'перейти к последнему ответу',
            'next' => 'пропустить следующие 10 ответов',
            'previous' => 'вернуться на предыдущие 10 ответов',
        ],

        'logs' => [
            '_' => '',
            'button' => '',

            'columns' => [
                'action' => '',
                'date' => '',
                'user' => '',
            ],

            'data' => [
                'add_tag' => '',
                'announcement' => '',
                'edit_topic' => '',
                'fork' => '',
                'pin' => '',
                'post_operation' => '',
                'remove_tag' => '',
                'source_forum_operation' => '',
                'unpin' => '',
            ],

            'no_results' => '',

            'operations' => [
                'delete_post' => '',
                'delete_topic' => '',
                'edit_topic' => '',
                'edit_poll' => '',
                'fork' => '',
                'issue_tag' => '',
                'lock' => '',
                'merge' => '',
                'move' => '',
                'pin' => '',
                'post_edited' => '',
                'restore_post' => '',
                'restore_topic' => '',
                'split_destination' => '',
                'split_source' => '',
                'topic_type' => '',
                'topic_type_changed' => '',
                'unlock' => '',
                'unpin' => '',
                'user_lock' => '',
                'user_unlock' => '',
            ],
        ],

        'post_edit' => [
            'cancel' => 'Отмена',
            'post' => 'Сохранить',
        ],
    ],

    'topic_watches' => [
        'index' => [
            'title_compact' => 'подписки на темы',

            'box' => [
                'total' => 'Подписок на тем',
                'unread' => 'С новыми ответами',
            ],

            'info' => [
                'total' => 'Всего подписок :total.',
                'unread' => 'У вас :unread непрочитанных ответов к темам, за которыми вы следите.',
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
            'login_reply' => 'Войдите, чтобы ответить',
            'reply' => 'Ответить',
            'reply_with_quote' => 'Ответить с цитированием',
            'search' => 'Найти',
        ],

        'create' => [
            'create_poll' => 'Создание опроса',

            'preview' => 'Предпросмотр',

            'create_poll_button' => [
                'add' => 'Прикрепить опрос',
                'remove' => 'Отменить опрос',
            ],

            'poll' => [
                'hide_results' => 'Скрыть результаты опроса.',
                'hide_results_info' => 'Они будут показаны только после окончания опроса.',
                'length' => 'Ограничить опрос по времени на',
                'length_days_suffix' => 'дней',
                'length_info' => 'Оставьте пустым для снятия ограничения',
                'max_options' => 'Количество ответов',
                'max_options_info' => 'Укажите количество вариантов, за которые сможет проголосовать каждый пользователь.',
                'options' => 'Варианты ответа',
                'options_info' => 'Разместите каждый вариант на новой строке. Вы можете ввести до 10 вариантов.',
                'title' => 'Вопрос',
                'vote_change' => 'Разрешить повторный ответ.',
                'vote_change_info' => 'Если включено, пользователи могут изменить свой ответ.',
            ],
        ],

        'edit_title' => [
            'start' => 'Изменить заголовок',
        ],

        'index' => [
            'feature_votes' => 'количество голосов',
            'replies' => 'ответов',
            'views' => 'просмотров',
        ],

        'issue_tag_added' => [
            'to_0' => 'Убрать тег "добавлено"',
            'to_0_done' => 'Убран тег "добавлено"',
            'to_1' => 'Добавить тег "добавлено"',
            'to_1_done' => 'Добавлен тег "добавлено"',
        ],

        'issue_tag_assigned' => [
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
            'to_0_confirm' => 'Открыть тему?',
            'to_0_done' => 'Тема открыта',
            'to_1' => 'Закрыть тему',
            'to_1_confirm' => 'Закрыть тему?',
            'to_1_done' => 'Тема закрыта',
        ],

        'moderate_move' => [
            'title' => 'Переместить в другой форум',
        ],

        'moderate_pin' => [
            'to_0' => 'Открепить тему',
            'to_0_confirm' => 'Открепить тему?',
            'to_0_done' => 'Тема откреплена',
            'to_1' => 'Закрепить тему',
            'to_1_confirm' => 'Закрепить тему?',
            'to_1_done' => 'Тема закреплена',
            'to_2' => 'Закрепить тему и отметить как анонс',
            'to_2_confirm' => 'Закрепить тему и отметить как объявление?',
            'to_2_done' => 'Тема закреплена и отмечена как анонс',
        ],

        'moderate_toggle_deleted' => [
            'show' => 'Показать удалённые сообщения',
            'hide' => 'Скрыть удалённые сообщения',
        ],

        'show' => [
            'deleted-posts' => 'Удалено ответов',
            'total_posts' => 'Всего ответов',

            'feature_vote' => [
                'current' => 'Текущий приоритет: +:count',
                'do' => 'Продвинуть эту идею',

                'info' => [
                    '_' => 'Это :feature_request. За идею можно проголосовать только с :supporters.',
                    'feature_request' => 'предложенная идея',
                    'supporters' => 'osu!supporter',
                ],

                'user' => [
                    'count' => ':count голос|:count голоса|:count голосов',
                    'current' => 'У вас осталось :votes.',
                    'not_enough' => "У вас больше нет голосов",
                ],
            ],

            'poll' => [
                'edit' => 'Редактирование опроса',
                'edit_warning' => 'Изменение опроса удалит текущие результаты!',
                'vote' => 'Голосовать',

                'button' => [
                    'change_vote' => 'Изменить голос',
                    'edit' => 'Изменить опрос',
                    'view_results' => 'Посмотреть результаты',
                    'vote' => 'Голосовать',
                ],

                'detail' => [
                    'end_time' => 'Опрос будет закрыт :time',
                    'ended' => 'Опрос закончен :time',
                    'results_hidden' => 'Результаты будут показаны после окончания опроса.',
                    'total' => 'Всего голосов: :count',
                ],
            ],
        ],

        'watch' => [
            'to_not_watching' => 'Не в закладках',
            'to_watching' => 'В закладки',
            'to_watching_mail' => 'В закладки с уведомлением',
            'tooltip_mail_disable' => 'Уведомления включены. Нажмите, чтобы отключить',
            'tooltip_mail_enable' => 'Уведомления отключены. Нажмите, чтобы включить',
        ],
    ],
];

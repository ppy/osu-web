<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
 */

return [
    'authorizations' => [
        'update' => [
            'null_user' => 'Вы должны войти для редактирования.',
            'system_generated' => 'Системное сообщение не может быть отредактировано.',
            'wrong_user' => 'Вы должны быть автором данной публикации для редактирования.',
        ],
    ],

    'events' => [
        'empty' => 'Ничего не происходит... пока что.',
    ],

    'index' => [
        'deleted_beatmap' => 'удалено',
        'title' => 'Обсуждение карты',

        'form' => [
            '_' => 'Поиск',
            'deleted' => 'Включая удаленные обсуждения',
            'only_unresolved' => '',
            'types' => 'Типы сообщений',
            'username' => 'Имя пользователя',

            'beatmapset_status' => [
                '_' => '',
                'all' => '',
                'disqualified' => '',
                'never_qualified' => '',
                'qualified' => '',
                'ranked' => '',
            ],

            'user' => [
                'label' => 'Пользователь',
                'overview' => 'Просмотр активности',
            ],
        ],
    ],

    'item' => [
        'created_at' => 'Дата создания',
        'deleted_at' => 'Дата удаления',
        'message_type' => 'Тип',
        'permalink' => 'Прямая ссылка',
    ],

    'nearby_posts' => [
        'confirm' => 'Ни один из постов не решает мою проблему',
        'notice' => 'Есть ответы между :timestamp (:existing_timestamps). Проверьте их перед тем как отвечать.',
    ],

    'reply' => [
        'open' => [
            'guest' => 'Войдите, чтобы ответить',
            'user' => 'Отправить',
        ],
    ],

    'system' => [
        'resolved' => [
            'true' => 'Помечено решённым пользователем :user',
            'false' => 'Открыто заново пользователем :user',
        ],
    ],

    'user_filter' => [
        'everyone' => 'Все',
        'label' => 'Сортировать по пользователям',
    ],
];

<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'authorizations' => [
        'update' => [
            'null_user' => 'Влезте в профила си, за да редактирате.',
            'system_generated' => 'Системно-генерираният пост не може да бъде редактиран.',
            'wrong_user' => 'Трябва да сте собственик на този пост да редактирате.',
        ],
    ],

    'events' => [
        'empty' => 'Нищо не се е случило... още.',
    ],

    'index' => [
        'deleted_beatmap' => 'изтрито',
        'none_found' => '',
        'title' => 'Бийтмап Дискусии',

        'form' => [
            '_' => 'Търсене',
            'deleted' => 'Включете изтрити дискусии',
            'only_unresolved' => '',
            'types' => 'Тип съобщения',
            'username' => 'Потребителско име',

            'beatmapset_status' => [
                '_' => '',
                'all' => '',
                'disqualified' => '',
                'never_qualified' => '',
                'qualified' => '',
                'ranked' => '',
            ],

            'user' => [
                'label' => 'Потребител',
                'overview' => 'Преглед на активността',
            ],
        ],
    ],

    'item' => [
        'created_at' => 'Дата на публикуване',
        'deleted_at' => 'Дата на изтриване',
        'message_type' => 'Вид',
        'permalink' => 'Постоянен линк',
    ],

    'nearby_posts' => [
        'confirm' => 'Нито един от постовете ме интересуват',
        'notice' => 'Има постове около :timestamp (:existing_timestamps). Моля проверете ги преди да публикувате.',
    ],

    'reply' => [
        'open' => [
            'guest' => 'Влезте в профила си за да Отговорите',
            'user' => 'Отговори',
        ],
    ],

    'review' => [
        'go_to_parent' => '',
        'go_to_child' => '',
        'validation' => [
            'invalid_block_type' => '',
            'invalid_document' => '',
            'minimum_issues' => '',
            'missing_text' => '',
            'too_many_blocks' => '',
        ],
    ],

    'system' => [
        'resolved' => [
            'true' => 'Маркирано като разрешено от :user',
            'false' => 'Подновено от :user',
        ],
    ],

    'timestamp_display' => [
        'general' => '',
        'general_all' => '',
    ],

    'user_filter' => [
        'everyone' => 'Всички',
        'label' => 'Филтрирано от потребителя',
    ],
];

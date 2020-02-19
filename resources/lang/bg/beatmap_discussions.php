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

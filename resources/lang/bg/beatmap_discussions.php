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
    'authorizations' => [
        'update' => [
            'null_user' => 'Трябва да влезете в профила си за да редактирате.',
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
            'types' => 'Тип съобщения',
            'username' => 'Потребителско име',

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
        'permalink' => 'Постоянна връзка',
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

    'system' => [
        'resolved' => [
            'true' => 'Маркирано като разрешено от :user',
            'false' => 'Подновено от :user',
        ],
    ],

    'user' => [
        'admin' => 'админ',
        'bng' => 'номинатор',
        'owner' => 'мапър',
        'qat' => 'qat',
    ],

    'user_filter' => [
        'everyone' => 'Всички',
        'label' => 'Филтрирано от потребителя',
    ],
];

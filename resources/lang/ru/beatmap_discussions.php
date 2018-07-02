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
            'types' => 'Типы сообщений',
            'username' => 'Имя пользователя',

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

    'user' => [
        'admin' => 'администратор',
        'bng' => 'номинатор',
        'owner' => 'маппер',
        'qat' => 'qat',
    ],

    'user_filter' => [
        'everyone' => 'Все',
        'label' => 'Сортировать по пользователям',
    ],
];

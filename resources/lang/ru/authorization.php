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
    'beatmap_discussion' => [
        'destroy' => [
            'has_reply' => 'Нельзя удалить обсуждение с ответами',
        ],

        'vote' => [
            'owner' => 'Нельзя голосовать в собственном обсуждении!',
        ],
    ],

    'beatmap_discussion_post' => [
        'edit' => [
            'system_generated' => 'Сгенерированное системой сообщение не может быть изменено.',
            'not_owner' => 'Только автор может редактировать этот пост.',
        ],
    ],

    'chat' => [
        'channel' => [
            'read' => [
                'no_access' => 'Доступ к запрошенному каналу не разрешён.',
            ],
        ],
        'message' => [
            'send' => [
                'channel' => [
                    'moderated' => 'Канал в настоящее время модерируется.',
                ],

                'not_allowed' => 'Нельзя отправить сообщение когда Вы забанены/ограничены/заткнуты.',
            ],
        ],
    ],

    'contest' => [
        'voting_over' => 'Вы не можете изменить свой голос после того, как период голосования на этот конкурс закончился.',
    ],

    'forum' => [
        'post' => [
            'delete' => [
                'only_last_post' => 'Удалить можно только последний пост.',
                'locked' => 'Невозможно удалить пост в закрытой теме.',
                'no_forum_access' => 'Необходим доступ к запрашиваемому форуму.',
                'not_owner' => 'Только автор может удалить пост.',
            ],

            'edit' => [
                'locked' => 'Пост защищен от редактирования.',
                'no_forum_access' => 'Необходимо доступ к запрашиваемому форуму.',
                'not_owner' => 'Только автор может редактировать пост.',
                'topic_locked' => 'Невозможно редактировать пост в закрытой теме.',
            ],
        ],
    ],

    'require_login' => 'Для продолжения необходимо войти.',

    'unauthorized' => 'Доступ запрещён.',

    'user' => [
        'page' => [
            'edit' => [
                'locked' => 'Страница пользователя заблокирована.',
                'not_owner' => 'Можно редактировать только свою страницу пользователя.',
                'require_supporter_tag' => 'Необходим тег саппортера.',
            ],
        ],
    ],
];

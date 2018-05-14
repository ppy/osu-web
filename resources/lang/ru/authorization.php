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
    'beatmap_discussion' => [
        'destroy' => [
            'is_hype' => 'Нельзя отменить хайп.',
            'has_reply' => 'Нельзя удалить обсуждение с ответами',
        ],
        'nominate' => [
            'exhausted' => 'Вы достигли своего лимита номинаций за день, повторите попытку завтра.',
        ],
        'resolve' => [
            'not_owner' => 'Только автор темы или карты может решить вопрос.',
        ],

        'vote' => [
            'limit_exceeded' => 'Подождите немного прежде чем голосовать дальше',
            'owner' => "Нельзя голосовать в собственном обсуждении!",
            'wrong_beatmapset_state' => 'Можно голосовать только в обсуждениях ожидающих карт.',
        ],
    ],

    'beatmap_discussion_post' => [
        'edit' => [
            'system_generated' => 'Невозможно отредактировать автоматически созданную публикацию.',
            'not_owner' => 'Только автор может редактировать публикацию.',
        ],
    ],

    'chat' => [
        'channel' => [
            'read' => [
                'no_access' => 'Доступ к запрошенному каналу запрещён.',
            ],
        ],
        'message' => [
            'send' => [
                'channel' => [
                    'no_access' => 'Требуется доступ к запрошенному каналу.',
                    'moderated' => 'Канал в настоящее время модерируется.',
                    'not_lazer' => 'Пока что, вы можете общаться только в #lazer.',
                ],

                'not_allowed' => 'Невозможно отправить сообщение пока забанен/ограничен/заткнут.',
            ],
        ],
    ],

    'contest' => [
        'voting_over' => 'Вы не можете изменить свой голос после окончания периода голосования.',
    ],

    'forum' => [
        'post' => [
            'delete' => [
                'only_last_post' => 'Только последняя публикация может быть удалена.',
                'locked' => 'Невозможно удалить публикацию в закрытой теме.',
                'no_forum_access' => 'Необходим доступ к запрашиваемому форуму.',
                'not_owner' => 'Только автор может удалить эту публикацию.',
            ],

            'edit' => [
                'deleted' => 'Невозможно изменить удалённую публикацию.',
                'locked' => 'Публикация защищена от изменений.',
                'no_forum_access' => 'Необходим доступ к запрашиваемому форуму.',
                'not_owner' => 'Только автор может редактировать эту публикацию.',
                'topic_locked' => 'Невозможно изменить публикацию в закрытой теме.',
            ],

            'store' => [
                'play_more' => '',
                'too_many_help_posts' => "", // FIXME: unhardcode email address.
            ],
        ],

        'topic' => [
            'reply' => [
                'double_post' => 'Недавно вы уже отвечали в этой теме. Подождите перед отправкой следующего поста, либо отредактируйте свой последний пост.',
                'locked' => 'Нельзя ответить в закрытой теме.',
                'no_forum_access' => 'Необходим доступ к запрашиваемому форуму.',
                'no_permission' => 'Нет прав для ответа.',

                'user' => [
                    'require_login' => 'Войдите для ответа.',
                    'restricted' => "Нельзя ответить пока аккаунт ограничен",
                    'silenced' => "Нельзя ответить пока заткнут.",
                ],
            ],

            'store' => [
                'no_forum_access' => 'Необходим доступ к запрашиваемому форуму.',
                'no_permission' => 'Нет прав на создание новой темы.',
                'forum_closed' => 'Нельзя публиковать пока форум закрыт.',
            ],

            'vote' => [
                'no_forum_access' => 'Необходим доступ к запрашиваемому форуму.',
                'over' => 'Опрос окончен и отвечать в нём уже нельзя.',
                'voted' => 'Менять свой ответ запрещено.',

                'user' => [
                    'require_login' => 'Войдите для ответа.',
                    'restricted' => "Нельзя ответить пока аккаунт ограничен",
                    'silenced' => "Нельзя ответить пока заткнут.",
                ],
            ],

            'watch' => [
                'no_forum_access' => 'Необходим доступ к запрашиваемому форуму.',
            ],
        ],

        'topic_cover' => [
            'edit' => [
                'uneditable' => 'Указана неверная обложка.',
                'not_owner' => 'Только автор темы может менять обложку.',
            ],
        ],

        'view' => [
            'admin_only' => 'Только администратор может просматривать этот форум.',
        ],
    ],

    'require_login' => 'Войдите для продолжения.',

    'unauthorized' => 'Доступ запрещён.',

    'silenced' => "Нельзя делать это пока ограничен",

    'restricted' => "Нельзя делать это пока заткнут",

    'user' => [
        'page' => [
            'edit' => [
                'locked' => 'Страница пользователя заблокирована.',
                'not_owner' => 'Можно редактировать только свою страницу.',
                'require_supporter_tag' => 'Необходим osu!supporter.',
            ],
        ],
    ],
];

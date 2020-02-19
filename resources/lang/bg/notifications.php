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
    'all_read' => '',
    'mark_all_read' => 'Изчисти всички',
    'none' => '',
    'see_all' => '',

    'filters' => [
        '_' => '',
        'user' => '',
        'beatmapset' => '',
        'forum_topic' => '',
        'news_post' => '',
        'build' => '',
        'channel' => '',
    ],

    'item' => [
        'beatmapset' => [
            '_' => 'Бийтмап',

            'beatmapset_discussion' => [
                '_' => 'Бийтмап дискусия',
                'beatmapset_discussion_lock' => '',
                'beatmapset_discussion_lock_compact' => '',
                'beatmapset_discussion_post_new' => '',
                'beatmapset_discussion_post_new_empty' => '',
                'beatmapset_discussion_post_new_compact' => 'Нова публикация от :username',
                'beatmapset_discussion_post_new_compact_empty' => '',
                'beatmapset_discussion_unlock' => '',
                'beatmapset_discussion_unlock_compact' => 'Дискусията бе отключена',
            ],

            'beatmapset_problem' => [
                '_' => '',
                'beatmapset_discussion_qualified_problem' => '',
                'beatmapset_discussion_qualified_problem_empty' => '',
                'beatmapset_discussion_qualified_problem_compact' => '',
                'beatmapset_discussion_qualified_problem_compact_empty' => '',
            ],

            'beatmapset_state' => [
                '_' => 'Промяна в статуса на бийтмапа',
                'beatmapset_disqualify' => '":title" бе дисквалифициран',
                'beatmapset_disqualify_compact' => 'Бийтмапът бе дисквалифициран',
                'beatmapset_love' => '',
                'beatmapset_love_compact' => '',
                'beatmapset_nominate' => '":title" бе номиниран',
                'beatmapset_nominate_compact' => 'Бийтмапът бе номиниран',
                'beatmapset_qualify' => '":title" получи достатъчно номинации и влезе в опашката за класиране',
                'beatmapset_qualify_compact' => '',
                'beatmapset_rank' => '":title" бе класиран',
                'beatmapset_rank_compact' => 'Бийтмапът бе класиран',
                'beatmapset_reset_nominations' => 'Номинацията на ":title" бе анулирана',
                'beatmapset_reset_nominations_compact' => 'Номинацията бе анулирана',
            ],

            'comment' => [
                '_' => 'Нов коментар',

                'comment_new' => ':username коментира ":content" в темата ":title"',
                'comment_new_compact' => ':username коментира ":content"',
            ],
        ],

        'channel' => [
            '_' => 'Чат',

            'channel' => [
                '_' => 'Ново съобщение',
                'pm' => [
                    'channel_message' => ':username казва ":title"',
                    'channel_message_compact' => ':title',
                    'channel_message_group' => 'от :username',
                ],
            ],
        ],

        'build' => [
            '_' => 'Списък на промените',

            'comment' => [
                '_' => 'Нов коментар',

                'comment_new' => ':username коментира ":content" в темата ":title"',
                'comment_new_compact' => ':username коментира ":content"',
            ],
        ],

        'news_post' => [
            '_' => 'Новини',

            'comment' => [
                '_' => 'Нов коментар',

                'comment_new' => ':username коментира ":content" в темата ":title"',
                'comment_new_compact' => ':username коментира ":content"',
            ],
        ],

        'forum_topic' => [
            '_' => 'Тема на форума',

            'forum_topic_reply' => [
                '_' => '',
                'forum_topic_reply' => ':username отговори в темата ":title"',
                'forum_topic_reply_compact' => ':username отговори',
            ],
        ],

        'legacy_pm' => [
            '_' => '',

            'legacy_pm' => [
                '_' => '',
                'legacy_pm' => ':count_delimited непрочетено съобщение|:count_delimited непрочетени съобщения',
            ],
        ],

        'user_achievement' => [
            '_' => 'Медали',

            'user_achievement_unlock' => [
                '_' => 'Нов медал',
                'user_achievement_unlock' => 'Отключихте ":title"!',
                'user_achievement_unlock_compact' => '',
            ],
        ],
    ],
];

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
    'all_read' => 'Všechna oznámení přečtena!',
    'mark_all_read' => 'Vymazat vše',
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
            '_' => 'Beatmapa',

            'beatmapset_discussion' => [
                '_' => 'Diskuze o beatmapě',
                'beatmapset_discussion_lock' => 'Diskuze ":title" byla uzamčena',
                'beatmapset_discussion_lock_compact' => 'Diskuze byla uzamčena',
                'beatmapset_discussion_post_new' => 'Nový příspěvek v ":title" od :username: ":content"',
                'beatmapset_discussion_post_new_empty' => 'Nový příspěvek v ":title" od :username',
                'beatmapset_discussion_post_new_compact' => 'Nový příspěvek od :username ":content"',
                'beatmapset_discussion_post_new_compact_empty' => 'Nový příspěvek od :username',
                'beatmapset_discussion_unlock' => 'Diskuze ":title" byla odemčena',
                'beatmapset_discussion_unlock_compact' => 'Diskuze byla odemčena',
            ],

            'beatmapset_problem' => [
                '_' => '',
                'beatmapset_discussion_qualified_problem' => '',
                'beatmapset_discussion_qualified_problem_empty' => '',
                'beatmapset_discussion_qualified_problem_compact' => '',
                'beatmapset_discussion_qualified_problem_compact_empty' => 'Nahlásil :username',
            ],

            'beatmapset_state' => [
                '_' => 'Stav Beatmapy se změnil',
                'beatmapset_disqualify' => '',
                'beatmapset_disqualify_compact' => 'Beatmapa byla diskvalifikována',
                'beatmapset_love' => '',
                'beatmapset_love_compact' => '',
                'beatmapset_nominate' => '":title" byla nominována',
                'beatmapset_nominate_compact' => 'Beatmapa byla nominována',
                'beatmapset_qualify' => '',
                'beatmapset_qualify_compact' => '',
                'beatmapset_rank' => '',
                'beatmapset_rank_compact' => '',
                'beatmapset_reset_nominations' => '',
                'beatmapset_reset_nominations_compact' => 'Nominace byla obnovena',
            ],

            'comment' => [
                '_' => 'Nový komentář',

                'comment_new' => '',
                'comment_new_compact' => ':username okomentoval ":content"',
            ],
        ],

        'channel' => [
            '_' => 'Chat',

            'channel' => [
                '_' => 'Nová zpráva',
                'pm' => [
                    'channel_message' => '',
                    'channel_message_compact' => ':title',
                    'channel_message_group' => 'od :username',
                ],
            ],
        ],

        'build' => [
            '_' => 'Protokol změn',

            'comment' => [
                '_' => 'Nový komentář',

                'comment_new' => '',
                'comment_new_compact' => ':username okomentoval ":content"',
            ],
        ],

        'news_post' => [
            '_' => 'Novinky',

            'comment' => [
                '_' => 'Nový komentář',

                'comment_new' => ':username odpověděl ":content" v ":title"',
                'comment_new_compact' => ':username okomentoval ":content"',
            ],
        ],

        'forum_topic' => [
            '_' => 'Téma fóra',

            'forum_topic_reply' => [
                '_' => 'Nová odpověď na fórum',
                'forum_topic_reply' => ':username odpověděl na ":title"',
                'forum_topic_reply_compact' => ':username odpověděl',
            ],
        ],

        'legacy_pm' => [
            '_' => 'SZ původního fóra',

            'legacy_pm' => [
                '_' => '',
                'legacy_pm' => '',
            ],
        ],

        'user_achievement' => [
            '_' => 'Medaile',

            'user_achievement_unlock' => [
                '_' => 'Nová medaile',
                'user_achievement_unlock' => 'Odemčeno ":title"\'!',
                'user_achievement_unlock_compact' => '',
            ],
        ],
    ],
];

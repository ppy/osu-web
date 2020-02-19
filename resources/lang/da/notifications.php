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
    'all_read' => 'Alle notifikationer læst!',
    'mark_all_read' => 'Ryd alt',
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
            '_' => 'Beatmap',

            'beatmapset_discussion' => [
                '_' => 'Beatmap diskussion',
                'beatmapset_discussion_lock' => 'Diskussion på ":title" er blevet låst',
                'beatmapset_discussion_lock_compact' => 'Diskussion er låst',
                'beatmapset_discussion_post_new' => ':username har indsendt en ny besked i ":title" beatmap diskussion.',
                'beatmapset_discussion_post_new_empty' => 'Nyt opslag på ":title" af :username',
                'beatmapset_discussion_post_new_compact' => 'Nyt oplsag af :username: ":content"',
                'beatmapset_discussion_post_new_compact_empty' => 'Nyt oplsag af :username',
                'beatmapset_discussion_unlock' => 'Diskussion på ":title" er blevet åbnet',
                'beatmapset_discussion_unlock_compact' => 'Diskussion er blevet åbnet',
            ],

            'beatmapset_problem' => [
                '_' => 'Kvalificeret Beatmap problem',
                'beatmapset_discussion_qualified_problem' => 'Rapporteret af :username på ":title": ":content"',
                'beatmapset_discussion_qualified_problem_empty' => 'Rapporteret af :username på ":title"',
                'beatmapset_discussion_qualified_problem_compact' => 'Rapporteret af :username: ":content"',
                'beatmapset_discussion_qualified_problem_compact_empty' => 'Rapporteret af :username',
            ],

            'beatmapset_state' => [
                '_' => 'Beatmap status ændret',
                'beatmapset_disqualify' => 'Beatmap ":title" er blevet diskvalificeret af :username.',
                'beatmapset_disqualify_compact' => 'Beatmap blev diskvalificeret',
                'beatmapset_love' => 'Beatmap ":title" er blevet forfremmet som elsket af :username.',
                'beatmapset_love_compact' => 'Beatmap blev ophøjet til elsket',
                'beatmapset_nominate' => 'Beatmap ":title" er blevet nomineret af :username.',
                'beatmapset_nominate_compact' => 'Beatmap blev nomineret',
                'beatmapset_qualify' => '":title" har optjent nok nomineringer og er gået ind i ranking ventelisten',
                'beatmapset_qualify_compact' => 'Beatmap er gået ind i ranking ventelisten',
                'beatmapset_rank' => '":title" er blevet ranked',
                'beatmapset_rank_compact' => 'Beatmap blev ranked',
                'beatmapset_reset_nominations' => 'Nominering af ":title" blev nulstillet',
                'beatmapset_reset_nominations_compact' => 'Nominering blev nulstillet',
            ],

            'comment' => [
                '_' => 'Ny kommentar',

                'comment_new' => ':username kommenterede ":content" på ":title"',
                'comment_new_compact' => ':username kommenterede ":content"',
            ],
        ],

        'channel' => [
            '_' => 'Chat',

            'channel' => [
                '_' => 'Ny besked',
                'pm' => [
                    'channel_message' => ':username siger ":title"',
                    'channel_message_compact' => ':title',
                    'channel_message_group' => 'fra :username',
                ],
            ],
        ],

        'build' => [
            '_' => 'Ændringsoversigt',

            'comment' => [
                '_' => 'Ny kommentar',

                'comment_new' => ':username kommenterede ":content" på ":title"',
                'comment_new_compact' => ':username kommenterede ":content"',
            ],
        ],

        'news_post' => [
            '_' => 'Nyheder',

            'comment' => [
                '_' => 'Ny kommentar',

                'comment_new' => ':username kommenterede ":content" på ":title"',
                'comment_new_compact' => ':username kommenterede ":content"',
            ],
        ],

        'forum_topic' => [
            '_' => 'Forum emne',

            'forum_topic_reply' => [
                '_' => 'Nyt forum svar',
                'forum_topic_reply' => ':username svarede til forum emne ":title".',
                'forum_topic_reply_compact' => ':username svarede',
            ],
        ],

        'legacy_pm' => [
            '_' => 'Legacy Forum PM',

            'legacy_pm' => [
                '_' => '',
                'legacy_pm' => ':count_delimited ulæst besked|:count_delimited ulæste beskeder',
            ],
        ],

        'user_achievement' => [
            '_' => 'Medaljer',

            'user_achievement_unlock' => [
                '_' => 'Ny medalje',
                'user_achievement_unlock' => 'Optjent ":title"!',
                'user_achievement_unlock_compact' => '',
            ],
        ],
    ],
];

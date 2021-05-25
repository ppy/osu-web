<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'all_read' => 'Alle notifikationer læst!',
    'delete' => '',
    'loading' => '',
    'mark_read' => 'Ryd :type',
    'none' => 'Ingen notifikationer',
    'see_all' => 'se alle notifikationer',
    'see_channel' => '',
    'verifying' => 'Bekræft venligst session for at se notifikationer',

    'filters' => [
        '_' => 'alle',
        'user' => 'profil',
        'beatmapset' => 'beatmaps',
        'forum_topic' => 'forum',
        'news_post' => 'nyheder',
        'build' => 'builds',
        'channel' => 'chat',
    ],

    'item' => [
        'beatmapset' => [
            '_' => 'Beatmap',

            'beatmap_owner_change' => [
                '_' => '',
                'beatmap_owner_change' => '',
                'beatmap_owner_change_compact' => '',
            ],

            'beatmapset_discussion' => [
                '_' => 'Beatmap diskussion',
                'beatmapset_discussion_lock' => 'Diskussion på ":title" er blevet låst',
                'beatmapset_discussion_lock_compact' => 'Diskussion er låst',
                'beatmapset_discussion_post_new' => ':username har indsendt en ny besked i ":title" beatmap diskussion.',
                'beatmapset_discussion_post_new_empty' => 'Nyt opslag på ":title" af :username',
                'beatmapset_discussion_post_new_compact' => 'Nyt oplsag af :username: ":content"',
                'beatmapset_discussion_post_new_compact_empty' => 'Nyt oplsag af :username',
                'beatmapset_discussion_review_new' => '',
                'beatmapset_discussion_review_new_compact' => '',
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
                'beatmapset_remove_from_loved' => '',
                'beatmapset_remove_from_loved_compact' => '',
                'beatmapset_reset_nominations' => 'Nominering af ":title" blev nulstillet',
                'beatmapset_reset_nominations_compact' => 'Nominering blev nulstillet',
            ],

            'comment' => [
                '_' => 'Ny kommentar',

                'comment_new' => ':username kommenterede ":content" på ":title"',
                'comment_new_compact' => ':username kommenterede ":content"',
                'comment_reply' => '',
                'comment_reply_compact' => '',
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
                'comment_reply' => '',
                'comment_reply_compact' => '',
            ],
        ],

        'news_post' => [
            '_' => 'Nyheder',

            'comment' => [
                '_' => 'Ny kommentar',

                'comment_new' => ':username kommenterede ":content" på ":title"',
                'comment_new_compact' => ':username kommenterede ":content"',
                'comment_reply' => '',
                'comment_reply_compact' => '',
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

        'user' => [
            'user_beatmapset_new' => [
                '_' => '',

                'user_beatmapset_new' => '',
                'user_beatmapset_new_compact' => '',
                'user_beatmapset_new_group' => '',
            ],
        ],

        'user_achievement' => [
            '_' => 'Medaljer',

            'user_achievement_unlock' => [
                '_' => 'Ny medalje',
                'user_achievement_unlock' => 'Optjent ":title"!',
                'user_achievement_unlock_compact' => 'Opnået ":title"!',
                'user_achievement_unlock_group' => '',
            ],
        ],
    ],

    'mail' => [
        'beatmapset' => [
            'beatmap_owner_change' => [
                'beatmap_owner_change' => '',
            ],

            'beatmapset_discussion' => [
                'beatmapset_discussion_lock' => '',
                'beatmapset_discussion_post_new' => '',
                'beatmapset_discussion_unlock' => '',
            ],

            'beatmapset_problem' => [
                'beatmapset_discussion_qualified_problem' => '',
            ],

            'beatmapset_state' => [
                'beatmapset_disqualify' => '',
                'beatmapset_love' => '',
                'beatmapset_nominate' => '',
                'beatmapset_qualify' => '',
                'beatmapset_rank' => '',
                'beatmapset_remove_from_loved' => '',
                'beatmapset_reset_nominations' => '',
            ],

            'comment' => [
                'comment_new' => '',
            ],
        ],

        'channel' => [
            'channel' => [
                'pm' => '',
            ],
        ],

        'build' => [
            'comment' => [
                'comment_new' => '',
            ],
        ],

        'news_post' => [
            'comment' => [
                'comment_new' => '',
            ],
        ],

        'forum_topic' => [
            'forum_topic_reply' => [
                'forum_topic_reply' => '',
            ],
        ],

        'user' => [
            'user_achievement_unlock' => [
                'user_achievement_unlock' => '',
                'user_achievement_unlock_self' => '',
            ],

            'user_beatmapset_new' => [
                'user_beatmapset_new' => '',
            ],
        ],
    ],
];

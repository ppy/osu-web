<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'all_read' => 'Alle notifikationer læst!',
    'delete' => 'Slet :type',
    'loading' => 'Indlæser ulæste notifikationer...',
    'mark_read' => 'Ryd :type',
    'none' => 'Ingen notifikationer',
    'see_all' => 'se alle notifikationer',
    'see_channel' => 'gå til chat',
    'verifying' => 'Bekræft venligst session for at se notifikationer',

    'action_type' => [
        '_' => '',
        'beatmapset' => '',
        'build' => '',
        'channel' => '',
        'forum_topic' => '',
        'news_post' => '',
        'user' => '',
    ],

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
                '_' => 'Gæst sværhedsgrad',
                'beatmap_owner_change' => 'Du er nu ejer af sværhedsgraden ":beatmap" for beatmappet ":title"',
                'beatmap_owner_change_compact' => 'Du er nu ejer af sværhedsgraden ":beatmap"',
            ],

            'beatmapset_discussion' => [
                '_' => 'Beatmap diskussion',
                'beatmapset_discussion_lock' => 'Diskussion på ":title" er blevet låst',
                'beatmapset_discussion_lock_compact' => 'Diskussion er låst',
                'beatmapset_discussion_post_new' => ':username har indsendt en ny besked i ":title" beatmap diskussion.',
                'beatmapset_discussion_post_new_empty' => 'Nyt opslag på ":title" af :username',
                'beatmapset_discussion_post_new_compact' => 'Nyt opslag af :username: ":content"',
                'beatmapset_discussion_post_new_compact_empty' => 'Nyt opslag af :username',
                'beatmapset_discussion_review_new' => 'Ny anmeldelse på ":title" af :username indeholder problemer: :problems, forslag: :suggestions, rose: :praises',
                'beatmapset_discussion_review_new_compact' => 'Ny anmeldelse af :username indeholder problemer: :problems, forslag: :suggestions, rose: :praises',
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
                'beatmapset_remove_from_loved' => '":title" blev fjernet fra Elsket',
                'beatmapset_remove_from_loved_compact' => 'Beatmap blev fjernet fra Elskede',
                'beatmapset_reset_nominations' => 'Nominering af ":title" blev nulstillet',
                'beatmapset_reset_nominations_compact' => 'Nominering blev nulstillet',
            ],

            'comment' => [
                '_' => 'Ny kommentar',

                'comment_new' => ':username kommenterede ":content" på ":title"',
                'comment_new_compact' => ':username kommenterede ":content"',
                'comment_reply' => ':username kommenterede ":content" på ":title"',
                'comment_reply_compact' => ':username kommenterede ":content"',
            ],
        ],

        'channel' => [
            '_' => 'Chat',

            'announcement' => [
                '_' => 'Ny meddelelse',

                'announce' => [
                    'channel_announcement' => ':username siger ":title"',
                    'channel_announcement_compact' => ':title',
                    'channel_announcement_group' => 'Meddelelse fra :username',
                ],
            ],

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
                'comment_reply' => ':username kommenterede ":content" på ":title"',
                'comment_reply_compact' => ':username kommenterede ":content"',
            ],
        ],

        'news_post' => [
            '_' => 'Nyheder',

            'comment' => [
                '_' => 'Ny kommentar',

                'comment_new' => ':username kommenterede ":content" på ":title"',
                'comment_new_compact' => ':username kommenterede ":content"',
                'comment_reply' => ':username kommenterede ":content" på ":title"',
                'comment_reply_compact' => ':username kommenterede ":content"',
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
                '_' => 'Nyt beatmap',

                'user_beatmapset_new' => 'Nyt beatmap ":title" af :username',
                'user_beatmapset_new_compact' => 'Nyt beatmap ":title"',
                'user_beatmapset_new_group' => 'Nyt beatmap af :username',

                'user_beatmapset_revive' => 'Beatmap ":title" blev genoplivet af :username',
                'user_beatmapset_revive_compact' => 'Beatmap ":title" blev genoplivet',
            ],
        ],

        'user_achievement' => [
            '_' => 'Medaljer',

            'user_achievement_unlock' => [
                '_' => 'Ny medalje',
                'user_achievement_unlock' => 'Optjent ":title"!',
                'user_achievement_unlock_compact' => 'Opnået ":title"!',
                'user_achievement_unlock_group' => 'Medaljer låst op!',
            ],
        ],
    ],

    'mail' => [
        'beatmapset' => [
            'beatmap_owner_change' => [
                'beatmap_owner_change' => 'Du er nu gæst på beatmap ":title"',
            ],

            'beatmapset_discussion' => [
                'beatmapset_discussion_lock' => 'Diskussionen ":title" er blevet låst',
                'beatmapset_discussion_post_new' => 'Diskussionen ":title" har nye opdateringer',
                'beatmapset_discussion_unlock' => 'Diskussionen ":title" er blevet åbnet',
            ],

            'beatmapset_problem' => [
                'beatmapset_discussion_qualified_problem' => 'Der blev rapporteret et nyt problem på ":title"',
            ],

            'beatmapset_state' => [
                'beatmapset_disqualify' => '":title" er blevet diskvalificeret',
                'beatmapset_love' => '":title" blev ophøjet til elsket',
                'beatmapset_nominate' => '":title" er blevet nomineret',
                'beatmapset_qualify' => '":title" har optjent nok nomineringer og er gået ind i ranking ventelisten',
                'beatmapset_rank' => '":title" er blevet ranked',
                'beatmapset_remove_from_loved' => '":title" blev fjernet fra Elskede',
                'beatmapset_reset_nominations' => 'Nominering af ":title" blev nulstillet',
            ],

            'comment' => [
                'comment_new' => 'Beatmap ":title" har nye kommentarer',
            ],
        ],

        'channel' => [
            'announcement' => [
                'announce' => '',
            ],

            'channel' => [
                'pm' => 'Du har modtaget en ny besked fra :username',
            ],
        ],

        'build' => [
            'comment' => [
                'comment_new' => 'Ændringsoversigt ":title" har nye kommentarer',
            ],
        ],

        'news_post' => [
            'comment' => [
                'comment_new' => 'Nyheder ":title" har nye kommentarer',
            ],
        ],

        'forum_topic' => [
            'forum_topic_reply' => [
                'forum_topic_reply' => 'Der er nye svar i ":title"',
            ],
        ],

        'user' => [
            'user_achievement_unlock' => [
                'user_achievement_unlock' => ':username har oplåst en ny medalje, ":title"!',
                'user_achievement_unlock_self' => 'Du har oplåst en ny medalje, ":title"!',
            ],

            'user_beatmapset_new' => [
                'user_beatmapset_new' => ':username har oprettet nye beatmaps',
                'user_beatmapset_revive' => '',
            ],
        ],
    ],
];

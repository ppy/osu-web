<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'all_read' => 'Alla aviseringar är lästa!',
    'delete' => 'Radera :type',
    'loading' => 'Laddar olästa aviseringar...',
    'mark_read' => 'Rensa :type',
    'none' => 'Inga aviseringar',
    'see_all' => 'visa alla aviseringar',
    'see_channel' => 'gå till chatt',
    'verifying' => 'Vänligen verifiera sessionen för att visa aviseringar',

    'filters' => [
        '_' => 'alla',
        'user' => 'profil',
        'beatmapset' => 'beatmaps',
        'forum_topic' => 'forum',
        'news_post' => 'nyheter',
        'build' => 'builds',
        'channel' => 'chatt',
    ],

    'item' => [
        'beatmapset' => [
            '_' => 'Beatmap',

            'beatmap_owner_change' => [
                '_' => 'Gästsvårighetsgrad',
                'beatmap_owner_change' => 'Du är nu ägare till svårighetsgraden ":beatmap" för beatmappen ":title"',
                'beatmap_owner_change_compact' => 'Du är nu ägare till svårighetsgraden ":beatmap"',
            ],

            'beatmapset_discussion' => [
                '_' => 'Beatmapdiskussion',
                'beatmapset_discussion_lock' => 'Diskussion om ":title" har låsts',
                'beatmapset_discussion_lock_compact' => 'Diskussionen låstes',
                'beatmapset_discussion_post_new' => 'Nytt inlägg på ":title" av :username: ":content"',
                'beatmapset_discussion_post_new_empty' => 'Nytt inlägg på ":title" av :username',
                'beatmapset_discussion_post_new_compact' => 'Nytt inlägg på ":username" av :content"',
                'beatmapset_discussion_post_new_compact_empty' => 'Nytt inlägg av :username',
                'beatmapset_discussion_review_new' => 'Ny recension av ":title" av:username som innehåller problem: :problems, förslag: :suggestions, beröm: :praises',
                'beatmapset_discussion_review_new_compact' => 'Ny recension av :username som innehåller problem: :problems, förslag: :suggestions, beröm: :praises',
                'beatmapset_discussion_unlock' => 'Diskussion om ":title" har låsts upp',
                'beatmapset_discussion_unlock_compact' => 'Diskussionen låstes upp',
            ],

            'beatmapset_problem' => [
                '_' => 'Kvalificerad beatmap-problem',
                'beatmapset_discussion_qualified_problem' => 'Rapporterat av :username på ":title": ":content"',
                'beatmapset_discussion_qualified_problem_empty' => 'Rapporterat av :username på ":title"',
                'beatmapset_discussion_qualified_problem_compact' => 'Rapporterat av :username: ":content"',
                'beatmapset_discussion_qualified_problem_compact_empty' => 'Rapporterad av :username',
            ],

            'beatmapset_state' => [
                '_' => 'Beatmapstatus ändrad',
                'beatmapset_disqualify' => '":title" har diskvalificerats',
                'beatmapset_disqualify_compact' => 'Beatmap diskvalificerades',
                'beatmapset_love' => '":title" befordrades till älskad',
                'beatmapset_love_compact' => 'Beatmap befordrades till älskad',
                'beatmapset_nominate' => '":title" har nominerats',
                'beatmapset_nominate_compact' => 'Beatmap nominerades',
                'beatmapset_qualify' => '":title" har fått tillräckligt många nomineringar och gått in i rankingkön',
                'beatmapset_qualify_compact' => 'Beatmap har gått in i rankningskön',
                'beatmapset_rank' => '":title" har rankats',
                'beatmapset_rank_compact' => 'Beatmap rankades',
                'beatmapset_remove_from_loved' => '":title" har tagits bort från Älskad',
                'beatmapset_remove_from_loved_compact' => 'Beatmappen togs bort från Älskad',
                'beatmapset_reset_nominations' => 'Nominering av ":title" har återställts',
                'beatmapset_reset_nominations_compact' => 'Nominering återställdes',
            ],

            'comment' => [
                '_' => 'Ny kommentar',

                'comment_new' => ':username kommenterade ":content" på ":title"',
                'comment_new_compact' => ':username kommenterade ":content"',
                'comment_reply' => ':username svarade ":content" på ":title"',
                'comment_reply_compact' => ':username svarade ":content"',
            ],
        ],

        'channel' => [
            '_' => 'Chatt',

            'channel' => [
                '_' => 'Nytt meddelande',
                'pm' => [
                    'channel_message' => ':username säger ":title"',
                    'channel_message_compact' => ':title',
                    'channel_message_group' => 'från :username',
                ],
            ],
        ],

        'build' => [
            '_' => 'Ändringslogg',

            'comment' => [
                '_' => 'Ny kommentar',

                'comment_new' => ':username kommenterade ":content" på ":title"',
                'comment_new_compact' => ':username kommenterade ":content"',
                'comment_reply' => ':username svarade ":content" på ":title"',
                'comment_reply_compact' => ':username svarade ":content"',
            ],
        ],

        'news_post' => [
            '_' => 'Nyheter',

            'comment' => [
                '_' => 'Ny kommentar',

                'comment_new' => ':username kommenterade ":content" på ":title"',
                'comment_new_compact' => ':username kommenterade ":content"',
                'comment_reply' => ':username svarade ":content" på ":title"',
                'comment_reply_compact' => ':username svarade ":content"',
            ],
        ],

        'forum_topic' => [
            '_' => 'Forumämnen',

            'forum_topic_reply' => [
                '_' => 'Nytt forumsvar',
                'forum_topic_reply' => ':username svarade på ":title"',
                'forum_topic_reply_compact' => ':username svarade',
            ],
        ],

        'legacy_pm' => [
            '_' => 'Forumets äldre PM',

            'legacy_pm' => [
                '_' => '',
                'legacy_pm' => ':count_delimited oläst meddelande|:count_delimited olästa meddelanden',
            ],
        ],

        'user' => [
            'user_beatmapset_new' => [
                '_' => 'Ny beatmap',

                'user_beatmapset_new' => 'Ny beatmap ":title" av :username',
                'user_beatmapset_new_compact' => 'Ny beatmap ":title"',
                'user_beatmapset_new_group' => 'Nya beatmaps av :username',
            ],
        ],

        'user_achievement' => [
            '_' => 'Medaljer',

            'user_achievement_unlock' => [
                '_' => 'Ny medalj',
                'user_achievement_unlock' => 'Låste upp ":title"!',
                'user_achievement_unlock_compact' => 'Låste upp ":title"!',
                'user_achievement_unlock_group' => 'Medaljer upplåsta!',
            ],
        ],
    ],

    'mail' => [
        'beatmapset' => [
            'beatmap_owner_change' => [
                'beatmap_owner_change' => 'Du är nu gäst i beatmappen ":title"',
            ],

            'beatmapset_discussion' => [
                'beatmapset_discussion_lock' => 'Diskussionen om ":title" har låsts',
                'beatmapset_discussion_post_new' => 'Diskussionen om ":title" har nya uppdateringar',
                'beatmapset_discussion_unlock' => 'Diskussionen om ":title" har låsts upp',
            ],

            'beatmapset_problem' => [
                'beatmapset_discussion_qualified_problem' => 'Ett nytt problem rapporterades på ":title"',
            ],

            'beatmapset_state' => [
                'beatmapset_disqualify' => '":title" har blivit diskvalificerad',
                'beatmapset_love' => '":title" befordrades till älskad',
                'beatmapset_nominate' => '":title" har blivit nominerad',
                'beatmapset_qualify' => '":title" har fått tillräckligt många nomineringar och har gått in i rankingkön',
                'beatmapset_rank' => '":title" har blivit rankad',
                'beatmapset_remove_from_loved' => '":title" togs bort från Älskad',
                'beatmapset_reset_nominations' => 'Nominering av ":title" har blivit återställd',
            ],

            'comment' => [
                'comment_new' => 'Beatmap ":title" har nya kommentarer',
            ],
        ],

        'channel' => [
            'channel' => [
                'pm' => 'Du har fått ett nytt meddelande från :username',
            ],
        ],

        'build' => [
            'comment' => [
                'comment_new' => 'Ändringslogg ":title" har nya kommentarer',
            ],
        ],

        'news_post' => [
            'comment' => [
                'comment_new' => 'Nyheter ":title" har nya kommentarer',
            ],
        ],

        'forum_topic' => [
            'forum_topic_reply' => [
                'forum_topic_reply' => 'Det finns nya svar i ":title"',
            ],
        ],

        'user' => [
            'user_achievement_unlock' => [
                'user_achievement_unlock' => ':username har låst upp en ny medalj, ":title"!',
                'user_achievement_unlock_self' => 'Du har låst upp en ny medalj, ":title"!',
            ],

            'user_beatmapset_new' => [
                'user_beatmapset_new' => ':username har skapat nya beatmaps',
            ],
        ],
    ],
];

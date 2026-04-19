<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'all_read' => 'Visi paziņojumi izlasīti!',
    'delete' => 'Izdzēst :type',
    'loading' => 'Ielādē neizlasītos paziņojumus...',
    'mark_read' => 'Iztīrīt :type',
    'none' => 'Nav paziņojumu',
    'see_all' => 'apskatīt visus paziņojumus',
    'see_channel' => 'iet uz čatu',
    'verifying' => 'Lūdzu verificē sesiju, lai apskatītu paziņojumus',

    'action_type' => [
        '_' => 'visi',
        'beatmapset' => 'ritma-mapes',
        'build' => 'izveidojumi',
        'channel' => 'čats',
        'forum_topic' => 'forums',
        'news_post' => 'jaunumi',
        'team' => 'komanda',
        'user' => 'profils',
    ],

    'filters' => [
        '_' => 'visi',
        'beatmapset' => 'ritma-mapes',
        'build' => 'izveidojumi',
        'channel' => 'čats',
        'forum_topic' => 'forums',
        'news_post' => 'jaunumi',
        'team' => 'komanda',
        'user' => 'profils',
    ],

    'item' => [
        'beatmapset' => [
            '_' => 'Ritma-mape',

            'beatmap_owner_change' => [
                '_' => 'Viesu grūtība',
                'beatmap_owner_change' => 'Tu tagad esi ":beatmap" grūtības īpašnieks priekš ritma-mapes ":title"',
                'beatmap_owner_change_compact' => 'Tu tagad esi ":beatmap" grūtības īpašnieks',
            ],

            'beatmapset_discussion' => [
                '_' => 'Ritma-mapes diskusija',
                'beatmapset_discussion_lock' => 'Diskusija uz ":title" tika aizslēgta',
                'beatmapset_discussion_lock_compact' => 'Diskusija tika aizslēgta',
                'beatmapset_discussion_post_new' => 'Jauns raksts uz ":title" no :username: ":content"',
                'beatmapset_discussion_post_new_empty' => 'Jauns raksts uz ":title" no :username',
                'beatmapset_discussion_post_new_compact' => 'Jauns raksts no :username: ":content"',
                'beatmapset_discussion_post_new_compact_empty' => 'Jauns raksts no :username',
                'beatmapset_discussion_review_new' => 'Jauna atsauce ":title" no :username saturot :review_counts',
                'beatmapset_discussion_review_new_compact' => 'Jauna atsauce no :username saturot :review_counts',
                'beatmapset_discussion_unlock' => 'Diskusiju par ":title" atvēra',
                'beatmapset_discussion_unlock_compact' => 'Diskusija tika atvērta',

                'review_count' => [
                    'praises' => ':count_delimited uzaslava|:count_delimited uzslavas',
                    'problems' => ':count_delimited problēma|:count_delimited problēmas',
                    'suggestions' => ':count_delimited ieteikums|:count_delimited ieteikumi',
                ],
            ],

            'beatmapset_problem' => [
                '_' => 'Kvalificētas Rima-mapes problēma',
                'beatmapset_discussion_qualified_problem' => ':username Pasūdzējās par ":title": ":content"',
                'beatmapset_discussion_qualified_problem_empty' => ':username Pasūdzējās par ":title"',
                'beatmapset_discussion_qualified_problem_compact' => 'Par ":content" pasūdzējās: :username',
                'beatmapset_discussion_qualified_problem_compact_empty' => ':username Pasūdzējās',
            ],

            'beatmapset_state' => [
                '_' => 'Ritma-mapes status izmainijās',
                'beatmapset_disqualify' => '":title" tika diskvalificēta',
                'beatmapset_disqualify_compact' => 'Ritma-mape tika diskvalificēta',
                'beatmapset_love' => '":title" tika paaugstināta uz iemīļotu',
                'beatmapset_love_compact' => 'Ritma-mape tika paaugstināta uz iemīļotu',
                'beatmapset_nominate' => '":title" tika nominēta',
                'beatmapset_nominate_compact' => 'Ritma-mape tika nominēta',
                'beatmapset_qualify' => '":title" saņēma pietiekami daudz nomināciju, un iestājās novērtējamo rindā',
                'beatmapset_qualify_compact' => 'Ritma-mape iestājās novērtējamo rindā',
                'beatmapset_rank' => '":title" tika novērtēta',
                'beatmapset_rank_compact' => 'Ritma-mape tika novērtēta',
                'beatmapset_remove_from_loved' => '":title" tika noņemta no Iemīļota',
                'beatmapset_remove_from_loved_compact' => 'Ritma-mape tika noņemta no iemīļota',
                'beatmapset_reset_nominations' => '":title" Nominācija tika atiestatīta',
                'beatmapset_reset_nominations_compact' => 'Nominācija tika atiestatīta',
            ],

            'comment' => [
                '_' => 'Jauns komentrārs',

                'comment_new' => ':username komentēja ":content" par ":title"',
                'comment_new_compact' => ':username komentēja ":content"',
                'comment_reply' => ':username atbildēja ":content" par ":title"',
                'comment_reply_compact' => ':username atbildēja ":content"',
            ],
        ],

        'channel' => [
            '_' => 'Čats',

            'announcement' => [
                '_' => 'Jauns paziņojums',

                'announce' => [
                    'channel_announcement' => ':username saka ":title"',
                    'channel_announcement_compact' => ':title',
                    'channel_announcement_group' => 'Paziņojums no :username',
                ],
            ],

            'channel' => [
                '_' => 'Jauna ziņa',

                'pm' => [
                    'channel_message' => ':username saka ":title"',
                    'channel_message_compact' => ':title',
                    'channel_message_group' => 'no :username',
                ],
            ],

            'channel_team' => [
                '_' => 'Jaunas komandas ziņas',

                'team' => [
                    'channel_team' => ':username saka ":title"',
                    'channel_team_compact' => ':username saka ":title"',
                    'channel_team_group' => ':username saka ":title"',
                ],
            ],
        ],

        'build' => [
            '_' => 'Izmaiņu pieraksts',

            'comment' => [
                '_' => 'Jauns komentārs',

                'comment_new' => ':username komentēja ":content" par ":title"',
                'comment_new_compact' => ':username komentēja ":content"',
                'comment_reply' => ':username atbildēja ":content" par ":title"',
                'comment_reply_compact' => ':username atbildēja ":content"',
            ],
        ],

        'news_post' => [
            '_' => 'Jaunumi',

            'comment' => [
                '_' => 'Jauns komentārs',

                'comment_new' => ':username komentēja ":content" par ":title"',
                'comment_new_compact' => ':username komentēja ":content"',
                'comment_reply' => ':username atbildēja ":content" par ":title"',
                'comment_reply_compact' => ':username atbildēja ":content"',
            ],

            'news_post' => [
                '_' => '',

                'news_post_new' => '',
                'news_post_new_compact' => '',
            ],
        ],

        'forum_topic' => [
            '_' => 'Foruma temats',

            'forum_topic_reply' => [
                '_' => 'Jauna foruma atbilde',
                'forum_topic_reply' => ':username atbildēja par ":title" ',
                'forum_topic_reply_compact' => ':username atbildēja',
            ],
        ],

        'team' => [
            'team_application' => [
                '_' => 'Komandas pievienošanās pieprasījums',

                'team_application_accept' => "Tu tagad esi daļa no komandas :title",
                'team_application_accept_compact' => "Tu tagad esi daļa no komandas :title",

                'team_application_group' => 'Komandas pievienošanās pieprasījuma atjaunojumi',

                'team_application_reject' => 'Tavs pieprasījums pievienoties komandai :title ir noraidīts',
                'team_application_reject_compact' => 'Tavs pieprasījums pievienoties komandai :title ir noraidīts',
                'team_application_store' => ':title pieprasīja pievienoties tavai komandai',
                'team_application_store_compact' => ':title pieprasīja pievienoties tavai komandai',
            ],
        ],

        'user' => [
            'user_beatmapset_new' => [
                '_' => 'Jauna ritma-mape',

                'user_beatmapset_new' => 'Jauna ritma-mape ":title" no :username',
                'user_beatmapset_new_compact' => 'Jauna ritma-mape ":title"',
                'user_beatmapset_new_group' => 'Jaunas ritma-mapes no :username',

                'user_beatmapset_revive' => 'Ritma-mapi ":title" atjaunināja :username',
                'user_beatmapset_revive_compact' => 'Ritma-mape ":title" atjaunināta',
            ],
        ],

        'user_achievement' => [
            '_' => 'Medaļas',

            'user_achievement_unlock' => [
                '_' => 'Jauna medaļa',
                'user_achievement_unlock' => 'Tu atslēdzi ":title"!',
                'user_achievement_unlock_compact' => 'Tu atslēdzi ":title"!',
                'user_achievement_unlock_group' => 'Medaļas atslēgtas!',
            ],
        ],
    ],

    'mail' => [
        'news' => '',

        'beatmapset' => [
            'beatmap_owner_change' => [
                'beatmap_owner_change' => 'Tu tagad esi ":title" ritma-mapes viesis',
            ],

            'beatmapset_discussion' => [
                'beatmapset_discussion_lock' => 'Diskusija par ":title" tika aizslēgta',
                'beatmapset_discussion_post_new' => 'Diskusijai par ":title" ir atjauninājumi',
                'beatmapset_discussion_unlock' => 'Diskusija par ":title" tika atslēgta',
            ],

            'beatmapset_problem' => [
                'beatmapset_discussion_qualified_problem' => 'Pasūdzējās par jaunu problēmu ":title"',
            ],

            'beatmapset_state' => [
                'beatmapset_disqualify' => '":title" tika diskvalificēta',
                'beatmapset_love' => '":title" tika paaugstināta uz iemīļotu',
                'beatmapset_nominate' => '":title" tika nominēta',
                'beatmapset_qualify' => '":title" saņēma pietiekami daudz nomināciju, un iestājās novērtējamo rindā',
                'beatmapset_rank' => '":title" tika novērtēta',
                'beatmapset_remove_from_loved' => '":title" tika noņemta no Iemīļota',
                'beatmapset_reset_nominations' => '":title" Nominācija tika atcelta',
            ],

            'comment' => [
                'comment_new' => 'Ritma-mapei ":title" ir jauni komentāri',
            ],
        ],

        'channel' => [
            'announcement' => [
                'channel_announcement' => 'Ir jauns paziņojums ":name"',
            ],
            'channel' => [
                'channel_message' => 'Tu saņēmi jaunu ziņu no :username',
            ],
            'channel_team' => [
                'channel_team' => 'Ir jauna ziņa komandā ":name"',
            ],
        ],

        'build' => [
            'comment' => [
                'comment_new' => 'Izmaiņu saraksts ":title" ir jauni komentāri',
            ],
        ],

        'news_post' => [
            'comment' => [
                'comment_new' => 'Jaunumi ":title" ir komentāri',
            ],
        ],

        'forum_topic' => [
            'forum_topic_reply' => [
                'forum_topic_reply' => 'Ir jaunas atbildes ":title"',
            ],
        ],

        'team' => [
            'team_application' => [
                'team_application_accept' => "Tu tagad esi komandas :title dalībnieks",
                'team_application_reject' => 'Tavs pieprasījums pievienoties komandai :title ir ticis noliegts',
                'team_application_store' => ':title pievienojās tavai komandai',
            ],
        ],

        'user' => [
            'user_beatmapset_new' => [
                'user_beatmapset_new' => ':username ir izveidojis jaunas ritma-mapes',
                'user_beatmapset_revive' => ':username ir atjauninājis ritma-mapes',
            ],
        ],
    ],
];

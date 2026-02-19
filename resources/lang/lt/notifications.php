<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'all_read' => 'Visi pranešimai yra perskaityti!',
    'delete' => 'Ištrinti :type',
    'loading' => 'Kraunami neperskaityti pranešimai...',
    'mark_read' => 'Išvalyti :type',
    'none' => 'Nėra pranešimų',
    'see_all' => 'peržiūrėti visus pranešimus',
    'see_channel' => 'eiti į pokalbių langą',
    'verifying' => 'Prašom patvirtinti sesiją, kad matyti pranešimus',

    'action_type' => [
        '_' => 'visi',
        'beatmapset' => 'beatmap\'ai',
        'build' => 'versijos',
        'channel' => 'pokalbiai',
        'forum_topic' => 'forumas',
        'news_post' => 'naujienos',
        'team' => 'komanda',
        'user' => 'profilis',
    ],

    'filters' => [
        '_' => 'visi',
        'beatmapset' => 'beatmap\'ai',
        'build' => 'versijos',
        'channel' => 'pokalbiai',
        'forum_topic' => 'forumas',
        'news_post' => 'naujienos',
        'team' => 'komanda',
        'user' => 'profilis',
    ],

    'item' => [
        'beatmapset' => [
            '_' => 'Beatmap\'as',

            'beatmap_owner_change' => [
                '_' => 'Svečio sunkumas',
                'beatmap_owner_change' => 'Jūs dabar esate savininkas šio sunkumo ":beatmap" šitam beatmap\'ui ":title"',
                'beatmap_owner_change_compact' => 'Jūs dabar esate savininkas šio sunkumo ":beatmap"',
            ],

            'beatmapset_discussion' => [
                '_' => 'Beatmap\'o diskusija',
                'beatmapset_discussion_lock' => 'Diskusija tarp ":title" buvo užrakinta',
                'beatmapset_discussion_lock_compact' => 'Diskusija buvo užrakinta',
                'beatmapset_discussion_post_new' => 'Naujas įrašas tarp :title" iš :username: ":content"',
                'beatmapset_discussion_post_new_empty' => 'Naujas įrašas tarp :title" iš :username',
                'beatmapset_discussion_post_new_compact' => 'Naujas įrašas iš :username ":content"',
                'beatmapset_discussion_post_new_compact_empty' => 'Naujas įrašas iš :username',
                'beatmapset_discussion_review_new' => 'Nauja apžvalga ant ":title" iš :username, kurioje yra problemos: :problems, pasiūlymai: :suggestions, pagyrimai: :praises',
                'beatmapset_discussion_review_new_compact' => 'Nauja apžvalga iš :username, kurioje yra problemos: :problems, pasiūlymai: :suggestions, pagyrimai: :praises',
                'beatmapset_discussion_unlock' => 'Diskusija apie ":title" buvo atrakinta',
                'beatmapset_discussion_unlock_compact' => 'Diskusija buvo atrakinta',

                'review_count' => [
                    'praises' => ':count_delimited pagyrimas|:count_delimited pagyrimai',
                    'problems' => ':count_delimited problema|:count_delimited problemos',
                    'suggestions' => ':count_delimited pasiūlymas|:count_delimited pasiūlymų',
                ],
            ],

            'beatmapset_problem' => [
                '_' => 'Kvalifikuoto Beatmap\'o problema',
                'beatmapset_discussion_qualified_problem' => 'Pranešė :username apie ":title": ":content"',
                'beatmapset_discussion_qualified_problem_empty' => 'Pranešė :username apie ":title"',
                'beatmapset_discussion_qualified_problem_compact' => 'Pranešė :username: ":content"',
                'beatmapset_discussion_qualified_problem_compact_empty' => 'Pranešė :username',
            ],

            'beatmapset_state' => [
                '_' => 'Beatmap\'o būsena pasikeitė',
                'beatmapset_disqualify' => '":title" buvo diskvalifikuotas',
                'beatmapset_disqualify_compact' => 'Beatmap\'as buvo diskvalifikuotas',
                'beatmapset_love' => '":title" buvo paaukštintas į mylimą',
                'beatmapset_love_compact' => 'Beatmap\'as buvo paaukštintas į mylimą',
                'beatmapset_nominate' => '":title" buvo nominuotas',
                'beatmapset_nominate_compact' => 'Beatmap\'as buvo nominuotas',
                'beatmapset_qualify' => '":title" gavo pakankamai nominacijų ir pateko į reitingavimo eilę',
                'beatmapset_qualify_compact' => 'Beatmap\'as pateko į reitingavimo eilę',
                'beatmapset_rank' => '":title" buvo reitinguotas',
                'beatmapset_rank_compact' => 'Beatmap\'as buvo reitinguotas',
                'beatmapset_remove_from_loved' => '":title" buvo pašalintas iš Mylimų',
                'beatmapset_remove_from_loved_compact' => 'Beatmap\'as buvo pašalintas iš Mylimų',
                'beatmapset_reset_nominations' => '":title" nominacija buvo atstatyta',
                'beatmapset_reset_nominations_compact' => 'Nominacija buvo atstatyta',
            ],

            'comment' => [
                '_' => 'Naujas komentaras',

                'comment_new' => ':username pakomentavo ":content" tarp ":title"',
                'comment_new_compact' => ':username pakomentavo ":content"',
                'comment_reply' => ':username atsakė ":content" tarp ":title"',
                'comment_reply_compact' => ':username atsakė ":content"',
            ],
        ],

        'channel' => [
            '_' => 'Pokalbiai',

            'announcement' => [
                '_' => 'Naujas skelbimas',

                'announce' => [
                    'channel_announcement' => ':username sako ":title"',
                    'channel_announcement_compact' => ':title',
                    'channel_announcement_group' => 'Skelbimas iš :username',
                ],
            ],

            'channel' => [
                '_' => 'Nauja žinutė',

                'pm' => [
                    'channel_message' => ':username sako ":title"',
                    'channel_message_compact' => ':title',
                    'channel_message_group' => 'nuo :username',
                ],
            ],

            'channel_team' => [
                '_' => 'Nauja žinutė komandoje',

                'team' => [
                    'channel_team' => ':username sako ":title"',
                    'channel_team_compact' => ':username sako ":title"',
                    'channel_team_group' => ':username sako ":title"',
                ],
            ],
        ],

        'build' => [
            '_' => 'Pakeitimų sąrašas',

            'comment' => [
                '_' => 'Naujas komentaras',

                'comment_new' => ':username pakomentavo ":content" tarp ":title"',
                'comment_new_compact' => ':username pakomentavo ":content"',
                'comment_reply' => ':username atsakė ":content" tarp ":title"',
                'comment_reply_compact' => ':username atsakė ":content"',
            ],
        ],

        'news_post' => [
            '_' => 'Naujienos',

            'comment' => [
                '_' => 'Naujas komentaras',

                'comment_new' => ':username pakomentavo ":content" tarp ":title"',
                'comment_new_compact' => ':username pakomentavo ":content"',
                'comment_reply' => ':username atsakė ":content" tarp ":title"',
                'comment_reply_compact' => ':username atsakė ":content"',
            ],

            'news_post' => [
                '_' => '',

                'news_post_new' => '',
                'news_post_new_compact' => '',
            ],
        ],

        'forum_topic' => [
            '_' => 'Forumo tema',

            'forum_topic_reply' => [
                '_' => 'Naujas forumo atsakymas',
                'forum_topic_reply' => ':username atsakė į ":title"',
                'forum_topic_reply_compact' => ':username atsakė',
            ],
        ],

        'team' => [
            'team_application' => [
                '_' => 'Prisijungimo prie komandos paraiška',

                'team_application_accept' => "Jus tapote :title komandos nariu",
                'team_application_accept_compact' => "Jus tapote :title komandos nariu",

                'team_application_group' => 'Komandos prisijungimo prašymų atnaujinimai',

                'team_application_reject' => 'Jūsų prašymas prisijungti prie :title komandos buvo atmestas',
                'team_application_reject_compact' => 'Jūsų prašymas prisijungti prie :title komandos buvo atmestas',
                'team_application_store' => ':title nori prisijungti prie komandos',
                'team_application_store_compact' => ':title nori prisijungti prie komandos',
            ],
        ],

        'user' => [
            'user_beatmapset_new' => [
                '_' => 'Naujas beatmap\'as',

                'user_beatmapset_new' => 'Naujas beatmap\'as ":title" iš :username',
                'user_beatmapset_new_compact' => 'Naujas beatmap\'as ":title"',
                'user_beatmapset_new_group' => 'Nauji beatmap\'ai iš :username',

                'user_beatmapset_revive' => 'Beatmap\'ą ":title" atgaivino :username',
                'user_beatmapset_revive_compact' => 'Beatmap\'as ":title" atgaivintas',
            ],
        ],

        'user_achievement' => [
            '_' => 'Medaliai',

            'user_achievement_unlock' => [
                '_' => 'Naujas medalis',
                'user_achievement_unlock' => 'Atrakinta ":title"!',
                'user_achievement_unlock_compact' => 'Atrakinta ":title"!',
                'user_achievement_unlock_group' => 'Medaliai atrakinti!',
            ],
        ],
    ],

    'mail' => [
        'news' => '',

        'beatmapset' => [
            'beatmap_owner_change' => [
                'beatmap_owner_change' => 'Dabar esi svečias beatmap\'o ":title"',
            ],

            'beatmapset_discussion' => [
                'beatmapset_discussion_lock' => 'Diskusija tarp ":title" buvo užrakinta',
                'beatmapset_discussion_post_new' => 'Diskusija tarp ":title" turi naujinimų',
                'beatmapset_discussion_unlock' => 'Diskusija tarp ":title" buvo atrakinta',
            ],

            'beatmapset_problem' => [
                'beatmapset_discussion_qualified_problem' => 'Pranešta apie naują problemą tarp ":title"',
            ],

            'beatmapset_state' => [
                'beatmapset_disqualify' => '":title" buvo diskvalifikuotas',
                'beatmapset_love' => '":title" buvo paaukštintas į mylimą',
                'beatmapset_nominate' => '":title" buvo nominuotas',
                'beatmapset_qualify' => '":title" gavo pakankamai nominacijų ir pateko į reitingavimo eilę',
                'beatmapset_rank' => '":title" buvo reitinguotas',
                'beatmapset_remove_from_loved' => '":title" buvo pašalintas iš Mylimų',
                'beatmapset_reset_nominations' => '":title" nominacija buvo atstatyta',
            ],

            'comment' => [
                'comment_new' => 'Beatmap\'as ":title" turi naujų komentarų',
            ],
        ],

        'channel' => [
            'announcement' => [
                'channel_announcement' => 'Naujas skelbimas tarp ":name"',
            ],
            'channel' => [
                'channel_message' => 'Gavote naują žinutę iš :username',
            ],
            'channel_team' => [
                'channel_team' => 'Nauja žinutė komandoje ":name"',
            ],
        ],

        'build' => [
            'comment' => [
                'comment_new' => 'Pakeitimų sąrašas ":title" turi naujų komentarų',
            ],
        ],

        'news_post' => [
            'comment' => [
                'comment_new' => 'Naujienos ":title" turi naujų komentarų',
            ],
        ],

        'forum_topic' => [
            'forum_topic_reply' => [
                'forum_topic_reply' => 'Yra naujų atsakymų tarp ":title"',
            ],
        ],

        'team' => [
            'team_application' => [
                'team_application_accept' => "Jus tapote :title komandos nariu",
                'team_application_reject' => 'Jūsų prašymas prisijungti prie :title komandos buvo atšauktas',
                'team_application_store' => ':title nori prisijungti prie komandos',
            ],
        ],

        'user' => [
            'user_beatmapset_new' => [
                'user_beatmapset_new' => ':username sukūrė naujų beatmap\'ų',
                'user_beatmapset_revive' => ':username atgaivino beatmap\'us',
            ],
        ],
    ],
];

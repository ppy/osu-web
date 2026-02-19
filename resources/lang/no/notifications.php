<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'all_read' => 'Alle varsler lest!',
    'delete' => 'Slett :type',
    'loading' => 'Laster inn uleste varsler...',
    'mark_read' => 'Tøm :type',
    'none' => 'Ingen varsler',
    'see_all' => 'se alle varsler',
    'see_channel' => 'gå til chat',
    'verifying' => 'Vennligst verifiser økten for å se varsler',

    'action_type' => [
        '_' => 'alt',
        'beatmapset' => 'beatmaps',
        'build' => 'versjon',
        'channel' => 'chat',
        'forum_topic' => 'forum',
        'news_post' => 'nyheter',
        'team' => '',
        'user' => 'profil',
    ],

    'filters' => [
        '_' => 'alle',
        'beatmapset' => 'beatmapper
',
        'build' => 'versjon',
        'channel' => 'chat',
        'forum_topic' => 'forum',
        'news_post' => 'nyheter',
        'team' => '',
        'user' => 'profil',
    ],

    'item' => [
        'beatmapset' => [
            '_' => 'Beatmap',

            'beatmap_owner_change' => [
                '_' => 'Gjeste-vanskelighetsgrad',
                'beatmap_owner_change' => 'Du er nå eier av vanskelighetsgrad ":beatmap for beatmap ":title',
                'beatmap_owner_change_compact' => 'Du er nå eier av vanskelighetsgrad ":beatmap"',
            ],

            'beatmapset_discussion' => [
                '_' => 'Beatmapdiskusjon',
                'beatmapset_discussion_lock' => 'Beatmappen ":title" har blitt låst for diskusjon.',
                'beatmapset_discussion_lock_compact' => 'Diskusjonen var låst',
                'beatmapset_discussion_post_new' => ':username la til en ny melding i beatmapdiskusjonen til ":title".',
                'beatmapset_discussion_post_new_empty' => 'Nytt innlegg ved ":title" av :username',
                'beatmapset_discussion_post_new_compact' => 'Nytt innlegg av :username',
                'beatmapset_discussion_post_new_compact_empty' => 'Nytt innlegg av :username',
                'beatmapset_discussion_review_new' => 'Ny anmeldelse på ":title" av :username som inneholder problemer: :problems, forslag: :suggestions, ros: :praises',
                'beatmapset_discussion_review_new_compact' => 'Ny anmeldelse av :username som inneholder problemer: :problems, forslag: :suggestions, ros: :praises',
                'beatmapset_discussion_unlock' => 'Beatmappen ":title" har blitt låst opp for diskusjon.',
                'beatmapset_discussion_unlock_compact' => 'Diskusjon var ulåst',

                'review_count' => [
                    'praises' => ':count_delimited ros|:count_delimited roser',
                    'problems' => ':count_delimited problem|:count_delimited problemer',
                    'suggestions' => ':count_delimited forslag|:count_delimited forslag',
                ],
            ],

            'beatmapset_problem' => [
                '_' => 'Kvalifisert beatmap-problem',
                'beatmapset_discussion_qualified_problem' => 'Rapportert av :username på ":title": ":content"',
                'beatmapset_discussion_qualified_problem_empty' => 'Rapportert av :username ved ":title"',
                'beatmapset_discussion_qualified_problem_compact' => 'Rapportert av :username: ":content"',
                'beatmapset_discussion_qualified_problem_compact_empty' => 'Rapportert av :username',
            ],

            'beatmapset_state' => [
                '_' => 'Beatmap status har blitt endret',
                'beatmapset_disqualify' => 'Beatmappen ":title" har blitt diskvalifisert av :username.',
                'beatmapset_disqualify_compact' => 'Beatmap var diskvalifisert',
                'beatmapset_love' => 'Beatmappen ":title" har blitt forfremmet til elsket av :username.',
                'beatmapset_love_compact' => 'Beatmap var promotert til elsket',
                'beatmapset_nominate' => 'Beatmappen ":title" har blitt nominert av :username.',
                'beatmapset_nominate_compact' => 'Beatmap var nominert',
                'beatmapset_qualify' => 'Beatmappen ":title" har fått nok nominasjoner og er dermed i kø til å bli rangert.',
                'beatmapset_qualify_compact' => 'Beatmappen er i kø for å bli rangert',
                'beatmapset_rank' => '":title" har blitt rangert',
                'beatmapset_rank_compact' => 'Beatmappet var rangert',
                'beatmapset_remove_from_loved' => '":title" ble fjernet fra Elsket',
                'beatmapset_remove_from_loved_compact' => 'Beatmap ble fjernet fra Loved',
                'beatmapset_reset_nominations' => 'Problemstilling skrevet av :username nullstilte nominasjonen av beatmappet ":title" ',
                'beatmapset_reset_nominations_compact' => 'Nominasjonen ble tilbakestilt',
            ],

            'comment' => [
                '_' => 'Ny kommentar',

                'comment_new' => ':username kommenterte ":content" på ":title"',
                'comment_new_compact' => ':username kommenterte ":content"',
                'comment_reply' => ':username svarte ":content" på ":title"',
                'comment_reply_compact' => ':username svarte ":content"',
            ],
        ],

        'channel' => [
            '_' => 'Chat',

            'announcement' => [
                '_' => 'Ny kunngjøring',

                'announce' => [
                    'channel_announcement' => ':username sier ":title"',
                    'channel_announcement_compact' => ':title',
                    'channel_announcement_group' => 'Kunngjøring fra :username',
                ],
            ],

            'channel' => [
                '_' => 'Ny melding',

                'pm' => [
                    'channel_message' => ':username sier ":title"',
                    'channel_message_compact' => ':title',
                    'channel_message_group' => 'fra :username',
                ],
            ],

            'channel_team' => [
                '_' => '',

                'team' => [
                    'channel_team' => '',
                    'channel_team_compact' => '',
                    'channel_team_group' => '',
                ],
            ],
        ],

        'build' => [
            '_' => 'Endringslogg',

            'comment' => [
                '_' => 'Ny kommentar',

                'comment_new' => ':username kommenterte ":content" på ":title"',
                'comment_new_compact' => ':username kommenterte ":content"',
                'comment_reply' => ':username svarte ":content" på ":title"',
                'comment_reply_compact' => ':username svarte ":content"',
            ],
        ],

        'news_post' => [
            '_' => 'Nyheter',

            'comment' => [
                '_' => 'Ny kommentar',

                'comment_new' => ':username kommenterte ":content" på ":title"',
                'comment_new_compact' => ':username kommenterte ":content"',
                'comment_reply' => ':username svarte ":content" på ":title"',
                'comment_reply_compact' => ':username svarte ":content"',
            ],

            'news_post' => [
                '_' => '',

                'news_post_new' => '',
                'news_post_new_compact' => '',
            ],
        ],

        'forum_topic' => [
            '_' => 'Forumemne',

            'forum_topic_reply' => [
                '_' => 'Nytt forum svar',
                'forum_topic_reply' => ':username svarte på forumemne ":title".',
                'forum_topic_reply_compact' => ':username svarte',
            ],
        ],

        'team' => [
            'team_application' => [
                '_' => '',

                'team_application_accept' => "",
                'team_application_accept_compact' => "",

                'team_application_group' => '',

                'team_application_reject' => '',
                'team_application_reject_compact' => '',
                'team_application_store' => '',
                'team_application_store_compact' => '',
            ],
        ],

        'user' => [
            'user_beatmapset_new' => [
                '_' => 'Nytt beatmap',

                'user_beatmapset_new' => 'Nytt beatmap ":title" av :username',
                'user_beatmapset_new_compact' => 'Nytt beatmap ":title"',
                'user_beatmapset_new_group' => 'Nye beatmap fra :username',

                'user_beatmapset_revive' => 'Beatmap ":title" gjenopplivet av :username',
                'user_beatmapset_revive_compact' => 'Beatmap ":title" gjenopplivet',
            ],
        ],

        'user_achievement' => [
            '_' => 'Medaljer',

            'user_achievement_unlock' => [
                '_' => 'Ny medalje',
                'user_achievement_unlock' => '":title" låst opp!',
                'user_achievement_unlock_compact' => '":title" låst opp!',
                'user_achievement_unlock_group' => 'Medaljer oppnådd!',
            ],
        ],
    ],

    'mail' => [
        'news' => '',

        'beatmapset' => [
            'beatmap_owner_change' => [
                'beatmap_owner_change' => 'Du er nå gjest for beatmap ":title',
            ],

            'beatmapset_discussion' => [
                'beatmapset_discussion_lock' => 'Diskusjonen om ":title" har blitt låst',
                'beatmapset_discussion_post_new' => 'Diskusjonen om ":title" har nye oppdateringer',
                'beatmapset_discussion_unlock' => 'Diskusjonen om ":title" har blitt låst',
            ],

            'beatmapset_problem' => [
                'beatmapset_discussion_qualified_problem' => 'Et nytt problem rapportert var rapportert på ":title"',
            ],

            'beatmapset_state' => [
                'beatmapset_disqualify' => '":title" har blitt diskvalifisert',
                'beatmapset_love' => '":title" ble forfremmet til loved',
                'beatmapset_nominate' => '":title" har blitt nominert',
                'beatmapset_qualify' => '":title" har fått nok nominasjoner og er nå i rangeringskøen',
                'beatmapset_rank' => '":title" har blitt rangert',
                'beatmapset_remove_from_loved' => '":title" ble fjernet fra Loved',
                'beatmapset_reset_nominations' => 'Nominasjon av ":title" har blitt tilbakestilt',
            ],

            'comment' => [
                'comment_new' => ' Beatmap ":title" har nye kommentarer',
            ],
        ],

        'channel' => [
            'announcement' => [
                'channel_announcement' => '',
            ],
            'channel' => [
                'channel_message' => '',
            ],
            'channel_team' => [
                'channel_team' => '',
            ],
        ],

        'build' => [
            'comment' => [
                'comment_new' => 'Endringslogg ":title" har nye kommentarer',
            ],
        ],

        'news_post' => [
            'comment' => [
                'comment_new' => 'Nyheter ":title" har nye kommentarer',
            ],
        ],

        'forum_topic' => [
            'forum_topic_reply' => [
                'forum_topic_reply' => 'Det finnes nye svar i ":title"',
            ],
        ],

        'team' => [
            'team_application' => [
                'team_application_accept' => "",
                'team_application_reject' => '',
                'team_application_store' => '',
            ],
        ],

        'user' => [
            'user_beatmapset_new' => [
                'user_beatmapset_new' => ':username har opprettet nye beatmaps',
                'user_beatmapset_revive' => ':username har gjenopplivet beatmaps',
            ],
        ],
    ],
];

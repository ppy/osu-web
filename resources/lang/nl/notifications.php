<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'all_read' => 'Alle meldingen gelezen!',
    'delete' => ':type verwijderen',
    'loading' => 'Ongelezen meldingen laden...',
    'mark_read' => 'Wissen :type',
    'none' => 'Geen meldingen',
    'see_all' => 'alle meldingen bekijken',
    'see_channel' => 'ga naar chat',
    'verifying' => 'Verifieer de sessie om meldingen te bekijken',

    'action_type' => [
        '_' => 'alle',
        'beatmapset' => 'beatmaps',
        'build' => 'versies',
        'channel' => 'chat',
        'forum_topic' => 'forum',
        'news_post' => 'nieuws',
        'team' => '',
        'user' => 'profiel',
    ],

    'filters' => [
        '_' => 'alle',
        'beatmapset' => 'beatmaps',
        'build' => 'versie',
        'channel' => 'chat',
        'forum_topic' => 'forum',
        'news_post' => 'nieuws',
        'team' => '',
        'user' => 'profiel',
    ],

    'item' => [
        'beatmapset' => [
            '_' => 'Beatmap',

            'beatmap_owner_change' => [
                '_' => 'Gast moeilijkheidsgraad',
                'beatmap_owner_change' => 'Je hebt nu de moeilijkheid ":beatmap" voor beatmap ":title"',
                'beatmap_owner_change_compact' => 'Je bent nu eigenaar van de moeilijkheidsgraad ":beatmap"',
            ],

            'beatmapset_discussion' => [
                '_' => 'Beatmap discussies',
                'beatmapset_discussion_lock' => 'Beatmap ":title" is vergrendeld voor discussie.',
                'beatmapset_discussion_lock_compact' => 'Discussie is vergrendeld',
                'beatmapset_discussion_post_new' => ':username plaatste een nieuw bericht in ":title" beatmap discussie.',
                'beatmapset_discussion_post_new_empty' => 'Nieuw bericht op ":title" door :username',
                'beatmapset_discussion_post_new_compact' => 'Nieuw bericht door :username',
                'beatmapset_discussion_post_new_compact_empty' => 'Nieuw bericht door :username',
                'beatmapset_discussion_review_new' => 'Nieuwe beoordeling op ":title" door :username die problemen bevat: :problems, suggesties: :suggestions, prijzen: :praises',
                'beatmapset_discussion_review_new_compact' => 'Nieuwe beoordeling door :username die problemen bevat: :problems, suggesties: :suggestions, prijzen: :praises',
                'beatmapset_discussion_unlock' => 'Beatmap ":title" is ontgrendeld voor discussie.',
                'beatmapset_discussion_unlock_compact' => 'Discussie is ontgrendeld',

                'review_count' => [
                    'praises' => ':count_delimited lof|:count_delimited lof',
                    'problems' => ':count_delimited probleem|:count_delimited problemen',
                    'suggestions' => ':count_delimited suggestie|:count_delimited suggesties',
                ],
            ],

            'beatmapset_problem' => [
                '_' => 'Gekwalificeerde Beatmap probleem',
                'beatmapset_discussion_qualified_problem' => 'Gerapporteerd door :username op ":title": ":content"',
                'beatmapset_discussion_qualified_problem_empty' => 'Gerapporteerd door :username op ":title"',
                'beatmapset_discussion_qualified_problem_compact' => 'Gerapporteerd door :username: ":content"',
                'beatmapset_discussion_qualified_problem_compact_empty' => 'Gerapporteerd door :username',
            ],

            'beatmapset_state' => [
                '_' => 'Beatmap status gewijzigd',
                'beatmapset_disqualify' => 'Beatmap ":title" is gediskwalificeerd door :username.',
                'beatmapset_disqualify_compact' => 'Beatmap was gediskwalificeerd',
                'beatmapset_love' => 'Beatmap ":title" is gepromoveerd tot loved door :username.',
                'beatmapset_love_compact' => 'Beatmap werd gepromoveerd voor loved',
                'beatmapset_nominate' => 'Beatmap ":title" is genomineerd door :username.',
                'beatmapset_nominate_compact' => 'Beatmap is genomineerd',
                'beatmapset_qualify' => 'Beatmap ":title" heeft genoeg nominaties en is dus in de rij gezet voor de ranked sectie.',
                'beatmapset_qualify_compact' => 'Beatmap staat in de ranked wachtlijst',
                'beatmapset_rank' => '":title" is geranked',
                'beatmapset_rank_compact' => 'Beatmap was geranked',
                'beatmapset_remove_from_loved' => '":title" is verwijderd van Loved',
                'beatmapset_remove_from_loved_compact' => 'Beatmap is verwijderd uit Loved',
                'beatmapset_reset_nominations' => 'Probleem geplaatst door :username reset nominatie van beatmap ":title" ',
                'beatmapset_reset_nominations_compact' => 'Nominatie is gereset',
            ],

            'comment' => [
                '_' => 'Nieuwe opmerking',

                'comment_new' => ':username gaf commentaar op ":content" op ":title"',
                'comment_new_compact' => ':username gaf commentaar op ":content"',
                'comment_reply' => ':username antwoordde ":content" op ":title"',
                'comment_reply_compact' => ':username antwoordde ":content"',
            ],
        ],

        'channel' => [
            '_' => 'Chat',

            'announcement' => [
                '_' => 'Nieuwe aankondiging',

                'announce' => [
                    'channel_announcement' => ':username zegt ":title"',
                    'channel_announcement_compact' => ':title',
                    'channel_announcement_group' => 'Aankondiging van :username',
                ],
            ],

            'channel' => [
                '_' => 'Nieuw bericht',

                'pm' => [
                    'channel_message' => ':username zegt ":title"',
                    'channel_message_compact' => ':title',
                    'channel_message_group' => 'van :username',
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
            '_' => 'Changelog',

            'comment' => [
                '_' => 'Nieuwe reactie',

                'comment_new' => ':username gaf commentaar ":content" op ":title"',
                'comment_new_compact' => ':username gaf commentaar op ":content"',
                'comment_reply' => ':username antwoordde ":content" op ":title"',
                'comment_reply_compact' => ':username antwoordde ":content"',
            ],
        ],

        'news_post' => [
            '_' => 'Nieuws',

            'comment' => [
                '_' => 'Nieuwe reactie',

                'comment_new' => ':username gaf commentaar ":content" op ":title"',
                'comment_new_compact' => ':username gaf commentaar op ":content"',
                'comment_reply' => ':username antwoordde ":content" op ":title"',
                'comment_reply_compact' => ':username antwoordde ":content"',
            ],

            'news_post' => [
                '_' => '',

                'news_post_new' => '',
                'news_post_new_compact' => '',
            ],
        ],

        'forum_topic' => [
            '_' => 'Forum onderwerp',

            'forum_topic_reply' => [
                '_' => 'Nieuw forum antwoord',
                'forum_topic_reply' => ':username antwoordde op forumonderwerp ":title".',
                'forum_topic_reply_compact' => ':username antwoordde',
            ],
        ],

        'team' => [
            'team_application' => [
                '_' => 'Teamlid worden',

                'team_application_accept' => "Je bent nu lid van het team :title",
                'team_application_accept_compact' => "Je bent nu lid van :title",

                'team_application_group' => '',

                'team_application_reject' => '',
                'team_application_reject_compact' => '',
                'team_application_store' => '',
                'team_application_store_compact' => '',
            ],
        ],

        'user' => [
            'user_beatmapset_new' => [
                '_' => 'Nieuwe beatmap',

                'user_beatmapset_new' => 'Nieuwe beatmap ":title" door :username',
                'user_beatmapset_new_compact' => 'Nieuwe beatmap ":title"',
                'user_beatmapset_new_group' => 'Nieuwe beatmaps door :username',

                'user_beatmapset_revive' => 'Beatmap ":title" vernieuwd door :username',
                'user_beatmapset_revive_compact' => 'Beatmap ":title" vernieuwd',
            ],
        ],

        'user_achievement' => [
            '_' => 'Medailles',

            'user_achievement_unlock' => [
                '_' => 'Nieuwe medaille',
                'user_achievement_unlock' => '":title" ontgrendeld!',
                'user_achievement_unlock_compact' => '":title" ontgrendeld!',
                'user_achievement_unlock_group' => 'Medailles ontgrendeld!',
            ],
        ],
    ],

    'mail' => [
        'news' => '',

        'beatmapset' => [
            'beatmap_owner_change' => [
                'beatmap_owner_change' => 'Je bent nu gast van beatmap ":title"',
            ],

            'beatmapset_discussion' => [
                'beatmapset_discussion_lock' => 'De discussie op ":title" is vergrendeld',
                'beatmapset_discussion_post_new' => 'De discussie over ":title" heeft nieuwe updates',
                'beatmapset_discussion_unlock' => 'De discussie op ":title" is ontgrendeld',
            ],

            'beatmapset_problem' => [
                'beatmapset_discussion_qualified_problem' => 'Er is een nieuw probleem gemeld op ":title"',
            ],

            'beatmapset_state' => [
                'beatmapset_disqualify' => '":title" is gediskwalificeerd',
                'beatmapset_love' => '":title" was gepromoveerd naar geliefde',
                'beatmapset_nominate' => '":title" is genomineerd',
                'beatmapset_qualify' => '":title" heeft genoeg nominaties gekregen en de rij van rangen ingevoerd',
                'beatmapset_rank' => '":title" is gerangschikt',
                'beatmapset_remove_from_loved' => '":title" is verwijderd uit Loved',
                'beatmapset_reset_nominations' => 'Nominatie van ":title" is gereset',
            ],

            'comment' => [
                'comment_new' => 'Beatmap ":title" heeft nieuwe reacties',
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
                'comment_new' => 'Changelog ":title" heeft nieuwe reacties',
            ],
        ],

        'news_post' => [
            'comment' => [
                'comment_new' => 'Nieuws ":title" heeft nieuwe reacties',
            ],
        ],

        'forum_topic' => [
            'forum_topic_reply' => [
                'forum_topic_reply' => 'Er zijn nieuwe antwoorden in ":title"',
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
                'user_beatmapset_new' => ':username heeft nieuwe beatmaps aangemaakt',
                'user_beatmapset_revive' => ':username heeft beatmaps vernieuwd',
            ],
        ],
    ],
];

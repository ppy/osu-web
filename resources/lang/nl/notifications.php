<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
 */

return [
    'all_read' => 'Alle meldingen gelezen!',
    'mark_all_read' => 'Alles wissen',

    'item' => [
        'beatmapset' => [
            '_' => 'Beatmap',

            'beatmapset_discussion' => [
                '_' => 'Beatmap discussies',
                'beatmapset_discussion_lock' => 'Beatmap ":title" is vergrendeld voor discussie.',
                'beatmapset_discussion_lock_compact' => 'Discussie is vergrendeld',
                'beatmapset_discussion_post_new' => ':username plaatste een nieuw bericht in ":title" beatmap discussie.',
                'beatmapset_discussion_post_new_empty' => '',
                'beatmapset_discussion_post_new_compact' => 'Nieuw bericht door :username',
                'beatmapset_discussion_post_new_compact_empty' => '',
                'beatmapset_discussion_unlock' => 'Beatmap ":title" is ontgrendeld voor discussie.',
                'beatmapset_discussion_unlock_compact' => 'Discussie is ontgrendeld',
            ],

            'beatmapset_problem' => [
                '_' => '',
                'beatmapset_discussion_qualified_problem' => '',
                'beatmapset_discussion_qualified_problem_empty' => '',
                'beatmapset_discussion_qualified_problem_compact' => '',
                'beatmapset_discussion_qualified_problem_compact_empty' => '',
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
                'beatmapset_reset_nominations' => 'Probleem geplaatst door :username reset nominatie van beatmap ":title" ',
                'beatmapset_reset_nominations_compact' => 'Nominatie is gereset',
            ],

            'comment' => [
                '_' => 'Nieuwe opmerking',

                'comment_new' => ':username gaf commentaar op ":content" op ":title"',
                'comment_new_compact' => ':username gaf commentaar op ":content"',
            ],
        ],

        'channel' => [
            '_' => 'Chat',

            'channel' => [
                '_' => 'Nieuw bericht',
                'pm' => [
                    'channel_message' => ':username zegt ":title"',
                    'channel_message_compact' => ':title',
                    'channel_message_group' => 'van :username',
                ],
            ],
        ],

        'build' => [
            '_' => 'Changelog',

            'comment' => [
                '_' => 'Nieuwe reactie',

                'comment_new' => ':username gaf commentaar ":content" op ":title"',
                'comment_new_compact' => ':username gaf commentaar op ":content"',
            ],
        ],

        'news_post' => [
            '_' => 'Nieuws',

            'comment' => [
                '_' => 'Nieuwe reactie',

                'comment_new' => ':username gaf commentaar ":content" op ":title"',
                'comment_new_compact' => ':username gaf commentaar op ":content"',
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

        'legacy_pm' => [
            '_' => 'Ouder Forum PM',

            'legacy_pm' => [
                '_' => '',
                'legacy_pm' => ':count_delimited ongelezen bericht.|:count_delimited berichten.',
            ],
        ],

        'user_achievement' => [
            '_' => 'Medailles',

            'user_achievement_unlock' => [
                '_' => 'Nieuwe medaille',
                'user_achievement_unlock' => '":title" ontgrendeld!',
            ],
        ],
    ],
];

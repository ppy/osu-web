<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'all_read' => 'Όλες οι ειδοποιήσεις διαβάστηκαν!',
    'delete' => '',
    'loading' => '',
    'mark_read' => '',
    'none' => '',
    'see_all' => '',
    'see_channel' => '',
    'verifying' => '',

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

            'beatmap_owner_change' => [
                '_' => '',
                'beatmap_owner_change' => '',
                'beatmap_owner_change_compact' => '',
            ],

            'beatmapset_discussion' => [
                '_' => 'Συζήτηση για το beatmap',
                'beatmapset_discussion_lock' => 'Η συζήτηση για το beatmap ":title" έχει κλειδώσει.',
                'beatmapset_discussion_lock_compact' => '',
                'beatmapset_discussion_post_new' => 'Ο χρήστης:username δημοσίευσε ένα καινούριο μήνυμα στη συζήτηση για το beatmap ":title".',
                'beatmapset_discussion_post_new_empty' => '',
                'beatmapset_discussion_post_new_compact' => '',
                'beatmapset_discussion_post_new_compact_empty' => '',
                'beatmapset_discussion_review_new' => '',
                'beatmapset_discussion_review_new_compact' => '',
                'beatmapset_discussion_unlock' => 'Η συζήτηση για το beatmap ":title" ξεκλειδώθηκε.',
                'beatmapset_discussion_unlock_compact' => '',
            ],

            'beatmapset_problem' => [
                '_' => '',
                'beatmapset_discussion_qualified_problem' => '',
                'beatmapset_discussion_qualified_problem_empty' => '',
                'beatmapset_discussion_qualified_problem_compact' => '',
                'beatmapset_discussion_qualified_problem_compact_empty' => '',
            ],

            'beatmapset_state' => [
                '_' => 'Η κατάσταση του beatmap άλλαξε',
                'beatmapset_disqualify' => 'Το beatmap ":title" απορρίφθηκε από τον χρήστη :username.',
                'beatmapset_disqualify_compact' => '',
                'beatmapset_love' => 'Το beatmap ":title" προάχθηκε ως loved από τον χρήστη :username.',
                'beatmapset_love_compact' => '',
                'beatmapset_nominate' => 'Το beatmap ":title" έγινε nominate από τον χρήστη :username.',
                'beatmapset_nominate_compact' => '',
                'beatmapset_qualify' => 'To beatmap ":title" έχει λάβει αρκετά nominations και μπήκε στη σειρά για να γίνει ranked.',
                'beatmapset_qualify_compact' => '',
                'beatmapset_rank' => '',
                'beatmapset_rank_compact' => '',
                'beatmapset_remove_from_loved' => '',
                'beatmapset_remove_from_loved_compact' => '',
                'beatmapset_reset_nominations' => 'Το θέμα που δημοσιεύτηκε από τον χρήστη :username επανέφερε το beatmap ":title" σε κατάσταση προς nomination ',
                'beatmapset_reset_nominations_compact' => '',
            ],

            'comment' => [
                '_' => '',

                'comment_new' => '',
                'comment_new_compact' => '',
                'comment_reply' => '',
                'comment_reply_compact' => '',
            ],
        ],

        'channel' => [
            '_' => '',

            'channel' => [
                '_' => '',
                'pm' => [
                    'channel_message' => '',
                    'channel_message_compact' => '',
                    'channel_message_group' => '',
                ],
            ],
        ],

        'build' => [
            '_' => '',

            'comment' => [
                '_' => '',

                'comment_new' => '',
                'comment_new_compact' => '',
                'comment_reply' => '',
                'comment_reply_compact' => '',
            ],
        ],

        'news_post' => [
            '_' => '',

            'comment' => [
                '_' => '',

                'comment_new' => '',
                'comment_new_compact' => '',
                'comment_reply' => '',
                'comment_reply_compact' => '',
            ],
        ],

        'forum_topic' => [
            '_' => 'Θέμα του forum',

            'forum_topic_reply' => [
                '_' => 'Νέα απάντηση στο forum',
                'forum_topic_reply' => 'O χρήστης:username απάντησε στο θέμα του forum ":title".',
                'forum_topic_reply_compact' => '',
            ],
        ],

        'legacy_pm' => [
            '_' => 'Προσωπικά Μηνύματα του Παλαιότερου Forum',

            'legacy_pm' => [
                '_' => '',
                'legacy_pm' => ':count_delimited αδιάβαστο μήνυμα.|:count_delimited αδιάβαστα μηνύματα.',
            ],
        ],

        'user' => [
            'user_beatmapset_new' => [
                '_' => '',

                'user_beatmapset_new' => '',
                'user_beatmapset_new_compact' => '',
                'user_beatmapset_new_group' => '',

                'user_beatmapset_revive' => '',
                'user_beatmapset_revive_compact' => '',
            ],
        ],

        'user_achievement' => [
            '_' => '',

            'user_achievement_unlock' => [
                '_' => '',
                'user_achievement_unlock' => '',
                'user_achievement_unlock_compact' => '',
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

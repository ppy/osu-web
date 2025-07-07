<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'all_read' => 'Όλες οι ειδοποιήσεις διαβάστηκαν!',
    'delete' => 'Διαγραφή :type',
    'loading' => 'Φόρτωση μη αναγνωσμένων ειδοποιήσεων...',
    'mark_read' => 'Καθαρισμός :type',
    'none' => 'Καμία ειδοποίηση',
    'see_all' => 'εμφάνιση όλων των ειδοποιήσεων',
    'see_channel' => 'μετάβαση στη συνομιλία',
    'verifying' => 'Παρακαλώ επιβεβαίωσε τη συνεδρία για να δεις τις ειδοποιήσεις',

    'action_type' => [
        '_' => 'όλα',
        'beatmapset' => 'beatmaps',
        'build' => 'εκδόσεις',
        'channel' => 'συνομιλία',
        'forum_topic' => 'φόρουμ',
        'news_post' => 'νέα',
        'team' => 'ομάδα',
        'user' => 'προφίλ',
    ],

    'filters' => [
        '_' => 'όλα',
        'beatmapset' => 'beatmaps',
        'build' => 'εκδόσεις',
        'channel' => 'συνομιλία',
        'forum_topic' => 'φόρουμ',
        'news_post' => 'νέα',
        'team' => 'ομάδα',
        'user' => 'προφίλ',
    ],

    'item' => [
        'beatmapset' => [
            '_' => 'Beatmap',

            'beatmap_owner_change' => [
                '_' => 'Δυσκολία επισκέπτη',
                'beatmap_owner_change' => 'Τώρα είσαι ιδιοκτήτης δυσκολίας \'\':beatmap\'\' για το beatmap \'\':title\'\'',
                'beatmap_owner_change_compact' => 'Τώρα είσαι ιδιοκτήτης δυσκολίας \'\':beatmap\'\'',
            ],

            'beatmapset_discussion' => [
                '_' => 'Συζήτηση για το beatmap',
                'beatmapset_discussion_lock' => 'Η συζήτηση για το beatmap ":title" έχει κλειδώσει.',
                'beatmapset_discussion_lock_compact' => 'Η συζήτηση κλειδώθηκε',
                'beatmapset_discussion_post_new' => 'Ο χρήστης:username δημοσίευσε ένα καινούριο μήνυμα στη συζήτηση για το beatmap ":title".',
                'beatmapset_discussion_post_new_empty' => 'Νέα δημοσίευση στο ":title" από :username',
                'beatmapset_discussion_post_new_compact' => 'Νέα δημοσίευση από :username: ":content"',
                'beatmapset_discussion_post_new_compact_empty' => 'Νέα δημοσίευση από :username',
                'beatmapset_discussion_review_new' => 'Νέα κριτική στο ":title" από :username που περιέχει :review_counts',
                'beatmapset_discussion_review_new_compact' => 'Νέα κριτική από :username που περιέχει :review_counts',
                'beatmapset_discussion_unlock' => 'Η συζήτηση για το beatmap ":title" ξεκλειδώθηκε.',
                'beatmapset_discussion_unlock_compact' => 'Η συζήτηση ξεκλειδώθηκε',

                'review_count' => [
                    'praises' => ':count_delimited επαίνους|:count_delimited επαινεί',
                    'problems' => ':count_delimited πρόβλημα|:count_delimited προβλήματα',
                    'suggestions' => ':count_delimited πρόταση|:count_delimited προτάσεις',
                ],
            ],

            'beatmapset_problem' => [
                '_' => 'Περασμένο πρόβλημα Beatmap',
                'beatmapset_discussion_qualified_problem' => 'Αναφέρθηκε από :username στο ":title": ":content"',
                'beatmapset_discussion_qualified_problem_empty' => 'Αναφέρθηκε από :username στο ":title"',
                'beatmapset_discussion_qualified_problem_compact' => 'Αναφέρθηκε από :username: ":content"',
                'beatmapset_discussion_qualified_problem_compact_empty' => 'Αναφέρθηκε από :username',
            ],

            'beatmapset_state' => [
                '_' => 'Η κατάσταση του beatmap άλλαξε',
                'beatmapset_disqualify' => 'Το beatmap ":title" απορρίφθηκε από τον χρήστη :username.',
                'beatmapset_disqualify_compact' => 'Το Beatmap αποκλείστηκε',
                'beatmapset_love' => 'Το beatmap ":title" προάχθηκε ως loved από τον χρήστη :username.',
                'beatmapset_love_compact' => 'Το Beatmap προωθήθηκε στα αγαπημένα (loved)',
                'beatmapset_nominate' => 'Το beatmap ":title" έγινε nominate από τον χρήστη :username.',
                'beatmapset_nominate_compact' => 'Το Beatmap διορίστηκε',
                'beatmapset_qualify' => 'To beatmap ":title" έχει λάβει αρκετά nominations και μπήκε στη σειρά για να γίνει ranked.',
                'beatmapset_qualify_compact' => 'Το Beatmap εισήγαγε την ουρά κατάταξης',
                'beatmapset_rank' => 'Το ":title" έχει καταταχθεί',
                'beatmapset_rank_compact' => 'Το Beatmap κατατάχθηκε',
                'beatmapset_remove_from_loved' => '":title" αφαιρέθηκε από τα αγαπημένα (loved)',
                'beatmapset_remove_from_loved_compact' => 'Το Beatmap αφαιρέθηκε από τα αγαπημένα (loved)',
                'beatmapset_reset_nominations' => 'Το θέμα που δημοσιεύτηκε από τον χρήστη :username επανέφερε το beatmap ":title" σε κατάσταση προς nomination ',
                'beatmapset_reset_nominations_compact' => 'Έγινε επαναφορά διορισμού',
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

            'announcement' => [
                '_' => '',

                'announce' => [
                    'channel_announcement' => '',
                    'channel_announcement_compact' => '',
                    'channel_announcement_group' => '',
                ],
            ],

            'channel' => [
                '_' => '',

                'pm' => [
                    'channel_message' => '',
                    'channel_message_compact' => '',
                    'channel_message_group' => '',
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

        'team' => [
            'team_application' => [
                'team_application_accept' => "",
                'team_application_reject' => '',
                'team_application_store' => '',
            ],
        ],

        'user' => [
            'user_beatmapset_new' => [
                'user_beatmapset_new' => '',
                'user_beatmapset_revive' => '',
            ],
        ],
    ],
];

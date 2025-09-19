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
                '_' => 'Νέο σχόλιο',

                'comment_new' => ':username σχολίασε \'\':content\'\' στο \'\':title\'\'',
                'comment_new_compact' => ':username σχολίασε \'\':content\'\'',
                'comment_reply' => ':username απάντησε με \'\':content\'\' στο \'\':title\'\'',
                'comment_reply_compact' => ':username απάντησε με \'\':content\'\'',
            ],
        ],

        'channel' => [
            '_' => 'Συνομιλία',

            'announcement' => [
                '_' => 'Νέα ανακοίνωση',

                'announce' => [
                    'channel_announcement' => ':username λέει \'\':title\'\'',
                    'channel_announcement_compact' => ':title',
                    'channel_announcement_group' => 'Ανακοίνωση από :username',
                ],
            ],

            'channel' => [
                '_' => 'Νέο μήνυμα',

                'pm' => [
                    'channel_message' => ':username λέει ":title"',
                    'channel_message_compact' => ':title',
                    'channel_message_group' => 'από :username',
                ],
            ],

            'channel_team' => [
                '_' => 'Νέο μήνυμα ομάδας',

                'team' => [
                    'channel_team' => ':username λέει ":title"',
                    'channel_team_compact' => ':username λέει ":title"',
                    'channel_team_group' => ':username λέει ":title"',
                ],
            ],
        ],

        'build' => [
            '_' => 'Αλλαγές',

            'comment' => [
                '_' => 'Νέο σχόλιο',

                'comment_new' => ':username σχολίασε \'\':content\'\' στο \'\':title\'\'',
                'comment_new_compact' => ':username σχολίασε ":content"',
                'comment_reply' => ':username απάντησε με \'\':content\'\' στο \'\':title\'\'',
                'comment_reply_compact' => ':username απάντησε με \'\':content\'\'',
            ],
        ],

        'news_post' => [
            '_' => 'Νέα',

            'comment' => [
                '_' => 'Νέο σχόλιο',

                'comment_new' => ':username σχολίασε \'\':content\'\' στο \'\':title\'\'',
                'comment_new_compact' => ':username σχολίασε ":content"',
                'comment_reply' => ':username απάντησε με \'\':content\'\' στο \'\':title\'\'',
                'comment_reply_compact' => ':username απάντησε με \'\':content\'\'',
            ],
        ],

        'forum_topic' => [
            '_' => 'Θέμα του forum',

            'forum_topic_reply' => [
                '_' => 'Νέα απάντηση στο forum',
                'forum_topic_reply' => 'O χρήστης:username απάντησε στο θέμα του forum ":title".',
                'forum_topic_reply_compact' => ':username απάντησε',
            ],
        ],

        'team' => [
            'team_application' => [
                '_' => 'Αίτημα συμμετοχής ομάδας',

                'team_application_accept' => "Είσαι τώρα μέλος της ομάδας :title ",
                'team_application_accept_compact' => "Είσαι τώρα μέλος της ομάδας :title ",

                'team_application_group' => 'Ενημερώσεις αιτήματος συμμετοχής ομάδας',

                'team_application_reject' => 'Το αίτημά σου για ένταξη στην ομάδα :title έχει απορριφθεί',
                'team_application_reject_compact' => 'Το αίτημά σου για ένταξη στην ομάδα :title έχει απορριφθεί',
                'team_application_store' => ':title έκανε αίτημα για να μπει στην ομάδα σου',
                'team_application_store_compact' => ':title έκανε αίτημα για να μπει στην ομάδα σου',
            ],
        ],

        'user' => [
            'user_beatmapset_new' => [
                '_' => 'Νέο beatmap',

                'user_beatmapset_new' => 'Νέο beatmap ":title" από :username',
                'user_beatmapset_new_compact' => 'Νέο beatmap ":title"',
                'user_beatmapset_new_group' => 'Νέα beatmaps από :username',

                'user_beatmapset_revive' => 'Beatmap ":title" αναβιώθηκε από :username',
                'user_beatmapset_revive_compact' => 'Beatmap ":title" αναβιώθηκε',
            ],
        ],

        'user_achievement' => [
            '_' => 'Μετάλλια',

            'user_achievement_unlock' => [
                '_' => 'Νέο μετάλλιο',
                'user_achievement_unlock' => 'Ξεκλείδωτο ":title"!',
                'user_achievement_unlock_compact' => 'Ξεκλείδωτο ":title"!',
                'user_achievement_unlock_group' => 'Μετάλλια ξεκλειδώθηκαν!',
            ],
        ],
    ],

    'mail' => [
        'beatmapset' => [
            'beatmap_owner_change' => [
                'beatmap_owner_change' => 'Είσαι τώρα επισκέπτης του beatmap \'\':title\'\'',
            ],

            'beatmapset_discussion' => [
                'beatmapset_discussion_lock' => 'Η συζήτηση στο ":title" έχει κλείσει',
                'beatmapset_discussion_post_new' => 'Η συζήτηση στο ":title" έχει νέες ενημερώσεις',
                'beatmapset_discussion_unlock' => 'Η συζήτηση στο ":title" έχει ανοίξει',
            ],

            'beatmapset_problem' => [
                'beatmapset_discussion_qualified_problem' => 'Ένα νέο πρόβλημα αναφέρθηκε στο ":title"',
            ],

            'beatmapset_state' => [
                'beatmapset_disqualify' => '":title" έχει αποκλειστεί',
                'beatmapset_love' => '":title" προωθήθηκε στα αγαπημένα',
                'beatmapset_nominate' => 'Το ":title" έχει καταταχθεί',
                'beatmapset_qualify' => '":title" έχει κερδίσει αρκετές υποψηφιότητες και έχει εισέλθει στην ουρά κατάταξης',
                'beatmapset_rank' => '":title" έχει καταταχθεί',
                'beatmapset_remove_from_loved' => '":title" αφαιρέθηκε από τα αγαπημένα',
                'beatmapset_reset_nominations' => 'Η υποψηφιότητα του \'\':title\'\' έχει επαναφερθεί',
            ],

            'comment' => [
                'comment_new' => 'Το beatmap \'\':title\'\' έχει νέα σχόλια',
            ],
        ],

        'channel' => [
            'announcement' => [
                'channel_announcement' => 'Υπάρχει μια νέα ανακοίνωση στο ":name"',
            ],
            'channel' => [
                'channel_message' => 'Έλαβες ένα νέο μήνυμ από :username',
            ],
            'channel_team' => [
                'channel_team' => 'Υπάρχει ένα νέο μήνυμα στην ομάδα ":name"',
            ],
        ],

        'build' => [
            'comment' => [
                'comment_new' => 'Το ημερολόγιο αλλαγών \'\':title\'\' έχει νέα σχόλια',
            ],
        ],

        'news_post' => [
            'comment' => [
                'comment_new' => 'Νέα ":title" έχει νέα σχόλια',
            ],
        ],

        'forum_topic' => [
            'forum_topic_reply' => [
                'forum_topic_reply' => 'Υπάρχουν νέες απαντήσεις στο ":title"',
            ],
        ],

        'team' => [
            'team_application' => [
                'team_application_accept' => "Είσαι τώρα μέλος της ομάδας :title ",
                'team_application_reject' => 'Το αίτημά σου για ένταξη στην ομάδα :title έχει απορριφθεί',
                'team_application_store' => ':title έκανε αίτημα για να μπει στην ομάδα σου',
            ],
        ],

        'user' => [
            'user_beatmapset_new' => [
                'user_beatmapset_new' => ':username έχει δημιουργήσει νέα beatmaps',
                'user_beatmapset_revive' => ':username έχει αναβιώσει beatmaps',
            ],
        ],
    ],
];

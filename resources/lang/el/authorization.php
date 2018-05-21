<?php

/**
 *    Copyright 2015-2018 ppy Pty. Ltd.
 *
 *    This file is part of osu!web. osu!web is distributed with the hope of
 *    attracting more community contributions to the core ecosystem of osu!.
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License version 3
 *    as published by the Free Software Foundation.
 *
 *    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
 *    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *    See the GNU Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public License
 *    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
 */

return [
    'beatmap_discussion' => [
        'destroy' => [
            'is_hype' => 'Δεν μπορείτε να αναιρέσετε το hype.',
            'has_reply' => 'Δεν μπορείτε να διαγράψετε τη συζήτηση με απαντήσεις',
        ],
        'nominate' => [
            'exhausted' => 'Έχετε φτάσει στο όριο υποψηφιότητας για σήμερα, παρακαλώ προσπαθήστε ξανά αύριο.',
            'incorrect_state' => 'Σφάλμα κατά την εκτέλεση αυτής της ενέργειας, δοκιμάστε να ανανεώσετε τη σελίδα.',
            'owner' => "Δεν μπορείτε να κάνετε nominate το δικό σας beatmap.",
        ],
        'resolve' => [
            'not_owner' => 'Μόνο οι δημιουργοί thread και του beatmap μπορούν να λύσουν τη συζήτηση.',
        ],

        'vote' => [
            'limit_exceeded' => 'Παρακαλώ περιμένετε λίγο πριν ψηφίσετε ξανά',
            'owner' => "Δεν μπορείτε να ψηφίσετε τη δική σας συζήτηση.",
            'wrong_beatmapset_state' => 'Μπορείτε να ψηφίσετε μόνο σε συζήτηση των pending beatmap.',
        ],
    ],

    'beatmap_discussion_post' => [
        'edit' => [
            'system_generated' => 'Τα post που έχουν δημιουργηθεί αυτόματα δεν μπορούν να επεξεργαστούν.',
            'not_owner' => 'Μόνο ο δημιουργός της δημοσίευσης μπορεί να την επεξεργαστεί.',
        ],
    ],

    'chat' => [
        'channel' => [
            'read' => [
                'no_access' => 'Η πρόσβαση σε αυτό το κανάλι δεν είναι επιτρεπτή.',
            ],
        ],
        'message' => [
            'send' => [
                'channel' => [
                    'no_access' => 'Απαιτείται πρόσβαση για αυτό το κανάλι.',
                    'moderated' => 'Το κανάλι τροποποιείται αυτή τη στιγμή.',
                    'not_lazer' => 'Μπορείτε να μιλήσετε μόνο στο #lazer αυτή τη στιγμή.',
                ],

                'not_allowed' => 'Το μήνυμα δε μπορεί να σταλθεί όταν είστε banned/restricted/silenced.',
            ],
        ],
    ],

    'contest' => [
        'voting_over' => 'Δε μπορείτε να αλλάξετε την ψήφο σας αφού η περίοδος ψηφοφορίας γι\' αυτόν τον διαγωνισμό έχει τελειώσει.',
    ],

    'forum' => [
        'post' => [
            'delete' => [
                'only_last_post' => 'Μόνο το τελευταίο post μπορεί να διαγραφεί.',
                'locked' => 'Δεν μπορεί να διαγραφεί ποστ κλειδωμένου θέματος.',
                'no_forum_access' => 'Απαιτείται πρόσβαση για το συγκεκριμένο forum.',
                'not_owner' => 'Μόνο ο δημιουργός του post μπορεί να το διαγράψει.',
            ],

            'edit' => [
                'deleted' => 'Δεν μπορείτε να επεξεργαστείτε διαγραμμένο post.',
                'locked' => 'Αυτό το post δεν μπορεί να επεξεργαστεί λόγω κλειδώματος.',
                'no_forum_access' => 'Απαιτείται πρόσβαση για το συγκεκριμένο forum.',
                'not_owner' => 'Μόνο ο δημιουργός του post μπορεί να το επεξεργαστεί.',
                'topic_locked' => 'Δεν μπορείτε να επεξεργαστείτε post κλειδωμένου θέματος.',
            ],

            'store' => [
                'play_more' => 'Δοκιμάστε να παίξετε το παιχνίδι πριν δημοσιεύσετε στα forum, παρακαλώ! Αν έχετε πρόβλημα στο παιχνίδι, παρακαλώ γράψτε στο forum Βοήθεια και Υποστήριξη.',
                'too_many_help_posts' => "Πρέπει να παίξετε το παιχνίδι περισσότερο για να έχετε τη δυνατότητα να κάνετε περισσότερα post. Αν έχετε πρόβλημα παίζοντας το παιχνίδι στείλτε μας email στο support@ppy.sh", // FIXME: unhardcode email address.
            ],
        ],

        'topic' => [
            'reply' => [
                'double_post' => 'Μόλις κάνατε post. Περιμένετε λίγο ή επεξεργαστείτε το τελευταίο σας post.',
                'locked' => 'Δεν μπορείτε να απαντήσετε σε κλειδωμένο thread.',
                'no_forum_access' => 'Απαιτείται πρόσβαση για το συγκεκριμένο forum.',
                'no_permission' => 'Δεν έχετε την άδεια να απαντήσετε.',

                'user' => [
                    'require_login' => 'Παρακαλώ συνδεθείτε για να απαντήσετε.',
                    'restricted' => "Δε μπορείτε να απαντήσετε όταν είστε restricted.",
                    'silenced' => "Δε μπορείτε να απαντήσετε όταν είστε silenced.",
                ],
            ],

            'store' => [
                'no_forum_access' => 'Απαιτείται πρόσβαση για το συγκεκριμένο forum.',
                'no_permission' => 'Δεν έχετε την άδεια να δημιουργήσετε νέο θέμα.',
                'forum_closed' => 'Το forum είναι κλειστό και δε μπορείτε να κάνετε post σε αυτό.',
            ],

            'vote' => [
                'no_forum_access' => 'Απαιτείται πρόσβαση για το συγκεκριμένο forum.',
                'over' => 'Η ψηφοφορία έχει τερματιστεί και δε μπορείτε να ψηφίσετε.',
                'voted' => 'Δεν επιτρέπεται η αλλαγή ψήφου.',

                'user' => [
                    'require_login' => 'Παρακαλώ συνδεθείτε για να ψηφίσετε.',
                    'restricted' => "Δε μπορείτε να ψηφίσετε όταν είστε restricted.",
                    'silenced' => "Δε μπορείτε να ψηφίσετε όταν είστε silenced.",
                ],
            ],

            'watch' => [
                'no_forum_access' => 'Απαιτείται πρόσβαση για το συγκεκριμένο forum.',
            ],
        ],

        'topic_cover' => [
            'edit' => [
                'uneditable' => 'Καθορίσατε μη έγκυρο εξώφυλλο.',
                'not_owner' => 'Μόνο ο ιδιοκτήτης μπορεί να επεξεργαστεί το εξώφυλλο.',
            ],
        ],

        'view' => [
            'admin_only' => 'Μόνο ο admin μπορεί να δει αυτό το forum.',
        ],
    ],

    'require_login' => 'Παρακαλώ συνδεθείτε για να συνεχίσετε.',

    'unauthorized' => 'Απαγορεύεται η πρόσβαση.',

    'silenced' => "Δε μπορείτε να το κάνετε αυτό όσο είστε silenced.",

    'restricted' => "Δε μπορείτε να το κάνετε αυτό όσο είστε restricted.",

    'user' => [
        'page' => [
            'edit' => [
                'locked' => 'Η σελίδα του χρήστη είναι κλειδωμένη.',
                'not_owner' => 'Μπορείτε να επεξεργαστείτε μόνο τη δική σας σελίδα.',
                'require_supporter_tag' => 'Απαιτείται Supporter tag.',
            ],
        ],
    ],
];

<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'pinned_topics' => 'Καρφιτσωμένα Θέματα',
    'slogan' => "είναι επικίνδυνο να παίζετε μόνοι σας.",
    'subforums' => 'Υπο-φόρουμ',
    'title' => 'osu! φόρουμ',

    'covers' => [
        'edit' => '',

        'create' => [
            '_' => 'Επιλογή εικόνας εξωφύλλου',
            'button' => 'Ανεβάστε εικόνα',
            'info' => 'Το μέγεθος εξωφύλλου θα πρέπει να είναι :dimensions. Μπορείτε επίσης να αφήσετε την εικόνα σας εδώ για να την ανεβάσετε.',
        ],

        'destroy' => [
            '_' => 'Αφαίρεση εικόνας εξωφύλλου',
            'confirm' => 'Είστε σίγουροι ότι θέλετε να αφαιρέσετε την εικόνα εξωφύλλου;',
        ],
    ],

    'forums' => [
        'latest_post' => '',

        'index' => [
            'title' => '',
        ],

        'topics' => [
            'empty' => 'Δεν υπάρχουν θέματα!',
        ],
    ],

    'mark_as_read' => [
        'forum' => 'Επισήμανση forum ως αναγνωσμένo',
        'forums' => 'Επισήμανση forum ως αναγνωσμένα',
        'busy' => 'Σήμανση ως αναγνωσμένου...',
    ],

    'post' => [
        'confirm_destroy' => 'Σίγουρα διαγραφή της δημοσίευσης;',
        'confirm_restore' => 'Σίγουρα επαναφορά της δημοσίευσης;',
        'edited' => 'Τελευταία τροποποίηση από τον χρήστη :user :when, τροποποιήθηκε :count φορές συνολικά.',
        'posted_at' => 'δημοσιεύτηκε :when',
        'posted_by' => '',

        'actions' => [
            'destroy' => 'Διαγραφή δημοσίευσης',
            'edit' => 'Επεξεργασία δημοσίευσης',
            'report' => '',
            'restore' => 'Επαναφορά δημοσίευσης',
        ],

        'create' => [
            'title' => [
                'reply' => '',
            ],
        ],

        'info' => [
            'post_count' => ':count_delimited δημοσίευση|:count_delimited δημοσιεύσεις',
            'topic_starter' => 'Δημιουργός του Θέματος',
        ],
    ],

    'search' => [
        'go_to_post' => 'Μετάβαση στη δημοσίευση',
        'post_number_input' => 'εισάγετε τον αριθμό δημοσίευσης',
        'total_posts' => ':posts_count δημοσιεύσεις συνολικά',
    ],

    'topic' => [
        'confirm_destroy' => '',
        'confirm_restore' => '',
        'deleted' => 'διαγραμμένο θέμα',
        'go_to_latest' => 'δείτε την πιο πρόσφατη δημοσίευση',
        'has_replied' => '',
        'in_forum' => '',
        'latest_post' => ':when από τον :user',
        'latest_reply_by' => 'τελευταία απάντηση από τον :user',
        'new_topic' => 'Δημοσιεύστε νέο θέμα',
        'new_topic_login' => 'Συνδεθείτε για να δημοσιεύσετε νέο θέμα',
        'post_reply' => 'Δημοσίευση',
        'reply_box_placeholder' => 'Πληκτρολογήστε εδώ για να απαντήσετε',
        'reply_title_prefix' => 'Re',
        'started_by' => 'από τον :user',
        'started_by_verbose' => 'ξεκίνησε από :user',

        'actions' => [
            'destroy' => '',
            'restore' => '',
        ],

        'create' => [
            'close' => '',
            'preview' => 'Προεπισκόπηση',
            // TL note: this is used in the topic reply preview, when
            // the user goes back from previewing to editing the reply
            'preview_hide' => 'Γράψτε',
            'submit' => 'Δημοσίευση',

            'necropost' => [
                'default' => 'Αυτό το θέμα έχει παραμείνει ανενεργό για κάποιο καιρό. Δημοσιεύστε εδώ μόνο αν έχετε κάποιο συγκεκριμένο λόγο.',

                'new_topic' => [
                    '_' => "Αυτό το θέμα έχει παραμείνει ανενεργό για κάποιο καιρό. Αν δεν έχετε κάποιο συγκεκριμένο λόγο για να δημοσιεύσετε εδώ, παρακαλώ :create αντ' αυτού.",
                    'create' => 'δημιουργήστε ένα νέο θέμα',
                ],
            ],

            'placeholder' => [
                'body' => 'Πληκτρολογήστε το περιεχόμενο της δημοσίευσης εδώ',
                'title' => 'Κάντε κλικ εδώ για να ορίσετε τον τίτλο',
            ],
        ],

        'jump' => [
            'enter' => 'κάντε κλικ για να βάλετε συγκεκριμένο αριθμό δημοσίευσης',
            'first' => 'μεταβείτε στην πρώτη δημοσίευση',
            'last' => 'μεταβείτε στην τελευταία δημοσίευση',
            'next' => 'παράλειψη των 10 επόμενων δημοσιεύσεων',
            'previous' => 'μετάβαση σε 10 δημοσιεύσεις πίσω',
        ],

        'post_edit' => [
            'cancel' => 'Ακύρωση',
            'post' => 'Αποθήκευση',
        ],
    ],

    'topic_watches' => [
        'index' => [
            'title_compact' => 'εγγραφές φόρουμ',

            'box' => [
                'total' => 'Θέματα στα οποία έχετε εγγραφεί',
                'unread' => 'Θέματα με νέες απαντήσεις',
            ],

            'info' => [
                'total' => 'Έχετε εγγραφεί σε :total θέματα.',
                'unread' => 'Έχετε :unread μη αναγνωσμένες απαντήσεις σε θέματα που έχετε εγγραφεί.',
            ],
        ],

        'topic_buttons' => [
            'remove' => [
                'confirmation' => 'Κατάργηση εγγραφής από το θέμα;',
                'title' => 'Κατάργηση εγγραφής',
            ],
        ],
    ],

    'topics' => [
        '_' => 'Θέματα',

        'actions' => [
            'login_reply' => 'Συνδεθείτε για να Aπαντήσετε',
            'reply' => 'Απάντηση',
            'reply_with_quote' => 'Ανάφερε post ως απάντηση',
            'search' => 'Αναζήτηση',
        ],

        'create' => [
            'create_poll' => 'Δημιουργία ψηφοφορίας',

            'preview' => 'Προεπισκόπηση Δημοσίευσης',

            'create_poll_button' => [
                'add' => 'Δημιούργησε ψηφοφορία',
                'remove' => 'Ακύρωση δημιουργίας ψηφοφορίας',
            ],

            'poll' => [
                'hide_results' => 'Απόκρυψη των αποτελεσμάτων της ψηφοφορίας.',
                'hide_results_info' => 'Θα φανερωθούν μόνο μετά τη λήξη της ψηφοφορίας.',
                'length' => 'Διεξαγωγή ψηφοφορίας για',
                'length_days_suffix' => 'μέρες',
                'length_info' => 'Αφήστε κενό για μία ατελείωτη ψηφοφορία',
                'max_options' => 'Επιλογές ανά χρήστη',
                'max_options_info' => 'Αυτός είναι ο αριθμός επιλογών που μπορεί να επιλέξει ο κάθε χρήστης όταν ψηφίζει.',
                'options' => 'Επιλογές',
                'options_info' => 'Τοποθέτησε κάθε επιλογή σε καινούργια γραμμή. Μπορείτε να εισάγετε μέχρι 10 επιλογές.',
                'title' => 'Ερώτηση',
                'vote_change' => 'Επιτρέπεται η αλλαγή ψήφου.',
                'vote_change_info' => 'Αν ενεργοποιηθεί. οι χρήστες θα μπορούν να αλλάξουν την ψήφο τους.',
            ],
        ],

        'edit_title' => [
            'start' => 'Επεξεργασία τίτλου',
        ],

        'index' => [
            'feature_votes' => 'βάσει αστεριών',
            'replies' => 'απαντήσεις',
            'views' => 'προβολές',
        ],

        'issue_tag_added' => [
            'to_0' => 'Αφαίρεση του tag \'\'added\'\'',
            'to_0_done' => 'Το tag \'\'added\'\' αφαιρέθηκε',
            'to_1' => 'Πρόσθεση του tag \'\'added\'\'',
            'to_1_done' => 'To tag \'\'added\'\' προστέθηκε',
        ],

        'issue_tag_assigned' => [
            'to_0' => 'Αφαίρεση του tag \'\'assigned"',
            'to_0_done' => 'Το tag "assigned" αφαιρέθηκε',
            'to_1' => 'Πρόσθεση του tag "assigned"',
            'to_1_done' => 'To tag "assigned" προστέθηκε',
        ],

        'issue_tag_confirmed' => [
            'to_0' => 'Αφαίρεση του tag "confirmed"',
            'to_0_done' => 'Το tag "confirmed" αφαιρέθηκε',
            'to_1' => 'Πρόσθεση του tag "confirmed"',
            'to_1_done' => 'Το tag "confirmed" προστέθηκε',
        ],

        'issue_tag_duplicate' => [
            'to_0' => 'Αφαίρεση του tag "duplicate"',
            'to_0_done' => 'To tag "duplicate" αφαιρέθηκε',
            'to_1' => 'Πρόσθεση του tag "duplicate"',
            'to_1_done' => 'To tag "duplicate" προστέθηκε',
        ],

        'issue_tag_invalid' => [
            'to_0' => 'Αφαίρεση του tag "invalid"',
            'to_0_done' => 'To tag "invalid" αφαιρέθηκε',
            'to_1' => 'Πρόσθεση του tag "invalid"',
            'to_1_done' => 'To tag "invalid" προστέθηκε',
        ],

        'issue_tag_resolved' => [
            'to_0' => 'Αφαίρεση του tag "resolved"',
            'to_0_done' => 'To tag "resolved" αφαιρέθηκε',
            'to_1' => 'Πρόσθεση του tag "resolved"',
            'to_1_done' => 'Το tag "resolved" προστέθηκε',
        ],

        'lock' => [
            'is_locked' => 'Η συζήτηση κλειδώθηκε και δεν δέχεται άλλες απαντήσεις',
            'to_0' => 'Ξεκλειδώστε το θέμα',
            'to_0_confirm' => '',
            'to_0_done' => 'Το θέμα ξεκλειδώθηκε',
            'to_1' => 'Κλειδώστε το θέμα',
            'to_1_confirm' => '',
            'to_1_done' => 'Το θέμα κλειδώθηκε',
        ],

        'moderate_move' => [
            'title' => 'Πηγαίντε σε άλλο φόρουμ',
        ],

        'moderate_pin' => [
            'to_0' => 'Ξεκαρφίτσωμα θέματος',
            'to_0_confirm' => '',
            'to_0_done' => 'Το θέμα ξεκαρφιτσώθηκε',
            'to_1' => 'Καρφίτσωμα θέματος',
            'to_1_confirm' => '',
            'to_1_done' => 'Το θέμα καρφιτσώθηκε',
            'to_2' => 'Καρφίτσωμα θέματος και σήμανση ως ανακοίνωση',
            'to_2_confirm' => '',
            'to_2_done' => 'Το θέμα καρφιτσώθηκε και σημάνθηκε ως ανακοίνωση',
        ],

        'moderate_toggle_deleted' => [
            'show' => '',
            'hide' => '',
        ],

        'show' => [
            'deleted-posts' => 'Διαγραμμένες Δημοσιεύσεις',
            'total_posts' => 'Σύνολο Δημοσιεύσεων',

            'feature_vote' => [
                'current' => 'Τρέχουσα Προτεραιότητα +:count',
                'do' => 'Προαγωγή αυτού του αιτήματος',

                'info' => [
                    '_' => 'Αυτό είναι ένα :feature_request. Τα αιτήματα για λειτουργίες μπορούν να ψηφισθούν από τους :supporters.',
                    'feature_request' => 'αίτημα για λειτουργία',
                    'supporters' => 'supporters',
                ],

                'user' => [
                    'count' => '{0} καμία ψήφος|{1} :count ψήφος|[2,*] :count ψήφοι',
                    'current' => 'Σας απομένουν :votes.',
                    'not_enough' => "Δε σας απομένουν ψήφοι",
                ],
            ],

            'poll' => [
                'edit' => '',
                'edit_warning' => '',
                'vote' => 'Ψηφίστε',

                'button' => [
                    'change_vote' => '',
                    'edit' => '',
                    'view_results' => '',
                    'vote' => '',
                ],

                'detail' => [
                    'end_time' => 'Η ψηφοφορία θα λήξει στις :time',
                    'ended' => 'H ψηφοφορία έληξε στις :time',
                    'results_hidden' => 'Τα αποτελέσματα θα φανερωθούν μόνο μετά τη λήξη της ψηφοφορίας.',
                    'total' => 'Σύνολο ψήφων: :count',
                ],
            ],
        ],

        'watch' => [
            'to_not_watching' => 'Χωρίς σελιδοδείκτη',
            'to_watching' => 'Βάλτε Σελιδοδείκτη',
            'to_watching_mail' => 'Βάλτε σελιδοδείκτη με ειδοποίηση',
            'tooltip_mail_disable' => 'Η Ειδοποίηση είναι ενεργοποιημένη. Κάντε κλικ για να απενεργοποίηση',
            'tooltip_mail_enable' => 'Η ειδοποίηση είναι απενεργοποιημένη. Κάντε κλικ για ενεργοποίηση',
        ],
    ],
];

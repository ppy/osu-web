<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'authorizations' => [
        'update' => [
            'null_user' => 'Πρέπει να είστε συνδεδεμένοι για να κάνετε επεξεργασία.',
            'system_generated' => 'Οι δημοσιεύσεις που δημιουργήθηκαν από το σύστημα δεν μπορούν να επεξεργαστούν.',
            'wrong_user' => 'Πρέπει να είστε ο δημιουργός της δημοσίευσης για να την επεξεργαστείτε.',
        ],
    ],

    'events' => [
        'empty' => 'Δεν έχει συμβεί τίποτα... ακόμη.',
    ],

    'index' => [
        'deleted_beatmap' => 'διαγραμμένο',
        'none_found' => '',
        'title' => 'Συζητήσεις περί Beatmap',

        'form' => [
            '_' => 'Αναζήτηση',
            'deleted' => 'Συμπεριλάμβανε διαγραμμένες συζητήσεις',
            'mode' => '',
            'only_unresolved' => '',
            'types' => 'Τύποι μηνυμάτων',
            'username' => 'Όνομα χρήστη',

            'beatmapset_status' => [
                '_' => '',
                'all' => 'Όλα',
                'disqualified' => '',
                'never_qualified' => '',
                'qualified' => '',
                'ranked' => '',
            ],

            'user' => [
                'label' => 'Χρήστης',
                'overview' => 'Επισκόπηση δραστηριοτήτων',
            ],
        ],
    ],

    'item' => [
        'created_at' => 'Ημερομηνία ανάρτησης',
        'deleted_at' => 'Ημερομηνία διαγραφής',
        'message_type' => 'Γράψε',
        'permalink' => 'Μόνιμος σύνδεσμος',
    ],

    'nearby_posts' => [
        'confirm' => 'Καμία δημοσίευση δεν απαντάει στο ερώτημά μου',
        'notice' => 'Υπάρχουν αναρτήσεις περίπου :timestamp (:existing_timestamps). Παρακαλώ να τις ελέγξετε πριν αναρτήσετε.',
        'unsaved' => '',
    ],

    'owner_editor' => [
        'button' => '',
        'reset_confirm' => '',
        'user' => '',
        'version' => '',
    ],

    'reply' => [
        'open' => [
            'guest' => 'Συνδεθείτε για να Aπαντήσετε',
            'user' => 'Απαντήστε',
        ],
    ],

    'review' => [
        'block_count' => '',
        'go_to_parent' => '',
        'go_to_child' => 'Προβολή Συζήτησης',
        'validation' => [
            'block_too_large' => 'κάθε block μπορεί να περιέχει μόνο έως :limit χαρακτήρες',
            'external_references' => '',
            'invalid_block_type' => '',
            'invalid_document' => '',
            'invalid_discussion_type' => '',
            'minimum_issues' => '',
            'missing_text' => '',
            'too_many_blocks' => '',
        ],
    ],

    'system' => [
        'resolved' => [
            'true' => 'Σημειώθηκε ως επιλυμένο από :user',
            'false' => 'Ανοίχθηκε ξανά από τον :user',
        ],
    ],

    'timestamp_display' => [
        'general' => 'γενικά',
        'general_all' => 'γενικά (όλα)',
    ],

    'user_filter' => [
        'everyone' => 'Όλοι',
        'label' => 'Φιλτράρισμα ανά χρήστη',
    ],
];

<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
 */

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
        'title' => 'Συζητήσεις περί Beatmap',

        'form' => [
            '_' => 'Αναζήτηση',
            'deleted' => 'Συμπεριλάμβανε διαγραμμένες συζητήσεις',
            'only_unresolved' => '',
            'types' => 'Τύποι μηνυμάτων',
            'username' => 'Όνομα χρήστη',

            'beatmapset_status' => [
                '_' => '',
                'all' => '',
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
    ],

    'reply' => [
        'open' => [
            'guest' => 'Συνδεθείτε για να Aπαντήσετε',
            'user' => 'Απαντήστε',
        ],
    ],

    'system' => [
        'resolved' => [
            'true' => 'Σημειώθηκε ως επιλυμένο από :user',
            'false' => 'Ανοίχθηκε ξανά από τον :user',
        ],
    ],

    'user_filter' => [
        'everyone' => 'Όλοι',
        'label' => 'Φιλτράρισμα ανά χρήστη',
    ],
];

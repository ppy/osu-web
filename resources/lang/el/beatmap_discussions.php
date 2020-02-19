<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
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

    'review' => [
        'go_to_parent' => '',
        'go_to_child' => '',
        'validation' => [
            'invalid_block_type' => '',
            'invalid_document' => '',
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
        'general' => '',
        'general_all' => '',
    ],

    'user_filter' => [
        'everyone' => 'Όλοι',
        'label' => 'Φιλτράρισμα ανά χρήστη',
    ],
];

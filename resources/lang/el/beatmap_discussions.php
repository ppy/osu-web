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
    'authorizations' => [
        'update' => [
            'null_user' => 'Πρέπει να συνδεθείτε για επεξεργασία.',
            'system_generated' => 'Τα post που έχει δημιουργηθεί αυτόματα δεν μπορεί να επεξεργαστεί.',
            'wrong_user' => 'Πρέπει να είστε δημιουργός του post για να το επεξεργαστείτε.',
        ],
    ],

    'events' => [
        'empty' => 'Δεν έχει συμβεί τίποτε... ακόμα.',
    ],

    'index' => [
        'deleted_beatmap' => 'διαγραμμένο',
        'title' => 'Συζητήσεις περί Beatmap',

        'form' => [
            'deleted' => 'Περιέχει διαγραμμένες συζητήσεις',

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
        'confirm' => 'Κανένα post δεν απανταεί στο ερώτημα μου',
        'notice' => 'Υπάρχουν αναρτήσεις περίπου :timestamp (:existing_timestamps). Παρακαλώ να τις ελέγξετε πριν αναρτήσετε.',
    ],

    'reply' => [
        'open' => [
            'guest' => 'Συνδεθείτε για να απαντήσετε',
            'user' => 'Απάντηση',
        ],
    ],

    'system' => [
        'resolved' => [
            'true' => 'Μαρκαρίστηκε ως επιλυμένο από :user',
            'false' => 'Ξανανοίξει από :user',
        ],
    ],

    'user' => [
        'admin' => 'διαχειριστής',
        'bng' => 'υποψήφιος',
        'owner' => 'δημιουργός',
        'qat' => 'qat',
    ],

    'user_filter' => [
        'everyone' => 'Όλοι',
        'label' => 'Φιλτράρισμα ανά χρήστη',
    ],
];

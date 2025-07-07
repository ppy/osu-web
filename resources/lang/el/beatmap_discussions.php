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
        'none_found' => 'Δεν βρέθηκαν συζητήσεις που να ταιριάζουν με τα κριτήρια αναζήτησης.',
        'title' => 'Συζητήσεις περί Beatmap',

        'form' => [
            '_' => 'Αναζήτηση',
            'deleted' => 'Συμπεριλάμβανε διαγραμμένες συζητήσεις',
            'mode' => 'Λειτουργία Beatmap',
            'only_unresolved' => 'Εμφάνιση μόνο ανεπίλυτων συζητήσεων',
            'show_review_embeds' => 'Εμφάνιση αναρτήσεων αξιολόγησης',
            'types' => 'Τύποι μηνυμάτων',
            'username' => 'Όνομα χρήστη',

            'beatmapset_status' => [
                '_' => 'Beatmap Status',
                'all' => 'Όλα',
                'disqualified' => 'Αποκλεισμένος',
                'never_qualified' => 'Ποτέ Μη Κατάλληλο',
                'qualified' => 'Πιστοποιημένα',
                'ranked' => 'Κατάταξη',
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
        'unsaved' => ':count σε αυτή την κριτική',
    ],

    'owner_editor' => [
        'button' => 'Δυσκολία Ιδιοκτήτη',
        'reset_confirm' => 'Επαναφορά ιδιοκτήτη για αυτή τη δυσκολία;',
        'user' => 'Ιδιοκτήτης',
        'version' => 'Δυσκολία',
    ],

    'refresh' => [
        'checking' => 'Έλεγχος για ενημερώσεις...',
        'has_updates' => 'Η συζήτηση έχει ενημερώσεις, κάνε κλικ για ανανέωση.',
        'no_updates' => 'Καμιά ενημέρωση',
        'updating' => 'Γίνεται ενημέρωση...',
    ],

    'reply' => [
        'open' => [
            'guest' => 'Συνδεθείτε για να Aπαντήσετε',
            'user' => 'Απαντήστε',
        ],
    ],

    'review' => [
        'block_count' => ':used / :max σε χρήση μπλοκ',
        'go_to_parent' => 'Προβολή Ανάρτησης Κριτικής',
        'go_to_child' => 'Προβολή Συζήτησης',
        'validation' => [
            'block_too_large' => 'κάθε block μπορεί να περιέχει μόνο έως :limit χαρακτήρες',
            'external_references' => 'ανασκόπηση περιέχει αναφορές σε ζητήματα που δεν ανήκουν σε αυτή την ανασκόπηση',
            'invalid_block_type' => 'μη έγκυρος τύπος μπλοκ',
            'invalid_document' => 'μη έγκυρη κριτική',
            'invalid_discussion_type' => 'μη έγκυρος τύπος συζήτησης',
            'minimum_issues' => 'η κριτική πρέπει να περιέχει τουλάχιστον θέμα :count : η κριτική πρέπει να περιέχει τουλάχιστον ζητήματα :count',
            'missing_text' => 'το μπλοκ λείπει κείμενο',
            'too_many_blocks' => 'οι κριτικές μπορεί να περιέχουν μόνο :count παράγραφο/ζήτημα/σχόλια μπορεί να περιέχουν μόνο έως και :count παραγράφους/ζητήματα',
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

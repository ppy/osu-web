<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'applications' => [
        'accept' => [
            'ok' => 'Προστέθηκε χρήστης στην ομάδα.',
        ],
        'destroy' => [
            'ok' => 'Ακυρώθηκε το αίτημα συμμετοχής.',
        ],
        'reject' => [
            'ok' => 'Απορρίφθηκε το ίτημα συμμετοχής',
        ],
        'store' => [
            'ok' => 'Ζητήθηκε το αίτημα για τη συμμετοχή στην ομάδα',
        ],
    ],

    'card' => [
        'members' => ':count_delimited μέλος|:count_delimited μέλη',
    ],

    'create' => [
        'submit' => 'Δημιουργία Ομάδας',

        'form' => [
            'name_help' => 'Το όνομα της ομάδας σου. Το όνομα είναι μόνιμο αυτή τη στιγμή.',
            'short_name_help' => 'Μέγιστο 4 χαρακτήρες.',
            'title' => "Ας δημιουργήσουμε μια νέα ομάδα",
        ],

        'intro' => [
            'description' => "Παίξε μαζί με φίλους, υπάρχοντες ή νέους. Δεν βρίσκεσαι σε ομάδα. Μπες σε μία υπάρχουσα ομάδα επισκέπτοντας την σελίδα ομάδας ή δημιούργησε την δικιά σου ομάδα από αυτήν τη σελίδα.",
            'title' => 'Ομάδα!',
        ],
    ],

    'destroy' => [
        'ok' => 'Η ομάδα αφαιρέθηκε.',
    ],

    'edit' => [
        'ok' => 'Οι ρυθμίσεις αποθηκεύτηκαν επιτυχώς.',
        'title' => 'Ρυθμίσεις Ομάδας',

        'description' => [
            'label' => 'Περιγραφή',
            'title' => 'Περιγραφή Ομάδας',
        ],

        'flag' => [
            'label' => 'Σημαία Ομάδας',
            'title' => 'Ορισμός Σημαίας Ομάδας',
        ],

        'header' => [
            'label' => 'Εικόνα Κεφαλίδας',
            'title' => 'Ορισμός Εικόνας Κεφαλίδας',
        ],

        'settings' => [
            'application_help' => 'Αν θα επιτρέπεται σε άτομα να υποβάλουν αίτηση για την ομάδα',
            'default_ruleset_help' => 'Το σύνολο κανόνων που θα επιλεγεί από προεπιλογή κατά την επίσκεψη στη σελίδα της ομάδας',
            'flag_help' => 'Μέγιστο μέγεθος :width×:height',
            'header_help' => 'Μέγιστο μέγεθος :width×:height',
            'title' => 'Ρυθμίσεις Ομάδας',

            'application_state' => [
                'state_0' => 'Κλειστό',
                'state_1' => 'Ανοιχτό',
            ],
        ],
    ],

    'header_links' => [
        'edit' => 'ρυθμίσεις',
        'leaderboard' => 'Κατάταξη',
        'show' => 'πληροφορίες',

        'members' => [
            'index' => 'Διαχείριση μελών',
        ],
    ],

    'leaderboard' => [
        'global_rank' => 'Παγκόσμια Κατάταξη',
    ],

    'members' => [
        'destroy' => [
            'success' => 'Μέλος της ομάδας αφαιρέθηκε',
        ],

        'index' => [
            'title' => 'Διαχείριση μελών',

            'applications' => [
                'accept_confirm' => 'Προσθήκη χρήστη :user στην ομάδα;',
                'created_at' => 'Ζητήθηκε Στις',
                'empty' => 'Δεν υπάρχουν αιτήσεις συμμετοχής αυτή τη στιγμή.',
                'empty_slots' => 'Διαθέσιμες υποδοχές',
                'empty_slots_overflow' => ':count_delimited συνδεδεμένος χρήστης |:count_delimited συνδεδεμένοι χρήστες',
                'reject_confirm' => 'Άρνηση αίτησης συμμετοχής από τον χρήστη :user;',
                'title' => 'Αιτήματα συμμετοχής',
            ],

            'table' => [
                'joined_at' => 'Ημερομηνία Συμμετοχής',
                'remove' => 'Αφαίρεση',
                'remove_confirm' => 'Αφαίρεση χρήστη :user από την ομάδα;',
                'set_leader' => 'Μεταφορά ηγεσίας ομάδας',
                'set_leader_confirm' => 'Μεταφορά ηγεσίας της ομάδας στον χρήστη :user;',
                'status' => 'Κατάσταση',
                'title' => 'Τρέχοντα μέλη',
            ],

            'status' => [
                'status_0' => 'Ανενεργός',
                'status_1' => 'Ενεργός',
            ],
        ],

        'set_leader' => [
            'success' => 'Ο χρήστης :user είναι τώρα ο αρχηγός της ομάδας.',
        ],
    ],

    'part' => [
        'ok' => 'Έφυγε από την ομάδα ;_;',
    ],

    'show' => [
        'bar' => [
            'chat' => 'Συνομιλία Ομάδας',
            'destroy' => 'Διάλυση Ομάδας',
            'join' => 'Αίτημα Συμμετοχής',
            'join_cancel' => 'Ακύρωση Σύμμετοχής',
            'part' => 'Αποχώρηση Από Την Ομάδα',
        ],

        'info' => [
            'created' => 'Σχηματίστηκε',
        ],

        'members' => [
            'members' => 'Μέλη Ομάδας',
            'owner' => 'Αρχηγός ομάδας',
        ],

        'sections' => [
            'about' => 'Σχετικά Με Εμάς!',
            'info' => 'Πληροφορίες',
            'members' => 'Μέλη',
        ],

        'statistics' => [
            'empty_slots' => ':count_delimited διαθέσιμη υποδοχή|:count_delimited διαθέσιμες υποδοχές',
            'first_places' => '',
            'leader' => 'Αρχηγός Ομάδας',
            'rank' => 'Κατάταξη',
            'ranked_beatmapsets' => '',
        ],
    ],

    'store' => [
        'ok' => 'Η ομάδα δημιουργήθηκε.',
    ],
];

<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'cancel' => 'Ακύρωση',

    'authorise' => [
        'app_owner' => 'μια εφαρμογή από :owner',
        'request' => 'ζητά άδεια για πρόσβαση στον λογαριασμό σας.',
        'scopes_title' => 'Αυτή η εφαρμογή θα μπορεί να:',
        'title' => 'Αίτηση Εξουσιοδότησης',
    ],

    'authorized_clients' => [
        'confirm_revoke' => 'Είστε βέβαιοι ότι θέλετε να ανακαλέσετε τα δικαιώματα αυτού του client;',
        'scopes_title' => 'Αυτή η εφαρμογή μπορεί:',
        'owned_by' => 'Ανήκει σε :user',
        'none' => 'Δεν Υπάρχουν clients',

        'revoked' => [
            'false' => 'Ανάκληση Πρόσβασης',
            'true' => 'Ανάκληση Πρόσβασης',
        ],
    ],

    'client' => [
        'id' => 'Ταυτότητα Client',
        'name' => 'Όνομα Εφαρμογής',
        'redirect' => 'Url Επανάκλησης Εφαρμογής',
        'reset' => 'Επαναφορά μυστικού client',
        'reset_failed' => 'Αποτυχία επαναφοράς του μυστικού client',
        'secret' => 'Μυστικό Client',

        'secret_visible' => [
            'false' => 'Εμφάνιση μυστικού client',
            'true' => 'Απόκρυψη μυστικού client',
        ],
    ],

    'new_client' => [
        'header' => 'Καταχωρήστε μια νέα εφαρμογή OAuth',
        'register' => 'Εγγραφή αίτησης',
        'terms_of_use' => [
            '_' => 'Χρησιμοποιώντας το API συμφωνείτε με το :link.',
            'link' => 'Όροι χρήσης',
        ],
    ],

    'own_clients' => [
        'confirm_delete' => 'Είστε βέβαιοι ότι θέλετε να διαγράψετε αυτόν τον πελάτη;',
        'confirm_reset' => 'Είστε βέβαιοι ότι θέλετε να επαναφέρετε το μυστικό του πελάτη? Αυτό θα ανακαλέσει όλα τα υπάρχοντα Tokens.',
        'new' => 'Νέα Εφαρμογή Oauth',
        'none' => 'Δεν Υπάρχουν Clients',

        'revoked' => [
            'false' => 'Διαγραφή',
            'true' => 'Διαγράφηκε',
        ],
    ],
];

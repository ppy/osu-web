<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'box' => [
        'sent' => 'Ένα email έχει σταλεί στο :mail με έναν κωδικό επιβεβαίωσης. Εισάγετε τον κωδικό.',
        'title' => 'Επαλήθευση του λογαριασμού',
        'verifying' => 'Επαλήθευση...',
        'issuing' => 'Δημιουργία νέου κωδικού...',

        'info' => [
            'check_spam' => "Σιγουρευτείτε ότι ελέγξατε τον φάκελο ανεπιθύμητης αλληλογραφίας (spam) αν δεν μπορείτε να βρείτε το email.",
            'recover' => "Αν δεν έχετε πρόσβαση στο email σας ή έχετε ξεχάσει ποιο χρησιμοποιήσατε, παρακαλώ ακολουθήστε τη :link.",
            'recover_link' => 'διαδικασία ανάκτησης email εδώ',
            'reissue' => 'Μπορείτε επίσης να :reissue_link ή να :logout_link.',
            'reissue_link' => 'ζητήσετε άλλον κωδικό',
            'logout_link' => 'αποσυνδεθείτε',
        ],
    ],

    'errors' => [
        'expired' => 'Ο κωδικός επαλήθευσης έληξε, ένα νέο email επαλήθευσης έχει σταλεί.',
        'incorrect_key' => 'Μη έγκυρος κωδικός επαλήθευσης.',
        'retries_exceeded' => 'Μη έγκυρος κωδικός επαλήθευσης. Το όριο προσπαθειών ξεπεράστηκε, ένα νέο email επαλήθευσης έχει σταλεί.',
        'reissued' => 'Ο κωδικός επαλήθευσης δημιουργήθηκε, ένα νέο email επαλήθευσης έχει σταλεί.',
        'unknown' => 'Παρουσιάστηκε άγνωστο πρόβλημα, στάλθηκε νέο email επαλήθευσης.',
    ],
];

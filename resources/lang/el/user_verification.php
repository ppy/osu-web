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

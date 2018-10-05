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
    'admin' => [
        'warehouse' => 'Αποθήκη',
    ],

    'cart' => [
        'checkout' => 'Ολοκλήρωση αγοράς',
        'more_goodies' => 'Θέλω να ελέγξω περισσότερα καλούδια πριν ολοκληρώσω την παραγγελία',
        'shipping_fees' => 'έξοδα αποστολής',
        'title' => 'Καλάθι Αγορών',
        'total' => 'σύνολο',

        'errors_no_checkout' => [
            'line_1' => 'Ωχ, υπάρχουν προβλήματα με το καλάθι σας που εμποδίζουν την ολοκλήρωση της αγοράς!',
            'line_2' => 'Καταργήστε ή ενημερώστε τα παραπάνω στοιχεία για να συνεχίσετε.',
        ],

        'empty' => [
            'text' => 'Το καλάθι σας είναι άδειο.',
            'return_link' => [
                '_' => 'Επιστροφή στη :link για να βρείτε μερικά καλούδια!',
                'link_text' => 'λίστα του καταστήματος',
            ],
        ],
    ],

    'checkout' => [
        'cart_problems' => 'Ουπς, υπάρχει πρόβλημα με το καλάθι σας!',
        'cart_problems_edit' => 'Κάντε κλικ εδώ για να το επεξεργαστείτε.',
        'declined' => 'Η πληρωμή ακυρώθηκε.',
        'old_cart' => 'Το καλάθι σας φαίνεται να έχει ξεπερασμένα πράγματα και έχει ανανεωθεί, παρακαλώ προσπαθήστε ξανά.',
        'pay' => 'Ολοκλήρωση αγοράς με Paypal',
        'pending_checkout' => [
            'line_1' => 'Μία προηγούμενη πληρωμή άρχισε αλλά δεν τελείωσε.',
            'line_2' => 'Συνεχίστε την πληρωμή σας επιλέγοντας μία μέθοδο πληρωμής, ή :link για ακύρωση.',
            'link_text' => 'κάνε κλικ εδώ',
        ],
        'delayed_shipping' => 'Προσωρινά μας έχουν κατακλύσει οι παραγγελίες! Μπορείτε να παραγγείλετε, αλλά παρακαλούμε να περιμένετε **1-2 εβδομάδες επιπλέον** ενώ προσπαθούμε να προλάβουμε τις υπάρχουσες παραγγελίες.',
    ],

    'discount' => 'κερδίστε :percent%',

    'mail' => [
        'payment_completed' => [
            'subject' => 'Λάβαμε την παραγγελία σας από το osu!store!',
        ],
    ],

    'order' => [
        'item' => [
            'display_name' => [
                'supporter_tag' => ':name για τον χρήστη :username (:duration)',
            ],
            'quantity' => 'Ποσότητα',
        ],

        'not_modifiable_exception' => [
            'cancelled' => 'Δεν μπορείτε να τροποποιήσετε την παραγγελία σας καθώς έχει ακυρωθεί.',
            'checkout' => 'Δεν μπορείτε να τροποποιήσετε την παραγγελία σας όσο βρίσκεται υπό επεξεργασία.', // checkout and processing should have the same message.
            'default' => 'Η παραγγελία δεν είναι τροποποιήσιμη',
            'delivered' => 'Δεν μπορείτε να τροποποιήσετε την παραγγελία σας καθώς έχει ήδη παραδοθεί.',
            'paid' => 'Δεν μπορείτε να τροποποιήσετε την παραγγελία σας καθώς έχει ήδη πληρωθεί.',
            'processing' => 'Δεν μπορείτε να τροποποιήσετε την παραγγελία σας όσο βρίσκεται υπό επεξεργασία.',
            'shipped' => 'Δεν μπορείτε να τροποποιήσετε την παραγγελία σας καθώς έχει ήδη αποσταλεί.',
        ],
    ],

    'product' => [
        'name' => 'Όνομα',

        'stock' => [
            'out' => 'Αυτό το αντικείμενο έχει εξαντληθεί προσωρινά. Ελέγξτε ξανά αργότερα!',
            'out_with_alternative' => 'Δυστυχώς αυτό το αντικείμενο έχει εξαντληθεί. Χρησιμοποιήστε το αναπτυσσόμενο μενού για να επιλέξετε έναν διαφορετικό τύπο ή ελέγξτε ξανά αργότερα!',
        ],

        'add_to_cart' => 'Προσθήκη στο Καλάθι',
        'notify' => 'Ειδοποιήστε με όταν θα είναι διαθέσιμο!',

        'notification_success' => 'θα σας ειδοποιήσουμε όταν ανανεωθεί το απόθεμά μας. Πατήστε εδω :link για ακύρωση',
        'notification_remove_text' => 'εδώ',

        'notification_in_stock' => 'Αυτό το προϊόν είναι ήδη διαθέσιμο!',
    ],

    'supporter_tag' => [
        'gift' => 'δωρίστε σε έναν παίχτη',
        'require_login' => [
            '_' => 'Πρέπει να είστε :link για να πάρετε ένα supporter tag!',
            'link_text' => 'συνδεδεμένος',
        ],
    ],

    'username_change' => [
        'check' => 'Εισάγετε ένα όνομα χρήστη για να ελέγξετε τη διαθεσιμότητα!',
        'checking' => 'Ελέγχουμε τη διαθεσιμότητα του :username...',
        'require_login' => [
            '_' => 'Πρέπει να είστε :link για να αλλάξετε το όνομα χρήστη σας!',
            'link_text' => 'συνδεδεμένος',
        ],
    ],
];

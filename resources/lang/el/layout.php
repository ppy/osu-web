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
    'defaults' => [
        'page_description' => 'osu! - Ο ρυθμός είναι μόνο ένα *κλικ* μακριά! Με Ouendan/EBA, Taiko και αυθεντικά gameplay modes, καθώς και έναν πλήρως λειτουργικό level editor.',
    ],

    'menu' => [
        'home' => [
            '_' => 'αρχική σελίδα',
            'account-edit' => 'ρυθμίσεις',
            'friends-index' => 'φίλοι',
            'changelog-index' => 'αρχείο καταγραφής αλλαγών',
            'changelog-build' => 'έκδοση',
            'getDownload' => 'λήψη',
            'getIcons' => 'εικονίδια',
            'groups-show' => 'ομάδες',
            'index' => 'επισκόπηση',
            'legal-show' => 'πληροφορίες',
            'news-index' => 'ειδήσεις',
            'news-show' => 'ειδήσεις',
            'password-reset-index' => 'επαναφορά κωδικού πρόσβασης',
            'search' => 'αναζήτηση',
            'supportTheGame' => 'υποστηρίξτε το παιχνίδι',
            'team' => 'ομάδα',
        ],
        'help' => [
            '_' => 'βοήθεια',
            'getFaq' => 'συχνές ερωτήσεις',
            'getRules' => 'κανόνες',
            'getSupport' => 'όχι, πραγματικά, χρειάζομαι βοήθεια!',
            'getWiki' => 'wiki',
            'wiki-show' => 'wiki',
        ],
        'beatmaps' => [
            '_' => 'beatmaps',
            'artists' => 'επιλεγμένοι καλλιτέχνες',
            'beatmap_discussion_posts-index' => 'αναρτήσεις της συζήτησης περί του beatmap',
            'beatmap_discussions-index' => 'συζητήσεις περί του beatmap',
            'beatmapset-watches-index' => 'modding λίστα παρακολούθησης',
            'beatmapset_discussion_votes-index' => 'ψήφοι συζήτησης περί του beatmap',
            'beatmapset_events-index' => 'beatmapset εκδηλώσεις',
            'index' => 'λίστα',
            'packs' => 'πακέτα',
            'show' => 'πληροφορίες',
        ],
        'beatmapsets' => [
            '_' => 'beatmaps',
            'discussion' => 'modding',
        ],
        'rankings' => [
            '_' => 'κατατάξεις',
            'index' => 'επίδοση',
            'performance' => 'επίδοση',
            'charts' => 'spotlights',
            'score' => 'βαθμολογία',
            'country' => 'χώρα',
            'kudosu' => 'kudosu',
        ],
        'community' => [
            '_' => 'κοινότητα',
            'dev' => 'προγραμματισμός',
            'getForum' => 'φόρουμ',
            'getChat' => 'συνομιλία',
            'getLive' => 'ζωντανά',
            'contests' => 'διαγωνισμοί',
            'profile' => 'προφίλ',
            'tournaments' => 'τουρνουά',
            'tournaments-index' => 'τουρνουά',
            'tournaments-show' => 'πληροφορίες τουρνουά',
            'forum-topic-watches-index' => 'συνδρομές',
            'forum-topics-create' => 'φόρουμ',
            'forum-topics-show' => 'φόρουμ',
            'forum-forums-index' => 'φόρουμ',
            'forum-forums-show' => 'φόρουμ',
        ],
        'multiplayer' => [
            '_' => 'multiplayer',
            'show' => 'αγώνας',
        ],
        'error' => [
            '_' => 'σφάλμα',
            '404' => 'λείπει',
            '403' => 'απαγορευμένο',
            '401' => 'μη εξουσιοδοτημένο',
            '405' => 'λείπει',
            '500' => 'κάτι χάλασε',
            '503' => 'συντήρηση',
        ],
        'user' => [
            '_' => 'χρήστης',
            'getLogin' => 'σύνδεση',
            'disabled' => 'απενεργοποιημένο',

            'register' => 'εγγραφή',
            'reset' => 'ανάκτηση',
            'new' => 'νέα',

            'messages' => 'Μηνύματα',
            'settings' => 'Ρυθμίσεις',
            'logout' => 'Αποσύνδεση',
            'help' => 'Βοήθεια',
            'modding-history-discussions' => 'modding συζητήσεις του χρήστη',
            'modding-history-events' => 'γεγονότα για την επεξεργασία χρηστών',
            'modding-history-index' => 'modding ιστορικό του χρήστη',
            'modding-history-posts' => 'modding αναρτήσεις του χρήστη',
            'modding-history-votesGiven' => 'modding ψήφους που έχει δώσει ο χρήστης',
            'modding-history-votesReceived' => 'modding ψήφους που έχει λάβει ο χρήστης',
        ],
        'store' => [
            '_' => 'κατάστημα',
            'checkout-show' => 'ολοκλήρωση αγοράς',
            'getListing' => 'λίστα',
            'cart-show' => 'καλάθι',

            'getCheckout' => 'ολοκλήρωση αγοράς',
            'getInvoice' => 'τιμολόγιο',
            'products-show' => 'προϊόν',

            'new' => 'νέο',
            'home' => 'αρχική σελίδα',
            'index' => 'αρχική σελίδα',
            'thanks' => 'ευχαριστούμε',
        ],
        'admin-forum' => [
            '_' => '',
            'forum-covers-index' => '',
        ],
        'admin-store' => [
            '_' => '',
            'orders-index' => '',
            'orders-show' => '',
        ],
        'admin' => [
            '_' => '',
            'beatmapsets-covers' => '',
            'logs-index' => '',
            'root' => '',

            'beatmapsets' => [
                '_' => '',
                'show' => '',
            ],
        ],
    ],

    'footer' => [
        'general' => [
            '_' => 'Γενικά',
            'home' => 'Αρχική σελίδα',
            'changelog-index' => 'Αρχείο καταγραφής αλλαγών',
            'beatmaps' => 'Λίστα Beatmap',
            'download' => 'Κατεβάστε το osu!',
            'wiki' => 'Wiki',
        ],
        'help' => [
            '_' => 'Βοήθεια & Κοινότητα',
            'faq' => 'Συχνές Ερωτήσεις',
            'forum' => 'Φόρουμ Κοινότητας',
            'livestreams' => 'Ζωντανές Μεταδόσεις',
            'report' => 'Αναφέρετε Κάποιο Πρόβλημα',
        ],
        'legal' => [
            '_' => 'Νομική Υπόσταση',
            'copyright' => 'Δικαιώματα Πνευματικής Ιδιοκτησίας (DMCA)',
            'privacy' => 'Απόρρητο',
            'server_status' => 'Κατάσταση Διακομιστή',
            'source_code' => 'Πηγαίος Κώδικας',
            'terms' => 'Όροι Παροχής Υπηρεσιών',
        ],
    ],

    'errors' => [
        '404' => [
            'error' => 'Η Σελίδα Λείπει',
            'description' => "Λυπούμαστε, αλλά η σελίδα που ζητήσατε δεν είναι εδώ!",
        ],
        '403' => [
            'error' => "Δεν πρέπει να είστε εδώ.",
            'description' => 'Θα μπορούσατε όμως να προσπαθήσετε να επιστρέψετε.',
        ],
        '401' => [
            'error' => "Δεν πρέπει να είστε εδώ.",
            'description' => 'Θα μπορούσατε όμως να προσπαθήσετε να επιστρέψετε. Ή ίσως να συνδεθείτε.',
        ],
        '405' => [
            'error' => 'Η Σελίδα Λείπει',
            'description' => "Λυπούμαστε, αλλά η σελίδα που ζητήσατε δεν είναι εδώ!",
        ],
        '500' => [
            'error' => 'Ωχ όχι! Κάτι χάλασε! ;_;',
            'description' => "Eιδοποιούμαστε αυτόματα για κάθε σφάλμα.",
        ],
        'fatal' => [
            'error' => 'Ωχ όχι! Κάτι χάλασε (άσχημα)! ;_;',
            'description' => "Eιδοποιούμαστε αυτόματα για κάθε σφάλμα.",
        ],
        '503' => [
            'error' => 'Εκτός λειτουργίας λόγω συντήρησης!',
            'description' => "Η συντήρηση συνήθως διαρκεί από 5 δευτερόλεπτα έως 10 λεπτά. Αν είμαστε εκτός λειτουργίας για μεγαλύτερο χρονικό διάστημα, δείτε :link για περισσότερες πληροφορίες.",
            'link' => [
                'text' => '',
                'href' => '',
            ],
        ],
        // used by sentry if it returns an error
        'reference' => "Για παν ενδεχόμενο, εδώ είναι ένας κωδικός που μπορείτε να δώσετε στην υποστήριξη!",
    ],

    'popup_login' => [
        'login' => [
            'email' => 'διεύθυνση email',
            'forgot' => "Έχω ξεχάσει τα στοιχεία μου",
            'password' => 'κωδικός',
            'title' => 'Συνδεθείτε Για Να Συνεχίσετε',

            'error' => [
                'email' => "Το όνομα χρήστη ή η διεύθυνση ηλεκτρονικού ταχυδρομείου δεν υπάρχει",
                'password' => 'Λάθος κωδικός',
            ],
        ],

        'register' => [
            'info' => "Χρειάζεστε λογαριασμό, κύριε. Γιατί δεν έχετε ήδη έναν;",
            'title' => "Δεν έχετε λογαριασμό;",
        ],
    ],

    'popup_user' => [
        'links' => [
            'account-edit' => 'Ρυθμίσεις',
            'friends' => 'Φίλοι',
            'logout' => 'Αποσύνδεση',
            'profile' => 'Το Προφίλ μου',
        ],
    ],

    'popup_search' => [
        'initial' => 'Πληκτρολογήστε για αναζήτηση!',
        'retry' => 'Η αναζήτηση απέτυχε. Κάντε κλικ για να προσπαθήσετε ξανά.',
    ],
];

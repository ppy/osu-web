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
    'landing' => [
        'download' => 'Κάντε λήψη τώρα',
        'online' => '<strong>:players</strong> συνδεδεμένοι αυτή τη στιγμή σε <strong>:games</strong> παιχνίδια',
        'peak' => 'Κορύφωση, :count συνδεδεμένοι χρήστες',
        'players' => '<strong>:count</strong> εγγεγραμμένοι παίκτες',
        'title' => '',

        'slogan' => [
            'main' => 'το καλυτερότερο free-to-win ρυθμικό παιχνίδι',
            'sub' => 'ο ρυθμός είναι ένα κλικ μακριά',
        ],
    ],

    'search' => [
        'advanced_link' => 'Σύνθετη αναζήτηση',
        'button' => 'Αναζήτηση',
        'empty_result' => 'Δεν βρέθηκε τίποτα!',
        'missing_query' => 'Απαιτείται λέξη-κλειδί αναζήτησης τουλάχιστον :n χαρακτήρων',
        'placeholder' => 'πληκτρολογήστε για αναζήτηση',
        'title' => 'Αναζήτηση',

        'beatmapset' => [
            'more' => ':count περισσότερα αποτελέσματα αναζήτησης beatmap',
            'more_simple' => 'Δείτε περισσότερα αποτελέσματα αναζήτησης beatmap',
            'title' => 'Beatmaps',
        ],

        'forum_post' => [
            'all' => 'Όλα τα Φόρουμ',
            'link' => 'Αναζήτηση στο φόρουμ',
            'more_simple' => 'Δείτε περισσότερα αποτελέσματα αναζήτησης φόρουμ',
            'title' => 'Φόρουμ',

            'label' => [
                'forum' => 'αναζήτηση στο φόρουμ',
                'forum_children' => 'συμπεριλάμβανε υπο-φόρουμ',
                'topic_id' => 'θέμα #',
                'username' => 'συντάκτης',
            ],
        ],

        'mode' => [
            'all' => 'όλα',
            'beatmapset' => 'beatmap',
            'forum_post' => 'φόρουμ',
            'user' => 'παίκτης',
            'wiki_page' => 'wiki',
        ],

        'user' => [
            'more' => ':count περισσότερα αποτελέσματα αναζήτησης παίκτη',
            'more_simple' => 'Δείτε περισσότερα αποτελέσματα αναζήτησης παίκτη',
            'more_hidden' => 'Αναζήτηση παικτών περιορίζεται σε :max παίκτες. Δοκιμάστε να βελτιώσετε το ερώτημα αναζήτησης.',
            'title' => 'Παίκτες',
        ],

        'wiki_page' => [
            'link' => 'Αναζήτηση στο wiki',
            'more_simple' => 'Δείτε περισσότερα αποτελέσματα αναζήτησης στο wiki',
            'title' => 'Wiki',
        ],
    ],

    'download' => [
        'tagline' => "ας<br>αρχίσουμε!",
        'action' => 'Λήψη osu!',
        'os' => [
            'windows' => 'για Windows',
            'macos' => 'για macOS',
            'linux' => 'για Linux',
        ],
        'mirror' => 'mirror',
        'macos-fallback' => 'χρήστες macOS',
        'steps' => [
            'register' => [
                'title' => 'αποκτήστε ένα λογαριασμό',
                'description' => 'ακολουθήστε τις οδηγίες που εμφανίζονται κατά την εκκίνηση του παιχνιδιού για να εγγραφείτε ή να δημιουργήσετε ένα νέο λογαριασμό',
            ],
            'download' => [
                'title' => 'κατεβάστε το παιχνίδι',
                'description' => 'κάντε κλικ στο κουμπί πάνω για να κατεβάσετε το πρόγραμμα εγκατάστασης και στη συνέχεια, εκτελέστε το!',
            ],
            'beatmaps' => [
                'title' => 'κατεβάστε beatmaps',
                'description' => [
                    '_' => ':browse στην τεράστια βιβλιοθήκη των beatmaps που δημιουργούνται από τους χρήστες και αρχίστε να παίζετε!',
                    'browse' => 'περιηγηθείτε',
                ],
            ],
        ],
        'video-guide' => 'οδηγός βίντεο',
    ],

    'user' => [
        'title' => 'επισκόπηση',
        'news' => [
            'title' => 'Ειδήσεις',
            'error' => 'Σφάλμα φόρτωσης ειδήσεων, δοκιμάστε να ανανεώσετε τη σελίδα;...',
        ],
        'header' => [
            'welcome' => 'Γεια σας, <strong>:username</strong>!',
            'messages' => 'Έχετε :count νέο μήνυμα|Έχετε :count νέα μηνύματα',
            'stats' => [
                'friends' => 'Συνδεδεμένοι Φίλοι',
                'games' => 'Παιχνίδια',
                'online' => 'Συνδεδεμένοι Χρήστες',
            ],
        ],
        'beatmaps' => [
            'new' => 'Νέα Ranked Beatmaps',
            'popular' => 'Δημοφιλή Beatmaps',
            'by' => 'από',
            'plays' => ':count προσπάθειες',
        ],
        'buttons' => [
            'download' => 'Λήψη osu!',
            'support' => 'Υποστηρίξτε το osu!',
            'store' => 'osu!κατάστημα',
        ],
    ],

    'support-osu' => [
        'title' => 'Ουάου!',
        'subtitle' => 'Φαίνεται να περνάτε καλά! :D',
        'body' => [
            'part-1' => 'Ξέρατε ότι το osu! τρέχει χωρίς διαφημίσεις και βασίζεται στους παίκτες για την υποστήριξη της ανάπτυξης και το κόστος λειτουργίας;',
            'part-2' => 'Ξέρατε επίσης ότι υποστηρίζοντας το osu! παίρνετε ένα σωρό χρήσιμες λειτουργίες, όπως η <strong>λήψη εντός παιχνιδιού</strong> η οποία ενεργοποιείται αυτόματα στο spectator και στα multiplayer λόμπυ;',
        ],
        'find-out-more' => 'Κάντε κλικ εδώ για να μάθετε περισσότερα!',
        'download-starting' => "Ω, και μην ανησυχείτε - η λήψη σας έχει ήδη ξεκινήσει ;)",
    ],
];

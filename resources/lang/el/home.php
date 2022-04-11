<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'landing' => [
        'download' => 'Κάντε λήψη τώρα',
        'online' => '<strong>:players</strong> συνδεδεμένοι αυτή τη στιγμή σε <strong>:games</strong> παιχνίδια',
        'peak' => 'Κορύφωση, :count συνδεδεμένοι χρήστες',
        'players' => '<strong>:count</strong> εγγεγραμμένοι παίκτες',
        'title' => 'καλώς ήρθατε',
        'see_more_news' => '',

        'slogan' => [
            'main' => 'το καλυτερότερο free-to-win ρυθμικό παιχνίδι',
            'sub' => 'ο ρυθμός είναι ένα κλικ μακριά',
        ],
    ],

    'search' => [
        'advanced_link' => 'Σύνθετη αναζήτηση',
        'button' => 'Αναζήτηση',
        'empty_result' => 'Δεν βρέθηκε τίποτα!',
        'keyword_required' => '',
        'placeholder' => 'πληκτρολογήστε για αναζήτηση',
        'title' => 'Αναζήτηση',

        'beatmapset' => [
            'login_required' => '',
            'more' => ':count περισσότερα αποτελέσματα αναζήτησης beatmap',
            'more_simple' => 'Δείτε περισσότερα αποτελέσματα αναζήτησης beatmap',
            'title' => 'Beatmaps',
        ],

        'forum_post' => [
            'all' => 'Όλα τα Φόρουμ',
            'link' => 'Αναζήτηση στο φόρουμ',
            'login_required' => '',
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
            'login_required' => '',
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

        'help' => [
            '_' => '',
            'help_forum_link' => '',
            'support_button' => '',
        ],

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
            'stats' => [
                'friends' => 'Συνδεδεμένοι Φίλοι',
                'games' => 'Παιχνίδια',
                'online' => 'Συνδεδεμένοι Χρήστες',
            ],
        ],
        'beatmaps' => [
            'new' => 'Νέα Ranked Beatmaps',
            'popular' => 'Δημοφιλή Beatmaps',
            'by_user' => '',
        ],
        'buttons' => [
            'download' => 'Λήψη osu!',
            'support' => 'Υποστηρίξτε το osu!',
            'store' => 'osu!κατάστημα',
        ],
    ],
];

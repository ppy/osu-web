<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'header' => [
        'small' => 'Ανταγωνιστείτε με περισσότερους τρόπους από το να πατάτε απλά κύκλους.',
        'large' => 'Διαγωνισμοί Κοινότητας',
    ],

    'index' => [
        'nav_title' => 'καταχώρηση',
    ],

    'judge' => [
        'comments' => '',
        'hide_judged' => '',
        'nav_title' => '',
        'no_current_vote' => '',
        'update' => '',
        'validation' => [
            'missing_score' => '',
            'contest_vote_judged' => '',
        ],
        'voted' => '',
    ],

    'judge_results' => [
        '_' => '',
        'creator' => '',
        'score' => '',
        'total_score' => '',
    ],

    'voting' => [
        'judge_link' => '',
        'judged_notice' => '',
        'login_required' => 'Παρακαλώ συνδεθείτε για να ψηφίσετε.',
        'over' => 'Η ψηφοφορία για αυτόν τον διαγωνισμό έχει λήξει',
        'show_voted_only' => 'Εμφάνιση ψήφων',

        'best_of' => [
            'none_played' => "Φαίνεται ότι δεν έχετε παίξει κάποιο beatmap που πληροί τα κριτήρια για αυτόν τον διαγωνισμό!",
        ],

        'button' => [
            'add' => 'Ψηφίστε',
            'remove' => 'Αφαίρεση ψήφου',
            'used_up' => 'Έχετε χρησιμοποιήσει όλες σας τις ψήφους',
        ],

        'progress' => [
            '_' => ':used / :max χρησιμοποιήθηκαν οι ψήφοι',
        ],

        'requirement' => [
            'playlist_beatmapsets' => [
                'incomplete_play' => 'Πρέπει να παίξει όλους τους beatmaps στις καθορισμένες λίστες αναπαραγωγής πριν από την ψηφοφορία',
            ],
        ],
    ],

    'entry' => [
        '_' => 'καταχώριση',
        'login_required' => 'Παρακαλούμε συνδεθείτε για να συμμετάσχετε στο διαγωνισμό.',
        'silenced_or_restricted' => 'Δεν μπορείτε να μπείτε σε διαγωνισμούς ενώ είστε restricted ή silenced.',
        'preparation' => 'Είμαστε στη διαδικασία προετοιμασίας του διαγωνισμού. Υπομονή παρακαλώ!',
        'drop_here' => 'Αφήστε την καταχώρησή σας εδώ',
        'download' => 'Λήψη .osz',

        'wrong_type' => [
            'art' => 'Μόνο .jpg και .png αρχεία είναι αποδεκτά για αυτόν τον διαγωνισμό.',
            'beatmap' => 'Μόνο .osu αρχεία είναι αποδεκτά για αυτόν τον διαγωνισμό.',
            'music' => 'Μόνο .mp3 αρχεία είναι αποδεκτά για αυτόν τον διαγωνισμό.',
        ],

        'wrong_dimensions' => 'Οι καταχωρήσεις για αυτό το διαγωνισμό πρέπει να είναι :widthx:height',
        'too_big' => 'Οι καταχωρήσεις για αυτόν τον διαγωνισμό μπορούν να είναι το πολύ :limit.',
    ],

    'beatmaps' => [
        'download' => 'Λήψη Καταχώρησης',
    ],

    'vote' => [
        'list' => 'ψήφοι',
        'count' => ':count ψήφος|:count ψήφοι',
        'points' => ':count πόντος|:count πόντοι',
    ],

    'dates' => [
        'ended' => 'Τελείωσε στις :date',
        'ended_no_date' => 'Τελείωσε',

        'starts' => [
            '_' => 'Ξεκινάει στις :date',
            'soon' => 'σύντομα™',
        ],
    ],

    'states' => [
        'entry' => 'Ανοιχτές Συμμετοχές',
        'voting' => 'Η Ψηφοφορία Ξεκίνησε',
        'results' => 'Αποτελέσματα',
    ],
];

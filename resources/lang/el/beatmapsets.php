<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'availability' => [
        'disabled' => 'Αυτό το beatmap δεν είναι διαθέσιμο για λήψη.',
        'parts-removed' => 'Τμήματα αυτού του beatmap έχουν αφαιρεθεί κατ\' απαίτηση του δημιουργού ή κάποιου τρίτου, κατόχου πνευματικών δικαιωμάτων.',
        'more-info' => 'Κάντε κλικ εδώ για να δείτε περισσότερα.',
        'rule_violation' => '',
    ],

    'download' => [
        'limit_exceeded' => '',
    ],

    'featured_artist_badge' => [
        'label' => '',
    ],

    'index' => [
        'title' => 'Λίστα Beatmaps',
        'guest_title' => 'Beatmaps',
    ],

    'panel' => [
        'empty' => '',

        'download' => [
            'all' => '',
            'video' => '',
            'no_video' => '',
            'direct' => '',
        ],
    ],

    'nominate' => [
        'hybrid_requires_modes' => '',
        'incorrect_mode' => '',
        'full_bn_required' => '',
        'too_many' => '',

        'dialog' => [
            'confirmation' => '',
            'header' => '',
            'hybrid_warning' => '',
            'which_modes' => '',
        ],
    ],

    'nsfw_badge' => [
        'label' => '',
    ],

    'show' => [
        'discussion' => 'Συζήτηση',

        'details' => [
            'by_artist' => '',
            'favourite' => 'Προσθέστε αυτό το beatmapset στα αγαπημένα',
            'favourite_login' => '',
            'logged-out' => 'Πρέπει να συνδεθείτε πριν κάνετε λήψη κάποιου beatmap!',
            'mapped_by' => 'δημιουργήθηκε από :mapper',
            'unfavourite' => 'Αφαιρέστε αυτό το beatmapset από τα αγαπημένα',
            'updated_timeago' => 'τελευταία ενημέρωση :timeago',

            'download' => [
                '_' => 'Λήψη',
                'direct' => '',
                'no-video' => 'χωρίς Βίντεο',
                'video' => 'με Βίντεο',
            ],

            'login_required' => [
                'bottom' => 'για να αποκτήσετε πρόσβαση σε περισσότερες λειτουργίες',
                'top' => 'Συνδεθείτε',
            ],
        ],

        'details_date' => [
            'approved' => '',
            'loved' => '',
            'qualified' => '',
            'ranked' => '',
            'submitted' => '',
            'updated' => '',
        ],

        'favourites' => [
            'limit_reached' => 'Έχετε πάρα πολλά αγαπημένα beatmaps! Παρακαλώ αφαιρέστε κάποια πριν ξαναδοκιμάσετε.',
        ],

        'hype' => [
            'action' => 'Προωθήστε το map εαν σας άρεσε και βοηθήστε το να προοδεύσει στην <strong>Ranked</strong> κατάταξη.',

            'current' => [
                '_' => 'Αυτό το map είναι προς το παρόν :status .',

                'status' => [
                    'pending' => 'εκκρεμεί',
                    'qualified' => 'πιστοποιημένο',
                    'wip' => 'εργασία σε εξέλιξη',
                ],
            ],

            'disqualify' => [
                '_' => '',
            ],

            'report' => [
                '_' => '',
                'button' => '',
                'link' => '',
            ],
        ],

        'info' => [
            'description' => 'Περιγραφή',
            'genre' => 'Είδος',
            'language' => 'Γλώσσα',
            'no_scores' => 'Τα δεδομένα ακόμα υπολογίζονται...',
            'nsfw' => '',
            'points-of-failure' => 'Σημεία Αποτυχίας',
            'source' => 'Προέλευση',
            'storyboard' => '',
            'success-rate' => 'Ποσοστό Επιτυχίας',
            'tags' => 'Ετικέτες',
            'video' => '',
        ],

        'nsfw_warning' => [
            'details' => '',
            'title' => '',

            'buttons' => [
                'disable' => '',
                'listing' => '',
                'show' => '',
            ],
        ],

        'scoreboard' => [
            'achieved' => 'επετεύχθη :when',
            'country' => 'Κατάταξη στη Χώρα',
            'friend' => 'Κατάταξη στους Φίλους',
            'global' => 'Παγκόσμια Κατάταξη',
            'supporter-link' => 'Κάντε κλικ <a href=":link">εδώ</a> για να δείτε όλες τις φοβερές δυνατότητες που μπορείτε να αποκτήσετε!',
            'supporter-only' => 'Χρειάζεται να είστε supporter για να έχετε πρόσβαση στις κατατάξεις χώρας και φίλων!',
            'title' => 'Πίνακας αποτελεσμάτων',

            'headers' => [
                'accuracy' => 'Ακρίβεια',
                'combo' => 'Μέγιστο Combo',
                'miss' => 'Αστοχίες',
                'mods' => 'Mods',
                'pin' => '',
                'player' => 'Παίκτης',
                'pp' => '',
                'rank' => 'Κατάταξη',
                'score' => 'Σκορ',
                'score_total' => 'Συνολικό Σκορ',
                'time' => '',
            ],

            'no_scores' => [
                'country' => 'Κανένας από τη χώρα σας δεν έχει κάποιο σκορ σε αυτό το map ακόμα!',
                'friend' => 'Κανένας από τους φίλους σας δεν έχει σκορ σε αυτό το map ακόμα!',
                'global' => 'Κανένα σκορ ακόμα. Μήπως να δοκιμάσετε εσείς να το πετύχετε;',
                'loading' => 'Φόρτωση σκορ...',
                'unranked' => 'Unranked beatmap.',
            ],
            'score' => [
                'first' => 'Προηγείται',
                'own' => 'Το καλύτερό σας',
            ],
        ],

        'stats' => [
            'cs' => 'Μέγεθος Κύκλου',
            'cs-mania' => 'Αριθμός Πλήκτρων',
            'drain' => 'HP Drain',
            'accuracy' => 'Ακρίβεια',
            'ar' => 'Approach Rate',
            'stars' => 'Δυσκολία σε Αστέρια',
            'total_length' => 'Διάρκεια',
            'bpm' => 'BPM',
            'count_circles' => 'Αριθμός Κύκλων',
            'count_sliders' => 'Αριθμός Sliders',
            'user-rating' => 'Βαθμολόγηση Χρηστών',
            'rating-spread' => 'Εύρος Βαθμολογίας',
            'nominations' => 'Υποψηφιότητες',
            'playcount' => 'Φορές που παίχτηκε',
        ],

        'status' => [
            'ranked' => '',
            'approved' => '',
            'loved' => '',
            'qualified' => '',
            'wip' => '',
            'pending' => '',
            'graveyard' => '',
        ],
    ],
];

<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'availability' => [
        'disabled' => 'Αυτό το beatmap δεν είναι διαθέσιμο για λήψη.',
        'parts-removed' => 'Τμήματα αυτού του beatmap έχουν αφαιρεθεί κατ\' απαίτηση του δημιουργού ή κάποιου τρίτου, κατόχου πνευματικών δικαιωμάτων.',
        'more-info' => 'Κάντε κλικ εδώ για να δείτε περισσότερα.',
        'rule_violation' => 'Ορισμένα περιουσιακά στοιχεία που περιέχονται σε αυτόν τον χάρτη έχουν αφαιρεθεί αφού έχουν κριθεί ότι δεν είναι κατάλληλα για χρήση στο osu!.',
    ],

    'cover' => [
        'deleted' => 'Διαγραμμένα beatmap',
    ],

    'download' => [
        'limit_exceeded' => 'Πιο αργά, παίξε περισσότερο.',
        'no_mirrors' => 'Κανένας διαθέσιμος server λήψης.',
    ],

    'featured_artist_badge' => [
        'label' => 'Προτεινόμενος Καλλιτέχνης',
    ],

    'index' => [
        'title' => 'Λίστα Beatmaps',
        'guest_title' => 'Beatmaps',
    ],

    'panel' => [
        'empty' => 'κανένα beatmap',

        'download' => [
            'all' => 'λήψη',
            'video' => 'λήψη με βίντεο',
            'no_video' => 'λήψη χωρίς βίντεο',
            'direct' => 'άνοιγμα με osu!direct',
        ],
    ],

    'nominate' => [
        'bng_limited_too_many_rulesets' => 'Οι υποψήφιοι δεν μπορούν να προτείνουν πολλαπλούς κανόνες.',
        'full_nomination_required' => 'Πρέπει να είσαι ένας πλήρης υποψήφιος για να εκτελέσεις την τελική υποψηφιότητα ενός συνόλου κανόνων.',
        'hybrid_requires_modes' => 'Ένα υβριδικό beatmap απαιτεί από εσένα να επιλέξεις τουλάχιστον μία λειτουργία αναπαραγωγής για την οποία θα ορίσεις.',
        'incorrect_mode' => 'Δεν έχεις άδεια να ορίσεις για τη λειτουργία: :mode',
        'invalid_limited_nomination' => 'Αυτό το beatmap έχει άκυρες υποψηφιότητες και δεν μπορεί να χαρακτηριστεί σε αυτή την κατάσταση.',
        'invalid_ruleset' => 'Αυτή η υποψηφιότητα έχει μη έγκυρους κανόνες.',
        'too_many' => 'Η απαίτηση διορισμού πληρούται ήδη.',
        'too_many_non_main_ruleset' => 'Ήδη πληρούται η απαίτηση διορισμού για μη κύριους κανόνες.',

        'dialog' => [
            'confirmation' => 'Θέλεις σίγουρα να ενημερώσεις αυτό το beatmap;',
            'different_nominator_warning' => 'Ο καθορισμός αυτού του beatmap με διαφορετικούς αριθμητές θα επαναφέρει τη θέση της σειράς προσόντων του.',
            'header' => 'Υποψηφιότητα Beatmap',
            'hybrid_warning' => 'σημείωση: μπορείς να υποδείξεις μόνο μία φορά, οπότε βεβαιώσου ότι ορίζεις για όλες τις λειτουργίες παιχνιδιού που σκοπεύεις να',
            'current_main_ruleset' => 'Το κύριο σύνολο κανόνων είναι τρέχον: :ruleset',
            'which_modes' => 'Υποψηφιότητα για ποιες λειτουργίες?',
        ],
    ],

    'nsfw_badge' => [
        'label' => 'Άσεμνο περιεχόμενο',
    ],

    'show' => [
        'discussion' => 'Συζήτηση',

        'admin' => [
            'full_size_cover' => 'Προβολή εικόνας πλήρους μεγέθους εξωφύλλου',
            'page' => 'Προβολή σελίδας διαχειριστή',
        ],

        'deleted_banner' => [
            'title' => 'Το beatmap έχει διαγραφτεί.',
            'message' => '(μόνο οι συντονιστές μπορούν να το δουν αυτό)',
        ],

        'details' => [
            'by_artist' => 'από :artist',
            'favourite' => 'Προσθέστε αυτό το beatmapset στα αγαπημένα',
            'favourite_login' => 'συνδέσου για να κάνεις αγαπημένο αυτό το beatmap',
            'logged-out' => 'Πρέπει να συνδεθείτε πριν κάνετε λήψη κάποιου beatmap!',
            'mapped_by' => 'δημιουργήθηκε από :mapper',
            'mapped_by_guest' => 'δυσκολία επισκέπτη από :mapper',
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
            'approved' => 'εγκεκριμένο :timeago',
            'loved' => 'αγαπημένο :timeago',
            'qualified' => 'πιστοποιημένο :timeago',
            'ranked' => 'καταταγμένο :timeago',
            'submitted' => 'υποβλήθηκε :timeago',
            'updated' => 'τελευταία ενημέρωση :timeago',
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
                '_' => 'Αν βρεις κάποιο πρόβλημα με αυτό το beatmap, παρακαλούμε να το αποκλείσεις :link.',
            ],

            'report' => [
                '_' => 'Αν βρεις κάποιο πρόβλημα με αυτό το beatmap, παρακαλώ ανέφερε το στο :link για να ειδοποιήσετε την ομάδα.',
                'button' => 'Αναφορά Προβλήματος',
                'link' => 'εδώ',
            ],
        ],

        'info' => [
            'description' => 'Περιγραφή',
            'genre' => 'Είδος',
            'language' => 'Γλώσσα',
            'mapper_tags' => 'Ετικέτες Mapper',
            'no_scores' => 'Τα δεδομένα ακόμα υπολογίζονται...',
            'nominators' => 'Υποψηφιότητες',
            'nsfw' => 'Ακατάλληλο περιεχόμενο',
            'offset' => 'Συνδεδεμένη μετατόπιση',
            'pack_tags' => '',
            'points-of-failure' => 'Σημεία Αποτυχίας',
            'source' => 'Προέλευση',
            'storyboard' => 'Αυτό το beatmap περιέχει storyboard',
            'success-rate' => 'Ποσοστό Επιτυχίας',
            'success_rate_plays' => '',
            'user_tags' => 'Ετικέτες Χρήστη',
            'video' => 'Αυτό το beatmap περιέχει βίντεο',
        ],

        'nsfw_warning' => [
            'details' => 'Αυτό το beatmap περιέχει ρητό, προσβλητικό, ή ενοχλητικό περιεχόμενο. Θα θέλεις να το δεις ούτως ή άλλως?',
            'title' => 'Ακατάλληλο περιεχόμενο',

            'buttons' => [
                'disable' => 'Απενεργοποίηση προειδοποίησης',
                'listing' => 'Λίστα Beatmap',
                'show' => 'Εμφάνιση',
            ],
        ],

        'scoreboard' => [
            'achieved' => 'επετεύχθη :when',
            'country' => 'Κατάταξη στη Χώρα',
            'error' => 'Αποτυχία φόρτωσης κατάταξης',
            'friend' => 'Κατάταξη στους Φίλους',
            'global' => 'Παγκόσμια Κατάταξη',
            'supporter-link' => 'Κάντε κλικ <a href=":link">εδώ</a> για να δείτε όλες τις φοβερές δυνατότητες που μπορείτε να αποκτήσετε!',
            'supporter-only' => 'Χρειάζεται να είστε supporter για να έχετε πρόσβαση στις κατατάξεις χώρας και φίλων!',
            'team' => 'Κατάταξη Ομάδας',
            'title' => 'Πίνακας αποτελεσμάτων',

            'headers' => [
                'accuracy' => 'Ακρίβεια',
                'combo' => 'Μέγιστο Combo',
                'miss' => 'Αστοχίες',
                'mods' => 'Mods',
                'pin' => 'Καρφίτσωμα',
                'player' => 'Παίκτης',
                'pp' => '',
                'rank' => 'Κατάταξη',
                'score' => 'Σκορ',
                'score_total' => 'Συνολικό Σκορ',
                'time' => 'Χρόνος',
            ],

            'no_scores' => [
                'country' => 'Κανένας από τη χώρα σας δεν έχει κάποιο σκορ σε αυτό το map ακόμα!',
                'friend' => 'Κανένας από τους φίλους σας δεν έχει σκορ σε αυτό το map ακόμα!',
                'global' => 'Κανένα σκορ ακόμα. Μήπως να δοκιμάσετε εσείς να το πετύχετε;',
                'loading' => 'Φόρτωση σκορ...',
                'team' => 'Κανένας από την ομάδα σου δεν έχει ορίσει βαθμολογία σε αυτό το map ακόμα!',
                'unranked' => 'Unranked beatmap.',
            ],
            'score' => [
                'first' => 'Προηγείται',
                'own' => 'Το καλύτερό σας',
            ],
            'supporter_link' => [
                '_' => 'Κάνε κλικ :here για να δεις όλες τις φοβερές δυνατότητες που αποκτάς!',
                'here' => 'εδώ',
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
            'offset' => 'Διαδικτυακή μετατόπιση: :offset',
            'user-rating' => 'Βαθμολόγηση Χρηστών',
            'rating-spread' => 'Εύρος Βαθμολογίας',
            'nominations' => 'Υποψηφιότητες',
            'playcount' => 'Φορές που παίχτηκε',
            'favourites' => '',
            'no_favourites' => '',
        ],

        'status' => [
            'ranked' => 'Καταταγμένο',
            'approved' => 'Εγκεκριμένο',
            'loved' => 'Αγαπημένο',
            'qualified' => 'Πιστοποιημένο',
            'wip' => 'WIP',
            'pending' => 'Σε εκκρεμότητα',
            'graveyard' => 'Νεκροταφείο',
        ],
    ],

    'spotlight_badge' => [
        'label' => 'Προσκήνιο',
    ],
];

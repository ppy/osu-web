<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'invalid' => '',
    'not_negative' => 'το :attribute δε μπορεί να δοθεί.',
    'required' => 'το :attribute απαιτείται.',
    'too_long' => 'το :attribute υπερβαίνει το μέγιστο όριο χαρακτήρων - μπορεί να είναι μέχρι :limit χαρακτήρες.',
    'wrong_confirmation' => 'Η βεβαίωση δεν ταιριάζει.',

    'beatmapset_discussion' => [
        'beatmap_missing' => 'Η χρονική σήμανση έχει καθοριστεί αλλά το beatmap λείπει.',
        'beatmapset_no_hype' => "Το beatmap δε μπορεί να γίνει hyped.",
        'hype_requires_null_beatmap' => 'Το hype πρέπει να γίνει στην Γενική (όλες οι δυσκολίες) ενότητα.',
        'invalid_beatmap_id' => 'Προσδιορίστηκε μη έγκυρη δυσκολία.',
        'invalid_beatmapset_id' => 'Προσδιορίστηκε μη έγκυρο beatmap.',
        'locked' => 'Η συζήτηση είναι κλειδωμένη.',

        'attributes' => [
            'message_type' => '',
            'timestamp' => '',
        ],

        'hype' => [
            'discussion_locked' => "",
            'guest' => 'Πρέπει να είστε συνδεδεμένοι για να κάνετε hype.',
            'hyped' => 'Έχετε κάνει ήδη hype αυτό το beatmap.',
            'limit_exceeded' => 'Έχετε χρησιμοποιήσει όλο το hype σας.',
            'not_hypeable' => 'Δε μπορεί να γίνει hype σε αυτό το betamap',
            'owner' => 'Δε μπορείτε να κάνετε hype το beatmap σας.',
        ],

        'timestamp' => [
            'exceeds_beatmapset_length' => 'Το καθορισμένο timestamp είναι πέρα από τη διάρκεια του beatmap.',
            'negative' => "Η χρονική σήμανση δε μπορεί να είναι αρνητική.",
        ],
    ],

    'beatmapset_discussion_post' => [
        'discussion_locked' => 'Η συζήτηση έχει κλειδωθεί.',
        'first_post' => 'Το αρχικό post δε μπορεί να διαγραφεί.',

        'attributes' => [
            'message' => '',
        ],
    ],

    'comment' => [
        'deleted_parent' => 'Δεν επιτρέπεται η απάντηση σε διαγραμμένο σχόλιο.',
        'top_only' => '',

        'attributes' => [
            'message' => '',
        ],
    ],

    'follow' => [
        'invalid' => '',
    ],

    'forum' => [
        'feature_vote' => [
            'not_feature_topic' => 'Μπορείτε να ψηφίσετε μόνο ένα αίτημα χαρακτηριστικών.',
            'not_enough_feature_votes' => 'Δε συγκεντρώθηκαν αρκετοί ψήφοι.',
        ],

        'poll_vote' => [
            'invalid' => 'Προσδιορίστηκε μη έγκυρη επιλογή.',
        ],

        'post' => [
            'beatmapset_post_no_delete' => 'Η διαγραφή του post για τα μεταδεδομένα το beatmap δεν είναι επιτρεπτή.',
            'beatmapset_post_no_edit' => 'Η επεξεργασία του post για τα μεταδεδομένα το beatmap δεν είναι επιτρεπτή.',
            'first_post_no_delete' => '',
            'missing_topic' => '',
            'only_quote' => 'Η απάντησή σας περιέχει μόνο μία αναφορά.',

            'attributes' => [
                'post_text' => '',
            ],
        ],

        'topic' => [
            'attributes' => [
                'topic_title' => 'Τίτλος Θέματος',
            ],
        ],

        'topic_poll' => [
            'duplicate_options' => 'Η επιλογή για διπλασιασμό δεν είναι επιτρεπτή.',
            'grace_period_expired' => 'Δεν είναι δυνατή επεξεργασία δημοσκόπησης μετά από :limit + ώρες',
            'hiding_results_forever' => 'Δεν μπορείτε να αποκρύψετε τα αποτελέσματα μιας ψηφοφορίας που δεν τελειώνει ποτέ.',
            'invalid_max_options' => 'Η επιλογή ανά χρήστη ίσως υπερβαίνει τον αριθμό των διαθέσιμων επιλογών.',
            'minimum_one_selection' => 'Το ελάχιστο που απαιτείται είναι μία επιλογή ανά χρήστη.',
            'minimum_two_options' => 'Χρειάζονται τουλάχιστον δύο επιλογές.',
            'too_many_options' => 'Υπερβήκατε το μέγιστο αριθμό επιλογών που επιτρέπεται.',

            'attributes' => [
                'title' => '',
            ],
        ],

        'topic_vote' => [
            'required' => 'Επιλέξτε μία επιλογή όταν ψηφίζετε.',
            'too_many' => 'Επιλέχθηκαν περισσότερες επιλογές από το επιτρεπόμενο όριο.',
        ],
    ],

    'oauth' => [
        'client' => [
            'too_many' => '',
            'url' => '',

            'attributes' => [
                'name' => '',
                'redirect' => '',
            ],
        ],
    ],

    'user' => [
        'contains_username' => 'Ο κωδικός δεν πρέπει να περιέχει το όνομα χρήστη.',
        'email_already_used' => 'Το email είναι ήδη σε χρήση.',
        'email_not_allowed' => '',
        'invalid_country' => 'Η χώρα δεν υπάρχει στη βάση δεδομένων.',
        'invalid_discord' => 'Το όνομα χρήστη στο Discord δεν είναι έγκυρο.',
        'invalid_email' => "Δε φαίνεται να είναι ένα έγκυρο email.",
        'invalid_twitter' => '',
        'too_short' => 'Ο καινούργιος κωδικός είναι πολύ μικρός.',
        'unknown_duplicate' => 'Το όνομα χρήστη ή το email είναι ήδη σε χρήση.',
        'username_available_in' => 'Αυτό το όνομα χρήστη θα είναι διαθέσιμο σε :duration μέρες.',
        'username_available_soon' => 'Αυτό το όνομα χρήστη θα είναι διαθέσιμο σύντομα!',
        'username_invalid_characters' => 'Το ζητούμενο όνομα χρήστη περιέχει μη έγκυρους χαρακτήρες.',
        'username_in_use' => 'Το όνομα χρήστη χρησιμοποιείται ήδη!',
        'username_locked' => 'Το όνομα χρήστη χρησιμοποιείται ήδη!', // TODO: language for this should be slightly different.
        'username_no_space_userscore_mix' => 'Παρακαλώ χρησιμοποιείστε κάτω παύλες ή κενά, όχι και τα δύο!',
        'username_no_spaces' => "Το όνομα χρήστη δε μπορεί να ξεκινάει ή να τελειώνει με κενά!",
        'username_not_allowed' => 'Η επιλογή αυτού του ονόματος χρήστη δεν επιτρέπεται.',
        'username_too_short' => 'Το ζητούμενο όνομα είναι πολύ μικρό.',
        'username_too_long' => 'Το ζητούμενο όνομα χρήστη είναι πολύ μεγάλο.',
        'weak' => 'Απαγορευμένος κωδικός.',
        'wrong_current_password' => 'Ο παρών κωδικός είναι λανθασμένος.',
        'wrong_email_confirmation' => 'Η πιστοποίηση του email δεν ταιριάζει.',
        'wrong_password_confirmation' => 'Η πιστοποίηση του κωδικού δεν ταιριάζει.',
        'too_long' => 'Έχετε υπερβεί το μέγιστο όριο - μπορεί να είναι μέχρι :limit χαρακτήρες.',

        'attributes' => [
            'username' => '',
            'user_email' => '',
            'password' => '',
        ],

        'change_username' => [
            'restricted' => 'Δεν μπορείτε να αλλάξετε όνομα χρήστη ενώ είστε restricted.',
            'supporter_required' => [
                '_' => 'Πρέπει να έχεις :link για να αλλάξεις το όνομα χρήστη σου!',
                'link_text' => 'υποστήριξε το osu!',
            ],
            'username_is_same' => 'Αυτό είναι ήδη το όνομα χρήστη σου, χαζούλη!',
        ],
    ],

    'user_report' => [
        'no_ranked_beatmapset' => '',
        'reason_not_valid' => '',
        'self' => "Δεν μπορείτε να αποκλέισετε τον εαυτό σας!",
    ],

    'store' => [
        'order_item' => [
            'attributes' => [
                'quantity' => '',
                'cost' => '',
            ],
        ],
    ],
];

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
    'not_negative' => 'το :attribute δε μπορεί να δοθεί.',
    'required' => 'το :attribute απαιτείται.',
    'too_long' => 'το :attribute υπερβαίνει το μέγιστο όριο χαρακτήρων - μπορεί να είναι μέχρι :limit χαρακτήρες.',
    'wrong_confirmation' => 'Η βεβαίωση δεν ταιριάζει.',

    'beatmap_discussion_post' => [
        'discussion_locked' => 'Η συζήτηση έχει κλειδωθεί.',
        'first_post' => 'Το αρχικό post δε μπορεί να διαγραφεί.',
    ],

    'beatmapset_discussion' => [
        'beatmap_missing' => 'Η χρονική σήμανση έχει καθοριστεί αλλά το beatmap λείπει.',
        'beatmapset_no_hype' => "Το beatmap δε μπορεί να γίνει hyped.",
        'hype_requires_null_beatmap' => 'Το hype πρέπει να γίνει στην Γενική (όλες οι δυσκολίες) ενότητα.',
        'invalid_beatmap_id' => 'Προσδιορίστηκε μη έγκυρη δυσκολία.',
        'invalid_beatmapset_id' => 'Προσδιορίστηκε μη έγκυρο beatmap.',
        'locked' => 'Η συζήτηση είναι κλειδωμένη.',

        'hype' => [
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
        ],

        'topic_poll' => [
            'duplicate_options' => 'Η επιλογή για διπλασιασμό δεν είναι επιτρεπτή.',
            'invalid_max_options' => 'Η επιλογή ανά χρήστη ίσως υπερβαίνει τον αριθμό των διαθέσιμων επιλογών.',
            'minimum_one_selection' => 'Το ελάχιστο που απαιτείται είναι μία επιλογή ανά χρήστη.',
            'minimum_two_options' => 'Χρειάζονται τουλάχιστον δύο επιλογές.',
            'too_many_options' => 'Υπερβήκατε το μέγιστο αριθμό επιλογών που επιτρέπεται.',
        ],

        'topic_vote' => [
            'required' => 'Επιλέξτε μία επιλογή όταν ψηφίζετε.',
            'too_many' => 'Επιλέχθηκαν περισσότερες επιλογές από το επιτρεπόμενο όριο.',
        ],
    ],

    'user' => [
        'contains_username' => 'Ο κωδικός δεν πρέπει να περιέχει το όνομα χρήστη.',
        'email_already_used' => 'Το email είναι ήδη σε χρήση.',
        'invalid_country' => 'Η χώρα δεν υπάρχει στη βάση δεδομένων.',
        'invalid_discord' => 'Το όνομα χρήστη στο Discord δεν είναι έγκυρο.',
        'invalid_email' => "Δε φαίνεται να είναι ένα έγκυρο email.",
        'too_short' => 'Ο καινούργιος κωδικός είναι πολύ μικρός.',
        'unknown_duplicate' => 'Το όνομα χρήστη ή το email είναι ήδη σε χρήση.',
        'username_available_in' => 'Αυτό το όνομα χρήστη θα είναι διαθέσιμο σε :duration μέρες.',
        'username_available_soon' => 'Αυτό το όνομα χρήστη θα είναι διαθέσιμο σύντομα!',
        'username_invalid_characters' => 'Το ζητούμενο όνομα χρήστη περιέχει μη έγκυρους χαρακτήρες.',
        'username_in_use' => 'Το όνομα χρήστη χρησιμοποιείται ήδη!',
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

        'change_username' => [
            'supporter_required' => [
                '_' => 'Πρέπει να έχεις :link για να αλλάξεις το όνομα χρήστη σου!',
                'link_text' => 'υποστήριξε το osu!',
            ],
            'username_is_same' => 'Αυτό είναι ήδη το όνομα χρήστη σου, χαζούλη!',
        ],
    ],
];

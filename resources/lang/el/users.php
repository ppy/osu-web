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
    'deleted' => '[διαγραμμένος χρήστης]',

    'beatmapset_activities' => [
        'title' => "Ιστορικό Modding του χρήστη :user",

        'discussions' => [
            'title_recent' => 'Πρόσφατα δημιουργημένες συζητήσεις',
        ],

        'events' => [
            'title_recent' => 'Πρόσφατα γεγονότα',
        ],

        'posts' => [
            'title_recent' => 'Πρόσφατες δημοσιεύσεις',
        ],

        'votes_received' => [
            'title_most' => 'Το πιο upvoted από (τελευταίους 3 μήνες)',
        ],

        'votes_made' => [
            'title_most' => 'Το πιο upvoted (τελευταίοι 3 μήνες)',
        ],
    ],

    'blocks' => [
        'banner_text' => 'Έχετε μπλοκάρει αυτόν τον χρήστη.',
        'blocked_count' => 'μπλοκαρισμένοι χρήστες (:count)',
        'hide_profile' => 'απόκρυψη προφίλ',
        'not_blocked' => 'Αυτός ο χρήστης δεν είναι μπλοκαρισμένος.',
        'show_profile' => 'εμφάνιση προφίλ',
        'too_many' => 'Φτάσατε το όριο μπλοκαρισμάτων.',
        'button' => [
            'block' => 'μπλοκάρισμα',
            'unblock' => 'ξεμπλοκάρισμα',
        ],
    ],

    'card' => [
        'loading' => 'Φόρτωση...',
        'send_message' => 'αποστολή μηνύματος',
    ],

    'login' => [
        '_' => 'Σύνδεση',
        'locked_ip' => 'η διεύθυνση IP σας είναι κλειδωμένη. Παρακαλώ περιμένετε λίγα λεπτά.',
        'username' => 'Όνομα χρήστη',
        'password' => 'Κωδικός',
        'button' => 'Είσοδος',
        'button_posting' => 'Είσοδος...',
        'remember' => 'Απομνημόνευση της σύνδεσης',
        'title' => 'Παρακαλώ συνδεθείτε για να συνεχίσετε',
        'failed' => 'Λάθος σύνδεση',
        'register' => "Δεν έχετε λογαριασμό στο osu!; Φτιάξτε ένα νέο",
        'forgot' => 'Ξεχάσατε τον κωδικό σας;',
        'beta' => [
            'main' => 'Η πρόσβαση στην έκδοση Beta είναι περιορισμένη σε προνομιούχους χρήστες.',
            'small' => '(οι osu!supporters θα έχουν πρόσβαση σύντομα)',
        ],

        'here' => 'εδώ', // this is substituted in when generating a link above. change it to suit the language.
    ],

    'posts' => [
        'title' => 'Δημοσιεύσεις του :username',
    ],

    'signup' => [
        '_' => 'Εγγραφή',
    ],
    'anonymous' => [
        'login_link' => 'κάντε κλικ για να συνδεθείτε',
        'login_text' => 'σύνδεση',
        'username' => 'Επισκέπτης',
        'error' => 'Πρέπει να είστε συνδεδεμένος για να το κάνετε αυτό.',
    ],
    'logout_confirm' => 'Είστε σίγουροι ότι θέλετε να αποσυνδεθείτε; :(',
    'report' => [
        'button_text' => 'αναφορά',
        'comments' => 'Πρόσθετα Σχόλια',
        'placeholder' => 'Παρακαλώ δώστε οποιαδήποτε πληροφορία πιστεύετε ότι μπορεί να είναι χρήσιμη.',
        'reason' => 'Λόγος',
        'thanks' => 'Ευχαριστούμε για την αναφορά σας!',
        'title' => 'Αναφορά του :username;',

        'actions' => [
            'send' => 'Αποστολή Αναφοράς',
            'cancel' => 'Άκυρο',
        ],

        'options' => [
            'cheating' => 'Παράτυπος τρόπος παιχνιδιού / Κλέψιμο',
            'insults' => 'Προσβάλει εμένα / άλλους',
            'spam' => 'Spamming',
            'unwanted_content' => 'Δημοσίευση links με ακατάλληλο περιεχόμενο',
            'nonsense' => 'Ανοησίες',
            'other' => 'Άλλο (γράψτε παρακάτω)',
        ],
    ],
    'restricted_banner' => [
        'title' => 'Ο λογαριασμός σας έχει περιοριστεί!',
        'message' => 'Όσο βρίσκεστε υπό περιορισμό, δεν θα είστε σε θέση να αλληλεπιδράσετε με άλλους χρήστες και τα score σας θα είναι ορατά μόνο σε εσάς. Αυτό είναι αποτέλεσμα μιας αυτόματης διαδικασίας που συνήθως διαρκεί 24 ώρες. Εάν επιθυμείτε την αναίρεση του περιορισμού, παρακαλώ <a href="mailto:accounts@ppy.sh">επικοινωνήστε με την ομάδα υποστήριξης</a>.',
    ],
    'show' => [
        'age' => ':age ετών',
        'change_avatar' => 'αλλάξτε το avatar σας!',
        'first_members' => 'Εδώ από την αρχή',
        'is_developer' => 'osu!developer',
        'is_supporter' => 'osu!supporter',
        'joined_at' => 'Μέλος από :date',
        'lastvisit' => 'Τελευταία φορά εμφανίστηκε στις :date',
        'missingtext' => 'Ίσως να κάνατε κάποιο ορθογραφικό λάθος! (ή ο χρήστης είναι banned)',
        'origin_country' => 'Από :country',
        'page_description' => 'osu! - Όλα όσα θέλεις να ξέρεις για τον :username!',
        'previous_usernames' => 'προηγουμένως γνωστός ως',
        'plays_with' => 'Παίζει με :devices',
        'title' => "Το προφίλ του :username",

        'edit' => [
            'cover' => [
                'button' => 'Αλλάξτε το Εξώφυλλο του Προφίλ σας',
                'defaults_info' => 'Περισσότερα εξώφυλλα θα είναι διαθέσιμα στο μέλλον',
                'upload' => [
                    'broken_file' => 'Αποτυχία επεξεργασίας εικόνας. Ελέγξτε την εικόνα και προσπαθήστε ξανά.',
                    'button' => 'Ανεβάστε εικόνα',
                    'dropzone' => 'Αφήστε εδώ για να ανεβεί',
                    'dropzone_info' => 'Μπορείτε επίσης να σύρετε την εικόνα σας εδώ για να ανεβεί',
                    'restriction_info' => "Διαθέσιμη μεταφόρτωση για <a href='".route('store.products.show', 'supporter-tag')."' target='_blank'>osu!supporters</a> μόνο",
                    'size_info' => 'Το μέγεθος του εξωφύλλου πρέπει να είναι 2000x700',
                    'too_large' => 'Το αρχείο είναι πολύ μεγάλο.',
                    'unsupported_format' => 'Μη υποστηριζόμενη μορφή.',
                ],
            ],

            'default_playmode' => [
                'is_default_tooltip' => 'προεπιλεγμένο game mode',
                'set' => 'όρισε το :mode ως το προεπιλεγμένο game mode',
            ],
        ],

        'extra' => [
            'followers' => '1 ακόλουθος|:count ακόλουθοι',
            'unranked' => 'Κανένα πρόσφατο σκορ',

            'achievements' => [
                'title' => 'Επιτεύγματα',
                'achieved-on' => 'Επιτεύχθηκε στις :date',
            ],
            'beatmaps' => [
                'none' => 'Κανένα... ακόμα.',
                'title' => 'Beatmaps',

                'favourite' => [
                    'title' => 'Αγαπημένα Beatmaps (:count)',
                ],
                'graveyard' => [
                    'title' => 'Παρατημένα Beatmaps (:count)',
                ],
                'loved' => [
                    'title' => 'Loved Beatmaps (:count)',
                ],
                'ranked_and_approved' => [
                    'title' => 'Ranked & Approved Beatmaps (:count)',
                ],
                'unranked' => [
                    'title' => 'Εκκρεμή Beatmaps (:count)',
                ],
            ],
            'historical' => [
                'empty' => 'Κανένα ρεκόρ επίδοσης. :(',
                'title' => 'Ιστορικό',

                'monthly_playcounts' => [
                    'title' => 'Ιστορικό Δραστηριότητας',
                ],
                'most_played' => [
                    'count' => 'φορές που παίχτηκε',
                    'title' => 'Πιο πολυπαιγμένα beatmaps',
                ],
                'recent_plays' => [
                    'accuracy' => 'ακρίβεια: :percentage',
                    'title' => 'Πρόσφατα Σκορ (24ω)',
                ],
                'replays_watched_counts' => [
                    'title' => 'Ιστορικό Παρακολούθησης Replay',
                ],
            ],
            'kudosu' => [
                'available' => 'Διαθέσιμα Kudosu',
                'available_info' => "Τα Kudosu μπορούν να ανταλλάσσονται με αστέρια kudosu, τα οποία θα βοηθήσουν το beatmap σας να πάρει περισσότερη προσοχή. Αυτός είναι ο αριθμός των kudosu που δεν έχετε ανταλλάξει ακόμα.",
                'recent_entries' => 'Πρόσφατο Ιστορικό Kudosu',
                'title' => 'Kudosu!',
                'total' => 'Σύνολο Εξασφαλισμένων Kudosu',
                'total_info' => 'Βασισμένο στο πόσο έχει συνεισφέρει ο χρήστης για τον έλεγχο των beatmap. Δείτε <a href="'.osu_url('user.kudosu').'">αυτήν τη σελίδα</a> για περισσότερες πληροφορίες.',

                'entry' => [
                    'amount' => ':amount kudosu',
                    'empty' => "Αυτός ο χρήστης δεν έχει κερδίσει kudosu!",

                    'beatmap_discussion' => [
                        'allow_kudosu' => [
                            'give' => 'Λάβατε :amount kudosu από την άρνηση κατάργησης για την επεξεργασία του post :post',
                        ],

                        'deny_kudosu' => [
                            'reset' => 'Αρνήθηκε :amount από το modding της ανάρτησης :post',
                        ],

                        'delete' => [
                            'reset' => 'Χάσατε :amount από την επεξεργασία του post :post αφού έχει διαγραφεί',
                        ],

                        'restore' => [
                            'give' => 'Λάβατε :amount από την επεξεργασία μετά την αποκατάσταση του :post',
                        ],

                        'vote' => [
                            'give' => 'Λάβατε :amount από την απόκτηση ψήφων στην επεξεργασία του post :post',
                            'reset' => 'Χάσατε :amount επειδή χάσατε ψήφους για την επεξεργασία του post :post',
                        ],

                        'recalculate' => [
                            'give' => 'Λάβατε :amount από επανυπολογισμό ψήφων στην επεξεργασία του post :post',
                            'reset' => 'Χάσατε :amount από επαnυπολογισμό ψήφων για την επεξεργασία του post :post',
                        ],
                    ],

                    'forum_post' => [
                        'give' => 'Λάβατε :amount από τον :giver για μια ανάρτηση στο :post',
                        'reset' => 'Διαγράφηκαν τα Kudosu από τον :giver για το post :post',
                        'revoke' => 'Ο :giver αρνήθηκε τα kudosu για το post :post',
                    ],
                ],
            ],
            'me' => [
                'title' => 'me!',
            ],
            'medals' => [
                'empty' => "Αυτός ο χρήστης δεν έχει πάρει κανένα ακόμα. ;_;",
                'title' => 'Μετάλλια',
            ],
            'recent_activity' => [
                'title' => 'Πρόσφατα',
            ],
            'top_ranks' => [
                'empty' => 'Καμία εκπληκτική επίδοση ακόμα. :(',
                'not_ranked' => 'Μόνο τα ranked beatmaps δίνουν pp.',
                'pp' => '',
                'title' => 'Σκορ',
                'weighted_pp' => 'σταθμισμένα: :pp (:percentage)',

                'best' => [
                    'title' => 'Καλύτερες Eπιδόσεις',
                ],
                'first' => [
                    'title' => 'Πρώτες Θέσεις',
                ],
            ],
            'account_standing' => [
                'title' => 'Κατάσταση λογαριασμού',
                'bad_standing' => "Ο λογαριασμός του <strong>:username</strong> δεν βρίσκεται σε καλή κατάσταση :(",
                'remaining_silence' => '<strong>:username</strong> θα μπορεί να μιλήσει πάλι σε :duration.',

                'recent_infringements' => [
                    'title' => 'Πρόσφατες Παραβιάσεις',
                    'date' => 'ημερομηνία',
                    'action' => 'δράση',
                    'length' => 'μήκος',
                    'length_permanent' => 'Μόνιμο',
                    'description' => 'περιγραφή',
                    'actor' => 'από :username',

                    'actions' => [
                        'restriction' => 'Αποκλεισμός',
                        'silence' => 'Σίγαση',
                        'note' => 'Σημείωση',
                    ],
                ],
            ],
        ],
        'info' => [
            'discord' => '',
            'interests' => 'Ενδιαφέροντα',
            'lastfm' => 'Last.fm',
            'location' => 'Τρέχουσα Τοποθεσία',
            'occupation' => 'Ενασχόληση',
            'skype' => '',
            'twitter' => '',
            'website' => 'Ιστοσελίδα',
        ],
        'not_found' => [
            'reason_1' => 'Μπορεί να έχει αλλάξει όνομα χρήστη.',
            'reason_2' => 'Ο λογαριασμός μπορεί να είναι προσωρινά μη διαθέσιμος λόγω προβλημάτων ασφάλειας η κατάχρησης.',
            'reason_3' => 'Μπορεί να έχετε κάνει τυπογραφικό λάθος!',
            'reason_header' => 'Υπάρχουν μερικοί πιθανοί λόγοι για αυτό:',
            'title' => 'Ο χρήστης δε βρέθηκε! ;_;',
        ],
        'page' => [
            'description' => 'To <strong>me!</strong> είναι μια προσωπική προσαρμόσιμη περιοχή στη σελίδα του προφίλ σας.',
            'edit_big' => 'Επεξεργασία!',
            'placeholder' => 'Γράψτε το περιεχόμενο της σελίδας εδώ',
            'restriction_info' => "Χρειάζεται να είστε <a href='".route('store.products.show', 'supporter-tag')."' target='_blank'>osu!supporter</a> για να ξεκλειδώσετε αυτή τη δυνατότητα.",
        ],
        'post_count' => [
            '_' => 'Συνεισφορά :link',
            'count' => ':count φόρουμ ανάρτηση|:count φόρουμ αναρτήσεις',
        ],
        'rank' => [
            'country' => 'Κατάταξη στη χώρα για το :mode',
            'global' => 'Παγκόσμια κατάταξη για το :mode',
        ],
        'stats' => [
            'hit_accuracy' => 'Ακρίβεια Ευστοχίας',
            'level' => 'Επίπεδο :level',
            'maximum_combo' => 'Μέγιστο Combo',
            'play_count' => 'Αριθμός Προσπαθειών',
            'play_time' => 'Συνολικός Χρόνος Παιχνιδιού',
            'ranked_score' => 'Ranked Σκορ',
            'replays_watched_by_others' => 'Replays που Παρακολουθήθηκαν από Άλλους',
            'score_ranks' => 'Κατάταξη Score',
            'total_hits' => 'Συνολικά Hits',
            'total_score' => 'Συνολική Βαθμολογία',
        ],
    ],
    'status' => [
        'online' => 'Συνδεδεμένοι',
        'offline' => 'Αποσυνδεδεμένοι',
    ],
    'store' => [
        'saved' => 'Ο χρήστης δημιουργήθηκε',
    ],
    'verify' => [
        'title' => 'Επαλήθευση του Λογαριασμού',
    ],
];

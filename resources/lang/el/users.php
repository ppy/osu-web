<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'deleted' => '[διαγραμμένος χρήστης]',

    'beatmapset_activities' => [
        'title' => "Ιστορικό Modding του χρήστη :user",
        'title_compact' => 'Εξέταση',

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

    'disabled' => [
        'title' => '',
        'warning' => "",

        'if_mistake' => [
            '_' => '',
            'email' => '',
        ],

        'reasons' => [
            'compromised' => '',
            'opening' => '',

            'tos' => [
                '_' => '',
                'community_rules' => '',
                'tos' => '',
            ],
        ],
    ],

    'filtering' => [
        'by_game_mode' => '',
    ],

    'force_reactivation' => [
        'reason' => [
            'inactive_different_country' => "",
        ],
    ],

    'login' => [
        '_' => 'Σύνδεση',
        'button' => 'Είσοδος',
        'button_posting' => 'Είσοδος...',
        'email_login_disabled' => '',
        'failed' => 'Λάθος σύνδεση',
        'forgot' => 'Ξεχάσατε τον κωδικό σας;',
        'info' => '',
        'invalid_captcha' => '',
        'locked_ip' => 'η διεύθυνση IP σας είναι κλειδωμένη. Παρακαλώ περιμένετε λίγα λεπτά.',
        'password' => 'Κωδικός',
        'register' => "Δεν έχετε λογαριασμό στο osu!; Φτιάξτε ένα νέο",
        'remember' => 'Απομνημόνευση της σύνδεσης',
        'title' => 'Παρακαλώ συνδεθείτε για να συνεχίσετε',
        'username' => 'Όνομα χρήστη',

        'beta' => [
            'main' => 'Η πρόσβαση στην έκδοση Beta είναι περιορισμένη σε προνομιούχους χρήστες.',
            'small' => '(οι osu!supporters θα έχουν πρόσβαση σύντομα)',
        ],
    ],

    'posts' => [
        'title' => 'Δημοσιεύσεις του :username',
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
        'lastvisit_online' => '',
        'missingtext' => 'Ίσως να κάνατε κάποιο ορθογραφικό λάθος! (ή ο χρήστης είναι banned)',
        'origin_country' => 'Από :country',
        'previous_usernames' => 'προηγουμένως γνωστός ως',
        'plays_with' => 'Παίζει με :devices',
        'title' => "Το προφίλ του :username",

        'comments_count' => [
            '_' => '',
            'count' => '',
        ],
        'edit' => [
            'cover' => [
                'button' => 'Αλλάξτε το Εξώφυλλο του Προφίλ σας',
                'defaults_info' => 'Περισσότερα εξώφυλλα θα είναι διαθέσιμα στο μέλλον',
                'upload' => [
                    'broken_file' => 'Αποτυχία επεξεργασίας εικόνας. Ελέγξτε την εικόνα και προσπαθήστε ξανά.',
                    'button' => 'Ανεβάστε εικόνα',
                    'dropzone' => 'Αφήστε εδώ για να ανεβεί',
                    'dropzone_info' => 'Μπορείτε επίσης να σύρετε την εικόνα σας εδώ για να ανεβεί',
                    'size_info' => 'Το μέγεθος του εξωφύλλου πρέπει να είναι 2400x620',
                    'too_large' => 'Το αρχείο είναι πολύ μεγάλο.',
                    'unsupported_format' => 'Μη υποστηριζόμενη μορφή.',

                    'restriction_info' => [
                        '_' => '',
                        'link' => '',
                    ],
                ],
            ],

            'default_playmode' => [
                'is_default_tooltip' => 'προεπιλεγμένο game mode',
                'set' => 'όρισε το :mode ως το προεπιλεγμένο game mode',
            ],
        ],

        'extra' => [
            'none' => '',
            'unranked' => 'Κανένα πρόσφατο σκορ',

            'achievements' => [
                'achieved-on' => 'Επιτεύχθηκε στις :date',
                'locked' => 'Κλειδωμένο',
                'title' => 'Επιτεύγματα',
            ],
            'beatmaps' => [
                'by_artist' => 'από :artist',
                'title' => 'Beatmaps',

                'favourite' => [
                    'title' => 'Αγαπημένα Beatmaps',
                ],
                'graveyard' => [
                    'title' => 'Παρατημένα Beatmaps',
                ],
                'loved' => [
                    'title' => 'Loved Beatmaps',
                ],
                'pending' => [
                    'title' => 'Εκκρεμή Beatmaps',
                ],
                'ranked' => [
                    'title' => 'Ranked & Approved Beatmaps',
                ],
            ],
            'discussions' => [
                'title' => '',
                'title_longer' => '',
                'show_more' => '',
            ],
            'events' => [
                'title' => '',
                'title_longer' => '',
                'show_more' => '',
            ],
            'historical' => [
                'title' => 'Ιστορικό',

                'monthly_playcounts' => [
                    'title' => 'Ιστορικό Δραστηριότητας',
                    'count_label' => 'Προσπάθειες',
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
                    'count_label' => 'Παρακολουθημένες Επαναλήψεις',
                ],
            ],
            'kudosu' => [
                'recent_entries' => 'Πρόσφατο Ιστορικό Kudosu',
                'title' => 'Kudosu!',
                'total' => 'Σύνολο Εξασφαλισμένων Kudosu',

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

                'total_info' => [
                    '_' => '',
                    'link' => '',
                ],
            ],
            'me' => [
                'title' => 'me!',
            ],
            'medals' => [
                'empty' => "Αυτός ο χρήστης δεν έχει πάρει κανένα ακόμα. ;_;",
                'recent' => 'Πρόσφατα',
                'title' => 'Μετάλλια',
            ],
            'posts' => [
                'title' => '',
                'title_longer' => '',
                'show_more' => '',
            ],
            'recent_activity' => [
                'title' => 'Πρόσφατα',
            ],
            'top_ranks' => [
                'download_replay' => 'Λήψη Επανάληψης',
                'not_ranked' => 'Μόνο τα ranked beatmaps δίνουν pp.',
                'pp_weight' => 'σταθμισμένo :percentage',
                'view_details' => '',
                'title' => 'Σκορ',

                'best' => [
                    'title' => 'Καλύτερες Eπιδόσεις',
                ],
                'first' => [
                    'title' => 'Πρώτες Θέσεις',
                ],
            ],
            'votes' => [
                'given' => '',
                'received' => '',
                'title' => '',
                'title_longer' => '',
                'vote_count' => '',
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
            'location' => 'Τρέχουσα Τοποθεσία',
            'occupation' => 'Ενασχόληση',
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
            'button' => 'Επεξεργασία σελίδας προφίλ',
            'description' => 'To <strong>me!</strong> είναι μια προσωπική προσαρμόσιμη περιοχή στη σελίδα του προφίλ σας.',
            'edit_big' => 'Επεξεργασία!',
            'placeholder' => 'Γράψτε το περιεχόμενο της σελίδας εδώ',

            'restriction_info' => [
                '_' => '',
                'link' => '',
            ],
        ],
        'post_count' => [
            '_' => 'Συνεισφορά :link',
            'count' => ':count φόρουμ ανάρτηση|:count φόρουμ αναρτήσεις',
        ],
        'rank' => [
            'country' => 'Κατάταξη στη χώρα για το :mode',
            'country_simple' => 'Εθνική Κατάταξη',
            'global' => 'Παγκόσμια κατάταξη για το :mode',
            'global_simple' => 'Παγκόσμια Κατάταξη',
        ],
        'stats' => [
            'hit_accuracy' => 'Ακρίβεια Ευστοχίας',
            'level' => 'Επίπεδο :level',
            'level_progress' => 'Πρόοδος για επόμενο επίπεδο',
            'maximum_combo' => 'Μέγιστο Combo',
            'medals' => 'Μετάλλια',
            'play_count' => 'Αριθμός Προσπαθειών',
            'play_time' => 'Συνολικός Χρόνος Παιχνιδιού',
            'ranked_score' => 'Ranked Σκορ',
            'replays_watched_by_others' => 'Replays που Παρακολουθήθηκαν από Άλλους',
            'score_ranks' => 'Κατάταξη Score',
            'total_hits' => 'Συνολικά Hits',
            'total_score' => 'Συνολική Βαθμολογία',
            // modding stats
            'graveyard_beatmapset_count' => '',
            'loved_beatmapset_count' => '',
            'pending_beatmapset_count' => '',
            'ranked_beatmapset_count' => '',
        ],
    ],

    'silenced_banner' => [
        'title' => '',
        'message' => '',
    ],

    'status' => [
        'all' => '',
        'online' => 'Συνδεδεμένοι',
        'offline' => 'Αποσυνδεδεμένοι',
    ],
    'store' => [
        'saved' => 'Ο χρήστης δημιουργήθηκε',
    ],
    'verify' => [
        'title' => 'Επαλήθευση του Λογαριασμού',
    ],

    'view_mode' => [
        'brick' => '',
        'card' => '',
        'list' => '',
    ],
];

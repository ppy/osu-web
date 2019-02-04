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
    'support' => [
        'header' => [
            // size in font-size
            'big_description' => 'Σας αρέσει το osu!;<br/>                                Υποστηρίξτε την εξέλιξη του osu! :D',
            'small_description' => '',
            'support_button' => 'Θέλω να υποστηρίξω το osu!',
        ],

        'dev_quote' => 'To osu! είναι ένα εντελώς δωρεάν παιχνίδι, αλλά η λειτουργία του δεν είναι σε καμία περίπτωση τόσο δωρεάν. Μεταξύ άλλων, το κόστος των servers και το υψηλής ποιότητας διεθνές bandwith, ο χρόνος που ξοδεύεται για τη διατήρηση του συστήματος και της κοινότητας,  εξασφαλίζοντας βραβεία για τους διαγωνισμούς, απαντώντας σε ερωτήσεις υποστήριξης και γενικά κρατώντας τον κόσμο χαρούμενο, το osu! καταναλώνει ένα βαρύ ποσό χρημάτων!        Α, και μην ξεχνάτε το γεγονός ότι όλα αυτά τα κάνουμε χωρίς καμία διαφήμιση ή με κάποια συνεργασία με κάποιο χαζό toolbar και τα λοιπά!            <br/><br/> Το osu! στην τελική τρέχεται σε μεγάλο ποσοστό από εμένα, που μπορεί να με γνωρίζετε ως "peppy".
            Έπρεπε να παραιτηθώ από τη δουλειά μου για να μπορώ να διατηρώ το osu!
            και όντως κάποιες φορές παλεύω να διατηρήσω τα standards για τα οποία αγωνίζομαι.
            Θα ήθελα να προσφέρω τις προσωπικές μου ευχαριστίες σε όσους έχουν υποστηρίξει το osu! εώς τώρα,
            και να ευχαριστήσω επίσης στον ίδιο βαθμό εκείνους που συνεχίζουν να υποστηρίζουν αυτό το υπέροχο παιχνίδι και την κοινότητα και στο μέλλον :).',

        'supporter_status' => [
            'contribution' => 'Ευχαριστούμε για την υποστήριξή σας μέχρι τώρα! Έχετε συνεισφέρει το χρηματικό ποσό των :dollars σε :tags συναλλαγές!',
            'gifted' => ':giftedTags από τις αγορές των tag που έχετε κάνει έχουν δωριστεί (συνολικά :giftedDollars), πόσο γενναιόδωρο!',
            'not_yet' => "Δεν έχετε supporter tag. :(",
            'title' => 'Η τρέχουσα κατάσταση supporter',
            'valid_until' => 'Το τρέχον supporter tag σας είναι έγκυρο μέχρι τις :date!',
            'was_valid_until' => 'Το supporter tag σας ήταν έγκυρο μέχρι :date.',
        ],

        'why_support' => [
            'title' => 'Γιατί πρέπει να υποστηρίξω το osu!;',
            'blocks' => [
                'dev' => 'Αναπτύσσεται και συντηρείται κυρίως από έναν άνθρωπο στην Αυστραλία',
                'time' => 'Παίρνει τόσο χρόνο να το συντηρούμε που πλέον δεν το αποκαλούμε \'\'χόμπι\'\'.',
                'ads' => 'Καθόλου διαφημίσεις πουθενά <br/><br/>
Σε αντίθεση με το 99.95% του διαδικτύου, δεν επωφελούμαστε απ\' το να ρίχνουμε πράγματα στη μούρη σας.',
                'goodies' => 'Παίρνετε κάποια επιπλέον καλούδια!',
            ],
        ],

        'perks' => [
            'title' => 'Χμ; Τι κερδίζω;!',
            'osu_direct' => [
                'title' => 'osu!direct',
                'description' => 'γρήγορη και εύκολη πρόσβαση για να αναζητήσετε beatmaps χωρίς να βγείτε από το παιχνίδι.',
            ],

            'auto_downloads' => [
                'title' => 'Αυτόματα download',
                'description' => 'Αυτόματα download όσο παίζετε σε multiplayer, όταν κάνετε spectate άλλους, ή ανοίγετε links στο chat!',
            ],

            'upload_more' => [
                'title' => 'Ανεβάστε Περισσότερα',
                'description' => 'Επιπλέον θέσεις για pending beatmaps (ανά ranked beatmap) μέχρι το μέγιστο των 10.',
            ],

            'early_access' => [
                'title' => 'Πρόωρη Πρόσβαση',
                'description' => 'Πρόσβαση σε πρόωρες κυκλοφορίες, όπου μπορείτε να δοκιμάσετε τα νέα χαρακτηριστικά πριν γίνουν δημόσια!',
            ],

            'customisation' => [
                'title' => 'Προσαρμογή',
                'description' => 'Προσαρμόστε το προφίλ σας προσθέτοντας μία πλήρως προσαρμόσιμη σελίδα χρήστη.',
            ],

            'beatmap_filters' => [
                'title' => 'Φίλτρα για beatmaps',
                'description' => 'Φιλτράρετε τις αναζητήσεις για beatmaps σε αυτά που έχετε παίξει και σε αυτά που δεν έχετε παίξει και στο βαθμό που έχετε πάρει (αν υπάρχει).',
            ],

            'yellow_fellow' => [
                'title' => 'Κίτρινος Σύντροφος',
                'description' => 'Είστε αναγνωρίσιμοι μέσα στο παιχνίδι από το φωτεινό κίτρινο χρώμα στο όνομα χρήστη σας.',
            ],

            'speedy_downloads' => [
                'title' => 'Γρήγορα Download',
                'description' => 'Πιο επιεικείς περιορισμοί στα download, ειδικά όταν χρησιμοποιείτε το osu!direct.',
            ],

            'change_username' => [
                'title' => 'Αλλάξτε το όνομα χρήστη σας',
                'description' => 'Η δυνατότητα να αλλάξετε το όνομα χρήστη σας χωρίς επιπλέον κόστη. (μία φορά το πολύ)',
            ],

            'skinnables' => [
                'title' => 'Προσαρμόσιμα χαρακτηριστικά',
                'description' => 'Επιπλέον προσαρμόσιμα χαρακτηριστικά μέσα στο παιχνίδι, όπως το εξώφυλλο του κύριου μενού.',
            ],

            'feature_votes' => [
                'title' => 'Ψήφοι για Λειτουργίες',
                'description' => 'Ψήφοι για αιτήματα νέων λειτουργιών. (2 κάθε μήνα)',
            ],

            'sort_options' => [
                'title' => 'Κατάταξε',
                'description' => 'Η ικανότητα να βλέπετε την σειρά κατάταξης της χώρας / των φίλων σας / συγκεκριμένων mod στα beatmaps μέσα στο παιχνίδι.',
            ],

            'feel_special' => [
                'title' => 'Νιώστε ιδιαίτεροι',
                'description' => 'Το ζεστό και όμορφο αίσθημα να βοηθάς το osu! για να κυλάει ομαλά!',
            ],

            'more_to_come' => [
                'title' => 'Περισσότερα έρχονται',
                'description' => '',
            ],
        ],

        'convinced' => [
            'title' => 'Έχω πειστεί! :D',
            'support' => 'υποστηρίξτε το osu!',
            'gift' => 'ή δωρίστε σε άλλους παίκτες',
            'instructions' => 'κάντε κλικ στην καρδιά για να προχωρήσετε στο osu!κατάστημα',
        ],
    ],
];

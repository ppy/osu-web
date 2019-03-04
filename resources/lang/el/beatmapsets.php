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
    'availability' => [
        'disabled' => 'Αυτό το beatmap δεν είναι διαθέσιμο για λήψη.',
        'parts-removed' => 'Τμήματα αυτού του beatmap έχουν αφαιρεθεί κατ\' απαίτηση του δημιουργού ή κάποιου τρίτου, κατόχου πνευματικών δικαιωμάτων.',
        'more-info' => 'Κάντε κλικ εδώ για να δείτε περισσότερα.',
    ],

    'index' => [
        'title' => 'Λίστα Beatmaps',
        'guest_title' => 'Beatmaps',
    ],

    'show' => [
        'discussion' => 'Συζήτηση',

        'details' => [
            'approved' => 'έγινε approved στις ',
            'favourite' => 'Προσθέστε αυτό το beatmapset στα αγαπημένα',
            'favourited_count' => '+1 ακόμη| + :count ακόμη!',
            'logged-out' => 'Πρέπει να συνδεθείτε πριν κάνετε λήψη κάποιου beatmap!',
            'loved' => 'έγινε loved στις ',
            'mapped_by' => 'δημιουργήθηκε από :mapper',
            'qualified' => 'έγινε qualified στις ',
            'ranked' => 'έγινε ranked στις ',
            'submitted' => 'υποβλήθηκε στις ',
            'unfavourite' => 'Αφαιρέστε αυτό το beatmapset από τα αγαπημένα',
            'updated' => 'τελευταία ενημέρωση στις ',
            'updated_timeago' => 'τελευταία ενημέρωση :timeago',

            'download' => [
                '_' => 'Λήψη',
                'direct' => '',
                'no-video' => 'χωρίς Βίντεο',
                'video' => 'με Βίντεο',
            ],

            'login_required' => [
                'bottom' => '',
                'top' => '',
            ],
        ],

        'favourites' => [
            'limit_reached' => '',
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
        ],

        'info' => [
            'description' => 'Περιγραφή',
            'genre' => 'Είδος',
            'language' => 'Γλώσσα',
            'no_scores' => 'Τα δεδομένα ακόμα υπολογίζονται...',
            'points-of-failure' => 'Σημεία Αποτυχίας',
            'source' => 'Προέλευση',
            'success-rate' => 'Ποσοστό Επιτυχίας',
            'tags' => 'Ετικέτες',
            'unranked' => 'Unranked beatmap',
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
                'player' => 'Παίκτης',
                'pp' => '',
                'rank' => 'Κατάταξη',
                'score_total' => 'Συνολικό Σκορ',
                'score' => 'Σκορ',
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
    ],
];

<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'event' => [
        'approve' => 'Approved.',
        'beatmap_owner_change' => 'Ο ιδιοκτήτης δυσκολίας :beatmap άλλαξε σε :new_user.',
        'discussion_delete' => 'Ένας συντονιστής διέγραψε τη συζήτηση :discussion.',
        'discussion_lock' => 'Η συζήτηση για αυτό το beatmap έχει απενεργοποιηθεί. (:text)',
        'discussion_post_delete' => 'Ένας συντονιστής διέγραψε μια δημοσίευση από τη συζήτηση :discussion.',
        'discussion_post_restore' => 'Ένας συντονιστής επανέφερε μία δημοσίευση στη συζήτηση :discussion.',
        'discussion_restore' => 'Ένας συντονιστής επανέφερε τη συζήτηση :discussion.',
        'discussion_unlock' => 'Η συζήτηση για αυτό το beatmap έχει ενεργοποιηθεί.',
        'disqualify' => 'Disqualified από :user. Αιτία: :discussion (:text).',
        'disqualify_legacy' => 'Disqualified από :user. Αιτία: :text.',
        'genre_edit' => 'Το είδος άλλαξε από :old σε :new.',
        'issue_reopen' => 'Το ζήτημα επιλύθηκε, η συζήτηση :discussion ξανάνοιξε.',
        'issue_resolve' => 'Ζήτημα :discussion σημάνθηκε ως επιλυμένο.',
        'kudosu_allow' => 'Άρνηση kudosu για τη συζήτηση :discussion που αφαιρέθηκε.',
        'kudosu_deny' => 'Άρνηση kudosu για τη συζήτηση :discussion.',
        'kudosu_gain' => 'Η συζήτηση :discussion από τον :user έλαβε αρκετές ψήφους για kudosu.',
        'kudosu_lost' => 'Η συζήτηση :discussion από τον :user έχασε ψήφους και τα kudosu που είχαν δοθεί αφαιρέθηκαν.',
        'kudosu_recalculate' => 'Τα κέρδη kudosu για τη συζήτηση :discussion επαναϋπολογίστηκαν.',
        'language_edit' => 'Η γλώσσα άλλαξε από :old σε :new.',
        'love' => 'Loved από :user',
        'nominate' => 'Nominated από :user.',
        'nominate_modes' => 'Υποψήφια από :user (:modes).',
        'nomination_reset' => 'Ένα νέο πρόβλημα :discussion (:text) ξεκίνησε μια επαναφορά της διαδικασίας υποψηφιότητας.',
        'nomination_reset_received' => 'Διορισμός από :user επαναφέρθηκε από :source_user (:text)',
        'nomination_reset_received_profile' => 'Η υποψηφιότητα επαναφέρθηκε από :user (:text)',
        'offset_edit' => 'Η Online μετατόπιση άλλαξε από :old σε :new.',
        'qualify' => 'Αυτό το beatmap έχει φτάσει των απαραίτητο αριθμό nominations και είναι πλέον qualified.',
        'rank' => 'Ranked.',
        'remove_from_loved' => 'Αφαιρέθηκε από Loved by :user. (:text)',
        'tags_edit' => 'Οι ετικέτες άλλαξαν από ":old" σε ":new".',

        'nsfw_toggle' => [
            'to_0' => 'Η explict επισήμανση αφαιρέθηκε',
            'to_1' => 'Σήμανση ως explict',
        ],
    ],

    'index' => [
        'title' => 'Γεγονότα Beatmapset',

        'form' => [
            'period' => 'Περίοδος',
            'types' => 'Τύποι',
        ],
    ],

    'item' => [
        'content' => 'Περιεχόμενο',
        'discussion_deleted' => '[διαγράφηκε]',
        'type' => 'Τύπος',
    ],

    'type' => [
        'approve' => 'Έγκριση',
        'beatmap_owner_change' => 'Αλλαγή ιδιοκτήτη δυσκολίας',
        'discussion_delete' => 'Διαγραφή συζήτησης',
        'discussion_post_delete' => 'Διαγραφή απάντησης συζήτησης',
        'discussion_post_restore' => 'Αποκατάσταση απάντησης συζήτησης',
        'discussion_restore' => 'Αποκατάσταση συζήτησης',
        'disqualify' => 'Αποκλεισμός',
        'genre_edit' => 'Επεξεργασία είδους',
        'issue_reopen' => 'Επανάνοιγμα συζήτησης',
        'issue_resolve' => 'Επίλυση συζήτησης',
        'kudosu_allow' => 'Επίδομα Kudosu',
        'kudosu_deny' => 'Άρνηση Kudosu',
        'kudosu_gain' => 'Κέρδος Kudosu',
        'kudosu_lost' => 'Απώλεια Kudosu',
        'kudosu_recalculate' => 'Επαναϋπολογισμός Kudosu',
        'language_edit' => 'Επεξεργασία γλώσσας',
        'love' => 'Αγαπημένο',
        'nominate' => 'Διορισμός',
        'nomination_reset' => 'Επαναφορά διορισμού',
        'nomination_reset_received' => 'Ελήφθησαν επαναφορά διορισμού',
        'nsfw_toggle' => 'Explict σήμα',
        'offset_edit' => 'Επεξεργασία μετατόπισης',
        'qualify' => 'Προσόντα',
        'rank' => 'Κατάταξη',
        'remove_from_loved' => 'Αφαίρεση αγάπης',
    ],
];

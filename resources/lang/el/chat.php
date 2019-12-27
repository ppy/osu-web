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
    'limitation_notice' => 'ΣΗΜΕΙΩΣΗ: Μόνο όσοι χρησημοποιούν το <a href=":lazer_link">osu!lazer</a> ή την νέα ιστοσελίδα θα μπορούν να δέχονται προσωπικά μηνύματα μέσω του συστήματος.<br/>Εαν δεν είστε σίγουρος, στέιλτε τους μήνυμα μέσω του <a href=":oldpm_link">παλιού forum</a> αντί αυτού.',
    'talking_in' => 'μιλάτε στο: :channel',
    'talking_with' => 'μιλάτε με: :name',
    'title_compact' => 'συνομιλία',

    'cannot_send' => [
        'channel' => 'Δεν μπορείτε να στείλετε μήνυμα σε αυτό το κανάλι αυτή τη στιγμή. Αυτό μπορεί να οφείλεται σε οποιοδήποτε από τους παρακάτω λόγους:',
        'user' => 'Δεν μπορείτε να στείλετε μήνυμα σε αυτόν τον χρήστη αυτή τη στιγμή. Αυτό μπορεί να οφείλεται σε οποιοδήποτε από τους παρακάτω λόγους:',
        'reasons' => [
            'blocked' => 'Έχετε αποκλειστεί από τον παραλήπτη',
            'channel_moderated' => 'Το κανάλι έχει εποπτευτεί',
            'friends_only' => 'Ο παραλήπτης δέχεται μηνύματα μόνο από άτομα στην λίστα φίλων τους',
            'restricted' => 'Είστε περιορισμένος',
            'target_restricted' => 'Αυτός ο χρήστης είναι περιορισμένος',
        ],
    ],
    'input' => [
        'disabled' => 'αδυναμία αποστολής μηνύματος...',
        'placeholder' => 'εισάγετε μήνυμα...',
        'send' => 'Αποστολή',
    ],
    'no-conversations' => [
        'howto' => "Ξεκινήστε συνομιλίες από προφίλ χρήστη ή usercard παράθυρο.",
        'lazer' => 'Δημόσια κανάλια που συνδέεστε μέσω του <a href=":link">osu!lazer</a> θα επίσης εμφανίζονται εδώ.',
        'pm_limitations' => 'Μόνο τα άτομα που χρησιμοποιούν το <a href=":link">osu!lazer</a> ή τη νέα ιστοσελίδα θα λάμβάνουν PMs.',
        'title' => 'δεν υπάρχουν συνομιλίες',
    ],
];

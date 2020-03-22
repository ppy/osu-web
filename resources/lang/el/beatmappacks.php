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
    'index' => [
        'description' => 'Προ-πακεταρισμένες συλλογές beatmaps βασισμένες σε ένα κοινό θέμα.',
        'nav_title' => '',
        'title' => 'Πακέτα Beatmaps',

        'blurb' => [
            'important' => 'ΔΙΑΒΑΣΤΕ ΠΡΙΝ ΑΠΟ ΤΗ ΛΗΨΗ',
            'instruction' => [
                '_' => "Εγκατάσταση: Όταν ολοκληρωθεί η λήψη ενός πακέτου, εξάγετε το .rar αρχείο στον osu! Songs φάκελό σας. Όλα τα τραγούδια είναι ακόμα σε μορφή zip ή osz μέσα στο πακέτο, οπότε το osu! θα χρειαστεί να κάνει εξαγωγή όλα τα beatmaps από μόνο του την επόμενη φορά που θα πατήσετε Play. MHN εξάγετε τα αρχεία zip/osz από μόνοι σας, διαφορετικά τα beatmaps θα εμφανίζονται εσφαλμένα στο osu! και δε θα λειτουργούν σωστά.",
                'scary' => 'ΜΗΝ',
            ],
            'note' => [
                '_' => 'Επίσης λάβετε υπόψη ότι προτείνεται να :scary, καθώς τα παλαιότερα maps είναι μακράν χειρότερης ποιότητας από τα περισσότερα πρόσφατα maps.',
                'scary' => 'κατεβάσετε τα πακέτα από τα πιο πρόσφατα προς τα παλαιότερα',
            ],
        ],
    ],

    'show' => [
        'download' => 'Λήψη',
        'item' => [
            'cleared' => 'ολοκληρώθηκε',
            'not_cleared' => 'δεν ολοκληρώθηκε',
        ],
    ],

    'mode' => [
        'artist' => 'Καλλιτέχνης/Άλμπουμ',
        'chart' => 'Spotlights',
        'standard' => 'Standard',
        'theme' => 'Θέμα',
    ],

    'require_login' => [
        '_' => 'Χρειάζεται να είστε :link για να κατεβάσετε',
        'link_text' => 'συνδεδεμένος',
    ],
];

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
    'index' => [
        'blurb' => [
            'important' => 'ΔΙΑΒΑΣΤΕ ΠΡΙΝ ΑΠΟ ΤΗ ΛΗΨΗ',
            'instruction' => [
                '_' => "Εγκατάσταση: Όταν ολοκληρωθεί η λήψη ενός πακέτου, εξάγετε το .rar αρχείο στον osu! Songs φάκελός σας. Όλα τα τραγούδια είναι ακόμα σε μορφή zip ή osz μέσα στο πακέτο, οπότε το osu! θα χρειαστεί να κάνει αξαγωγή όλα τα beatmaps από μόνο του την επόμενη φορά που θα είστε σε λειτουργία Play. MHN εξάγετε τα αρχεία zip/osz από μόνοι σας, ή τα beatmaps θα εμφανίζονται εσφαλμένα στο osu! και δε θα λειτουργούν σωστά.",
                'scary' => 'ΜΗΝ',
            ],
            'note' => [
                '_' => 'Επίσης λάβετε υπόψη ότι προτείνεται να :scary, αφού τα παλαιότερα maps είναι μακράν χειρότερης ποιότητας από τα περισσότερα πρόσφατα maps.',
                'scary' => 'κατεβάσετε τα πακέτα από το παλαιότερο προς το πιο πρόσφατο',
            ],
        ],
        'title' => 'Πακέτα Beatmaps',
        'description' => 'Προ-πακεταρισμένες συλλογές beatmaps βασισμένες σε ένα κοινό θέμα.',
    ],

    'show' => [
        'download' => 'Λήψη',
        'item' => [
            'cleared' => 'ολοκληρώθηκε',
            'not_cleared' => 'δεν ολοκληρώθηκε',
        ],
    ],

    'mode' => [
        'artist' => 'Καλλιτέχνης/Album',
        'chart' => 'Spotlights',
        'standard' => 'Standard',
        'theme' => 'Θέμα',
    ],

    'require_login' => [
        '_' => 'Χρειάζεται να είστε :link για να πραγματοποιήσετε λήψη',
        'link_text' => 'συνδεδεμένος',
    ],
];

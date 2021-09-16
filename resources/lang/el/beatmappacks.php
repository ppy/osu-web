<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'index' => [
        'description' => 'Προ-πακεταρισμένες συλλογές beatmaps βασισμένες σε ένα κοινό θέμα.',
        'nav_title' => 'λίστα',
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
        'no_diff_reduction' => [
            '_' => '',
            'link' => '',
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

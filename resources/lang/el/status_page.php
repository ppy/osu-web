<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'header' => [
        'title' => 'κατάσταση',
        'description' => 'τι συμβαίνει ρε αδερφέ;',
    ],

    'incidents' => [
        'title' => 'Ενεργά Περιστατικά',
        'automated' => 'αυτοματοποιημένο',
    ],

    'online' => [
        'title' => [
            'users' => 'Συνδεδεμένοι Χρήστες τις τελευταίες 24 Ώρες',
            'score' => 'Υποβολές Σκορ τις τελευταίες 24 Ώρες',
        ],
        'current' => 'Τρέχοντες Συνδεδεμένοι Χρήστες',
        'score' => 'Υποβολές Σκορ ανά Δευτερόλεπτο',
    ],

    'recent' => [
        'incidents' => [
            'title' => 'Πρόσφατα Περιστατικά',
            'state' => [
                'resolved' => 'Επιλυμένα',
                'resolving' => 'Σε Επίλυση',
                'unknown' => 'Άγνωστο',
            ],
        ],

        'uptime' => [
            'title' => 'Χρόνος σε λειτουργία',
            'graphs' => [
                'server' => 'server',
                'web' => 'web',
            ],
        ],

        'when' => [
            'today' => 'σήμερα',
            'week' => 'εβδομάδα',
            'month' => 'μήνας',
            'all_time' => 'από την αρχή',
            'last_week' => 'την προηγούμενη εβδομάδα',
            'weeks_ago' => ':count εβδομάδα πριν|:count εβδομάδες πριν',
        ],
    ],
];

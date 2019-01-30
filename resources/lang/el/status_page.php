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

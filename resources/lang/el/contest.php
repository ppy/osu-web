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
    'header' => [
        'small' => 'Ανταγωνιστείτε με περισσότερους τρόπους από το να πατάτε απλά κύκλους.',
        'large' => 'Διαγωνισμοί Κοινότητας',
    ],
    'voting' => [
        'over' => 'Η ψηφοφορία για αυτόν τον διαγωνισμό έχει λήξει',
        'login_required' => 'Παρακαλώ συνδεθείτε για να ψηφίσετε.',
        'best_of' => [
            'none_played' => "Φαίνεται ότι δεν έχετε παίξει κάποιο beatmap που πληροί τα κριτήρια για αυτόν τον διαγωνισμό!",
        ],
    ],
    'entry' => [
        '_' => 'καταχώριση',
        'login_required' => 'Παρακαλούμε συνδεθείτε για να συμμετάσχετε στο διαγωνισμό.',
        'silenced_or_restricted' => 'Δεν μπορείτε να μπείτε σε διαγωνισμούς ενώ είστε restricted ή silenced.',
        'preparation' => 'Είμαστε στη διαδικασία προετοιμασίας του διαγωνισμού. Υπομονή παρακαλώ!',
        'over' => 'Σας ευχαριστούμε για τις καταχωρήσεις σας! Οι υποβολές έχουν κλείσει για αυτόν τον διαγωνισμό και η ψηφοφορία θα ανοίξει σύντομα.',
        'limit_reached' => 'Έχετε φτάσει το όριο καταχωρήσεων για αυτόν τον διαγωνισμό',
        'drop_here' => 'Αφήστε την καταχώρησή σας εδώ',
        'wrong_type' => [
            'art' => 'Μόνο .jpg και .png αρχεία είναι αποδεκτά για αυτόν τον διαγωνισμό.',
            'beatmap' => 'Μόνο .osu αρχεία είναι αποδεκτά για αυτόν τον διαγωνισμό.',
            'music' => 'Μόνο .mp3 αρχεία είναι αποδεκτά για αυτόν τον διαγωνισμό.',
        ],
        'too_big' => 'Οι καταχωρήσεις για αυτόν τον διαγωνισμό μπορούν να είναι το πολύ :limit.',
    ],
    'beatmaps' => [
        'download' => 'Λήψη Καταχώρησης',
    ],
    'vote' => [
        'list' => 'ψήφοι',
        'count' => '1 ψήφος|:count ψήφοι',
    ],
    'dates' => [
        'ended' => 'Τελείωσε στις :date',

        'starts' => [
            '_' => 'Ξεκινάει στις :date',
            'soon' => 'σύντομα™',
        ],
    ],
    'states' => [
        'entry' => 'Ανοιχτές Συμμετοχές',
        'voting' => 'Η Ψηφοφορία Ξεκίνησε',
        'results' => 'Αποτελέσματα',
    ],
];

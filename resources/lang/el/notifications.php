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
    'all_read' => 'Όλες οι ειδοποιήσεις διαβάστηκαν!',
    'mark_all_read' => 'Εκκαθάριση όλων',
    'message_multi' => ':count_delimited νέα ενημέρωση στο ":title".|:count_delimited καινούριες ενημερώσεις στο ":title".',

    'item' => [
        'beatmapset' => [
            '_' => 'Beatmap',

            'beatmapset_discussion' => [
                '_' => 'Συζήτηση για το beatmap',
                'beatmapset_discussion_lock' => 'Η συζήτηση για το beatmap ":title" έχει κλειδώσει.',
                'beatmapset_discussion_post_new' => 'Ο χρήστης:username δημοσίευσε ένα καινούριο μήνυμα στη συζήτηση για το beatmap ":title".',
                'beatmapset_discussion_unlock' => 'Η συζήτηση για το beatmap ":title" ξεκλειδώθηκε.',
            ],

            'beatmapset_state' => [
                '_' => 'Η κατάσταση του beatmap άλλαξε',
                'beatmapset_disqualify' => 'Το beatmap ":title" απορρίφθηκε από τον χρήστη :username.',
                'beatmapset_love' => 'Το beatmap ":title" προάχθηκε ως loved από τον χρήστη :username.',
                'beatmapset_nominate' => 'Το beatmap ":title" έγινε nominate από τον χρήστη :username.',
                'beatmapset_qualify' => 'To beatmap ":title" έχει λάβει αρκετά nominations και μπήκε στη σειρά για να γίνει ranked.',
                'beatmapset_reset_nominations' => 'Το θέμα που δημοσιεύτηκε από τον χρήστη :username επανέφερε το beatmap ":title" σε κατάσταση προς nomination ',
            ],
        ],

        'forum_topic' => [
            '_' => 'Θέμα του forum',

            'forum_topic_reply' => [
                '_' => 'Νέα απάντηση στο forum',
                'forum_topic_reply' => 'O χρήστης:username απάντησε στο θέμα του forum ":title".',
            ],
        ],

        'legacy_pm' => [
            '_' => 'Προσωπικά Μηνύματα του Παλαιότερου Forum',

            'legacy_pm' => [
                '_' => '',
                'legacy_pm' => ':count_delimited αδιάβαστο μήνυμα.|:count_delimited αδιάβαστα μηνύματα.',
            ],
        ],
    ],
];

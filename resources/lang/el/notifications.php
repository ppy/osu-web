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
    'none' => '',
    'see_all' => '',

    'filters' => [
        '_' => '',
        'user' => '',
        'beatmapset' => '',
        'forum_topic' => '',
        'news_post' => '',
        'build' => '',
        'channel' => '',
    ],

    'item' => [
        'beatmapset' => [
            '_' => 'Beatmap',

            'beatmapset_discussion' => [
                '_' => 'Συζήτηση για το beatmap',
                'beatmapset_discussion_lock' => 'Η συζήτηση για το beatmap ":title" έχει κλειδώσει.',
                'beatmapset_discussion_lock_compact' => '',
                'beatmapset_discussion_post_new' => 'Ο χρήστης:username δημοσίευσε ένα καινούριο μήνυμα στη συζήτηση για το beatmap ":title".',
                'beatmapset_discussion_post_new_empty' => '',
                'beatmapset_discussion_post_new_compact' => '',
                'beatmapset_discussion_post_new_compact_empty' => '',
                'beatmapset_discussion_unlock' => 'Η συζήτηση για το beatmap ":title" ξεκλειδώθηκε.',
                'beatmapset_discussion_unlock_compact' => '',
            ],

            'beatmapset_problem' => [
                '_' => '',
                'beatmapset_discussion_qualified_problem' => '',
                'beatmapset_discussion_qualified_problem_empty' => '',
                'beatmapset_discussion_qualified_problem_compact' => '',
                'beatmapset_discussion_qualified_problem_compact_empty' => '',
            ],

            'beatmapset_state' => [
                '_' => 'Η κατάσταση του beatmap άλλαξε',
                'beatmapset_disqualify' => 'Το beatmap ":title" απορρίφθηκε από τον χρήστη :username.',
                'beatmapset_disqualify_compact' => '',
                'beatmapset_love' => 'Το beatmap ":title" προάχθηκε ως loved από τον χρήστη :username.',
                'beatmapset_love_compact' => '',
                'beatmapset_nominate' => 'Το beatmap ":title" έγινε nominate από τον χρήστη :username.',
                'beatmapset_nominate_compact' => '',
                'beatmapset_qualify' => 'To beatmap ":title" έχει λάβει αρκετά nominations και μπήκε στη σειρά για να γίνει ranked.',
                'beatmapset_qualify_compact' => '',
                'beatmapset_rank' => '',
                'beatmapset_rank_compact' => '',
                'beatmapset_reset_nominations' => 'Το θέμα που δημοσιεύτηκε από τον χρήστη :username επανέφερε το beatmap ":title" σε κατάσταση προς nomination ',
                'beatmapset_reset_nominations_compact' => '',
            ],

            'comment' => [
                '_' => '',

                'comment_new' => '',
                'comment_new_compact' => '',
            ],
        ],

        'channel' => [
            '_' => '',

            'channel' => [
                '_' => '',
                'pm' => [
                    'channel_message' => '',
                    'channel_message_compact' => '',
                    'channel_message_group' => '',
                ],
            ],
        ],

        'build' => [
            '_' => '',

            'comment' => [
                '_' => '',

                'comment_new' => '',
                'comment_new_compact' => '',
            ],
        ],

        'news_post' => [
            '_' => '',

            'comment' => [
                '_' => '',

                'comment_new' => '',
                'comment_new_compact' => '',
            ],
        ],

        'forum_topic' => [
            '_' => 'Θέμα του forum',

            'forum_topic_reply' => [
                '_' => 'Νέα απάντηση στο forum',
                'forum_topic_reply' => 'O χρήστης:username απάντησε στο θέμα του forum ":title".',
                'forum_topic_reply_compact' => '',
            ],
        ],

        'legacy_pm' => [
            '_' => 'Προσωπικά Μηνύματα του Παλαιότερου Forum',

            'legacy_pm' => [
                '_' => '',
                'legacy_pm' => ':count_delimited αδιάβαστο μήνυμα.|:count_delimited αδιάβαστα μηνύματα.',
            ],
        ],

        'user_achievement' => [
            '_' => '',

            'user_achievement_unlock' => [
                '_' => '',
                'user_achievement_unlock' => '',
                'user_achievement_unlock_compact' => '',
            ],
        ],
    ],
];

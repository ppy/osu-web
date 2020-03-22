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
    'all_read' => 'Alle varsler lest!',
    'mark_all_read' => 'Tøm alt',
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
                '_' => 'Beatmapdiskusjon',
                'beatmapset_discussion_lock' => 'Beatmappen ":title" har blitt låst for diskusjon.',
                'beatmapset_discussion_lock_compact' => 'Diskusjonen var låst',
                'beatmapset_discussion_post_new' => ':username la til en ny melding i beatmapdiskusjonen til ":title".',
                'beatmapset_discussion_post_new_empty' => '',
                'beatmapset_discussion_post_new_compact' => 'Nytt innlegg av :username',
                'beatmapset_discussion_post_new_compact_empty' => '',
                'beatmapset_discussion_unlock' => 'Beatmappen ":title" har blitt låst opp for diskusjon.',
                'beatmapset_discussion_unlock_compact' => 'Diskusjon var ulåst',
            ],

            'beatmapset_problem' => [
                '_' => '',
                'beatmapset_discussion_qualified_problem' => '',
                'beatmapset_discussion_qualified_problem_empty' => '',
                'beatmapset_discussion_qualified_problem_compact' => '',
                'beatmapset_discussion_qualified_problem_compact_empty' => '',
            ],

            'beatmapset_state' => [
                '_' => 'Beatmap status har blitt endret',
                'beatmapset_disqualify' => 'Beatmappen ":title" har blitt diskvalifisert av :username.',
                'beatmapset_disqualify_compact' => 'Beatmap var diskvalifisert',
                'beatmapset_love' => 'Beatmappen ":title" har blitt forfremmet til elsket av :username.',
                'beatmapset_love_compact' => 'Beatmap var promotert til elsket',
                'beatmapset_nominate' => 'Beatmappen ":title" har blitt nominert av :username.',
                'beatmapset_nominate_compact' => 'Beatmap var nominert',
                'beatmapset_qualify' => 'Beatmappen ":title" har fått nok nominasjoner og er dermed i kø til å bli rangert.',
                'beatmapset_qualify_compact' => 'Beatmappen er i kø for å bli rangert',
                'beatmapset_rank' => '":title" har blitt rangert',
                'beatmapset_rank_compact' => 'Beatmappet var rangert',
                'beatmapset_reset_nominations' => 'Problemstilling skrevet av :username nullstilte nominasjonen av beatmappet ":title" ',
                'beatmapset_reset_nominations_compact' => 'Nominasjonen ble tilbakestilt',
            ],

            'comment' => [
                '_' => 'Ny kommentar',

                'comment_new' => ':username kommenterte ":content" på ":title"',
                'comment_new_compact' => ':username kommenterte ":content"',
            ],
        ],

        'channel' => [
            '_' => 'Chat',

            'channel' => [
                '_' => 'Ny melding',
                'pm' => [
                    'channel_message' => ':username sier ":title"',
                    'channel_message_compact' => ':title',
                    'channel_message_group' => 'fra :username',
                ],
            ],
        ],

        'build' => [
            '_' => 'Endringslogg',

            'comment' => [
                '_' => 'Ny kommentar',

                'comment_new' => ':username kommenterte ":content" på ":title"',
                'comment_new_compact' => ':username kommenterte ":content"',
            ],
        ],

        'news_post' => [
            '_' => 'Nyheter',

            'comment' => [
                '_' => 'Ny kommentar',

                'comment_new' => ':username kommenterte ":content" på ":title"',
                'comment_new_compact' => ':username kommenterte ":content"',
            ],
        ],

        'forum_topic' => [
            '_' => 'Forumemne',

            'forum_topic_reply' => [
                '_' => 'Nytt forum svar',
                'forum_topic_reply' => ':username svarte på forumemne ":title".',
                'forum_topic_reply_compact' => ':username svarte',
            ],
        ],

        'legacy_pm' => [
            '_' => 'Eldre Forum PM',

            'legacy_pm' => [
                '_' => '',
                'legacy_pm' => ':count_delimited ulest melding.|:count_delimited uleste meldinger.',
            ],
        ],

        'user_achievement' => [
            '_' => 'Medaljer',

            'user_achievement_unlock' => [
                '_' => 'Ny medalje',
                'user_achievement_unlock' => '":title" låst opp!',
                'user_achievement_unlock_compact' => '',
            ],
        ],
    ],
];

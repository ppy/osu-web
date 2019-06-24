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
    'message_multi' => ':count_delimited ny oppdatering ved ":title".|:count_delimited nye oppdateringer ved ":title".',

    'item' => [
        'beatmapset' => [
            '_' => 'Beatmap',

            'beatmapset_discussion' => [
                '_' => 'Beatmapdiskusjon',
                'beatmapset_discussion_lock' => 'Beatmappen ":title" har blitt låst for diskusjon.',
                'beatmapset_discussion_post_new' => ':username la til en ny melding i beatmapdiskusjonen til ":title".',
                'beatmapset_discussion_unlock' => 'Beatmappen ":title" har blitt låst opp for diskusjon.',
            ],

            'beatmapset_state' => [
                '_' => 'Beatmap status er endret',
                'beatmapset_disqualify' => 'Beatmappen ":title" har blitt diskvalifisert av :username.',
                'beatmapset_love' => 'Beatmappen ":title" har blitt forfremmet til elsket av :username.',
                'beatmapset_nominate' => 'Beatmappen ":title" har blitt nominert av :username.',
                'beatmapset_qualify' => 'Beatmappen ":title" har fått nok nominasjoner og er dermed i kø til å bli rangert.',
                'beatmapset_reset_nominations' => 'Problemstilling skrevet av :username nullstilte nominasjonen av beatmappet ":title" ',
            ],
        ],

        'forum_topic' => [
            '_' => 'Forumemne',

            'forum_topic_reply' => [
                '_' => 'Nytt forum svar',
                'forum_topic_reply' => ':username svarte på forumemne ":title".',
            ],
        ],

        'legacy_pm' => [
            '_' => 'Eldre Forum PM',

            'legacy_pm' => [
                '_' => '',
                'legacy_pm' => ':count_delimited ulest melding.|:count_delimited uleste meldinger.',
            ],
        ],
    ],
];

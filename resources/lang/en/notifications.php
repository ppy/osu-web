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
    'all_read' => 'All notifications read!',
    'mark_all_read' => 'Clear all',
    'message_multi' => ':count_delimited new update on ":title".|:count_delimited new updates on ":title".',

    'item' => [
        'beatmapset' => [
            '_' => 'Beatmap',

            'beatmapset_discussion' => [
                '_' => 'Discussion',
                'beatmapset_discussion_post_new' => ':username posted new message in ":title" beatmap discussion.',
            ],

            'beatmapset_state' => [
                '_' => 'Approval',
                'beatmapset_disqualify' => 'Beatmap ":title" has been disqualified by :username.',
                'beatmapset_love' => 'Beatmap ":title" has been promoted as loved by :username.',
                'beatmapset_nominate' => 'Beatmap ":title" has been nominated by :username.',
                'beatmapset_qualify' => 'Beatmap ":title" has been gotten enough nominations and thus queued for ranking.',
                'beatmapset_reset_nominations' => 'Issue posted by :username reset nomination of beatmap ":title" ',
            ],
        ],

        'forum_topic' => [
            '_' => 'Forum topic',

            'forum_topic_reply' => [
                '_' => 'New reply',
                'forum_topic_reply' => ':username replied to forum topic ":title".',
            ],
        ],

        'legacy_pm' => [
            '_' => 'Private message',

            'legacy_pm' => [
                '_' => 'Legacy forum PM',
                'legacy_pm' => ':count_delimited unread message.|:count_delimited unread messages.',
            ],
        ],
    ],
];

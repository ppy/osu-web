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
    'all_read' => 'Alle Benachrichtigungen gelesen!',
    'mark_all_read' => 'Alle schließen',
    'message_multi' => ':count_delimited neues Update bei ":title".|:count_delimited neue Updates bei ":title".',

    'item' => [
        'beatmapset' => [
            '_' => 'Beatmap',

            'beatmapset_discussion' => [
                '_' => 'Beatmap Diskussion',
                'beatmapset_discussion_lock' => 'Die Diskussion der Beatmap ":title" wurde gesperrt.',
                'beatmapset_discussion_post_new' => ':username hat eine neue Nachricht in der Diskussion zur Beatmap ":title" gepostet.',
                'beatmapset_discussion_unlock' => 'Beatmap ":title" wurde zur Diskussion freigegeben.',
            ],

            'beatmapset_state' => [
                '_' => 'Beatmap Status geändert',
                'beatmapset_disqualify' => 'Beatmap ":title" wurde von :username disqualifiziert.',
                'beatmapset_love' => '',
                'beatmapset_nominate' => 'Beatmap ":title" wurde von :username nominiert.',
                'beatmapset_qualify' => '',
                'beatmapset_reset_nominations' => '',
            ],
        ],

        'forum_topic' => [
            '_' => '',

            'forum_topic_reply' => [
                '_' => '',
                'forum_topic_reply' => '',
            ],
        ],

        'legacy_pm' => [
            '_' => '',

            'legacy_pm' => [
                '_' => '',
                'legacy_pm' => '',
            ],
        ],
    ],
];

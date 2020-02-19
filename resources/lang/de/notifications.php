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
                '_' => 'Beatmap Diskussion',
                'beatmapset_discussion_lock' => 'Die Diskussion der Beatmap ":title" wurde gesperrt.',
                'beatmapset_discussion_lock_compact' => 'Die Diskussion ist gesperrt',
                'beatmapset_discussion_post_new' => ':username hat eine neue Nachricht in der Diskussion zur Beatmap ":title" gepostet.',
                'beatmapset_discussion_post_new_empty' => 'Neuer Beitrag auf ":title" von :username',
                'beatmapset_discussion_post_new_compact' => 'Neuer Beitrag von :username',
                'beatmapset_discussion_post_new_compact_empty' => 'Neuer Beitrag von :username',
                'beatmapset_discussion_unlock' => 'Beatmap ":title" wurde zur Diskussion freigegeben.',
                'beatmapset_discussion_unlock_compact' => 'Die Diskussion ist freigegeben',
            ],

            'beatmapset_problem' => [
                '_' => 'Problem mit qualifizierter Beatmap',
                'beatmapset_discussion_qualified_problem' => 'Gemeldet von :username auf ":title": ":content"',
                'beatmapset_discussion_qualified_problem_empty' => 'Gemeldet von :username auf ":title"',
                'beatmapset_discussion_qualified_problem_compact' => 'Gemeldet von :username: ":content"',
                'beatmapset_discussion_qualified_problem_compact_empty' => 'Gemeldet von :username',
            ],

            'beatmapset_state' => [
                '_' => 'Beatmap Status geändert',
                'beatmapset_disqualify' => 'Beatmap ":title" wurde von :username disqualifiziert.',
                'beatmapset_disqualify_compact' => 'Beatmap wurde disqualifiziert',
                'beatmapset_love' => 'Beatmap ":title" wurde zu geliebt erhoben',
                'beatmapset_love_compact' => 'Beatmap wurde zu geliebt erhoben',
                'beatmapset_nominate' => 'Beatmap ":title" wurde von :username nominiert.',
                'beatmapset_nominate_compact' => 'Beatmap wurde nominiert',
                'beatmapset_qualify' => '":title" hat genug Nominierungen erhalten und wurde in die Ranglisten-Warteschlange aufgenommen',
                'beatmapset_qualify_compact' => 'Beatmap wurde in die Ranglisten-Warteschlange aufgenommen',
                'beatmapset_rank' => '":title" wurde zur Rangliste erhoben',
                'beatmapset_rank_compact' => 'Beatmap wurde zur Rangliste erhoben',
                'beatmapset_reset_nominations' => 'Nominierung von ":title" wurde zurückgesetzt',
                'beatmapset_reset_nominations_compact' => 'Nominierung wurde zurückgesetzt',
            ],

            'comment' => [
                '_' => 'Neuer Kommentar',

                'comment_new' => ':username kommentierte ":content" auf ":title"',
                'comment_new_compact' => ':username kommentierte ":content"',
            ],
        ],

        'channel' => [
            '_' => 'Chat',

            'channel' => [
                '_' => 'Neue Mitteilung',
                'pm' => [
                    'channel_message' => ':username sagt ":title"',
                    'channel_message_compact' => ':title',
                    'channel_message_group' => 'von :username',
                ],
            ],
        ],

        'build' => [
            '_' => 'Änderungsprotokoll',

            'comment' => [
                '_' => 'Neuer Kommentar',

                'comment_new' => ':username kommentierte ":content" auf ":title"',
                'comment_new_compact' => ':username kommentierte ":content"',
            ],
        ],

        'news_post' => [
            '_' => 'Neuigkeiten',

            'comment' => [
                '_' => 'Neuer Kommentar',

                'comment_new' => ':username kommentierte ":content" auf ":title"',
                'comment_new_compact' => ':username kommentierte ":content"',
            ],
        ],

        'forum_topic' => [
            '_' => 'Forum Thema',

            'forum_topic_reply' => [
                '_' => 'Neue Foren-Antwort',
                'forum_topic_reply' => ':username antwortete auf ":title"',
                'forum_topic_reply_compact' => ':username antwortete',
            ],
        ],

        'legacy_pm' => [
            '_' => 'Alt-Forum PN',

            'legacy_pm' => [
                '_' => '',
                'legacy_pm' => ':count_delimited ungelesene Nachricht|:count_delimited ungelesene Nachrichten',
            ],
        ],

        'user_achievement' => [
            '_' => 'Medaillen',

            'user_achievement_unlock' => [
                '_' => 'Neue Medaille',
                'user_achievement_unlock' => '":title" freigeschaltet!',
                'user_achievement_unlock_compact' => '',
            ],
        ],
    ],
];

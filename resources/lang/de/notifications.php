<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'all_read' => 'Alle Benachrichtigungen gelesen!',
    'mark_read' => 'Lösche :type',
    'none' => 'Keine Benachrichtigungen',
    'see_all' => 'alle benachrichtigungen ansehen',

    'filters' => [
        '_' => 'alle',
        'user' => 'profil',
        'beatmapset' => 'beatmaps',
        'forum_topic' => 'forum',
        'news_post' => 'neuigkeiten',
        'build' => 'versionen',
        'channel' => 'chat',
    ],

    'item' => [
        'beatmapset' => [
            '_' => 'Beatmap',

            'beatmapset_discussion' => [
                '_' => 'Beatmap-Diskussion',
                'beatmapset_discussion_lock' => 'Die Diskussion der Beatmap ":title" wurde gesperrt.',
                'beatmapset_discussion_lock_compact' => 'Die Diskussion ist gesperrt',
                'beatmapset_discussion_post_new' => 'Neuer Beitrag auf ":title" von :username: ":content"',
                'beatmapset_discussion_post_new_empty' => 'Neuer Beitrag auf ":title" von :username',
                'beatmapset_discussion_post_new_compact' => 'Neuer Beitrag von :username: ":content"',
                'beatmapset_discussion_post_new_compact_empty' => 'Neuer Beitrag von :username',
                'beatmapset_discussion_review_new' => 'Neue Rezension zu ":title" von :username mit Problemen: :problems, Vorschlägen: :suggestions, Lob: :praises',
                'beatmapset_discussion_review_new_compact' => 'Neue Rezension von :username mit Problemen: :problems, Vorschlägen: :suggestions, Lob: :praises',
                'beatmapset_discussion_unlock' => 'Diskussion auf ":title" wurde freigegeben',
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
                '_' => 'Beatmap-Status geändert',
                'beatmapset_disqualify' => '":title" wurde disqualifiziert',
                'beatmapset_disqualify_compact' => 'Beatmap wurde disqualifiziert',
                'beatmapset_love' => '":title" hat loved-Status erlangt',
                'beatmapset_love_compact' => 'Beatmap hat loved-Status erlangt',
                'beatmapset_nominate' => '":title" wurde nominiert',
                'beatmapset_nominate_compact' => 'Beatmap wurde nominiert',
                'beatmapset_qualify' => '":title" hat genug Nominierungen erhalten und wurde in die Ranglisten-Warteschlange aufgenommen',
                'beatmapset_qualify_compact' => 'Beatmap wurde in die Ranglisten-Warteschlange aufgenommen',
                'beatmapset_rank' => '":title" wurde ranked',
                'beatmapset_rank_compact' => 'Beatmap wurde ranked',
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
            '_' => 'Forum-Thema',

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
                'user_achievement_unlock_compact' => '":title" freigeschaltet!',
            ],
        ],
    ],

    'mail' => [
        'beatmapset' => [
            'beatmapset_discussion' => 'Die Diskussion über ":title" hat neue Updates',
            'beatmapset_discussion_lock' => 'Die Diskussion über ":title" wurde gesperrt',
            'beatmapset_discussion_unlock' => 'Die Diskussion über ":title" wurde entsperrt',
            'beatmapset_problem' => 'Ein neues Problem wurde auf ":title" gemeldet',
            'beatmapset_state' => 'Der Status von ":title" hat sich geändert',
            'comment' => 'Beatmap ":title" hat neue Kommentare',
        ],

        'channel' => [
            'channel' => [
                'pm' => 'Du hast eine neue Nachricht von :username erhalten',
            ],
        ],

        'build' => [
            'comment' => 'Changelog ":title" hat neue Kommentare',
        ],

        'news_post' => [
            'comment' => 'Neuigkeit ":title" hat neue Kommentare',
        ],

        'forum_topic' => [
            'forum_topic_reply' => 'Es gibt neue Antworten in ":title"',
        ],

        'user_achievement' => [
            'user_achievement_unlock' => ':username hat eine neue Medaille freigeschaltet, ":title"!',
            'user_achievement_unlock_self' => 'Du hast eine neue Medaille freigeschaltet, ":title"!',
        ],
    ],
];

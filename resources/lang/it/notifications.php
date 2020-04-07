<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'all_read' => 'Lette tutte le notifiche!',
    'mark_read' => 'Svuota :type',
    'none' => 'Nessuna notifica',
    'see_all' => 'vedi tutte le notifiche',

    'filters' => [
        '_' => 'tutto',
        'user' => 'profilo',
        'beatmapset' => 'beatmap',
        'forum_topic' => 'forum',
        'news_post' => 'notizie',
        'build' => 'versioni',
        'channel' => 'chat',
    ],

    'item' => [
        'beatmapset' => [
            '_' => 'Beatmap',

            'beatmapset_discussion' => [
                '_' => 'Discussione beatmap',
                'beatmapset_discussion_lock' => 'La discussione su ":title" è stata bloccata',
                'beatmapset_discussion_lock_compact' => 'La discussione è stata bloccata',
                'beatmapset_discussion_post_new' => 'Nuovo post su ":title" da :username: ":content"',
                'beatmapset_discussion_post_new_empty' => 'Nuovo post su ":title" di :username',
                'beatmapset_discussion_post_new_compact' => 'Nuovo post da :username: ":content"',
                'beatmapset_discussion_post_new_compact_empty' => 'Nuovo post di :username',
                'beatmapset_discussion_unlock' => 'La discussione su ":title" è stata sbloccata',
                'beatmapset_discussion_unlock_compact' => 'La discussione è stata sbloccata',
            ],

            'beatmapset_problem' => [
                '_' => 'Problema con una beatmap qualificata',
                'beatmapset_discussion_qualified_problem' => 'Segnalato da :username su ":title": ":content"',
                'beatmapset_discussion_qualified_problem_empty' => 'Segnalato da :username su ":title"',
                'beatmapset_discussion_qualified_problem_compact' => 'Segnalato da :username: ":content"',
                'beatmapset_discussion_qualified_problem_compact_empty' => 'Segnalato da :username',
            ],

            'beatmapset_state' => [
                '_' => 'Lo stato della beatmap è stato modificato',
                'beatmapset_disqualify' => '":title" è stata squalificata',
                'beatmapset_disqualify_compact' => 'La beatmap è stata squalificata',
                'beatmapset_love' => '":title" è stata promossa tra le amate',
                'beatmapset_love_compact' => 'La beatmap è stata promossa tra le amate',
                'beatmapset_nominate' => '":title" è stata nominata',
                'beatmapset_nominate_compact' => 'La beatmap è stata nominata',
                'beatmapset_qualify' => '":title" ha ottenuto abbastanza nomine ed è entrata nella coda di classificazione',
                'beatmapset_qualify_compact' => 'La beatmap è entrata nella coda di classificazione',
                'beatmapset_rank' => '":title" è stata classificata',
                'beatmapset_rank_compact' => 'La beatmap è stata classificata',
                'beatmapset_reset_nominations' => 'La nomina di ":title" è stata reimpostata',
                'beatmapset_reset_nominations_compact' => 'La nomina è stata reimpostata',
            ],

            'comment' => [
                '_' => 'Nuovo commento',

                'comment_new' => ':username ha commentato ":content" su ":title"',
                'comment_new_compact' => ':username ha commentato ":content"',
            ],
        ],

        'channel' => [
            '_' => 'Chat',

            'channel' => [
                '_' => 'Nuovo messaggio',
                'pm' => [
                    'channel_message' => ':username ha scritto ":title"',
                    'channel_message_compact' => ':title',
                    'channel_message_group' => 'da :username',
                ],
            ],
        ],

        'build' => [
            '_' => 'Note di rilascio',

            'comment' => [
                '_' => 'Nuovo commento',

                'comment_new' => ':username ha commentato ":content" su ":title"',
                'comment_new_compact' => ':username ha commentato ":content"',
            ],
        ],

        'news_post' => [
            '_' => 'Notizie',

            'comment' => [
                '_' => 'Nuovo commento',

                'comment_new' => ':username ha commentato ":content" su ":title"',
                'comment_new_compact' => ':username ha commentato ":content"',
            ],
        ],

        'forum_topic' => [
            '_' => 'Topic del forum',

            'forum_topic_reply' => [
                '_' => 'Nuova risposta sul forum',
                'forum_topic_reply' => ':username ha risposto a ":title"',
                'forum_topic_reply_compact' => ':username ha risposto',
            ],
        ],

        'legacy_pm' => [
            '_' => 'PM forum legacy',

            'legacy_pm' => [
                '_' => '',
                'legacy_pm' => ':count_delimited messaggio non letto|:count_delimited messaggi non letti',
            ],
        ],

        'user_achievement' => [
            '_' => 'Medaglie',

            'user_achievement_unlock' => [
                '_' => 'Nuova medaglia',
                'user_achievement_unlock' => 'Sbloccato ":title"!',
                'user_achievement_unlock_compact' => 'Sbloccato ":title"!',
            ],
        ],
    ],
];

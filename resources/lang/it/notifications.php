<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'all_read' => 'Lette tutte le notifiche!',
    'delete' => 'Elimina :type',
    'loading' => 'Caricamento notifiche non lette...',
    'mark_read' => 'Segna :type come letto',
    'none' => 'Nessuna notifica',
    'see_all' => 'vedi tutte le notifiche',
    'see_channel' => 'vai alla chat',
    'verifying' => 'Verifica la sessione per visualizzare le notifiche',

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
                'beatmapset_discussion_review_new' => 'Nuova revisione su ":title" da :username contenente problemi: :problems, suggerimenti: :suggestions, elogi: :praises',
                'beatmapset_discussion_review_new_compact' => 'Nuova revisione da :username contenente problemi: :problems, suggerimenti: :suggestions, elogi: :praises',
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
                'beatmapset_qualify' => '":title" ha ottenuto abbastanza nomine ed è entrata nella coda di raking',
                'beatmapset_qualify_compact' => 'La beatmap è entrata nella coda di classificazione',
                'beatmapset_rank' => '":title" è stata classificata',
                'beatmapset_rank_compact' => 'La beatmap è stata classificata',
                'beatmapset_remove_from_loved' => '":title" è stato rimossa da Loved',
                'beatmapset_remove_from_loved_compact' => 'La beatmap è stata rimossa dalle amate',
                'beatmapset_reset_nominations' => 'La nomina di ":title" è stata reimpostata',
                'beatmapset_reset_nominations_compact' => 'La nomina è stata reimpostata',
            ],

            'comment' => [
                '_' => 'Nuovo commento',

                'comment_new' => ':username ha commentato ":content" su ":title"',
                'comment_new_compact' => ':username ha commentato ":content"',
                'comment_reply' => ':username ha risposto ":content" su ":title"',
                'comment_reply_compact' => ':username ha risposto ":content"',
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
                'comment_reply' => ':username ha risposto ":content" su ":title"',
                'comment_reply_compact' => ':username ha risposto ":content"',
            ],
        ],

        'news_post' => [
            '_' => 'Notizie',

            'comment' => [
                '_' => 'Nuovo commento',

                'comment_new' => ':username ha commentato ":content" su ":title"',
                'comment_new_compact' => ':username ha commentato ":content"',
                'comment_reply' => ':username ha risposto ":content" su ":title"',
                'comment_reply_compact' => ':username ha risposto ":content"',
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

        'user' => [
            'user_beatmapset_new' => [
                '_' => 'Nuova beatmap',

                'user_beatmapset_new' => 'Nuova beatmap ":title" di :username',
                'user_beatmapset_new_compact' => 'Nuova beatmap ":title"',
                'user_beatmapset_new_group' => 'Nuove beatmap di :username',
            ],
        ],

        'user_achievement' => [
            '_' => 'Medaglie',

            'user_achievement_unlock' => [
                '_' => 'Nuova medaglia',
                'user_achievement_unlock' => 'Sbloccato ":title"!',
                'user_achievement_unlock_compact' => 'Sbloccato ":title"!',
                'user_achievement_unlock_group' => 'Medaglie sbloccate!',
            ],
        ],
    ],

    'mail' => [
        'beatmapset' => [
            'beatmapset_discussion' => [
                'beatmapset_discussion_lock' => 'La discussione su ":title" è stata bloccata',
                'beatmapset_discussion_post_new' => 'La discussione su ":title" ha nuovi aggiornamenti',
                'beatmapset_discussion_unlock' => 'La discussione su ":title" è stata sbloccata',
            ],

            'beatmapset_problem' => [
                'beatmapset_discussion_qualified_problem' => 'Un nuovo problema è stato segnalato su ":title"',
            ],

            'beatmapset_state' => [
                'beatmapset_disqualify' => '":title" è stata squalificata',
                'beatmapset_love' => '":title" è stata promossa tra le amate',
                'beatmapset_nominate' => '":title" è stata nominata',
                'beatmapset_qualify' => '":title" ha ottenuto abbastanza nomine ed è entrata nella coda di ranking',
                'beatmapset_rank' => '":title" è stata rankata',
                'beatmapset_remove_from_loved' => '":title" è stata rimossa dalle amate',
                'beatmapset_reset_nominations' => 'La nomina di ":title" è stata resettata',
            ],

            'comment' => [
                'comment_new' => 'La beatmap ":title" ha nuovi commenti',
            ],
        ],

        'channel' => [
            'channel' => [
                'pm' => 'Hai ricevuto un nuovo messaggio da :username',
            ],
        ],

        'build' => [
            'comment' => [
                'comment_new' => 'La nota di rilascio ":title" ha nuovi commenti',
            ],
        ],

        'news_post' => [
            'comment' => [
                'comment_new' => 'La notizia ":title" ha nuovi commenti',
            ],
        ],

        'forum_topic' => [
            'forum_topic_reply' => [
                'forum_topic_reply' => 'Ci sono nuove risposte in ":title"',
            ],
        ],

        'user' => [
            'user_achievement_unlock' => [
                'user_achievement_unlock' => ':username ha sbloccato una nuova medaglia, ":title"!',
                'user_achievement_unlock_self' => 'Hai sbloccato una nuova medaglia, ":title"!',
            ],

            'user_beatmapset_new' => [
                'user_beatmapset_new' => ':username ha creato nuove beatmap',
            ],
        ],
    ],
];

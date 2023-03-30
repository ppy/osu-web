<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'all_read' => 'Toate notificările citite!',
    'delete' => 'Șterge :type',
    'loading' => 'Se încarcă notificările necitite...',
    'mark_read' => 'Curăță :type',
    'none' => 'Nicio notificare',
    'see_all' => 'vedeți toate notificările',
    'see_channel' => 'accesați chat-ul',
    'verifying' => 'Verificați sesiunea pentru a vizualiza notificările',

    'action_type' => [
        '_' => 'tot',
        'beatmapset' => 'beatmap-uri',
        'build' => 'versiuni',
        'channel' => 'chat',
        'forum_topic' => 'forum',
        'news_post' => 'știri',
        'user' => 'profil',
    ],

    'filters' => [
        '_' => 'tot',
        'user' => 'profil',
        'beatmapset' => 'beatmap-uri',
        'forum_topic' => 'forum',
        'news_post' => 'noutăți',
        'build' => 'versiuni',
        'channel' => 'chat',
    ],

    'item' => [
        'beatmapset' => [
            '_' => 'Beatmap',

            'beatmap_owner_change' => [
                '_' => 'Dificultate cu participare ca oaspete',
                'beatmap_owner_change' => 'Acum ești proprietarul dificultății ":beatmap" pentru beatmap-ul ":title"',
                'beatmap_owner_change_compact' => 'Acum ești proprietarul dificultății ":beatmap"',
            ],

            'beatmapset_discussion' => [
                '_' => 'Discuții beatmap',
                'beatmapset_discussion_lock' => 'Discuția pe ":title" a fost închisă',
                'beatmapset_discussion_lock_compact' => 'Discuția a fost închisă',
                'beatmapset_discussion_post_new' => 'Postare nouă pe ":title" de :username',
                'beatmapset_discussion_post_new_empty' => 'Postare nouă pe ":title" de :username',
                'beatmapset_discussion_post_new_compact' => 'Postare nouă de :username',
                'beatmapset_discussion_post_new_compact_empty' => 'Postare nouă de :username',
                'beatmapset_discussion_review_new' => 'Noua recenzie ":title" de :username care conține probleme: :problems, sugestii: :suggestions, laude: :praises',
                'beatmapset_discussion_review_new_compact' => 'Noua recenzie de :username care conține probleme: :problems, sugestii: :suggestions, laude: :praises',
                'beatmapset_discussion_unlock' => 'Discuția pe ":title" a fost redeschisă',
                'beatmapset_discussion_unlock_compact' => 'Discuția a fost redeschisă',
            ],

            'beatmapset_problem' => [
                '_' => 'Problemă de beatmap calificat',
                'beatmapset_discussion_qualified_problem' => 'Raportat de :username on ":title": ":content"',
                'beatmapset_discussion_qualified_problem_empty' => 'Raportat de :username pe ":title"',
                'beatmapset_discussion_qualified_problem_compact' => 'Raportat de :username: ":content"',
                'beatmapset_discussion_qualified_problem_compact_empty' => 'Raportat de :username',
            ],

            'beatmapset_state' => [
                '_' => 'Starea Beatmap-ului s-a schimbat',
                'beatmapset_disqualify' => ':title a fost descalificat',
                'beatmapset_disqualify_compact' => 'Beatmap-ul a fost descalificat',
                'beatmapset_love' => ':title a fost promovat la Iubit',
                'beatmapset_love_compact' => 'Beatmap-ul a fost promovat la Iubit',
                'beatmapset_nominate' => ':title a fost nominat',
                'beatmapset_nominate_compact' => 'Beatmap-ul a fost nominat',
                'beatmapset_qualify' => ':title a starns destule nominații si a intrat în ranking queue',
                'beatmapset_qualify_compact' => 'Beatmap-ul a intrat în ranking queue',
                'beatmapset_rank' => ':title a fost premiat',
                'beatmapset_rank_compact' => 'Beatmap-ul a fost premiat',
                'beatmapset_remove_from_loved' => '":title" a fost eliminat din Iubit',
                'beatmapset_remove_from_loved_compact' => 'Beatmap-ul a fost eliminat din Iubit',
                'beatmapset_reset_nominations' => 'Nominația ":title" a fost resetată',
                'beatmapset_reset_nominations_compact' => 'Nominația a fost resetată',
            ],

            'comment' => [
                '_' => 'Comentariu nou',

                'comment_new' => ':username a comentat ":content" la ":title"',
                'comment_new_compact' => ':username a comentat ":content"',
                'comment_reply' => ':username a răspuns ”:content” pe ”:title”',
                'comment_reply_compact' => ':username a răspuns ”:content”',
            ],
        ],

        'channel' => [
            '_' => 'Conversație',

            'announcement' => [
                '_' => 'Anunț nou',

                'announce' => [
                    'channel_announcement' => ':username spune ":title"',
                    'channel_announcement_compact' => ':title',
                    'channel_announcement_group' => 'Anunţ de la :username',
                ],
            ],

            'channel' => [
                '_' => 'Mesaj nou',

                'pm' => [
                    'channel_message' => ':username spune ":title"',
                    'channel_message_compact' => ':title',
                    'channel_message_group' => 'de la :username',
                ],
            ],
        ],

        'build' => [
            '_' => 'Istoric modificări',

            'comment' => [
                '_' => 'Comentariu nou',

                'comment_new' => ':username a comentat ":content" la ":title"',
                'comment_new_compact' => ':username a comentat ":content"',
                'comment_reply' => ':username a răspuns ”:content” pe ”:title”',
                'comment_reply_compact' => ':username a răspuns ”:content”',
            ],
        ],

        'news_post' => [
            '_' => 'Noutăți',

            'comment' => [
                '_' => 'Comentariu nou',

                'comment_new' => ':username a comentat ":content" la ":title"',
                'comment_new_compact' => ':username a comentat ":content"',
                'comment_reply' => ':username a răspuns ”:content” pe ”:title”',
                'comment_reply_compact' => ':username a răspuns ”:content”',
            ],
        ],

        'forum_topic' => [
            '_' => 'Subiect forum',

            'forum_topic_reply' => [
                '_' => 'Un nou răspuns pe forum',
                'forum_topic_reply' => ':username a răspuns la ":title"',
                'forum_topic_reply_compact' => ':username a răspuns',
            ],
        ],

        'legacy_pm' => [
            '_' => 'PM vechi forum',

            'legacy_pm' => [
                '_' => '',
                'legacy_pm' => 'un mesaj necitit|:count_delimited mesaje necitite|:count_delimited de mesaje necitite',
            ],
        ],

        'user' => [
            'user_beatmapset_new' => [
                '_' => 'Beatmap nou',

                'user_beatmapset_new' => 'Beatmap nou ":title" de către :username',
                'user_beatmapset_new_compact' => 'Beatmap nou ":title"',
                'user_beatmapset_new_group' => 'Beatmap-uri noi de către :username',

                'user_beatmapset_revive' => 'Beatmap-ul ":title" reînviat de către :username',
                'user_beatmapset_revive_compact' => 'Beatmap-ul ":title" reînviat',
            ],
        ],

        'user_achievement' => [
            '_' => 'Medalii',

            'user_achievement_unlock' => [
                '_' => 'Medalie nouă',
                'user_achievement_unlock' => 'Deblocat ":title"!',
                'user_achievement_unlock_compact' => 'Deblocat ":title"!',
                'user_achievement_unlock_group' => 'Medalii deblocate!',
            ],
        ],
    ],

    'mail' => [
        'beatmapset' => [
            'beatmap_owner_change' => [
                'beatmap_owner_change' => 'Ești acum un oaspete al beatmap-ului ":title"',
            ],

            'beatmapset_discussion' => [
                'beatmapset_discussion_lock' => 'Discuția pe ”:title” a fost încuiată',
                'beatmapset_discussion_post_new' => 'Discuția pe ”:title” are update-uri noi',
                'beatmapset_discussion_unlock' => 'Discuția pe ”:title” a fost redeschisă',
            ],

            'beatmapset_problem' => [
                'beatmapset_discussion_qualified_problem' => 'O nouă problem a fost raportată pe ”:title”',
            ],

            'beatmapset_state' => [
                'beatmapset_disqualify' => '”:title” a fost descalificat',
                'beatmapset_love' => '”:title” a fost promovată la Iubit',
                'beatmapset_nominate' => '”:title” a fost nominat',
                'beatmapset_qualify' => '”:title” a primit suficiente nominații și a intrat în lista de așteptare pentru clasament',
                'beatmapset_rank' => '”:title” a fost clasat',
                'beatmapset_remove_from_loved' => '":title" a fost eliminat din Iubit',
                'beatmapset_reset_nominations' => 'Nominația ”:title” a fost resetată',
            ],

            'comment' => [
                'comment_new' => 'Beatmap-ul ”:title” are noi comentarii',
            ],
        ],

        'channel' => [
            'announcement' => [
                'announce' => 'Există un anunț nou în „:name”',
            ],

            'channel' => [
                'pm' => 'Ai primit un mesaj nou de la :username',
            ],
        ],

        'build' => [
            'comment' => [
                'comment_new' => 'Istoricul schimbărilor ":title" are comentarii noi',
            ],
        ],

        'news_post' => [
            'comment' => [
                'comment_new' => 'Noutățile ”:title” au noi comentarii',
            ],
        ],

        'forum_topic' => [
            'forum_topic_reply' => [
                'forum_topic_reply' => 'Există răspunsuri noi în ":title"',
            ],
        ],

        'user' => [
            'user_achievement_unlock' => [
                'user_achievement_unlock' => ':username a deblocat o nouă medalie, ":title"!',
                'user_achievement_unlock_self' => 'Ați deblocat o nouă medalie, ":title"!',
            ],

            'user_beatmapset_new' => [
                'user_beatmapset_new' => ':username a creat beatmap-uri noi',
                'user_beatmapset_revive' => ':username a reînviat beatmap-uri',
            ],
        ],
    ],
];

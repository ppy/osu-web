<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'all_read' => 'Všetky upozornenia prečítané!',
    'delete' => 'Vymazať :type',
    'loading' => 'Načítavanie neprečítaných notifikácií...',
    'mark_read' => 'Vyčistiť :type',
    'none' => 'Žiadne upozornenia',
    'see_all' => 'zobraziť všetky upozornenia',
    'see_channel' => 'prejsť ku konverzáciám',
    'verifying' => 'Prosím verifikuj reláciu na zobrazenie oznámení',

    'action_type' => [
        '_' => 'všetko',
        'beatmapset' => 'beatmapy',
        'build' => 'verzie',
        'channel' => 'chat',
        'forum_topic' => 'fórum',
        'news_post' => 'novinky',
        'team' => 'tím',
        'user' => 'profil',
    ],

    'filters' => [
        '_' => 'všetko',
        'beatmapset' => 'beatmapy',
        'build' => 'verzie',
        'channel' => 'konverzácie',
        'forum_topic' => 'fórum',
        'news_post' => 'novinky',
        'team' => 'tím',
        'user' => 'profil',
    ],

    'item' => [
        'beatmapset' => [
            '_' => 'Beatmapa',

            'beatmap_owner_change' => [
                '_' => 'Obtiažnosť hosťa',
                'beatmap_owner_change' => 'Stali ste sa majiteľom obtiažnosti ":beatmap" pre beatmapu ":title"',
                'beatmap_owner_change_compact' => 'Stali ste sa majiteľom obtiažnosti ":beatmap"',
            ],

            'beatmapset_discussion' => [
                '_' => 'Diskusia o beatmape',
                'beatmapset_discussion_lock' => 'Diskusia o ":title" bola uzamknutá',
                'beatmapset_discussion_lock_compact' => 'Diskusia bola uzamknutá',
                'beatmapset_discussion_post_new' => '',
                'beatmapset_discussion_post_new_empty' => '',
                'beatmapset_discussion_post_new_compact' => '',
                'beatmapset_discussion_post_new_compact_empty' => '',
                'beatmapset_discussion_review_new' => '',
                'beatmapset_discussion_review_new_compact' => '',
                'beatmapset_discussion_unlock' => '',
                'beatmapset_discussion_unlock_compact' => '',

                'review_count' => [
                    'praises' => '',
                    'problems' => '',
                    'suggestions' => '',
                ],
            ],

            'beatmapset_problem' => [
                '_' => '',
                'beatmapset_discussion_qualified_problem' => '',
                'beatmapset_discussion_qualified_problem_empty' => '',
                'beatmapset_discussion_qualified_problem_compact' => '',
                'beatmapset_discussion_qualified_problem_compact_empty' => '',
            ],

            'beatmapset_state' => [
                '_' => '',
                'beatmapset_disqualify' => '',
                'beatmapset_disqualify_compact' => '',
                'beatmapset_love' => '',
                'beatmapset_love_compact' => '',
                'beatmapset_nominate' => '',
                'beatmapset_nominate_compact' => '',
                'beatmapset_qualify' => '',
                'beatmapset_qualify_compact' => '',
                'beatmapset_rank' => '',
                'beatmapset_rank_compact' => '',
                'beatmapset_remove_from_loved' => '',
                'beatmapset_remove_from_loved_compact' => '',
                'beatmapset_reset_nominations' => '',
                'beatmapset_reset_nominations_compact' => '',
            ],

            'comment' => [
                '_' => '',

                'comment_new' => '',
                'comment_new_compact' => '',
                'comment_reply' => '',
                'comment_reply_compact' => '',
            ],
        ],

        'channel' => [
            '_' => 'Konverzácia',

            'announcement' => [
                '_' => '',

                'announce' => [
                    'channel_announcement' => '',
                    'channel_announcement_compact' => ':title',
                    'channel_announcement_group' => '',
                ],
            ],

            'channel' => [
                '_' => 'Nová správa',

                'pm' => [
                    'channel_message' => ':username píše ":title"',
                    'channel_message_compact' => ':title',
                    'channel_message_group' => 'od :username',
                ],
            ],

            'channel_mention' => [
                '_' => 'Spomienka v chate',

                'public' => [
                    'channel_mention' => ':username ťa spomenul v :name ":title"',
                    'channel_mention_compact' => ':username ":title"',
                    'channel_mention_group' => 'spomenutý v :name',
                ],
            ],

            'channel_team' => [
                '_' => 'Nová tímová správa',

                'team' => [
                    'channel_team' => ':username píše ":title"',
                    'channel_team_compact' => ':username píše ":title"',
                    'channel_team_group' => ':username píše ":title"',
                ],
            ],
        ],

        'build' => [
            '_' => 'Zoznam zmien',

            'comment' => [
                '_' => 'Nový komentár',

                'comment_new' => '',
                'comment_new_compact' => '',
                'comment_reply' => '',
                'comment_reply_compact' => '',
            ],
        ],

        'news_post' => [
            '_' => 'Novinky',

            'comment' => [
                '_' => 'Nový komentár',

                'comment_new' => '',
                'comment_new_compact' => '',
                'comment_reply' => '',
                'comment_reply_compact' => '',
            ],

            'news_post' => [
                '_' => '',

                'news_post_new' => '',
                'news_post_new_compact' => '',
            ],
        ],

        'forum_topic' => [
            '_' => '',

            'forum_topic_reply' => [
                '_' => '',
                'forum_topic_reply' => '',
                'forum_topic_reply_compact' => '',
            ],
        ],

        'team' => [
            'team_application' => [
                '_' => '',

                'team_application_accept' => "",
                'team_application_accept_compact' => "",

                'team_application_group' => '',

                'team_application_reject' => '',
                'team_application_reject_compact' => '',
                'team_application_store' => '',
                'team_application_store_compact' => '',
            ],
        ],

        'user' => [
            'user_beatmapset_new' => [
                '_' => '',

                'user_beatmapset_new' => '',
                'user_beatmapset_new_compact' => '',
                'user_beatmapset_new_group' => '',

                'user_beatmapset_revive' => '',
                'user_beatmapset_revive_compact' => '',
            ],
        ],

        'user_achievement' => [
            '_' => 'Medaile',

            'user_achievement_unlock' => [
                '_' => 'Nová medaila',
                'user_achievement_unlock' => '',
                'user_achievement_unlock_compact' => '',
                'user_achievement_unlock_group' => '',
            ],
        ],
    ],

    'mail' => [
        'news' => '',

        'beatmapset' => [
            'beatmap_owner_change' => [
                'beatmap_owner_change' => '',
            ],

            'beatmapset_discussion' => [
                'beatmapset_discussion_lock' => '',
                'beatmapset_discussion_post_new' => 'Diskusia o ":title" má nové aktualizácie',
                'beatmapset_discussion_unlock' => 'Diskusia o ":title" bola odomknutá',
            ],

            'beatmapset_problem' => [
                'beatmapset_discussion_qualified_problem' => 'Bol nahlásený nový problém na ":title"',
            ],

            'beatmapset_state' => [
                'beatmapset_disqualify' => '":title" bola diskvalifikovaná',
                'beatmapset_love' => '":title" bola povýšená na milovanú',
                'beatmapset_nominate' => '":title" bola nominovaná',
                'beatmapset_qualify' => '":title" dostala dostatok nominácií a vstúpila do radu na hodnotenie',
                'beatmapset_rank' => '":title" bola hodnotená',
                'beatmapset_remove_from_loved' => '":title" bola odstránená z milovaných',
                'beatmapset_reset_nominations' => 'Nominácia ":title" bola obnovená',
            ],

            'comment' => [
                'comment_new' => 'Beatmapa ":title" má nové komentáre',
            ],
        ],

        'channel' => [
            'announcement' => [
                'channel_announcement' => 'Nový oznam v ":name"',
            ],
            'channel' => [
                'channel_message' => 'Dostal si novú správu od ":username"',
            ],
            'channel_mention' => [
                'channel_mention' => ':username ťa spomenul v :name ":title"',
            ],

            'channel_team' => [
                'channel_team' => 'Nová správa v tíme ":name"',
            ],
        ],

        'build' => [
            'comment' => [
                'comment_new' => 'Zoznam zmien ":title" má nové komentáre',
            ],
        ],

        'news_post' => [
            'comment' => [
                'comment_new' => 'Novinky ":title" majú nové komentáre',
            ],
        ],

        'forum_topic' => [
            'forum_topic_reply' => [
                'forum_topic_reply' => 'Nové odpovede v ":title"',
            ],
        ],

        'team' => [
            'team_application' => [
                'team_application_accept' => "Od teraz si členom tímu :title",
                'team_application_reject' => 'Tvoja žiadosť o pripojenie do tímu :title bola zamietnutá',
                'team_application_store' => ':title požiadal o pripojenie do tvojho tímu',
            ],
        ],

        'user' => [
            'user_beatmapset_new' => [
                'user_beatmapset_new' => ':username vytvoril nové beatmapy',
                'user_beatmapset_revive' => ':username oživil beatmapy',
            ],
        ],
    ],
];

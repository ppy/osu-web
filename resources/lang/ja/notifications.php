<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'all_read' => '通知は全て既読となりました！',
    'mark_read' => '消去 :type',
    'none' => '通知なし',
    'see_all' => 'すべての通知を見る',

    'filters' => [
        '_' => '全て',
        'user' => 'プロフィール',
        'beatmapset' => 'ビートマップ',
        'forum_topic' => 'フォーラム',
        'news_post' => 'お知らせ',
        'build' => 'ビルド',
        'channel' => 'チャット',
    ],

    'item' => [
        'beatmapset' => [
            '_' => 'ビートマップ',

            'beatmapset_discussion' => [
                '_' => 'ビートマップディスカッション',
                'beatmapset_discussion_lock' => 'ビートマップ「:title」ディスカッションのためにロックされています。',
                'beatmapset_discussion_lock_compact' => 'ディスカッションはロックされています。',
                'beatmapset_discussion_post_new' => ':usernameがビートマップディスカッション「:title」に新しいメッセージを投稿しました。',
                'beatmapset_discussion_post_new_empty' => ':username による「:title」への新しい投稿',
                'beatmapset_discussion_post_new_compact' => ':username による新しい投稿: 「:content」',
                'beatmapset_discussion_post_new_compact_empty' => ':username による新しい投稿',
                'beatmapset_discussion_review_new' => ':usernameが「:title」で問題：:problems、提案：:suggestions、称賛：:praisesを含む新しいレビューを投稿しました。',
                'beatmapset_discussion_review_new_compact' => ':usernameが問題：:problems、提案：:suggestions、称賛：:praisesを含む新しいレビューを投稿しました。',
                'beatmapset_discussion_unlock' => 'ビートマップ「:title」ディスカッションのためにロック解除されました。',
                'beatmapset_discussion_unlock_compact' => 'ディスカッションはアンロックされました。',
            ],

            'beatmapset_problem' => [
                '_' => 'Qualifiedビートマップの問題',
                'beatmapset_discussion_qualified_problem' => ':username による「:title」への報告：「:content」',
                'beatmapset_discussion_qualified_problem_empty' => ':usernameによる「:title」への報告',
                'beatmapset_discussion_qualified_problem_compact' => ':username による報告：「:content」',
                'beatmapset_discussion_qualified_problem_compact_empty' => ':username による報告',
            ],

            'beatmapset_state' => [
                '_' => 'ビートマップのステータスが変更されました',
                'beatmapset_disqualify' => 'ビートマップ「:title」は:usernameによってdisqualifyされました。',
                'beatmapset_disqualify_compact' => 'ビートマップはdisqualifiedになりました。',
                'beatmapset_love' => '「:title」は:usernameによってLovedされているとして宣伝されました。',
                'beatmapset_love_compact' => 'ビートマップはLovedされているとして宣伝されました。',
                'beatmapset_nominate' => '「:title」は:usernameによってノミネートされました。',
                'beatmapset_nominate_compact' => 'ビートマップがノミネートされました。',
                'beatmapset_qualify' => '「:title」は十分なノミネートを受けたのでランキングに入れられました。',
                'beatmapset_qualify_compact' => 'ビートマップがランキングのキューに入りました',
                'beatmapset_rank' => '「:title」はrankedされました。',
                'beatmapset_rank_compact' => 'ビートマップがrankedされました。',
                'beatmapset_reset_nominations' => ':usernameの問題点投稿によりビートマップ「:title」のノミネーションがリセットされました。 ',
                'beatmapset_reset_nominations_compact' => 'ノミネーションがリセットされました。',
            ],

            'comment' => [
                '_' => '新しいコメント',

                'comment_new' => ':usernameが「:title」でコメント「:content」',
                'comment_new_compact' => ':usernameがコメント「:content」',
                'comment_reply' => '',
                'comment_reply_compact' => '',
            ],
        ],

        'channel' => [
            '_' => 'チャット',

            'channel' => [
                '_' => '新しいメッセージ',
                'pm' => [
                    'channel_message' => ':usernameが「:title」で発言',
                    'channel_message_compact' => ':title',
                    'channel_message_group' => ':username より',
                ],
            ],
        ],

        'build' => [
            '_' => '更新履歴',

            'comment' => [
                '_' => '新しいコメント',

                'comment_new' => ':usernameが「:title」でコメント「:content」',
                'comment_new_compact' => ':usernameがコメント「:content」',
                'comment_reply' => '',
                'comment_reply_compact' => '',
            ],
        ],

        'news_post' => [
            '_' => 'ニュース',

            'comment' => [
                '_' => '新しいコメント',

                'comment_new' => ':usernameが「:title」でコメント「:content」',
                'comment_new_compact' => ':usernameがコメント「:content」',
                'comment_reply' => '',
                'comment_reply_compact' => '',
            ],
        ],

        'forum_topic' => [
            '_' => 'フォーラムトピック',

            'forum_topic_reply' => [
                '_' => '新しいフォーラムの返信',
                'forum_topic_reply' => ':usernameがフォーラムトピック「:title」に返信しました。',
                'forum_topic_reply_compact' => ':username の返信',
            ],
        ],

        'legacy_pm' => [
            '_' => 'レガシーフォーラムPM',

            'legacy_pm' => [
                '_' => '',
                'legacy_pm' => ':count_delimited個の未読メッセージ',
            ],
        ],

        'user_achievement' => [
            '_' => 'メダル',

            'user_achievement_unlock' => [
                '_' => '新しいメダル',
                'user_achievement_unlock' => ':title をアンロック！',
                'user_achievement_unlock_compact' => ':title をアンロック！',
            ],
        ],
    ],

    'mail' => [
        'beatmapset' => [
            'beatmapset_discussion' => [
                'beatmapset_discussion_lock' => '',
                'beatmapset_discussion_post_new' => '',
                'beatmapset_discussion_unlock' => '',
            ],

            'beatmapset_problem' => [
                'beatmapset_discussion_qualified_problem' => '',
            ],

            'beatmapset_state' => [
                'beatmapset_disqualify' => '',
                'beatmapset_love' => '',
                'beatmapset_nominate' => '',
                'beatmapset_qualify' => '',
                'beatmapset_rank' => '',
                'beatmapset_reset_nominations' => '',
            ],

            'comment' => [
                'comment_new' => '',
            ],
        ],

        'channel' => [
            'channel' => [
                'pm' => '',
            ],
        ],

        'build' => [
            'comment' => [
                'comment_new' => '',
            ],
        ],

        'news_post' => [
            'comment' => [
                'comment_new' => '',
            ],
        ],

        'forum_topic' => [
            'forum_topic_reply' => [
                'forum_topic_reply' => '',
            ],
        ],

        'user' => [
            'user_achievement_unlock' => [
                'user_achievement_unlock' => '',
                'user_achievement_unlock_self' => '',
            ],
        ],
    ],
];

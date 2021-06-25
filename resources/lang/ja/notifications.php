<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'all_read' => '通知を全て既読にする！',
    'delete' => ':type を削除',
    'loading' => '未読通知を読み込み中...',
    'mark_read' => '消去 :type',
    'none' => '通知なし',
    'see_all' => 'すべての通知を見る',
    'see_channel' => 'チャットに行く',
    'verifying' => '通知を表示するには、セッションを確認してください。',

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

            'beatmap_owner_change' => [
                '_' => 'ゲスト難易度',
                'beatmap_owner_change' => 'ビートマップ":title"の難易度":beatmap"の所有者になりました',
                'beatmap_owner_change_compact' => '難易度":beatmap”の所有者になりました',
            ],

            'beatmapset_discussion' => [
                '_' => 'ビートマップディスカッション',
                'beatmapset_discussion_lock' => 'ビートマップ「:title」ディスカッションのためにロックされています。',
                'beatmapset_discussion_lock_compact' => 'ディスカッションはロックされています。',
                'beatmapset_discussion_post_new' => ':usernameがビートマップディスカッション「:title」に新しいメッセージを投稿しました。',
                'beatmapset_discussion_post_new_empty' => ':username による「:title」への新しい投稿',
                'beatmapset_discussion_post_new_compact' => ':username による新しい投稿: 「:content」',
                'beatmapset_discussion_post_new_compact_empty' => ':username による新しい投稿',
                'beatmapset_discussion_review_new' => ':usernameが「:title」に問題：:problems、提案：:suggestions、称賛：:praisesを含む、新しいレビューを投稿しました。',
                'beatmapset_discussion_review_new_compact' => ':usernameが問題：:problems、提案：:suggestions、称賛：:praisesを含む、新しいレビューを投稿しました。',
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
                'beatmapset_remove_from_loved' => '「:title」はlovedから削除されました',
                'beatmapset_remove_from_loved_compact' => 'ビートマップはlovedから削除されました',
                'beatmapset_reset_nominations' => ':usernameの問題点投稿によりビートマップ「:title」のノミネーションがリセットされました。 ',
                'beatmapset_reset_nominations_compact' => 'ノミネーションがリセットされました。',
            ],

            'comment' => [
                '_' => '新しいコメント',

                'comment_new' => ':usernameが「:title」でコメント「:content」',
                'comment_new_compact' => ':usernameがコメント「:content」',
                'comment_reply' => ':usernameが「:title」に「:content」を返信しました',
                'comment_reply_compact' => ':usernameが「:content」に返信しました',
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
                'comment_reply' => ':usernameが「:title」に「:content」を返信しました',
                'comment_reply_compact' => ':usernameが「:content」に返信しました',
            ],
        ],

        'news_post' => [
            '_' => 'ニュース',

            'comment' => [
                '_' => '新しいコメント',

                'comment_new' => ':usernameが「:title」でコメント「:content」',
                'comment_new_compact' => ':usernameがコメント「:content」',
                'comment_reply' => ':usernameが「:title」に「:content」を返信しました',
                'comment_reply_compact' => ':usernameが「:content」に返信しました',
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

        'user' => [
            'user_beatmapset_new' => [
                '_' => '新しいビートマップ',

                'user_beatmapset_new' => ':username による新しいビートマップ「:title」',
                'user_beatmapset_new_compact' => '新しいビートマップ「:title」',
                'user_beatmapset_new_group' => ':username の新しいビートマップ',
            ],
        ],

        'user_achievement' => [
            '_' => 'メダル',

            'user_achievement_unlock' => [
                '_' => '新しいメダル',
                'user_achievement_unlock' => ':title をアンロック！',
                'user_achievement_unlock_compact' => ':title をアンロック！',
                'user_achievement_unlock_group' => 'メダルのロックが解除されました！',
            ],
        ],
    ],

    'mail' => [
        'beatmapset' => [
            'beatmap_owner_change' => [
                'beatmap_owner_change' => 'ビートマップ":title"のゲストになりました',
            ],

            'beatmapset_discussion' => [
                'beatmapset_discussion_lock' => 'ディスカッション「:title」はロックされています',
                'beatmapset_discussion_post_new' => 'ディスカッション「:title」に新しい更新があります',
                'beatmapset_discussion_unlock' => 'ディスカッション「:title」のロックが解除されました',
            ],

            'beatmapset_problem' => [
                'beatmapset_discussion_qualified_problem' => '新しい問題が「:title」で報告されました',
            ],

            'beatmapset_state' => [
                'beatmapset_disqualify' => '「:title」はdisqualifyされました',
                'beatmapset_love' => '「:title」はlovedになりました',
                'beatmapset_nominate' => '「:title」はノミネートされました',
                'beatmapset_qualify' => '「:title」は十分なノミネートを獲得し、ランキングキューに入りました',
                'beatmapset_rank' => '「:title」はrankedされました',
                'beatmapset_remove_from_loved' => '「:title」はlovedから削除されました',
                'beatmapset_reset_nominations' => '「:title」のノミネーションがリセットされました',
            ],

            'comment' => [
                'comment_new' => 'ビートマップ「:title」に新しいコメントがあります',
            ],
        ],

        'channel' => [
            'channel' => [
                'pm' => ':usernameから新しいメッセージを受信しました',
            ],
        ],

        'build' => [
            'comment' => [
                'comment_new' => '更新履歴「:title」に新しいコメントがあります',
            ],
        ],

        'news_post' => [
            'comment' => [
                'comment_new' => 'ニュース「:title」に新しいコメントがあります',
            ],
        ],

        'forum_topic' => [
            'forum_topic_reply' => [
                'forum_topic_reply' => '「:title」に新しい返信があります',
            ],
        ],

        'user' => [
            'user_achievement_unlock' => [
                'user_achievement_unlock' => ':usernameが新しいメダル「:title」をアンロックしました！',
                'user_achievement_unlock_self' => '新しいメダル「:title」をアンロックしました！',
            ],

            'user_beatmapset_new' => [
                'user_beatmapset_new' => ':usernameがビートマップを作成しました',
            ],
        ],
    ],
];

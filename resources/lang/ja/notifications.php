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
    'all_read' => '全ての通知を読む！',
    'mark_all_read' => '全て消去',
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
            '_' => 'ビートマップ',

            'beatmapset_discussion' => [
                '_' => 'ビートマップディスカッション',
                'beatmapset_discussion_lock' => 'ビートマップ":title"ディスカッションのためにロックされています。',
                'beatmapset_discussion_lock_compact' => 'ディスカッションはロックされています。',
                'beatmapset_discussion_post_new' => ':usernameがビートマップディスカッション":title"に新しいメッセージを投稿しました。',
                'beatmapset_discussion_post_new_empty' => ':username による「:title」への新しい投稿',
                'beatmapset_discussion_post_new_compact' => ':username による新しい投稿',
                'beatmapset_discussion_post_new_compact_empty' => ':username による新しい投稿',
                'beatmapset_discussion_unlock' => 'ビートマップ":title"ディスカッションのためにロック解除されました。',
                'beatmapset_discussion_unlock_compact' => 'ディスカッションはアンロックされました。',
            ],

            'beatmapset_problem' => [
                '_' => 'Qualifiedビートマップの問題',
                'beatmapset_discussion_qualified_problem' => ':username による「:title」への報告： :content',
                'beatmapset_discussion_qualified_problem_empty' => ':usernameによる「:title」への報告',
                'beatmapset_discussion_qualified_problem_compact' => ':username による報告： :content',
                'beatmapset_discussion_qualified_problem_compact_empty' => ':username による報告',
            ],

            'beatmapset_state' => [
                '_' => 'ビートマップのステータスが変更されました',
                'beatmapset_disqualify' => 'ビートマップ":title"は:usernameによってdisqualifyされました。',
                'beatmapset_disqualify_compact' => 'ビートマップはdisqualifiedになりました。',
                'beatmapset_love' => '":title"は:usernameによってLovedされているとして宣伝されました。',
                'beatmapset_love_compact' => 'ビートマップはLovedされているとして宣伝されました。',
                'beatmapset_nominate' => '":title"は:usernameによってノミネートされました。',
                'beatmapset_nominate_compact' => 'ビートマップがノミネートされました。',
                'beatmapset_qualify' => '":title"は十分なノミネートを受けたのでランキングに入れられました。',
                'beatmapset_qualify_compact' => 'ビートマップがランキングのキューに入りました',
                'beatmapset_rank' => '":title"はrankedされました。',
                'beatmapset_rank_compact' => 'ビートマップがrankedされました。',
                'beatmapset_reset_nominations' => ':usernameの問題点投稿によりビートマップ":title"のノミネーションがリセットされました。 ',
                'beatmapset_reset_nominations_compact' => 'ノミネーションがリセットされました。',
            ],

            'comment' => [
                '_' => '新しいコメント',

                'comment_new' => ':usernameが":title"でコメント":content"',
                'comment_new_compact' => ':usernameがコメント":content"',
            ],
        ],

        'channel' => [
            '_' => 'チャット',

            'channel' => [
                '_' => '新しいメッセージ',
                'pm' => [
                    'channel_message' => ':usernameが":title"で発言',
                    'channel_message_compact' => ':title',
                    'channel_message_group' => ':username より',
                ],
            ],
        ],

        'build' => [
            '_' => 'チェンジログ',

            'comment' => [
                '_' => '新しいコメント',

                'comment_new' => ':usernameが":title"でコメント":content"',
                'comment_new_compact' => ':usernameがコメント":content"',
            ],
        ],

        'news_post' => [
            '_' => 'ニュース',

            'comment' => [
                '_' => '新しいコメント',

                'comment_new' => ':usernameが":title"でコメント":content"',
                'comment_new_compact' => ':usernameがコメント":content"',
            ],
        ],

        'forum_topic' => [
            '_' => 'フォーラムトピック',

            'forum_topic_reply' => [
                '_' => '新しいフォーラムの返信',
                'forum_topic_reply' => ':usernameがフォーラムトピック":title"に返信しました。',
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
                'user_achievement_unlock_compact' => '',
            ],
        ],
    ],
];

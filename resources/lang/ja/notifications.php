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
    'message_multi' => '":title"に:count_delimited個の新しいアップデート',

    'item' => [
        'beatmapset' => [
            '_' => 'ビートマップ',

            'beatmapset_discussion' => [
                '_' => 'ビートマップディスカッション',
                'beatmapset_discussion_lock' => 'ビートマップ":title"ディスカッションのためにロックされています。',
                'beatmapset_discussion_post_new' => ':usernameがビートマップディスカッション":title"に新しいメッセージを投稿しました。',
                'beatmapset_discussion_unlock' => 'ビートマップ":title"ディスカッションのためにロック解除されました。',
            ],

            'beatmapset_state' => [
                '_' => 'ビートマップのステータスが変更されました',
                'beatmapset_disqualify' => 'ビートマップ":title"は:usernameによってdisqualifyされました。',
                'beatmapset_love' => 'ビートマップ":title"は:usernameによってLovedされているとして宣伝されました。',
                'beatmapset_nominate' => 'ビートマップ":title"は:usernameによってノミネートされました。',
                'beatmapset_qualify' => 'ビートマップ":title"は十分なノミネートを受けたのでランキングに入れられました。',
                'beatmapset_reset_nominations' => ':usernameの問題点投稿によりビートマップ":title"のノミネーションがリセットされました。 ',
            ],
        ],

        'forum_topic' => [
            '_' => 'フォーラムトピック',

            'forum_topic_reply' => [
                '_' => '新しいフォーラムの返信',
                'forum_topic_reply' => ':usernameがフォーラムトピック":title"に返信しました。',
            ],
        ],

        'legacy_pm' => [
            '_' => 'レガシーフォーラムPM',

            'legacy_pm' => [
                '_' => '',
                'legacy_pm' => ':count_delimited個の未読メッセージ',
            ],
        ],
    ],
];

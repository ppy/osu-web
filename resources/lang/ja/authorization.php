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
    'beatmap_discussion' => [
        'destroy' => [
            'is_hype' => 'hypeは取り消し不可能です。',
            'has_reply' => '返信の付いているディスカッションは削除できません。',
        ],
        'nominate' => [
            'exhausted' => '一日のノミネーションの上限に達しました。後日お試しください。',
            'incorrect_state' => '実行中にエラーが発生しました。ページを更新してください。',
            'owner' => "自分の譜面をノミネートすることはできません。",
        ],
        'resolve' => [
            'not_owner' => 'スレッド作者と譜面作者にのみディスカッションは解決できます。',
        ],

        'store' => [
            'mapper_note_wrong_user' => 'ビートマップの所有者か、管理者/QATグループのメンバーのみマッパーノートに投稿できます。',
        ],

        'vote' => [
            'limit_exceeded' => '再度評価するには少し間を置いてください。',
            'owner' => "自分のディスカッションは評価できません。",
            'wrong_beatmapset_state' => '保留中のビートマップはディスカッションでのみ評価できます。',
        ],
    ],

    'beatmap_discussion_post' => [
        'edit' => [
            'system_generated' => '自動生成された投稿は編集できません。',
            'not_owner' => '投稿者のみ編集できます。',
        ],
    ],

    'chat' => [
        'blocked' => 'あなたをブロックしているユーザーまたは、あなたがブロックしているユーザーとはメッセージはやり取りできません。',
        'friends_only' => 'ユーザーはフレンドリストにいない人からのメッセージをブロックしています。',
        'moderated' => 'そのチャンネルは現在管理されています。',
        'no_access' => 'あなたはそのチャンネルにアクセスするための権限を持っていません。',
        'restricted' => 'あなたがbanされている間はメッセージを送信できません。',
    ],

    'comment' => [
        'update' => [
            'deleted' => "削除済みの投稿は編集できません。",
        ],
    ],

    'contest' => [
        'voting_over' => 'コンテストの投票期間終了後に投票を変更することはできません。',
    ],

    'forum' => [
        'moderate' => [
            'no_permission' => 'このフォーラムを管理する権限がありません。',
        ],

        'post' => [
            'delete' => [
                'only_last_post' => '最新の投稿のみ削除できます。',
                'locked' => 'ロックされたトピックの投稿は削除できません。',
                'no_forum_access' => '要求されたチャンネルへのアクセスが必要です。',
                'not_owner' => '投稿を削除できるのは投稿者のみです。',
            ],

            'edit' => [
                'deleted' => '削除済みの投稿は編集できません。',
                'locked' => 'この投稿はロックされているので編集できません。',
                'no_forum_access' => '要求されたチャンネルへのアクセスが必要です。',
                'not_owner' => '投稿を編集できるのは投稿者のみです。',
                'topic_locked' => 'ロックされたトピックの投稿は編集できません。',
            ],

            'store' => [
                'play_more' => 'フォーラムに投稿をする前にゲームのプレイをお願いします。プレイする上で問題が発生した場合、Helpフォーラムにお問い合わせください。',
                'too_many_help_posts' => "続けて投稿する為に必要とされているプレイ回数を満たしていません。問題が発生していてプレイができない場合、support@ppy.sh宛てにEメールでお問い合わせください。", // FIXME: unhardcode email address.
            ],
        ],

        'topic' => [
            'reply' => [
                'double_post' => '再投稿の代わりに最後の投稿を編集してください。',
                'locked' => 'ロックされたスレッドには返信できません。',
                'no_forum_access' => '要求されたチャンネルへのアクセスが必要です。',
                'no_permission' => '返信する権限がありません。',

                'user' => [
                    'require_login' => '返信するにはサインインが必要です。',
                    'restricted' => "制限中は返信できません。",
                    'silenced' => "サイレンス中は返信できません。",
                ],
            ],

            'store' => [
                'no_forum_access' => '要求されたチャンネルへのアクセスが必要です。',
                'no_permission' => 'トピックの新規作成が許可されていません。',
                'forum_closed' => 'フォーラムは閉鎖されています。投稿できません。',
            ],

            'vote' => [
                'no_forum_access' => '要求されたチャンネルへのアクセスが必要です。',
                'over' => '投票期間は既に終了しています。',
                'voted' => '投票の変更は許可されていません。',

                'user' => [
                    'require_login' => '投票するにはサインインが必要です。',
                    'restricted' => "制限中は投票できません。",
                    'silenced' => "サイレンス中は投票できません。",
                ],
            ],

            'watch' => [
                'no_forum_access' => '要求されたチャンネルへのアクセスが必要です。',
            ],
        ],

        'topic_cover' => [
            'edit' => [
                'uneditable' => '指定のカバー画像は無効です。',
                'not_owner' => '投稿者のみカバー画像を変更できます。',
            ],
        ],

        'view' => [
            'admin_only' => '管理人にのみこのフォーラムは閲覧可能です。',
        ],
    ],

    'require_login' => '続行するにはログインが必要です。',

    'unauthorized' => 'アクセスが拒否されました。',

    'silenced' => "サイレンス中には不可能です。",

    'restricted' => "制限中には不可能です。",

    'user' => [
        'page' => [
            'edit' => [
                'locked' => 'ユーザーページはロックされています。',
                'not_owner' => '自分のユーザーページのみ編集できます。',
                'require_supporter_tag' => 'サポータータグが必要です。',
            ],
        ],
    ],
];

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
    'require_login' => '続行するにはログインが必要です。',
    'require_verification' => '続行して確認してください。',
    'restricted' => "制限中には不可能です。",
    'silenced' => "サイレンス中には不可能です。",
    'unauthorized' => 'アクセスが拒否されました。',

    'beatmap_discussion' => [
        'destroy' => [
            'is_hype' => 'hypeは取り消し不可能です。',
            'has_reply' => '返信の付いているディスカッションは削除できません。',
        ],
        'nominate' => [
            'exhausted' => '一日のノミネーションの上限に達しました。後日お試しください。',
            'full_bn_required' => 'qualifyノミネーションを行うには完全なノミネーターでなければなりません。',
            'full_bn_required_hybrid' => 'ビートマップセットを複数のゲームモードでノミネートするには、完全なノミネーターでなければなりません。',
            'incorrect_state' => '実行中にエラーが発生しました。ページを更新してください。',
            'owner' => "自分のビートマップをノミネートすることはできません。",
        ],
        'resolve' => [
            'not_owner' => 'スレッド作者とビートマップの所有者のみがディスカッションを解決できます。',
        ],

        'store' => [
            'mapper_note_wrong_user' => 'ビートマップの所有者か、ノミネーター/QATグループのメンバーのみマッパーノートに投稿できます。',
        ],

        'vote' => [
            'limit_exceeded' => '再度評価するには少し間を置いてください。',
            'owner' => "自分のディスカッションは評価できません。",
            'wrong_beatmapset_state' => 'Pendingビートマップはディスカッションでのみ評価できます。',
        ],
    ],

    'beatmap_discussion_post' => [
        'destroy' => [
            'not_owner' => '自分の投稿のみを削除できます。',
            'resolved' => '解決済みのディスカッションを削除することはできません。',
            'system_generated' => '自動生成された投稿は削除できません。',
        ],

        'edit' => [
            'not_owner' => '投稿者のみ編集できます。',
            'resolved' => '解決済みのディスカッションを編集することはできません。',
            'system_generated' => '自動生成された投稿は編集できません。',
        ],

        'store' => [
            'beatmapset_locked' => 'このビートマップはディスカッションのためにロックされています。',
        ],
    ],

    'chat' => [
        'blocked' => 'あなたをブロックしているユーザーまたは、あなたがブロックしているユーザーとはメッセージをやり取りできません。',
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
        'voting_over' => 'コンテストの投票期間終了後に投票先を変更することはできません。',
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
                'play_more' => 'フォーラムに投稿をする前にゲームのプレイをしてください。プレイする上で問題が発生した場合、ヘルプとサポートフォーラムに問い合わせて下さい。',
                'too_many_help_posts' => "追加投稿をするためにはもっとゲームをプレイする必要があります。問題が発生していてプレイができない場合、support@ppy.shにメールしてください。", // FIXME: unhardcode email address.
            ],
        ],

        'topic' => [
            'reply' => [
                'double_post' => '再投稿の代わりに最後の投稿を編集してください。',
                'locked' => 'ロックされたスレッドには返信できません。',
                'no_forum_access' => '要求されたチャンネルへのアクセスが必要です。',
                'no_permission' => '返信する権限がありません。',

                'user' => [
                    'require_login' => '返信するにはログインが必要です。',
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
                'play_more' => 'あなたはフォーラムに投票する前にもっとプレイする必要があります。',
                'voted' => '投票先の変更は許可されていません。',

                'user' => [
                    'require_login' => '投票するにはログインが必要です。',
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
            'store' => [
                'forum_not_allowed' => 'このフォーラムはトピックカバーが許可されていません。',
            ],
        ],

        'view' => [
            'admin_only' => '管理人のみがこのフォーラムは閲覧可能です。',
        ],
    ],

    'user' => [
        'page' => [
            'edit' => [
                'locked' => 'ユーザーページはロックされています。',
                'not_owner' => '自分のユーザーページのみ編集できます。',
                'require_supporter_tag' => 'osu!サポータータグが必要です。',
            ],
        ],
    ],
];

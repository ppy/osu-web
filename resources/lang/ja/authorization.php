<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'play_more' => '代わりにosu!で遊んでみてはどうですか？',
    'require_login' => '続行するにはログインが必要です。',
    'require_verification' => '続行するには認証が必要です。',
    'restricted' => "制限されている間は実行できません。",
    'silenced' => "サイレンス中は実行できません。",
    'unauthorized' => 'アクセスが拒否されました。',

    'beatmap_discussion' => [
        'destroy' => [
            'is_hype' => 'hypeは取り消し不可能です。',
            'has_reply' => '返信の付いているディスカッションは削除できません。',
        ],
        'nominate' => [
            'exhausted' => '一日のノミネーションの上限に達しました。明日もう一度お試しください。',
            'incorrect_state' => '実行中にエラーが発生しました。ページを更新してください。',
            'owner' => "自分のビートマップをノミネートすることはできません。",
            'set_metadata' => 'ノミネートする前にジャンルと言語を設定する必要があります。',
        ],
        'resolve' => [
            'not_owner' => 'スレッド作者とビートマップの所有者のみがディスカッションを解決できます。',
        ],

        'store' => [
            'mapper_note_wrong_user' => 'ビートマップの所有者か、ノミネーター/NATグループのメンバーのみマッパーノートに投稿できます。',
        ],

        'vote' => [
            'bot' => "ボットによるディスカッションに投票できません",
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

    'beatmapset' => [
        'metadata' => [
            'nominated' => 'ノミネートされたビートマップのメタデータを変更することはできません。正しく設定されていないと思われる場合は、BNまたはNATのメンバーに問い合わせてください。',
        ],
    ],

    'chat' => [
        'blocked' => 'あなたをブロックしているユーザーまたは、あなたがブロックしているユーザーとはメッセージをやり取りできません。',
        'friends_only' => 'ユーザーはフレンドリストにいない人からのメッセージをブロックしています。',
        'moderated' => 'そのチャンネルは現在制限がかかっています。',
        'no_access' => 'あなたはそのチャンネルにアクセスするための権限を持っていません。',
        'restricted' => 'あなたがサイレンス、制限またはBanされている間はメッセージを送信できません。',
        'silenced' => 'あなたがサイレンス、制限またはBanされている間はメッセージを送信できません。',
    ],

    'comment' => [
        'update' => [
            'deleted' => "削除済みの投稿は編集できません。",
        ],
    ],

    'contest' => [
        'voting_over' => 'コンテストの投票期間終了後に投票先を変更することはできません。',

        'entry' => [
            'limit_reached' => 'このコンテストへのエントリー上限に達しました。',
            'over' => 'エントリーありがとうございます！このコンテストへの応募は終了し、投票がまもなく開始されます。',
        ],
    ],

    'forum' => [
        'moderate' => [
            'no_permission' => 'このフォーラムに制限をかける権限がありません。',
        ],

        'post' => [
            'delete' => [
                'only_last_post' => '最後の投稿のみ削除できます。',
                'locked' => 'ロックされたトピックの投稿は削除できません。',
                'no_forum_access' => '要求されたフォーラムへのアクセスが必要です。',
                'not_owner' => '投稿を削除できるのは投稿者のみです。',
            ],

            'edit' => [
                'deleted' => '削除された投稿は編集できません。',
                'locked' => 'この投稿はロックされているので編集できません。',
                'no_forum_access' => '要求されたフォーラムへのアクセスが必要です。',
                'not_owner' => '投稿を編集できるのは投稿者のみです。',
                'topic_locked' => 'ロックされたトピックの投稿は編集できません。',
            ],

            'store' => [
                'play_more' => 'フォーラムに投稿をする前にゲームのプレイをお願いします。プレイする上で問題が発生した場合、Helpフォーラムにお問い合わせください。',
                'too_many_help_posts' => "追加投稿をするためにはもっとゲームをプレイする必要があります。問題が発生していてプレイができない場合、support@ppy.shにメールしてください。", // FIXME: unhardcode email address.
            ],
        ],

        'topic' => [
            'reply' => [
                'double_post' => '再投稿の代わりに最後に行った投稿を編集してください。',
                'locked' => 'ロックされたスレッドには返信できません。',
                'no_forum_access' => '要求されたフォーラムへのアクセスが必要です。',
                'no_permission' => '返信する権限がありません。',

                'user' => [
                    'require_login' => '返信するにはログインが必要です。',
                    'restricted' => "制限されている間は返信できません。",
                    'silenced' => "サイレンス中は返信できません。",
                ],
            ],

            'store' => [
                'no_forum_access' => '要求されたフォーラムへのアクセスが必要です。',
                'no_permission' => 'トピックの新規作成が許可されていません。',
                'forum_closed' => 'フォーラムは閉鎖されています。投稿できません。',
            ],

            'vote' => [
                'no_forum_access' => '要求されたフォーラムへのアクセスが必要です。',
                'over' => '投票期間は既に終了しています。',
                'play_more' => 'あなたはフォーラムに投票する前にもっとプレイする必要があります。',
                'voted' => '投票先の変更は許可されていません。',

                'user' => [
                    'require_login' => '投票するにはログインが必要です。',
                    'restricted' => "制限されている間は投票できません。",
                    'silenced' => "サイレンス中は投票できません。",
                ],
            ],

            'watch' => [
                'no_forum_access' => '要求されたフォーラムへのアクセスが必要です。',
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
            'admin_only' => 'このフォーラムは管理人のみ閲覧可能です。',
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

<?php

/**
 *    Copyright 2015-2017 ppy Pty. Ltd.
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
            'has_reply' => 'Can not delete discussion with replies',
        ],
        'nominate' => [
            'exhausted' => 'You have reached your nomination limit for the day, please try again tomorrow.',
        ],
        'resolve' => [
            'not_owner' => 'Only thread starter and beatmap owner can resolve a discussion.',
        ],

        'vote' => [
            'limit_exceeded' => 'Please wait a while before casting more votes',
            'owner' => 'Can not vote own discussion!',
        ],
    ],

    'beatmap_discussion_post' => [
        'edit' => [
            'system_generated' => '自動生成された投稿は編集できません。',
            'not_owner' => '投稿者のみが編集できます。',
        ],
    ],

    'chat' => [
        'channel' => [
            'read' => [
                'no_access' => '指定のチャンネルへのアクセスが許可されていません。',
            ],
        ],
        'message' => [
            'send' => [
                'channel' => [
                    'no_access' => '指定のチャンネルへのアクセス許可が必要です。',
                    'moderated' => 'チャンネルはmoderated状態です。',
                    'not_lazer' => '現在#lazerでしか発言できません。',
                ],

                'not_allowed' => '規制・サイレンス中にメッセージは送信できません。',
            ],
        ],
    ],

    'contest' => [
        'voting_over' => '投票期間が終了した後に投票の変更はできません。',
    ],

    'forum' => [
        'post' => [
            'delete' => [
                'only_last_post' => '最新の投稿のみ削除できます。',
                'locked' => 'ロックされたトピックの投稿は削除できません。',
                'no_forum_access' => '指定のフォーラムへのアクセス許可が必要です。',
                'not_owner' => '投稿者のみが削除できます。',
            ],

            'edit' => [
                'deleted' => '削除された投稿は編集できません。',
                'locked' => 'この投稿は編集禁止になっています。',
                'no_forum_access' => '指定のフォーラムへのアクセス許可が必要です。',
                'not_owner' => '投稿者のみが削除できます。',
                'topic_locked' => 'ロックされたトピックの投稿は編集できません。',
            ],
        ],

        'topic' => [
            'reply' => [
                'double_post' => '投稿直後に再度投稿はできません。少し時間を置いてからもう一度お試しください。',
                'locked' => 'ロックされたスレッドに投稿はできません。',
                'no_forum_access' => '指定のフォーラムへのアクセス許可が必要です。',
                'no_permission' => '返信が許可されていません。',

                'user' => [
                    'require_login' => '返信するにはログインしてください。',
                    'restricted' => "規制中には返信できません。",
                    'silenced' => "サイレンス中には返信できません。",
                ],
            ],

            'store' => [
                'no_forum_access' => '指定のフォーラムへのアクセス許可が必要です。',
                'no_permission' => '新規のトピックを作成する許可がありません。',
                'forum_closed' => 'フォーラムが閉鎖されています。投稿できません。',
            ],

            'vote' => [
                'no_forum_access' => '指定のフォーラムへのアクセス許可が必要です。',
                'over' => '投票期間は終了しています。',
                'voted' => '投票の変更は許可されていません。',

                'user' => [
                    'require_login' => '投票するにはログインしてください。',
                    'restricted' => "規制中には投票できません。",
                    'silenced' => "サイレンス中には投票できません。",
                ],
            ],

            'watch' => [
                'no_forum_access' => '指定のフォーラムへのアクセス許可が必要です。',
            ],
        ],

        'topic_cover' => [
            'edit' => [
                'uneditable' => 'Invalid cover specified.',
                'not_owner' => 'Only owner can edit cover.',
            ],
        ],

        'view' => [
            'admin_only' => 'adminのみ閲覧できます。',
        ],
    ],

    'require_login' => '続行するにはログインしてください。',

    'unauthorized' => 'アクセスが拒否されました。',

    'silenced' => "サイレンス中には許可されていません。",

    'restricted' => "規制中には許可されていません。",

    'user' => [
        'page' => [
            'edit' => [
                'locked' => 'ユーザーページはロックされています。',
                'not_owner' => '本人のみが編集できます。',
                'require_supporter_tag' => 'サポータータグが必要です。',
            ],
        ],
    ],
];

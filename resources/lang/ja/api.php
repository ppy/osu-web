<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'error' => [
        'chat' => [
            'empty' => '空のメッセージを送信できません。',
            'limit_exceeded' => 'メッセージの送信頻度が高すぎます。時間を置いてもう一度試してください。',
            'too_long' => '送信しようとしてるメッセージが長すぎます。',
        ],
    ],

    'scopes' => [
        'bot' => 'チャットボットとして機能します。',
        'identify' => 'あなたを識別し、一般公開プロフィールを読み取ります。',

        'chat' => [
            'write' => 'あなたの代わりにメッセージを送信します。',
        ],

        'forum' => [
            'write' => '代わりにフォーラムのトピックと投稿を作成し編集します。',
        ],

        'friends' => [
            'read' => 'フォローしている人を見る。',
        ],

        'public' => '公開されているデータを代わりに読み取る。',
    ],
];

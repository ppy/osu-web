<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'talking_in' => ':channelで会話中',
    'talking_with' => ':nameと会話中',
    'title_compact' => 'チャット',

    'cannot_send' => [
        'channel' => '現在このチャンネルでメッセージを送信できません。次の理由のいずれかである可能性があります：',
        'user' => '現在このユーザーへメッセージを送信できません。理由は次のいずれかである可能性があります：',
        'reasons' => [
            'blocked' => 'あなたは受信者にブロックされました',
            'channel_moderated' => 'このチャンネルは制限がかかっています。',
            'friends_only' => 'フレンドリスト上の人からのメッセージのみ受信する',
            'not_enough_plays' => '十分にゲームをプレイしていません',
            'not_verified' => 'セッションが確認されていません',
            'restricted' => 'あなたは現在制限されています',
            'silenced' => '現在サイレンス中です',
            'target_restricted' => '受信者は現在制限されています',
        ],
    ],
    'input' => [
        'disabled' => 'メッセージの送信ができません...',
        'disconnected' => '',
        'placeholder' => 'メッセージを入力...',
        'send' => '送信',
    ],
    'no-conversations' => [
        'howto' => "ユーザープロフィールまたはユーザーカードのポップアップから会話を開始します。",
        'lazer' => 'あなたが<a href=":link">osu!lazer</a>で参加している公開チャンネルもここに表示されます。',
        'title' => 'まだトークはありません',
    ],
];

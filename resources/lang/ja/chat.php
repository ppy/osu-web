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
    'limitation_notice' => '注意：<a href=":lazer_link">osu!lazer</a>または新しいウェブサイトを利用している人だけが、このシステムを使ってPMを受け取れます。<br/>もし嫌な場合は、<a href=":oldpm_link">旧サイト</a>からメッセージを送信して下さい。',
    'talking_in' => ':channelで会話中',
    'talking_with' => ':nameと会話中',
    'title_compact' => 'チャット',

    'cannot_send' => [
        'channel' => '現在このチャンネルでメッセージを送信できません。次の理由のいずれかである可能性があります：',
        'user' => '現在このユーザーへメッセージを送信できません。理由は次のいずれかである可能性があります：',
        'reasons' => [
            'blocked' => 'あなたは受信者にブロックされました',
            'channel_moderated' => 'このチャンネルは管理されています',
            'friends_only' => 'フレンドリスト上の人からのメッセージのみ受信する',
            'restricted' => 'あなたは現在制限されています',
            'target_restricted' => '受信者は現在制限されています',
        ],
    ],
    'input' => [
        'disabled' => 'メッセージの送信ができません...',
        'placeholder' => 'メッセージを入力',
        'send' => '送信',
    ],
    'no-conversations' => [
        'howto' => "ユーザープロフィールまたはユーザーカードのポップアップから会話を開始します。",
        'lazer' => 'あなたが<a href=":link">osu!lazer</a>で参加している公開チャンネルもここに表示されます。',
        'pm_limitations' => '<a href=":link">osu!lazer</a>または新しいウェブサイトを利用している人だけがPMを受信できます。',
        'title' => 'まだトークはありません',
    ],
];

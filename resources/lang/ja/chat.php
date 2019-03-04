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
    'coming_soon' => '近日公開',
    'limitation_notice' => '注: <a href=":lazer_link">osu!lazer</a>または新しいウェブサイトでこのシステムを使ってPMを受け取れるようになります。<br/>もしご希望でない場合は、<a href=":oldpm_link">旧サイト</a>からメッセージが送信可能です。',
    'talking_in' => ':channel で会話中',
    'talking_with' => ':name と会話中',
    'title_compact' => 'チャット',
    'title' => 'チャット',
    'cannot_send' => [
        'channel' => '現在このチャンネルでメッセージを送信できません。次の理由のいずれかが原因として考えられます:',
        'user' => '現在このユーザーへのメッセージを送信できません。次の理由のいずれかが原因として考えられます:',
        'reasons' => [
            'blocked' => '送信者によってブロックされました',
            'channel_moderated' => 'このチャンネルは管理されています',
            'friends_only' => '自分のフレンドリスト上の人からのみメッセージを受信する',
            'restricted' => '現在制限されています',
            'target_restricted' => '受信者は現在制限されています',
        ],
    ],
    'input' => [
        'disabled' => 'メッセージの送信ができません...',
        'placeholder' => 'メッセージを入力...',
        'send' => '送信',
    ],
    'no-conversations' => [
        'howto' => "ユーザープロフィールまたはポップアップユーザーカードから会話を開始",
        'lazer' => 'あなたが参加している公開チャンネル<a href=":link">osu!lazer</a>もここに表示されます。',
        'pm_limitations' => '<a href=":link">osu!lazer</a>または新しいウェブサイトを利用している人がPMを受信します。',
        'title' => 'まだトークはありません',
    ],
];

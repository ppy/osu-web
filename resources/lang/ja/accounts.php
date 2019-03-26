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
    'edit' => [
        'title' => '<strong>アカウント</strong>設定',
        'title_compact' => '設定',
        'username' => 'ユーザー名',

        'avatar' => [
            'title' => 'プロフィール画像',
        ],

        'email' => [
            'current' => '現在のメールアドレス',
            'new' => '新しいメールアドレス',
            'new_confirmation' => '新しいメールアドレス（再入力）',
            'title' => 'メールアドレス',
        ],

        'password' => [
            'current' => '現在のパスワード',
            'new' => '新しいパスワード',
            'new_confirmation' => '新しいパスワード（再入力）',
            'title' => 'パスワード',
        ],

        'profile' => [
            'title' => 'プロフィール',

            'user' => [
                'user_from' => '現在地',
                'user_interests' => '趣味',
                'user_msnm' => 'skype',
                'user_occ' => '職業',
                'user_twitter' => 'twitter',
                'user_website' => 'ウェブサイト',
                'user_discord' => 'discord',
            ],
        ],

        'signature' => [
            'title' => '署名',
            'update' => '適用',
        ],
    ],

    'update_email' => [
        'email_subject' => 'osu! メールアドレス変更の確認',
        'update' => '更新',
    ],

    'update_password' => [
        'email_subject' => 'osu!パスワード変更の確認',
        'update' => '更新',
    ],

    'playstyles' => [
        'title' => 'プレイスタイル',
        'mouse' => 'マウス',
        'keyboard' => 'キーボード',
        'tablet' => 'ペンタブ',
        'touch' => 'タッチスクリーン',
    ],

    'privacy' => [
        'title' => 'プライバシー',
        'friends_only' => 'フレンドリストにいない人からのプライベートメッセージをブロックする',
        'hide_online' => 'オンライン状態を隠す',
    ],

    'security' => [
        'current_session' => '現在',
        'end_session' => 'セッション終了',
        'end_session_confirmation' => 'これによりこのデバイスでのセッションが終了します。本当によろしいですか?',
        'last_active' => '最終ログイン：',
        'title' => 'セキュリティ',
        'web_sessions' => 'webセッション',
    ],
];

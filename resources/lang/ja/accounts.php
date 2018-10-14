<?php

/**
 *    Copyright 2015-2018 ppy Pty. Ltd.
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
            'current' => '現在のEメール',
            'new' => '新しいEメール',
            'new_confirmation' => 'Eメールの確認',
            'title' => 'Eメール',
        ],

        'password' => [
            'current' => '現在のパスワード',
            'new' => '新しいパスワード',
            'new_confirmation' => 'パスワードの確認',
            'title' => 'パスワード',
        ],

        'profile' => [
            'title' => 'プロフィールの編集',

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
        'email_subject' => 'osu!Eメール変更の確認',
        'update' => '適用',
    ],

    'update_password' => [
        'email_subject' => 'osu!パスワード変更の確認',
        'update' => '適用',
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
        'friends_only' => '友達リストにいない人からプライベートメッセージをブロックする',
    ],
];

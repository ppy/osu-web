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
        'title_compact' => '設定',
        'username' => 'ユーザー名',

        'avatar' => [
            'title' => 'プロフィール画像',
            'rules' => 'あなたのプロフィール画像が公序良俗に反したもので無いか確認してください。 :link.<br/>易しく言えば<strong>全ての年齢に適した</strong>、つまりヌードや冒涜的な表現などを想起させるものを含んでいない事を確認してください。',
            'rules_link' => 'コミュニティールール',
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
                'user_discord' => 'discord',
                'user_from' => '現在地',
                'user_interests' => '趣味',
                'user_msnm' => 'skype',
                'user_occ' => '職業',
                'user_twitter' => 'twitter',
                'user_website' => 'ウェブサイト',
            ],
        ],

        'signature' => [
            'title' => '署名',
            'update' => '更新',
        ],
    ],

    'notifications' => [
        'title' => '通知',
        'topic_auto_subscribe' => '作成した新しいフォーラムトピックに関する通知を自動的に有効にします',
        'beatmapset_discussion_qualified_problem' => '次のモードのQualifiedビートマップで新しい問題の通知を受け取る',

        'mail' => [
            '_' => '次のメール通知を受け取る：',
            'beatmapset:modding' => 'ビートマップmodding',
            'forum_topic_reply' => 'トピックの返信',
        ],
    ],

    'oauth' => [
        'authorized_clients' => '認証済みのクライアント',
        'own_clients' => '自分のクライアント',
        'title' => 'OAuth',
    ],

    'playstyles' => [
        'keyboard' => 'キーボード',
        'mouse' => 'マウス',
        'tablet' => 'ペンタブ',
        'title' => 'プレイスタイル',
        'touch' => 'タッチスクリーン',
    ],

    'privacy' => [
        'friends_only' => 'フレンドリストにいない人からのプライベートメッセージをブロックする',
        'hide_online' => 'オンライン状態を隠す',
        'title' => 'プライバシー',
    ],

    'security' => [
        'current_session' => '現在',
        'end_session' => 'セッション終了',
        'end_session_confirmation' => 'このデバイスでのセッションが終了します。本当によろしいですか？',
        'last_active' => '最終ログイン：',
        'title' => 'セキュリティ',
        'web_sessions' => 'webセッション',
    ],

    'update_email' => [
        'update' => '更新',
    ],

    'update_password' => [
        'update' => '更新',
    ],

    'verification_completed' => [
        'text' => '今すぐにこのウィンドウを閉じる事が出来ます。',
        'title' => '認証が完了しました。',
    ],

    'verification_invalid' => [
        'title' => '無効もしくは期限切れの認証リンク',
    ],
];

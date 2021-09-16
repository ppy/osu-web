<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'invalid' => '無効な :attribute が指定されています。',
    'not_negative' => ':attributeに負の数は使用できません',
    'required' => ':attributeが必須です',
    'too_long' => ':attributeの使用文字数の制限を超えています。上限は:limit文字です。',
    'wrong_confirmation' => '認証が一致しません。',

    'beatmapset_discussion' => [
        'beatmap_missing' => 'タイムスタンプは指定されていますが、ビートマップの難易度が不足しています。',
        'beatmapset_no_hype' => "このビートマップはHypeできません。",
        'hype_requires_null_beatmap' => 'Hypeは一般（全ての難易度）セクションで行ってください。',
        'invalid_beatmap_id' => '無効な難易度が指定されました。',
        'invalid_beatmapset_id' => '無効なビートマップが指定されました。',
        'locked' => 'ディスカッションはロックされています。',

        'attributes' => [
            'message_type' => 'メッセージの種類',
            'timestamp' => 'タイムスタンプ',
        ],

        'hype' => [
            'discussion_locked' => "このビートマップは議論中のためロックされており、Hypeできません。",
            'guest' => 'Hypeするにはログインが必要です。',
            'hyped' => '既にこのビートマップをHypeしています。',
            'limit_exceeded' => 'Hype回数が残っていません。',
            'not_hypeable' => 'このビートマップはHypeできません。',
            'owner' => '自分のビートマップはHypeできません。',
        ],

        'timestamp' => [
            'exceeds_beatmapset_length' => '指定されたタイムスタンプはビートマップの長さの範囲に存在しません。',
            'negative' => "タイムスタンプは負の数が使えません。",
        ],
    ],

    'beatmapset_discussion_post' => [
        'discussion_locked' => 'ディスカッションはロックされています。',
        'first_post' => '最初の投稿は削除できません。',

        'attributes' => [
            'message' => 'メッセージ',
        ],
    ],

    'comment' => [
        'deleted_parent' => '削除されたコメントに返信することはできません。',
        'top_only' => 'コメントの返信を固定することはできません。
',

        'attributes' => [
            'message' => 'メッセージ',
        ],
    ],

    'follow' => [
        'invalid' => '無効な :attribute が指定されています。',
    ],

    'forum' => [
        'feature_vote' => [
            'not_feature_topic' => '機能リクエスト以外は投票できません。',
            'not_enough_feature_votes' => '残りの投票回数が足りません',
        ],

        'poll_vote' => [
            'invalid' => '無効の選択肢が指定されています。',
        ],

        'post' => [
            'beatmapset_post_no_delete' => 'ビートマップのメタデータ投稿を削除することは許可されていません。',
            'beatmapset_post_no_edit' => 'ビートマップのメタデータ投稿を編集することは許可されていません。',
            'first_post_no_delete' => '最初の投稿は削除できません',
            'missing_topic' => 'トピックがありません。',
            'only_quote' => 'あなたの返信には引用しかありません。',

            'attributes' => [
                'post_text' => '本文を送信',
            ],
        ],

        'topic' => [
            'attributes' => [
                'topic_title' => 'タイトル',
            ],
        ],

        'topic_poll' => [
            'duplicate_options' => '選択肢の重複があります。',
            'grace_period_expired' => ':limit時間以上後に投票を編集できません。',
            'hiding_results_forever' => '投票期限が設定されていない投票の結果を隠すことはできません。',
            'invalid_max_options' => '選択数の上限に選択肢の数以上の数値は使用不可能です。',
            'minimum_one_selection' => '選択数は１が最低の数値です。',
            'minimum_two_options' => '選択肢は最低2つ必要です。',
            'too_many_options' => '選択肢の数が多すぎます。',

            'attributes' => [
                'title' => '投票タイトル',
            ],
        ],

        'topic_vote' => [
            'required' => '投票する選択肢を選んでください。',
            'too_many' => '許可されている選択肢より多くを選択しました。',
        ],
    ],

    'oauth' => [
        'client' => [
            'too_many' => '許可されるOAuthアプリケーションの最大数を超えました。',
            'url' => '有効なURLを入力してください。',

            'attributes' => [
                'name' => 'アプリケーション名',
                'redirect' => 'アプリケーションコールバックURL',
            ],
        ],
    ],

    'user' => [
        'contains_username' => 'ユーザー名を含んだパスワードは使用できません。',
        'email_already_used' => '既に使用されているメールアドレスです。',
        'email_not_allowed' => 'メールアドレスが許可されていません。',
        'invalid_country' => 'データベースに存在しない国です。',
        'invalid_discord' => 'Discordのユーザー名が無効です。',
        'invalid_email' => "無効なメールアドレスです。",
        'invalid_twitter' => 'Twitterのユーザー名が無効です。',
        'too_short' => '新しいパスワードが短すぎます。',
        'unknown_duplicate' => 'ユーザー名かメールアドレスが既に使用されています。',
        'username_available_in' => 'このユーザー名は:durationで使用可能になります。',
        'username_available_soon' => 'このユーザー名はまもなく使用可能になります。',
        'username_invalid_characters' => '指定のユーザー名に無効の文字が含まれています。',
        'username_in_use' => '既に使用されているユーザー名です！',
        'username_locked' => '既に使用されているユーザー名です！', // TODO: language for this should be slightly different.
        'username_no_space_userscore_mix' => 'アンダーバーかスペースのどちらかに統一してください。',
        'username_no_spaces' => "ユーザー名の端にスペースは使用できません。",
        'username_not_allowed' => 'このユーザー名の使用は許可されていません。',
        'username_too_short' => 'ユーザー名が短すぎます。',
        'username_too_long' => 'ユーザー名が長すぎます。',
        'weak' => 'ブラックリストに載っているパスワードです。',
        'wrong_current_password' => 'パスワードが間違っています。',
        'wrong_email_confirmation' => 'メールアドレスが一致しません。',
        'wrong_password_confirmation' => 'パスワードが一致しません。',
        'too_long' => '使用文字数の制限を超えています。上限は:limit文字です。',

        'attributes' => [
            'username' => 'ユーザー名',
            'user_email' => 'メールアドレス',
            'password' => 'パスワード',
        ],

        'change_username' => [
            'restricted' => '制限されている間は、ユーザー名を変更することはできません。',
            'supporter_required' => [
                '_' => ':linkになったことがないと名前を変更できません！',
                'link_text' => 'サポーター',
            ],
            'username_is_same' => '既に使用しているユーザー名です！',
        ],
    ],

    'user_report' => [
        'reason_not_valid' => ':reason はこのテレポートタイプでは無効です。',
        'self' => "自分自身を報告することはできません！",
    ],

    'store' => [
        'order_item' => [
            'attributes' => [
                'quantity' => '個数',
                'cost' => '価格',
            ],
        ],
    ],
];

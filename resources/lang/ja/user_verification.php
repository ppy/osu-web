<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'box' => [
        'sent' => ':mailに認証コードが含まれるメールが送信されました。実行するには認証コードを入力してください。',
        'title' => 'アカウント認証',
        'verifying' => '認証中・・・',
        'issuing' => '新しいコードを生成中...',

        'info' => [
            'check_spam' => "もしメールが届かない場合は迷惑メールフォルダを確認してください。",
            'recover' => "メールアドレスにアクセスできない場合や使用したメールアドレスを忘れた場合はこちらから復元を試して下さい。:link",
            'recover_link' => 'メールアドレスの復元',
            'reissue' => 'コードの:reissue_linkや:logout_linkもできます。',
            'reissue_link' => '認証コードの再発行',
            'logout_link' => 'ログアウト',
        ],
    ],

    'box_totp' => [
        'heading' => '認証アプリのコードを入力してください。',

        'info' => [
            'logout' => [
                '_' => ':link することもできます。',
                'link' => 'ログアウト',
            ],
            'mail_fallback' => [
                '_' => 'アプリにアクセスできない場合は、:link。',
                'link' => '代わりにメールで認証を行えます',
            ],
        ],
    ],

    'errors' => [
        'expired' => '認証コードの期限が切れています。新しい認証コードがメールアドレスに送信されました。',
        'incorrect_key' => '認証コードが正しくありません。',
        'retries_exceeded' => '認証コードが正しくありません。試行回数の制限を超えたので、新しい認証コードがメールアドレスに送信されました。',
        'reissued' => '認証コードが再発行され、新しい認証コードがメールアドレスに送信されました。',
        'totp_used_key' => '認証コードは既に使用されています、しばらく待ってから新しいコードをご利用ください。',
        'totp_gone' => '認証トークンが削除されたため、メール認証に切り替えます。認証メールを送信しました。',
        'unknown' => '予期せぬ問題が発生しました。新しい認証コードがメールアドレスに送信されました。',
    ],
];

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

    'errors' => [
        'expired' => '認証コードの期限が切れています。新しい認証コードがメールアドレスに送信されました。',
        'incorrect_key' => '認証コードが正しくありません。',
        'retries_exceeded' => '認証コードが正しくありません。試行回数の制限を超えたので、新しい認証コードがメールアドレスに送信されました。',
        'reissued' => '認証コードが再発行され、新しい認証コードがメールアドレスに送信されました。',
        'unknown' => '予期せぬ問題が発生しました。新しい認証コードがメールアドレスに送信されました。',
    ],
];

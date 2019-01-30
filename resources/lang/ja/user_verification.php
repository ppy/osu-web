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
        'sent' => ':mailに認証コードが含まれるEメールが送られました。続行するにはコードを入力してください。',
        'title' => 'アカウント認証',
        'verifying' => '認証中・・・',
        'issuing' => 'コードの生成中・・・',

        'info' => [
            'check_spam' => "スパムフォルダーに入っていないか確認をお願いいたします。",
            'recover' => "Eメールアカウントにアクセスできない場合はこちらから復元を試みてください。:link.",
            'recover_link' => 'Eメールの復元',
            'reissue' => 'コードの:reissue_linkや:logout_linkもできます。',
            'reissue_link' => '再生成',
            'logout_link' => 'ログアウト',
        ],
    ],

    'email' => [
        'subject' => 'osu!アカウントの認証',
    ],

    'errors' => [
        'expired' => '認証コードの期限が切れています。再度認証コードのメールが送られます。',
        'incorrect_key' => '認証コードが正しくありません。',
        'retries_exceeded' => '認証コードが正しくありません。試行回数の制限を超えてしまったので、再度認証コードのメールが送られます。',
        'reissued' => '認証コードが再生成されました。再度認証コードのメールが送られます。',
        'unknown' => '予期せぬ問題が発生しました。再度認証コードのメールが送られます。',
    ],
];

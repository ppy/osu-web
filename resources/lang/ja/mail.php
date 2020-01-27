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
    'beatmapset_update_notice' => [
        'new' => '前回の訪問以降、ビートマップ「:title」に新しい更新がありました。',
        'subject' => 'ビートマップ":title"に新しい投稿があります',
        'unwatch' => 'このビートマップのウォッチを解除したい場合は、ページ上にある[ウォッチ解除]をクリックするか、moddingウォッチリストページからクリックしてください:',
        'visit' => 'こちらのディスカッションページにアクセスしてください:',
    ],

    'common' => [
        'closing' => 'お手数おかけして申し訳ございませんが、どうぞよろしくお願い致します。',
        'hello' => 'こんにちは :user、',
        'report' => 'この変更をしていない場合は、すぐにこのメールに返信してください。',
    ],

    'forum_new_reply' => [
        'new' => '前回の訪問以降、ビートマップ「:title」に新しい返信がありました。',
        'subject' => '[osu!] トピック":title"に新しい返信があります',
        'unwatch' => 'このトピックをもう見たくない場合は、トピックの下部にある[トピックのサブスクライブを解除]リンクをクリックするか、トピックサブスクリプション管理ページからクリックしてください:',
        'visit' => '次のリンクを使用して、最新の返信に直接ジャンプします:',
    ],

    'password_reset' => [
        'code' => '確認コードは次のとおりです:',
        'requested' => 'あなたまたはあなたを装った誰かがあなたのosu!アカウントのパスワードリセットを要求しました。',
        'subject' => 'osu!アカウントの復元',
    ],

    'store_payment_completed' => [
        'prepare_shipping' => 'お支払いを受領しました、ご注文の発送準備中です。 注文の量によっては、発送までに数日かかる場合があります。 ここで注文の進行状況を追跡できます:',
        'processing' => 'お支払いを受け取りました。現在、注文を処理しています。 こちらで注文の進行状況を確認できます:',
        'questions' => "ご不明な点がございましたら、このメールへの返信をしてください。",
        'shipping' => '出荷',
        'subject' => 'osu!ストアで注文を受け付けました！',
        'thank_you' => 'osu!store でのご注文ありがとうございます！',
        'total' => '合計',
    ],

    'supporter_gift' => [
        'anonymous_gift' => 'このタグを贈った人は匿名のままにすることを選択したため、この通知には記載されていません。',
        'anonymous_gift_maybe_not' => 'しかし、あなたはおそらくそれが誰であるかすでに知っているでしょう;)',
        'duration' => '彼らのおかげで、次の:duration osu!directおよびその他のosu!supporter特典を利用できます。',
        'features' => 'これらの機能の詳細については、こちらをご覧ください:',
        'gifted' => '誰かがあなたにosu!supporterタグをプレゼントしました！',
        'subject' => 'あなたはosu!サポータータグを贈られました！',
    ],

    'user_email_updated' => [
        'changed_to' => 'これはosu!のメールアドレスが次のものに変更された事に関する確認メールです: :email',
        'check' => '今後このosu!アカウントにアクセスできなくなることを防ぐため、新しいアドレスでこのメールを受信したことを確認してください。',
        'sent' => 'セキュリティ上の理由から、このメールは新しいメールアドレスと古いメールアドレスの両方に送信されています。',
        'subject' => 'メールアドレス変更の確認',
    ],

    'user_force_reactivation' => [
        'main' => 'アカウントが侵害された疑いがあります、最近疑わしいアクティビティがあるか、パスワードが非常に脆弱です。そのため新しいパスワードを設定する必要があります。 必ず安全なパスワードにしてください。',
        'perform_reset' => 'リセットは :url からできます。',
        'reason' => '理由:',
        'subject' => 'osu! アカウントの再アクティベーションが必要です',
    ],

    'user_password_updated' => [
        'confirmation' => 'これはosu! パスワードが変更されたことを確認するだけです。',
        'subject' => 'パスワード変更の確認',
    ],

    'user_verification' => [
        'code' => '確認コードは次のとおりです:',
        'code_hint' => 'スペースを入れても入れなくてもコードを入力できます。',
        'link' => 'または、以下のリンクにアクセスして確認を完了することもできます:',
        'report' => 'これをしていない場合はアカウントが危険にさらされている可能性があるため、すぐに返信してください。',
        'subject' => 'osu!アカウントの認証',

        'action_from' => [
            '_' => ':country でアカウントに対して実行されたアクションには確認作業が必要です。',
            'unknown_country' => '不明な国',
        ],
    ],
];

<?php

/**
 *    Copyright 2015-2017 ppy Pty. Ltd.
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
    'admin' => [
        'warehouse' => 'ウェアハウス',
    ],

    'checkout' => [
        'cart_problems' => 'カートに問題があります！',
        'cart_problems_edit' => 'クリックで変更',
        'declined' => 'お支払いはキャンセルされました。',
        'error' => '精算中に問題が発生しました。',
        'old_cart' => 'Your cart appears to be out of date and has been reloaded, please try again.',
        'pay' => 'Paypalで支払う',
        'pending_checkout' => [
            'line_1' => '前回の精算が完了していません。',
            'line_2' => '支払い方法を選択して再開するか:linkキャンセルできます。',
            'link_text' => 'ここをクリックして',
        ],
        'delayed_shipping' => '現在注文が多く大変混雑しています。注文はまだ受け付けていますが、**1，2週間ほどの遅延**が発生する可能性があります。',
    ],

    'discount' => ':percent%の割引',

    'mail' => [
        'payment_completed' => [
            'subject' => 'We received your osu!store order!',
        ],
    ],

    'order' => [
        'item' => [
            'display_name' => [
                'supporter_tag' => ':nameが:usernameに(:duration)',
            ],
            'quantity' => '個数',
        ],
    ],

    'product' => [
        'name' => '名前',

        'stock' => [
            'out' => 'この製品は現在売り切れです。また今度確認してみてください！',
            'out_with_alternative' => 'この製品は現在売り切れです。ドロップダウンメニューから別のを選ぶかまた今度確認してみてください！',
        ],

        'add_to_cart' => 'カートに入れる',
        'notify' => '入荷したら通知する',

        'notification_success' => '入荷次第連絡が通知が入る様になります。:linkからキャンセルできます',
        'notification_remove_text' => 'ここ',

        'notification_in_stock' => '既に入荷しています！',
    ],

    'supporter_tag' => [
        'gift' => 'プレイヤーにギフト',
        'require_login' => [
            '_' => 'サポータータグを入手するには:linkが必要です！',
            'link_text' => 'ログイン',
        ],
    ],

    'username_change' => [
        'check' => '名前を入力して使用可能か確認しましょう！',
        'checking' => ':usernameが使用可能か確認中・・・',
        'require_login' => [
            '_' => '名前を変えるには:linkが必要です！',
            'link_text' => 'ログイン',
        ],
    ],
];

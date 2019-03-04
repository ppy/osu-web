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
    'admin' => [
        'warehouse' => '倉庫',
    ],

    'cart' => [
        'checkout' => 'レジへ進む',
        'more_goodies' => '精算の前に他のグッズをチェックする。',
        'shipping_fees' => '送料',
        'title' => '買い物かご',
        'total' => '合計',

        'errors_no_checkout' => [
            'line_1' => '会計をする上でカート内の商品に問題があります！',
            'line_2' => '続けるためには削除するか、商品の変更をしてください。',
        ],

        'empty' => [
            'text' => 'カートには何もありません。',
            'return_link' => [
                '_' => ':linkに戻って商品を見つける',
                'link_text' => '商品一覧',
            ],
        ],
    ],

    'checkout' => [
        'cart_problems' => 'カートに問題があります！',
        'cart_problems_edit' => 'クリックで変更',
        'declined' => 'お支払いはキャンセルされました。',
        'delayed_shipping' => '現在注文が多く大変混雑しています。注文はまだ受け付けていますが、**1，2週間ほどの遅延**が発生する可能性があります。',
        'old_cart' => 'あなたのカートは期限切れ、または再読み込みされたようです。再度お試しください。',
        'pay' => 'Paypalで支払う',

        'has_pending' => [
            '_' => '未完了の支払いがあります。:linkをクリックして詳細を確認してください。',
            'link_text' => 'ここ',
        ],

        'pending_checkout' => [
            'line_1' => '前回の精算が完了していません。',
            'line_2' => 'お支払い方法を選択して購入をする。',
        ],
    ],

    'discount' => ':percent%の割引',

    'invoice' => [
        'echeck_delay' => '決済方法がeCheckのため、PayPalを介した支払いが完了するまで、さらに最大10日を要します。予めご了承ください。',
        'status' => [
            'processing' => [
                'title' => 'お支払いはまだ完了していません。',
                'line_1' => 'すでにお支払いが完了している場合は、私たちはあなたのお支払いが確定したことを受け取るのを待っています。このページを1~2分待ってから再読み込みしてください。',
                'line_2' => [
                    '_' => 'お支払いに関して問題がある場合: :link',
                    'link_text' => 'ここをクリックして購入を続ける',
                ],
            ],
        ],
    ],

    'mail' => [
        'payment_completed' => [
            'subject' => 'あなたの注文を受け付けました！',
        ],
    ],

    'order' => [
        'paid_on' => '注文済み :date',

        'invoice' => '請求書を見る',
        'no_orders' => '表示できる注文がありません。',

        'item' => [
            'display_name' => [
                'supporter_tag' => ':nameが:usernameに(:duration)',
            ],
            'quantity' => '個数',
        ],

        'not_modifiable_exception' => [
            'cancelled' => 'キャンセル後に注文の変更は行えません。',
            'checkout' => '発送準備中に注文の変更は行えません。', // checkout and processing should have the same message.
            'default' => '注文の変更は行えません。',
            'delivered' => '発送後に注文の変更は行えません。',
            'paid' => '支払い後に注文の変更は行えません。',
            'processing' => '発送準備中に注文の変更は行えません。',
            'shipped' => '発送後に注文の変更はできません。',
        ],

        'status' => [
            'cancelled' => 'キャンセル済み',
            'checkout' => '準備中',
            'delivered' => '発送済み',
            'paid' => '支払い済み',
            'processing' => '承認待ち',
            'shipped' => '輸送中',
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

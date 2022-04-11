<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'cart' => [
        'checkout' => '支払いをする',
        'info' => ':count_delimited 個がカート内にあります($:subtotal)',
        'more_goodies' => '精算の前に他のグッズをチェックする。',
        'shipping_fees' => '配送料',
        'title' => 'カート',
        'total' => '合計',

        'errors_no_checkout' => [
            'line_1' => 'カート内の商品に問題があるため、お支払いができません。',
            'line_2' => '商品の削除か更新をして続ける。',
        ],

        'empty' => [
            'text' => 'カートには何もありません。',
            'return_link' => [
                '_' => ':linkに戻って他のグッズを見つける',
                'link_text' => '商品一覧',
            ],
        ],
    ],

    'checkout' => [
        'cart_problems' => 'ええと、あなたのカートに問題があります！',
        'cart_problems_edit' => 'クリックで変更',
        'declined' => 'お支払いはキャンセルされました。',
        'delayed_shipping' => '現在注文が多く大変混雑しています。注文はまだ受け付けていますが、**１～２週間ほどの遅延**が発生する可能性があります。',
        'old_cart' => 'あなたのカートは期限切れ、または再読み込みされたようです。再度お試しください。',
        'pay' => 'Paypalで支払う',
        'title_compact' => '決済',

        'has_pending' => [
            '_' => '未完了の支払いがあります。:linkをクリックして詳細を確認してください。',
            'link_text' => 'ここ',
        ],

        'pending_checkout' => [
            'line_1' => '前回の支払いが完了しませんでした。',
            'line_2' => 'お支払い方法を選択して支払いを再開する。',
        ],
    ],

    'discount' => ':percent%の割引',

    'invoice' => [
        'echeck_delay' => '決済方法がeCheckのため、PayPalを介した支払いが完了するまで、さらに最大10日を要します。予めご了承ください。',
        'title_compact' => '請求書',

        'status' => [
            'processing' => [
                'title' => 'お支払いはまだ確認されていません。',
                'line_1' => '既にお支払いを済ませている場合、私達は支払いを確認している最中の可能性があります。１～２分後にページの再読込をして下さい。',
                'line_2' => [
                    '_' => 'お支払いに関して問題がある場合: :link',
                    'link_text' => 'ここをクリックして支払いを続ける',
                ],
            ],
        ],
    ],

    'order' => [
        'cancel' => '注文をキャンセル',
        'cancel_confirm' => 'この注文はキャンセルされ、支払いは受け付けられません。 選択した支払い会社は、支払いをすぐに返金しない可能性があります。よろしいですか？',
        'cancel_not_allowed' => 'この注文は現在キャンセルできません。',
        'invoice' => '請求書を見る',
        'no_orders' => '表示できる注文がありません。',
        'paid_on' => '注文済み :date',
        'resume' => '支払いを再開',
        'shopify_expired' => 'この注文の決済リンクは期限切れとなりました。',

        'item' => [
            'display_name' => [
                'supporter_tag' => ':nameを:usernameに贈る（:duration）',
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
            'shipped' => '発送済み',
        ],
    ],

    'product' => [
        'name' => '名前',

        'stock' => [
            'out' => 'この商品は現在在庫がありません。また今度確認してみてください！',
            'out_with_alternative' => 'この商品は現在在庫がありません。メニューから別の種類を選ぶか、また今度確認してみてください！',
        ],

        'add_to_cart' => 'カートに入れる',
        'notify' => '入荷したら通知する',

        'notification_success' => '入荷されたら通知を受け取ることができます。:linkからキャンセルできます',
        'notification_remove_text' => 'ここ',

        'notification_in_stock' => '既に入荷しています！',
    ],

    'supporter_tag' => [
        'gift' => 'プレイヤーにギフトを贈る',
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

    'xsolla' => [
        'distributor' => '',
    ],
];

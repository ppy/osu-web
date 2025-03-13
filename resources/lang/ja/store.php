<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'cart' => [
        'checkout' => '支払いをする',
        'empty_cart' => 'カートからすべてのアイテムを削除',
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
        'hide_from_activity' => 'この順序でosu!サポータータグをすべて非表示にする',
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
    'free' => '無料',

    'invoice' => [
        'contact' => 'お問い合わせ先：',
        'date' => '日付:',
        'echeck_delay' => '決済方法がeCheckのため、PayPalを介した支払いが完了するまで、さらに最大10日を要します。予めご了承ください。',
        'echeck_denied' => '',
        'hide_from_activity' => 'osu!サポータータグは最近のアクティビティには表示されません。',
        'sent_via' => '',
        'shipping_to' => '',
        'title' => '請求書',
        'title_compact' => '請求書',

        'status' => [
            'cancelled' => [
                'title' => 'この注文はキャンセルされました',
                'line_1' => [
                    '_' => "キャンセルを希望されない場合は、注文番号 (#:order_number) を明記の上、:link までご連絡ください。",
                    'link_text' => 'osu!store support',
                ],
            ],
            'delivered' => [
                'title' => 'ご注文の商品が届きました！どうぞ存分にお楽しみください！',
                'line_1' => [
                    '_' => 'ご購入に問題がある場合は、 :link までご連絡ください。',
                    'link_text' => 'osu!store support',
                ],
            ],
            'prepared' => [
                'title' => 'ご注文は準備中です！',
                'line_1' => '発送まで、もう少々お待ちください。ご注文の処理・発送が完了次第、追跡情報がこちらに表示されます。混雑状況によっては最大５日ほどかかる場合があります（ただし通常はもっと早いです！）ので、何卒ご了承ください。',
                'line_2' => '私たちはすべてのご注文を日本から、重量や商品の価値に応じてさまざまな配送サービスを使ってお送りしています。ご注文を発送次第、こちらに詳細が反映されますのでご確認ください。',
            ],
            'processing' => [
                'title' => 'お支払いはまだ確認されていません。',
                'line_1' => '既にお支払いを済ませている場合、私達は支払いを確認している最中の可能性があります。１～２分後にページの再読込をして下さい。',
                'line_2' => [
                    '_' => 'お支払いに関して問題がある場合: :link',
                    'link_text' => 'ここをクリックして支払いを続ける',
                ],
            ],
            'shipped' => [
                'title' => 'ご注文は発送されました！',
                'tracking_details' => '追跡情報：',
                'no_tracking_details' => [
                    '_' => "エアメールでお送りしたため、追跡情報はございませんが、通常1〜3週間ほどでお届けできる見込みです。ヨーロッパへの発送の場合、税関の事情により配送が遅れる可能性があり、私たちでは対応が難しいこともございます。ご不明点やご不安な点がありましたら、ご注文確認メールへの返信(または :link)にてお問い合わせください。",
                    'link_text' => '',
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
        'shipping_and_handling' => '配送と手数料',
        'shopify_expired' => 'この注文の決済リンクは期限切れとなりました。',
        'subtotal' => '小計',
        'total' => '合計',

        'details' => [
            'order_number' => '注文 #',
            'payment_terms' => '支払い条件',
            'salesperson' => '',
            'shipping_method' => '配送方法',
            'shipping_terms' => '配送条件',
            'title' => '注文の詳細',
        ],

        'item' => [
            'quantity' => '個数',

            'display_name' => [
                'supporter_tag' => ':nameを:usernameに贈る（:duration）',
            ],

            'subtext' => [
                'supporter_tag' => 'メッセージ :message',
            ],
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
            'title' => '注文ステータス',
        ],

        'thanks' => [
            'title' => 'ご注文ありがとうございました！',
            'line_1' => [
                '_' => '',
                'link_text' => 'お問い合わせ',
            ],
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
        'gift_message' => 'ギフトに任意のメッセージを追加 (最大 :length 文字)',

        'require_login' => [
            '_' => 'サポータータグを入手するには:linkが必要です！',
            'link_text' => 'ログイン',
        ],
    ],

    'username_change' => [
        'check' => '名前を入力して使用可能か確認しましょう！',
        'checking' => ':usernameが使用可能か確認中・・・',
        'placeholder' => '',
        'label' => '新しいユーザー名',
        'current' => '現在のあなたのユーザー名は ":username" です。',

        'require_login' => [
            '_' => '名前を変えるには:linkが必要です！',
            'link_text' => 'ログイン',
        ],
    ],

    'xsolla' => [
        'distributor' => '',
    ],
];

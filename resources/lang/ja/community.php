<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'support' => [
        'convinced' => [
            'title' => 'いいですね！',
            'support' => 'osu!をサポートする！',
            'gift' => 'もしくはギフトを贈る',
            'instructions' => 'ハートボタンをクリックでosu!storeに飛びます(英語)',
        ],
        'why-support' => [
            'title' => 'なぜosu!を支援する必要があるの？お金はどう使われるの？',

            'team' => [
                'title' => 'チームを支援する',
                'description' => 'osu!は小規模なチームによって開発されています。あなたのサポートがチームを助けます。',
            ],
            'infra' => [
                'title' => 'サーバーインフラ',
                'description' => '寄付はウェブサイト、マルチプレイサービス、オンラインリーダーボードを実行するサーバーの為に使われます。',
            ],
            'featured-artists' => [
                'title' => '注目アーティスト',
                'description' => 'あなたのサポートで私達は素晴らしいアーティストにアプローチして、osu!で使用するための素晴らしい音楽をライセンスすることができます。',
                'link_text' => '現在の一覧を見る &raquo;',
            ],
            'ads' => [
                'title' => 'osu!の独立性を保つ',
                'description' => 'あなたの貢献によってゲームは独立し、広告や外部のスポンサーから自由になることができます。',
            ],
            'tournaments' => [
                'title' => '公式トーナメント',
                'description' => '公式osu!ワールドカップトーナメントに資金（および賞品）を提供してください！',
                'link_text' => 'トーナメントを検索 &raquo;',
            ],
            'bounty-program' => [
                'title' => 'オープンソースバウンティプログラム',
                'description' => 'osu!を改善するために時間と労力を費やしてきたコミュニティの貢献者を支援します。',
                'link_text' => '詳細を見る &raquo;',
            ],
        ],
        'perks' => [
            'title' => '特典って？',
            'osu_direct' => [
                'title' => 'osu!direct',
                'description' => 'ゲームから離れることなくビートマップを素早くダウンロード。',
            ],

            'friend_ranking' => [
                'title' => 'フレンドランキング',
                'description' => "ゲーム内とウェブサイトのリーダーボードで、フレンドと競い合う方法をご覧ください。",
            ],

            'country_ranking' => [
                'title' => '国別ランキング',
                'description' => '世界征服の前にまずは君の国で一番を目指そう。',
            ],

            'mod_filtering' => [
                'title' => 'Modsで絞り込む',
                'description' => 'HDHRをプレイする人と関連付けますか？問題ありません！',
            ],

            'auto_downloads' => [
                'title' => '自動ダウンロード',
                'description' => '観戦やマルチプレイをする時に自動的にビートマップをダウンロードします。リンクもクリックだけで終わります。',
            ],

            'upload_more' => [
                'title' => 'アップロード上限数の増加',
                'description' => 'Pendingのビートマップをアップロードできる数が増えます。（Rankedビートマップ一つあたり）上限は10個です。',
            ],

            'early_access' => [
                'title' => '早期アクセス',
                'description' => 'テスト段階の機能が使えるベータ版のクライアントが利用できるようになります。',
            ],

            'customisation' => [
                'title' => 'カスタマイズ',
                'description' => "自分のユーザーページに自由に編集できる領域が追加されます。",
            ],

            'beatmap_filters' => [
                'title' => 'ビートマップの検索フィルター',
                'description' => 'ビートマップがプレイ・未プレイや取得したランクで検索できるようになります。',
            ],

            'yellow_fellow' => [
                'title' => 'イエローフェロー',
                'description' => 'ゲーム内チャットで名前の色が明るい黄色で表示されるようになります。',
            ],

            'speedy_downloads' => [
                'title' => '高速ダウンロード',
                'description' => 'ダウンロードの制限が緩くなります。',
            ],

            'change_username' => [
                'title' => 'ユーザー名の変更',
                'description' => 'ユーザー名の変更を一回だけ追加料金なしで利用できます。',
            ],

            'skinnables' => [
                'title' => 'スキンの拡張',
                'description' => 'メインメニューの背景のような追加スキンを変更できるようになります。',
            ],

            'feature_votes' => [
                'title' => '機能リクエスト',
                'description' => '機能リクエストに投票できるようになります。（月あたり２回）',
            ],

            'sort_options' => [
                'title' => '並び替えオプション',
                'description' => 'ゲーム内でビートマップの国別・フレンド・Mod別ランキングが利用できるようになります。',
            ],

            'more_favourites' => [
                'title' => 'その他のお気に入り',
                'description' => 'お気に入りに登録できるビートマップの数は:normally &rarr; :supporterに増加します',
            ],
            'more_friends' => [
                'title' => 'その他のフレンド',
                'description' => '登録できるフレンドの数は:normally &rarr; :supporterに増加します',
            ],
            'more_beatmaps' => [
                'title' => '他のビートマップをアップロード',
                'description' => '一度に保持できるRankedされていないビートマップ数は、基準値とRankedされたビートマップの追加ボーナス値から計算されます。<br/><br/>通常これは:baseつで、Rankedされたビートマップごとに:bonusつ追加されます。（最大 :bonus_max）サポーターになると、:supporter_baseつになりRankedされるごとに:supporter_bonusつ追加されます。（最大 :supporter_bonus_max）',
            ],
            'friend_filtering' => [
                'title' => 'フレンドリーダーボード',
                'description' => 'フレンドとランキングを競うことができます！',
            ],

        ],
        'supporter_status' => [
            'contribution' => 'osu!をサポートしてくれてありがとうございます！今までに:dollarsで:tags個のタグを購入しました！',
            'gifted' => "今まで購入したサポータータグのうち:giftedTags個がギフト（ギフト合計金額：:giftedDollars）として送られました。あなたの寛大さに拍手！",
            'not_yet' => "osu!サポータータグをまだ持っていません :(",
            'valid_until' => 'あなたのosu!サポータータグは:dateまで有効です！',
            'was_valid_until' => 'あなたのosu!サポータータグは:dateに期限切れになりました。',
        ],
    ],
];

<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'audio' => [
        'autoplay' => '次のトラックを自動的に再生',
    ],

    'defaults' => [
        'page_description' => 'osu! - リズムはもう、その指先に！応援団や太鼓をモチーフにしたゲームモード、オリジナルのゲームモード、そしてレベルエディタも備えています。',
    ],

    'header' => [
        'admin' => [
            'beatmapset' => 'ビートマップセット',
            'beatmapset_covers' => 'ビートマップセットカバー',
            'contest' => 'コンテスト',
            'contests' => 'コンテスト',
            'root' => 'コンソール',
            'store_orders' => 'ストア管理者',
        ],

        'artists' => [
            'index' => '一覧',
        ],

        'changelog' => [
            'index' => '一覧',
        ],

        'help' => [
            'index' => '目次',
            'sitemap' => 'サイトマップ',
        ],

        'store' => [
            'cart' => 'カート',
            'orders' => '注文履歴',
            'products' => '製品',
        ],

        'tournaments' => [
            'index' => '一覧',
        ],

        'users' => [
            'modding' => 'modding',
            'multiplayer' => '',
            'show' => '詳細',
        ],
    ],

    'gallery' => [
        'close' => '閉じる（Esc）',
        'fullscreen' => '全画面表示に切り替え',
        'zoom' => 'ズームイン/ズームアウト',
        'previous' => '前（左矢印）',
        'next' => '次へ（右矢印）',
    ],

    'menu' => [
        'beatmaps' => [
            '_' => 'ビートマップ',
            'artists' => '注目アーティスト',
            'index' => '一覧',
            'packs' => 'パック',
        ],
        'community' => [
            '_' => 'コミュニティ',
            'chat' => 'チャット',
            'contests' => 'コンテスト',
            'dev' => '開発',
            'forum-forums-index' => 'フォーラム',
            'getLive' => '配信',
            'tournaments' => 'トーナメント',
        ],
        'help' => [
            '_' => 'ヘルプ',
            'getAbuse' => '不正利用の報告',
            'getFaq' => 'FAQ',
            'getRules' => 'ルール',
            'getSupport' => 'サポートが必要です！',
            'getWiki' => 'wiki',
        ],
        'home' => [
            '_' => 'ホーム',
            'changelog-index' => '更新履歴',
            'getDownload' => 'ダウンロード',
            'news-index' => 'お知らせ',
            'search' => '検索',
            'team' => 'osu!team',
        ],
        'rankings' => [
            '_' => 'ランキング',
            'charts' => 'スポットライト',
            'country' => '国別',
            'index' => 'パフォーマンス',
            'kudosu' => 'kudosu',
            'multiplayer' => 'マルチプレイヤー',
            'score' => 'スコア',
        ],
        'store' => [
            '_' => 'ストア',
            'cart-show' => 'カート',
            'getListing' => '商品一覧',
            'orders-index' => '注文履歴',
        ],
    ],

    'footer' => [
        'general' => [
            '_' => '全般',
            'home' => 'ホーム',
            'changelog-index' => '更新履歴',
            'beatmaps' => 'ビートマップリスト',
            'download' => 'osu!をダウンロード',
        ],
        'help' => [
            '_' => 'ヘルプ＆コミュニティ',
            'faq' => 'よくある質問',
            'forum' => 'コミュニティフォーラム',
            'livestreams' => 'ライブ配信',
            'report' => '問題を報告する',
            'wiki' => 'Wiki',
        ],
        'legal' => [
            '_' => 'Legal & Status',
            'copyright' => '著作権 (DMCA)',
            'privacy' => 'プライバシー',
            'server_status' => 'サーバー状態',
            'source_code' => 'ソースコード',
            'terms' => '利用規約',
        ],
    ],

    'errors' => [
        '400' => [
            'error' => '無効な要求パラメーター',
            'description' => '',
        ],
        '404' => [
            'error' => 'ページが見つかりません',
            'description' => "申し訳ありませんが、要求されたページはここにはないようです。",
        ],
        '403' => [
            'error' => "何か手違いがあったみたいです。",
            'description' => '戻ってみることをおすすめします。',
        ],
        '401' => [
            'error' => "何か手違いがあったみたいです。",
            'description' => '戻ってみるか、ログインしてみる事をおすすめします。',
        ],
        '405' => [
            'error' => 'ページが見つかりません',
            'description' => "申し訳ありませんが、要求されたページはここにはないようです。",
        ],
        '422' => [
            'error' => '無効な要求パラメーターです。',
            'description' => '',
        ],
        '429' => [
            'error' => '試行可能回数の上限に達しました。',
            'description' => '',
        ],
        '500' => [
            'error' => '予期せぬエラーが発生しました ;_;',
            'description' => "自動的にエラーは報告されます。",
        ],
        'fatal' => [
            'error' => '予期せぬエラーが発生しました（爆） ;_;',
            'description' => "自動的にエラーは報告されます。",
        ],
        '503' => [
            'error' => 'メンテナンス中です！',
            'description' => "メンテナンスには通常5秒から10分かかります。もし長時間ダウンしている場合は:linkを参照してください。",
            'link' => [
                'text' => '',
                'href' => '',
            ],
        ],
        // used by sentry if it returns an error
        'reference' => "念の為に、サポートに提示できるコードを表示します。",
    ],

    'popup_login' => [
        'button' => 'ログイン / 登録',

        'login' => [
            'forgot' => "ログイン情報を忘れた",
            'password' => 'パスワード',
            'title' => '続行するにはログインしてください',
            'username' => 'ユーザー名',

            'error' => [
                'email' => "ユーザー名かメールアドレスが存在しません",
                'password' => 'パスワードが一致しませんでした。',
            ],
        ],

        'register' => [
            'download' => 'ダウンロード',
            'info' => 'アカウントが必要です。作ってみませんか？',
            'title' => "アカウントが必要です",
        ],
    ],

    'popup_user' => [
        'links' => [
            'account-edit' => '設定',
            'follows' => 'ウォッチリスト',
            'friends' => 'フレンド',
            'logout' => 'ログアウト',
            'profile' => 'プロフィール',
        ],
    ],

    'popup_search' => [
        'initial' => '入力して検索！',
        'retry' => '検索に失敗しました。クリックでリトライします。',
    ],
];

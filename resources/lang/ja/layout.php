<?php

/**
 *    Copyright 2015-2018 ppy Pty. Ltd.
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
    'defaults' => [
        'page_description' => 'osu! - リズムはもう、その指先に！  某応援団や某太鼓のゲームをモチーフにしたゲームモードやオリジナルのゲームモードも楽しめて、譜面作成までも完全に行えるゲームです。',
    ],

    'menu' => [
        'home' => [
            '_' => 'ホーム',
            'account-edit' => '設定',
            'friends-index' => 'フレンド',
            'changelog-index' => '更新履歴',
            'changelog-build' => 'ビルド',
            'getDownload' => 'ダウンロード',
            'getIcons' => 'アイコン',
            'groups-show' => 'グループ',
            'index' => 'ダッシュボード',
            'legal-show' => 'インフォメーション',
            'news-index' => 'お知らせ',
            'news-show' => 'お知らせ',
            'password-reset-index' => 'パスワードのリセット',
            'search' => '検索',
            'supportTheGame' => '支援する',
            'team' => 'osu!チーム',
        ],
        'help' => [
            '_' => 'ヘルプ',
            'getFaq' => 'FAQ',
            'getRules' => 'ルール',
            'getSupport' => '本当にサポートが必要です！',
            'getWiki' => 'wiki',
            'wiki-show' => 'wiki',
        ],
        'beatmaps' => [
            '_' => '譜面',
            'artists' => '推奨アーティスト',
            'beatmap_discussion_posts-index' => 'ディスカッション投稿',
            'beatmap_discussions-index' => 'ディスカッション',
            'beatmapset-watches-index' => 'moddingウォッチリスト',
            'beatmapset_discussion_votes-index' => 'ディスカッション評価',
            'beatmapset_events-index' => 'ビートマップセットイベント',
            'index' => '譜面リスト',
            'packs' => 'パック',
            'show' => '詳細',
        ],
        'beatmapsets' => [
            '_' => '譜面',
            'discussion' => 'modding',
        ],
        'rankings' => [
            '_' => 'ランキング',
            'index' => 'パフォーマンス',
            'performance' => 'パフォーマンス',
            'charts' => 'チャート',
            'score' => 'スコア',
            'country' => '国別',
            'kudosu' => 'kudosu',
        ],
        'community' => [
            '_' => 'コミュニティ',
            'dev' => '開発',
            'getForum' => 'フォーラム',
            'getChat' => 'チャット',
            'getLive' => '配信',
            'contests' => 'コンテスト',
            'profile' => 'プロフィール',
            'tournaments' => 'トーナメント',
            'tournaments-index' => 'トーナメント',
            'tournaments-show' => 'トーナメント情報',
            'forum-topic-watches-index' => 'サブスクリプション',
            'forum-topics-create' => 'フォーラム',
            'forum-topics-show' => 'フォーラム',
            'forum-forums-index' => 'フォーラム',
            'forum-forums-show' => 'フォーラム',
        ],
        'multiplayer' => [
            '_' => 'マルチプレイヤー',
            'show' => 'マッチ',
        ],
        'error' => [
            '_' => 'エラー',
            '404' => '見つかりません',
            '403' => '禁止されています',
            '401' => '権限がありません',
            '405' => '見つかりません',
            '500' => '予期せぬエラーです',
            '503' => 'メンテナンス',
        ],
        'user' => [
            '_' => 'ユーザー',
            'getLogin' => 'ログイン',
            'disabled' => '無効',

            'register' => '登録',
            'reset' => 'リセット',
            'new' => '新しい',

            'messages' => 'メッセージ',
            'settings' => '設定',
            'logout' => 'ログアウト',
            'help' => 'ヘルプ',
            'modding-history-discussions' => 'ユーザーモッディングの議論',
            'modding-history-events' => 'ユーザーモッディングイベント',
            'modding-history-index' => 'ユーザーのビートマップセットのアクティビティ',
            'modding-history-posts' => 'ユーザーモッディングポスト',
            'modding-history-votesGiven' => 'ユーザーモッディングあげた投票',
            'modding-history-votesReceived' => 'ユーザーモッディング貰った投票',
        ],
        'store' => [
            '_' => 'ストア',
            'checkout-show' => '精算',
            'getListing' => '製品一覧',
            'cart-show' => 'カート',

            'getCheckout' => '精算',
            'getInvoice' => '送り状',
            'products-show' => '製品',

            'new' => 'new',
            'home' => 'ホーム',
            'index' => 'ホーム',
            'thanks' => 'お礼',
        ],
        'admin-forum' => [
            '_' => 'admin::forum',
            'forum-covers-index' => 'フォーラムカバー',
        ],
        'admin-store' => [
            '_' => 'admin::store',
            'orders-index' => '注文',
            'orders-show' => '注文',
        ],
        'admin' => [
            '_' => 'admin',
            'beatmapsets-covers' => 'ビートマップセットカバー',
            'logs-index' => 'ログ',
            'root' => 'インデックス',

            'beatmapsets' => [
                '_' => 'ビートマップセット',
                'show' => '詳細',
            ],
        ],
    ],

    'footer' => [
        'general' => [
            '_' => '全般',
            'home' => 'ホーム',
            'changelog-index' => '更新履歴',
            'beatmaps' => '譜面のリスト',
            'download' => 'osu!をダウンロード',
            'wiki' => 'Wiki',
        ],
        'help' => [
            '_' => 'ヘルプ＆コミュニティ',
            'faq' => 'よくある質問',
            'forum' => 'コミュニティフォーラム',
            'livestreams' => 'ライブ配信',
            'report' => '問題を報告する',
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
        '404' => [
            'error' => 'ページが見つかりません',
            'description' => "ご希望のページはここにはない様です。",
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
            'description' => "ご希望のページはここにはない様です。",
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
            'description' => "メンテナンスは大体5秒から10分の間で完了します。もし10分以上サーバーに接続できない場合は:linkを参照してください。",
            'link' => [
                'text' => '@osustatus',
                'href' => 'https://twitter.com/osustatus',
            ],
        ],
        // used by sentry if it returns an error
        'reference' => "念の為に、サポートに提示できるコードが表示されます。",
    ],

    'popup_login' => [
        'login' => [
            'email' => 'Eメールアドレス',
            'forgot' => "ログイン情報を忘れた",
            'password' => 'パスワード',
            'title' => '続行するにはログインしてください',

            'error' => [
                'email' => "ユーザー名かEメールか存在しません",
                'password' => 'パスワードが一致しませんでした。',
            ],
        ],

        'register' => [
            'info' => "アカウントが必要です。作ってみませんか？",
            'title' => "アカウントが必要です",
        ],
    ],

    'popup_user' => [
        'links' => [
            'account-edit' => '設定',
            'friends' => 'フレンド',
            'logout' => 'ログアウト',
            'profile' => 'プロフィール',
        ],
    ],

    'popup_search' => [
        'initial' => '入力で検索！',
        'retry' => '検索に失敗しました。クリックでリトライします。',
    ],
];

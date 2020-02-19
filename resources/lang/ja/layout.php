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
    'defaults' => [
        'page_description' => 'osu! - リズムはもう、その指先に！応援団や太鼓をモチーフにしたゲームモード、オリジナルのゲームモード、そしてレベルエディタも備えています。',
    ],

    'header' => [
        'admin' => [
            '_' => '管理者',
            'beatmapset' => 'ビートマップセット',
            'beatmapset_covers' => 'ビートマップセットカバー',
            'contest' => 'コンテスト',
            'contests' => 'コンテスト',
            'root' => 'コンソール',
            'store_orders' => 'ストア管理者',
        ],

        'artists' => [
            '_' => '注目アーティスト',
            'index' => '一覧',
        ],

        'beatmapsets' => [
            '_' => 'ビートマップ',
            'discussions' => 'ディスカッション',
            'index' => '一覧',
            'show' => '詳細',
            'packs' => 'パック',
        ],

        'changelog' => [
            '_' => '更新履歴',
            'index' => '一覧',
        ],

        'community' => [
            '_' => 'コミュニティ',
            'comments' => 'コメント',
            'contests' => 'コンテスト',
            'forum' => 'フォーラム',
            'livestream' => 'ライブ配信',
        ],

        'error' => [
            '_' => 'エラー',
        ],

        'help' => [
            '_' => 'wiki',
            'index' => '目次',
        ],

        'home' => [
            '_' => 'ホーム',
            'password_reset' => 'パスワードのリセット',
        ],

        'matches' => [
            '_' => '対戦履歴',
        ],

        'notice' => [
            '_' => 'お知らせ',
        ],

        'notifications' => [
            '_' => '',
            'index' => '',
        ],

        'rankings' => [
            '_' => 'ランキング',
        ],

        'store' => [
            '_' => 'osu!ストア',
            'cart' => 'カート',
            'order' => '請求書',
            'orders' => '注文履歴',
            'product' => '製品',
            'products' => '製品',
        ],

        'tournaments' => [
            '_' => 'トーナメント',
            'index' => '一覧',
        ],

        'users' => [
            '_' => 'プレイヤー',
            'forum_posts' => 'フォーラム投稿',
            'modding' => 'modding',
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
        'home' => [
            '_' => 'ホーム',
            'account-edit' => '設定',
            'account-verifyLink' => '認証が完了しました。',
            'beatmapset-watches-index' => 'modding ウォッチリスト',
            'changelog-build' => 'ビルド',
            'changelog-index' => '更新履歴',
            'client_verifications-create' => 'osu!クライアントの認証',
            'forum-topic-watches-index' => 'フォーラムサブスクリプション',
            'friends-index' => 'フレンド',
            'getDownload' => 'ダウンロード',
            'getIcons' => 'アイコン',
            'groups-show' => 'グループ',
            'index' => 'ダッシュボード',
            'legal-show' => 'インフォメーション',
            'messages-index' => 'メッセージ',
            'news-index' => 'お知らせ',
            'news-show' => 'お知らせ',
            'password-reset-index' => 'パスワードのリセット',
            'search' => '検索',
            'supportTheGame' => 'ゲームを支援する',
            'team' => 'osu!team',
            'testflight' => 'testflight',
        ],
        'profile' => [
            '_' => 'プロフィール',
            'friends' => 'フレンド',
            'settings' => '設定',
        ],
        'help' => [
            '_' => 'ヘルプ',
            'getFaq' => 'FAQ',
            'getRules' => 'ルール',
            'getSupport' => 'サポートが必要です！',
            'getWiki' => 'wiki',
            'wiki-show' => 'wiki',
        ],
        'beatmaps' => [
            '_' => 'ビートマップ',
            'artists' => '注目アーティスト',
            'beatmap_discussion_posts-index' => 'ディスカッション投稿',
            'beatmap_discussions-index' => 'ディスカッション',
            'beatmapset_discussion_votes-index' => 'ディスカッション評価',
            'beatmapset_events-index' => 'ビートマップセットイベント',
            'index' => '一覧',
            'packs' => 'パック',
            'show' => '詳細',
        ],
        'beatmapsets' => [
            '_' => 'ビートマップ',
            'discussion' => 'modding',
        ],
        'rankings' => [
            '_' => 'ランキング',
            'index' => 'パフォーマンス',
            'performance' => 'パフォーマンス',
            'charts' => 'スポットライト',
            'score' => 'スコア',
            'country' => '国別',
            'kudosu' => 'kudosu',
        ],
        'community' => [
            '_' => 'コミュニティ',
            'chat' => 'チャット',
            'chat-index' => 'チャット',
            'dev' => '開発',
            'getForum' => 'フォーラム',
            'getLive' => '配信',
            'comments-index' => 'コメント',
            'comments-show' => 'コメント',
            'contests' => 'コンテスト',
            'profile' => 'プロフィール',
            'tournaments' => 'トーナメント',
            'tournaments-index' => 'トーナメント',
            'tournaments-show' => 'トーナメント情報',
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

            'help' => 'ヘルプ',
            'logout' => 'ログアウト',
            'messages' => 'メッセージ',
            'modding-history-discussions' => 'ユーザーのmoddingディスカッション',
            'modding-history-events' => 'ユーザーのmoddingイベント',
            'modding-history-index' => 'ユーザーのmodding履歴',
            'modding-history-posts' => 'ユーザーのmodding投稿',
            'modding-history-votesGiven' => 'ユーザーがmoddingに与えた投票',
            'modding-history-votesReceived' => 'ユーザーがmoddingで受け取った投票',
            'notifications-index' => '',
            'oauth_login' => 'oauthでログインする。',
            'oauth_request' => 'oauth認証',
            'settings' => '設定',
        ],
        'store' => [
            '_' => 'ストア',
            'checkout-show' => '支払いをする',
            'getListing' => '商品一覧',
            'cart-show' => 'カート',

            'getCheckout' => '支払いをする',
            'getInvoice' => '請求書',
            'orders-index' => '注文履歴',
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
            'beatmaps' => 'ビートマップリスト',
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
            'description' => "申し訳ありませんが、要求されたページはここにはない様です。",
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
            'description' => "メンテナンスには通常5秒から10分かかります。もし長時間ダウンしている場合は:linkを参照してください。",
            'link' => [
                'text' => '@osustatus',
                'href' => 'https://twitter.com/osustatus',
            ],
        ],
        // used by sentry if it returns an error
        'reference' => "念の為に、サポートに提示できるコードを表示します。",
    ],

    'popup_login' => [
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
            'title' => "アカウントを持っていませんか？",
        ],
    ],

    'popup_user' => [
        'links' => [
            'account-edit' => '設定',
            'friends' => 'フレンドリスト',
            'logout' => 'ログアウト',
            'profile' => 'プロフィール',
        ],
    ],

    'popup_search' => [
        'initial' => '入力して検索',
        'retry' => '検索に失敗しました。クリックでリトライします。',
    ],
];

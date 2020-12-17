<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'landing' => [
        'download' => '今すぐダウンロード',
        'online' => '現在<strong>:players</strong>人オンラインでマルチ部屋数<strong>:games</strong>',
        'peak' => '最高オンライン数:count人',
        'players' => '累計登録者数<strong>:count</strong>人',
        'title' => 'ようこそ！',
        'see_more_news' => '他のニュースを見る',

        'slogan' => [
            'main' => '基本料無料で最高のリズムゲーム',
            'sub' => 'リズムはもう、その指先に',
        ],
    ],

    'search' => [
        'advanced_link' => '高度な検索',
        'button' => '検索',
        'empty_result' => '何も見つかりませんでした！',
        'keyword_required' => '検索キーワードが必要です',
        'placeholder' => '検索キーワードを入力',
        'title' => '検索',

        'beatmapset' => [
            'login_required' => 'ログインしてビートマップを検索',
            'more' => '他:count件のビートマップ検索結果',
            'more_simple' => 'もっとビートマップの検索結果を見る',
            'title' => 'ビートマップ',
        ],

        'forum_post' => [
            'all' => '全てのフォーラム',
            'link' => 'フォーラムを検索',
            'login_required' => 'ログインしてフォーラムを検索',
            'more_simple' => 'もっとフォーラム検索結果を見る',
            'title' => 'フォーラム',

            'label' => [
                'forum' => 'フォーラム内を検索',
                'forum_children' => 'サブフォーラムを含む',
                'topic_id' => 'トピック #',
                'username' => '投稿者',
            ],
        ],

        'mode' => [
            'all' => '全て',
            'beatmapset' => 'ビートマップ',
            'forum_post' => 'フォーラム',
            'user' => 'プレイヤー',
            'wiki_page' => 'wiki',
        ],

        'user' => [
            'login_required' => 'ログインしてユーザーを検索',
            'more' => '他に:count人のプレイヤーが見つかりました',
            'more_simple' => 'もっとプレイヤーの検索結果を見る',
            'more_hidden' => 'プレイヤー検索は最大:max件までです。絞り込む事をおすすめします。',
            'title' => 'プレイヤー',
        ],

        'wiki_page' => [
            'link' => 'wikiを検索',
            'more_simple' => 'もっとwikiの検索結果を見る',
            'title' => 'Wiki',
        ],
    ],

    'download' => [
        'tagline' => "さぁ、<br>始めよう！",
        'action' => 'osu!をダウンロード',

        'help' => [
            '_' => 'ゲームの開始やアカウント登録に問題がある場合は、:help_forum_link または :support_button。',
            'help_forum_link' => 'ヘルプフォーラムを確認する',
            'support_button' => 'お問い合わせ',
        ],

        'os' => [
            'windows' => 'for Windows',
            'macos' => 'for macOS',
            'linux' => 'for Linux',
        ],
        'mirror' => 'ミラー',
        'macos-fallback' => 'macOSユーザー',
        'steps' => [
            'register' => [
                'title' => 'アカウントを作る',
                'description' => 'ゲーム起動後に表示される手順に沿ってアカウントを作成、そしてログインしよう',
            ],
            'download' => [
                'title' => 'ゲームをインストール',
                'description' => '上のボタンからインストーラーをダウンロードして、実行しよう！',
            ],
            'beatmaps' => [
                'title' => 'ビートマップを取得',
                'description' => [
                    '_' => ':browseからユーザーが作った膨大な数のビートマップから好きなビートマップを見つけて遊ぼう！',
                    'browse' => 'ここ',
                ],
            ],
        ],
        'video-guide' => '説明動画',
    ],

    'user' => [
        'title' => 'ダッシュボード',
        'news' => [
            'title' => 'お知らせ',
            'error' => '読み込みに失敗しました。ページの更新をしてみると直るかも・・・？',
        ],
        'header' => [
            'stats' => [
                'friends' => 'オンラインのフレンド',
                'games' => '部屋数',
                'online' => 'オンラインのユーザー数',
            ],
        ],
        'beatmaps' => [
            'new' => '最新のRankedビートマップ',
            'popular' => '人気のビートマップ',
            'by_user' => 'by :user',
        ],
        'buttons' => [
            'download' => 'osu!をダウンロード',
            'support' => 'osu!を支援する',
            'store' => 'osu!ストア',
        ],
    ],

    'support-osu' => [
        'title' => 'ねえねえ、君！',
        'subtitle' => 'osu!の事、気に入って貰えたかな？',
        'body' => [
            'part-1' => 'osu!のサービス維持は広告に頼らず、全てプレイヤーたちの支援によって実現されています。',
            'part-2' => 'osu! を支援する事によってさまざまな機能が追加で利用できるようになります。<strong>ゲーム内ダウンロード</strong>はそのうちのひとつで、観戦やマルチプレイ中に自動でビートマップをダウンロードできるようになります！',
        ],
        'find-out-more' => 'もっと知りたい人はクリック！',
        'download-starting' => "あ、君のダウンロードはもう始まってるよ！",
    ],
];

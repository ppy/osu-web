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
    'landing' => [
        'download' => '今すぐダウンロード',
        'online' => '現在<strong>:players</strong>人オンラインでマルチ部屋数<strong>:games</strong>',
        'peak' => '最高オンライン数:count',
        'players' => '累計登録者数<strong>:count</strong>人',
        'title' => 'ようこそ！',
        'see_more_news' => '他のニュースを見る',

        'slogan' => [
            'main' => '基本無料で最高のリズムゲーム',
            'sub' => 'リズムはもう、その指先に',
        ],
    ],

    'search' => [
        'advanced_link' => '高度な検索',
        'button' => '検索',
        'empty_result' => '何も見つかりませんでした！',
        'keyword_required' => '検索キーワードが必要です',
        'placeholder' => '検索キーワードを入力',
        'title' => '検索結果',

        'beatmapset' => [
            'more' => '他:count件のビートマップ検索結果',
            'more_simple' => 'もっとビートマップの検索結果を見る',
            'title' => 'ビートマップ',
        ],

        'forum_post' => [
            'all' => '全てのフォーラム',
            'link' => 'フォーラムを検索',
            'more_simple' => '他のフォーラム検索結果を見る',
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
            'more' => '他:count件のプレイヤー検索結果',
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
                'title' => 'ゲームをダウンロードする',
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
                'online' => 'オンライン',
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
            'part-2' => 'osu!を支援する事によってさまざまな機能が追加で利用できるようになります。　<strong>ゲーム内ダウンロード</strong>はその内のひとつで、プレイヤーのスペクト中やマルチプレイ中に簡単に譜面を入れられる様になります！',
        ],
        'find-out-more' => 'もっと知りたい人はクリック！',
        'download-starting' => "あ、君のダウンロードはもう始まってるよ！",
    ],
];

<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'index' => [
        'description' => '共通のテーマを有するビートマップを集めたパックです。',
        'nav_title' => '一覧',
        'title' => 'ビートマップパック',

        'blurb' => [
            'important' => 'ダウンロード前に必ず読んでください',
            'instruction' => [
                '_' => "インストールするには：ダウンロードが完了次第.rarファイルをosu!のSongsフォルダに中身を解凍してください。
                    osu!が次回ビートマップの読み込みを開始する時に圧縮されているビートマップファイル（zip/osz）を自動的に取り込みます。
                    :scaryにzip/oszファイルを手動で解凍しないでください。ビートマップの取り込みに失敗して正常にビートマップが表示されなくなります。",
                'scary' => '絶対',
            ],
            'note' => [
                '_' => ':scary作成日時が古いビートマップはクオリティが低い可能性があります。',
                'scary' => '最新のビートマップを優先してダウンロードしてください。',
            ],
        ],
    ],

    'show' => [
        'download' => 'ダウンロード',
        'item' => [
            'cleared' => '削除済み',
            'not_cleared' => '未クリア',
        ],
        'no_diff_reduction' => [
            '_' => ':link はこのパックをクリアするのに使用できません。',
            'link' => '難易度低下mod',
        ],
    ],

    'mode' => [
        'artist' => 'アーティスト/アルバム',
        'chart' => 'スポットライト',
        'standard' => 'スタンダードパック',
        'theme' => 'テーマ',
    ],

    'require_login' => [
        '_' => 'ダウンロードするには:linkが必要です',
        'link_text' => 'ログイン',
    ],
];

<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
 */

return [
    'index' => [
        'blurb' => [
            'important' => 'ダウンロード前に必ず読んでください',
            'instruction' => [
                '_' => "インストールするには：ダウンロードが完了次第.rarファイルをosu!のSongsフォルダに中身を解凍してください。
                    osu!が次回ビートマップの読み込みを開始する時に圧縮されているビートマップファイル（zip/osz）を自動的に取り込みます。
                    :scaryにzip/oszファイルを手動で解凍しないでください。ビートマップの取り込みに失敗して正常にビートマップが表示されなくなります。",
                'scary' => '絶対に',
            ],
            'note' => [
                '_' => ':scary作成日時が古いビートマップはクオリティが低い可能性があります。',
                'scary' => '最新のビートマップを優先してダウンロードしてください。',
            ],
        ],
        'title' => 'ビートマップパック',
        'description' => '共通のテーマを有するビートマップを集めたパックです。',
    ],

    'show' => [
        'back' => '',
        'download' => 'ダウンロード',
        'item' => [
            'cleared' => '消去しました',
            'not_cleared' => '未消去',
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

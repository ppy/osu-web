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
    'index' => [
        'blurb' => [
            'important' => 'ダウンロード前に必ず読んでください',
            'instruction' => [
                '_' => "インストールするには：ダウンロードが完了次第.rarファイルをosu!のSongsフォルダに中身を解凍してください。
                    osu!が次回譜面の読み込みを開始する時に圧縮されている譜面ファイル(zip/osz)を自動的に取り込みます。
                    :scaryにzip/oszファイルを手動で解凍しないでください。譜面の取り込みに失敗して正常に譜面が表示されなくなります。",
                'scary' => '絶対に',
            ],
            'note' => [
                '_' => ':scary作成日時が古い譜面はクオリティが低い傾向があります。',
                'scary' => '最新の譜面を優先してダウンロードしてください。',
            ],
        ],
        'title' => 'ビートマップパック',
        'description' => '共通のテーマを有する譜面を寄せ集めたパックです。',
    ],

    'show' => [
        'download' => 'ダウンロード',
        'item' => [
            'cleared' => '消去しました',
            'not_cleared' => '未消去',
        ],
    ],

    'mode' => [
        'artist' => 'アーティスト/アルバム',
        'chart' => 'チャート',
        'standard' => '基本パック',
        'theme' => 'テーマ',
    ],

    'require_login' => [
        '_' => 'ダウンロードするには:linkが必要です',
        'link_text' => 'ログイン',
    ],
];

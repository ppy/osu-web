<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'index' => [
        'batch_disable' => '選択項目を無効化',
        'batch_enable' => '選択項目を有効化',

        'batch_confirm' => [
            '_' => ':action :items?',
            'disable' => '無効',
            'enable' => '有効',
            'items' => ':count_delimited 件のカバー|:count_delimited 件のカバー',
        ],

        'create_form' => [
            'files' => 'ファイル',
            'submit' => '保存',
            'title' => '新規追加',
        ],

        'item' => [
            'click_to_disable' => '無効化するにはクリック',
            'click_to_enable' => '有効化するにはクリック',
            'enabled' => '有効化済み',
            'disabled' => '無効化済み',
            'image_store' => '画像を設定',
            'image_update' => '画像を置き換え',
        ],
    ],
    'store' => [
        'failed' => 'カバーの作成中にエラーが発生しました: :error',
        'ok' => 'カバーが作成されました',
    ],
];

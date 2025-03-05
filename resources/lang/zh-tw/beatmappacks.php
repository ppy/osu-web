<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'index' => [
        'description' => '圍繞相同主題的圖譜合集壓縮檔',
        'empty' => '敬請期待！',
        'nav_title' => '清單',
        'title' => '圖譜壓縮檔',

        'blurb' => [
            'important' => '下載前必讀',
            'install_instruction' => '如何安裝：下載完成後，請將圖譜壓縮檔解壓縮到 osu! 的 Songs 資料夾。osu! 會處理後續流程。',
        ],
    ],

    'show' => [
        'created_by' => '作者：:author',
        'download' => '下載',
        'item' => [
            'cleared' => '已通過',
            'not_cleared' => '未通過',
        ],
        'no_diff_reduction' => [
            '_' => '使用:link將無法解鎖這個圖譜壓縮檔的成就。',
            'link' => '降低難度的 mod',
        ],
    ],

    'mode' => [
        'artist' => '藝術家/專輯',
        'chart' => '聚光燈',
        'featured' => '精選藝術家',
        'loved' => '社群喜愛計畫',
        'standard' => '標準',
        'theme' => '主題',
        'tournament' => '錦標賽',
    ],

    'require_login' => [
        '_' => '您需要 :link 才能下載',
        'link_text' => '登入',
    ],
];

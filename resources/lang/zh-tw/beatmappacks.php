<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'index' => [
        'description' => '相同主題的圖譜合集壓縮檔',
        'nav_title' => '列表',
        'title' => '曲包',

        'blurb' => [
            'important' => '下載前必讀',
            'install_instruction' => '如何安裝：下載完成後，請將圖譜包解壓縮到 osu! 的 Songs 資料夾。osu! 會處理後續流程。',
            'note' => [
                '_' => '強烈建議您 :scary，因為舊圖譜的品質可能不如現在。',
                'scary' => '下載最新的圖譜壓縮檔',
            ],
        ],
    ],

    'show' => [
        'download' => '下載',
        'item' => [
            'cleared' => '玩過',
            'not_cleared' => '未玩',
        ],
        'no_diff_reduction' => [
            '_' => '使用:link將無法解鎖這個曲包的成就。',
            'link' => '降低難度的 mod',
        ],
    ],

    'mode' => [
        'artist' => '藝術家/專輯',
        'chart' => '頭條',
        'standard' => '標準',
        'theme' => '主題',
    ],

    'require_login' => [
        '_' => '您需要 :link 才能下載',
        'link_text' => '登入',
    ],
];

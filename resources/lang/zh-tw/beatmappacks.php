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
        'description' => '相同主題的圖譜合集壓縮檔',
        'nav_title' => '列表',
        'title' => '圖譜壓縮檔',

        'blurb' => [
            'important' => '下載前必讀',
            'instruction' => [
                '_' => "安裝方式：當您下載好壓縮檔之後,請將壓縮檔 .rar 解壓到您 osu! 安裝目錄下的 Songs 資料夾內。
                    解壓出來的圖譜檔案皆是 .zip 或 .osz 檔案, osu! 會在你下一次啟動時自動載入這些圖譜。
                    因此請 :scary 自行解壓這些圖譜檔案，否則恐導致無法正常遊戲。",
                'scary' => '不要',
            ],
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

<?php

/**
 *    Copyright 2015-2017 ppy Pty. Ltd.
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
            'important' => '下載前必讀',
            'instruction' => [
                '_' => '安裝：下載好曲包之後,直接解壓 .rar 文件到你的 osu! 的 Songs 文件夾下。
                    所有的譜面此時都是 .zip 或 .osz 文件, osu! 會在你下一次啓動時自動載入這些譜面，
                    因此 :scary 自己解壓這些譜面。
                    否則這些譜面可能無法正常遊玩。',
                'scary' => '不要',
            ],
            'note' => [
                '_' => '強烈建議 :scary，因爲舊譜面的質量可能不如現在。',
                'scary' => '下載最新的曲包',
            ],
        ],
        'title' => '曲包',
        'description' => '圍繞某個相同主題打包好的曲包',
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
        'chart' => '月賽',
        'standard' => '標準',
        'theme' => '主題',
    ],

    'require_login' => [
        '_' => '需要 :link 才能下載',
        'link_text' => '登錄',
    ],
];

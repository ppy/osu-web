<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'page_description' => 'osu! 精選藝術家',
    'title' => '精選藝術家',

    'admin' => [
        'hidden' => '這個藝術家已被隱藏',
    ],

    'beatmaps' => [
        '_' => '圖譜',
        'download' => '下載圖譜範本',
        'download-na' => '圖譜範本暫不提供',
    ],

    'index' => [
        'description' => '精選藝術家是我們正在合作的藝術家，目的是為 osu! 帶來全新原創的音樂。這些藝術家和他們的一些曲目，都是經由 osu! 團隊精心挑選，品質優良且適合用於圖譜製作。部分精選藝術家也創作了專門用於 osu! 的全新曲目。<br><br>此區所有曲目均以預先計時的 .osz 檔案格式提供，並已獲得官方授權，可在 osu! 及 osu! 相關內容中使用。',
    ],

    'links' => [
        'beatmaps' => 'osu! 圖譜',
        'osu' => 'osu! 個人檔案',
        'site' => '官方網站',
    ],

    'songs' => [
        '_' => '樂曲',
        'count' => ':count_delimited 首歌曲|:count_delimited 首歌曲',
        'original' => 'osu! 原創',
        'original_badge' => '原創曲',
    ],

    'tracklist' => [
        'title' => '標題',
        'length' => '長度',
        'bpm' => 'bpm',
        'genre' => '類型',
    ],

    'tracks' => [
        'index' => [
            '_' => '歌曲搜尋',

            'exclusive_only' => [
                'all' => '全部',
                'exclusive_only' => 'osu! 原創',
            ],

            'form' => [
                'advanced' => '進階搜尋',
                'album' => '專輯',
                'artist' => '演出者',
                'bpm_gte' => 'BPM 最小值',
                'bpm_lte' => 'BPM 最大值',
                'empty' => '找不到符合條件的歌曲。',
                'exclusive_only' => '類別',
                'genre' => '曲風',
                'genre_all' => '全部',
                'length_gte' => '長度最小值',
                'length_lte' => '長度最大值',
            ],
        ],
    ],
];

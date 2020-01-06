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
    'show' => [
        'fallback_translation' => '請求的頁面還未被翻譯為選中語言 (:language)，現在正顯示英文版本。',
        'incomplete_or_outdated' => '此頁面上的內容不完整或過時。 如果您能夠提供幫助，請考慮更新文章！',
        'missing' => '請求的頁面未找到',
        'missing_title' => '未找到',
        'missing_translation' => '請求的頁面沒有當前語言的版本。',
        'needs_cleanup_or_rewrite' => '',
        'search' => '在 wiki 中搜索 :link 。',
        'toc' => '目錄',

        'edit' => [
            'link' => '在 GitHub 上顯示',
            'refresh' => '刷新',
        ],

        'translation' => [
            'legal' => '此翻譯僅為方便起見而提供。原本 :default 應是本文的唯一具有法律約束力的版本。',
            'outdated' => '此頁面包含原始內容的過時翻譯。請檢查 :default 獲取最準確的資訊（及如果您能夠提供幫助，請考慮更新翻譯）！',

            'default' => '英文版本',
        ],
    ],
    'main' => [
        'title' => '知識庫',
        'subtitle' => '',
    ],
];

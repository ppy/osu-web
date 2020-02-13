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
        'fallback_translation' => '请求的页面还没有没有被翻译为选中语言 (:language). 正在显示英文版本.',
        'incomplete_or_outdated' => '此页面的内容不完整或已过时。如果你能帮忙，请一起更新这篇文章！',
        'missing' => '请求的页面未找到',
        'missing_title' => '未找到',
        'missing_translation' => '请求的页面没有当前语言的版本',
        'needs_cleanup_or_rewrite' => '此页面不符合osu! wiki的标准，需要清理或重写。 欢迎你帮助更新这篇文章 ！',
        'search' => '在 wiki 中搜索 :link 。',
        'toc' => '目录',

        'edit' => [
            'link' => '在 GitHub 上显示',
            'refresh' => '刷新',
        ],

        'translation' => [
            'legal' => '本翻译仅为方便阅读，只有原始的 :default 才是唯一具有法律效力的版本。',
            'outdated' => '本文是原始内容的过期翻译，请查阅 :default 以获得最准确的信息（欢迎你来帮助更新翻译）！',

            'default' => '英文版本',
        ],
    ],
    'main' => [
        'title' => '知识库',
        'subtitle' => '因为 osu!pedia 听起来有点酸',
    ],
];

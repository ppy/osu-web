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
    'breadcrumbs' => [
        'news-index' => '列表',
        'news-show' => '新闻', //未使用字段
    ],

    'index' => [
        'title' => 'osu!新闻',

        'nav' => [
            'newer' => '下一条新闻',
            'older' => '上一条新闻',
        ],
    ],

    'show' => [
        'posted' => ':time 推送',

        'nav' => [
            'newer' => '下一条新闻',
            'older' => '上一条新闻',
        ],
    ],

    'store' => [
        'button' => '更新', //未使用字段
        'ok' => '列表已更新.', //未使用字段
    ],

    'update' => [
        'button' => '更新',
        'ok' => '新闻已更新.', //未使用字段
    ],
];

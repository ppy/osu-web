<?php

/**
 *    Copyright 2015-2018 ppy Pty. Ltd.
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
    'feed_title' => '详细',
    'generic' => '修复已知问题并做了小改动.',

    'build' => [
        'title' => ':version 中的更新',
    ],

    'builds' => [
        'users_online' => ':count_delimited 名用户在线',
    ],

    'entry' => [
        'by' => '作者：:user',
    ],

    'index' => [
        'page_title' => [
            '_' => '更新日志',
            '_from' => '自 :from 以来的更新',
            '_from_to' => '从 :from 到 :to 的更新',
            '_stream' => ':stream 中的更新',
            '_stream_from' => '自 :from 以来 :stream 中的更新',
            '_stream_from_to' => '从 :from 到 :to 以来 :stream 中的更新',
            '_stream_to' => '',
            '_to' => '',
        ],

        'title' => [
            '_' => '更新日志 :info',
            'info' => '列表',
        ],
    ],

    'support' => [
        'heading' => '喜欢这次更新吗？',
        'text_1' => '支持 osu! 的后续开发并 :link 吧！',
        'text_1_link' => '成为 Supporter',
        'text_2' => '你不仅仅能加快开发进度，还能获得一些额外的功能及定制化内容！',
    ],
];

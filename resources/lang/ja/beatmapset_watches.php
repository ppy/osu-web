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
        'description' => 'ウォッチ中のディスカッションの一覧です。新しい投稿や更新の時に通知されます。',
        'title_compact' => 'modding ウォッチリスト',

        'table' => [
            'empty' => 'ウォッチしているビートマップディスカッションがありません',
            'open_issues' => '未解決の問題',
            'state' => 'ステータス',
            'title' => 'タイトル',
        ],
    ],

    'status' => [
        'read' => '既読',
        'unread' => '未読',
    ],
];

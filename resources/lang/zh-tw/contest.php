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
    'header' => [
        'small' => '享受遊戲以外的競賽體驗。',
        'large' => '',
    ],
    'voting' => [
        'over' => '這場評選的投票已經結束',
        'login_required' => '請登錄後再投票.',
        'best_of' => [
            'none_played' => "沒有符合此次評選條件的譜面！",
        ],
    ],
    'entry' => [
        '_' => '參加',
        'login_required' => '請登錄後再參加評選。',
        'silenced_or_restricted' => '帳戶受限時無法參加評選。',
        'preparation' => '我們正在準備這場評選，請耐心等待！',
        'over' => '感謝參與！提交已經關閉，投票即將開始。',
        'limit_reached' => '您提交的參賽文件大小超出限制',
        'drop_here' => '將您的參賽文件拖到此處',
        'wrong_type' => [
            'art' => '只接受 .jpg 和 .png 格式的文件.',
            'beatmap' => '只接受 .osu 格式的文件.',
            'music' => '只接受 .mp3 格式的文件.',
        ],
        'too_big' => '參賽文件的大小不能超過 :limit.',
    ],
    'beatmaps' => [
        'download' => '下載模板',
    ],
    'vote' => [
        'list' => '投票',
        'count' => ':count 票',
    ],
    'dates' => [
        'ended' => '結束於 :date',

        'starts' => [
            '_' => '開始於 :date',
            'soon' => 'soon™',
        ],
    ],
    'states' => [
        'entry' => '可參加',
        'voting' => '投票中',
        'results' => '已結束',
    ],
];

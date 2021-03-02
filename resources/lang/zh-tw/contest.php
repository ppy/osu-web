<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'header' => [
        'small' => '享受遊戲以外的競賽體驗。',
        'large' => '社群賽事',
    ],

    'index' => [
        'nav_title' => '清單',
    ],

    'voting' => [
        'login_required' => '請登入後再投票。',
        'over' => '這場評選的投票已經結束',
        'show_voted_only' => '顯示投票',

        'best_of' => [
            'none_played' => "沒有符合此次評選條件的圖譜！",
        ],

        'button' => [
            'add' => '投他一票',
            'remove' => '取消投票',
            'used_up' => '您的票已經用光了。',
        ],
    ],
    'entry' => [
        '_' => '參加',
        'login_required' => '請登入後再參加評選。',
        'silenced_or_restricted' => '帳戶受限時無法參加評選。',
        'preparation' => '我們正在準備這場評選，請耐心等待！',
        'drop_here' => '將您的參賽文件拖到此處',
        'download' => '下載 .osz 檔案',
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
        'count' => ':count_delimited 票|:count_delimited 票',
        'points' => ':count_delimited 分|:count_delimited 分',
    ],
    'dates' => [
        'ended' => '結束於 :date',
        'ended_no_date' => '已結束',

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

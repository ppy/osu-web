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

    'judge' => [
        'comments' => '評論',
        'hide_judged' => '隱藏已評分的項目',
        'nav_title' => '評分',
        'no_current_vote' => '您尚未投票',
        'update' => '更新',
        'validation' => [
            'missing_score' => '缺少成績',
            'contest_vote_judged' => '無法在已評分的競賽中投票',
        ],
        'voted' => '您已經提交過此項目的投票',
    ],

    'judge_results' => [
        '_' => '評分結果',
        'creator' => '作者',
        'score' => '分數',
        'total_score' => '總分',
    ],

    'voting' => [
        'judge_link' => '您是此競賽的評委。請在這裡評分。',
        'judged_notice' => '本競賽使用評分系統，評委正在進行評分。',
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

        'progress' => [
            '_' => ':used / :max 已使用票數',
        ],

        'requirement' => [
            'playlist_beatmapsets' => [
                'incomplete_play' => '在玩過指定音樂清單中的所有圖譜後您才能進行投票',
            ],
        ],
    ],

    'entry' => [
        '_' => '參加',
        'login_required' => '請登入後再參加評選。',
        'silenced_or_restricted' => '帳號受限時無法參加評選。',
        'preparation' => '我們正在準備這場評選，請耐心等待！',
        'drop_here' => '將您的參賽檔案拖曳至此',
        'download' => '下載 .osz 檔案',

        'wrong_type' => [
            'art' => '只接受 .jpg 和 .png 格式的檔案。',
            'beatmap' => '只接受 .osu 格式的檔案。',
            'music' => '只接受 .mp3 格式的檔案。',
        ],

        'wrong_dimensions' => '參加競賽的數量必須達到 :widthx:height',
        'too_big' => '參賽檔案的大小不能超過 :limit。',
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

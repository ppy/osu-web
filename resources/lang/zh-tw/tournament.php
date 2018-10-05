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
    'index' => [
        'none_running' => '目前沒有正在進行的比賽，過段時間再來看看吧！',
        'registration_period' => '報名時間： :start 到 :end',

        'header' => [
            'subtitle' => '官方認可的比賽列表',
            'title' => '社區比賽',
        ],

        'item' => [
            'registered' => '已註冊玩家',
        ],

        'state' => [
            'current' => '正在進行的比賽',
            'previous' => '過去的比賽',
        ],
    ],

    'show' => [
        'banner' => '贊助您的隊伍',
        'entered' => '你已經報名這次比賽。<br><br>請注意，這不表示你已經被分組。<br><br>比賽開始前你將收到郵件通知，所以請確保你的 osu! 帳號的email可以收到信件！',
        'info_page' => '訊息頁',
        'login_to_register' => '請 :login 以查看報名細節！',
        'not_yet_entered' => '你還沒有報名這次比賽。',
        'rank_too_low' => '抱歉, 您的排名不符合這次比賽的要求!',
        'registration_ends' => '報名於 :date 結束',

        'button' => [
            'cancel' => '取消報名',
            'register' => '我要報名！',
        ],

        'state' => [
            'before_registration' => '這次比賽還沒開放報名。',
            'ended' => '本次比赛已經结束。查看訊息頁面以取得比赛结果。',
            'registration_closed' => '本次比赛已經停止報名。查看訊息頁面以取得最新消息。',
            'running' => '本次比赛正在進行。查看訊息頁面以取得賽況。',
        ],
    ],
    'tournament_period' => ':start 到 :end',
];

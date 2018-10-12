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
        'none_running' => '目前没有正在进行的比赛，过段时间再来看看吧！',
        'registration_period' => '报名时间： :start 到 :end',

        'header' => [
            'subtitle' => '官方认可的比赛列表',
            'title' => '社区比赛',
        ],

        'item' => [
            'registered' => '已注册玩家',
        ],

        'state' => [
            'current' => '正在进行的比赛',
            'previous' => '已经结束的比赛',
        ],
    ],

    'show' => [
        'banner' => '支持你的队伍',
        'entered' => '你已报名此次比赛。<br><br>这不意味着你已经被分组。<br><br>比赛开始前你将收到邮件通知，所以请确保你的 osu! 邮箱可用！',
        'info_page' => '信息页',
        'login_to_register' => '请 :login 以查看报名细节！',
        'not_yet_entered' => '你还没有报名此次比赛。',
        'rank_too_low' => '抱歉，你还没有达到本次比赛的排名要求！',
        'registration_ends' => '报名于 :date 结束',

        'button' => [
            'cancel' => '取消报名',
            'register' => '我要报名！',
        ],

        'state' => [
            'before_registration' => '本次比赛还未开始报名。',
            'ended' => '本次比赛已经结束。移步信息页查看比赛结果。',
            'registration_closed' => '本次比赛已停止报名。移步信息页查看最新信息。',
            'running' => '本次比赛正在进行。移步信息页查看赛况。',
        ],
    ],
    'tournament_period' => ':start 到 :end',
];

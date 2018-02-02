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
    'index' => [
        'header' => [
            'subtitle' => '官方认可的比赛列表',
            'title' => '社区比赛',
        ],
        'none_running' => '目前没有正在进行的比赛，过段时间再来看看吧！',
        'registration_period' => '报名时间： :start 到 :end',
    ],
    'show' => [
        'button' => [
            'register' => '我要报名！',
            'cancel' => '取消报名',
        ],
        'entered' => '你已报名此次比赛。<br><br>这不意味着你已经被分组。<br><br>比赛开始前你将收到邮件通知，所以请确保你的 osu! 邮箱可用！',
        'login_to_register' => '请 :login 以查看报名细节！',
        'not_yet_entered' => '你还没有报名此次比赛。',
        'rank_too_low' => '抱歉，你还没有达到本次比赛的排名要求！',
        'registration_ends' => '报名于 :date 结束',
    ],
    'tournament_period' => ':start 到 :end',
];

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
        'small' => '享受游戏以外的竞赛体验。',
        'large' => '社区评选',
    ],
    'voting' => [
        'over' => '这场评选的投票已经结束',
        'login_required' => '请登录后再投票.',
        'best_of' => [
            'none_played' => "没有符合此次评选条件的谱面！",
        ],
    ],
    'entry' => [
        '_' => '参加',
        'login_required' => '请登录后再参加评选。',
        'silenced_or_restricted' => '账户受限时无法参加评选。',
        'preparation' => '我们正在准备这场评选，请耐心等待！',
        'over' => '感谢参与！提交已经关闭，投票即将开始。',
        'limit_reached' => '您提交的参赛文件大小超出限制',
        'drop_here' => '将您的参赛文件拖到此处',
        'wrong_type' => [
            'art' => '只接受 .jpg 和 .png 格式的文件.',
            'beatmap' => '只接受 .osu 格式的文件.',
            'music' => '只接受 .mp3 格式的文件.',
        ],
        'too_big' => '参赛文件的大小不能超过 :limit.',
    ],
    'beatmaps' => [
        'download' => '下载模板',
    ],
    'vote' => [
        'list' => '投票',
        'count' => ':count 票',
    ],
    'dates' => [
        'ended' => '结束于 :date',

        'starts' => [
            '_' => '开始于 :date',
            'soon' => '马上就到',
        ],
    ],
    'states' => [
        'entry' => '可参加',
        'voting' => '投票中',
        'results' => '已结束',
    ],
];

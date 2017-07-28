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
        'blurb' => [
            'important' => '下载前必读',
            'instruction' => [
                '_' => '安装：下载好曲包之后,直接解压 .rar 文件到你的 osu! 的 Songs 文件夹下。
                    所有的谱面此时都是 .zip 或 .osz 文件, osu! 会在你下一次启动时自动载入这些谱面，
                    因此:scary自己解压这些谱面。
                    否则这些谱面可能无法正常游玩。',
                'scary' => '不要',
            ],
            'note' => [
                '_' => '强烈建议:scary，因为较老的谱面的质量可能比现在差一些。',
                'scary' => '下载最新的曲包',
            ],
        ],
        'title' => '曲包',
        'description' => '围绕某个相同主题打包好的曲包',
    ],

    'show' => [
        'download' => '下载',
        'item' => [
            'cleared' => '玩过',
            'not_cleared' => '没玩过',
        ],
    ],

    'mode' => [
        'artist' => '艺术家/专辑',
        'chart' => '图表', //与排名那边的翻译同步，但是这个翻译肯定不好
        'standard' => '常规',
        'theme' => '主题',
    ],

    'require_login' => [
        '_' => '需要 :link 才能下载',
        'link_text' => '登录',
    ],
];

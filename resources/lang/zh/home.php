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
    'landing' => [
        'online' => '<strong>:players</strong> 在线玩家 在 <strong>:games</strong> 个房间中',
        'peak' => '最高在线人数 :count 人',
        'players' => '<strong>:count</strong> 注册玩家',

        'download' => [
            '_' => '下载',
            'soon' => '其他操作系统版本的osu!即将到来',
            'for' => ':os版',
            'other' => '点击这里下载 :os1 或 :os2 版',
        ],

        'slogan' => [
            'main' => '免费音乐游戏',
            'sub' => '节奏只需轻轻一点', //@zby1999 的翻译建议
        ],
    ],

    'search' => [
        'advanced_link' => '高级搜索',
        'empty_result' => '没有结果!',
        'missing_query' => '至少应该提供 :n 个字符',
        'title' => '搜索结果',

        'beatmapset' => [
            'more' => '搜索到 :count 张谱面',
            'more_simple' => '查看更多搜索结果',
            'title' => '搜索',
        ],

        'forum_post' => [
            'link' => '在论坛中搜索',
            'more_simple' => '查看更多搜索结果',
            'title' => '论坛',
        ],

        'mode' => [
            'all' => '所有',
            'beatmapset' => '谱面',
            'forum_post' => '论坛',
            'user' => '玩家',
            'wiki_page' => 'wiki',
        ],

        'user' => [
            'more' => '搜索到 :count 个玩家',
            'more_simple' => '查看更多搜索结果',
            'title' => '玩家',
        ],

        'wiki_page' => [
            'link' => '在wiki中搜索',
            'more_simple' => '查看更多搜索结果',
            'title' => 'Wiki',
        ],
    ],

    'download' => [
      'header' => [
          '1' => '让我们',
          '2' => '开始吧',
          '3' => '下载 osu! Windows版',
      ],
      'steps' => [
          '1' => [
              'name' => '第一步',
              'content' => '下载 osu!',
          ],
          '2' => [
              'name' => '第二步',
              'content' => '注册osu!账户',
          ],
          '3' => [
              'name' => '第三步',
              'content' => '???',
          ],
      ],
      'more' => '想了解更多?',
      'more_text' => '查看<a href="https://www.youtube.com/user/osuacademy/">osu!学院 YouTube 频道</a>(国内用户可能访问有困难) 获取最新的教程',
    ],

    'user' => [
        'title' => '新闻',
        'news' => [
            'title' => '新闻',
            'error' => '载入新闻失败,尝试刷新页面?...',
        ],
        'header' => [
            'welcome' => '嗨, <strong>:username</strong>!',
            'messages' => '你有 :count 条新消息',
            'stats' => [
                'games' => '房间',
                'online' => '在线用户',
            ],
        ],
        'beatmaps' => [
            'new' => '新Approved谱面', //mapping相关,暂不翻译
            'popular' => '高人气谱面',
        ],
        'buttons' => [
            'download' => '下载osu!',
            'support' => '支持osu!',
            'store' => 'osu!商店',
        ],
    ],
];

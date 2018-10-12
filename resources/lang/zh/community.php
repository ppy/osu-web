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
    'support' => [
        'header' => [
            // size in font-size
            'big_description' => '喜欢 osu! 吗！？<br/>
                                那就支持 osu! 开发吧 (￣3￣)',
            'small_description' => '',
            'support_button' => '我想支持 osu!',
        ],

        'dev_quote' => 'osu! 是一款完全免费的游戏，但是经营它却不是免费的。在我们租用服务器和高速网络、维护系统及社区、向比赛提供奖品、提供疑难解答以及让玩家们开心的同时，osu! 已经消耗了大量的金钱！噢，别忘了我们是凭着爱好在做 osu! ，没有任何的广告合作！
            <br/><br/>osu! 由我一个人运营着，
            为了维护 osu! 我已经辞去了我的日常工作，
            而我时常感受到使 osu! 维持我所期望的质量是一件很艰难的事情，
            我以个人的名义感谢至今为止所有支持 osu! 的人，
            也包括继续支持 osu! 的所有人 :)。',

        'supporter_status' => [
            'contribution' => '感谢你一直以来的支持！你已经捐赠了 :dollars 并购买了 :tags 次支持者标签！',
            'gifted' => '你已经捐赠了 :giftedTags 次支持者标签（花费了 :giftedDollars ），真慷慨啊！',
            'not_yet' => "你还没有支持者标签 :(",
            'title' => '当前支持者状态',
            'valid_until' => '你的支持者标签将在 :date 到期',
            'was_valid_until' => '你的支持者标签已于 :date 到期',
        ],

        'why_support' => [
            'title' => '为什么要支持 osu! ？',
            'blocks' => [
                'dev' => 'osu! 最初是 ppy 个人开发和维护的',
                'time' => '运营它的成本和投入的精力已经超出了“兴趣”的范围',
                'ads' => '无广告 <br/><br/>
                        不像 99.95% 的网站，我们不推送广告，也没有从中获利。',
                'goodies' => '解锁更多高级功能！',
            ],
        ],

        'perks' => [
            'title' => '我能得到什么？',
            'osu_direct' => [
                'title' => 'osu!direct',
                'description' => '在游戏客户端内搜索和下载谱面。',
            ],

            'auto_downloads' => [
                'title' => '自动下载',
                'description' => '本地没有需要的谱面时，osu! 会自动下载！',
            ],

            'upload_more' => [
                'title' => '上传更多谱面',
                'description' => '谱面集中 Pending 谱面上限增加到 10 张。',
            ],

            'early_access' => [
                'title' => '抢先体验',
                'description' => '抢先体验正在测试中的新特性！',
            ],

            'customisation' => [
                'title' => '个性化',
                'description' => '自定义个人资料页。',
            ],

            'beatmap_filters' => [
                'title' => '谱面筛选器',
                'description' => '更多角度的去筛选谱面。',
            ],

            'yellow_fellow' => [
                'title' => '高亮用户名',
                'description' => '聊天时，用户名会变成亮黄色。',
            ],

            'speedy_downloads' => [
                'title' => '高速下载',
                'description' => '更快的下载速度，尤其是使用 osu!direct 时。',
            ],

            'change_username' => [
                'title' => '修改用户名',
                'description' => '修改用户名而不需要支付费用（最多 1 次）。',
            ],

            'skinnables' => [
                'title' => '更多的定制',
                'description' => '自定义更多的游戏界面元素，例如主菜单的背景。',
            ],

            'feature_votes' => [
                'title' => '新特性投票',
                'description' => '为新特性请求投票（每月 2 票）。',
            ],

            'sort_options' => [
                'title' => '排名',
                'description' => '查看排名时可按 国家/好友/所选MOD 进行排名。',
            ],

            'feel_special' => [
                'title' => '满足感',
                'description' => '对 “帮助 osu! 继续运营” 感到满足！',
            ],

            'more_to_come' => [
                'title' => '更多特性即将到来',
                'description' => '',
            ],
        ],

        'convinced' => [
            'title' => '可以可以，买买买！',
            'support' => '支持 osu!',
            'gift' => '或者以礼物方式赠送给其它玩家',
            'instructions' => '点击爱心前往 osu! 商店',
        ],
    ],
];

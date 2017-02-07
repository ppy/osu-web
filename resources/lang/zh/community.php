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
    'support' => [
        'header' => [
            // size in font-size
            'big_description' => '喜欢osu!?<br/>
                                支持osu!开发者吧 :D',
            'small_description' => '',
            'support_button' => '我想支持osu!',
        ],

        'dev_quote' => 'osu!是一款完全免费的游戏,但是经营它却不是免费的.在我们租用服务器和高速网络,维护系统及社区,向比赛提供奖品,提供疑难解答,以及让玩家们开心的同时,osu!已经消耗了大量的金钱! 噢,别忘了我们是凭着爱好在做osu!,没有任何的广告合作!
            <br/><br/>osu!由我一个人运营着.
            为了维护osu!我已经辞去了我的日常工作,
            而我时常感受到使osu!维持我所期望的质量是一件很艰难的事情.
            我以个人的名义感谢至今为止所有支持osu!的人,
            也包括继续支持osu!的所有人 :).',

        'why_support' => [
            'title' => '为什么我应该支持osu!?',
            'blocks' => [
                'dev' => '开发和维护主要是一个澳大利亚的伙计在负责', //可能不准确
                'time' => '运行它的消耗已经不能称得上"兴趣"了',
                'ads' => '无广告. <br/><br/>
                        不像99.95%的网站,我们不推送广告,也没有从中获利.',
                'goodies' => '您还能得到特技(见下方)!', //可能不准确
            ],
        ],

        'perks' => [
            'title' => '噢?我能得到什么?!',
            'osu_direct' => [
                'title' => 'osu!direct', //不翻译
                'description' => '您可以不离开游戏进行谱面的搜索和下载.',
            ],

            'auto_downloads' => [
                'title' => '自动下载',
                'description' => '多人游戏,观看他人游戏,或是点击聊天中的谱面链接时,osu!会自动下载!',
            ],

            'upload_more' => [ //TODO 需要帮助
                'title' => 'Upload More',
                'description' => 'Additional pending beatmap slots (per ranked beatmap) up to a max of 10.',
            ],

            'early_access' => [
                'title' => '抢先体验',
                'description' => '在一些特性公开之前,您将能抢先体验它们!',
            ],

            'customisation' => [
                'title' => '自定义',
                'description' => '您可以自定义您的个人资料(me!).',
            ],

            'beatmap_filters' => [
                'title' => '谱面筛选器',
                'description' => '您可以按照玩过和没玩过或是达到某个等级来筛选谱面.', //可能不准确
            ],

            'yellow_fellow' => [
                'title' => '黄色高亮',
                'description' => '您在聊天时,名字会被黄色加亮.',
            ],

            'speedy_downloads' => [
                'title' => '高速下载',
                'description' => '您的下载限制会被放开,尤其是当您使用osu!direct的时候.',
            ],

            'change_username' => [
                'title' => '变更用户名',
                'description' => '您可以改变您的用户名而不需要额外的花费(最多1次)',
            ],

            'skinnables' => [
                'title' => '皮肤',
                'description' => '您可以改变更多的游戏皮肤元素,比如主菜单的背景.', //可能不准确
            ],

            'feature_votes' => [
                'title' => '特性投票',
                'description' => '您可以为新特性请求投票(每月2票)',
            ],

            'sort_options' => [
                'title' => '排名',
                'description' => '新添加:您可以在游戏中按 国家/好友/指定MOD 进行排名了.',
            ],

            'feel_special' => [ //TODO 需要帮助
                'title' => 'Feel Special',
                'description' => 'The warm and fuzzy feeling of doing your part to keep osu! running smoothly!',
            ],

            'more_to_come' => [
                'title' => '即将到来',
                'description' => '',
            ],
        ],

        'convinced' => [
            'title' => 'I\'m convinced! :D', //TODO 需要帮助
            'support' => '支持osu!',
            'gift' => '或者给其他玩家一份礼物',
            'instructions' => '点击爱心按钮前往osu!商店',
        ],
    ],
];

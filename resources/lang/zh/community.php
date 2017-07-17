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
            'big_description' => '喜欢 osu 吗！？<br/>
                                那就支持 osu! 开发者吧 (￣3￣)',
            'small_description' => '',
            'support_button' => '我想支持 osu!',
        ],

        'dev_quote' => 'osu! 是一款完全免费的游戏，但是经营它却不是免费的。在我们租用服务器和高速网络、维护系统及社区、向比赛提供奖品、提供疑难解答以及让玩家们开心的同时，osu! 已经消耗了大量的金钱！噢，别忘了我们是凭着爱好在做 osu! ，没有任何的广告合作！
            <br/><br/>osu! 由我一个人运营着，
            为了维护 osu! 我已经辞去了我的日常工作，
            而我时常感受到使 osu! 维持我所期望的质量是一件很艰难的事情，
            我以个人的名义感谢至今为止所有支持 osu! 的人，
            也包括继续支持 osu! 的所有人 :)。',

        'why_support' => [
            'title' => '为什么我应该支持 osu！呢？',
            'blocks' => [
                'dev' => '开发和维护主要是一个澳大利亚人在负责', //可能不准确
                'time' => '运行它的消耗已经不能称得上“兴趣”了',
                'ads' => '无广告 <br/><br/>
                        不像 99.95% 的网站，我们不推送广告，也没有从中获利。',
                'goodies' => '解锁更多新功能！', //可能不准确
            ],
        ],

        'perks' => [
            'title' => '我能得到什么？',
            'osu_direct' => [
                'title' => 'osu!direct', //不翻译
                'description' => '您可以不离开游戏进行谱面的搜索和下载。',
            ],

            'auto_downloads' => [
                'title' => '自动下载',
                'description' => '多人游戏，观看他人进行游戏，或是点击聊天中的谱面链接时，osu! 会自动下载！',
            ],

            'upload_more' => [ //TODO 需要帮助
                'title' => '上传更多谱面',
                'description' => '每个 Ranked 谱面集的 Pending 谱面上限增加到10张。',
            ],

            'early_access' => [
                'title' => '抢先体验',
                'description' => '在一些特性公开之前，您将能抢先体验它们！',
            ],

            'customisation' => [
                'title' => '自定义',
                'description' => '您可以自定义您的个人资料。',
            ],

            'beatmap_filters' => [
                'title' => '谱面筛选器',
                'description' => '您可以按照玩过和没玩过或达到的某个评价来筛选谱面。', //可能不准确
            ],

            'yellow_fellow' => [
                'title' => '黄色高亮',
                'description' => '您在聊天时，黄色用户名会被加亮。',
            ],

            'speedy_downloads' => [
                'title' => '高速下载',
                'description' => '更快的下载速度，尤其是当您使用osu!direct的时候。',
            ],

            'change_username' => [
                'title' => '变更用户名',
                'description' => '您可以改变您的用户名而不需要额外的花费(最多1次)',
            ],

            'skinnables' => [
                'title' => '皮肤',
                'description' => '改变更多的游戏界面，比如主菜单的背景。', //可能不准确
            ],

            'feature_votes' => [
                'title' => '特性投票',
                'description' => '为新特性请求投票（每月2票）。',
            ],

            'sort_options' => [
                'title' => '排名',
                'description' => '新添加：您可以在游戏中按 国家/好友/所选MOD 进行排名了。',
            ],

            'feel_special' => [ //TODO 需要帮助
                'title' => '感到自豪',
                'description' => '为帮助 osu! 顺利运行而自豪!',
            ],

            'more_to_come' => [
                'title' => '更多特性即将到来',
                'description' => '',
            ],
        ],

        'convinced' => [
            'title' => '我被说服了！ :D',
            'support' => '支持 osu!',
            'gift' => '或者给其他玩家一份礼物',
            'instructions' => '点击爱心按钮前往 osu! 商店',
        ],
    ],
];

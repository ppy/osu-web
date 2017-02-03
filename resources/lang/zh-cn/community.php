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

        'dev_quote' => 'osu!是一款完全免费的游戏,但是经营它却不是免费的. 在运行服务器,高质量的网络带宽,维护系统及社区,为比赛提供奖品,提供帮助,保持大家快乐等方面,osu!已经消耗了大量的财力! 噢,别忘了我们是凭着爱好在做osu!,没有任何的广告合作!
            <br/><br/>osu!在我(peppy)这里全天候地运行着.
            为了维护osu!我已经辞去了我的日常工作,
            and do at times struggle to maintain the standards I strive for.
            我以个人的名义感谢至今为止所有支持osu!的人,
            也包括继续支持osu!的所有人 :).', //TODO 中间的句子.可能整段需要重新翻译

        'why_support' => [
            'title' => '为什么我应该支持osu!?',
            'blocks' => [
                'dev' => 'Developed and maintained predominantly by one guy in Australia',
                'time' => 'Takes so much time to keep running that it\'s no longer possible to call it a "hobby".',
                'ads' => 'No ads anywhere. <br/><br/>
                        Unlike 99.95% of the web, we don\'t profit off shoving stuff in your face.',
                'goodies' => 'You get some extra goodies!',
            ],
        ],

        'perks' => [
            'title' => 'Oh? What do i get?!',
            'osu_direct' => [
                'title' => 'osu!direct',
                'description' => 'quick and easy access to search beatmaps without leaving the game.',
            ],

            'auto_downloads' => [
                'title' => 'Auto Downloads',
                'description' => 'Automatic downloads when playing multiplayer, spectating others, or clicking links in chat!',
            ],

            'upload_more' => [
                'title' => 'Upload More',
                'description' => 'Additional pending beatmap slots (per ranked beatmap) up to a max of 10.',
            ],

            'early_access' => [
                'title' => 'Early Access',
                'description' => 'Access to early releases, where you can try new features before they go public!',
            ],

            'customisation' => [
                'title' => 'Customisation',
                'description' => 'Customise your profile by adding a fully customisable user page.',
            ],

            'beatmap_filters' => [
                'title' => 'Beatmap Filters',
                'description' => 'Filter beatmap searches by played and unplayed maps and rank achieved (if any).',
            ],

            'yellow_fellow' => [
                'title' => 'Yellow Fellow',
                'description' => 'Be recognised in-game with your new bright yellow chat username colour.',
            ],

            'speedy_downloads' => [
                'title' => 'Speedy Downloads',
                'description' => 'More lenient download restrictions, especially when using osu!direct.',
            ],

            'change_username' => [
                'title' => 'Change Username',
                'description' => 'The ability to change your username without additional costs. (once max)',
            ],

            'skinnables' => [
                'title' => 'Skinnables',
                'description' => 'Extra in-game skinnables, like the main menu background.',
            ],

            'feature_votes' => [
                'title' => 'Feature Votes',
                'description' => 'Votes for feature requests. (2 per month)',
            ],

            'sort_options' => [
                'title' => 'Sort Options',
                'description' => 'NEW: The ability to view beatmap country / friend / mod-specific rankings in-game.',
            ],

            'feel_special' => [
                'title' => 'Feel Special',
                'description' => 'The warm and fuzzy feeling of doing your part to keep osu! running smoothly!',
            ],

            'more_to_come' => [
                'title' => 'More to come',
                'description' => '',
            ],
        ],

        'convinced' => [
            'title' => 'I\'m convinced! :D',
            'support' => 'support osu!',
            'gift' => 'or gift support to other players',
            'instructions' => 'click the heart button to proceed to the osu!store',
        ],
    ],
];

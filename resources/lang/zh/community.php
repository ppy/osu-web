<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'support' => [
        'convinced' => [
            'title' => '太棒了，买买买！OwO',
            'support' => '支持 osu!',
            'gift' => '或者作为礼物赠送给其他玩家',
            'instructions' => '点击爱心按钮前往 osu! 商店',
        ],
        'why-support' => [
            'title' => '为什么支持 osu!？钱将用往何处？',

            'team' => [
                'title' => '支持开发团队',
                'description' => '一个小团队开发、运行并维护着 osu!，您的支持可以帮助他们……继续下去。',
            ],
            'infra' => [
                'title' => '维护服务器',
                'description' => '资金将用于维护网站，并保持多人游戏、排行榜等服务运行',
            ],
            'featured-artists' => [
                'title' => '精选艺术家',
                'description' => '在您的支持下，我们可以与更多艺术家合作，为 osu! 带来更多的绝佳音乐。',
                'link_text' => '查看当前列表 &raquo;',
            ],
            'ads' => [
                'title' => '维持 osu! 自给自足',
                'description' => '您的帮助可以让游戏保持独立运行，无需依靠其他赞助商且植入广告。',
            ],
            'tournaments' => [
                'title' => '官方比赛',
                'description' => '为运营 osu! 世界杯筹集资金（及奖励）。',
                'link_text' => '探索比赛 &raquo;',
            ],
            'bounty-program' => [
                'title' => '开源赏金计划',
                'description' => '支持那些为了使 osu! 变得更好而花费大量时间与精力的社区贡献者。',
                'link_text' => '了解更多 &raquo;',
            ],
        ],
        'perks' => [
            'title' => '哇，好炫酷！那么我能得到什么？',
            'osu_direct' => [
                'title' => 'osu!direct',
                'description' => '在游戏内轻松搜索下载谱面。',
            ],

            'friend_ranking' => [
                'title' => '好友排名',
                'description' => "在游戏内与网站上查看好友排行榜，了解你与好友孰强孰弱。",
            ],

            'country_ranking' => [
                'title' => '国内/区内排名',
                'description' => '在征服世界前，先征服你所在的地方吧。',
            ],

            'mod_filtering' => [
                'title' => '按 Mod 筛选',
                'description' => '只和玩 HDHR 的玩家打？没问题！',
            ],

            'auto_downloads' => [
                'title' => '自动下载',
                'description' => '当旁观、多人游戏、点击聊天蓝链时，osu! 会自动下载本地缺少的谱面！',
            ],

            'upload_more' => [
                'title' => '上传更多谱面',
                'description' => 'Pending 谱面位上限增加到 10 张。',
            ],

            'early_access' => [
                'title' => '抢先体验',
                'description' => '抢先体验正在测试中的新特性！<br/><br/>同时还包含网站的新功能！',
            ],

            'customisation' => [
                'title' => '个性化',
                'description' => "可编辑个人介绍，并可在个人资料中上传自定义封面。",
            ],

            'beatmap_filters' => [
                'title' => '筛选谱面',
                'description' => '可按更多条件（例如：是否游玩、评级）搜索谱面。',
            ],

            'yellow_fellow' => [
                'title' => '用户名高亮',
                'description' => '聊天时，用户名会变成亮黄色。',
            ],

            'speedy_downloads' => [
                'title' => '高速下载',
                'description' => '开放高速下载。使用 osu!direct 下载的话还能更快。',
            ],

            'change_username' => [
                'title' => '修改用户名',
                'description' => '你能得到一次免费修改用户名的机会。',
            ],

            'skinnables' => [
                'title' => '更多的定制皮肤元素',
                'description' => '可自定义更多皮肤元素，例如主菜单显示的背景。',
            ],

            'feature_votes' => [
                'title' => '新特性投票',
                'description' => '可为新功能每月投 2 票。',
            ],

            'sort_options' => [
                'title' => '更多排行榜',
                'description' => '可查看国家或地区、好友、所选MOD排行榜。',
            ],

            'more_favourites' => [
                'title' => '收藏更多谱面',
                'description' => '你的谱面收藏夹容量将从 :normally 个增加到 :supporter 个',
            ],
            'more_friends' => [
                'title' => '添加更多好友',
                'description' => '你的好友数量上限将从 :normally 增加到 :supporter',
            ],
            'more_beatmaps' => [
                'title' => '上传更多谱面',
                'description' => '普通玩家的 Pending 谱面位数量上限为 :base，支持玩家为 :supporter_base，并且每拥有一张 Ranked 谱面，能提升 :bonus 张上限（支持玩家能提升 :supporter_bonus 张），普通玩家最多提升到 :bonus_max 张，支持玩家最多提升到 :supporter_bonus_max 张。',
            ],
            'friend_filtering' => [
                'title' => '好友排行榜',
                'description' => '和你的朋友们一起竞赛，看看你如何在排名上超过他们！',
            ],

        ],
        'supporter_status' => [
            'contribution' => '感谢您一直以来的支持！您已经捐赠了 :dollars 并购买了 :tags 次支持者标签！',
            'gifted' => "您已经捐赠了 :giftedTags 次支持者标签（花费了 :giftedDollars ），真慷慨啊！",
            'not_yet' => "您还没有支持者标签 :(",
            'valid_until' => '您的支持者标签将在 :date 到期',
            'was_valid_until' => '您的支持者标签已于 :date 到期',
        ],
    ],
];

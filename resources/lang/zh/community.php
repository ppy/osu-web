<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'support' => [
        'convinced' => [
            'title' => '太棒了，买买买！OwO',
            'support' => '支持 osu!',
            'gift' => '或者以礼物方式赠送给其它玩家',
            'instructions' => '点击爱心前往 osu! 商店',
        ],
        'why-support' => [
            'title' => '为什么支持 osu!？钱将用往何处？',

            'team' => [
                'title' => '支持开发团队',
                'description' => '一个小团队开发并维护着 osu!，你的支持可以帮助他们继续下去。',
            ],
            'infra' => [
                'title' => '维护服务器',
                'description' => '资金将用于维护网站和在线游玩、排行榜等服务',
            ],
            'featured-artists' => [
                'title' => '精选艺术家',
                'description' => '在你的支持下，我们可以与更多艺术家合作为 osu! 带来更多的绝佳音乐。',
                'link_text' => '查看当前列表 &raquo;',
            ],
            'ads' => [
                'title' => '维持 osu! 自给自足',
                'description' => '你的帮助可以让游戏保持独立并远离广告，不受外部赞助商的控制。',
            ],
            'tournaments' => [
                'title' => '官方比赛',
                'description' => '为运营 osu! 世界杯筹集资金（及奖励）。',
                'link_text' => '探索比赛 &raquo;',
            ],
            'bounty-program' => [
                'title' => '开源赏金计划',
                'description' => '支持那些花费时间与精力来帮助 osu! 变得更好的社区贡献者。',
                'link_text' => '了解更多 &raquo;',
            ],
        ],
        'perks' => [
            'title' => 'Wow，Awesome！那么我能得到什么？',
            'osu_direct' => [
                'title' => 'osu!direct',
                'description' => '在游戏客户端内搜索和下载谱面。',
            ],

            'friend_ranking' => [
                'title' => '好友排名',
                'description' => "在游戏内与网站上查看谱面排行榜，了解你与好友孰强孰弱。",
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
                'description' => '本地没有需要的谱面时，osu! 会自动下载！',
            ],

            'upload_more' => [
                'title' => '上传更多谱面',
                'description' => '谱面集中 Pending 谱面上限增加到 10 张。',
            ],

            'early_access' => [
                'title' => '抢先体验',
                'description' => '抢先体验正在测试中的新特性！<br/><br/>同时还包含网站的新功能！',
            ],

            'customisation' => [
                'title' => '个性化',
                'description' => "自定义个人资料页。",
            ],

            'beatmap_filters' => [
                'title' => '筛选谱面',
                'description' => '可在搜索谱面时以更多调件筛选，例如游玩状态和得分评价。',
            ],

            'yellow_fellow' => [
                'title' => '用户名高亮',
                'description' => '聊天时，用户名会变成亮黄色。',
            ],

            'speedy_downloads' => [
                'title' => '高速下载',
                'description' => '更快的下载速度。使用 osu!direct 的话甚至会更快。',
            ],

            'change_username' => [
                'title' => '修改用户名',
                'description' => '你能得到一次免费修改用户名的机会。',
            ],

            'skinnables' => [
                'title' => '更多的皮肤',
                'description' => '自定义更多的游戏界面元素，例如主菜单的背景。',
            ],

            'feature_votes' => [
                'title' => '新特性投票',
                'description' => '为新功能投票（每月 2 票）。',
            ],

            'sort_options' => [
                'title' => '详细的排名',
                'description' => '查看排名时可按 国家/好友/所选MOD 进行排名。',
            ],

            'more_favourites' => [
                'title' => '更大的收藏夹',
                'description' => '你的谱面收藏夹容量将从 :normally 个增加到 :supporter 个',
            ],
            'more_friends' => [
                'title' => '更多好友位',
                'description' => '你的好友位数量将从 :normally 增加到 :supporter',
            ],
            'more_beatmaps' => [
                'title' => '上传更多谱面，肝更多谱',
                'description' => '同一时间你能拥有的未 ranked 的谱面数量由一个基数值和附加奖励相加得到，附加奖励根据你已 ranked 的谱面数量而定，并且有一个上限。<br/><br/>通常情况下，基数为4，每多一张 ranked 的谱面会增加 1，最多增加 2。当你是支持者时，基数变为8，每张 ranked 的谱面会增加 1，最多增加 12。',
            ],
            'friend_filtering' => [
                'title' => '好友排行榜',
                'description' => '和你的朋友们一起比赛，看看你如何超过他们的排名！*<br/><br/><small>* 在新版网站上目前尚不支持此功能，即将上线 (tm)</small>',
            ],

        ],
        'supporter_status' => [
            'contribution' => '感谢你一直以来的支持！你已经捐赠了 :dollars 并购买了 :tags 次支持者标签！',
            'gifted' => "你已经捐赠了 :giftedTags 次支持者标签（花费了 :giftedDollars ），真慷慨啊！",
            'not_yet' => "你还没有支持者标签 :(",
            'valid_until' => '你的支持者标签将在 :date 到期',
            'was_valid_until' => '你的支持者标签已于 :date 到期',
        ],
    ],
];

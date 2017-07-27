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
    'deleted' => '[已删除的用户]', //TODO 需要上下文

    'login' => [
        '_' => '登录',
        'locked_ip' => '您的IP已被锁定，请稍等几分钟',
        'username' => '用户名',
        'password' => '密码',
        'button' => '登录',
        'button_posting' => '登录中...',
        'remember' => '记住此电脑',
        'title' => '登录以继续',
        'failed' => '登录失败',
        'register' => '没有 osu! 账户？现在注册一个吧',
        'forgot' => '忘记密码？',
        'beta' => [ //已弃用(?)
            'main' => 'Beta 仅限于特定用户访问',
            'small' => '（捐赠玩家将在不久开放）',
        ],

        'here' => '这里', // this is substituted in when generating a link above. change it to suit the language. //TODO 需要上下文
    ],
    'signup' => [
        '_' => '注册',
    ],
    'anonymous' => [
        'login_link' => '点击登录',
        'username' => '游客',
        'error' => '请先登录',
    ],
    'logout_confirm' => '你确定要退出吗？(^·ω·^ )',
    'restricted_banner' => [
        'title' => '账户已受限！',
        'message' => '在被限制时，不能与其他玩家互动，并且您的分数只有您自己可见。该限制通常由系统自动给予，并将在24小时内解除。如果您需要申诉，请<a href="mailto:accounts@ppy.sh">联系客服</a>.',
    ],
    'show' => [
        '404' => '找不到指定的用户',
        'age' => ':age 岁',
        'current_location' => '现在在 :location',
        'first_members' => '最初的用户', //TODO 需要上下文
        'is_developer' => 'osu! 开发者',
        'is_supporter' => 'osu! 支持者',
        'joined_at' => '注册时间：:date',
        'lastvisit' => '上次登录：:date',
        'missingtext' => '您可能输错了！（或者该用户已经被 ban）',
        'origin_age' => ':age 岁',
        'origin_country' => '来自 :country',
        'origin_country_age' => ':age，来自 :country',
        'page_description' => 'osu! - 你想知道的关于 :username 的一切!',
        'plays_with' => '惯用 :devices',
        'title' => ':username 的个人资料',

        'edit' => [
            'cover' => [
                'button' => '更换个人资料皮肤',
                'defaults_info' => '在将来会有更多皮肤可用',
                'upload' => [
                    'broken_file' => '上传失败.请检查上传的图片然后重试.',
                    'button' => '上传图片',
                    'dropzone' => '拖拽到此处',
                    'dropzone_info' => '将图片拖动到这里也可以上传',
                    'restriction_info' => "自定义皮肤只有 <a href='".osu_url('support-the-game')."' target='_blank'>osu!支持者</a> 可用",
                    'size_info' => '图片尺寸应为2000x500',
                    'too_large' => '上传的图片过大.',
                    'unsupported_format' => '不支持的格式.',
                ],
            ],
        ],
        'extra' => [
            'followers' => '粉丝：:count',
            'unranked' => '最近没有玩过',

            'achievements' => [
                'title' => '成就',
                'achieved-on' => '达成于 :date',
            ],
            'beatmaps' => [
                'title' => '谱面',
            ],
            'historical' => [
                'empty' => '没有游戏记录。:(',
                'most_played' => [
                    'count' => '游玩次数',
                    'title' => '玩得最多的谱面',
                ],
                'recent_plays' => [
                    'accuracy' => '准确率：:percentage',
                    'title' => '最近游玩',
                ],
                'title' => '历史记录',
            ],
            'kudosu' => [
                'available' => '可用 kudosu',
                'available_info' => 'kudosu 可以兑换为 kudosu 星,它可以让你的谱面更引人注意。这是你还没有兑换的 kudosu 数。',
                'recent_entries' => '最近 Kudosu 记录',
                'title' => 'Kudosu!',
                'total' => '总共获得 kudosu',
                'total_info' => '取决于您对制谱的贡献如何。查看 <a href="'.osu_url('user.kudosu').'">这个页面</a> 以得到更多信息。',

                'entry' => [
                    'amount' => ':amount kudosu',
                    'empty' => '该用户还没有收到过 kudosu ！',

                    'beatmap_discussion' => [ //TODO 专有名词太多,需要帮助
                        'allow_kudosu' => [
                            'give' => 'Received :amount from kudosu deny repeal of modding post :post',
                        ],

                        'deny_kudosu' => [
                            'reset' => 'Denied :amount from modding post :post',
                        ],

                        'delete' => [
                            'reset' => 'Lost :amount from modding post deletion of :post',
                        ],

                        'restore' => [
                            'give' => 'Received :amount from modding post restoration of :post',
                        ],

                        'vote' => [
                            'give' => 'Received :amount from obtaining votes in modding post of :post',
                            'reset' => 'Lost :amount from losing votes in modding post of :post',
                        ],
                    ],

                    'forum_post' => [
                        'give' => 'Received :amount from :giver for a post at :post',
                        'reset' => 'Kudosu reset by :giver for the post :post',
                        'revoke' => 'Denied kudosu by :giver for the post :post',
                    ],
                ],
            ],
            'me' => [
                'title' => '关于我！',
            ],
            'medals' => [
                'empty' => '该用户还没有获得奖章。;_;',
                'title' => '奖章',
            ],
            'recent_activities' => [
                'title' => '最近活动',
            ],
            'top_ranks' => [ //翻译可能不准确
                'best' => [
                    'title' => '最佳表现',
                ],
                'empty' => '还没有最佳表现。 :(',
                'first' => [
                    'title' => '第一名',
                ],
                'pp' => ':amountpp',
                'title' => '表现',
                'weighted_pp' => '权重：:pp (:percentage)',
            ],
            'beatmaps' => [
                'title' => '谱面',
                'favourite' => [
                    'title' => '收藏的谱面 (:count)',
                ],
                'ranked_and_approved' => [
                    'title' => 'Ranked并且得到赞的谱面 (:count)',
                ],
                'none' => '暂时没有...',
            ],
        ],
        'page' => [
            'description' => '<strong>关于我！</strong> 是您可以自定义的展示区.',
            'edit_big' => '编辑',
            'placeholder' => '在这里编辑',
            'restriction_info' => "您需要成为 <a href='".osu_url('support-the-game')."' target='_blank'>osu!支持者</a> 以解锁该特性.",
        ],
        'rank' => [
            'country' => ':mode 模式的国内排名',
            'global' => ':mode 模式的全球排名',
        ],
        'stats' => [
            'hit_accuracy' => '准确率',
            'level' => '等级 :level',
            'maximum_combo' => '最大连击',
            'play_count' => '游玩次数',
            'ranked_score' => 'Ranked谱面总分', //Ranked不翻译
            'replays_watched_by_others' => '回放被观看次数',
            'score_ranks' => '得分等级',
            'total_hits' => '总命中次数', //或许不翻译hit更好
            'total_score' => '总分',
        ],
    ],
    'status' => [
        'online' => '在线',
        'offline' => '离线',
    ],
    'verify' => [
        'title' => '账户认证',
    ],
];

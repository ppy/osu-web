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
    'deleted' => '[deleted user]', //TODO 需要上下文

    'login' => [
        '_' => '登录',
        'locked_ip' => '您的IP已被锁定.请稍等几分钟.',
        'username' => '用户名',
        'password' => '密码',
        'button' => '登录',
        'remember' => '记住此电脑',
        'title' => '登录以继续',
        'failed' => '登录失败',
        'register' => "没有 osu! 账户? 现在注册一个吧",
        'forgot' => '忘记密码?',
        'beta' => [
            'main' => 'Beta access is currently restricted to privileged users.', //TODO 需要上下文
            'small' => '(supporters will get in soon)', //TODO 需要上下文
        ],

        'here' => '此处', // this is substituted in when generating a link above. change it to suit the language. //TODO 需要上下文
    ],
    'signup' => [
        '_' => '注册',
    ],
    'anonymous' => [
        'login_link' => '点击登录',
        'username' => '游客',
        'error' => '请先登录.',
    ],
    'logout_confirm' => '你确定要退出吗? :(',
    'show' => [
        '404' => '找不到指定的用户',
        'current_location' => '现在在 :location.',
        'edit' => [
            'cover' => [
                'button' => '更换个人资料皮肤',
                'defaults_info' => '在将来会有更多皮肤可用',
                'upload' => [
                    'broken_file' => '上传失败.请检查上传的图片然后重试.',
                    'button' => '上传图片',
                    'dropzone' => '拖拽到此处',
                    'dropzone_info' => '将图片拖动到这里也可以上传',
                    'restriction_info' => "自定义皮肤只有<a href='".osu_url('support-the-game')."' target='_blank'>osu!支持者</a>可用",
                    'size_info' => '图片尺寸应为2000x500',
                    'too_large' => '上传的图片过大.',
                    'unsupported_format' => '不支持的格式.',
                ],
            ],
        ],
        'extra' => [
            'achievements' => [
                'title' => '成就',
                'achieved-on' => '达成于 :date',
            ],
            'beatmaps' => [
                'title' => '谱面',
            ],
            'historical' => [
                'empty' => '没有游戏记录. :(',
                'most_played' => [
                    'count' => '游玩次数',
                    'title' => '玩得最多的谱面',
                ],
                'recent_plays' => [
                    'accuracy' => '准确率: :percentage',
                    'title' => '最近游玩',
                ],
                'title' => '历史记录',
            ],
            'performance' => [
                'title' => '排名',
            ],
            'kudosu' => [
                'available' => '可用 Kudosu',
                'available_info' => 'Kudosu 可以兑换为 kudosu 星,它可以让你的谱面更引人注意. 这是你还没有兑换的 kudosu 数量.',
                'recent_entries' => '最近 Kudosu 记录',
                'title' => 'Kudosu!',
                'total' => '总共获得 Kudosu',
                'total_info' => '取决于您对制谱的贡献如何. 查看 <a href="'.osu_url('user.kudosu').'">这个页面</a> 以得到更多信息.',

                'entry' => [
                    'amount' => ':amount kudosu', //TODO 需要上下文
                    'empty' => "该用户还没有收到过 kudosu!",

                    'beatmap_discussion' => [
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
                        'give' => 'Received :amount kudosu from :giver for a post at :post',
                        'revoke' => 'Denied kudosu by :giver for the post :post',
                    ],
                ],
            ],
            'me' => [
                'title' => 'me!',
            ],
            'medals' => [
                'empty' => "This user hasn't gotten any yet. ;_;",
                'title' => 'Medals',
            ],
            'recent_activities' => [
                'title' => 'Recent',
            ],
            'top_ranks' => [
                'best' => [
                    'title' => 'Best Performance',
                ],
                'empty' => 'No awesome performance records yet. :(',
                'first' => [
                    'title' => 'First Place Ranks',
                ],
                'pp' => ':amountpp',
                'title' => 'Ranks',
                'weighted_pp' => 'weighted: :pp (:percentage)',
            ],
            'beatmaps' => [
                'title' => 'Beatmaps',
                'favourite' => [
                    'title' => 'Favourite Beatmaps (:count)',
                ],
                'ranked_and_approved' => [
                    'title' => 'Ranked & Approved Beatmaps (:count)',
                ],
                'none' => 'None... yet.',
            ],
        ],
        'first_members' => 'here since the beginning',
        'is_supporter' => 'osu!supporter',
        'is_developer' => 'osu!developer',
        'lastvisit' => 'Last seen :date.',
        'joined_at' => 'joined :date',
        'more_achievements' => 'and more',
        'origin' => [
            'age' => ':age years old.',
            'country' => 'From :country.',
            'country_age' => ':age years old from :country.',
        ],
        'page' => [
            'description' => '<strong>me!</strong> is a personal customisable area in your profile page.',
            'edit_big' => 'Edit me!',
            'placeholder' => 'Type page content here',
            'restriction_info' => "You need to be an <a href='".osu_url('support-the-game')."' target='_blank'>osu!supporter</a> to unlock this feature.",
        ],
        'plays_with' => [
            '_' => 'Plays with',
            'keyboard' => 'Keyboard',
            'mouse' => 'Mouse',
            'tablet' => 'Tablet',
            'touch' => 'Touch Screen',
        ],
        'missingtext' => 'You might have made a typo! (or the user may have been banned)',
        'page_description' => 'osu! - Everything you ever wanted to know about :username!',
        'rank' => [
            'country' => 'Country rank for :mode',
            'global' => 'Global rank for :mode',
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
        'title' => ":username 的个人资料",
    ],

    'verify' => [
        'title' => '账户认证',
    ],
];

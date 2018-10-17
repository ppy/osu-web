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
    'deleted' => '[被删除的用户]',

    'beatmapset_activities' => [
        'title' => ":user 的摸图历史",

        'discussions' => [
            'title_recent' => '最近打开的讨论',
        ],

        'events' => [
            'title_recent' => '最近事件',
        ],

        'posts' => [
            'title_recent' => '最近帖子',
        ],

        'votes_received' => [
            'title_most' => '得赞最多（最近三个月）',
        ],

        'votes_made' => [
            'title_most' => '赞数最多（最近三个月）',
        ],
    ],

    'blocks' => [
        'banner_text' => '你已经屏蔽此用户。',
        'blocked_count' => '被屏蔽的用户 (:count)',
        'hide_profile' => '隐藏用户资料',
        'not_blocked' => '此用户未被屏蔽。',
        'show_profile' => '显示用户资料',
        'too_many' => '屏蔽用户数量达到最大限制。',
        'button' => [
            'block' => '屏蔽',
            'unblock' => '解除屏蔽',
        ],
    ],

    'card' => [
        'loading' => '加载中...',
        'send_message' => '发送消息',
    ],

    'login' => [
        '_' => '登录',
        'locked_ip' => 'IP 已被锁定，请稍等几分钟',
        'username' => '用户名',
        'password' => '密码',
        'button' => '登录',
        'button_posting' => '登录中...',
        'remember' => '记住此电脑',
        'title' => '登录以继续',
        'failed' => '登录失败',
        'register' => "没有 osu! 账户？现在就注册一个！",
        'forgot' => '忘记密码？',
        'beta' => [
            'main' => 'Beta 仅限于特定用户访问',
            'small' => '（在不久后将对 osu!支持者 开放）',
        ],

        'here' => '这里', // this is substituted in when generating a link above. change it to suit the language.
    ],

    'posts' => [
        'title' => ':username 的帖子',
    ],

    'signup' => [
        '_' => '注册',
    ],
    'anonymous' => [
        'login_link' => '点击登录',
        'login_text' => '登录',
        'username' => '游客',
        'error' => '请先登录',
    ],
    'logout_confirm' => '确定要退出吗？o(TヘTo)',
    'report' => [
        'button_text' => '举报',
        'comments' => '附加信息',
        'placeholder' => '请提供你认为可能有用的所有信息。',
        'reason' => '原因',
        'thanks' => '感谢你的报告！',
        'title' => '举报 :username ？',

        'actions' => [
            'send' => '发送报告',
            'cancel' => '取消',
        ],

        'options' => [
            'cheating' => '违规 / 作弊',
            'insults' => '侮辱 我/其他人',
            'spam' => '刷屏/垃圾广告',
            'unwanted_content' => '发布包含不当内容的链接',
            'nonsense' => '无意义内容',
            'other' => '其他（在下方输入原因）',
        ],
    ],
    'restricted_banner' => [
        'title' => '账户进入限制模式！',
        'message' => '在被限制时，无法与其他玩家互动，分数只有自己可见。该限制通常由系统自动给予，并将在24小时内解除。需要申诉？请<a href="mailto:accounts@ppy.sh">联系支持团队</a>.',
    ],
    'show' => [
        'age' => ':age 岁',
        'change_avatar' => '更换头像！',
        'first_members' => '元老玩家',
        'is_developer' => 'osu! 开发者',
        'is_supporter' => 'osu!supporter',
        'joined_at' => '注册时间：:date',
        'lastvisit' => '上次登录：:date',
        'missingtext' => '未找到用户！（或者该用户已经被 ban）',
        'origin_country' => '来自 :country',
        'page_description' => 'osu! - 你想知道的关于 :username 的一切!',
        'previous_usernames' => '曾用名',
        'plays_with' => '惯用 :devices',
        'title' => ":username 的个人资料",

        'edit' => [
            'cover' => [
                'button' => '更换个人资料头图',
                'defaults_info' => '在将来会有更多头图可用',
                'upload' => [
                    'broken_file' => '上传失败.请检查上传的图片然后重试.',
                    'button' => '上传图片',
                    'dropzone' => '拖拽到此处',
                    'dropzone_info' => '将图片拖动到这里也可以上传',
                    'restriction_info' => "自定义头图只有 <a href='".route('store.products.show', 'supporter-tag')."' target='_blank'>osu!supporter</a> 可用",
                    'size_info' => '图片大小最好是 2000x700 像素',
                    'too_large' => '上传的图片过大。',
                    'unsupported_format' => '不支持的格式。',
                ],
            ],

            'default_playmode' => [
                'is_default_tooltip' => '默认游戏模式',
                'set' => '设置 :mode 为个人资料的默认游戏模式',
            ],
        ],

        'extra' => [
            'followers' => '关注者：:count',
            'unranked' => '最近没有玩过',

            'achievements' => [
                'title' => '成就',
                'achieved-on' => '达成于 :date',
            ],
            'beatmaps' => [
                'none' => '暂时没有...',
                'title' => '谱面',

                'favourite' => [
                    'title' => '收藏的谱面 (:count)',
                ],
                'graveyard' => [
                    'title' => '坟场里的谱面 (:count)',
                ],
                'loved' => [
                    'title' => 'Loved 的谱面 (:count)',
                ],
                'ranked_and_approved' => [
                    'title' => 'Ranked & Approved 的谱面 (:count)',
                ],
                'unranked' => [
                    'title' => 'Pending 的谱面 (:count)',
                ],
            ],
            'historical' => [
                'empty' => '没有游戏记录。:(',
                'title' => '历史记录',

                'monthly_playcounts' => [
                    'title' => '游玩记录',
                ],
                'most_played' => [
                    'count' => '游玩次数',
                    'title' => '玩得最多的谱面',
                ],
                'recent_plays' => [
                    'accuracy' => '准确率：:percentage',
                    'title' => '最近24小时游玩',
                ],
                'replays_watched_counts' => [
                    'title' => '回放被观看记录',
                ],
            ],
            'kudosu' => [
                'available' => '可用 kudosu',
                'available_info' => "kudosu 可以兑换为 kudosu 星,它可以让你的谱面更引人注意。这是你还没有兑换的 kudosu 数。",
                'recent_entries' => '最近 Kudosu 记录',
                'title' => 'Kudosu!',
                'total' => '总共获得 kudosu',
                'total_info' => '取决于你对制谱的贡献如何。查看 <a href="'.osu_url('user.kudosu').'">这个页面</a> 以得到更多信息。',

                'entry' => [
                    'amount' => ':amount kudosu',
                    'empty' => "该用户还没有收到过 kudosu ！",

                    'beatmap_discussion' => [
                        'allow_kudosu' => [
                            'give' => '因讨论帖 :post 的 kudosu 移除操作的撤销而获得 :amount',
                        ],

                        'deny_kudosu' => [
                            'reset' => '在讨论帖 :post 中被移除 :amount',
                        ],

                        'delete' => [
                            'reset' => '因讨论帖 :post 被删除而失去 :amount',
                        ],

                        'restore' => [
                            'give' => '因讨论帖 :post 被恢复而获得 :amount',
                        ],

                        'vote' => [
                            'give' => '因在讨论帖 :post 中得到了足够票数而获得 :amount',
                            'reset' => '因在讨论帖 :post 中丢失了票数而失去 :amount',
                        ],

                        'recalculate' => [
                            'give' => '因讨论帖 :post 的投票重新计算而获得 :amount',
                            'reset' => '因讨论帖 :post 的投票重新计算而失去 :amount',
                        ],
                    ],

                    'forum_post' => [
                        'give' => '在帖子 :post 中被 :giver 给予 :amount ',
                        'reset' => '在帖子 :post 中被 :giver 重置 kudosu ',
                        'revoke' => '在帖子 :post 中被 :giver 移除 kudosu ',
                    ],
                ],
            ],
            'me' => [
                'title' => '个人介绍',
            ],
            'medals' => [
                'empty' => "该用户还没有获得成就。;_;",
                'title' => '成就',
            ],
            'recent_activity' => [
                'title' => '最近活动',
            ],
            'top_ranks' => [
                'empty' => '还没有上传过成绩。 :(',
                'not_ranked' => '只有 ranked 谱面才能得到 pp。',
                'pp' => ':amountpp',
                'title' => '成绩',
                'weighted_pp' => '权重：:pp (:percentage)',

                'best' => [
                    'title' => '最好成绩',
                ],
                'first' => [
                    'title' => '第一名',
                ],
            ],
            'account_standing' => [
                'title' => '帐号状态',
                'bad_standing' => "<strong>:username</strong> 的帐号存在不良记录 :(",
                'remaining_silence' => '<strong>:username</strong> 的禁言将在 :duration 解除',

                'recent_infringements' => [
                    'title' => '最近记录',
                    'date' => '时间',
                    'action' => '处理',
                    'length' => '时长',
                    'length_permanent' => '永久',
                    'description' => '原因',
                    'actor' => '裁决者： :username',

                    'actions' => [
                        'restriction' => '封禁',
                        'silence' => '禁言',
                        'note' => '注释',
                    ],
                ],
            ],
        ],
        'info' => [
            'discord' => 'Discord',
            'interests' => '兴趣爱好',
            'lastfm' => 'Last.fm',
            'location' => '所在地',
            'occupation' => '职业',
            'skype' => 'Skype',
            'twitter' => 'Twitter',
            'website' => '网站',
        ],
        'not_found' => [
            'reason_1' => '他可能换了用户名。',
            'reason_2' => '该帐号由于安全或滥用问题暂时不可用。',
            'reason_3' => '你可能输错用户名了！',
            'reason_header' => '可能是由于以下原因：',
            'title' => '找不到指定的用户',
        ],
        'page' => [
            'description' => '<strong>个人介绍</strong> 是您可以自定义的展示区.',
            'edit_big' => '编辑',
            'placeholder' => '在这里编辑',
            'restriction_info' => "需要成为 <a href='".route('store.products.show', 'supporter-tag')."' target='_blank'>osu!supporter</a> 以解锁该特性.",
        ],
        'post_count' => [
            '_' => '发表了 :link',
            'count' => ':count 篇帖子',
        ],
        'rank' => [
            'country' => ':mode 模式的国内排名',
            'global' => ':mode 模式的全球排名',
        ],
        'stats' => [
            'hit_accuracy' => '准确率',
            'level' => '等级 :level',
            'maximum_combo' => '最大连击',
            'play_count' => '游戏次数',
            'play_time' => '游戏时间',
            'ranked_score' => 'Ranked 谱面总分',
            'replays_watched_by_others' => '回放被观看次数',
            'score_ranks' => '得分等级',
            'total_hits' => '总命中次数',
            'total_score' => '总分',
        ],
    ],
    'status' => [
        'online' => '在线',
        'offline' => '离线',
    ],
    'store' => [
        'saved' => '账户已创建',
    ],
    'verify' => [
        'title' => '账户认证',
    ],
];

<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'edit' => [
        'title_compact' => '账户设置',
        'username' => '用户名',

        'avatar' => [
            'title' => '头像',
            'reset' => '重置',
            'rules' => '请确保你的头像符合:link。<br/>这意味着头像内容必须是<strong>全年龄的</strong>，即没有裸露、亵渎或暗示的内容。',
            'rules_link' => '视觉内容注意事项',
        ],

        'email' => [
            'new' => '新邮箱地址',
            'new_confirmation' => '确认新邮箱地址',
            'title' => '邮箱',
            'locked' => [
                '_' => '如果您想修改邮箱地址，请联系:accounts。',
                'accounts' => '账号支持团队',
            ],
        ],

        'legacy_api' => [
            'api' => 'api',
            'irc' => 'irc',
            'title' => '旧版本 API',
        ],

        'password' => [
            'current' => '当前密码',
            'new' => '新密码',
            'new_confirmation' => '确认新密码',
            'title' => '密码',
        ],

        'profile' => [
            'country' => '国家或地区',
            'title' => '个人资料',

            'country_change' => [
                '_' => "您的个人资料所在国家或地区似乎与您的居住地不符。:update_link。",
                'update_link' => '更新为 :country',
            ],

            'user' => [
                'user_discord' => '',
                'user_from' => '当前位置',
                'user_interests' => '兴趣爱好',
                'user_occ' => '职业',
                'user_twitter' => '',
                'user_website' => '个人网站',
            ],
        ],

        'signature' => [
            'title' => '个性签名',
            'update' => '更新',
        ],
    ],

    'github_user' => [
        'info' => "如果你是 osu! 开源仓库的贡献者，在这里填写你 GitHub 的账号，可以将你的更新日志条目与 osu! 个人主页绑定起来。如果 GitHub 账号没有历史提交记录，则无法绑定。",
        'link' => '绑定 GitHub 账号',
        'title' => 'GitHub',
        'unlink' => '解绑 GitHub 账号',

        'error' => [
            'already_linked' => '这个 GitHub 账号已经绑定到另一个玩家账号上。',
            'no_contribution' => '无法绑定在 osu! 仓库中没有任何贡献记录的 GitHub 账号。',
            'unverified_email' => '请在你 GitHub 账号的首选邮箱中完成验证，然后重新绑定账号。',
        ],
    ],

    'notifications' => [
        'beatmapset_discussion_qualified_problem' => '接收以下游戏模式在过审 (Qualified) 谱面上的新问题通知：',
        'beatmapset_disqualify' => '接收以下游戏模式谱面下架 (DQ) 时的通知：',
        'comment_reply' => '在你的评论被回复时接收通知',
        'news_post' => '',
        'title' => '通知',
        'topic_auto_subscribe' => '自动启用自己创建的主题的通知',

        'options' => [
            '_' => '推送设置',
            'beatmap_owner_change' => '客串难度',
            'beatmapset:modding' => '谱面摸图',
            'channel_message' => '私信',
            'channel_team' => '战队聊天消息',
            'comment_new' => '新评论',
            'forum_topic_reply' => '主题回复',
            'mail' => '邮件',
            'mapping' => '谱师',
            'news_post' => '',
            'push' => '推送',
        ],
    ],

    'oauth' => [
        'authorized_clients' => '已授权的第三方应用',
        'own_clients' => '拥有的客户端',
        'title' => '开放授权',
    ],

    'options' => [
        'beatmapset_show_nsfw' => '隐藏不良内容谱面提示',
        'beatmapset_title_show_original' => '以原语言显示谱面信息',
        'title' => '选项',

        'beatmapset_download' => [
            '_' => '默认谱面下载类型',
            'all' => '包含视频（若可用）',
            'direct' => '在 osu!direct 中查看',
            'no_video' => '不包含视频',
        ],
    ],

    'playstyles' => [
        'keyboard' => '键盘',
        'mouse' => '鼠标',
        'tablet' => '数位板',
        'title' => '游戏方式',
        'touch' => '触摸屏',
    ],

    'privacy' => [
        'friends_only' => '屏蔽来自陌生人的私信',
        'hide_online' => '隐藏在线状态',
        'hide_online_info' => '将同步到 osu!lazer 的隐身模式',
        'title' => '隐私',
    ],

    'security' => [
        'current_session' => '当前',
        'end_session' => '终止会话',
        'end_session_confirmation' => '这将立刻结束该设备上的会话，你确定吗？',
        'last_active' => '上次登录：',
        'title' => '安全',
        'web_sessions' => '网页会话',
    ],

    'update_email' => [
        'update' => '更新',
    ],

    'update_password' => [
        'update' => '更新',
    ],

    'user_totp' => [
        'title' => '身份验证器应用',
        'usage_note' => '使用身份验证器应用而不是电子邮件进行验证。电子邮件验证仍会作为备用选项。',

        'button' => [
            'remove' => '移除',
            'setup' => '添加身份验证器应用',
        ],
        'status' => [
            'label' => '状态',
            'not_set' => '未设置',
            'set' => '已设置',
        ],
    ],

    'verification_completed' => [
        'text' => '现在可以关闭此窗口',
        'title' => '验证已经完成',
    ],

    'verification_invalid' => [
        'title' => '无效或过期的验证链接',
    ],
];

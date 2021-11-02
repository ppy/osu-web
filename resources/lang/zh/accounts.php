<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'edit' => [
        'title_compact' => '设置',
        'username' => '用户名',

        'avatar' => [
            'title' => '头像',
            'rules' => '请确保你的头像符合 :link。<br/>这意味着头像内容必须是<strong>全年龄的</strong>，即没有裸露、亵渎或暗示的内容。',
            'rules_link' => '社区规则',
        ],

        'email' => [
            'current' => '当前邮箱地址',
            'new' => '新邮箱地址',
            'new_confirmation' => '确认新邮箱地址',
            'title' => '邮箱',
        ],

        'password' => [
            'current' => '当前密码',
            'new' => '新密码',
            'new_confirmation' => '确认新密码',
            'title' => '密码',
        ],

        'profile' => [
            'title' => '个人资料',

            'user' => [
                'user_discord' => '',
                'user_from' => '当前位置',
                'user_interests' => '兴趣爱好',
                'user_occ' => '职业',
                'user_twitter' => '',
                'user_website' => '个人主页',
            ],
        ],

        'signature' => [
            'title' => '个性签名',
            'update' => '更新',
        ],
    ],

    'notifications' => [
        'beatmapset_discussion_qualified_problem' => '在以下模式的合格谱面上接收新问题通知：',
        'beatmapset_disqualify' => '在以下模式的谱面被标记为不合格时接收通知：',
        'comment_reply' => '在你的评论被回复时接收通知',
        'title' => '通知',
        'topic_auto_subscribe' => '自动启用自己创建的主题的通知',

        'options' => [
            '_' => '推送设置',
            'beatmap_owner_change' => '客串难度',
            'beatmapset:modding' => '谱面修改',
            'channel_message' => '私信',
            'comment_new' => '新评论',
            'forum_topic_reply' => '主题回复',
            'mail' => '邮件',
            'mapping' => '谱师',
            'push' => '推送',
            'user_achievement_unlock' => '成就解锁',
        ],
    ],

    'oauth' => [
        'authorized_clients' => '已授权的第三应用',
        'own_clients' => '拥有的客户端',
        'title' => '开放授权',
    ],

    'options' => [
        'beatmapset_show_nsfw' => '隐藏谱面少儿不宜提示',
        'beatmapset_title_show_original' => '以原语言显示谱面信息',
        'title' => '选项',

        'beatmapset_download' => [
            '_' => '默认谱面下载类型',
            'all' => '包含视频',
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

    'verification_completed' => [
        'text' => '现在可以关闭此窗口',
        'title' => '验证已经完成',
    ],

    'verification_invalid' => [
        'title' => '无效或过期的验证链接',
    ],
];

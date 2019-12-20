<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
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
    'edit' => [
        'title_compact' => '设置',
        'username' => '用户名',

        'avatar' => [
            'title' => '头像',
            'rules' => '请确保你的头像符合 :link。<br/>这意味着必须是<strong>全年龄</strong>头像。即没有裸露、亵渎或暗示的内容',
            'rules_link' => '社群规则',
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
                'user_discord' => 'discord',
                'user_from' => '当前位置',
                'user_interests' => '兴趣爱好',
                'user_msnm' => 'skype',
                'user_occ' => '职业',
                'user_twitter' => '推特',
                'user_website' => '个人主页',
            ],
        ],

        'signature' => [
            'title' => '签名',
            'update' => '更新',
        ],
    ],

    'notifications' => [
        'title' => '通知',
        'topic_auto_subscribe' => '自动启用自己创建的主题的通知',
        'beatmapset_discussion_qualified_problem' => '在以下模式的合格节拍图上接收新问题通知',

        'mail' => [
            '_' => '接收有关下列哪些的邮件通知？',
            'beatmapset:modding' => '谱面审核',
            'forum_topic_reply' => '帖子回复',
        ],
    ],

    'oauth' => [
        'authorized_clients' => '已授权的第三方',
        'own_clients' => '拥有的客户端',
        'title' => '开放授权',
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
        'title' => '隐私政策',
    ],

    'security' => [
        'current_session' => '当前',
        'end_session' => '终止会话',
        'end_session_confirmation' => '这将立刻结束该设备上的会话，你确定吗？',
        'last_active' => '上次使用：',
        'title' => '安全',
        'web_sessions' => '浏览器会话',
    ],

    'update_email' => [
        'update' => '更新',
    ],

    'update_password' => [
        'update' => '更新',
    ],

    'verification_completed' => [
        'text' => '现在可以关闭本窗口了',
        'title' => '验证已经完成',
    ],

    'verification_invalid' => [
        'title' => '无效或过期的验证链接',
    ],
];

<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
 */

return [
    'cancel' => '取消',

    'authorise' => [
        'authorise' => '授权',
        'request' => '正在请求访问你的账户',
        'scopes_title' => '该应用将可以：',
        'title' => '授权请求',

        'wrong_user' => [
            '_' => '你正以 :user 登录。:logout_link。',
            'logout_link' => '点此切换用户',
        ],
    ],

    'authorized_clients' => [
        'confirm_revoke' => '你确定要撤回给予的权限吗？',
        'scopes_title' => '此应用能够：',
        'owned_by' => '由 :user 拥有',
        'none' => '无授权第三方',

        'revoked' => [
            'false' => '撤除访问权限',
            'true' => '访问权限已被撤除',
        ],
    ],

    'client' => [
        'id' => '客户端 ID',
        'name' => '应用名称',
        'redirect' => '应用回调链接',
        'secret' => '客户端密钥',
    ],

    'login' => [
        'download' => '点此以下载游戏并创建账号',
        'label' => '首先，让我们登录你的账号',
        'title' => '账号登录',
    ],

    'new_client' => [
        'header' => '注册一个新的 OAuth 应用程序',
        'register' => '注册应用程序',
        'terms_of_use' => [
            '_' => '一旦使用此 API 将视为你已经同意了 :link 。',
            'link' => '使用条款',
        ],
    ],

    'own_clients' => [
        'confirm_delete' => '你确定想要删除这个客户端？',
        'new' => '新的 OAuth 应用',
        'none' => '没有客户端',

        'revoked' => [
            'false' => '删除',
            'true' => '已删除',
        ],
    ],
];

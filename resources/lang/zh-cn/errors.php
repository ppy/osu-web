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
    'codes' => [
        'http-403' => '拒绝访问.',
        'http-401' => '请先登录.',
    ],
    'account' => [
        'profile-order' => [
            'generic' => '发生未知错误,请尝试刷新页面.',
        ],
    ],
    'community' => [
        'slack' => [//TODO 不会翻译,需要帮助翻译
            'not-eligible' => 'Your account is not eligible for the Slack invite.',
            'slack-error' => 'An error has occured on the Slack servers. Please try again in a few minutes.',
        ],
    ],
    'beatmaps' => [//TODO 不会翻译,需要帮助翻译
        'standard-converts-only' => 'Only the osu! mode can have scores in other modes.',
    ],
    'beatmapsets' => [
        'too-many-favourites' => '您收藏的谱面过多,请删除一个后继续.',
    ],
    'logged_out' => '您已退出,请重新登录后重试.',
    'supporter_only' => '要使用此功能,请先成为捐赠者.',
    'no_restricted_access' => '账户受限,无法执行该操作.',
    'unknown' => '发生了未知的错误.',
];

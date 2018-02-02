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
    'event' => [
        'approve' => 'Approved.',
        'discussion_delete' => '管理员删除了 :discussion 。',
        'discussion_post_delete' => '管理员在 :discussion 中删除了这条回复。',
        'discussion_post_restore' => '管理员在 :discussion 中恢复了这条回复。',
        'discussion_restore' => '管理员恢复了 :discussion 。',
        'disqualify' => '该谱面因为 :text 被 DQ',
        'issue_reopen' => '问题 :discussion 被重新打开。',
        'issue_resolve' => '问题 :discussion 被标记为 “已解决”。',
        'kudosu_allow' => '讨论 :discussion 的 kudosu 移除操作已被重置。',
        'kudosu_deny' => '讨论 :discussion 所得的 kudosu 被移除。',
        'kudosu_gain' => '讨论 :discussion 获得了足够的票数而被给予 kudosu 。',
        'kudosu_lost' => '讨论 :discussion 失去了票数，并且所得 kudosu 已被移除。',
        'kudosu_recalculate' => '讨论 :discussion 所得的 kudosu 已经重新计算。',
        'nominate' => 'Nominated.',
        'nomination_reset' => '新问题 :discussion 导致提名被重置。',
        'qualify' => 'Qualified.',
        'rank' => 'Ranked.',
    ],

    'index' => [
        'title' => '谱面事件',
    ],

    'item' => [ //上下文
        'content' => '内容',
        'type' => '类型',
    ],
];

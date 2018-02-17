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
        'discussion_delete' => '管理員刪除了 :discussion 。',
        'discussion_post_delete' => '管理員在 :discussion 中刪除了這條回覆。',
        'discussion_post_restore' => '管理員在 :discussion 中恢復了這條回覆。',
        'discussion_restore' => '管理員恢復了 :discussion 。',
        'disqualify' => '該譜面因爲 :text 被 DQ',
        'issue_reopen' => '問題 :discussion 被重新打開。',
        'issue_resolve' => '問題 :discussion 被標記爲 “已解決”。',
        'kudosu_allow' => '討論 :discussion 的 kudosu 移除操作已被重置。',
        'kudosu_deny' => '討論 :discussion 所得的 kudosu 被移除。',
        'kudosu_gain' => '討論 :discussion 獲得了足夠的票數而被給予 kudosu 。',
        'kudosu_lost' => '討論 :discussion 失去了票數，並且所得 kudosu 已被移除。',
        'kudosu_recalculate' => '討論 :discussion 所得的 kudosu 已經重新計算。',
        'nominate' => 'Nominated.',
        'nomination_reset' => '新問題 :discussion 導致提名被重置。',
        'qualify' => 'Qualified.',
        'rank' => 'Ranked.',
    ],

    'index' => [
        'title' => '譜面事件',
    ],

    'item' => [ //上下文
        'content' => '內容',
        'type' => '類型',
    ],
];

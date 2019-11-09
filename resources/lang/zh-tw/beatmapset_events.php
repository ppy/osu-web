<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
 */

return [
    'event' => [
        'approve' => '已批准。',
        'discussion_delete' => '管理員刪除了 :discussion 。',
        'discussion_lock' => '此圖譜的討論已被禁用。（:text）',
        'discussion_post_delete' => '管理員在 :discussion 中刪除了這條回覆。',
        'discussion_post_restore' => '管理員在 :discussion 中恢復了這條回覆。',
        'discussion_restore' => '管理員已恢復 :discussion 。',
        'discussion_unlock' => '此圖譜的討論已被啟用。',
        'disqualify' => '由於 :discussion (:text) 被 :user DQ。',
        'disqualify_legacy' => '該圖譜因 :text 被 DQ',
        'issue_reopen' => '問題 :discussion 被重新打開。',
        'issue_resolve' => '問題 :discussion 被標記為 “已解決”。',
        'kudosu_allow' => '討論 :discussion 的 kudosu 移除操作已被重置。',
        'kudosu_deny' => '討論 :discussion 所得的 kudosu 被移除。',
        'kudosu_gain' => '討論 :discussion 獲得了足夠的票數而被給予 kudosu 。',
        'kudosu_lost' => '討論 :discussion 失去了票數，並且所得 kudosu 已被移除。',
        'kudosu_recalculate' => '討論 :discussion 所得的 kudosu 已經重新計算。',
        'love' => '受到 :user 的喜愛',
        'nominate' => '被 :user 提名',
        'nomination_reset' => '新問題 :discussion 導致提名被重置。',
        'qualify' => '這張譜面已經達到所需的提名數量，並已經 qualified。',
        'rank' => '進榜',
    ],

    'index' => [
        'title' => '圖譜事件',

        'form' => [
            'period' => '期間',
            'types' => '類型',
        ],
    ],

    'item' => [
        'content' => '內容',
        'discussion_deleted' => '[已刪除]',
        'type' => '類型',
    ],

    'type' => [
        'approve' => 'Approval',
        'discussion_delete' => '刪除討論',
        'discussion_post_delete' => '刪除討論的回覆',
        'discussion_post_restore' => '恢復已刪除的討論的回覆',
        'discussion_restore' => '恢復已刪除的討論',
        'disqualify' => 'Disqualification',
        'issue_reopen' => '重新打開討論',
        'issue_resolve' => '討論被解決',
        'kudosu_allow' => '給予 Kudosu',
        'kudosu_deny' => '收回 Kudosu',
        'kudosu_gain' => '獲得 Kudosu',
        'kudosu_lost' => '失去 Kudosu',
        'kudosu_recalculate' => '重新計算 Kudosu',
        'love' => 'Love',
        'nominate' => '被提名',
        'nomination_reset' => '被取消提名',
        'qualify' => 'Qualification',
        'rank' => 'Ranking',
    ],
];

<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'event' => [
        'approve' => '已批准。',
        'beatmap_owner_change' => '難度 :beatmap 的作者已變更為 :new_user。',
        'discussion_delete' => '管理員刪除了 :discussion。',
        'discussion_lock' => '這張圖譜的討論已被停用。（:text）',
        'discussion_post_delete' => '管理員在 :discussion 中刪除了這則回覆。',
        'discussion_post_restore' => '版主已將 :discussion 中的貼文還原。',
        'discussion_restore' => '版主已還原 :discussion 。',
        'discussion_unlock' => '這張圖譜的討論已被啟用。',
        'disqualify' => '這張圖譜因 :discussion(:text) 被 :user 取消資格。',
        'disqualify_legacy' => '該圖譜因 :text 被 :user 取消資格。',
        'genre_edit' => '曲風由 :old 變更為 :new。',
        'issue_reopen' => ':user 要求重審 :discussion_user 提出的問題 :discussion。',
        'issue_resolve' => ':user 已解決 :discussion_user 提出的問題 :discussion。',
        'kudosu_allow' => '討論串 :discussion 的遭拒的kudosu已被移除。',
        'kudosu_deny' => '討論 :discussion 所得的kudosu被移除。',
        'kudosu_gain' => ':user 的討論 :discussion 獲得了足夠的票數而被給予kudosu。',
        'kudosu_lost' => '討論 :discussion 失去了票數，並且所得 kudosu 已被移除。',
        'kudosu_recalculate' => '討論 :discussion 所得的kudosu已經重新計算。',
        'language_edit' => '語言從 :old 改為 :new。',
        'love' => '由 :user 加入至社群喜愛',
        'nominate' => '被 :user 提名',
        'nominate_modes' => '由 :user 提名 (:modes)。',
        'nomination_reset' => '新問題 :discussion（:text）導致提名被重設。',
        'nomination_reset_received' => ':source_user 重設了 :user 的提名 (:text)',
        'nomination_reset_received_profile' => ':user 重設了提名 (:text)',
        'offset_edit' => '線上偏移調整已從 :old 變更為 :new。',
        'qualify' => '這張圖譜已達到所需的提名次數，並已合格。',
        'rank' => '進榜',
        'remove_from_loved' => '由 :user 從社群喜愛中移除。(:text)',
        'tags_edit' => '標籤由「:old」變更為「:new」。',

        'nsfw_toggle' => [
            'to_0' => '移除成人內容標記',
            'to_1' => '標記為成人內容',
        ],
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
        'approve' => '批准',
        'beatmap_owner_change' => '難度作者變更',
        'discussion_delete' => '刪除討論',
        'discussion_post_delete' => '刪除討論的回覆',
        'discussion_post_restore' => '討論回覆還原',
        'discussion_restore' => '還原已刪除的討論',
        'disqualify' => '取消資格',
        'genre_edit' => '編輯曲風',
        'issue_reopen' => '重審問題',
        'issue_resolve' => '討論被解決',
        'kudosu_allow' => '給予kudosu',
        'kudosu_deny' => '收回kudosu',
        'kudosu_gain' => '獲得kudosu',
        'kudosu_lost' => '失去kudosu',
        'kudosu_recalculate' => '重新計算kudosu',
        'language_edit' => '變更語言',
        'love' => '加入至社群喜愛',
        'nominate' => '被提名',
        'nomination_reset' => '被取消提名',
        'nomination_reset_received' => '收到提名重設',
        'nsfw_toggle' => '成人內容標記',
        'offset_edit' => '編輯偏移',
        'qualify' => '合格',
        'rank' => '進榜',
        'remove_from_loved' => '移除社群喜愛',
    ],
];

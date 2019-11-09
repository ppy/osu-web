<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
 */

return [
    'event' => [
        'approve' => 'Approved.',
        'discussion_delete' => '管理员删除了 :discussion 。',
        'discussion_lock' => '针对该谱面的讨论已被禁用。（ :text ）',
        'discussion_post_delete' => '管理员在 :discussion 中删除了这条回复。',
        'discussion_post_restore' => '管理员在 :discussion 中恢复了这条回复。',
        'discussion_restore' => '管理员恢复了 :discussion 。',
        'discussion_unlock' => '针对该谱面的讨论已被启用。',
        'disqualify' => '由于 :discussion (:text) 被 :user DQ。',
        'disqualify_legacy' => '该谱面因为 :text 被 DQ。',
        'issue_reopen' => '已解决问题 :discussion 被重新打开。',
        'issue_resolve' => '问题 :discussion 被标记为 “已解决”。',
        'kudosu_allow' => '讨论 :discussion 的 kudosu 移除操作已被重置。',
        'kudosu_deny' => '讨论 :discussion 所得的 kudosu 被移除。',
        'kudosu_gain' => '讨论 :discussion 获得了足够的票数而被给予 kudosu 。',
        'kudosu_lost' => '讨论 :discussion 失去了票数，并且所得 kudosu 已被移除。',
        'kudosu_recalculate' => '讨论 :discussion 所得的 kudosu 已经重新计算。',
        'love' => '受到 :user 的喜爱',
        'nominate' => '被 :user 提名。',
        'nomination_reset' => '新问题 :discussion（:text）导致提名被重置。',
        'qualify' => '这张谱面已经有了足够数量的提名并已经 Qualified。',
        'rank' => 'Ranked.',
    ],

    'index' => [
        'title' => '谱面事件',

        'form' => [
            'period' => '时期',
            'types' => '类型',
        ],
    ],

    'item' => [
        'content' => '内容',
        'discussion_deleted' => '[已删除]',
        'type' => '类型',
    ],

    'type' => [
        'approve' => '推荐',
        'discussion_delete' => '删除讨论',
        'discussion_post_delete' => '删除讨论的回复',
        'discussion_post_restore' => '恢复已删除的讨论的回复',
        'discussion_restore' => '恢复已删除的讨论',
        'disqualify' => '取消 Qualified',
        'issue_reopen' => '议题重启',
        'issue_resolve' => '讨论被解决',
        'kudosu_allow' => '给予 Kudosu',
        'kudosu_deny' => '收回 Kudosu',
        'kudosu_gain' => '获得 Kudosu',
        'kudosu_lost' => '失去 Kudosu',
        'kudosu_recalculate' => '重新计算 Kudosu',
        'love' => '被 Loved',
        'nominate' => '提名',
        'nomination_reset' => '重置提名',
        'qualify' => '审核通过',
        'rank' => '被 Ranked',
    ],
];

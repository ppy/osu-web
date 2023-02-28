<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'event' => [
        'approve' => '谱面已达标 (Approved)。',
        'beatmap_owner_change' => ':new_user 成为 :beatmap 难度的作者',
        'discussion_delete' => '管理员删除了 :discussion 。',
        'discussion_lock' => '已封禁谱面的讨论区。 (:text)',
        'discussion_post_delete' => '管理员删除了 :discussion 中的回复。',
        'discussion_post_restore' => '管理员恢复了 :discussion 中的回复。',
        'discussion_restore' => '管理员恢复了 :discussion。',
        'discussion_unlock' => '已启用谱面的讨论区。',
        'disqualify' => '谱面已下架 (DQ)。原因：:user 提出的 :discussion (:text)。',
        'disqualify_legacy' => '谱面已下架 (DQ)。原因：:text。',
        'genre_edit' => '流派由 :old 更改为 :new。',
        'issue_reopen' => ':user 要求重审 :discussion_user 提出的问题 :discussion。',
        'issue_resolve' => ':user 已解决 :discussion_user 提出的问题 :discussion。',
        'kudosu_allow' => '已取消在讨论 :discussion 中移除 kudosu 的操作。',
        'kudosu_deny' => '已移除在讨论 :discussion 中获得的 kudosu。',
        'kudosu_gain' => ':user 提出的讨论 :discussion 已获得足够多的赞，获得 kudosu。',
        'kudosu_lost' => ':user 提出的讨论 :discussion 的赞数量不足，已移除 kudosu。',
        'kudosu_recalculate' => '已重新计算讨论 :discussion 中所得的 kudosu。',
        'language_edit' => '语言由 :old 更改为 :new。',
        'love' => ':user 将其加入社区喜爱 (Loved)。',
        'nominate' => ':user 提名了谱面。',
        'nominate_modes' => ':user (:modes) 提名了谱面。',
        'nomination_reset' => '谱面的提名过程重置：新问题 :discussion (:text)。',
        'nomination_reset_received' => ':source_user 重置了:user 的提名 (:text)',
        'nomination_reset_received_profile' => ':user 重置了提名 (:text) ',
        'offset_edit' => '在线偏移值由 :old 更改为 :new。',
        'qualify' => '谱面已过审 (Qualified)：这张谱面已经获得了足够数量的提名。',
        'rank' => '谱面已上架 (Ranked)。',
        'remove_from_loved' => ':user 已将其从社区喜爱 (Loved) 状态中移除。(:text)',

        'nsfw_toggle' => [
            'to_0' => '移除不良内容标识
',
            'to_1' => '已标为不良内容',
        ],
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
        'approve' => '达标 (Approved)',
        'beatmap_owner_change' => '更改难度作者',
        'discussion_delete' => '删除讨论',
        'discussion_post_delete' => '删除讨论下的回复',
        'discussion_post_restore' => '恢复讨论下已删除的回复',
        'discussion_restore' => '恢复已删除的讨论',
        'disqualify' => '下架 (DQ)',
        'genre_edit' => '更改流派',
        'issue_reopen' => '重审问题',
        'issue_resolve' => '解决问题',
        'kudosu_allow' => '给予 Kudosu',
        'kudosu_deny' => '收回 Kudosu',
        'kudosu_gain' => '获得 Kudosu',
        'kudosu_lost' => '失去 Kudosu',
        'kudosu_recalculate' => '重算 Kudosu',
        'language_edit' => '更改语言',
        'love' => '加入社区喜爱 (Loved)',
        'nominate' => '提名',
        'nomination_reset' => '重置提名',
        'nomination_reset_received' => '已重置提名',
        'nsfw_toggle' => '不良内容标识',
        'offset_edit' => '偏移值设定',
        'qualify' => '过审 (Qualification)',
        'rank' => '上架 (Ranking)',
        'remove_from_loved' => '移出社区喜爱 (Loved)',
    ],
];

<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'event' => [
        'approve' => 'Approved',
        'beatmap_owner_change' => '難易度:beatmapの所有者が:new_userに変更されました。',
        'discussion_delete' => 'モデレーターが:discussionを削除しました。',
        'discussion_lock' => 'このビートマップに関するディスカッションは無効になっています。 （:text）',
        'discussion_post_delete' => 'モデレーターが:discussionから投稿を削除しました。',
        'discussion_post_restore' => 'モデレーターが:discussionから投稿を復元しました。',
        'discussion_restore' => 'モデレーターが:discussionを復元しました。',
        'discussion_unlock' => 'このビートマップに関するディスカッションは有効になりました。',
        'disqualify' => ':userによってDisqualifyされました。理由：:discussion （:text）',
        'disqualify_legacy' => ':userによってDisqualifyされました。理由：:text。',
        'genre_edit' => 'ジャンルが :old から :new に変更されました。',
        'issue_reopen' => '解決済みの:discussionが再開されました。',
        'issue_resolve' => '問題:discussionが解決しました。',
        'kudosu_allow' => ':discussionに対するkudosuの拒否は削除されました。',
        'kudosu_deny' => ':discussionはkudosuにより拒否されました。',
        'kudosu_gain' => ':userの:discussionがkudosuに十分な評価を得ました。',
        'kudosu_lost' => ':userの:discussionは投票を失ったため、獲得したkudosuは削除されました。',
        'kudosu_recalculate' => ':discussionの取得kudosuが再計算されました。',
        'language_edit' => '言語が :old から :new に変更されました。',
        'love' => ':userがLovedに追加しました。',
        'nominate' => ':userがノミネートしました。',
        'nominate_modes' => ':user(:modes)がノミネートしました。',
        'nomination_reset' => '新しい問題 :discussion (:text)によりノミネートがリセットされました。',
        'qualify' => 'このビートマップは既に必要なノミネーション数に達しており、Qualifiedされています。',
        'rank' => 'Rankedされました。',
        'remove_from_loved' => ':userによってLovedから削除されました。(:text)',

        'nsfw_toggle' => [
            'to_0' => '露骨マークを削除しました',
            'to_1' => '露骨であるとマークする',
        ],
    ],

    'index' => [
        'title' => 'ビートマップセットイベント',

        'form' => [
            'period' => '期間',
            'types' => 'タイプ',
        ],
    ],

    'item' => [
        'content' => '目次',
        'discussion_deleted' => '[削除済み]',
        'type' => 'タイプ',
    ],

    'type' => [
        'approve' => '承認',
        'beatmap_owner_change' => '難易度の所有者変更',
        'discussion_delete' => 'ディスカッションの削除',
        'discussion_post_delete' => 'ディスカッションの返信を削除',
        'discussion_post_restore' => 'ディスカッションの返信を復元',
        'discussion_restore' => 'ディスカッションの復元',
        'disqualify' => 'Disqualification',
        'genre_edit' => 'ジャンル編集',
        'issue_reopen' => 'ディスカッションを再開する',
        'issue_resolve' => 'ディスカッションを解決する',
        'kudosu_allow' => 'Kudosuを許可',
        'kudosu_deny' => 'Kudosuを拒否',
        'kudosu_gain' => 'Kudosuを獲得',
        'kudosu_lost' => 'Kudosuを失う',
        'kudosu_recalculate' => 'Kudosuの再計算',
        'language_edit' => '言語編集',
        'love' => 'Love',
        'nominate' => 'ノミネーション',
        'nomination_reset' => 'ノミネーションのリセット',
        'nsfw_toggle' => '露骨マーク',
        'qualify' => 'Qualification',
        'rank' => 'ランキング',
        'remove_from_loved' => 'Loved削除',
    ],
];

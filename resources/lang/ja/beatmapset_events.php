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
    'event' => [
        'approve' => '承認済み',
        'discussion_delete' => 'モデレーターがディスカッション:discussionを削除しました。',
        'discussion_post_delete' => 'モデレーターがディスカッション:discussionから投稿を削除しました。',
        'discussion_post_restore' => 'モデレーターがディスカッション:discussionから投稿を復元しました。',
        'discussion_restore' => 'モデレーターがディスカッション:discussionを復元しました。',
        'disqualify' => ':userによってDisqualifyされました。理由：:discussion (:text).',
        'disqualify_legacy' => ':userによってDisqualifyされました。理由：:text.',
        'issue_reopen' => '解決済みの議題:discussionが再開されました。',
        'issue_resolve' => '議題:discussionが解決しました。',
        'kudosu_allow' => 'ディスカッション:discussionのkudosu拒否が取り消されました。',
        'kudosu_deny' => 'ディスカッション:discussionのkudosuが拒否されました。',
        'kudosu_gain' => ':userのディスカッション:discussionがkudosu取得に値する評価を得ました。',
        'kudosu_lost' => ':userのディスカッション:discussionの評価が下がりkudosu取得が取り消されました。',
        'kudosu_recalculate' => 'ディスカッション:discussionのkudosu取得量が再計算されました。',
        'love' => ':user がLovedに追加しました。',
        'nominate' => ':userがノミネートしました。',
        'nomination_reset' => '新しい問題:discussionによりノミネートがリセットされました。',
        'qualify' => 'このビートマップは既に必要なノミネーション数に達しており、申請されています。',
        'rank' => 'Rankedされました。',
    ],

    'index' => [
        'title' => 'ビートマップセットイベント',

        'form' => [
            'period' => '期間',
            'types' => '種類',
        ],
    ],

    'item' => [
        'content' => '目次',
        'discussion_deleted' => '[削除済み]',
        'type' => 'タイプ',
    ],

    'type' => [
        'approve' => '承認',
        'discussion_delete' => 'ディスカッション上の質問',
        'discussion_post_delete' => 'ディスカッション上の返信を削除',
        'discussion_post_restore' => 'ディスカッション上の返信を復元',
        'discussion_restore' => 'ディスカッションの復元',
        'disqualify' => '失格',
        'issue_reopen' => 'ディスカッションを再開する',
        'issue_resolve' => 'ディスカッションを解決する',
        'kudosu_allow' => '許可したKudosu',
        'kudosu_deny' => '拒否したKudosu',
        'kudosu_gain' => 'Kudosuを獲得する',
        'kudosu_lost' => 'Kudosuを失う',
        'kudosu_recalculate' => 'Kudosuを計算し直す',
        'love' => 'Love',
        'nominate' => 'ノミネーション',
        'nomination_reset' => 'ノミネーションを取り消し',
        'qualify' => '申請中',
        'rank' => 'ランキング',
    ],
];

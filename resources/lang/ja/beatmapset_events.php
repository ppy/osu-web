<?php

/**
 *    Copyright 2015-2018 ppy Pty. Ltd.
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
        'approve' => '承認済みです。',
        'discussion_delete' => 'モデレーターがディスカッション:discussionを削除しました。.',
        'discussion_post_delete' => 'モデレーターがディスカッション:discussionから投稿を削除しました。',
        'discussion_post_restore' => 'モデレーターがディスカッション:discussionから投稿を復元しました。',
        'discussion_restore' => 'モデレーターがディスカッション:discussionを復元しました。',
        'disqualify' => ':userがDisqualifyしました。理由：:discussion (:text).',
        'disqualify_legacy' => ':userがDisqualifyしました。理由：:text.',
        'issue_reopen' => '解決済みの事項:discussionが未解決に戻りました。',
        'issue_resolve' => '事項:discussionが解決しました。',
        'kudosu_allow' => 'ディスカッション:discussionのkudosu拒否が取り消されました。',
        'kudosu_deny' => 'ディスカッション:discussionのkudosuが拒否されました。',
        'kudosu_gain' => ':userのディスカッション:discussionがkudosu取得に値する評価を得ました。',
        'kudosu_lost' => ':userのディスカッション:discussionの評価が下がりkudosu取得が取り消されました。',
        'kudosu_recalculate' => 'ディスカッション:discussionのkudosu取得量が再計算されました。',
        'love' => ':user がLovedに追加しました。',
        'nominate' => ':userがノミネートしました。',
        'nomination_reset' => '新しい問題:discussionによりノミネートがリセットされました。',
        'qualify' => 'このBeatmapは審査の対象になる数に達しており、審査に通っています。',
        'rank' => 'Rankedされました。',
    ],

    'index' => [
        'title' => 'ビートマップセットイベント',
    ],

    'item' => [
        'content' => '目次',
        'discussion_deleted' => '[削除済み]',
        'type' => 'タイプ',
    ],
];

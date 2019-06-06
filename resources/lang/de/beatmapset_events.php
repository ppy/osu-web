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
        'approve' => 'Approved.',
        'discussion_delete' => 'Ein Moderator hat die Diskussion :discussion gelöscht.',
        'discussion_lock' => 'Die Diskussion für diese Beatmap wurde deaktiviert. (:text)',
        'discussion_post_delete' => 'Ein Moderator hat einen Beitrag der Diskussion :discussion gelöscht.',
        'discussion_post_restore' => 'Ein Moderator hat einen Beitrag der Diskussion :discussion wiederhergestellt.',
        'discussion_restore' => 'Ein Moderator hat die Diskussion :discussion wiederhergestellt.',
        'discussion_unlock' => 'Die Diskussion für diese Beatmap wurde aktiviert.',
        'disqualify' => 'Von :user disqualifiziert mit der Begründung: :text.',
        'disqualify_legacy' => 'Von :user disqualifiziert mit der Begründung: :text.',
        'issue_reopen' => 'Gelöster/-s Vorschlag/Problem :discussion wiedereröffnet.',
        'issue_resolve' => 'Vorschlag/Problem :discussion als gelöst gekennzeichnet.',
        'kudosu_allow' => 'Das kudosu-Verbot für Diskussion :discussion wurde entfernt.',
        'kudosu_deny' => 'Diskussion :discussion wurde das kudosu verwehrt.',
        'kudosu_gain' => 'Die Diskussion :discussion von :user hat genug Stimmen für kudosu erhalten.',
        'kudosu_lost' => 'Die Diskussion :discussion von :user hat an Stimmen verloren und kudosu wurde entfernt.',
        'kudosu_recalculate' => 'Das verteilte kudosu der Diskussion :discussion wurde neu berechnet.',
        'love' => 'Nominiert von :user',
        'nominate' => 'Von :user nominiert.',
        'nomination_reset' => 'Neues Problem :discussion hat die Nominierung zurückgesetzt.',
        'qualify' => 'Diese Beatmap hat die erforderliche Anzahl an Nominierungen erreicht und wurde qualifiziert.',
        'rank' => 'Ranked.',
    ],

    'index' => [
        'title' => 'Beatmapset-Events',

        'form' => [
            'period' => 'Zeitraum',
            'types' => 'Typen',
        ],
    ],

    'item' => [
        'content' => 'Inhalt',
        'discussion_deleted' => '[gelöscht]',
        'type' => 'Typ',
    ],

    'type' => [
        'approve' => 'Approval',
        'discussion_delete' => 'Diskussion löschen',
        'discussion_post_delete' => 'Löschen der Diskussionsantwort',
        'discussion_post_restore' => 'Diskussionsantwort wiederherstellen',
        'discussion_restore' => 'Diskussion wiederherstellen',
        'disqualify' => 'Disqualifikation',
        'issue_reopen' => 'Diskussion wieder öffnen',
        'issue_resolve' => 'Diskussion lösen',
        'kudosu_allow' => 'Kudosu erlauben',
        'kudosu_deny' => 'Kudosu verweigern',
        'kudosu_gain' => 'Kudosu erlangt',
        'kudosu_lost' => 'Kudosu verloren',
        'kudosu_recalculate' => 'Kudosu neuberechnen',
        'love' => 'Love',
        'nominate' => 'Nominierung',
        'nomination_reset' => 'Nominierung zurücksetzten',
        'qualify' => 'Qualifikation',
        'rank' => 'Ranking',
    ],
];

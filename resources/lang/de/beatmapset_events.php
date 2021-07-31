<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'event' => [
        'approve' => 'Approved.',
        'beatmap_owner_change' => 'Besitzer der Schwierigkeit :beatmap wurde auf :new_user geändert.',
        'discussion_delete' => 'Ein Moderator hat die Diskussion :discussion gelöscht.',
        'discussion_lock' => 'Die Diskussion für diese Beatmap wurde deaktiviert. (:text)',
        'discussion_post_delete' => 'Ein Moderator hat einen Beitrag der Diskussion :discussion gelöscht.',
        'discussion_post_restore' => 'Ein Moderator hat einen Beitrag der Diskussion :discussion wiederhergestellt.',
        'discussion_restore' => 'Ein Moderator hat die Diskussion :discussion wiederhergestellt.',
        'discussion_unlock' => 'Die Diskussion für diese Beatmap wurde aktiviert.',
        'disqualify' => 'Von :user disqualifiziert mit der Begründung: :discussion (:text).',
        'disqualify_legacy' => 'Von :user disqualifiziert mit der Begründung: :text.',
        'genre_edit' => 'Genre wurde von :old zu :new geändert.',
        'issue_reopen' => 'Gelöster/-s Vorschlag/Problem :discussion wiedereröffnet.',
        'issue_resolve' => 'Vorschlag/Problem :discussion als gelöst gekennzeichnet.',
        'kudosu_allow' => 'Das kudosu-Verbot für Diskussion :discussion wurde entfernt.',
        'kudosu_deny' => 'Diskussion :discussion wurde das kudosu verwehrt.',
        'kudosu_gain' => 'Die Diskussion :discussion von :user hat genug Stimmen für Kudosu erhalten.',
        'kudosu_lost' => 'Die Diskussion :discussion von :user hat an Stimmen verloren und kudosu wurde entfernt.',
        'kudosu_recalculate' => 'Das verteilte kudosu der Diskussion :discussion wurde neu berechnet.',
        'language_edit' => 'Sprache wurde von :old zu :new geändert.',
        'love' => 'Nominiert von :user',
        'nominate' => 'Von :user nominiert.',
        'nominate_modes' => 'Nominiert von :user (:modes).',
        'nomination_reset' => 'Neues Problem :discussion hat die Nominierung zurückgesetzt.',
        'nomination_reset_received' => '',
        'nomination_reset_received_profile' => '',
        'qualify' => 'Diese Beatmap hat die erforderliche Anzahl an Nominierungen erreicht und wurde qualifiziert.',
        'rank' => 'Ranked.',
        'remove_from_loved' => 'Aus Loved entfernt von :user. (:text)',

        'nsfw_toggle' => [
            'to_0' => 'Explizit-Markierung entfernt',
            'to_1' => 'Als explizit markiert',
        ],
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
        'beatmap_owner_change' => 'Schwierigkeitsstufenbesitzeränderung',
        'discussion_delete' => 'Diskussion löschen',
        'discussion_post_delete' => 'Löschen der Diskussionsantwort',
        'discussion_post_restore' => 'Diskussionsantwort wiederherstellen',
        'discussion_restore' => 'Diskussion wiederherstellen',
        'disqualify' => 'Disqualifikation',
        'genre_edit' => 'Genre-Änderung',
        'issue_reopen' => 'Diskussion wieder öffnen',
        'issue_resolve' => 'Diskussion lösen',
        'kudosu_allow' => 'Kudosu erlauben',
        'kudosu_deny' => 'Kudosu verweigern',
        'kudosu_gain' => 'Kudosu erlangt',
        'kudosu_lost' => 'Kudosu verloren',
        'kudosu_recalculate' => 'Kudosu neuberechnen',
        'language_edit' => 'Sprachänderung',
        'love' => 'Love',
        'nominate' => 'Nominierung',
        'nomination_reset' => 'Nominierung zurücksetzten',
        'nomination_reset_received' => '',
        'nsfw_toggle' => 'Explizit-Markierung',
        'qualify' => 'Qualifikation',
        'rank' => 'Ranking',
        'remove_from_loved' => 'Loved-Entfernung',
    ],
];

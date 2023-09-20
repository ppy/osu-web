<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'event' => [
        'approve' => 'Approved.',
        'beatmap_owner_change' => 'Besitzer der Difficulty :beatmap wurde zu :new_user geändert.',
        'discussion_delete' => 'Ein Moderator hat die Diskussion :discussion gelöscht.',
        'discussion_lock' => 'Die Diskussion für diese Beatmap wurde deaktiviert. (:text)',
        'discussion_post_delete' => 'Ein Moderator hat einen Beitrag der Diskussion :discussion gelöscht.',
        'discussion_post_restore' => 'Ein Moderator hat einen Beitrag der Diskussion :discussion wiederhergestellt.',
        'discussion_restore' => 'Ein Moderator hat die Diskussion :discussion wiederhergestellt.',
        'discussion_unlock' => 'Die Diskussion für diese Beatmap wurde aktiviert.',
        'disqualify' => 'Von :user disqualifiziert. Grund: :discussion (:text).',
        'disqualify_legacy' => 'Von :user disqualifiziert. Grund: :text.',
        'genre_edit' => 'Genre wurde von :old zu :new geändert.',
        'issue_reopen' => 'Gelöstes Problem :discussion von :discussion_user wurde durch :user wiedereröffnet.',
        'issue_resolve' => 'Problem :discussion von :discussion_user wurde durch :user als gelöst gekennzeichnet.',
        'kudosu_allow' => 'Kudosu-Ablehnung für die Diskussion :discussion wurde entfernt.',
        'kudosu_deny' => 'Kudosu werden in der Diskussion :discussion abgelehnt.',
        'kudosu_gain' => 'Die Diskussion :discussion von :user hat genug Stimmen für Kudosu erhalten.',
        'kudosu_lost' => 'Die Diskussion :discussion von :user hat an Stimmen verloren und erteilte Kudosu wurden abgelehnt.',
        'kudosu_recalculate' => 'Erteilte Kudosu der Diskussion :discussion wurden neu berechnet.',
        'language_edit' => 'Sprache wurde von :old zu :new geändert.',
        'love' => 'Loved von :user.',
        'nominate' => 'Von :user nominiert.',
        'nominate_modes' => 'Nominiert von :user (:modes).',
        'nomination_reset' => 'Ein neues Problem :discussion hat die Nominierung zurückgesetzt (:text).',
        'nomination_reset_received' => 'Nominierung von :user wurde von :source_user zurückgesetzt (:text)',
        'nomination_reset_received_profile' => 'Nominierung wurde von :user zurückgesetzt (:text)',
        'offset_edit' => 'Online-Offset wurde von :old zu :new geändert.',
        'qualify' => 'Diese Beatmap hat die erforderliche Anzahl an Nominierungen erreicht und wurde qualifiziert.',
        'rank' => 'Ranked.',
        'remove_from_loved' => 'Aus Loved entfernt von :user. (:text)',
        'tags_edit' => 'Tags wurden von ":old" zu ":new" geändert.',

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
        'beatmap_owner_change' => 'Besitzerwechsel der Difficulty',
        'discussion_delete' => 'Diskussion löschen',
        'discussion_post_delete' => 'Antwort in der Diskussion entfernen',
        'discussion_post_restore' => 'Antwort in der Diskussion wiederherstellen',
        'discussion_restore' => 'Diskussion wiederherstellen',
        'disqualify' => 'Disqualifikation',
        'genre_edit' => 'Genre-Änderung',
        'issue_reopen' => 'Diskussion wiedereröffnen',
        'issue_resolve' => 'Diskussion lösen',
        'kudosu_allow' => 'Kudosu erlauben',
        'kudosu_deny' => 'Kudosu ablehnen',
        'kudosu_gain' => 'Kudosu erhalten',
        'kudosu_lost' => 'Kudosu-Verlust',
        'kudosu_recalculate' => 'Kudosu-Neuberechnung',
        'language_edit' => 'Sprachänderung',
        'love' => 'Love',
        'nominate' => 'Nominierung',
        'nomination_reset' => 'Nominierung zurücksetzten',
        'nomination_reset_received' => 'Nomination-Reset erhalten',
        'nsfw_toggle' => 'Explizit-Markierung',
        'offset_edit' => 'Offset bearbeiten',
        'qualify' => 'Qualifikation',
        'rank' => 'Rangliste',
        'remove_from_loved' => 'Loved entfernen',
    ],
];

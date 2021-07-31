<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'event' => [
        'approve' => 'Jóváhagyva.',
        'beatmap_owner_change' => ':new_user lett az új tulajdonosa :beatmap nehézségnek.',
        'discussion_delete' => 'A moderátor kitörölte a :discussion megbeszélést.',
        'discussion_lock' => 'A beatmap megbeszélése meg lett tiltva. (:text)',
        'discussion_post_delete' => 'A moderátor posztot törölt a :discussion megbeszélésből.',
        'discussion_post_restore' => 'A moderátor posztot állított vissza a :discussion megbeszélésben.',
        'discussion_restore' => 'A moderátor visszaállította a következő megbeszélést :discussion.',
        'discussion_unlock' => 'A beatmap megbeszélése engedélyezve lett.',
        'disqualify' => 'Diszkvalifikálva :user által. Indok: :discussion (:text).',
        'disqualify_legacy' => 'Diszkvalifikálva :user által. Indok: :text.',
        'genre_edit' => 'Műfaj megváltoztatva erről :old erre :new.',
        'issue_reopen' => 'Megoldott probléma :discussion újranyitva.',
        'issue_resolve' => 'A :discussion problémát megoldottnak jelölték.',
        'kudosu_allow' => 'Kudosu megtagadás a :discussion megbeszélésre el lett távolítva.',
        'kudosu_deny' => 'A :discussion megbeszélés kudosu-tól megtagadva.',
        'kudosu_gain' => 'A :discussion megbeszélés :user által elég szavazatot szerzett kudosu-ra.',
        'kudosu_lost' => 'A :discussion megbeszélés :user által szavazatokat vesztett, így a megszerzett kudosu vissza lett vonva.',
        'kudosu_recalculate' => 'A :discussion megbeszélés kudosu értékei újra lettek kalkulálva.',
        'language_edit' => 'Nyelv megváltoztatva erről :old erre :new.',
        'love' => 'Kedvelte :user',
        'nominate' => 'Nominálva :user által.',
        'nominate_modes' => 'Nominálva :user (:modes) által.',
        'nomination_reset' => 'Új probléma :discussion (:text) miatt a nominálás alaphelyzetbe állt.',
        'nomination_reset_received' => '',
        'nomination_reset_received_profile' => '',
        'qualify' => 'Ez a beatmap elérte az elegendő számú nominálást és kvalifikálva lett.',
        'rank' => 'Rangsorolt.',
        'remove_from_loved' => 'Eltávolítva szeretettek közül :user felhasználó által. (:text)',

        'nsfw_toggle' => [
            'to_0' => 'Felnőtt tartalom törlése',
            'to_1' => 'Felnőtt tartalomként jelölés',
        ],
    ],

    'index' => [
        'title' => 'Beatmap szett Események',

        'form' => [
            'period' => 'Időszak',
            'types' => 'Típusok',
        ],
    ],

    'item' => [
        'content' => 'Tartalom',
        'discussion_deleted' => '[törölt]',
        'type' => 'Típus',
    ],

    'type' => [
        'approve' => 'Jóváhagyás',
        'beatmap_owner_change' => 'Nehézség tulajdonosának változása',
        'discussion_delete' => 'Megbeszélés törlése',
        'discussion_post_delete' => 'Megbeszélés válaszának törlése',
        'discussion_post_restore' => 'Megbeszélés válaszának visszaállítása',
        'discussion_restore' => 'Megbeszélés visszaállítása',
        'disqualify' => 'Diszkvalifikáció',
        'genre_edit' => 'Műfaj szerkesztése',
        'issue_reopen' => 'Megbeszélés újranyitás',
        'issue_resolve' => 'Megbeszélés megoldás',
        'kudosu_allow' => 'Kudosu engedélyezés',
        'kudosu_deny' => 'Kudosu megtagadás',
        'kudosu_gain' => 'Kudosu nyereség',
        'kudosu_lost' => 'Kudosu veszteség',
        'kudosu_recalculate' => 'Kudosu újraszámítás',
        'language_edit' => 'Nyelv szerkesztése',
        'love' => 'Love',
        'nominate' => 'Nominálás',
        'nomination_reset' => 'Nominálás visszaállítás',
        'nomination_reset_received' => '',
        'nsfw_toggle' => 'Felnőtt tartalom jel',
        'qualify' => 'Kvalifikáció',
        'rank' => 'Rangsorolás',
        'remove_from_loved' => 'Szeretett eltávolítás',
    ],
];

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
        'approve' => 'Jóváhagyva.',
        'discussion_delete' => 'A moderátor kitörölte a :discussion megbeszélést.',
        'discussion_lock' => 'A beatmap megbeszélése meg lett tiltva. (:text)',
        'discussion_post_delete' => 'A moderátor posztot törölt a :discussion megbeszélésből.',
        'discussion_post_restore' => 'A moderátor posztot állított vissza a :discussion megbeszélésben.',
        'discussion_restore' => 'A moderátor visszaállította a következő megbeszélést :discussion.',
        'discussion_unlock' => 'A beatmap megbeszélése engedélyezve lett.',
        'disqualify' => 'Diszkvalifikálva :user által. Indok: :discussion (:text).',
        'disqualify_legacy' => 'Diszkvalifikálva :user által. Indok: :text.',
        'issue_reopen' => 'Megoldott probléma :discussion újranyitva.',
        'issue_resolve' => 'A :discussion problémát megoldottnak jelölték.',
        'kudosu_allow' => 'Kudosu megtagadás a :discussion megbeszélésre el lett távolítva.',
        'kudosu_deny' => 'A :discussion megbeszélés kudosu-tól megtagadva.',
        'kudosu_gain' => 'A :discussion megbeszélés :user által elég szavazatot szerzett kudosu-ra.',
        'kudosu_lost' => 'A :discussion megbeszélés :user által szavazatokat vesztett, így a megszerzett kudosu vissza lett vonva.',
        'kudosu_recalculate' => 'A :discussion megbeszélés kudosu értékei újra lettek kalkulálva.',
        'love' => 'Kedvelte :user',
        'nominate' => 'Nominálva :user által.',
        'nomination_reset' => 'Új probléma :discussion (:text) miatt a nominálás alaphelyzetbe állt.',
        'qualify' => 'Ez a beatmap elérte az elegendő számú nominálást és kvalifikálva lett.',
        'rank' => 'Rangsorolt.',
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
        'discussion_delete' => 'Megbeszélés törlése',
        'discussion_post_delete' => 'Megbeszélés válaszának törlése',
        'discussion_post_restore' => 'Megbeszélés válaszának visszaállítása',
        'discussion_restore' => 'Megbeszélés visszaállítása',
        'disqualify' => 'Diszkvalifikáció',
        'issue_reopen' => 'Megbeszélés újranyitás',
        'issue_resolve' => 'Megbeszélés megoldás',
        'kudosu_allow' => 'Kudosu engedélyezés',
        'kudosu_deny' => 'Kudosu megtagadás',
        'kudosu_gain' => 'Kudosu nyereség',
        'kudosu_lost' => 'Kudosu veszteség',
        'kudosu_recalculate' => 'Kudosu újraszámítás',
        'love' => 'Love',
        'nominate' => 'Nominálás',
        'nomination_reset' => 'Nominálás visszaállítás',
        'qualify' => 'Kvalifikáció',
        'rank' => 'Rangsorolás',
    ],
];

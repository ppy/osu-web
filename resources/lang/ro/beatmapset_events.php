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
        'approve' => 'Aprobat.',
        'discussion_delete' => 'Un moderator a șters discuția :discussion.',
        'discussion_lock' => 'Discuție pentru acest beatmap a fost dezactivată. (:text)',
        'discussion_post_delete' => 'Un moderator a șters postarea din discuția :discussion.',
        'discussion_post_restore' => 'Un moderator a restaurat postarea din discuția :discussion.',
        'discussion_restore' => 'Un moderator a restaurat discuția :discussion.',
        'discussion_unlock' => 'Discuție pentru acest beatmap a fost activată.',
        'disqualify' => 'Descalificat de :user. Motiv: :discussion (:text).',
        'disqualify_legacy' => 'Descalificat de :user. Motiv :text.',
        'issue_reopen' => 'Problema rezolvată :discussion s-a redeschis.',
        'issue_resolve' => 'Problema :discussion a fost marcată ca rezolvată.',
        'kudosu_allow' => 'Negocierea de kudosu pentru discuția :discussion a fost eliminată.',
        'kudosu_deny' => 'Discuția :discussion a fost respinsă pentru kudosu.',
        'kudosu_gain' => 'Discuția :discussion de :user a obținut destule voturi pentru kudosu.',
        'kudosu_lost' => 'Discuția :discussion de :user a pierdut voturi și kudosu acordați au fost eliminați.',
        'kudosu_recalculate' => 'Numărul de kudosu acordat pentru discuția :discussion a fost recalculat.',
        'love' => 'Loved de către :user',
        'nominate' => 'Nominalizat de :user.',
        'nomination_reset' => 'O problemă nouă :discussion (:text) a declanșat reluarea unei nominalizări.',
        'qualify' => 'Acest beatmap a atins numărul limită de nominalizări și s-a calificat.',
        'rank' => 'Clasat.',
    ],

    'index' => [
        'title' => 'Evenimente beatmapset',

        'form' => [
            'period' => 'Perioadă',
            'types' => 'Tipuri',
        ],
    ],

    'item' => [
        'content' => 'Conținut',
        'discussion_deleted' => '[deleted]',
        'type' => 'Tip',
    ],

    'type' => [
        'approve' => 'Aprobare',
        'discussion_delete' => 'Ștergerea discuției',
        'discussion_post_delete' => 'Ștergerea răspunsului',
        'discussion_post_restore' => 'Restaurarea răspunsului',
        'discussion_restore' => 'Restaurarea discuției',
        'disqualify' => 'Descalificare',
        'issue_reopen' => 'Redeschiderea discuției',
        'issue_resolve' => 'Rezolvarea discuției',
        'kudosu_allow' => 'Alocația de kudosu',
        'kudosu_deny' => 'Respingere de kudosu',
        'kudosu_gain' => 'Câștigare de kudosu',
        'kudosu_lost' => 'Pierdere de kudosu',
        'kudosu_recalculate' => 'Recalcularea kudosu',
        'love' => 'Love',
        'nominate' => 'Nominalizare',
        'nomination_reset' => 'Resetarea nominalizărilor',
        'qualify' => 'Calificare',
        'rank' => 'Clasament',
    ],
];

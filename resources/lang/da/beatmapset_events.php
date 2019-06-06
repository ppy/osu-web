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
        'approve' => 'Godkendt.',
        'discussion_delete' => 'Moderator slette diskussionen :discussion.',
        'discussion_lock' => 'Diskussion for dette beatmap er blevet deaktiveret. (:text)',
        'discussion_post_delete' => 'Moderator slettede et opslag fra diskussionen :discussion.',
        'discussion_post_restore' => 'Moderator gendannede et opslag fra diskussionen :discussion.',
        'discussion_restore' => 'Moderator gendannede diskussionen :discussion.',
        'discussion_unlock' => 'Diskussion for dette beatmap er blevet aktiveret.',
        'disqualify' => 'Diskvalificeret af :user. Årsag: :discussion (:text).',
        'disqualify_legacy' => 'Diskvalificeret af :user. Årsag: :text.',
        'issue_reopen' => 'Løste problem :discussion genåbnet.',
        'issue_resolve' => 'Problem :discussion markeret som løst.',
        'kudosu_allow' => 'Kudosu benægtelse fordi diskussionen :discussion er blevet fjernet.',
        'kudosu_deny' => 'Diskussionen :discussion er blevet benægtet fra at modtage kudosu.',
        'kudosu_gain' => 'Diskussionen :discussion af :user modtog nok stemmer for at modtage kudosu.',
        'kudosu_lost' => 'Diskussionen :discussion by :user mistede stemmer, og det givne kudosu er blevet inddraget.',
        'kudosu_recalculate' => 'Diskussionen :discussion har fået sin kudosu givelser genberegnet.',
        'love' => 'Elsket af :user',
        'nominate' => 'Nomineret af :user.',
        'nomination_reset' => 'Nyt problem :discussion udløste en nomineringsnulstilling.',
        'qualify' => 'Denne beatmap har nået det krævede antal nomineringer og er blevet kvalificeret.',
        'rank' => 'Ranked.',
    ],

    'index' => [
        'title' => 'Beatmapset Begivenheder',

        'form' => [
            'period' => 'Periode',
            'types' => 'Skriver',
        ],
    ],

    'item' => [
        'content' => 'Indhold',
        'discussion_deleted' => '[slettet]',
        'type' => 'Skriv',
    ],

    'type' => [
        'approve' => 'Godkendelse',
        'discussion_delete' => 'Diskussion sletning',
        'discussion_post_delete' => 'Diskussion svar sletning',
        'discussion_post_restore' => 'Diskussion svar restoration',
        'discussion_restore' => 'Diskussion restoration',
        'disqualify' => 'Diskvalifikation',
        'issue_reopen' => 'Diskussion genåbning',
        'issue_resolve' => 'Diskussion løsning',
        'kudosu_allow' => 'Kudosu Tilgængelighed',
        'kudosu_deny' => 'Kudosu nægtelse',
        'kudosu_gain' => 'Kudosu tjent',
        'kudosu_lost' => 'Kudosu mistet',
        'kudosu_recalculate' => 'Kudosu genberegning',
        'love' => 'Kærlighed',
        'nominate' => 'Nominering',
        'nomination_reset' => 'Nulstilling af nominering',
        'qualify' => 'Kvalifikation',
        'rank' => 'Rangering',
    ],
];

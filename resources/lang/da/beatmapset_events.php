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
        'discussion_delete' => 'Moderator slettede diskussion :discussion.',
        'discussion_lock' => 'Diskussion for dette beatmap er blevet deaktiveret. (:text)',
        'discussion_post_delete' => 'Moderator slettede et opslag fra diskussion :discussion.',
        'discussion_post_restore' => 'Moderator gendannede et opslag fra diskussion :discussion.',
        'discussion_restore' => 'Moderator gendannede diskussion :discussion.',
        'discussion_unlock' => 'Diskussion for dette beatmap er blevet aktiveret.',
        'disqualify' => 'Diskvalificeret af :user. Årsag: :discussion (:text).',
        'disqualify_legacy' => 'Diskvalificeret af :user. Årsag: :text.',
        'issue_reopen' => 'Løste problem :discussion genåbnet.',
        'issue_resolve' => 'Problem :discussion markeret som løst.',
        'kudosu_allow' => 'Kudosu nægtet fordi diskussion :discussion er blevet fjernet.',
        'kudosu_deny' => 'Diskussion :discussion er blevet nægtet kudosu.',
        'kudosu_gain' => 'Diskussion :discussion af :user opnåede stemmer nok til at få kudosu.',
        'kudosu_lost' => 'Diskussion :discussion af :user mistede stemmer, og det modtagede kudosu er blevet taget tilbage.',
        'kudosu_recalculate' => 'Diskussion :discussion har haft sit kudosu genberegnet.',
        'love' => 'Elsket af :user',
        'nominate' => 'Nomineret af :user.',
        'nomination_reset' => 'Nyt problem :discussion udløste en nomineringsnulstilling.',
        'qualify' => 'Dette beatmap har opnået det nødvendige antal nomineringer og er blevet kvalificeret.',
        'rank' => 'Ranked.',
    ],

    'index' => [
        'title' => 'Beatmapset Begivenheder',

        'form' => [
            'period' => 'Periode',
            'types' => 'Typer',
        ],
    ],

    'item' => [
        'content' => 'Indhold',
        'discussion_deleted' => '[slettet]',
        'type' => 'Type',
    ],

    'type' => [
        'approve' => 'Godkendelse',
        'discussion_delete' => 'Diskussions-sletning',
        'discussion_post_delete' => 'Diskussions-svar sletning',
        'discussion_post_restore' => 'Diskussions-svar genoprettelse',
        'discussion_restore' => 'Diskussions-genoprettelse',
        'disqualify' => 'Diskvalifikation',
        'issue_reopen' => 'Diskussions-genåbning',
        'issue_resolve' => 'Diskussion løsning',
        'kudosu_allow' => 'Kudosu indkomst',
        'kudosu_deny' => 'Kudosu nægtelse',
        'kudosu_gain' => 'Kudosu tjent',
        'kudosu_lost' => 'Kudosu mistet',
        'kudosu_recalculate' => 'Kudosu genberegning',
        'love' => 'Elsk',
        'nominate' => 'Nominering',
        'nomination_reset' => 'Nulstilling af nominering',
        'qualify' => 'Kvalifikation',
        'rank' => 'Rangering',
    ],
];

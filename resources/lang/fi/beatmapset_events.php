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
        'approve' => 'Vahvistettu.',
        'discussion_delete' => 'Moderaattori poisti keskustelun :discussion.',
        'discussion_lock' => '',
        'discussion_post_delete' => 'Moderaattori poisti viestin keskustelusta :discussion.',
        'discussion_post_restore' => 'Moderaattori toi viestin takaisin keskusteluun :discussion.',
        'discussion_restore' => 'Moderaattori toi keskustelun :discussion takaisin.',
        'discussion_unlock' => '',
        'disqualify' => 'Hyväksymisen keskeytti :user. Syy: :discussion (:text).',
        'disqualify_legacy' => ':user keskeytti hyväksymisen. Syy: :text.',
        'issue_reopen' => 'Ratkaistu ongelma :discussion uudelleenavattu.',
        'issue_resolve' => 'Ongelma :discussion merkitty ratkaistuksi.',
        'kudosu_allow' => 'Kudosuhylkäys keskustelusta :discussion on poistettu.',
        'kudosu_deny' => 'Keskustelusta :discussion hylättiin kudosu.',
        'kudosu_gain' => 'Keskustelu :discussion käyttäjältä :user sai tarpeeksi ääniä kudosua varten.',
        'kudosu_lost' => 'Keskustelu :discussion käyttäjältä :user menetti ääniä ja annettu kudosu on poistettu.',
        'kudosu_recalculate' => 'Keskustelun :discussion kudosu on uudelleenlaskettu.',
        'love' => ':user rakastaa',
        'nominate' => 'Käyttäjän :user suosittelema.',
        'nomination_reset' => 'Uusi ongelma :discussion (:text) nollasi suositukset.',
        'qualify' => 'Tämä beatmap sai vaaditun määrän suosituksia hyväksymisvaihetta varten.',
        'rank' => 'Hyväksytty.',
    ],

    'index' => [
        'title' => 'Beatmapin Tapahtumat',

        'form' => [
            'period' => 'Piste',
            'types' => 'Tyypit',
        ],
    ],

    'item' => [
        'content' => 'Sisältö',
        'discussion_deleted' => '[poistettu]',
        'type' => 'Tyyppi',
    ],

    'type' => [
        'approve' => 'Hyväksyntä',
        'discussion_delete' => 'Poista keskustelu',
        'discussion_post_delete' => 'Keskustelun vastauksen poistaminen',
        'discussion_post_restore' => 'Keskustelun vastauksen palautus',
        'discussion_restore' => 'Keskustelun palauttaminen',
        'disqualify' => 'Epähyväksyntä',
        'issue_reopen' => 'Keskustelun uudelleenavaaminen',
        'issue_resolve' => 'Keskustelun ratkaiseminen',
        'kudosu_allow' => 'Kusodun hyväksyntä',
        'kudosu_deny' => 'Kusodun kieltäminen',
        'kudosu_gain' => 'Kusodun ansaitseminen',
        'kudosu_lost' => 'Kusodun menettäminen',
        'kudosu_recalculate' => 'Kusodun uudelleenlaskenta',
        'love' => 'Rakkaus',
        'nominate' => 'Äänestetty',
        'nomination_reset' => 'Äänestyksen resetointi',
        'qualify' => 'Hyväksyntä',
        'rank' => 'Luokittelu',
    ],
];
